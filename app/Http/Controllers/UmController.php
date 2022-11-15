<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Um;

class UmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measurements = Um::paginate(10);
        return	view('unit_measurement')->with(['measurements'=>$measurements,'criterio'=>""]);
    }

     /**
     * Store the Unit of measurement data.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'measurementName' => 'required',
            'measurementDescription' => 'required'
        ]);

        if($request->input('measurementName')){$name = $request->input('measurementName');}
        if($request->input('measurementDescription')){$description = $request->input('measurementDescription');}

        if($name && $description){
            $measurement = new Um();
            $measurement ->name = $name;
            $measurement ->description = $description;
            $measurement->save();
            return redirect()->route('measurementList')->with(array('tipo_msg'=>'ok','msg'=>'La Unidad de Medida se salvo satisfactoriamente.'));
        }else{
            return redirect()->route('measurementList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }

    /**
     * Search Unit of measurement.
     *
     */
    public function search(Request $request)
    {

        if($request->get('searchMeasurement')){
            $search =  $request->get('searchMeasurement');

            $measurements	= Um::where('name','LIKE','%'.$search.'%')->paginate(10);

            return	view('unit_measurement')->with(['measurements'=>$measurements,'criterio'=>$search]);
        }else{
            return redirect()->route('measurementList');
        }

    }


    /**
     * Delete Unit of measurement.
     *
     */
    public function destroy($id)
    {
        if($id){
            $measurement = Um::find($id);

            $measurement->delete();
            return redirect()->route('measurementList')->with(array('tipo_msg'=>'ok','msg'=>'La Unidad de Medida se eliminó satisfactoriamente.'));
        }
        else{
            return redirect()->route('measurementList')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'));
        }
    }
}
