<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>店家管理</title>
</head>
<body>
<table style="width: 70%; margin-top:1em;">
    <thead>
    <tr>
        <th>#</th>
        <th>店名</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($stores as $store)
        <tr>
            <td>{{ $store->id }}</td>
            <td><a href="{{ route('store.show', $store->id) }}">{{ $store->name }}</a></td>
            <td>{{ $store->desc }}</td>
            <td><a href="{{ route('store.edit', $store->id) }}">修改</a></td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    </tfoot>
</table>
<a href="{{ route('store.create') }}">新增</a>
<a href="{{ route('store.index') }}">回首頁</a>
</body>
</html>
