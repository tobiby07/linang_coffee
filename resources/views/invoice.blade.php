<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice</h1>
    <p><strong>User:</strong> {{ $transaction->user->name }}</p>
    <p><strong>Total:</strong> {{ $transaction->total }}</p>
    <p><strong>Date:</strong> {{ $transaction->created_at }}</p>

    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>{{ $details['price'] }}</td>
                    <td>{{ $details['price'] * $details['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
