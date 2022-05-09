
    <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col"><i class="fas fa-tools"></i></th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Hora / data</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if (count($news) <= 0)
                <h2>Nada para mostrar</h2>
            @else
                @foreach ($news as $item)
                    <tr>
                        <th>
                            <a class="tools-icons" href="{{ url('/adm/news/editar/'.$item['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="tools-icons2" href="{{ url('/adm/news/delete/'.$item['id']) }}"><i class="fas fa-trash-alt"></i></a>
                        </th>
                        <td><a href="{{ url('/adm/news/editar/'.$item['id']) }}">{{ Helper::limitString($item['title'], 30) }}</a></td>
                        <td><a href="{{ url('/adm/news/editar/'.$item['id']) }}">{{ $item['telephone'] }}</a></td>
                        <td><a href="{{ url('/adm/new/editar/'.$item['id']) }}">{{ $item['date'] .' - '. $item['time']}}</a></td>
                        <td>
                            @if ($item['status'] == "Não lido")
                                <a style="color: red; font-weight: bolder;" href="{{ url('/adm/news/editar/'.$item['id']) }}">{{ $item['status'] }}</a>
                            @else 
                                <a style="color: white; font-weight: bolder;" href="{{ url('/adm/news/editar/'.$item['id']) }}">{{ $item['status'] }}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $news->links() }}
    <a class="btn btn-success" href="{{ url('/adm/home') }}" download="newsexl.xls"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Gerar Relatório Excel</a>
