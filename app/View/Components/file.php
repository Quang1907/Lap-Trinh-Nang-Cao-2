<?php

namespace App\View\Components;

use Illuminate\View\Component;

class file extends Component
{
    public $id;
    public $title;
    public $fieldId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $fieldId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->fieldId = $fieldId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file');
    }
}
