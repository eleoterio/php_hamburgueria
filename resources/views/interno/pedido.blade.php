@extends('layouts.interno')

@section('content')


<h2 class="page-header">{{ ucfirst('Pedidos') }} {{$pedido->id}} <a href="/cozinha" class="btn btn-default">Voltar</a></h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Listagem de Items 
    </div>    
    <div class="panel-body">
        <label>Valor Total: R$ {{number_format($pedido->valor, 2, ',', '.')}}</label>
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
            </div>
            @endforeach 
        @endif
    </div>
</div>


@endsection