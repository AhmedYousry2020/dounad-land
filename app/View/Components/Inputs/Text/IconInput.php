<?php

namespace App\View\Components\inputs\text;

use Illuminate\View\Component;

class IconInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $inputclass;
    public $hasLabel;
    public $icon;
    public $label;

    public function __construct($name, $icon = 'keyboard', $label = '', $inputclass = '')
    {
        $this->inputclass = $inputclass;
        $this->name = $name;
        $this->hasLabel = !empty($label);
        $this->label = $label;
        $this->icon = $icon;
    }

    public function hasLabel()
    {
        return $this->hasLabel ? "<label for='$this->name' class='form-label'>" . __($this->label) . "</label>" : null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (isset($data['attributes']['placeholder'])) {
                $data['attributes']["placeholder"] = __($data['attributes']['placeholder']);
            }

            return 'components.inputs.text.iconInput';
        };
    }
}
