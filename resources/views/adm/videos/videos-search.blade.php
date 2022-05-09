    <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col"><i class="fas fa-tools"></i></th>
            <th scope="col">Nome</th>
            <th scope="col">Autor</th>
            </tr>
        </thead>
        <tbody>
            @if ($acompanhe === null)
                <h3>Nada para mostrar</h3>
            @else            
                @foreach ($acompanhe as $item)
                    <tr>
                        <th>
                            <a class="tools-icons" href="{{ url('/adm/videos/edit/'.$item['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="tools-icons2" href="{{ url('/adm/videos/del/'.$item['id']) }}"><i class="fas fa-trash-alt"></i></a>
                        </th>
                        <td><a href="{{ url('/adm/videos/edit/'.$item['id']) }}">{{ Helper::limitString($item['name'], 40) }}</a></td>
                        <td><a href="{{ url('/adm/videos/edit/'.$item['id']) }}">{{ $item['postedBy'] }}</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if ($acompanhe != null)
        {{ $acompanhe->links() }}
    @endif
