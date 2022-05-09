//cookies script
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
    }

    $("#nome").attr("value",getCookie("nome"));
    $("#telefone").attr("value",getCookie("telefone").replace('+',' '));
    $("#email").attr("value",getCookie("email"));

    $('body').on('click','.down', function(){
        $('.hidden').toggle('fast');
        $(this).toggleClass('rotate');
    });

    $(document).ready(function($){
        var nav = $('.aside-content');

        $(window).scroll(function () {
            if ($(this).scrollTop() > 90) {
                nav.addClass("fixo");
            } else {
                nav.removeClass("fixo");
            }
        });

        $("#top").click(function(){
            $('html, body').animate({scrollTop:0}, 1000);
        });
    });

    $(document).ready(function(){
        // animação scroll quando se clica no menu
        $('.aside-content ul li').on('click', function() {
        $("html, body").animate({
            scrollTop: $('#' +$(this).data('section')).offset().top - 190// ir para a secção cujo o id é o valor do atributo `data-section` do item do menu onde clicamos
        }, 1000);
        });

        // guardamos todas as distancias de cada seção até ao todo da página e respectivo id
        var alturas = {};
        $('.section').each(function () {
        alturas[$(this).prop('id')] = $(this).offset().top - 200 // ex: alturas['section_2'] = 600
        });

        // quando fazemos scoll vamos percorrer o nosso obj alturas e comparar a altura de cada secção com o que já andamos em scroll
        $(window).on('scroll', function() {
            for(var seccao in alturas) {
                if($(window).scrollTop() >= alturas[seccao]) {
                    $('.aside-content ul li').removeClass('ativo'); // removemos a classe ativo
                    $('.aside-content ul li[data-section="' +seccao+ '"]').addClass('ativo'); // adicionamos a class active ao item do menu cuja data-section é igual ao id da secção que está a uma maior ou igual distancia do topo do que aquela que percorremos com o scroll
                }
            }
        });
    });

    function validation()
    {
        let inputCel = document.querySelector('#whatsapp');
        inputCel.addEventListener('keyup', function(){
            let valor = mtel(this.value);
            this.value = valor;
        });
        function mtel(v){
            v = v.replace(/\D/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }
    }

    validation();