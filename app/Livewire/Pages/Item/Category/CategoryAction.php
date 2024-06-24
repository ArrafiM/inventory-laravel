<?php

namespace App\Livewire\Pages\Item\Category;

use Livewire\Component;
use App\Models\ItemCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CategoryAction extends Component
{
    use LivewireAlert;

    public $showForm = false;
    public $name = '';
    public $description = '';
    public $edit = false;
    public $category = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
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
        $this->category = null;
    }

    public function submitForm()
    {
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $category = [
            'name' => $this->name,
            'description' => $this->description
        ];
        $createCategory = ItemCategory::create($category);
        $this->alert('success', 'Category Item Created!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.category', [], true, navigate: true);

    }

    public function editData(){
        $this->validate();
        // Handle form submission, e.g., save data to the database
        $category = ItemCategory::find($this->category->id);
        if($this->name) $category->name = $this->name;
        if($this->description) $category->description = $this->description;
        $category->save();
        $this->alert('success', 'Category Item Updated!',[
            'timer' => 6000,
            'position' => 'top-end'
        ]);
        // Close the form after submission
        $this->closeForm();
        return $this->redirectRoute('dashboard.item.category', [], true, navigate: true);
    }

    private function resetForm()
    {
        $this->reset(['name', 'description']);
    }

    public function render()
    {
        return view('livewire.pages.item.category.category-action');
    }

    public function editForm($id){
        $this->edit = true;
        $this->showForm = true;
        $categoryData = ItemCategory::find($id);
        $this->category = $categoryData;
        $this->name = $categoryData->name;
        $this->description = $categoryData->description;
    }

}
