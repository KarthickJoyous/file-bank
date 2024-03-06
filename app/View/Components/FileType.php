<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileType extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $fileType)
    {
        $this->fileType = $fileType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-type');
    }
}
