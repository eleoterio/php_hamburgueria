<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pedido;
use App\Item_pedido;

use DB;

class PedidosController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('pedidos.index', []);
  }

  public function create(Request $request)
  {
    return view('pedidos.add', [
      []
    ]);
  }

  public function edit(Request $request, $id)
  {
    $pedido = DB::table("pedido")
    ->leftjoin('usuario', 'usuario_id', '=', 'usuario.id')
      ->where("pedido.id", "=", $id)
      ->first(["pedido.*", "usuario.nome"]);

      $item_pedido = DB::table("item_pedido")
      ->leftjoin("produto", "produto.id", "=", "item_pedido.produto_id")
      ->where("pedido_id", "=", $id)
      ->get(["item_pedido.*", "produto.nome", "produto.descricao", "produto.valor"]);
      
      $itens = DB::table("produto")
      ->get();
      return view('pedidos.add', [
          'pedido' => $pedido ,
          'itens' => $itens,
          'item_pedido' => $item_pedido  
      ]);
  }

  public function show(Request $request, $id)
  {
    $pedido = Pedido::findOrFail($id);
    return view('pedidos.show', [
      'model' => $pedido    ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT DISTINCT a.id, a.valor, DATE_FORMAT(a.data_criado, '%d/%m/%Y'), usuario.nome,status_item.descricao, avaliacao.nota,1,2 ";
    $presql = " FROM pedido a LEFT JOIN usuario ON usuario_id = usuario.id ";
    $presql .= " LEFT JOIN avaliacao ON avaliacao.pedido_id = a.id ";
    $presql .= " LEFT JOIN item_pedido ON item_pedido.pedido_id = a.id ";
    $presql .= " LEFT JOIN status_item ON status_item.id = item_pedido.statusitem_id ";
    if($_GET['search']['value']) {
      $presql .= " WHERE valor LIKE '%".$_GET['search']['value']."%' ";
    }

    $presql .= "  ";

    //------------------------------------
    // 1/2/18 - Jasmine Robinson Added Orderby Section for the Grid Results
    //------------------------------------
    $orderby = "";
    $columns = array('id','valor','data_criado','nome','descricao', 'nota');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $orderby = "Order By " . $order . " desc";

    $sql = $select.$presql.$orderby." LIMIT ".$start.",".$len;
    //------------------------------------

    $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
    //print_r($qcount);
    $count = $qcount[0]->c;
    
    $results = DB::select($sql);
    
    $ret = [];
    foreach ($results as $row) {
      $r = [];

      foreach ($row as $key => $value) {
        if ($key == 'valor') {
          $r[] = "R$ " . number_format($value, 2, ',', '.');
          continue;
        }
        $r[] = $value;
      }
      $ret[] = $r;
    }

    $ret['data'] = $ret;
    $ret['recordsTotal'] = $count;
    $ret['iTotalDisplayRecords'] = $count;

    $ret['recordsFiltered'] = count($ret);
    $ret['draw'] = $_GET['draw'];

    echo json_encode($ret);

  }


  public function update(Request $request) {
    //
    /*$this->validate($request, [
    'name' => 'required|max:255',
  ]);*/
  $pedido = null;
  if($request->id > 0) { $pedido = Pedido::findOrFail($request->id); }
  else {
    $pedido = new Pedido;
  }


  
    $pedido->id = $request->id?:0;
    
  
      $pedido->valor = $request->valor;
  
  
      $pedido->data_criado = $request->data_criado;
  
  
      $pedido->usuario_id = $request->usuario_id;
  
    //$pedido->user_id = $request->user()->id;
  $pedido->save();

  return redirect('/pedidos');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $pedido = Pedido::findOrFail($id);

  $pedido->delete();
  return "OK";

}
public function newitempedido(Request $request){
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
  }
  $alterPedido = Pedido::findOrFail($request->pedido_id);
  $alterPedido->valor = $total;
  $alterPedido->save();
  $url = "/pedidos/" . $request->pedido_id . "/edit";

  return redirect($url);
}

public function delitempedido(Request $request, $id){
  $item_del = Item_pedido::findOrFail($id);
  $item_del->delete();

  $item_pedido = DB::table("item_pedido")
  ->leftjoin("produto", "produto.id", "=", "item_pedido.produto_id")
  ->where("pedido_id", "=", $item_del->pedido_id)
  ->get(["item_pedido.*", "produto.nome", "produto.descricao", "produto.valor"]);

  $total = 0;
  foreach ($item_pedido as $item) {
      $total += ($item->quantidade * $item->valor);
  }
  $alterPedido = Pedido::findOrFail($item_del->pedido_id);
  $alterPedido->valor = $total;
  $alterPedido->save();

  return "OK";
}


}
