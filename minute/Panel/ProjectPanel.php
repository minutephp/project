<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Panel {

    use App\Model\MProject;
    use Carbon\Carbon;
    use Minute\Event\ImportEvent;

    class ProjectPanel {
        public function adminDashboardPanel(ImportEvent $event) {
            $yesterday = Carbon::create(date('Y'), date('m'), date('d'), 0, 0, 0, 'UTC');
            $count     = MProject::where('created_at', '>', $yesterday)->count();

            $panels = [
                ['type' => 'member', 'title' => 'Projects', 'stats' => "$count created", 'icon' => 'fa-file', 'priority' => 2, 'href' => '/admin/projects/stats', 'cta' => 'View stats..',
                 'bg' => 'bg-orange']
            ];

            $event->addContent($panels);
        }
    }
}