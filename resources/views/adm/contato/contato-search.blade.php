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
        @if (count($contatos) <= 0)
            <h2>Nada para mostrar</h2>
        @else
            @foreach ($contatos as $contato)
                <tr>
                    <th>
                        <a class="tools-icons" href="{{ url('/adm/contato/editar/'.$contato['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                        <a class="tools-icons2" href="{{ url('/adm/contato/delete/'.$contato['id']) }}"><i class="fas fa-trash-alt"></i></a>
                    </th>
                    <td><a href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ Helper::limitString($contato['title'], 30) }}</a></td>
                    <td><a href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['telephone'] }}</a></td>
                    <td><a href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['date'] . " - ".Helper::noSeg($contato['time'])}}</a></td>
                    <td>
                        @if ($contato['status'] == "Não lido")
                            <a style="color: red; font-weight: bolder;" href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['status'] }}</a>
                        @else 
                            <a style="color: white; font-weight: bolder;" href="{{ url('/adm/contato/editar/'.$contato['id']) }}">{{ $contato['status'] }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{ $contatos->links() }}
<a class="btn btn-success" href="{{ url('/adm/home') }}" download="contatosexl.xls"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Gerar Relatório Excel</a>