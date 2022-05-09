
@php header("Content-type: application/msexcel") @endphp
<meta charset="utf-8">

@php header("Content-Disposition: attachment; filename=contatos.xls") @endphp

<table border="1" bordercolor="#000000">
    <tr>
        <td bgcolor="#99CCFF">Titulo</td>
        <td bgcolor="#99CCFF">Telefone</td>
        <td bgcolor="#99CCFF">Email</td>
        <td bgcolor="#99CCFF">Mensagem</td>
    </tr>

    @foreach ($excel as $rs)
        <tr>
            <td>{{ $rs['title'] }}</td>
            <td>{{ $rs["telephone"] }}</td>
            <td>{{ $rs["email"] }}</td>
            <td>{{ $rs["text"] }}</td>
        </tr>
    @endforeach
</table>