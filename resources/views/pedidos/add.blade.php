@extends('layouts.app')

@section('content')


<h2 class="page-header">{{ ucfirst('Pedidos') }} {{$pedido->id}} <a href="/pedidos" class="btn btn-default">Voltar</a></h2>
<label>Nome : {{$pedido->nome}} </label>
<div class="panel panel-default">
    <div class="panel-heading">
        Listagem de Items 
    </div>    
    <div class="panel-body">
        <label>Valor Total: R$ {{number_format($pedido->valor, 2, ',', '.')}}</label>
        <form action="/pedidos/newitem" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="pedido_id" value="{{$pedido->id}}"/>
            <select name="produto">
                @foreach ($itens as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach
            </select>
            <input type="number" name="quantidade"/>
            <input type="submit" class="btn btn-primary" role="button" value="Novo Item">
        </form>
        @if (isset($item_pedido))
            @foreach ($item_pedido as $item)
            <div>        
                <div class="col-md-12">
                    {{$item->nome}} - {{$item->quantidade}} - R$ {{number_format(($item->quantidade*$item->valor),2,',',',')}}
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        {{$item->descricao}}
                    </div>
                </div>
                @if ($item->statusitem_id == 1 || $item->statusitem_id == 6)
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <a class="btn btn-danger" data-excluir="{{$item->id}}" >Excluir</a>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach 
        @endif
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Cardapio
    </div>    
    <div class="panel-body">
        @foreach ($itens as $item)
        <div >
            <div class="col-md-12">
                    {{$item->nome}} - R$ {{number_format($item->valor,2,',',',')}}
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    {{$item->descricao}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $("[data-excluir]").click(function(){
            if(confirm('Deseja mesmo remover este registro?')) {
               $.ajax({ url: "/pedidos/delitem/" + $(this).data('excluir'), 
                type: 'DELETE'})
               .success(function() {
                    window.location.reload();
               });
            }
        });       
    </script>
@endsection