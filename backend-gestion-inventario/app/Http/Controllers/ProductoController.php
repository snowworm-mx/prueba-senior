<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\HistorialMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productos = Producto::whereAny(['nombre','descripcion'],'LIKE',"%".$request->search."%")
                            ->paginate(5);
        //dd($producto);
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre'=>'required|string|max:200',
            'descripcion'=>'string|max:300',
            'precio'=>'numeric',
            'cantidad'=>'numeric|min:0',
        ];

        $messages = [
            'nombre.required'=>'El campo nombre es requerido',
            'nombre.max'=>'El campo nombre debe tener maximo 200 caracteres',
            'descripcion.max'=>'El campo descripcion debe tener maximo 300 caracteres',
            'precio.numeric'=>'El campo precio debe ser numerico',
            'cantidad.numeric'=>'El campo cantidad debe ser numerico',
            'cantidad.min'=>'El valor minimo de la cantidad deb ser 0',
        ];

        $validator = \Validator::make($request->input(),$rules,$messages);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()->all()
            ],400);
        }

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        if(!$producto->save()){
            return response()->json([
                'status'=>false,
                'message'=>'No se pudo registar el producto'
            ],400);
        }
        return response()->json([
            'status'=>true,
            'message'=>'El producto se registro con exito!'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $rules = [
            'nombre'=>'required|string|max:200',
            'descripcion'=>'string|max:300',
            'precio'=>'numeric',
            'cantidad'=>'numeric|min:0',
        ];

        $messages = [
            'nombre.required'=>'El campo nombre es requerido',
            'nombre.max'=>'El campo nombre debe tener maximo 200 caracteres',
            'descripcion.max'=>'El campo descripcion debe tener maximo 300 caracteres',
            'precio.numeric'=>'El campo precio debe ser numerico',
            'cantidad.numeric'=>'El campo cantidad debe ser numerico',
            'cantidad.min'=>'El valor minimo de la cantidad deb ser 0',
        ];

        $validator = \Validator::make($request->input(),$rules,$messages);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()->all()
            ],400);
        }

        if($producto->cantidad != $request->cantidad)
        {
            $hm = new HistorialMovimiento();
            $hm->usuario = $request->user()->name;
            $hm->producto = $request->nombre;
            $hm->cantidad = $request->cantidad;
            $hm->fecha =date('Y-m-d H:i:s');
            $hm->save();
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;

        if($producto->cantidad <= 3)
        {
            //Enviamos alerta
            Mail::to('jose@correo.com')
            ->send(new \App\Mail\AlertaInventarioMailable($producto));
        }

        if(!$producto->save()){
            return response()->json([
                'status'=>false,
                'message'=>'No se pudo actualizar el producto'
            ],400);
        }
        return response()->json([
            'status'=>true,
            'message'=>'El producto se actualizo con exito!'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json([
            'status'=>true,
            'message'=>'El producto se elimino con exito!'
        ],200);
    }
}
