<?php
/**
 * Created by: MinutePHP Framework
 */
namespace App\Model {

    use Minute\Model\ModelEx;

    class MProject extends ModelEx {
        protected $table      = 'm_projects';
        protected $primaryKey = 'project_id';
    }
}