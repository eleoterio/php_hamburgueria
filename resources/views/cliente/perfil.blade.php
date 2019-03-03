@extends('layouts.newclient')

@section('content')


<h2 class="page-header">Usuario</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar/Editar   </div>

    <div class="panel-body">
                
        <form action="{{ url('/usuarios'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif


            <div class="form-group">
                <label for="id" class="col-sm-3 control-label">Id</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="<?= isset($model['id']) ? $model['id'] : '' ?>" readonly="readonly">
                </div>
            </div>
                                                                                                                                                <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" id="email" class="form-control" value="<?= isset($model['email']) ? $model['email'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class="col-sm-3 control-label">Senha</label>
                <div class="col-sm-6">
                    <input type="text" name="senha" id="senha" class="form-control" value="<?= isset($model['senha']) ? $model['senha'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="nome" class="col-sm-3 control-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" name="nome" id="nome" class="form-control" value="<?= isset($model['nome']) ? $model['nome'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="cpf" class="col-sm-3 control-label">Cpf</label>
                <div class="col-sm-2">
                    <input type="number" name="cpf" id="cpf" class="form-control" value="<?= isset($model['cpf']) ? $model['cpf'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="endereco" class="col-sm-3 control-label">Endereco</label>
                <div class="col-sm-6">
                    <input type="text" name="endereco" id="endereco" class="form-control" value="<?= isset($model['endereco']) ? $model['endereco'] : '' ?>">
                </div>
            </div>
                                                            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Salvar
                    </button> 
                    <a class="btn btn-default" href="{{ url('/cliente') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection