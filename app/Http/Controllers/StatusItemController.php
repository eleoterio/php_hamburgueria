<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status_item;

class StatusItemController extends Controller
{
    public function index()
    {
        $list = Status_item::orderBy('descricao', 'desc')->paginate(10);
        return view('status_item.index',['list' => $list]);
    }
  
    public function create()
    {
        return view('status_item.create');
    }
  
    public function store(Status_itemRequest $request)
    {
        $status = new Status_item;
        $status->descricao = $request->descricao;
        $status->save();
        return redirect()->route('status_item.index')->with('message', 'Status criado com Sucesso!');
    }
  
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $status = Status_item::findOrFail($id);
        return view('status_item.edit',compact('status'));
    }
  
    public function update(Status_itemRequest $request, $id)
    {
        $status = Status_item::findOrFail($id);
        $status->descricao = $request->descricao;
        $status->save();
        return redirect()->route('status_item.index')->with('message', 'Status atualizado com Sucesso!');
    }
  
    public function destroy($id)
    {
        $status = Status_item::findOrFail($id);
        $status->delete();
        return redirect()->route('status_item.index')->with('alert-success','Status apagado com sucesso!');
    }
}
