@extends('layouts.adm')

@section('content')



   <!-- links and config -->

   <link rel="stylesheet" href="{{ URL::to('/public/adm/css/video-create.css') }}">

   <script src="{{ URL::to('/public/ckeditor/ckeditor.js') }}"></script>

   <!-- end links and config -->



   <div class="container">

       <div class="form-area">

           <div class="form-box">



               <div class="title-area">

                   <h1>Videos - Editar</h1>

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



               @if($Error = Session::get('Error'))

                    <div class="alert alert-danger">

                        <ul>

                            <li>{{ $Error }}</li>

                        </ul>

                    </div>

                @endif



                @if($success = Session::get('success'))

                    <div class="alert alert-success">

                        <ul>

                            <li>{{ $success }}</li>

                        </ul>

                    </div>

                @endif



               <form action="{{ url('/adm/videos/edited/'.$video['id']) }}" method="post" enctype="multipart/form-data">



                    @csrf



                    <div class="form-group">

                        <label for="title">Nome do vídeo</label>

                        <input type="text" class="form-control @error('nomeDoVideo') is-invalid @enderror" id="nomeDoVideo" name="nomeDoVideo" maxlength="100" onkeyup="CountCaracters($(this).val().length,'title')" placeholder="Nome do vídeo" value="{{$video['name']}}{{old('nomeDoVideo')}}">

                        <span class="title-char-count" id="titleCharCount">Máximo Caracteres (0 / 100)</span>

                    </div>



                     <div class="form-group">

                        <label for="title">Autor</label>

                        <input type="text" class="form-control @error('autor') is-invalid @enderror" id="author" name="autor" maxlength="100" onkeyup="CountCaracters($(this).val().length,'author')" placeholder="Autor do vídeo" value="{{$video['postedBy']}}{{old('autor')}}">

                        <span class="title-char-count" id="authorCharCount">Máximo Caracteres (0 / 100)</span>

                    </div>



                    <div class="form-group" id="area-video">

                        <label for="title">ID do vídeo</label>

                        <input type="text" class="form-control @error('idDoVideo') is-invalid @enderror" id="idDoVideo" name="idDoVideo" maxlength="255" placeholder="ID do vídeo" value="{{$video['code']}}{{old('idDoVideo')}}">

                        <span class="title-char-count"> 

                            https://www.youtube.com/watch?v=<font color="red">ID do vídeo</font><br>

                            Exemplo: https://www.youtube.com/watch?v=<font color="red">6NKhcV3v2nw</font><br>

                         </span>

                    </div>



                     <div class="form-group" id="videoFrame">

                        <label for="title">Seu vídeo</label>

                        <iframe id="ytVideo" src="https://www.youtube.com/embed/{{$video['code']}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </div>



                   <div class="btn-area">

                       <button type="submit" class="btn btn-success">Editar</button>

                       <a href="{{ url('/adm/videos') }}" class="btn btn-primary">Voltar</a>

                   </div>



               </form>

           </div>

       </div>

   </div>



   <!-- scripts -->

   <script type="text/javascript">



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


    if(type == 'author')
    {

        $('#authorCharCount').html('Máximo Caracteres ('+lengthObj+' / 100 )');

                

        if(lengthObj >= 100)

        {

            $('#author').css("border","2px solid red");

            $('#authorCharCount').css("color","red");

        }

        if(lengthObj < 100)

        {

            $('#author').css("border","1px solid #ced4da");

            $('#authorCharCount').css("color","#000");

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

   

   </script>

   <!-- end scripts -->



@endsection