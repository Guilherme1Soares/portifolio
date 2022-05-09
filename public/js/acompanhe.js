setInterval(function(){
     /* PEGANDO LARGURA E ALTURA DA IMAGEM */
     var imageWidth = $('.acompanhe-content .container .box-left .box-photo .photo img').width();
     var imageHeight = $('.acompanhe-content .container .box-left .box-photo .photo img').height();
 
     /* POSICIONANDO OS ELEMENTOS INTERNOS DENTRO DA IMAGEM */
     $('.border-internal-left').css({"top": (imageHeight - 100) - 10});
     $('.border-internal-right').css({"left": (imageWidth - 100) - 10});
 
     /* DEFININDO LARGURA E ALTURA DA BORDA EXTERNA */
      $('.img-border').css({"width": imageWidth, "height": imageHeight});
},100);