@extends('layouts.adm')
@section('content')

   <!-- links and config -->
   <link rel="stylesheet" href="{{ URL::to('/public/adm/css/acompanhe-edit.css') }}">
   <script src="{{ URL::to('/public/ckeditor/ckeditor.js') }}"></script>
   @include('adm.inc.jquery-agenda')
   <style>
    .container .form-area .image-area{
        max-width: 100% !important;
        display: flex;
        width: 100%;
        justify-content: center;
        margin: 25px 0;
        height: auto !important;
    }
    .container .form-area .image-area video{
       width: 600px;
       height: 400px;
    }
    #videoArea{
        display: none;
    }

    iframe{
        background-color: #034462;
    }
</style>
   <!-- end links and config -->

   <div class="container">
       <div class="form-area">
           <div class="form-box">

               <div class="title-area">
                   <h1>Acompanhe - Editar</h1>
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

               <form action="{{ url('/adm/acompanhe/edited/'.$acompanhe['id']) }}" method="post" enctype="multipart/form-data">

                    @csrf

                   <div class="form-group">
                       <label for="title">Titulo</label>
                       <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="title" name="titulo" placeholder="Titulo" maxlength="100" onkeyup="CountCaracters($(this).val().length,'title')" value="{{ $acompanhe['title'] }}">
                       <span class="title-char-count" id="titleCharCount">Máximo Caracteres (0 / 100)</span>
                   </div>

                   <div class="form-group">
                       <label for="subtitle">Resumo</label>
                       <textarea name="resumo" id="subtitle" rows="3" class="form-control @error('resumo') is-invalid @enderror" maxlength="255" onkeyup="CountCaracters($(this).val().length,'resume')" placeholder="Resumo">{{ $acompanhe['subtitle'] }}</textarea>
                       <span class="subtitle-char-count" id="subtitleCharCount">Máximo Caracteres (0 / 255)</span>
                   </div>

                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="author">Autor</label>
                               <input type="text" id="author" class="form-control @error('autor') is-invalid @enderror" name="autor" placeholder="Autor" value="{{ $acompanhe['author'] }}">
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="type">Tipo</label>
                               <select class="form-control" name="type" id="type" value="{{ $acompanhe['type'] }}">
                                   @if($acompanhe['type'] =='texto')
                                        @section('selectedText', 'selected')
                                    @else
                                        @section('selectedVideo', 'selected')
                                    @endif
                                    <option id="opTexto" value="texto" @yield('selectedText')>Texto</option>
                                    <option id="opVideo" value="video" @yield('selectedVideo')>Video</option>
                                </select>
                           </div>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="postNow">Publicar agora</label>
                               <input type="radio" class="postNow" name="postDate" id="postNow" checked onclick="hideData()">
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="fomr-group">
                               <label for="postAfter">Agendar postagem</label>
                               <input type="radio" class="postAfter" name="postDate" id="postAfter" onclick="showData()">
                           </div>
                       </div>
                   </div>

                   <div class="row" id="hide">
                       <div class="col-md-4">
                           <div class="form-group">
                               <label for="time">Agendar Horário</label>
                               <input type="text" name="time" id="time" class="form-control" value="{{ $acompanhe['time'] }}" onkeyup="$(this).mask('00:00')">
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <label for="date">Agendar Data</label>
                               <input type="text" name="date" id="date" class="form-control" value="{{ $acompanhe['date'] }}" onkeyup="$(this).mask('00/00/0000')">
                           </div>
                       </div>
                   </div>

                   <div class="row" id="imgWrapper">
                       <div class="col-md-6">
                           <label>Imagem Principal</label>
                           <input id="uploadImage" class="file" type="file" name="image" onchange="PreviewImage();" style="display: block"/>
                           <span class="text-danger">Obs: formatos recomendados (.jpg .png) com 72dpi e tamanho maximo de 5MB</span>
                           <br>
                           <span style="display: flex; color: #b22; ">*Obs: Resolução de imagem recomendada:&nbsp;<strong>{{ Helper::getItem('acomp-image-resolution') }}</strong></span>
                       </div>
                       <div class="col-md-6">
                           <div class="img-area">
                               <img src="{{ URL::to($acompanhe['image']) }}" id="uploadPreview"/>
                           </div>
                       </div>
                   </div>

                   <div id="videoArea">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Insira a ID do vídeo:</label>
                                <input maxlength="11" id="uploadVideo" onkeyup="CountCaracters($(this).val().length,'video')" class="form-control" type="text" name="video" style="display: block" value="{{ $acompanhe['video'] }}"/>
                                <span class="text-danger">Obs: Insira o ID da URL do vídeo.<br> Exemplo: https://www.youtube.com/watch?v=<span style="color: #000">ID-do-vídeo</span> </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="image-area">
                                    @if($acompanhe['video'] == null)
                                        <iframe id="previewImage" width="100%" height="500" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @else
                                        <iframe id="previewImage" width="100%" height="500" src="{{ URL::to('https://www.youtube.com/embed/'.$acompanhe['video']) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    @endif    
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="row text-area">
                       <div class="col-md-12">
                           <div class="form-group">
                               <label for="text">Conteúdo</label>
                               <textarea class="form-control @error('conteudo') is-invalid @enderror" name="conteudo" id="text" cols="10" placeholder="Conteúdo" >{{ $acompanhe['text'] }}</textarea>
                           </div>
                           <script>
                               CKEDITOR.replace('text');
                           </script>
                       </div>
                   </div>

                   <div class="btn-area">
                       <button type="submit" class="btn btn-success">Editar</button>
                       <a href="{{ url('/adm/acompanhe') }}" class="btn btn-primary">Voltar</a>
                   </div>

               </form>
           </div>
       </div>
   </div>

   <!-- scripts -->
   <script type="text/javascript">


