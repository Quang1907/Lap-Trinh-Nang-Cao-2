<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $name;
    public $select;
    public $title;
    public $button;
    public $idModal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $title, $button, $select, $idModal)
    {
        $this->name = $name;
        $this->select = $select;
        $this->title = $title;
        $this->button = $button;
        $this->idModal = $idModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
