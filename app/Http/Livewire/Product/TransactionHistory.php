<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Transaction;

class TransactionHistory extends Component
{
    public function render()
    {
        $transactions = Transaction::all();
        return view('livewire.product.transaction',[
            'transactions' => $transactions,
        ]);
    }
}
