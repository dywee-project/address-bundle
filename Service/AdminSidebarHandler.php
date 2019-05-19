<?php

namespace Dywee\AddressBundle\Service;

use Symfony\Component\Routing\RouterInterface;

class AdminSidebarHandler
{
    /** @var RouterInterface  */
    private $router;

    /**
     * AdminSidebarHandler constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return array
     */
    public function getSideBarAdminMenuElement()
    {
        $menu = array(
            'key' => 'address',
            'icon' => 'fa fa-map-marker',
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

    /**
     * @return array
     */
    public function getSideBarMemberMenuElement()
    {
        $menu = array(
            'key' => 'address',
            'icon' => 'fa fa-map-marker',
            'label' => 'address.sidebar.label',
            'route' => $this->router->generate('address_admin_table')
        );

        return $menu;
    }
}
