<?php


namespace App\Admin;


class SidebarStore
{
    private array $items = [];

    public function items(): array
    {
        return $this->items;
    }

    public function set(string $name, string $route, string $pattern): static
    {
        $this->items[$name] = [$route, $pattern];

        return $this;
    }
}
