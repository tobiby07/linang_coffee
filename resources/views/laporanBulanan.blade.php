<x-layouts>
    @slot('title')
    Dashboard
@endslot
@section('content')
<div class="container">
    <h1>Monthly Report</h1>
    <form method="GET" action="{{ route('laporanBulanan') }}"
        <div class="form-group">
            <label for="month">Select Month</label>
            <select name="month" id="month" class="form-control">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="btn btn-primary">View Report</button>
        <a href="{{ route('reports.monthly.download', ['month' => $month]) }}" class="btn btn-danger">Download PDF</a>
    </form>
    <br>
    <table class="table table-striped">
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
                <td>{{ $counter++ }}</td>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->total }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total: Rp. {{ number_format($totalAmount, 2) }}</h3>
    <a class="btn btn-primary mb-3 mt-2" href="/laporan">Kembali</a>
</div>
@endsection
</x-layouts>