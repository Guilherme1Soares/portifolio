<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- METAS TAGS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Title" content="Porifólio - Guilherme Soares Cordeoli">
    <meta name="Developer" content="Guilherme Soares Cordeoli">
    <meta name="description" content="@yield("description")">
    <meta name="keywords" content="@yield("keywords")">
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="manifest" href="/site.webmanifest">

    
    <!-- END METAS TAGS -->

    <link rel="stylesheet" href="{{URL::to('public/css/site.css')}}">
    <!-- END LINKS AND LIBS CSS -->

    <title>@yield('title')</title>

</head>
<body>

      <!-- HEADER -->
    <div class="sticky-top">
    <header>
        <div class="headerColumn1">
            <div class="icons">
                <ul>
                    <a href="{{ Helper::getItem('github')}}" target="_blank"><li><i class="icon-github"></i></li></a>
                    <!-- <a href="{{ Helper::getItem('instagram')}}" target="_blank"><li><i class="icon-instagram_black_logo_icon_147122"></i></li></a> -->
                    <!-- <a href=""><li><i class="icon-youtube"></i></li></a> -->
                    <a href="{{ Helper::getItem('linkedin')}}" target="_blank"><li><i class="icon-linkedin_black_logo_icon_147114"></i></li></a>
                    <a href="{{ Helper::getItem('behance')}}" target="_blank"><li><i class="icon-behance-2161"></i></li></a>
                </ul>
            </div>
        </div>
        <div class="column2">
            <div class="container-full">
                <div class="container-static">
                    <div class="column2Wrapper">
                        <div class="photo">
                            <figure>
                                <a href="{{ url('/')}}"><img src="{{ url('/public/img/photo.webp')}}" alt="Guilherme Soares Cordeoli"></a>
                            </figure>
                        </div>
                        <div class="navbar">
                            @include('inc.navbar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    </div>
    <!-- END HEADER -->

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>
    <!-- END CONTENT -->

    <!-- FOOTER -->
    <footer>
        <div class="footer">
            <div class="container-full">
                <div class="container-static">
                    <div class="footerWrapper">
                        <div class="developer">
                            <h1>Desenvolvido por: Guilherme Soares Cordeoli</h1>
                        </div>
                        <!-- <div class="creditos">
                            <a href="">Creditos</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <!--Navbar Mobile-->
    <div class="navbar-mobile">
        <div class="navbar-mobile-wrapper">
            <div class="logo-area">
                <a href="{{ url('/') }}">
                    <figure>
                        <img src="{{ url('/public/img/photo.webp')}}" alt="Guilherme Soares Cordeoli">
                    </figure>
                </a>
            </div>
            <div class="menu">
            <a href="javascript:;" onclick="openMenu();"> <i class="icon-menu"></i></a>
            </div>
        </div>
        <div class="nav-content" id="contentMobile">
            <div class="close">
            <i class="icon-cross" onclick="closeMenu();"></i> 
            </div>
            @include('inc.navbar')
        </div>
    </div>
    <!--End Navbar Mobile-->

    <!--Botão Flutuante Whats-->
    <a href="{{ Helper::getItem('link-whats1')}}" target="_blank">
        <div class="btnWhats">
            <i class="icon-whatsapp"></i>
        </div>
    </a>
    <!--End Botão Flutuante Whats-->

    <!--Icomoon-->
    <link rel="stylesheet" href="{{ url('public/icomoon/style.css')}}">
    <!--End Icomoon-->

    <!-- SCRIPTS AND LIBS JS -->
    <script src="{{URL::to('public/js/site.js')}}"></script>
    <!-- END SCRIPTS AND LIBS JS -->

    <script>
        /* MENU MOBILE */
        function openMenu(){
            let conteudo = document.querySelector("#contentMobile");
            conteudo.classList.add("nav-mobile-active");
        }
        function closeMenu(){
            let conteudo = document.querySelector("#contentMobile");
            conteudo.classList.remove("nav-mobile-active");
        }
       /* //MENU MOBILE */
   </script>

</body>
</html>