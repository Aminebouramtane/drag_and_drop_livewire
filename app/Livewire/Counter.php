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

        if ($itemToMove) {
            // Update the item's list attribute in the database
            // dd($itemToMove);
            $itemToMove->update(['list' => 2]);

            // Remove the item from List 1
            $this->{$fromListIndex} = $this->{$fromListIndex}->reject(function ($value) use ($itemToMove) {
                return $value->id === $itemToMove->id;
            });

            // Refresh list from the database (optional, if needed)
            $this->list1 = Datatable::where('list', 1)->get();
            $this->list2 = Datatable::where('list', 2)->get();
        }
    }

 
    public function render()
    {
        // $this->list1 = Datatable::all();
        return view('livewire.counter');
    }
}
