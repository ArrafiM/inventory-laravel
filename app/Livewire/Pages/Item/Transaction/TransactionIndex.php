<?php

namespace App\Livewire\Pages\Item\Transaction;

use Livewire\Component;
use App\Models\StokTransaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class TransactionIndex extends Component
{
    use LivewireAlert, WithPagination;

    protected $listeners = [
        'confirmed'
    ];

    public $transactionData = null;
    public $search = '';

    public function render()
    {
        return view('livewire.pages.item.transaction.transaction-index',[
            'transactions' => $this->allTransaction()
        ]);
    }

    public function allTransaction(){
        $data = StokTransaction::where('item_id', 'ilike', '%' . $this->search . '%')
                ->with('item',function($query){
                    $query->select('id','name');
                })
                ->with('supplier',function($query){
                    $query->select('id','name');
                })
                ->paginate(10);
        return $data;
    }

    public function delete($id){
        $this->transactionData = StokTransaction::find($id);
        if(!$this->transactionData){
            $this->alert('info', "Transaction notfound!",[
                'position' => 'center'
            ]);
        }else{
            $this->alert('warning', "Are You sure to delete data [{$this->transactionData->name}]", [
                'showDenyButton' => true,
                'denyButtonText' => 'Yes',
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancel',
                'onDenied' => 'confirmed',
                'onDismissed' => 'cancelled',
                'timer' => null,
                'position' => 'center'
            ]);
        }
    }

    public function confirmed()
    {
        StokTransaction::find($this->transactionData->id)->delete();
        $this->alert('success', "Transaction Item [{$this->transactionData->name}] Deleted! ",[
            'timer' => 2000,
            'position' => 'center'
        ]);
        $this->transactionData = null;
        return $this->redirectRoute('dashboard.item.transaction', [], true, navigate: true);
    }
}
