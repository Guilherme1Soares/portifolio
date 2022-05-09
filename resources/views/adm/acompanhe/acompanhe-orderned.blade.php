<div class="sortable" id="sort">
    @php $i = 1 @endphp
    @foreach ($acompanhe as $item)
        <div class="alert bg-dark item light" id="{{ $item['id'] }}">
            <div class="ordem">{{ $i }} &ordm;</div>
            <div class="titulo">{{ $item['title'] }}</div>
        </div>
        @php $i++ @endphp
    @endforeach
</div>