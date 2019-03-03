@extends('layouts.app')

@section('content')



<h2 class="page-header">Tipo Usuario</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Visualizar  </div>

    <div class="panel-body">
                

        <form action="{{ url('/tipo_usuarios') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="<?=$model['id']?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="descricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-6">
                <input type="text" name="descricao" id="descricao" class="form-control" value="<?=$model['descricao']?>" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/tipo_usuarios') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection