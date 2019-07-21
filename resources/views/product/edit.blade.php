<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>修改產品</title>
</head>
<body>
<form method="POST" action="{{ route('product.update', $product->id) }}">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <table style="width: 70%; margin-top:1em;">
        <thead>
        <tr>
            <th>產品</th>
            <th>價錢</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td><input type="text" name="name" value="{{ $product->name }}"/></td>
            <td><input type="text" name="price" value="{{ $product->price }}"/></td>
        </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <input type="submit">
</form>
</body>
</html>
