<?php

namespace App\Livewire\Pages\Item\List;

use Livewire\Component;
use App\Models\Item;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class ItemListIndex extends Component
{
    use LivewireAlert, WithPagination;

    protected $listeners = [
        'confirmed'
    ];

    public $itemData = null;
    public $search = '';

    public function render()
    {
        return view('livewire.pages.item.list.item-list',[
            'items' => $this->allItem(),
        ]);
    }

    public function allItem(){
        $data = Item::where('name', 'ilike', '%' . $this->search . '%')
            ->with('category',function($query){
                $query->select('id','name');
            })
            ->with('stok',function($query){
                $query->select('id','item_id','total');
            })
            ->paginate(10);
        return $data;
    }

    public function delete($id){
        $this->itemData = Item::find($id);
        if(!$this->itemData){
            $this->alert('info', "Item notfound!",[
                'position' => 'center'
            ]);
        }else{
            $this->alert('warning', "Are You sure to delete data [{$this->itemData->name}]", [
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
        Item::find($this->itemData->id)->delete();
        $this->alert('success', "Item Data [{$this->itemData->name}] Deleted! ",[
            'timer' => 2000,
            'position' => 'center'
        ]);
        $this->itemData = null;
        return $this->redirectRoute('dashboard.item.list', [], true, navigate: true);
    }
}
