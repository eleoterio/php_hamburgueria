<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuario;
use App\Tipo_usuario;

use DB;

class UsuariosController extends Controller
{
  //
  public function __construct()
  {
    //$this->middleware('auth');
  }


  public function index(Request $request)
  {
    return view('usuarios.index', []);
  }

  public function create(Request $request)
  {
    $tipo_usuario = Tipo_usuario::get();
    
    return view('usuarios.add', [
      'tipo_usuario' => $tipo_usuario
    ]);
  }

  public function new_user(Request $request)
  {
    return view('usuarios.new-user', [
      []
    ]);
  }
  public function post_user(Request $request)
  {
    $usuario = new Usuario;
    
    $usuario->email = $request->email;  
    $usuario->senha = $request->senha; 
    $usuario->nome = $request->nome;  
    $usuario->cpf = $request->cpf;
    $usuario->endereco = $request->endereco;
    $usuario->tipousuario_id = $request->tipousuario_id;
  
    $usuario->save();
    
    return redirect('/');
  }

  public function login(Request $request)
  {
    $login = DB::table("usuario")
    ->where('email', '=',$request->email)
    ->where('senha', $request->senha)
    ->first();
    if ($login) {
      $request->session()->push('id', $login->id);
      $request->session()->push('tipo', $login->tipousuario_id);
      if ($login->tipousuario_id == 1) {
        return redirect('/cliente');
      }
      if ($login->tipousuario_id == 2) {
        return redirect('/admin');
      }
      if ($login->tipousuario_id == 3) {
        return redirect('/atendimento');
      }
      if ($login->tipousuario_id == 4) {
        return redirect('/cozinha');
      }
    }
    
    return redirect('/');
  }

  public function edit(Request $request, $id)
  {
    $tipo_usuario = Tipo_usuario::get();
    $usuario = Usuario::findOrFail($id);
    return view('usuarios.add', [
      'model' => $usuario,
      'tipo_usuario' => $tipo_usuario    
    ]);
  }

  public function show(Request $request, $id)
  {
    $usuario = Usuario::findOrFail($id);
    return view('usuarios.show', [
      'model' => $usuario    ]);
  }

  public function grid(Request $request)
  {
    $len = $_GET['length'];
    $start = $_GET['start'];

    $select = "SELECT a.id,
                      a.email,
                      a.senha,
                      a.nome,
                      a.cpf,
                      a.data_criado,
                      a.endereco,
                      tipo_usuario.descricao,1,2 ";
    $presql = " FROM usuario a LEFT JOIN tipo_usuario ON tipo_usuario.id = tipousuario_id";
    if($_GET['search']['value']) {
      $presql .= " WHERE email LIKE '%".$_GET['search']['value']."%' ";
    }

    $presql .= "  ";

    //------------------------------------
    // 1/2/18 - Jasmine Robinson Added Orderby Section for the Grid Results
    //------------------------------------
    $orderby = "";
    $columns = array('id','email','senha','nome','cpf','data_criado','endereco','descricao',);
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
  $usuario = null;
  if($request->id > 0) { 
    $usuario = Usuario::findOrFail($request->id); 
  } else {
    $usuario = new Usuario;
  }


  
    $usuario->id = $request->id?:0;
    
  
      $usuario->email = $request->email;
  
  
      $usuario->senha = $request->senha;
  
  
      $usuario->nome = $request->nome;
  
  
      $usuario->cpf = $request->cpf;
  
  
      $usuario->data_criado = $request->data_criado;
  
  
      $usuario->endereco = $request->endereco;
  
  
      $usuario->tipousuario_id = $request->tipousuario_id;
  
    //$usuario->user_id = $request->user()->id;
  $usuario->save();

  return redirect('/usuarios');

}

public function store(Request $request)
{
  return $this->update($request);
}

public function destroy(Request $request, $id) {

  $usuario = Usuario::findOrFail($id);

  $usuario->delete();
  return "OK";

}


}
