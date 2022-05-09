@extends('layouts.adm')
@section('content')

    <!-- links e config -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/user-edit.css') }}">
    <!-- end links e config -->

    <div class="container">
        <div class="form-area">
            <div class="form-box">
                <div class="title-area">
                    <h1>Dados do usuário</h1>
                </div>

                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/adm/dados-usuario/update/'.Auth::user()->id )}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="nome" class="form-control" placeholder="Nome" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username">Usuário:</label>
                                <input type="text" id="username" name="usuario" class="form-control" placeholder="Usuário" value="{{ Auth::user()->username }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Nome" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" id="password" name="senha" class="form-control" placeholder="Senha">
                                <span class="text-danger">OBS: Se não for alterar a senha, favor deixar o campo em branco</span>
                            </div>
                        </div>
                    </div>

                    <div class="btn-area">
                        <button type="submit" class="btn btn-success">Editar</button>
                        <a href="{{ url('/adm/home') }}" class="btn btn-primary">Voltar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
    
    <!-- scripts -->

    <!-- end scripts -->

@endsection