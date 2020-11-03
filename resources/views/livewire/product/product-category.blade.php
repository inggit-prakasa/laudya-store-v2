<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kategori</h4>
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
                    <a href="#">Kategori</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-6">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Buat Kategori</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-show-validation row">
                            <label for="name" class="col-lg-2 mt-sm-2 text-left">Nama Kategori</label>
                            <div class="col-lg-4 col-md-9 col-sm-8">
                                <input wire:model="name" type="text" class="form-control" id="name" name="name" placeholder="Masukan kategori" required>
                            </div>
                            <div class="col-lg-2 col-md-9 col-sm-8 primary">
                                @if($isUpdate)
                                <input wire:click="update" type="submit" class="form-control btn btn-primary" value="Update"  id="name" name="name">
                                @else
                                <input wire:click="create" type="submit" class="form-control btn btn-primary" value="Kirim" id="name" name="name">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List Kategori</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 80px">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center" style="width: 200px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $category->name }} </td>
                                    <td>
                                        <button wire:click="edit({{ $category->id }})" type="submit" class="btn btn-info btn-sm">EDIT</button>
                                        <button wire:click="delete({{ $category->id }})" type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                    </td>
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

