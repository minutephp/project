<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 11/5/2016
 * Time: 11:04 AM
 */
namespace Minute\Todo {

    use Minute\Config\Config;
    use Minute\Event\ImportEvent;

    class ProjectTodo {
        /**
         * @var TodoMaker
         */
        private $todoMaker;
        /**
         * @var Config
         */
        private $config;

        /**
         * MailerTodo constructor.
         *
         * @param TodoMaker $todoMaker - This class is only called by TodoEvent (so we assume TodoMaker is be available)
         * @param Config $config
         */
        public function __construct(TodoMaker $todoMaker, Config $config) {
            $this->todoMaker = $todoMaker;
            $this->config = $config;
        }

        public function getTodoList(ImportEvent $event) {
            $todos[] = ['name' => 'Setup project page details', 'description' => 'Project page heading, description, links, etc',
                        'status' => $this->config->get('project/title') ? 'complete' : 'incomplete', 'link' => '/admin/project-settings'];

            $event->addContent(['Project' => $todos]);
        }
    }
}