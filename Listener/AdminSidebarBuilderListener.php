<?php

namespace Dywee\AddressBundle\Listener;

use Dywee\AddressBundle\Service\AdminSidebarHandler;
use Dywee\CoreBundle\DyweeCoreEvent;
use Dywee\CoreBundle\Event\SidebarBuilderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class AdminSidebarBuilderListener implements EventSubscriberInterface
{
    /** @var AdminSidebarHandler  */
    private $adminSidebarHandler;

    /**
     * AdminSidebarBuilderListener constructor.
     *
     * @param AdminSidebarHandler $adminSidebarHandler
     */
    public function __construct(AdminSidebarHandler $adminSidebarHandler)
    {
        $this->adminSidebarHandler = $adminSidebarHandler;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            DyweeCoreEvent::BUILD_ADMIN_SIDEBAR  => ['addElementToAdminSidebar', -10],
            DyweeCoreEvent::BUILD_MEMBER_SIDEBAR => ['addElementToMemberSidebar', -20]
        ];
    }

    /**
     * @param SidebarBuilderEvent $adminSidebarBuilderEvent
     */
    public function addElementToAdminSidebar(SidebarBuilderEvent $adminSidebarBuilderEvent)
    {
        $adminSidebarBuilderEvent->addElement($this->adminSidebarHandler->getSideBarAdminMenuElement());
    }

    /**
     * @param SidebarBuilderEvent $adminSidebarBuilderEvent
     */
    public function addElementToMemberSidebar(SidebarBuilderEvent $adminSidebarBuilderEvent)
    {
        $adminSidebarBuilderEvent->addElement($this->adminSidebarHandler->getSideBarMemberMenuElement());
    }

}