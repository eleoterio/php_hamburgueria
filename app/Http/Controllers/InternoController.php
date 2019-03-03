<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use App\Item_pedido;
use App\Pedido;
class InternoController extends Controller
{
    public function cozinha(Request $request, $id){
        $item_pedido = DB::table("item_pedido")
        ->where("pedido_id", "=", $id)
        ->get();

        
        foreach ($item_pedido as $item) {
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 2;
            $item_alt->save();           
        }

        return "OK";
        return redirect('/atendimento');
    }
    public function pronto(Request $request, $id){
        $item_pedido = DB::table("item_pedido")
        ->where("pedido_id", "=", $id)
        ->get();

        
        foreach ($item_pedido as $item) {
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 3;
            $item_alt->save();           
        }

        return "OK";
        return redirect('/cozinha');
    }
    public function entregar(Request $request, $id){
        $item_pedido = DB::table("item_pedido")
        ->where("pedido_id", "=", $id)
        ->get();

        
        foreach ($item_pedido as $item) {
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 4;
            $item_alt->save();           
        }

        return "OK";
        return redirect('/atendimento');
    }
    public function entregue(Request $request, $id){
        $item_pedido = DB::table("item_pedido")
        ->where("pedido_id", "=", $id)
        ->get();

        
        foreach ($item_pedido as $item) {
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 5;
            $item_alt->save();           
        }

        return "OK";
        return redirect('/atendimento');
    }
    public function pedido(Request $request, $id){
        $pedido = DB::table("pedido")
        ->where("pedido.id", "=", $id)
        ->first();

        $item_pedido = DB::table("item_pedido")
        ->leftjoin("produto", "produto.id", "=", "item_pedido.produto_id")
        ->where("pedido_id", "=", $id)
        ->get(["item_pedido.*", "produto.nome", "produto.descricao", "produto.valor"]);
        
        $itens = DB::table("produto")
        ->get();
        return view('interno.pedido', [
            'pedido' => $pedido ,
            'itens' => $itens,
            'item_pedido' => $item_pedido  
        ]);
    }
}
