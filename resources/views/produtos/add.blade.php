@extends('layouts.app')

@section('content')


<h2 class="page-header">Produto</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Cadastrar/Editar    </div>

    <div class="panel-body">
                
        <form action="{{ url('/produtos'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
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
                <label for="nome" class="col-sm-3 control-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" name="nome" id="nome" class="form-control" value="<?= isset($model['nome']) ? $model['nome'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="descricao" class="col-sm-3 control-label">Descricao</label>
                <div class="col-sm-6">
                    <input type="text" name="descricao" id="descricao" class="form-control" value="<?= isset($model['descricao']) ? $model['descricao'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="valor" class="col-sm-3 control-label">Valor</label>
                <div class="col-sm-2">
                    <input type="text" name="valor" id="valor" class="form-control" value="<?= isset($model['valor']) ? $model['valor'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="categoriaproduto_id" class="col-sm-3 control-label">Categoria</label>
                <div class="col-sm-2">
                    <select name="categoriaproduto_id">
                        @foreach ($categorias as $item)
                            @if (isset($model->categoriaproduto_id) && $item->id == $model->categoriaproduto_id)
                                <option selected value="{{$item->id}}">{{$item->descricao}}</option>
                            @else
                                <option value="{{$item->id}}">{{$item->descricao}}</option>
                            @endif                            
                        @endforeach
                    </select>
                </div>
            </div>
                                                
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Salvar
                    </button> 
                    <a class="btn btn-default" href="{{ url('/produtos') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection