<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>{{ $store->name }} 的店</title>
</head>
<body>
<table style="width: 70%; margin-top:1em;">
    <thead>
    <tr>
        <th>產品</th>
        <th>價錢</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($store->products as $product)
        <tr>
            <td><a href="{{ route('product.edit', $product->id) }}">{{ $product->name }}</a></td>
            <td>{{ $product->price }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    </tfoot>
</table>
<a href="{{ route('product.create', ['store_id' => $store->id]) }}">新增產品</a>
</body>
</html>
