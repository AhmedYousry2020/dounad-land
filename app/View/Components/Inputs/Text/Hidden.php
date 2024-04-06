<?php

namespace App\View\Components\inputs\text;

use Illuminate\View\Component;

class Hidden extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $inputclass;
    public $hasLabel;

    public function __construct($name,$label = '', $inputclass = '')
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.text.hidden');
    }
}
