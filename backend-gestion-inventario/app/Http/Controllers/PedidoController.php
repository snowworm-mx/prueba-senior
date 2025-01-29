<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::with(['user','detallePedidos.producto'])->paginate();
        return response()->json($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $p = new Pedido();
            $p->id_usuario = $request->user()->id;
            $p->descripcion = $request->descripcion;
            $p->estado = 'PENDIENTE';
            if(!$p->save())
            {
                throw new \Exception('No se pudo registar el pedido');
            }

            $detalle = $request->detallePedido;
            foreach($detalle as $dp)
            {
                
                //throw new \Exception(var_dump($dp));
                //exit();
                $d = new DetallePedido();
                $d->id_pedido =  $p->id;
                $d->id_producto = $dp['id'];
                $d->cantidad = $dp['cantidad'];
                if(!$d->save())
                {
                    throw new \Exception('No se pudo registar el detalle de producto');
                }
            }
            DB::commit();
            return response()->json('El pedido dse registro con exito!',200);
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return response()->json($ex->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        try{
            //echo throw new \Exception(var_dump($pedido->estado));
            //exit();
            $p = $pedido;
            if(trim(strtoupper($p->estado)) != 'PENDIENTE')
            {
                throw new \Exception('El pedido solo se puede modificar si su estado es PENDIENTE');
            }

            DB::beginTransaction();
            $p->id_usuario = $request->user()->id;
            $p->descripcion = $request->descripcion;
            if(!$p->save())
            {
                throw new \Exception('No se pudo registar el pedido');
            }

            DB::table('detalle_pedidos')->where('id_pedido','=',$p->id)->delete();

            $detalle = $request->detallePedido;
            foreach($detalle as $dp)
            {
                
                //throw new \Exception(var_dump($dp));
                //exit();
                $d = new DetallePedido();
                $d->id_pedido =  $p->id;
                $d->id_producto = $dp['id'];
                $d->cantidad = $dp['cantidad'];
                if(!$d->save())
                {
                    throw new \Exception('No se pudo registar el detalle de producto');
                }
            }
            DB::commit();
            return response()->json('El pedido dse registro con exito!',200);
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return response()->json($ex->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    public function changeStatus(Request $request,$id)
    {
        try{
            DB::beginTransaction();
            $pedido = Pedido::findOrFail($id);

            if($pedido->estado == 'TERMINADO')
            {
                throw new Exception("El pedido ya se encuentra terminado");
            }

            if($pedido->estado == 'CANCELADO')
            {
                throw new Exception("El pedido ya se encuentra cancelado");
            }

            $pedido->estado = $request->estado;

        

            if($request->estado == 'TERMINADO')
            {
                $detalle = $pedido->detallePedidos();
                foreach($detalle as $d)
                {
                    $p = DB::table('productos')->where('id','=',$d->id_producto)->first();
                    DB::table('productos')->where('id','=',$d->id_producto)
                            ->update(['cantidad'=>($p->cantidad+$d->cantidad)]);
                }
            }

            if(!$pedido->save())
            {
                throw new \Exception('No se pudo actualizar el estado');
            }

            DB::commit();

            Mail::to('jose@correo.com')
                ->send(new \App\Mail\CambioEstadoMailable($pedido));

            return response()->json('El estado se actualizo con exito',200);
        }
        catch(\Exception $ex)
        {
            DB::rollback();
            return response()->json($ex->getMessage(),500);
        }
    }
}
