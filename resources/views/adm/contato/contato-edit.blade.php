@extends('layouts.adm')
@section('content')

    <!-- links e config -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/contato-create.css') }}">
    <!-- end links e config -->

    <div class="container">

        <div class="form-area">
            <div class="form-box">

                <div class="title-area">
                    <h1>Contato - Editar</h1>
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

                <form action="{{ url('/adm/contato/edited/'.$contato['id']) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="titulo">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome" value="{{ $contato['title'] }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $contato['email'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telephone">Telefone</label>
                                <input type="text" id="input-phone" name="telefone" class="form-control @error('telefone') is-invalid @enderror" placeholder="telefone" value="{{ $contato['telephone'] }}" maxlength="15">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="texto">Texto</label>
                                <textarea name="mensagem" id="mensagem" class="form-control @error('mensagem') is-invalid @enderror" rows="5" placeholder="Mensagem">{{ $contato['text'] }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            @if($contato['term'] == 'on')
                                <span><input type="checkbox" onclick="return false;" checked> Aceito receber os informativos da Oftalmologia Correa</span>
                            @else
                                <span><input type="checkbox" onclick="return false;"> Não aceito receber os informativos da Oftalmologia Correa</span> 
                            @endif
                        </div>
                    </div><br>

                    <div class="btn-area">
                        <button type="submit" class="btn btn-success">Editar</button>
                        <a href="{{ url('/adm/contato') }}" class="btn btn-primary">Voltar</a>
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