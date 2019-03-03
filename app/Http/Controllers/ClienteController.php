<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedido;
use App\Item_pedido;
use App\Tipo_usuario;
use App\Usuario;
use App\Avaliacao;
use DB;

class ClienteController extends Controller
{
    public function pedido(Request $request){        
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;
        $pedido = new Pedido;
        $pedido->usuario_id = $usuario_id;
        $pedido->save();
        $itens = DB::table("produto")
        ->get();
        return view('cliente.pedido', [
            'pedido' => $pedido ,
            'itens' => $itens  
        ]);
    }

    public function editpedido(Request $request, $id){
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;
        $pedido = DB::table("pedido")
        ->where("pedido.id", "=", $id)
        ->first();

        $item_pedido = DB::table("item_pedido")
        ->leftjoin("produto", "produto.id", "=", "item_pedido.produto_id")
        ->where("pedido_id", "=", $id)
        ->get(["item_pedido.*", "produto.nome", "produto.descricao", "produto.valor"]);
        
        $itens = DB::table("produto")
        ->get();
        return view('cliente.pedido', [
            'pedido' => $pedido ,
            'itens' => $itens,
            'item_pedido' => $item_pedido  
        ]);
    }

    public function newitempedido(Request $request){
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;
        $new_item_pedido = new Item_pedido;
        $new_item_pedido->pedido_id = $request->pedido_id;
        $new_item_pedido->produto_id = $request->produto;
        $new_item_pedido->quantidade = $request->quantidade;
        $new_item_pedido->statusitem_id = 1;
        $new_item_pedido->save();

        $item_pedido = DB::table("item_pedido")
        ->leftjoin("produto", "produto.id", "=", "item_pedido.produto_id")
        ->where("pedido_id", "=", $request->pedido_id)
        ->get(["item_pedido.*", "produto.nome", "produto.descricao", "produto.valor"]);

        $total = 0;
        foreach ($item_pedido as $item) {
            $total += ($item->quantidade * $item->valor);
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 1;
            $item_alt->save();
        }
        $alterPedido = Pedido::findOrFail($request->pedido_id);
        $alterPedido->valor = $total;
        $alterPedido->save();
        $url = "/cliente/pedido/" . $request->pedido_id;

        return redirect($url);
    }

    public function delitempedido(Request $request, $id){
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;
        $item_del = Item_pedido::findOrFail($id);
        $item_del->delete();

        $item_pedido = DB::table("item_pedido")
        ->leftjoin("produto", "produto.id", "=", "item_pedido.produto_id")
        ->where("pedido_id", "=", $item_del->pedido_id)
        ->get(["item_pedido.*", "produto.nome", "produto.descricao", "produto.valor"]);

        $total = 0;
        foreach ($item_pedido as $item) {
            $total += ($item->quantidade * $item->valor);
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 1;
            $item_alt->save();
        }
        $alterPedido = Pedido::findOrFail($item_del->pedido_id);
        $alterPedido->valor = $total;
        $alterPedido->save();

        return "OK";
    }

    public function confirmpedido(Request $request, $id){
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;
        $item_pedido = DB::table("item_pedido")
        ->where("pedido_id", "=", $id)
        ->get();

        
        foreach ($item_pedido as $item) {
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 6;
            $item_alt->save();           
        }

        return "OK";
    }

    public function perfil(Request $request, $id) {
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;

        $usuario = Usuario::findOrFail($id);
        return view('cliente.perfil', [
            'model' => $usuario
        ]);
    }

    public function editperfil(Request $request) {
        $usuario_id = $request->session()->get('id')[0];
        session_start();
        $_SESSION["id"]=$usuario_id;
        $usuario = Usuario::findOrFail($request->id); 

        $usuario->email = $request->email;
        $usuario->senha = $request->senha;
        $usuario->nome = $request->nome;
        $usuario->cpf = $request->cpf;
        $usuario->endereco = $request->endereco;
        
        $usuario->save();

        return view('cliente.perfil', [
            'model' => $usuario
        ]);
    }
    public function avaliacao(Request $request){
        $avaliacao = new Avaliacao();
        $avaliacao->pedido_id = $request->pedido_id;
        $avaliacao->nota = $request->nota;
        $avaliacao->save();

        $item_pedido = DB::table("item_pedido")
        ->where("pedido_id", "=", $request->pedido_id)
        ->get();

        
        foreach ($item_pedido as $item) {
            $item_alt = Item_pedido::findOrFail($item->id);
            $item_alt->statusitem_id = 7;
            $item_alt->save();           
        }
        $url = "/cliente/pedido/" . $request->pedido_id;
        return redirect($url);
    }
}
