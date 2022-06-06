<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $id;
    public $name;
    public $type;
    public $place;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $type, $place, $value)
    {
        $this->id = $id;
        $this->value = $value;
        $this->name = $name;
        $this->type = $type;
        $this->place = $place;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
