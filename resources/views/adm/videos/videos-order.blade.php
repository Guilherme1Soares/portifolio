@extends('layouts.adm')

@section('content')



    <!-- links css e config -->

    <link rel="stylesheet" href="{{ URL::to('/public/adm/css/acompanhe-order.css') }}">

    <!-- end links e config -->



    <div class="container">

        <span>Para ordenar os dados você deve pressionar o mouse sobre o item e arrastar para posição desejada.</span><br>

        <span style="color:red;">Ao alterar as posições dos itens, pressione <strong>F5</strong> no seu teclado para visualizar as alterações.</span>

        <div class="form-area">



            <div class="title-area">

                <h1>Videos - Ordenar</h1>

            </div>



            <!-- exebindo menssagem de sucesso -->

            <div class="box-text">

                <div id="msg-sucesso"></div>    

            </div>

            



            <!-- header ordenação -->

            <div class="titulo-ordem">

                <label class="ordem">Ordem</label>

                <label class="titulo"> Titulo</label>

            </div>

            

           <!-- itrens de ordenação -->

           <div id="dortee">

                <div class="sortable" id="sort">

                    @php $i = 1 @endphp

                    @foreach ($acompanhe as $item)

                        <div class="alert bg-dark item light" id="{{ $item['id'] }}">

                            <div class="ordem">{{ $i }} &ordm;</div>

                            <div class="titulo">{{ $item['name'] }} {!! $item['datePost'] > $datatual ? "<strong style='color:red;'>( Aguardando publicação ) </strong>" : "<strong>( Publicado )</strong>" !!}</div>

                        </div>

                        @php $i++ @endphp

                    @endforeach

                </div>

           </div>

        </div>

    </div>



   <!-- scripts -->

   <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



   <script>



       $(".sortable").sortable({

           connectWith: ".sortable",

           placeholder: 'dragHelper',

           scroll: true,

           revert: true,

           cursor: "move",

           update: function () {

               let cad_id_list = $(this).sortable('toArray').toString();

               //alert("Fotos ordenadas com sucesso");

               $.ajaxSetup({

                   headers: {

                       'X-CSRF-TOKEN': $('meta[name="csrf-token "]').attr('content')

                   }

               });

               $.ajax({

                   url: "{{ url('/adm/videos/orderned/') }}",

                   type: 'GET',

                   data: {cad_id_item: cad_id_list},

                   success: function (resp) {

                       //location.reload();

                       $('#msg-sucesso').html("<div class='alert alert-success'>"+resp+'</div>')

                       //$('#dortee').html(resp)

                   }

               });

           }

       });

   </script>



@endsection