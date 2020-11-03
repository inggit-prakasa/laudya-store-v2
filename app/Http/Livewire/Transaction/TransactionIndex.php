<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\ProductTransaction;
use App\Models\Transaction;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Storage;

class TransactionIndex extends Component
{
    public $cartData = [];
    protected $idUser = 1;
    public $discount;
    public $pay;
    public $url;


    public function addCart($product) {
        Cart::session($this->idUser)->add([
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
        ]);
    }

    public function clear() {
        Cart::session($this->idUser)->clear();
    }

    public function incrementCart($id) {
        $product = Product::find($id);
        $cart = Cart::session($this->idUser)->get($id);
        if ($cart->quantity < $product->quantity) {
            Cart::session($this->idUser)->update($id,[
                'quantity' => [
                    'relative' => true,
                    'value' => 1,
                ],
            ]);
        } else {
            dd('kelebihan');
        }
    }

    public function decrementCart($id) {
        $cart = Cart::session($this->idUser)->get($id);

        if ($cart) {
            if( $cart->quantity <= 1) {
                Cart::session($this->idUser)->remove($id);
            } else {
                Cart::session($this->idUser)->update($id,[
                    'quantity' => [
                        'relative' => true,
                        'value' => -1,
                    ],
                ]);
            }
        }
    }

    public function save () {
        $carts = Cart::session($this->idUser);
        $total = $carts->getTotal();
        $cartData = $carts->getContent();
        $change = $this->pay - $total + $this->discount;

        if ($change < 0) {
            dd('Uangnya kurang Bos');
        }

        $invoices_number = IdGenerator::generate(['table' => 'transaction', 'length' => 10, 'prefix' =>'INV-', 'field' => 'invoices_number'],);

        Transaction::create([
            'invoices_number' => $invoices_number,
            'user_id' => $this->idUser,
            'pay' => $this->pay,
            'total' => $total
        ]);

        foreach ($cartData as $cart) {
            $product = Product::find($cart['id']);

            ProductHistory::create([
                'product_id' => $cart['id'],
                'user_id' => $this->idUser,
                'quantity' => $product->quantity,
                'quantity_change' => -$cart['quantity'],
                'type' => 'TR'
            ]);

            ProductTransaction::create([
                'product_id' => $cart['id'],
                'invoices_number' => $invoices_number,
                'quantity' => $cart['quantity'],
            ]);

            $product->decrement('quantity',$cart['quantity']);
        }

        $carts->clear();
        $this->pay = 0;
        $this->discount = 0;
    }

    public function render()
    {
        $products = Product::all();
        $items = Cart::session($this->idUser)->getContent();

        if(Cart::isEmpty()){
            $cart_data = [];
        } else {
            foreach($items as $item) {
                $cart[] = [
                    'itemId' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }
            $cart_data = collect($cart);
        }

        $total = Cart::session($this->idUser)->getTotal();

        return view('livewire.transaction.index',[
            'products' => $products,
            'cartDatas' => $cart_data,
            'total' => $total
        ]);
    }
}
