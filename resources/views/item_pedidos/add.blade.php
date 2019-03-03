@extends('layouts.app')

@section('content')


<h2 class="page-header">Item Pedido</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Adicionar/Editar   </div>

    <div class="panel-body">
                
        <form action="{{ url('/item_pedidos'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif


                                    <div class="form-group">
                <label for="id" class="col-sm-3 control-label">Id</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="<?= (isset($model['id'])) ? $model['id'] : '' ?>" readonly="readonly">
                </div>
            </div>
            <div class="form-group">
                <label for="pedido_id" class="col-sm-3 control-label">Pedido</label>
                <div class="col-sm-2">
                    <input type="number" name="pedido_id" id="pedido_id" class="form-control" value="<?= (isset($model['pedido_id'])) ? $model['pedido_id'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="produto_id" class="col-sm-3 control-label">Produto </label>
                <div class="col-sm-2">
                    <input type="number" name="produto_id" id="produto_id" class="form-control" value="<?= (isset($model['produto_id'])) ? $model['produto_id'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="quantidade" class="col-sm-3 control-label">Quantidade</label>
                <div class="col-sm-2">
                    <input type="number" name="quantidade" id="quantidade" class="form-control" value="<?=(isset($model['quantidade'])) ? $model['quantidade'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="statusitem_id" class="col-sm-3 control-label">Status </label>
                <div class="col-sm-2">
                    <input type="number" name="statusitem_id" id="statusitem_id" class="form-control" value="<?=(isset($model['statusitem_id'])) ? $model['statusitem_id'] : ''  ?>">
                </div>
            </div>
                                                
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Salvar
                    </button> 
                    <a class="btn btn-default" href="{{ url('/item_pedidos') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection