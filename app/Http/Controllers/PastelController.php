<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pastel;

class PastelController extends Controller
{

    //Retorna todos los datos o elementos en la tabla "pasteles"
    public function index(Request $request)
    {


        $pastel = Pastel::all();

        if ($pastel != "") {
            return response()->json([
                "status" => "ok",
                "data" => $pastel
            ]);
        } else {
            return response()->json([
                "status" => "ok",
                "data" => "No hay ningun dato que mostrar"
            ]);
        }
    }



    //Agrega un nuevo producto a la tabla "pasteles"
    public function store(Request $request)
    {
        //Obtener datos
        $data = $request->all();

        //Validar la data
        $this->validate($request, [
            'sabor' => 'required|max:200'
        ]);

        //Insertar el pastel
        Pastel::create($data);

        //Retornar mensaje/objeto Json
        return response()->json([
            "status" => "ok",
            "res" => "Producto agregado correctamente"
        ]);
    }

    //Modifica o actualiza campos
    public function update($id, Request $request)
    {
        //Obtener datos
        $data = $request->all();

        //Validar la data
        $this->validate($request, [
            'sabor' => 'required|max:200'
        ]);

        Pastel::find($id)->update($data);

        return response()->json([
            "status" => "ok",
            "res" => "Producto modificado correctamente"
        ]);
    }

    //Elimina de acuerdo al id ingresado
    public function delete($id)
    {

        $delete = Pastel::destroy($id);
        if ($delete) {

            return response()->json([
                "status" => "ok",
                "res" => "Producto eliminado correctamente"
            ]);
        } else {

            return response()->json([
                "status" => "bad",
                "res" => "Ha ocurrido un error inexperado"
            ]);
        }
    }

    //Realiza una busqueda dependiendo el sabor que sea ingresado
    public function search(Request $request)
    {
        //Obtener la data
        $data = $request->all();

        //Convertir  a json el array $data
        $encodeData = json_encode($data);

        //Reducir el json para obtener unicamente el sabor a consultar
        $getWord = substr($encodeData, 9, -1);

        //Convertir a string para poder realizar la consulta sql
        $search = json_decode($getWord);

        //Realizar consulta a la base de datps
        $product = Pastel::where('sabor', 'like', '%' . $search . '%')->get();

        //Variable que cuenta los elementos que vienen en la consulta
        $count = count($product);
        
        
        //Evaluar si hay elementos y retornar mensajes correspondientes
        if ($count > 0) {
             return response()->json([
                 "status" => "ok",
                 "data" => $product,
                 "res" => "Estos productos coinciden con este sabor"
             ]);
         } else {
             return response()->json([
                 "status" => "ok",
                 "res" => "No se encontraron productos de ese sabor"
             ]);
         }
    }


    public function new(){
        
    }
}
