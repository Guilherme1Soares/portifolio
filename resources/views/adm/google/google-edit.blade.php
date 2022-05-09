@extends('layouts.adm')
@section('content')

    <!-- links e confih -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/google-create.css') }}">
    <!-- end links e config -->

    
    <div class="container">
        <div class="form-area">
            <div class="form-box">

                <div class="title-area">
                    <h1>Meta tag - Editar</h1>
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

                <form action="{{ url('/adm/tags/edited/'.$google['id']) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="pagina">Página</label>
                        <input disabled type="text" name="pagina" id="pagina" class="form-control @error('pagina') is-invalid @enderror" placeholder="Página" value="{{ $google['title'] }}">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Palavra Chave</label>
                        {{-- <textarea name="descricao" id="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror" placeholder="Descrição" >{{ $google['description'] }}</textarea> --}}
                        <textarea name="PalavraChave" id="PalavraChave" rows="5" class="form-control @error('PalavraChave') is-invalid @enderror" placeholder="PalavraChave" >{{ $google['text'] }}</textarea>
                        <span class="text-danger">Atenção: As palavras chaves devem ser separadas por vírgulas e pertinente ao conteúdo da respectiva página.</span>
                    </div>
                    
                    <div class="form-group">
                        <label for="conteudo">Descrição</label>
                        {{-- <textarea name="conteudo" id="conteudo" rows="5" class="form-control @error('conteudo') is-invalid @enderror" placeholder="Conteúdo" >{{ $google['text'] }}</textarea> --}}
                        <textarea name="descricao" id="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror" placeholder="Descrição" maxlength="150" onkeyup="CountCaracters($(this).val().length,'descricao')">{{ $google['description'] }}</textarea> 
                        <span class="title-char-count" id="titleCharCount">Máximo Caracteres (0 / 150)</span>
                    </div>

                    <div class="btn-area">
                        <button type="submit" class="btn btn-success">Editar</button>
                        <a href="{{ url('/adm/tags') }}" class="btn btn-primary">Voltar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- scripts -->
    <script>
        function CountCaracters(lengthObj,type){

            if(type == 'descricao')
            {
                $('#titleCharCount').html('Máximo Caracteres ('+lengthObj+' / 150 )');
                
                if(lengthObj >= 150)
                {
                    $('#title').css("border","2px solid red");
                    $('#titleCharCount').css("color","red");
                }

                if(lengthObj < 150)
                {
                    $('#title').css("border","1px solid #ced4da");
                    $('#titleCharCount').css("color","#000");
                }


            }
        }
    </script>
    <!-- end scripts -->

@endsection