@extends('layouts.app')

@section('content')



<h2 class="page-header">Produto</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Visualizar   </div>

    <div class="panel-body">
                

        <form action="{{ url('/produtos') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="<?=$model->id ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="nome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-6">
                <input type="text" name="nome" id="nome" class="form-control" value="<?=$model->nome ?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="descricao" class="col-sm-3 control-label">Descricao</label>
            <div class="col-sm-6">
                <input type="text" name="descricao" id="descricao" class="form-control" value="<?=$model->descricao?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="valor" class="col-sm-3 control-label">Valor</label>
            <div class="col-sm-6">
                <input type="text" name="valor" id="valor" class="form-control" value="<?=$model->valor?>" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="categoriaproduto_id" class="col-sm-3 control-label">Categoria</label>
            <div class="col-sm-6">
                <input type="text" name="categoriaproduto_id" id="categoriaproduto_id" class="form-control" value="<?=$model->categoriaproduto_descricao ?>" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/produtos') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection