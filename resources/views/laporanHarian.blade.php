<x-layouts>
    @slot('title')
        LAPORAN HARIAN
    @endslot
    @section('content')
        <div class="container">
            <h1>Laporan Harian</h1>
            <table class="table table-striped">
                <a class="btn btn-primary mb-3 mt-2" href="/laporanBulanan">Laporan Bulanan</a>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Transaction ID</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Created At</th>
                        <th>Details</th>
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
                            <td>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#details-{{ $transaction->id }}" aria-expanded="false"
                                    aria-controls="details-{{ $transaction->id }}">
                                    View Details
                                </button>
                            </td>
                        </tr>
                        <tr class="collapse" id="details-{{ $transaction->id }}">
                            <td colspan="5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Menu Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->items as $item)
                                            <tr>
                                                <td>{{ $item->menu->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total: Rp. {{ number_format($totalAmount, 2) }}</h3>
        </div>
    @endsection
</x-layouts>
