<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class HiddenCounter extends Component
{
    public $type;
    public $counter_class;
    public $counter_name;
    public $old_default = 1;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $type = 'hidden',
        $class = 'counter-rows',
        $name = 'counter_length',
        $old = 1
    ) {
        $this->type = $type;
        $this->counter_class = $class;
        $this->counter_name = $name;
        if($old) {
            $this->old_default = $old;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.hidden-counter');
    }
}
