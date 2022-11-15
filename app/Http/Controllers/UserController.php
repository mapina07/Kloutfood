<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Cart;
use App\Models\IngredientCart;
use App\Models\Spare;

class UserController extends Controller
{
    /**
     * Return a view login.
     *
     */
    public function login()
    {

        return	view('login');
    }


    /**
     * Return a view register new user.
     *
     */
    public function register()
    {

        return	view('register');
    }

    /**
     * Store the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'userName' => 'required',
            'userLastname' => 'required',
            'userRol' => 'required',
            'userEmail' => 'required',
            'userPass' => 'required',
        ]);

        if($request->input('userName')){$name = $request->input('userName');}
        if($request->input('userLastname')){$lastname = $request->input('userLastname');}
        if($request->input('userRol')){$rol = $request->input('userRol');}
        if($request->input('userEmail')){$email = $request->input('userEmail');}
        if($request->input('userPass')){$password = $request->input('userPass');}

        if($name && $lastname && $rol && $email && $password){
            $user = new User();
            $user->name = $name;
            $user->lastname = $lastname;
            $user->rol = $rol;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();
            return redirect()->route('userLogin')->with(array('tipo_msg'=>'ok','msg'=>'El Usuario se salvo satisfactoriamente, inicie sessión.'));
        }else{
            return redirect()->route('userRegister')->with(array('tipo_msg'=>'error','msg'=>'Error, los datos no se enviaron correctamente.'))->withInput();
        }
    }

    /**
     * authenticate the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        //$this->limpiarCarrito();

        $validatedData = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        if($request->input('user')){$user = $request->input('user');}
        if($request->input('password')){$password = $request->input('password');}

        $user = User::where('email',$request->user)->first();

        if($user){
            if(Hash::check($password, $user->password)){
                $request->session()->put('LoginUser',$user);
                $request->session()->put('cant_pedidos',0);
                return redirect()->route('store');
            }else{
                return redirect()->route('userLogin')->with(array('tipo_msg'=>'error','msg'=>'Error, contraseña incorrecta.'))->withInput();
            }
        }else{
            return redirect()->route('userLogin')->with(array('tipo_msg'=>'error','msg'=>'Error, usuario incorrecto.'))->withInput();
        }
    }

    private function limpiarCarrito()
    {
    //    $sobrantes = Spare::all();
    //    $carts = Cart::all();
    //    $ingCarts =  IngredientCart::all();

       $clases = ['App\Models\Spare','App\Models\IngredientCart','App\Models\Cart'];

       foreach($clases as $clase){
            $ids = [];
            $collection = $clase::all();
            foreach ($collection as $item){
                $ids[] = $item->id;
            }
            $clase::destroy($ids);
       }

    //    $ids = [];
    //    foreach ($sobrantes as $sobrante){
    //         $ids[] = $sobrante->id;
    //    }
    //    Spare::destroy($ids);

    //    foreach ($sobrantes as $sobrante){
    //     $ids[] = $sobrante->id;
    //    }
    //    Spare::destroy($ids);
    }


    /**
     * authenticate the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if(session()->has('LoginUser')){
            session()->pull('LoginUser');
            session()->pull('cant_pedidos');
            $this->limpiarCarrito();
            return redirect()->route('userLogin');
        }

    }
}
