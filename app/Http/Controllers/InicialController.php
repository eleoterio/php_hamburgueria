<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
class InicialController extends Controller
{
    public function cliente(Request $request){
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;

        $pedido = DB::table("pedido")
        ->leftjoin('item_pedido', 'pedido.id', '=', 'pedido_id')
        ->leftjoin('status_item', 'statusitem_id', '=', 'status_item.id')
        ->where('usuario_id', '=', $usuario_id)
        ->distinct("pedido.id")
        ->get(["pedido.*", "item_pedido.statusitem_id", "status_item.descricao"]);
        return view(
            'cliente.client_list', 
            [
                'list' => $pedido   
            ]);
    }
    public function admin(Request $request){
        return view(
            'admin', 
            []);
    }
    public function atendimento(Request $request){
        $pedido = DB::table("pedido")
        ->leftjoin('item_pedido', 'pedido.id', '=', 'pedido_id')
        ->leftjoin('status_item', 'statusitem_id', '=', 'status_item.id')
        ->whereIn('statusitem_id', ['6','3','4'])
        ->distinct("pedido.id")
        ->get(["pedido.*", "item_pedido.statusitem_id", "status_item.descricao"]);
        return view(
            'interno.atendimento', 
            [
                'list' => $pedido   
            ]);
    }

    public function cozinha(Request $request){
        $pedido = DB::table("pedido")
        ->leftjoin('item_pedido', 'pedido.id', '=', 'pedido_id')
        ->leftjoin('status_item', 'statusitem_id', '=', 'status_item.id')
        ->where('statusitem_id', '=', 2)
        ->distinct("pedido.id")
        ->get(["pedido.*", "item_pedido.statusitem_id", "status_item.descricao"]);
        return view(
            'interno.cozinha', 
            [
                'list' => $pedido   
            ]);
    }
}
