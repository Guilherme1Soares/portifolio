@extends('layouts.adm')
@section('content')

    <!-- links and config -->
    <link rel="stylesheet" href="{{ URL::to('public/adm/css/google-home.css') }}">

    <!-- end links and config -->

    <div class="container">
        <span style="color: #b22">Clique em <i class="fas fa-pencil-alt"></i> para editar</span><br>
        <div class="form-area">
            <div class="container" id="google-show">
                <h1 class="titulo" style="text-align: center;">Meta Tags</h1>
                @if ($edited = Session::get('edited'))
                    <div class="alert alert-success">
                        {{ $edited }}
                    </div>
                @endif
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
    
                <div id="content">
                    <table class="table table-striped table-dark">
                        <thead>
                          <tr>
                            <th scope="col">Pagina</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($google as $item)
                                <tr>
                                    <td>
                                        <a class="tools-icons" href="{{ url('/adm/tags/editar/'.$item['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('/adm/tags/editar/'.$item['id']) }}">{{ Helper::limitString($item['title'], 30) }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>

@endsection