<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $link;
    public $text;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param  string  $link
     * @param  string  $text
     * @param  string  $class
     * @return void
     */
    public function __construct($link, $text, $class)
    {
        $this->link = $link;
        $this->text = $text;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
