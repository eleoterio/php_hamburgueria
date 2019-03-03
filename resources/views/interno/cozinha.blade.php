@extends('layouts.interno')

@section('content')


<h2 class="page-header">{{ ucfirst('Pedidos') }}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Listagem
    </div>

    <div class="panel-body">
        <div class="">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th style="width:50px"></th>
                    <th style="width:50px"></th>
                </tr>
              </thead>
              <tbody>
                           
                @foreach ($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                        <td>{{$item->descricao}}</td>
                        <td>
                            <a href="/interno/pedido/{{$item->id}}" class="pronto btn btn-default">Visualizar</a>                           
                        </td>
                        <td>
                            <a data-id="{{$item->id}}" class="pronto btn btn-primary">Pronto</a>                           
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>




@endsection



@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "ordering": true,
                "responsive": true,
                "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                },
            });
        });
        $(".pronto").click(function(){
            $.ajax({ url: "/interno/pronto/" + $(this).data('id'), 
                type: 'PUT'})
            .success(function() {
                    window.location.reload();
            });
        });
    </script>
@endsection