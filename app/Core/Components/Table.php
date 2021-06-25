<?php

namespace App\Core\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public string $table;
    public array $columns;
    public array $items;
    public string $route;
    public bool $withActions;

    public function __construct(string $table, array $columns, array $items, string $route, bool $withActions)
    {
        $this->table = $table;
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
