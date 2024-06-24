<?php

namespace App\Livewire\Pages\Item\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SupplierAction extends Component
{
    use LivewireAlert;

    public $showForm = false;
    public $name = '';
    public $address;
    public $phone;
    public $email;
    public $edit = false;
    public $supplier = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
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
        $this->supplier = null;
    }

    public function submitForm()
    {
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $supplier = [
            'name' => $this->name,
            'address' => $this->address ?? null,
            'phone' => $this->phone ?? null,
            'email' => $this->email ?? null,
        ];
        $createSupplier = Supplier::create($supplier);
        $this->alert('success', 'Supplier Item Created!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.supplier', [], true, navigate: true);

    }

    public function editData(){
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $supplier = Supplier::find($this->supplier->id);
        if($this->name) $supplier->name = $this->name;
        if($this->address) $supplier->address = $this->address;
        if($this->phone) $supplier->phone = $this->phone;
        if($this->email) $supplier->email = $this->email;
        $supplier->save();
        $this->alert('success', 'Supplier Item Updated!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.supplier', [], true, navigate: true);
    }

    private function resetForm()
    {
        $this->reset(['name', 'address', 'phone', 'email']);
    }

    public function render()
    {
        return view('livewire.pages.item.supplier.supplier-action');
    }

    public function editForm($id){
        $this->edit = true;
        $this->showForm = true;
        $supplierData = Supplier::find($id);
        $this->supplier = $supplierData;
        $this->name = $supplierData->name;
        $this->address = $supplierData->address;
        $this->phone = $supplierData->phone;
        $this->email = $supplierData->email;
    }

}
