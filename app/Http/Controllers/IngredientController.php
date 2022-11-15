<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Um;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $ingredients = Ingredient::all();
            return response()->json($ingredients);
        }

        $ingredients = Ingredient::paginate(4);
        $measurements = Um::all();
        //dd($ingredients);
        return	view('ingredient')->with([
            'ingredients'=>$ingredients,
            'criterio'=>"",
            'measurements' =>$measurements
        ]);
    }

     /**
     * Store the unit of measurement data.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'ingredientName' => 'required',
            'ingredientDescription' => 'required',
            'ingredientUm' => 'required',
            'ingredientMinQuantity' => 'required',
            'ingredientPrice' => 'required'
        ]);


        if($request->input('ingredientName')){$name = $request->input('ingredientName');}
        if($request->input('ingredientDescription')){$description = $request->input('ingredientDescription');}
        if($request->input('ingredientUm')){$um = $request->input('ingredientUm');}
        if($request->input('ingredientMinQuantity')){$cantidad_minima = $request->input('ingredientMinQuantity');}
        if($request->input('ingredientPrice')){$precio = $request->input('ingredientPrice');}

        if($name && $description && $um && $cantidad_minima && $precio){
            if($request->file('ingredientPicture')){
                if(file_exists($request->file('ingredientPicture'))){
                    $path = $request->file('ingredientPicture')->store('ingredientImg');
                }else{
                    return redirect()->route('ingredientList')->with(array('tipo_msg'=>'error','msg'=>'Error al salvar la imagen del ingrediente.'));
                }

            }else{
                $path = 'img/ingredientDefault.png';
            }

            if($path){
                $ingredient = new Ingredient();
                $ingredient ->name = $name;
                $ingredient ->description = $description;
                $ingredient ->um_id = $um;
                $ingredient ->min_quantity = $cantidad_minima;
                $ingredient ->price = $precio;
                $ingredient ->picture_url = $path;
                $ingredient->save();

                return redirect()->route('ingredientList')->with(array('tipo_msg'=>'ok','msg'=>'El Ingrediente se salvó satisfactoriamente.'));
            }else{
                return redirect()->route('ingredientList')->with(array('tipo_msg'=>'error','msg'=>'Error al salvar la imagen del ingrediente.'));
            }

        }else{
            return redirect()->route('ingredientList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
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

        if($request->get('searchIngredient')){
            $search =  $request->get('searchIngredient');

            $ingredients  = Ingredient::where('name','LIKE','%'.$search.'%')->paginate(4);
            $measurements = Um::all();

            return	view('ingredient')->with([
                'ingredients'=>$ingredients,
                'criterio'=>$search,
                'measurements' =>$measurements
            ]);
        }else{
            return redirect()->route('ingredientList');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
            $ingredient = Ingredient::find($id);

            $ingredient->delete();
            return redirect()->route('ingredientList')->with(array('tipo_msg'=>'ok','msg'=>'El Ingrediente se eliminó satisfactoriamente.'));
        }
        else{
            return redirect()->route('ingredientList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }
}
