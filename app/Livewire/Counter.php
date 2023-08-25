<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $list1 = ['Item 1', 'Item 2', 'Item 3'];
    public $list2 = [];

    public function moveItem($fromList, $item)
    {
        $itemIndex = array_search($item, $this->$fromList);
        if ($itemIndex !== false) {
            array_splice($this->$fromList, $itemIndex, 1);
            array_push($this->list2, $item);
        }
    }

 
    public function render()
    {
        return view('livewire.counter');
    }
}
