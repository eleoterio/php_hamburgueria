<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tipo_usuario;

use DB;

class Tipo_usuariosController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('tipo_usuarios.index', []);
  }

  public function create(Request $request)
  {
    return view('tipo_usuarios.add', [
      []
    ]);
  }

  public function edit(Request $request, $id)
  {
    $tipo_usuario = Tipo_usuario::findOrFail($id);
    return view('tipo_usuarios.add', [
      'model' => $tipo_usuario    ]);
  }

  public function show(Request $request, $id)
  {
    $tipo_usuario = Tipo_usuario::findOrFail($id);
    return view('tipo_usuarios.show', [
      'model' => $tipo_usuario    ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT *,1,2 ";
    $presql = " FROM tipo_usuario a ";
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
  $tipo_usuario = null;
  if($request->id > 0) { $tipo_usuario = Tipo_usuario::findOrFail($request->id); }
  else {
    $tipo_usuario = new Tipo_usuario;
  }


  
    $tipo_usuario->id = $request->id?:0;
    
  
      $tipo_usuario->descricao = $request->descricao;
  
    //$tipo_usuario->user_id = $request->user()->id;
  $tipo_usuario->save();

  return redirect('/tipo_usuarios');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $tipo_usuario = Tipo_usuario::findOrFail($id);

  $tipo_usuario->delete();
  return "OK";

}


}
