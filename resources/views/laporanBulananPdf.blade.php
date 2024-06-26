<!DOCTYPE html>
<html>

<head>
    <title>Monthly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Monthly Report for {{ \Carbon\Carbon::create()->month($month)->format('F') }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Transaction ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalAmount = 0; ?>
            <?php $counter = 1; ?>
            @foreach ($transactions as $transaction)
                <?php $totalAmount += $transaction->total; ?>
                <tr>
                    <td>{{$counter++}}</td>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->total }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <h3>Total: Rp. {{ number_format($totalAmount, 2) }}</h3>
    </table>
</body>

</html>
