<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Produto;
use App\Categoria_produto;

use DB;

class ProdutosController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('produtos.index', []);
  }

  public function create(Request $request)
  {
    $categorias = Categoria_produto::get();
    
    return view('produtos.add', [
      'categorias' => $categorias
    ]);
  }

  public function edit(Request $request, $id)
  {
    $categorias = Categoria_produto::get();
    $produto = Produto::findOrFail($id);

    return view('produtos.add', [
      'model' => $produto ,
      'categorias' => $categorias
      ]);
  }

  public function show(Request $request, $id)
  {
    $produto = DB::table('produto')
    ->leftjoin('categoria_produto', 'categoriaproduto_id', '=', 'categoria_produto.id')
    ->where("produto.id", "=", $id)
    ->first(["produto.*", "categoria_produto.descricao AS categoriaproduto_descricao"]);
    return view('produtos.show', [
      'model' => $produto   
      ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT a.id,
                    a.nome,
                    a.descricao,
                    a.valor,
                    categoria_produto.descricao AS descricao_categoria,1,2 ";
    $presql = " FROM produto a INNER JOIN categoria_produto ON categoriaproduto_id = categoria_produto.id  ";
    if($_GET['search']['value']) {
      $presql .= " WHERE nome LIKE '%".$_GET['search']['value']."%' ";
    }

    $presql .= "  ";

    //------------------------------------
    // 1/2/18 - Jasmine Robinson Added Orderby Section for the Grid Results
    //------------------------------------
    $orderby = "";
    $columns = array('id','nome','descricao','valor','descricao_categoria');
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
  $produto = null;
  if($request->id > 0) { $produto = Produto::findOrFail($request->id); }
  else {
    $produto = new Produto;
  }


  
    $produto->id = $request->id?:0;
    
  
      $produto->nome = $request->nome;
  
  
      $produto->descricao = $request->descricao;
  
  
      $produto->valor = $request->valor;
  
  
      $produto->categoriaproduto_id = $request->categoriaproduto_id;
  
    //$produto->user_id = $request->user()->id;
  $produto->save();

  return redirect('/produtos');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $produto = Produto::findOrFail($id);

  $produto->delete();
  return "OK";

}


}
