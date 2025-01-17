<?php

namespace App\Livewire\Pages\Item\Transaction;

use Livewire\Component;
use App\Models\StokTransaction;
use App\Models\Stok;
use App\Models\Item;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TransactionAction extends Component
{
    use LivewireAlert;

    public $showForm = false;
    public $item_id;
    public $status;
    public $qty;
    public $supplier_id;
    public $edit = false;
    public $transactionData = null;

    protected $rules = [
        'item_id' => 'required|integer|max:255',
        'status' => 'required|integer',
        'qty' => 'required|integer',
        'supplier_id' => 'nullable|integer',
    ];

    protected $listeners = ['openForm', 'editForm'];

    public function openForm()
    {
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->resetForm();
        $this->edit = false;
        $this->showForm = false;
        $this->transactionData = null;
        return $this->redirectRoute('dashboard.item.transaction', [], true, navigate: true);
    }

    public function submitForm()
    {
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $transactionData = [
            'item_id' => $this->item_id,
            'status' => $this->status,
            'qty' => $this->qty,
            'supplier_id' => $this->supplier_id ?? null
        ];
        // dd($transactionData);
        $item = Item::find($this->item_id);
        if(!$item) {
            $this->alertMessage('warning','Item not found!');
            return false;
        }
        if($this->status == 2){
            $cek = $this->cekStok($this->item_id);
            if(!$cek) return false;
        }
        $createCategory = StokTransaction::create($transactionData);
        $this->updateStok($this->item_id);
        $this->alert('success', 'Transaction Item Created!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
    }

    public function cekStok($itemId){
        $stok = Stok::query()->where('item_id',$itemId)->first();
        if(!$stok) {
            $this->alertMessage('warning','Item stok not found!');
            return false;
        }
        if($stok->total < $this->qty) {
            $this->alertMessage('warning','Item stok not enough!');
            return false;
        }
        return true;
    }

    public function alertMessage($status,$message){
        $this->alert($status, $message,[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
    }

    public function updateStok($itemId){
        $stok = Stok::query()->where('item_id',$itemId)->first();
        if(!$stok) return false;
        switch($this->status){
            case 1:
                $stok->total += $this->qty; break;
            case 2;
                $stok->total -= $this->qty; break;
        }
        $stok->save();
        return true;
    }

    public function editData(){
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $transactionData = StokTransaction::find($this->transactionData->id);
        if($this->item_id) $transactionData->item_id = $this->item_id;
        if($this->status) $transactionData->status = $this->status;
        if($this->qty) $transactionData->qty = $this->qty;
        if($this->supplier_id) $transactionData->supplier_id = $this->supplier_id;
        $transactionData->save();
        $this->alert('success', 'Transaction Item Updated!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.transaction', [], true, navigate: true);
    }

    private function resetForm()
    {
        $this->reset(['item_id', 'status','qty','supplier_id']);
    }

    public function render()
    {
        return view('livewire.pages.item.transaction.transaction-action');
    }

    public function editForm($id){
        $this->edit = true;
        $this->showForm = true;
        $transactionData = StokTransaction::find($id);
        $this->transactionData = $transactionData;
        $this->item_id = $transactionData->item_id;
        $this->status = $transactionData->status;
        $this->qty = $transactionData->qty;
        $this->supplier_id = $transactionData->supplier_id;
    }

}
