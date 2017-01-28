<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Menu {

    use Minute\Event\ImportEvent;

    class ProjectMenu {
        public function adminLinks(ImportEvent $event) {
            $links = ['project-settings' => ['title' => 'Project settings', 'icon' => 'fa-folder-open', 'priority' => 80, 'parent' => 'members', 'href' => '/admin/project-settings']];

            $event->addContent($links);
        }

        public function memberLinks(ImportEvent $event) {
            $links = ['member-projects' => ['title' => "My projects", 'icon' => 'fa-folder-open', 'href' => '/members/projects', 'priority' => 3]];

            $event->addContent($links);
        }

        public function toolbarLinks(ImportEvent $event) {
            $links = [['title' => "My projects", 'icon' => 'fa-folder-open', 'priority' => 2, 'href' => '/members/projects', 'tooltip' => 'My projects']];

            $event->addContent($links);
        }
    }
}