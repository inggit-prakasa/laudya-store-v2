<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"></h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List Produk</h4>
                            <div class="col text-right">
                                <select name="" id="" class="form-control from-control-sm" style="font-size: 12px">
                                    <option value="" holder>Filter Category</option>
                                    <option value="1">All Category...</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>
                                    <input type="text" name="search" class="form-control form-control-sm col-sm-12 float-right"
                                           placeholder="Search Product..." onblur="this.form.submit()">
                                </label>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary btn-sm float-right btn-block">
                                    Cari Product
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            @foreach ($products as $product)
                                <div style="width: 21.5%;border:1px solid rgb(243, 243, 243)" class="m-2">
                                    <div class="productCard">
                                        <img class="card-img-top" src="{{ Storage::disk('s3')->url( $product->image ) }}" alt="{{ $product->name }}" style="height: 150px">
                                        <div class="card-body p-2">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">
                                                Sisa :
                                                {{ $product->quantity }}
                                                <br>
                                                <span style="color: #5C55BF">Rp. {{ number_format($product->price,2,',','.') }}</span>
                                            </p>
                                            <a class="btn btn-primary" wire:click="addCart({{$product}})">ADD</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Keranjang</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama produk</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Sub total</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($cartDatas as $index => $data)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td class="font-weight-bold">
                                            <button wire:click="decrementCart({{ $data['itemId'] }})" class="btn btn-sm btn-info mx-1" style="display: inline;padding:0.4rem 0.6rem!important"><i class="fas fa-minus"></i></button>
                                            <label>
                                                <input type="text" style="width:50px" value="{{ $data['quantity'] }}">
                                            </label>
                                            <button wire:click="incrementCart({{ $data['itemId'] }})" class="btn btn-sm btn-primary mx-1" style="display: inline;padding:0.4rem 0.6rem!important"><i class="fas fa-plus "></i></button>
                                        </td>
                                        <td class="text-right">Rp. {{ number_format($data['price'],2,',','.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Empty Cart</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <table class="table mt-5 table-borderless">
                            <tr>
                                <th>Total</th>
                                <th class="text-right font-weight-bold">Rp. {{ $total }}</th>
                            </tr>
                            <tr>
                                <th>Diskon</th>
                                <th class="text-right font-weight-bold">
                                    <input type="number" wire:model="discount" value="0" style="border-width:1px;text-align: right;border-color: #ccc">
                                </th>
                            </tr>
                            <tr>
                                <th>Bayar</th>
                                <th class="text-right font-weight-bold">
                                    <input type="number" wire:model="pay" value="0" style="border-width:1px;text-align: right;border-color: #ccc">
                                </th>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-sm-4">
                                <button class="btn btn-info btn-lg btn-block" style="padding:1rem!important" wire:click="clear" type="submit">Clear</button>
                            </div>
                            <div class="col-sm-4">
                                <a class="btn btn-primary btn-lg btn-block" style="padding:1rem!important" href="{{ route('transaction.history') }}" >History</a>
                            </div>
                            <div class="col-sm-4">
                                <button wire:click="save"  class="btn btn-success btn-lg btn-block" style="padding:1rem!important" data-toggle="modal" data-target="#fullHeightModalRight">Pay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
