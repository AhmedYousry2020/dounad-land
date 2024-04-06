<?php

namespace App\View\Components\inputs\select;

use Illuminate\View\Component;

class CaregoryInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $name;
     public $inputclass;
     public $hasLabel;
     public $options;
     public $label;

     public function __construct($name, $options = [], $label = '', $inputclass = '')
     {
         $this->inputclass = $inputclass;
         $this->name = $name;
         $this->hasLabel = !empty($label);
         $this->label = $label;
         $this->options = $options;
         info('im here');
     }
 
     public function label()
     {
 
         return $this->hasLabel ? "<label for='$this->name' class='form-label'>". __($this->label) . "</label>" : null;
     }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.select.categoryInput');
    }
}
