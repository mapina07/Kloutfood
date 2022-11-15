<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Str;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\IngredientRecipes;


class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::paginate(4);
        $categorys = Category::all();
        $ingredients = Ingredient::all();
        return	view('recipe')->with(['recipes'=>$recipes,'categorys'=>$categorys,'ingredients'=>$ingredients,'criterio'=>""]);
    }


    /**
     * Store the Unit of measurement data.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'recipeName' => 'required',
            'recipeCategory' => 'required',
            'recipeInstruction' => 'required',
            'ingredientes' => 'required',
            'ingredientes.*' => 'required',
            'quantitys' => 'required',
            'quantitys.*' => 'required',
        ]);

        if($request->input('recipeName')){$name = $request->input('recipeName');}
        if($request->input('recipeCategory')){$category_id = $request->input('recipeCategory');}
        if($request->input('recipeInstruction')){$instructions = $request->input('recipeInstruction');}
        if($request->input('ingredientes')){$ingredients_id = $request->input('ingredientes');}
        if($request->input('quantitys')){$quantitys = $request->input('quantitys');}



        if($name && $category_id && $instructions && $ingredients_id && $quantitys){
            if($request->file('recipePicture')){
                if(file_exists($request->file('recipePicture'))){
                    $path = $request->file('recipePicture')->store('recipeImg');
                }else{
                    return redirect()->route('recipeList')->with(array('tipo_msg'=>'error','msg'=>'Error al salvar la imagen de la receta.'));
                }

            }else{
                $path = 'img/ingredientDefault.png';
            }

            if($path){
                $recipe = new Recipe();
                $recipe ->name = $name;
                $recipe ->category_id = $category_id;
                $recipe ->instructions = $instructions;
                $recipe ->picture_url = $path;
                $recipe->save();

                $ingredients = Ingredient::whereIn('id',$ingredients_id)->get()->toArray();

                $items = [];
                for($i=0;$i<sizeof($ingredients);$i++){
                    $item = [
                        'recipe_id' => $recipe->id,
                        'ingredient_id' => $ingredients[$i]['id'],
                        'quantity' => $quantitys[$i],
                    ];
                    array_push($items,$item);
                }
                IngredientRecipes::insert($items);

                return redirect()->route('recipeList')->with(array('tipo_msg'=>'ok','msg'=>'La Receta se salvó satisfactoriamente.'));

            }else{
                return redirect()->route('recipeList')->with(array('tipo_msg'=>'error','msg'=>'Error al salvar la imagen de la receta.'));
            }

        }else{
            return redirect()->route('recipeList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
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

        if($request->get('searchRecipe')){
            $search =  $request->get('searchRecipe');

            $recipes  = Recipe::where('name','LIKE','%'.$search.'%')->paginate(4);
            $categorys = Category::all();
            $ingredients = Ingredient::all();
            return	view('recipe')->with([
                'recipes'=>$recipes,
                'categorys'=>$categorys,
                'ingredients'=>$ingredients,
                'criterio'=>$search
            ]);
        }else{
            return redirect()->route('recipeList');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        if($id){
            $recipe = Recipe::find($id);

            $relations = IngredientRecipes::where('recipe_id',$recipe->id)->get();

            $relations->map(function ($relation) {
                $relation->delete();
            });

            $recipe->delete();
            return redirect()->route('recipeList')->with(array('tipo_msg'=>'ok','msg'=>'El Ingrediente se eliminó satisfactoriamente.'));
        }
        else{
            return redirect()->route('recipeList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }

}
