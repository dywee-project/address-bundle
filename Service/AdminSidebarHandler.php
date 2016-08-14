<?php

namespace Dywee\AddressBundle\Service;

use Symfony\Component\Routing\Router;

class AdminSidebarHandler
{

    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getSideBarMenuElement()
    {
        $menu = array(
            'key' => 'address',
            'icon' => 'fa fa-files-o',
            'label' => 'address.sidebar.label',
            'children' => array(
                array(
                    'icon' => 'fa fa-list-alt',
                    'label' => 'address.sidebar.table',
                    'route' => $this->router->generate('address_admin_table')
                ),
            )
        );

        return $menu;
    }
}