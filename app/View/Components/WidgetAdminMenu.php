<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class WidgetAdminMenu extends Component
{
    public function __construct(
        private readonly array $items,
    ) {

    }

    public function render(): string
    {
        $requestUrl = request()?->getPathInfo();

        $menu = '<ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget = "treeview" role = "menu"
                data-accordion = "false" >';

        foreach ($this->items as $item) {

            if (isset($item['submenu'])) {
                $submenu = '';
                $openParentClass = '';
                $activeParentClass = '';

                foreach ($item['submenu'] as $subItem) {
                    if (route($subItem['route'], [], false) === $requestUrl) {
                        $activeItemClass = 'active';
                        $activeParentClass = $activeItemClass;
                        $openParentClass = 'menu-open';
                    } else {
                        $activeItemClass = '';
                    }

                    $submenu .= view('components.admin-menu._menu-item', [
                        'item' => $subItem,
                        'activeItemClass' => $activeItemClass
                    ]);
                }

                $menu .= view('components.admin-menu._menu-item-with-children', [
                    'item' => $item,
                    'openParentClass' => $openParentClass,
                    'activeParentClass' => $activeParentClass,
                    'submenu' => $submenu
                ]);

            } else {
                $activeItemClass = route($item['route'], [], false) === $requestUrl ? 'active' : '';
                $menu .= view('components.admin-menu._menu-item', [
                    'item' => $item,
                    'activeItemClass' => $activeItemClass
                ]);
            }
        }

        return $menu . '</ul>';
    }
}
