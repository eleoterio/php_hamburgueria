@extends('layouts.app')

@section('content')


<h2 class="page-header">{{ ucfirst('Usuario') }}</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Listagem
    </div>

    <div class="panel-body">
        <div class="">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Nome</th>
                    <th>Cpf</th>
                    <th>Data Criado</th>
                    <th>Endereco</th>
                    <th>Tipo de Usuario</th>
                    <th style="width:50px"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <a href="{{url('usuarios/create')}}" class="btn btn-primary" role="button">Cadastrar</a>
    </div>
</div>




@endsection



@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": true,
                "ajax": "{{url('usuarios/grid')}}",
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/usuarios') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/usuarios') }}/'+row[0]+'/edit" class="btn btn-default">Alterar</a>';
                        },
                        "targets": 8                    
                    },
                ],
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
        function doDelete(id) {
            if(confirm('Deseja mesmo remover este registro?')) {
               $.ajax({ url: '{{ url('/usuarios') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection