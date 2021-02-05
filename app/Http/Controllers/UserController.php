<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;



class UserController extends Controller
{

    public function store(Request $request)
    {
        //Obtener datos
        $data = $request->all();

        //Validar la data
        $this->validate($request, [
            'password' => 'required|min:6'
        ]);

        $data['password'] = Hash::make($request->password); 

        //Insertar el pastel
        User::create($data);
        //Retornar mensaje/objeto Json
        return response()->json([
            "status" => "ok",
            "res" => "Usuario agregado correctamente"
        ]);
    }


    public  function login(Request $request){

        $user = User::whereName($request->name)->first();
        
        //Ojo con el orden de comparacion de contraseñas
        if(!is_null($user) && Hash::check( $request->password, $user->password)){
            $user->api_token = Str::random(150);
            $user->save();

            //Retornar mensaje/objeto Json
            return response()->json([
            "status" => "ok",
            "token" => $user->api_token,
            "res" => "Bienvenido"
        ]);

        }else{
            return response()->json([
                "status" => "ok",
                "data" => "Los datos ingresados son incorrectos"
            ]);

        }
    }
}
