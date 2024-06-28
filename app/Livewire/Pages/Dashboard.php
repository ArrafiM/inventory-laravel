<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Item;
use App\Models\StokTransaction;
use App\Models\Stok;

class Dashboard extends Component
{

    public function render()
    {
        return view('livewire.pages.dashboard',[
            'summary' => $this->summary(),
            'transactions' => $this->allTransaction(),
        ]);
    }

    public function summary(){
        $item = count($this->item())?? 0;
        $trx = $this->transaction() ?? [];
        $stok = $this->stok() ?? [];
        $masuk = 0;
        $keluar = 0;
        foreach($trx as $res){
            if($res->status === 1) $masuk += $res->qty;
            else $keluar += $res->qty;
        }
        $totalStok = 0;
        foreach($stok as $res){
            $totalStok += $res->total;
        }
        $data = [
            'item' => $item, 'masuk' => $masuk, 
            'keluar' => $keluar, 'stok' => $totalStok
        ];
        return $data;
    }

    public function item(){
        return Item::all();
    }

    public function transaction(){
        return StokTransaction::all();
    }

    public function stok(){
        return Stok::all();
    }

    public function allTransaction(){
        $data = StokTransaction::query()
                ->with('item',function($query){
                    $query->select('id','name');
                })
                ->with('supplier',function($query){
                    $query->select('id','name');
                })
                ->orderBy('created_at','desc')
                ->limit(10)
                ->get();
        return $data;
    }
}
