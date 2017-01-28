<?php

/** @var Router $router */
use Minute\Model\Permission;
use Minute\Routing\Router;

$router->get('/members/projects', 'Members/Projects', true, 'm_projects[5] as projects ORDER BY updated_at DESC', 'm_configs[type] as configs')
       ->setReadPermission('projects', Permission::SAME_USER)->setReadPermission('configs', Permission::EVERYONE)
       ->setDefault('projects', '*')->setDefault('type', 'project');
$router->post('/members/projects', null, true, 'm_projects as projects')
       ->setAllPermissions('projects', Permission::SAME_USER);

$router->get('/admin/project-settings', null, 'admin', 'm_configs[type] as configs')
       ->setReadPermission('configs', 'admin')->setDefault('type', 'project');
$router->post('/admin/project-settings', null, 'admin', 'm_configs as configs')
       ->setAllPermissions('configs', 'admin');