function bootCountCaracters(){

    let qntCaracterTitle = $("#title").val().length;
    let qntCaracterResume = $("#subtitle").val().length;

    $('#titleCharCount').html('Máximo Caracteres ('+qntCaracterTitle+' / 100 )');
    $('#subtitleCharCount').html('Máximo Caracteres ('+qntCaracterResume+' / 255 )');

        if(qntCaracterTitle >= 100)
        {
            $('#title').css("border","2px solid red");
            $('#titleCharCount').css("color","red");
        }

        if(qntCaracterTitle < 100)
        {
            $('#title').css("border","1px solid #ced4da");
            $('#titleCharCount').css("color","#000");
        }

        if(qntCaracterResume >= 255)
        {
            $('#subtitle').css("border","2px solid red");
            $('#subtitleCharCount').css("color","red");
        }

        if(qntCaracterResume < 255)
        {
            $('#subtitle').css("border","1px solid #ced4da");
            $('#subtitleCharCount').css("color","#000");
        }

} 

function CountCaracters(lengthObj,type){

    if(type == 'title')
    {
        $('#titleCharCount').html('Máximo Caracteres ('+lengthObj+' / 100 )');
        
        if(lengthObj >= 100)
        {
            $('#title').css("border","2px solid red");
            $('#titleCharCount').css("color","red");
        }

        if(lengthObj < 100)
        {
            $('#title').css("border","1px solid #ced4da");
            $('#titleCharCount').css("color","#000");
        }


    }


    if(type == 'resume')
    {
      $('#subtitleCharCount').html('Máximo Caracteres ('+lengthObj+' / 255 )');
      
      if(lengthObj >= 255)
      {
          $('#subtitle').css("border","2px solid red");
          $('#subtitleCharCount').css("color","red");
      }

      if(lengthObj < 255)
      {
          $('#subtitle').css("border","1px solid #ced4da");
          $('#subtitleCharCount').css("color","#000");
      }


  }
  if(type == 'video')
    {                   
      if(lengthObj >= 11)
      {
          var prevImage = $('#uploadVideo').val();
          var x = $("#previewImage").attr("src", "https://www.youtube.com/embed/"+prevImage);
      }
    }

}

       function hideData(){
           $('#hide').css('display', 'none')
       }

       function showData(){
           $('#hide').css('display', 'flex')
       }

       function PreviewImage() {
           var oFReader = new FileReader();
           oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
   
           oFReader.onload = function (oFREvent) {
               document.getElementById("uploadPreview").src = oFREvent.target.result;
               $('#uploadPreview').css('opacity', 1);
           };
       };
   
    bootCountCaracters();
   </script>
   <script>
        $(document).ready(function(){
            $('#type').on("change", function () {
                if ($(this).val()=="video") {
                    $("#imgWrapper").fadeOut(500);
                    $("#videoArea").delay(500).fadeIn(500);
                }
                else{
                    $("#videoArea").fadeOut(500);
                    $("#imgWrapper").delay(500).fadeIn(500);
                }
            });

            if($('#type').val() == 'video')
            {
                $("#imgWrapper").hide();
                $("#videoArea").delay(500).fadeIn(500)
            }
            else
            {
                $("#videoArea").hide();
                $("#imgWrapper").delay(500).fadeIn(500);
            }
        });
    </script>
    <script>
        $(function() {
            $( "#date" ).datepicker(
                $.datepicker.regional["pt-BR"]
            );
        });
    </script>
   <!-- end scripts -->

@endsection