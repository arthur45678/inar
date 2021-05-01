<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Ckeditor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public  $name;
    public  $value;

    public function __construct($name, $value = false)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       $name = $this->name;
       $value = $this->value;
       return view('components.forms.ckeditor',compact('name','value'));
    }
}
