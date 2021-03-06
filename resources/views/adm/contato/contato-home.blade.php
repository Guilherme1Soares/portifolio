@extends('layouts.adm')
@section('content')

    <!-- links and config -->
    <link rel="stylesheet" href="{{ URL::to('public/adm/css/contato-home.css') }}">

    <!-- end links and config -->

    <div class="container">
        <span style="color: #b22">Clique em <i class="fas fa-pencil-alt"></i> para editar e <i class="fas fa-trash-alt"></i> para excluir</span><br>
        <div class="form-area">
            <div class="container" id="contatos-show">
                <h1 class="titulo" style="text-align: center;">contatos</h1>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                @if ($message = Session::get('delete'))
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                @endif
        
                <div class="busca-area">
                    <input class="form-control mr-sm-2" type="search" placeholder="buscar" aria-label="Search" id="buscar">      
                </div>
        
                <div id="content">
                    <table class="table table-striped table-dark">
                        <thead>
                          <tr>
                            <th scope="col"><i class="fas fa-tools"></i></th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Data / Hora</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 0;
                            @endphp
                            @foreach ($contatos as $contato)
                                @php
                                    $x++;
                                @endphp
                                <tr>
                                    <th>
                                        <a class="tools-icons" href="{{ url('/adm/contato/editar/'.$contato['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                                        {{-- <a class="tools-icons2" href="{{ url('/adm/contato/delete/'.$contato['id']) }}"><i class="fas fa-trash-alt"></i></a> --}}
                                        <button style="border-style: none; outline: none; background-color: transparent; color: #fff;" class="tools-icons2" type="button" data-toggle="modal" data-target="#exampleModal-{{ $x }}"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                    <td><a href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ Helper::limitString($contato['title'], 30) }}</a></td>
                                    <td><a href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['telephone'] }}</a></td>
                                    <td><a href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['date'] . " - ".Helper::noSeg($contato['time'])}}</a></td>
                                    <td>
                                        @if ($contato['status'] == "N??o lido")
                                            <a style="color: red; font-weight: bolder;" href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['status'] }}</a>
                                        @else 
                                            <a style="color: white; font-weight: bolder;" href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['status'] }}</a>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="exampleModal-{{ $x }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apagar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem certeza que deseja apagar?</p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">N??o</button>
                                                <a href="{{ url('/adm/contato/delete/'.$contato['id']) }}" class="btn btn-primary">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $contatos->links() }}
                    <a class="btn btn-success" href="{{ url('/adm/contato/excel/') }}" download="contatosexl.xls"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Gerar Relat??rio Excel</a>
                </div>
                
                
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script>
        var timeout = null;
        $('body').on('keyup', '#buscar', function(e){

            var buscar = $('#buscar').val();
            clearTimeout(timeout);

            timeout = setTimeout(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{ url('/adm/contato/search/') }}",
                    data: {busca: buscar},
                    success: function(retorno){
                        $('#content').html(retorno);
                    }
                });
            }, 800)
        });
    </script>
    <!-- end scripts -->
@endsection