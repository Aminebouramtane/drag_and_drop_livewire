<?php

namespace App\Livewire;

use App\Models\Datatable;
use Livewire\Component;

class Counter extends Component
{
    public $list1 = [];
    public $list2 = [];

    public function mount()
    {
        $this->list1 = Datatable::where('list', 1)->get();
        $this->list2 = Datatable::where('list', 2)->get();
    }

    public function moveItem($fromListIndex, $item)
    {
        $itemToMove = $this->{$fromListIndex}[$item];
        if ($itemToMove->list == 1) {
            $itemToMove->update(['list' => 2]);
            $this->{$fromListIndex} = $this->{$fromListIndex}->reject(function ($value) use ($itemToMove) {
                return $value->id === $itemToMove->id;
            });
            $this->list1 = Datatable::where('list', 1)->get();
            $this->list2 = Datatable::where('list', 2)->get();
        }else{
            $itemToMove->update(['list' => 1]);
                $this->{$fromListIndex} = $this->{$fromListIndex}->reject(function ($value) use ($itemToMove) {
                return $value->id === $itemToMove->id;
            });
            $this->list1 = Datatable::where('list', 1)->get();
            $this->list2 = Datatable::where('list', 2)->get();
        }
    }

 
    public function render()
    {
        return view('livewire.counter');
    }
}
