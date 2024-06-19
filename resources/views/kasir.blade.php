<x-layouts>
    @slot('title')
    Kasir
    @endslot

    @section('content')
    <div class="container">
        <h2>Kasir</h2>
    
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('transactions.store') }}">
            @csrf
    
            <div class="form-group">
                <label for="menu">Menu</label>
                <select class="form-control" id="menu" name="items[0][menu_id]">
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }} - {{ $menu->price }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="items[0][quantity]" min="1" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Proses</button>
        </form>
    </div>
    @endsection

</x-layouts>