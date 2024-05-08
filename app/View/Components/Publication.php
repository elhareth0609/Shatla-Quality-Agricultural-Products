<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Publication extends Component
{

    public $publication;

    /**
     * Create a new component instance.
     *
     * @param $product
     */
    public function __construct($publication)
    {
        $this->publication = $publication;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.publication');
    }
}
