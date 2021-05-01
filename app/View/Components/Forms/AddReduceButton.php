<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class AddReduceButton extends Component
{
    public $type_class;
    public $data_row;
    public $icon;
    public $data_limit;
    public $classes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $dataRow = ".data-row", $dataLimit = null, $classes = "")
    {
        if ($type === 'add') {
            $this->type_class = 'btn-add-row';
            $this->icon = 'cui-plus';
        } elseif ($type === 'reduce') {
            $this->type_class = 'btn-reduce-row';
            $this->icon = 'cui-minus';
        } else {
            $this->type_class = $type;
            $this->icon = 'cui-clock';
        }
        $this->data_row = $dataRow;
        $this->data_limit = $dataLimit;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.add-reduce-button');
    }
}
