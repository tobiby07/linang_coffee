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
                <div class="col-md-8" style="max-height: 80vh; overflow-y: auto;">
                   @foreach ($kategoriMenus as $category)
                        <h4>{{ $category->name }}</h4>
                        <div class="row">
                            @foreach ($category->menus as $menu)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
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
                                            <h5 class="card-title">Rp.{{ $menu->price }}</h5>
                                            <form action="{{ route('transactions.add_to_cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-primary mb-2" type="button"
                                                        id="minus-{{ $menu->id }}" {{ $menu->status ? '' : 'disabled' }} >
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="text" name="quantity" id="quantity-{{ $menu->id }}"
                                                        class="form-control mx-sm-3 mb-2" min="1" value="1" required style="width: 60px" readonly
                                                        {{ $menu->status ? '' : 'disabled' }}>
                                                    <button class="btn btn-primary mb-2" type="button"
                                                        id="plus-{{ $menu->id }}" {{ $menu->status ? '' : 'disabled' }} >
                                                        <i class="fas fa-plus"  ></i>
                                                    </button>
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
                                                    {{ $menu->status ? '' : 'disabled' }}> <i class="fa fa-cart-arrow-down"></i> Add to Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h2>Cart</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('cart', []) as $id => $details)
                                <tr>
                                    <td>{{ $details['name'] }}</td>
                                    <td>{{ $details['quantity'] }}</td>
                                    <td>Rp.{{ $details['price'] }}</td>
                                    <td>Rp.{{ $details['price'] * $details['quantity'] }}</td>
                                    <td>
                                        <form action="{{ route('transactions.remove_from_cart', $id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3>Total: Rp.
                        {{ array_sum(array_map(function ($item) { return $item['price'] * $item['quantity']; }, session('cart', []))) }}
                    </h3>

                    <form action="{{ route('transactions.checkout') }}" method="POST">
                        @csrf
                        <button class="btn btn-success" type="submit">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-layouts>
