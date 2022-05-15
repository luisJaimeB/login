<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">producto</th>
                <th scope="col">Ventas</th>
                <th scope="col">Cantidad vendida</th>
                <th scope="col">Valor de venta</th>
                <th scope="col">Fecha del producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->invoices->count() }}</td>
                    <td>{{ $product->invoices->sum('pivot.quantity') }}</td>
                    <td>{{ $product->invoices->sum('pivot.subtotal') }}</td>
                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
