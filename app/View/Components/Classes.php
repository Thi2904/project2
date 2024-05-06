<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Classes extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(

        public string $titleName = '',
        public string $className = '',
        public string $grade = '',
        public string $totalName = '',
        public string $totalResult = '',
        public string $linkBtn = '',
        public string $nameBtn = '',
        public string $linkDetails = '',
        public string $nameLink = '',
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.classes');
    }
}
