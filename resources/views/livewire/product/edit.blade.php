<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Produk</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Product</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit Produk</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Produk</div>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="update" re enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for = "name">Nama</label>
                                        <input type="text" wire:model="name" class="form-control" name="name" value="">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group">
                                        <label for="color">Warna</label>
                                        <select wire:model.lazy="color" class="form-control form-control-md" id="color" name="color">
                                            <option value="Merah">Merah</option>
                                            <option value="Kuning">Kuning</option>
                                            <option value="Hijau">Hijau</option>
                                            <option value="Ungu">Ungu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="size">Ukuran</label>
                                        <input wire:model="size" type="number" class="form-control" id="size" name="size">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group">
                                        <label for="category">Kategori</label>
                                        <select wire:model="category" class="form-control form-control-md" id="category" name="category">
                                            <option value="Hijab">Hijab</option>
                                            <option value="Celana" >Celana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for ="quantity">Stok</label>
                                        <input wire:model="quantity" type="number" class="form-control" name="quantity" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group">
                                        <label for ="price">Harga</label>
                                        <input wire:model="price" type="number" class="form-control" name="price" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for ="newquantity">Tambah/Kurangi (+/-) Stok</label>
                                        <input wire:model="newQuantity" type="number" class="form-control" name="newquantity" value="0">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea wire:model="description" class="form-control" id="description" rows="5" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-defult">
                                        <label for="image">Gambar</label>
                                        <br>
                                        @error('image') <span class="error">{{ $message }}</span> @enderror
                                        <input wire:model="imageNew" type="file" class="form-control dropzone" id="image" name="image" accept="image/*">
                                        @if ( $imageNew )
                                            <img src="{{ $imageNew->temporaryUrl()}}" class="w-50">
                                        @else
                                            <img src="{{ Storage::disk('s3')->url($image) }}" class="w-50">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">History Produk</div>
                    </div>
                    <div class="card-body">
                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">User</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Perubahan Stok</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($recordsHistory as $index => $item)
                                    <tr>
                                        <td> {{ $index + 1 }} </td>
                                        <td> {{ $name }} </td>
                                        <td> {{ $item->user_id }} </td>
                                        <td> {{ $item->quantity }} </td>
                                        <td> {{ $item->quantity_change }} </td>
                                        <td> {{ $item->type }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
