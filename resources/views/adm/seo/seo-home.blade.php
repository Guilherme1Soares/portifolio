@extends('layouts.adm')
@section('content')

    <!-- links and config -->
    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/acompanhe-home.css') }}">
    <!-- end links and config -->

    <div class="container">
        <div class="form-area">

            <div class="title-area">
                <h1>SEO Avançado</h1>
            </div>

            <div class="info">
                @if($error = Session::get('error'))
                 <div class="alert alert-danger" role="alert">
                     {{ $error }}
                  </div>
                @endif
                @if($success = Session::get('success'))
                  <div class="alert alert-success" role="alert">
                    {{ $success }}
                  </div>
               @endif
                <span style="color:red;">Atenção: Caso não tenha experiência com XML ou SITEMAP, não mexa nas configurações.<br>Somente anexe um sitemap.xml caso não haja nenhum sitemap anexado em seu website.</span><br>
                <hr>
                <span>Caso não exista nenhum sitemap anexado ao seu website, favor anexar o mesmo seguindo a estrutura abaixo.</span><br>
                <span>
                    Por padrão o header do seu xml será semelhante ao código abaixo. <span style="color:red;">( O header é gerado automaticamente não é necessário inseri-lo no seu arquivo XML )</span>
                    @php
                        $xml_header = '
                        <?xml version="1.0" encoding="UTF-8"?>
                        <urlset
                            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                                    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
                        <!-- XML Gerado por: ADM -->
                        ';
                        echo '<pre>'.htmlspecialchars($xml_header).'</pre>';
                    @endphp
                </span>
                <span>O sitemap.xml que você deve anexar tem de seguir a estrutura abaixo.</span>
                <span>
                    @php 
                        $xml_body = '
                        <url>
                        <loc>https://www.seusite.com.br/</loc>
                        <lastmod>2021-08-30T20:11:36+00:00</lastmod>
                        <priority>1.00</priority>
                        </url>
                        <url>
                        <loc>https://www.seusite.com.br/quem-somos</loc>
                        <lastmod>2021-08-30T20:11:36+00:00</lastmod>
                        <priority>0.80</priority>
                        </url>
                        ';
                        echo '<pre>'.htmlspecialchars($xml_body).'</pre>';
                    @endphp
                </span>
                <form action="{{ route('seo-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Anexar sitemap XML</label>
                        <input type="file" name="sitemap" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar sitemap</button>
                </form>
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
                    url: "{{ url('/adm/acompanhe/search/') }}",
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