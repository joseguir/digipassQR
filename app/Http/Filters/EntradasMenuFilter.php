<?php

namespace App\Http\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class EntradasMenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['text']) && $item['text'] === 'Entradas' && auth()->check()) {
            if (auth()->user()->role_id == 3) {
                $item['text'] = 'Mis Entradas';
            }
        }

        return $item;
    }
}
