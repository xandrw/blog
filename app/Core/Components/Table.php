<?php

namespace App\Core\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public string $name;
    public array $columns;
    public array $items;
    public string $route;
    public bool $withActions;

    public function __construct(string $name, array $columns, array $items, string $route, bool $withActions)
    {
        $this->name = $name;
        $this->columns = $columns;
        $this->items = $items;
        $this->route = $route;
        $this->withActions = $withActions;
    }

    public function render(): View
    {
        return view('Core::components.table');
    }
}
