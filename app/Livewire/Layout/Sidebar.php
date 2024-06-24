<?php

namespace App\Livewire\Layout;
use Illuminate\Support\Facades\Route;

use Livewire\Component;

class Sidebar extends Component
{

    public $currentRoute;

    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();
    }

    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
