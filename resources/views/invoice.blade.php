<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
</head>

<body>
    <center><img src="assets/images/black.png" style="max-width: 5rem"></center>
    <p>Jl.Kalimalang Blitar Jawa Timur</p>
    <h1>Invoice</h1>
    <p style="text-transform: uppercase"><strong style="text-transform: capitalize">Kasir:</strong> {{ $transaction->user->name }}</p>
    <p><strong>Total:</strong>Rp. {{ $transaction->total }}</p>
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
            @foreach ($cart as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>{{ $details['price'] }}</td>
                    <td>{{ $details['price'] * $details['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><center>Password Wifi : AkuSukamu</center></p>
    <p><center>Pengaduan 098789987766</center></p>
</body>

</html>
