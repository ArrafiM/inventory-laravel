<?php

namespace App\Livewire\Pages\Item\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class SupplierIndex extends Component
{
    use LivewireAlert, WithPagination;

    protected $listeners = [
        'confirmed'
    ];

    public $supplier = null;
    public $search = '';

    public function render()
    {
        return view('livewire.pages.item.supplier.supplier',[
            'suppliers' => $this->allSupplier()
        ]);
    }

    public function allSupplier(){
        $data = Supplier::where('name', 'ilike', '%' . $this->search . '%')
                    ->paginate(10);
        return $data;
    }

    public function delete($id){
        $this->supplier = Supplier::find($id);
        if(!$this->supplier){
            $this->alert('info', "Supplier notfound!",[
                'position' => 'center'
            ]);
        }else{
            $this->alert('warning', "Are You sure to delete data [{$this->supplier->name}]", [
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
        Supplier::find($this->supplier->id)->delete();
        $this->alert('success', "Supplier data [{$this->supplier->name}] Deleted! ",[
            'timer' => 2000,
            'position' => 'center'
        ]);
        $this->supplier = null;
        return $this->redirectRoute('dashboard.item.supplier', [], true, navigate: true);
    }
}
