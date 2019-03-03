<?php

namespace App\Http\Controllers;

use App\Tipo_usuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    public function index()
    {
        $list = Tipo_usuario::orderBy('descricao', 'desc')->paginate(10);
        return view('tipo_usuario.index',['list' => $list]);
    }
  
    public function create()
    {
        return view('tipo_usuario.create');
    }
  
    public function store(Tipo_usuarioRequest $request)
    {
        $tipo = new Tipo_usuario;
        $tipo->descricao = $request->descricao;
        $tipo->save();
        return redirect()->route('tipo_usuario.index')->with('message', 'Tipo de usuario criado com Sucesso!');
    }
  
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $tipo = Tipo_usuario::findOrFail($id);
        return view('tipo_usuario.edit',compact('tipo'));
    }
  
    public function update(Tipo_usuarioRequest $request, $id)
    {
        $tipo = Tipo_usuario::findOrFail($id);
        $tipo->descricao = $request->descricao;
        $tipo->save();
        return redirect()->route('tipo_usuario.index')->with('message', 'Tipo de usuario atualizado com Sucesso!');
    }
  
    public function destroy($id)
    {
        $tipo = Tipo_usuario::findOrFail($id);
        $tipo->delete();
        return redirect()->route('tipo_usuario.index')->with('alert-success','Tipo de usuario apagado com sucesso!');
    }
}
