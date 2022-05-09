    <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col"><i class="fas fa-tools"></i></th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Hora / data da publicação</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($acompanhe === null)
                <h3>Nada para mostrar</h3>
            @else
                <tr>
                    <th>
                        <a class="tools-icons" href="{{ url('/adm/acompanhe/edit/'.$new['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="tools-icons2" href="{{ url('/adm/novidades-apagar/'.$new['id']) }}"><i class="fas fa-trash-alt"></i></a>
                    </th>
                    <td><a href="{{ url('/adm/acompanhe/edit/'.$new['id']) }}">{{ Helper::limitString($new['title'], 40) }}</a></td>
                    <td><a href="{{ url('/adm/acompanhe/edit/'.$new['id']) }}">{{ $new['author'] }}</a></td>
                    <td><a href="{{ url('/adm/acompanhe/edit/'.$new['id']) }}">{{ $new['date']. " - ". $new['time'] }}</a></td>
                    <td>
                        <a style="color: white; font-weight: bolder;" href="{{ url('/adm/acompanhe/edit/'.$new['id']) }}">Conteúdo Atual</a>
                    </td>
                </tr>
                
                @foreach ($acompanhe as $item)
                    <tr>
                        <th>
                            <a class="tools-icons" href="{{ url('/adm/acompanhe/edit/'.$item['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="tools-icons2" href="{{ url('/adm/novidades-apagar/'.$item['id']) }}"><i class="fas fa-trash-alt"></i></a>
                        </th>
                        <td><a href="{{ url('/adm/acompanhe/edit/'.$item['id']) }}">{{ Helper::limitString($item['title'], 40) }}</a></td>
                        <td><a href="{{ url('/adm/acompanhe/edit/'.$item['id']) }}">{{ $item['author'] }}</a></td>
                        <td><a href="{{ url('/adm/acompanhe/edit/'.$item['id']) }}">{{ $item['date']. " - ". $item['time'] }}</a></td>
                        <td>
                            @if ($item['datePost'] > strtotime(date('Y/m/d H:i:d')))
                                <span class="text-danger">Conteúdo Pendente</span>
                            @else
                                <span class="text-success">Conteúdo Publicado</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if ($acompanhe != null)
        {{ $acompanhe->links() }}
    @endif
