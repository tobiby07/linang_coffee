<x-layouts>
    @slot('title')
        Kasir
    @endslot

    @section('content')
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" style="max-height: 10rem">
                            <form action="{{ route('menu.toggle-status', $menu->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <button class="{{ $menu->status ? 'btn btn-dark' : 'btn btn-danger' }}"
                                    type="submit">{{ $menu->status ? 'Tersedia' : 'Tidak Tersedia' }}</button>
                            </form> 
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text">{{ $menu->description }}</p>
                                <h5 class="card-title">{{ $menu->price }}</h5>
                                <form action="{{ route('transactions.add_to_cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                     
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary mb-2" type="button"
                                                id="minus-{{ $menu->id }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="string" name="quantity" id="quantity-{{ $menu->id }}"
                                            class="form-control mx-sm-3 mb-2"  min="1" value="1" required style="width: 10px" readonly
                                            {{ $menu->status ? '' : 'disabled' }}>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary mb-2" type="button"
                                                id="plus-{{ $menu->id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const quantityInput = document.getElementById('quantity-{{ $menu->id }}');
                                            const minusButton = document.getElementById('minus-{{ $menu->id }}');
                                            const plusButton = document.getElementById('plus-{{ $menu->id }}');

                                            minusButton.addEventListener('click', () => {
                                                let quantity = parseInt(quantityInput.value);
                                                if (quantity > 1) {
                                                    quantityInput.value = quantity - 1;
                                                }
                                            });

                                            plusButton.addEventListener('click', () => {
                                                let quantity = parseInt(quantityInput.value);
                                                quantityInput.value = quantity + 1;
                                            });
                                        });
                                    </script>
                                    <button class="btn btn-primary" type="submit"
                                        {{ $menu->status ? '' : 'disabled' }}>Add to Cart</button>
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
