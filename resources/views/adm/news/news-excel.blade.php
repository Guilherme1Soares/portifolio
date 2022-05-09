@php header("Content-type: application/msexcel") @endphp
<meta charset="utf-8">

@php header("Content-Disposition: attachment; filename=news.xls") @endphp

<table border="1" bordercolor="#000000">
    <tr>
        <td bgcolor="#99CCFF">Nome</td>
        <td bgcolor="#99CCFF">Telefone</td>
    </tr>

    @foreach ($excels as $rs)
        <tr>
            <td>{{ $rs['title'] }}</td>
            <td>{{ $rs["telephone"] }}</td>
        </tr>
    @endforeach
</table>