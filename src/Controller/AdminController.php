<?php
/**
 * Created by PhpStorm.
 * User: lycurgus
 * Date: 4/23/18
 * Time: 3:14 PM
 */

    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;


    class AdminController extends AppController
    {

        public function index()
        {
            $this->viewBuilder()->setLayout('admin');
            $query = TableRegistry::get('Parts')->find();
            $cat = TableRegistry::get('Categories')->find();
            $this->set('parts', $query);
            $this->set('categories', $cat);

        }
        public function get_cat()
        {
            return TableRegistry::get('Categories')->find();

        }
    }
