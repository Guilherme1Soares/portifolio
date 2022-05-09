@extends('layouts.site')
@section('title', 'Guilherme - Portifólio')
@section('content')

<link rel="stylesheet" href="{{URL::to('public/libs/Swiper/package/css/swiper.min.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="site.css">

<section class="whoArea">
    <div class="container-full">
        <div class="container-static">
            <div class="whoWrapper">
                <div class="text">
                    <span id="alert"></span>
                </div>
                <div class="photo">
                    <figure>
                        <img src="{{ url('/public/img/BG.webp')}}" alt="Guilherme Soares Cordeoli">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="slide">
    <div class="container-full">
        <div class="container-static">

            <div class="slideWrapper">
                <div class="webProject">
                    <h1>- Projetos WebDesign:</h1>
                </div>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="slideImage">
                                <figure>
                                    <a href="{{ url::to('https://evolutiondho.com.br/')}}" target="_blank"><img src="{{ url('/public/img/slide01.webp')}}" alt="Projeto WebDesign">
                                        <span id="warning">Clique para ir ao site!</span>
                                    </a>
                                </figure>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <div class="swiper-slide">
                            <div class="slideImage">
                                <figure>
                                    <a href="{{ url::to('https://centroacaminhodaluz.com.br/')}}" target="_blank"><img src="{{ url('/public/img/slide02.webp')}}" alt="Projeto WebDesign">
                                        <span id="warning">Clique para ir ao site!</span>
                                    </a>
                                </figure>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <div class="swiper-slide">
                            <div class="slideImage">
                                <figure>
                                    <a href="{{ url::to('https://www.arcocorretora.com.br')}}" target="_blank"><img src="{{ url('/public/img/slide03.webp')}}" alt="Projeto WebDesign">
                                        <span id="warning">Clique para ir ao site!</span>
                                    </a>
                                </figure>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <div class="swiper-slide">
                            <div class="slideImage">
                                <figure>
                                    <a href="{{ url::to('https://lfcpadv.com.br')}}" target="_blank"><img src="{{ url('/public/img/slide04.webp')}}" alt="Projeto WebDesign">
                                        <span id="warning">Clique para ir ao site!</span>
                                    </a>
                                </figure>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>

                </div>

                <div class="anotherProject">
                    <div class="title">
                        <h2>- Outros Projetos de Design:</h2>
                    </div>
                    <div class="boxes">
                        <div class="boxWrapper">

                            <div class="box01">
                                <a href="{{Helper::getItem('behance')}}" target="_blank"><i class="icon-behance-2161"></i></a>
                            </div>

                            <div class="box02">
                                <a href="{{Helper::getItem('github')}}" target="_blank"><i class="icon-github"></i></a>
                            </div>

                            <div class="box03">
                                <a href="{{Helper::getItem('linkedin')}}" target="_blank"><i class="icon-linkedin_black_logo_icon_147114"></i></a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<section class="curriculo">
    <div class="container-full">
        <div class="container-static">
            <div class="curriculo-wrapper">

                <div class="title">
                    <h3>Curriculo:</h3>
                </div>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Guilherme Soares Cordeoli
                                 </a>
                            </h4>
                        </div>

                         <div id="collapseOne" class="panel-collapse collapse in">
                             <div class="panel-body">
                                 - Bacharelado em Design. <br>
                                 - Experiência em WebDesign e Desenvolvimento Web. <br>
                                 - Projetos realizados em campo profissional. <br>
                                 - Conhecimento adequado nos softwares Adobe. <br>
                                 - Experiência com as linguagens HTML, CSS, JAVASCRIPT, PHP. <br>
                            </div>
                         </div>
                    </div>
                </div>    

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Creditos
                                 </a>
                            </h4>
                        </div>

                         <div id="collapseOne" class="panel-collapse collapse in">
                             <div class="panel-body">
                                 Sites desenvolvidos por mim, em atividade dentro da empresa: <a href="{{ url('https://www.engenhodeimagens.com.br')}}" target="_blank">Engenho de Imagens</a>
                            </div>
                         </div>
                    </div>
                </div>    

            </div>
        </div>
    </div>
</section>

<script src="{{URL::to('public/libs/Swiper/package/js/swiper.min.js')}}"></script>
<script src="{{URL::to('public/js/t-writer.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 

<script>
    var swiper = new Swiper(".mySwiper", {
        autoplay: true,
        speed: 2000,

        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
</script>

<script>
    var app = document.getElementById('alert');
    var typewriter = new Typewriter(app, {
    loop: true
});

    typewriter.typeString('Olá, sou o Guilherme, tenho 21 anos sou Designer e WebDeveloper! tenho diversos projetos acadêmicos e profissionais realizados por mim voltados a área do Design e também como Web Developer')
    .pauseFor(6500)
    .deleteAll()
    .start();
</script>

@endsection
