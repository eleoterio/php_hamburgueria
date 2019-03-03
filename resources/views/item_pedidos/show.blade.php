@extends('layouts.app')

@section('content')



<h2 class="page-header">Item Pedido</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Visualizar  </div>

    <div class="panel-body">
                

        <form action="{{ url('/item_pedidos') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="<?=$model['id'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="pedido_id" class="col-sm-3 control-label">Pedido Id</label>
            <div class="col-sm-6">
                <input type="text" name="pedido_id" id="pedido_id" class="form-control" value="<?=$model['pedido_id'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="produto_id" class="col-sm-3 control-label">Produto Id</label>
            <div class="col-sm-6">
                <input type="text" name="produto_id" id="produto_id" class="form-control" value="<?=$model['produto_id'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="quantidade" class="col-sm-3 control-label">Quantidade</label>
            <div class="col-sm-6">
                <input type="text" name="quantidade" id="quantidade" class="form-control" value="<?=$model['quantidade'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="statusitem_id" class="col-sm-3 control-label">Statusitem Id</label>
            <div class="col-sm-6">
                <input type="text" name="statusitem_id" id="statusitem_id" class="form-control" value="<?=$model['statusitem_id']?>" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/item_pedidos') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection