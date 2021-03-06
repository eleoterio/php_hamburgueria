<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Status_item;

use DB;

class Status_itemsController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('status_items.index', []);
  }

  public function create(Request $request)
  {
    return view('status_items.add', [
      []
    ]);
  }

  public function edit(Request $request, $id)
  {
    $status_item = Status_item::findOrFail($id);
    return view('status_items.add', [
      'model' => $status_item    ]);
  }

  public function show(Request $request, $id)
  {
    $status_item = Status_item::findOrFail($id);
    return view('status_items.show', [
      'model' => $status_item    ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT *,1,2 ";
    $presql = " FROM status_item a ";
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
  $status_item = null;
  if($request->id > 0) { $status_item = Status_item::findOrFail($request->id); }
  else {
    $status_item = new Status_item;
  }


  
    $status_item->id = $request->id?:0;
    
  
      $status_item->descricao = $request->descricao;
  
    //$status_item->user_id = $request->user()->id;
  $status_item->save();

  return redirect('/status_items');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $status_item = Status_item::findOrFail($id);

  $status_item->delete();
  return "OK";

}


}
