<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Folder extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $folder, public $index = null)
    {
        $this->folder = $folder;

        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.folder');
    }
}
