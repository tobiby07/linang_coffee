<x-layouts>
    @slot('title')
        MENU
    @endslot

    @section('content')
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm1">Tambah kategori
                Baru</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm2">Tambah Menu
                Baru</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKategoriModal">Edit
                Kategori</button>

            <div class="row mt-4">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $item)
                                <tr>
                                    <td>{{ $item->kategori->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editMenuModal{{ $item->id }}">Edit</button>
                                        <form action="{{ route('menu.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Form for Adding New Menu -->
                                <div class="modal fade" id="modalForm2" tabindex="-1" aria-labelledby="modalForm2Label"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalForm2Label">Tambah Menu Baru</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('menu.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Menu</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" aria-describedby="formInput2Help" required>
                                                        <small class="form-text text-muted" id="formInput2Help">Masukan Nama
                                                            Menu</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kategori_menu_id" class="form-label">Kategori
                                                            Menu</label>
                                                        <select class="form-select" id="kategori_menu_id"
                                                            name="kategori_menu_id" required>
                                                            <option selected disabled>Pilih Kategori</option>
                                                            @foreach ($kategoriMenu as $kategori)
                                                                <option value="{{ $kategori->id }}">{{ $kategori->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="price"
                                                            name="price" aria-describedby="formInput3Help" required>
                                                        <small class="form-text text-muted" id="formInput3Help">Masukan
                                                            Harga Menu</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="description" name="description"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Gambar</label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Menu Modal -->
                                <div class="modal fade" id="editMenuModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('menu.update', $item->id) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Menu</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kategori_menu_id" class="form-label">Kategori
                                                            Menu</label>
                                                        <select class="form-select" id="kategori_menu_id"
                                                            name="kategori_menu_id" required>
                                                            @foreach ($kategoriMenu as $kategori)
                                                                <option value="{{ $kategori->id }}"
                                                                    @if ($kategori->id == $item->kategori_menu_id) selected @endif>
                                                                    {{ $kategori->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="price"
                                                            name="price" value="{{ $item->price }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="description" name="description">{{ $item->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Gambar</label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image">
                                                        @if ($item->image)
                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                alt="{{ $item->name }}" width="100">
                                                        @endif
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Form for Adding New Kategori -->
            <div class="modal fade" id="modalForm1" tabindex="-1" aria-labelledby="modalForm1Label"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalForm1Label">Tambah Kategori Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('kategori-menu.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Kategori Baru</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
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

            <!-- Modal Form for Editing Kategori -->
            <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" id="editKategoriForm">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="existingCategory" class="form-label">Existing Categories</label>
                                    <select name="existingCategory" id="existingCategory" class="form-control" required
                                        onchange="updateCategoryName(this)">
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        @foreach ($kategoriMenu as $category)
                                            <option value="{{ $category->id }}" data-name="{{ $category->name }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editKategoriName" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" id="editKategoriName" name="name"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function updateCategoryName(selectElement) {
                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                    const selectedName = selectedOption.getAttribute('data-name');
                    const selectedId = selectedOption.value;

                    document.getElementById('editKategoriName').value = selectedName;
                    document.getElementById('editKategoriForm').action = '/kategori-menu/' + selectedId;
                }
            </script>
            
        @endsection
</x-layouts>
