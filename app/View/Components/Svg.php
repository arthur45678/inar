<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Svg extends Component
{

    public $icon;
    public $sidebarIcon;

    /**
     * Create a new component instance.
     * param string $icon
     * param bool $sidebarIcon
     *
     * @return void
     */
    public function __construct($icon, $sidebarIcon = false)
    {
        $this->icon = $icon;
        $this->sidebarIcon = $sidebarIcon;
    }

    public function getClassName()
    {
        return $this->sidebarIcon ? "c-sidebar-nav-icon" : "c-icon";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.svg');
    }
}
