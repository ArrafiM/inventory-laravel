<?php

namespace App\Livewire\Pages\Item\Category;

use Livewire\Component;
use App\Models\ItemCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use LivewireAlert, WithPagination;

    protected $listeners = [
        'confirmed'
    ];

    public $category = null;
    public $search = '';

    public function render()
    {
        return view('livewire.pages.item.category.category',[
            'categories' => $this->allCategory()
        ]);
    }

    public function allCategory(){
        $data = ItemCategory::where('name', 'ilike', '%' . $this->search . '%')
                ->paginate(10);
        return $data;
    }

    public function delete($id){
        $this->category = ItemCategory::find($id);
        if(!$this->category){
            $this->alert('info', "Category notfound!",[
                'position' => 'center'
            ]);
        }else{
            $this->alert('warning', "Are You sure to delete data [{$this->category->name}]", [
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
        ItemCategory::find($this->category->id)->delete();
        $this->alert('success', "Category Item [{$this->category->name}] Deleted! ",[
            'timer' => 2000,
            'position' => 'center'
        ]);
        $this->category = null;
        return $this->redirectRoute('dashboard.item.category', [], true, navigate: true);
    }
}
