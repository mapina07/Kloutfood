<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::paginate(10);
        return	view('category')->with(['categorys'=>$categorys,'criterio'=>""]);
    }

     /**
     * Store the category data.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ]);

        if($request->input('categoryName')){$name = $request->input('categoryName');}
        if($request->input('categoryDescription')){$description = $request->input('categoryDescription');}

        if($name && $description){
            if($request->file('categoryPicture')){
                if(file_exists($request->file('categoryPicture'))){
                    $path = $request->file('categoryPicture')->store('categoryImg');
                }else{
                    return redirect()->route('categoryList')->with(array('tipo_msg'=>'error','msg'=>'Error al salvar la imagen de la categoría.'));
                }

            }else{
                $path = 'img/ingredientDefault.png';
            }
            $category = new Category();
            $category ->name = $name;
            $category ->description = $description;
            $category ->picture_url = $path;
            $category->save();
            return redirect()->route('categoryList')->with(array('tipo_msg'=>'ok','msg'=>'La Categoría se salvo satisfactoriamente.'));
        }else{
            return redirect()->route('categoryList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }

    /**
     * Search category.
     *
     */
    public function search(Request $request)
    {

        if($request->get('searchCategory')){
            $search =  $request->get('searchCategory');

            $categorys	=	Category::where('name','LIKE','%'.$search.'%')->paginate(10);

            return	view('category')->with(['categorys'=>$categorys,'criterio'=>$search]);
        }else{
            return redirect()->route('categoryList');
        }

    }


    /**
     * Delete category.
     *
     */
    public function destroy($id)
    {
        if($id){
            $category = Category::find($id);

            $category->delete();
            return redirect()->route('categoryList')->with(array('tipo_msg'=>'ok','msg'=>'La Categoria se eliminó satisfactoriamente.'));
        }
        else{
            return redirect()->route('categoryList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }
}
