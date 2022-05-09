    <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col"><i class="fas fa-tools"></i></th>
            <th scope="col">Nome</th>
            <th scope="col">CRO</th>
            </tr>
        </thead>
        <tbody>
            @if ($acompanhe === null)
                <h3>Nada para mostrar</h3>
            @else
                <tr>
                    <th>
                        <a class="tools-icons" href="{{ url('/adm/equipe/edit/'.$new['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="tools-icons2" href="{{ url('/adm/equipe-apagar/'.$new['id']) }}"><i class="fas fa-trash-alt"></i></a>
                    </th>
                    <td><a href="{{ url('/adm/equipe/edit/'.$new['id']) }}">{{ Helper::limitString($new['title'], 40) }}</a></td>
                    <td><a href="{{ url('/adm/equipe/edit/'.$new['id']) }}">{{ $new['cro'] }}</a></td>
                </tr>
                
                @foreach ($acompanhe as $item)
                    <tr>
                        <th>
                            <a class="tools-icons" href="{{ url('/adm/equipe/edit/'.$item['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="tools-icons2" href="{{ url('/adm/equipe-apagar/'.$item['id']) }}"><i class="fas fa-trash-alt"></i></a>
                        </th>
                        <td><a href="{{ url('/adm/equipe/edit/'.$item['id']) }}">{{ Helper::limitString($item['title'], 40) }}</a></td>
                        <td><a href="{{ url('/adm/equipe/edit/'.$item['id']) }}">{{ $item['cro'] }}</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if ($acompanhe != null)
        {{ $acompanhe->links() }}
    @endif
