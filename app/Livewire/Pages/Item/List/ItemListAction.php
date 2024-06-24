<?php

namespace App\Livewire\Pages\Item\List;

use Livewire\Component;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Stok;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ItemListAction extends Component
{
    use LivewireAlert;

    public $showForm = false;
    public $name = '';
    public $description = '';
    public $type = '';
    public $selectedCategoryId;
    public $satuan = '';
    public $edit = false;
    public $items = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
        'satuan' => 'required|string',
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
        $this->items = null;
    }

    public function submitForm()
    {
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $items = [
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'satuan' => $this->satuan ?? null,
            'category_id' => $this->selectedCategoryId,
            'created_by' => auth()->user()->id,
        ];
        $createdItem = Item::create($items);
        $stok = [
            'item_id' => $createdItem->id,
            'total' => 0,
            'created_by' => auth()->user()->id,
        ];
        Stok::create($stok);
        $this->alert('success', 'Item Data Created!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.list', [], true, navigate: true);

    }

    public function editData(){
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $items = Item::find($this->items->id);
        if($this->name) $items->name = $this->name;
        if($this->description) $items->description = $this->description;
        if($this->type) $items->type = $this->type;
        if($this->selectedCategoryId) $items->category_id = $this->selectedCategoryId;
        if($this->satuan) $items->satuan = $this->satuan;
        $items->save();
        $this->alert('success', 'Item Data Updated!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.list', [], true, navigate: true);
    }

    private function resetForm()
    {
        $this->reset(['name', 'description','type','satuan']);
    }

    public function render()
    {
        return view('livewire.pages.item.list.item-list-action',[
            "categories" => $this->categories(),
        ]
    );
    }

    public function editForm($id){
        $this->edit = true;
        $this->showForm = true;
        $itemData = Item::find($id);
        $this->items = $itemData;
        $this->name = $itemData->name;
        $this->description = $itemData->description;
        $this->type = $itemData->type;
        $this->satuan = $itemData->satuan;
    }

    public function categories(){
        return ItemCategory::all();
    }

}
