<?php

namespace Dywee\AddressBundle\Listener;

use Dywee\AddressBundle\Service\AdminSidebarHandler;
use Dywee\CoreBundle\DyweeCoreEvent;
use Dywee\CoreBundle\Event\AdminSidebarBuilderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class AdminSidebarBuilderListener implements EventSubscriberInterface{
    private $adminSidebarHandler;

    public function __construct(AdminSidebarHandler $adminSidebarHandler)
    {
        $this->adminSidebarHandler = $adminSidebarHandler;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return array(
            DyweeCoreEvent::BUILD_ADMIN_SIDEBAR => array('addElementToSidebar', -10)
        );
    }

    public function addElementToSidebar(AdminSidebarBuilderEvent $adminSidebarBuilderEvent)
    {
        $adminSidebarBuilderEvent->addAdminElement($this->adminSidebarHandler->getSideBarMenuElement());
    }

}