<?php

/** @var Binding $binding */
use Minute\Event\AdminEvent;
use Minute\Event\Binding;
use Minute\Event\MemberEvent;
use Minute\Event\TodoEvent;
use Minute\Menu\ProjectMenu;
use Minute\Panel\ProjectPanel;
use Minute\Todo\ProjectTodo;

$binding->addMultiple([
    //project
    ['event' => AdminEvent::IMPORT_ADMIN_MENU_LINKS, 'handler' => [ProjectMenu::class, 'adminLinks']],
    ['event' => AdminEvent::IMPORT_ADMIN_DASHBOARD_PANELS, 'handler' => [ProjectPanel::class, 'adminDashboardPanel']],

    ['event' => MemberEvent::IMPORT_MEMBERS_SIDEBAR_LINKS, 'handler' => [ProjectMenu::class, 'memberLinks']],
    ['event' => MemberEvent::IMPORT_MEMBERS_TOOLBAR_LINKS, 'handler' => [ProjectMenu::class, 'toolbarLinks']],

    //tasks
    ['event' => TodoEvent::IMPORT_TODO_ADMIN, 'handler' => [ProjectTodo::class, 'getTodoList']],
]);