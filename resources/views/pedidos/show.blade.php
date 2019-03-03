@extends('layouts.app')

@section('content')



<h2 class="page-header">Pedido</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Visualizar    </div>

    <div class="panel-body">
                

        <form action="{{ url('/pedidos') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="<?=$model['id']?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="valor" class="col-sm-3 control-label">Valor</label>
            <div class="col-sm-6">
                <input type="text" name="valor" id="valor" class="form-control" value="<?=$model['valor']?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="data_criado" class="col-sm-3 control-label">Data Criado</label>
            <div class="col-sm-6">
                <input type="text" name="data_criado" id="data_criado" class="form-control" value="<?=$model['data_criado']?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="usuario_id" class="col-sm-3 control-label">Usuario Id</label>
            <div class="col-sm-6">
                <input type="text" name="usuario_id" id="usuario_id" class="form-control" value="<?=$model['usuario_id'] ?>" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/pedidos') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection