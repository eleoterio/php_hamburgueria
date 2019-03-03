<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Categoria_produto;

use DB;

class Categoria_produtosController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('categoria_produtos.index', []);
  }

  public function create(Request $request)
  {
    return view('categoria_produtos.add', [
      []
    ]);
  }

  public function edit(Request $request, $id)
  {
    $categoria_produto = Categoria_produto::findOrFail($id);
    return view('categoria_produtos.add', [
      'model' => $categoria_produto    ]);
  }

  public function show(Request $request, $id)
  {
    $categoria_produto = Categoria_produto::findOrFail($id);
    return view('categoria_produtos.show', [
      'model' => $categoria_produto    ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT *,1,2 ";
    $presql = " FROM categoria_produto a ";
    if($_GET['search']['value']) {
      $presql .= " WHERE descricao LIKE '%".$_GET['search']['value']."%' ";
    }

    $presql .= "  ";

    //------------------------------------
    // 1/2/18 - Jasmine Robinson Added Orderby Section for the Grid Results
    //------------------------------------
    $orderby = "";
    $columns = array('id','descricao',);
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
  $categoria_produto = null;
  if($request->id > 0) { $categoria_produto = Categoria_produto::findOrFail($request->id); }
  else {
    $categoria_produto = new Categoria_produto;
  }


  
    $categoria_produto->id = $request->id?:0;
    
  
      $categoria_produto->descricao = $request->descricao;
  
    //$categoria_produto->user_id = $request->user()->id;
  $categoria_produto->save();

  return redirect('/categoria_produtos');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $categoria_produto = Categoria_produto::findOrFail($id);

  $categoria_produto->delete();
  return "OK";

}


}
