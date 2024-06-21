<x-layouts>
    @slot('title')
        Kasir
    @endslot

    @section('content')
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif



        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p>
                                <h5 class="card-title">{{ $menu->price }}</h5>
                                <form action="{{ route('transactions.add_to_cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <div class="form-group">
                                        <label for="quantity-{{ $menu->id }}">Quantity:</label>
                                        <input type="number" name="quantity" id="quantity-{{ $menu->id }}"
                                            class="form-control" min="1" required>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <h2>Cart</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart', []) as $id => $details)
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ $details['price'] }}</td>
                            <td>{{ $details['price'] * $details['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Total:
                {{ array_sum(array_map(function ($item) {return $item['price'] * $item['quantity'];}, session('cart', []))) }}
            </h3>

            <form action="{{ route('transactions.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success" type="submit">Checkout</button>
            </form>
        </div>
    @endsection
</x-layouts>
