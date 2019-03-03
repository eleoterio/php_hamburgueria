<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item_pedido;

use DB;

class Item_pedidosController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('item_pedidos.index', []);
  }

  public function create(Request $request)
  {
    return view('item_pedidos.add', [
      []
    ]);
  }

  public function edit(Request $request, $id)
  {
    $item_pedido = Item_pedido::findOrFail($id);
    return view('item_pedidos.add', [
      'model' => $item_pedido    ]);
  }

  public function show(Request $request, $id)
  {
    $item_pedido = Item_pedido::findOrFail($id);
    return view('item_pedidos.show', [
      'model' => $item_pedido    ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT *,1,2 ";
    $presql = " FROM item_pedido a ";
    if($_GET['search']['value']) {
      $presql .= " WHERE pedido_id LIKE '%".$_GET['search']['value']."%' ";
    }

    $presql .= "  ";

    //------------------------------------
    // 1/2/18 - Jasmine Robinson Added Orderby Section for the Grid Results
    //------------------------------------
    $orderby = "";
    $columns = array('id','pedido_id','produto_id','quantidade','statusitem_id',);
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $orderby = "Order By " . $order . " " . $dir;

    $sql = $select.$presql.$orderby." LIMIT ".$start.",".$len;
    //------------------------------------

    $qcount = DB::select("SELECT COUNT(a.id) c".$presql);
    //print_r($qcount);
    $count = $qcount[0]->c;

    $results = DB::select($sql);
    $ret = [];
    foreach ($results as $row) {
      $r = [];
      foreach ($row as $value) {
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
  $item_pedido = null;
  if($request->id > 0) { $item_pedido = Item_pedido::findOrFail($request->id); }
  else {
    $item_pedido = new Item_pedido;
  }


  
    $item_pedido->id = $request->id?:0;
    
  
      $item_pedido->pedido_id = $request->pedido_id;
  
  
      $item_pedido->produto_id = $request->produto_id;
  
  
      $item_pedido->quantidade = $request->quantidade;
  
  
      $item_pedido->statusitem_id = $request->statusitem_id;
  
    //$item_pedido->user_id = $request->user()->id;
  $item_pedido->save();

  return redirect('/item_pedidos');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $item_pedido = Item_pedido::findOrFail($id);

  $item_pedido->delete();
  return "OK";

}


}
