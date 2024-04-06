<?php

namespace App\View\Components\inputs\text;

use Illuminate\View\Component;

class Editor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $toolbarClass;
    public $editorClass;

    public function __construct($toolbarClass, $editorClass)
    {
        $this->toolbarClass = $toolbarClass;
        $this->editorClass = $editorClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return 'components.inputs.text.editor';
    }
}
