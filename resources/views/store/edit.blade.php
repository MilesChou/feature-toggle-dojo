<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>修改店家</title>
</head>
<body>
<form method="POST" action="{{ route('store.update', $store->id) }}">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <table style="width: 70%; margin-top:1em;">
        <thead>
        <tr>
            <th>店名</th>
            <th>描述</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td><input type="text" name="name" value="{{ $store->name }}"/></td>
            <td><input type="text" name="desc" value="{{ $store->desc }}"/></td>
        </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <input type="submit">
</form>
<a href="{{ route('store.index') }}">回首頁</a>
</body>
</html>
