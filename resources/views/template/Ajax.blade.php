
@if(count($news) < 1)
    <style>
        #ultNoticias{display:none;}
        #noNoticias{display:block !important;}
    </style>
@else
    <style>
        #ultNoticias{display:block;}
        #noNoticias{display:none !important;}
    </style>

     @foreach($news as $itens)
     <li> 
        <div class="icon">
            <i class="{{ $itens['type'] == "texto" ? "far fa-file-alt" : "fas fa-desktop" }}"></i>
        </div>
        <div class="text">
            <span><a href="{{ route('acompanhe')}}/{{ $itens['url']}}">{{ Helper::limitString($itens['title'], 60) }}</a><span>
        </div>
     </li>
     @endforeach

@endif 