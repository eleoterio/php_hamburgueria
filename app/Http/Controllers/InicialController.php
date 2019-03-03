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
        /**Pizza por categoria */
        $pedidos = DB::select('SELECT 
            SUM(produto.valor*item_pedido.quantidade) AS total, 
            categoria_produto.descricao 
        FROM pedido LEFT JOIN item_pedido ON item_pedido.pedido_id = pedido.id 
            LEFT JOIN produto ON produto_id = produto.id 
            LEFT JOIN categoria_produto ON categoriaproduto_id = categoria_produto.id 
        WHERE pedido.data_criado between now() - interval 1 month AND now()
        group by categoriaproduto_id;');

        $return[] = ['Task', 'Hours per Day'];

        foreach ($pedidos as $pedido) {
            $return[] = [
                $pedido->descricao,
                $pedido->total
            ];
        }
        /**Grafico Venda por semana */
        $semanas = DB::select("SELECT 
            DISTINCT YEARWEEK(data_criado) AS 'data',
            SUM(produto.valor*item_pedido.quantidade) AS total
        FROM pedido LEFT JOIN item_pedido ON item_pedido.pedido_id = pedido.id 
            LEFT JOIN produto ON produto_id = produto.id 
            LEFT JOIN categoria_produto ON categoriaproduto_id = categoria_produto.id 
        WHERE pedido.data_criado between now() - interval 2 month AND now()
        group by YEARWEEK(data_criado);"); 
        
        $returnSemana = [];
        foreach ($semanas as $semana) {
            $returnSemana[] = [
                $semana->data,
                $semana->total
            ];
        }

        return view('admin', [
            'pedidos' => json_encode($return),
            'semanas' => json_encode($returnSemana)
        ]);
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
