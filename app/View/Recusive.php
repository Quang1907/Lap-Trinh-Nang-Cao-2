<?php

namespace App\view;

class Recusive
{
    protected $htmlSelect;
    protected $categories;
    public function __construct($categories)
    {
        $this->categories = $categories;
        $this->htmlSelect = '';
    }
    public function show($select, $id = 0, $text = '')
    {
        foreach ($this->categories as $category) {
            if ($category->parent_id == $id) {
                if ($category->id == $select) {
                    $this->htmlSelect .= '<option value="' . $category->id . '" selected>' . $text . $category->name . '</option>';
                } else {
                    $this->htmlSelect .= '<option value="' . $category->id . '">' . $text . $category->name . '</option>';
                }
                $this->show($select, $category->id, $text . '--');
            }
        }
        return $this->htmlSelect;
    }
    
}
