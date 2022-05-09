@extends('layouts.adm')
@section('content')

   <!-- links and config -->
   <link rel="stylesheet" href="{{ URL::to('/public/adm/css/acompanhe-edit.css') }}">
   <script src="{{ URL::to('/public/ckeditor/ckeditor.js') }}"></script>
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
                   <h1>Equipe - Editar</h1>
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

               <form action="{{ url('/adm/equipe/edited/'.$acompanhe['id']) }}" method="post" enctype="multipart/form-data">

                    @csrf

                   <div class="form-group">
                       <label for="title">Nome</label>
                       <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" placeholder="nome" maxlength="100" onkeyup="CountCaracters($(this).val().length,'nome')" value="{{ $acompanhe['title'] }}">
                       <span class="title-char-count" id="titleCharCount">Máximo Caracteres (0 / 100)</span>
                   </div>

                   <div class="form-group">
                       <label for="title">CRO</label>
                       <input type="text" class="form-control @error('cro') is-invalid @enderror" id="cro" name="cro" placeholder="cro" maxlength="100" onkeyup="CountCaracters($(this).val().length,'cro')" value="{{ $acompanhe['cro'] }}">
                       <span class="title-char-count" id="titleCharCount">Máximo Caracteres (0 / 100)</span>
                   </div>

                   <div class="form-group">
                       <label for="subtitle">Descrição</label>
                       <textarea name="descricao" id="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror" maxlength="255" onkeyup="CountCaracters($(this).val().length,'descricao')" placeholder="Descrição">{{ $acompanhe['subtitle'] }}</textarea>
                       <span class="subtitle-char-count" id="subtitleCharCount">Máximo Caracteres (0 / 255)</span>
                   </div>


                   <div class="row" id="imgWrapper">
                       <div class="col-md-6">
                           <label>Foto do membro</label>
                           <input id="uploadImage" class="file" type="file" name="image" onchange="PreviewImage();" style="display: block"/>
                           <span class="text-danger">Obs: formatos recomendados (.jpg .png) com 72dpi com largura de 551px e Altura 367px e tamanho maximo de 5MB</span>
                       </div>
                       <div class="col-md-6">
                           <div class="img-area">
                               <img src="{{ URL::to($acompanhe['image']) }}" id="uploadPreview"/>
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
   <!-- end scripts -->

@endsection