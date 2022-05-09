@extends('layouts.adm')
@section('content')

    <!-- links e confih -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/google-create.css') }}">
    <!-- end links e config -->

    <div class="container">
        <div class="form-area">
            <div class="form-box">

                <div class="title-area">
                    <h1>Google Meta tag - Cadastro</h1>
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

                <form action="{{ url('/adm/tags') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="pagina">Página</label>
                        <input type="text" name="pagina" id="pagina" class="form-control @error('pagina') is-invalid @enderror" placeholder="Página" value="{{ old('pagina') }}">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror" placeholder="Descrição" >{{ old('descricao') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="conteudo">Palavra Chave</label>
                        <textarea name="PalavraChave" id="PalavraChave" rows="5" class="form-control @error('PalavraChave') is-invalid @enderror" placeholder="PalavraChave" >{{ old('PalavraChave') }}</textarea>
                        <span class="text-danger">Atenção: As palavras chaves devem ser separadas por vírgulas e pertinente ao conteúdo da respectiva página.</span>
                    </div>

                    <div class="btn-area">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                        <a href="{{ url('/adm/tags') }}" class="btn btn-primary">Voltar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- scripts -->

    <!-- end scripts -->

@endsection