@extends('layouts.app')

@section('content')



<h2 class="page-header">Usuario</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Visualizar   </div>

    <div class="panel-body">
                

        <form action="{{ url('/usuarios') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="<?= $model['id']?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" value="<?=$model['email'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="senha" class="col-sm-3 control-label">Senha</label>
            <div class="col-sm-6">
                <input type="text" name="senha" id="senha" class="form-control" value="<?=$model['senha']?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="nome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-6">
                <input type="text" name="nome" id="nome" class="form-control" value="<?=$model['nome'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="cpf" class="col-sm-3 control-label">Cpf</label>
            <div class="col-sm-6">
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?=$model['cpf'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="data_criado" class="col-sm-3 control-label">Data Criado</label>
            <div class="col-sm-6">
                <input type="text" name="data_criado" id="data_criado" class="form-control" value="<?= $model['data_criado'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="endereco" class="col-sm-3 control-label">Endereco</label>
            <div class="col-sm-6">
                <input type="text" name="endereco" id="endereco" class="form-control" value="<?=$model['endereco'] ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="tipousuario_id" class="col-sm-3 control-label">Tipousuario Id</label>
            <div class="col-sm-6">
                <input type="text" name="tipousuario_id" id="tipousuario_id" class="form-control" value="<?=$model['tipousuario_id'] ?>" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/usuarios') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection