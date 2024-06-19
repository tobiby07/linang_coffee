<x-layouts>
  @slot('title')
  MENU
  @endslot

  @section('content')
      <!-- Modal Form for Adding New Kategori -->
      <div class="modal fade" id="modalForm1" tabindex="-1" aria-labelledby="modalForm1Label" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalForm1Label">Tambah Kategori Baru</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" action="{{ route('kategori-menu.store') }}">
                          @csrf
                          <div class="mb-3">
                              <label for="name" class="form-label">Nama Kategori Baru</label>
                              <input type="text" class="form-control" id="name" name="name" aria-describedby="formInput1Help" required>
                              <small class="form-text text-muted" id="formInput1Help">Masukan Nama Kategori Baru</small>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Modal Form for Adding New Menu -->
      <div class="modal fade" id="modalForm2" tabindex="-1" aria-labelledby="modalForm2Label" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalForm2Label">Tambah Menu Baru</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                              <label for="name" class="form-label">Nama Menu</label>
                              <input type="text" class="form-control" id="name" name="name" aria-describedby="formInput2Help" required>
                              <small class="form-text text-muted" id="formInput2Help">Masukan Nama Menu</small>
                          </div>
                          <div class="mb-3">
                              <label for="kategori_menu_id" class="form-label">Kategori Menu</label>
                              <select class="form-select" id="kategori_menu_id" name="kategori_menu_id" required>
                                  <option selected disabled>Pilih Kategori</option>
                                  @foreach ($kategoriMenu as $kategori)
                                      <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="price" class="form-label">Harga</label>
                              <input type="number" class="form-control" id="price" name="price" aria-describedby="formInput3Help" required>
                              <small class="form-text text-muted" id="formInput3Help">Masukan Harga Menu</small>
                          </div>
                          <div class="mb-3">
                              <label for="description" class="form-label">Deskripsi</label>
                              <textarea class="form-control" id="description" name="description"></textarea>
                          </div>
                          <div class="mb-3">
                              <label for="image" class="form-label">Gambar</label>
                              <input type="file" class="form-control" id="image" name="image">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </form>         
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm1">Tambah Kategori Baru</button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm2">Tambah Menu Baru</button>

      <h1>Menu</h1>
    
      @if(session('success'))
          <p>{{ session('success') }}</p>
      @endif
  
      @if(session('error'))
          <p>{{ session('error') }}</p>
      @endif
  
      <h2>Kategori Menu</h2>
      <ul>
          @foreach($kategoriMenu as $kategori)
              <li>{{ $kategori->name }}</li>
          @endforeach
      </ul>
  
      <h2>Menu</h2>
      @if (isset($menu) && count($menu) > 0)
          <ul class="list-group">
              @foreach ($menu as $item)
                  <li class="list-group-item">
                      {{ $item->name }} - {{ $item->price }} - {{ $item->kategori->name }} - {{ $item->description }}
                      @if($item->image)
                          <br>
                          <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 100px;">
                      @endif
                  </li>
              @endforeach
          </ul>
      @else
          <p>Tidak ada menu yang ditemukan.</p>
      @endif
      
  @endsection
</x-layouts>
