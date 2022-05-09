@extends('layouts.adm')
@section('content')

    <!-- links e config -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/news-create.css') }}">
    <!-- end links e config -->

    <div class="container">
        <div class="form-area">
            <div class="form-box">

                <div class="title-area">
                    <h1>News - Cadastro</h1>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/adm/news/') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="nome" value="{{ old('nome') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" id="input-phone" name="telefone" class="form-control @error('telefone') is-invalid @enderror" placeholder="Telefone" value="{{ old('telefone') }}" maxlength="15">
                            </div>
                        </div>
                    </div>

                    <div class="btn-area">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                        <a href="{{ url('/adm/news') }}" class="btn btn-primary">Voltar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- scripts -->
    <script>
         $('body').on('keyup', '#input-phone',function(){
            valor = mtel($(this).val());
            $(this).val(valor);
        });

        function mtel(v){
            v = v.replace(/\D/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }
    </script>
    <!-- end scripts -->

@endsection