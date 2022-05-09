@extends('layouts.adm')
@section('content')

    <!-- links and config -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/acompanhe-home.css') }}">
    <!-- end links and config -->

    <div class="container">
        <div class="form-area">

            <div class="title-area">
                <h1>Equipe</h1>
            </div>

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

            <div class="table-area" id="table">

                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                        <th scope="col"><i class="fas fa-tools"></i></th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Cro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($new === null)
                            <h3>Nada para mostrar</h3>
                        @else           
                         @php
                             $x = 0;
                         @endphp      
                            @foreach ($acompanhe as $item)
                            @php
                                $x++;
                            @endphp
                                <tr>
                                    <th>
                                        <a class="tools-icons" href="{{ url('/adm/equipe/edit/'.$item['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                                        <button style="border-style: none; outline: none; background-color: transparent; color: #fff;" class="tools-icons2" type="button" data-toggle="modal" data-target="#exampleModal-{{ $x }}"><i class="fas fa-trash-alt"></i></button>
                                    </th>
                                    <td><a href="{{ url('/adm/equipe/edit/'.$item['id']) }}">{{ Helper::limitString($item['title'], 40) }}</a></td>
                                    <td><a href="{{ url('/adm/equipe/edit/'.$item['id']) }}">{{ $item['cro'] }}</a></td>
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
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a href="{{ url('/adm/equipe-apagar/'.$item['id']) }}" class="btn btn-primary">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if ($acompanhe != null)
                    {{ $acompanhe->links() }}
                @endif
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
                    url: "{{ url('/adm/equipe/search/') }}",
                    data: {busca: buscar},
                    success: function(retorno){
                        $('#table').html(retorno);
                    }
                });
            }, 800)
        });
    </script>
    <!-- end scripts -->

@endsection