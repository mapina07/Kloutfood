<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\Cart;
use App\Models\IngredientCart;
use App\Models\Spare;

use function PHPUnit\Framework\isNull;

class StoreController extends Controller
{
    /**
     * Display a listing of the recipe to the shop.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        $recipes = Recipe::all();
        $categorys = Category::all();
        return    view('shop')->with([
            'recipes' => $recipes,
            'categorys' => $categorys,
            'filter' => "",
            'criterio' => ""
        ]);
    }

    /**
     * Search  the specified resource.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd($request->all());
        if ($request->input('filterCategory') && $request->input('searchRecipe')) {
           $filterCategory = $request->input('filterCategory');
            $search =  $request->input('searchRecipe');

            $categorys = Category::all();

            if($filterCategory == "Seleccione"){
                $recipes = Recipe::where('name', 'LIKE', '%' . $search . '%')->paginate(4);
            }else{
                $recipes = Recipe::where([
                    ['category_id','=', $filterCategory],
                    ['name', 'LIKE', '%' . $search . '%']
                ])->paginate(4);
            }

            return view('shop')->with([
                'recipes' => $recipes,
                'categorys' => $categorys,
                'filter' => $filterCategory,
                'criterio' => $search
            ]);
        }elseif($request->input('filterCategory')){
            $filterCategory = $request->input('filterCategory');
            $search =  "";


            if($filterCategory == "Seleccione"){
                return redirect()->route('store');
            }else{
                $categorys = Category::all();
                $recipes = Recipe::where('category_id',$filterCategory)->paginate(4);
            }

            return view('shop')->with([
                'recipes' => $recipes,
                'categorys' => $categorys,
                'filter' => $filterCategory,
                'criterio' => $search
            ]) ;
        } else {
            return redirect()->route('store');
        }
    }


    /**
     * Detail the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        if($id){
            $recipe = Recipe::find($id);
            if($recipe){
                return view('card-recipe-detail')->with(['recipe' => $recipe]) ;
            }else{
                return redirect()->route('store')->with(array('tipo_msg'=>'error','msg'=>'Error, Ese identificador no se corresponde con ninguna receta de nuestra Base de Datos.'));
            }
        }
        else{
            return redirect()->route('store')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }

     /**
     * Display a listing of the recipe to the shop.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        if($request->recipe_id && $request->session()->has('LoginUser')){
            $user = $request->session()->get('LoginUser');
            $recipe_id = $request->recipe_id;
            $recipe = Recipe::where('id',$recipe_id)->first();
            $cart = Cart::create([
                "user_id"=>$user->id,
                "recipe_id"=>$recipe_id,
                "costo"=>$recipe->maxPrice()
            ]);
            foreach($recipe->ingredientes as $ingredient){

                $ing_cart = new IngredientCart();
                $ing_cart->cart_id = $cart->id;
                $ing_cart->user_id = $user->id;
                $ing_cart->recipe_id = $recipe_id;
                $ing_cart->ingredient_id = $ingredient->id;
                //Obteniendo el sobrante.
                $spare = Spare::where(['user_id'=>$user->id,'ingredient_id'=>$ingredient->id])->first();
                if(!$spare){
                    $spare = Spare::create([
                        "user_id" => $user->id,
                        "ingredient_id" => $ingredient->id,
                        "spare_quantity" => 0
                    ]);
                }
                $ing_cart->spare = $spare->spare_quantity;
                //Calculando la cantidad real del ingrediente a comprar, y actualizando el sobrante.
                if($ingredient->pivot->quantity <= $spare->spare_quantity){
                    $ing_cart->real_sales_quantity = 0;
                    $ing_cart->sale = 0;
                    $ing_cart->costo = 0;

                    $spare->spare_quantity = floatval($spare->spare_quantity) - floatval($ingredient->pivot->quantity);
                    $ing_cart->new_spare = $spare->spare_quantity;
                    $spare->save();
                }else{
                    if($ingredient->pivot->quantity > $spare->spare_quantity){
                        $cant_real = floatval($ingredient->pivot->quantity) - floatval($spare->spare_quantity);
                        $ing_cart->real_sales_quantity = $cant_real;
                        $ing_cart->costo = $this->precioRealIngrediente($ingredient->min_quantity, $cant_real,$ingredient->price);

                        $cant_comprada = $this->cantRealComprada($ingredient->min_quantity, $cant_real);
                        $ing_cart->sale = $cant_comprada;
                        $spare->spare_quantity = $cant_comprada - $cant_real;
                        $ing_cart->new_spare = $spare->spare_quantity;
                        $spare->save();
                    }
                }
                $ing_cart->save();
            }

            $ingredients_cart = IngredientCart::where('cart_id',$cart->id)->get();
            $cart_cost = $ingredients_cart->sum->costo;
            $cart->costo = $cart_cost;
            $cart->save();

            $cant_pedidos = $this->actualizarCart($request);
            return response()->json(['cant_pedidos'=>$cant_pedidos,'tipo_msg'=>'ok','msg'=>'La receta fue agregada al carrito.']);
        }else{
            return response()->json(['cant_pedidos'=>0,'tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.']);
        }
    }

    private function actualizarCart(Request $request)
    {
        $cant_pedido =  intval($request->session()->get('cant_pedidos'));
        $cant_pedido += 1;
        $request->session()->put('cant_pedidos',intval($cant_pedido));
        return $cant_pedido;
    }

    private function precioRealIngrediente($min_quantity, $rec_cuant,$price)
    {
            $stop = $min_quantity;
            $cant = 1;
            while($stop <  $rec_cuant){
                $cant+=1;
                $stop += floatval($min_quantity);
            }
            $precio_ingrediente_receta = $cant * $price;

            return floatval($precio_ingrediente_receta);
    }

    private function cantRealComprada($min_quantity, $rec_cuant)
    {
            $cantRealComprada = 0;
            $stop = $min_quantity;
            $cant = 1;
            while($stop <  $rec_cuant){
                $cant+=1;
                $stop += floatval($min_quantity);
            }
            $cantRealComprada = $stop;

            return floatval($cantRealComprada);
    }



    /**
    * Display shopping cart list.
    *
    * @return \Illuminate\Http\Response
    */
    public function shoppingCart(Request $request)
    {
        $cart_list = [];
        if($request->session()->has('LoginUser')){
            $user = $request->session()->get('LoginUser');
            $carts = Cart::where('user_id',$user->id)->get();
            foreach ($carts as $cart){
                $newCart = new \stdClass;
                $newCart->name = $cart->recipe->name;
                $newCart->picture_url = asset($cart->recipe->picture_url);
                $newCart->costo = $cart->costo;
                $ingredientes = [];
                foreach ($cart->ingredientsCart as $ingredientCart){
                    $newIngredient = new \stdClass;
                    $newIngredient->name = $ingredientCart->ingredient->name;
                    $newIngredient->price = $ingredientCart->ingredient->price;
                    $newIngredient->min_quantity = $ingredientCart->ingredient->min_quantity;
                    $newIngredient->recipe_quantity = $ingredientCart->recipe->ingredientes->find($ingredientCart->ingredient_id)->pivot->quantity;
                    $newIngredient->new_sobrante = $ingredientCart->new_spare;
                    $newIngredient->real_compra = $ingredientCart->real_sales_quantity;
                    $newIngredient->sobrante = $ingredientCart->spare;
                    $newIngredient->um = $ingredientCart->ingredient->um->name;
                    $newIngredient->sale = $ingredientCart->sale;
                    $newIngredient->costo = $ingredientCart->costo;
                    $ingredientes[] = $newIngredient;
                }
                $newCart->ingredients = $ingredientes;
                $cart_list[] = $newCart;
            }
            return response()->json(['error'=>false,'carts'=>$cart_list]);
        }else{
            return response()->json(['error'=>true,'carts'=>[],'msg'=>'No hay usuario autenticado.']);
        }
    }
}
