<?php

namespace App\Core\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $type = 'text';
    public string $value = '';

    public function __construct(string $name, string $type = 'text', string $value = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function render(): View
    {
        return view('Core::components.input');
    }
}
