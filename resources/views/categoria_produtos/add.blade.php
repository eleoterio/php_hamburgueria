@extends('layouts.app')

@section('content')


<h2 class="page-header">Categoria de Produto</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Adicionar/Editar</div>

    <div class="panel-body">
                
        <form action="{{ url('/categoria_produtos'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif


            <div class="form-group">
                <label for="id" class="col-sm-3 control-label">Código</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="<?= isset($model['id']) ? $model['id']: '' ?>" readonly="readonly">
                </div>
            </div>
            <div class="form-group">
                <label for="descricao" class="col-sm-3 control-label">Descrição</label>
                <div class="col-sm-6">
                    <input type="text" name="descricao" id="descricao" class="form-control" value="<?= isset($model['descricao']) ? $model['descricao']: ''  ?>">
                </div>
            </div>
                                                            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Salvar
                    </button> 
                    <a class="btn btn-default" href="{{ url('/categoria_produtos') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection