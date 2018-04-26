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


        public function view()
        {
            $this->viewBuilder()->setLayout('admin');
            $cat = TableRegistry::get('Categories')->find();
            $this->set('categories', $cat);

        }

        public function catalog($id)
        {
            $this->viewBuilder()->setLayout('admin');
            $this->loadModel('Parts');
            $query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.categoryID =' => $id],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
            $cat = TableRegistry::get('Categories')->find();
            $this->set('parts', $query);
            $this->set('categories', $cat);

        }


        public function index()
        {
            $this->viewBuilder()->setLayout('admin');
            $this->loadModel('Parts');
            $query =  $this->paginate($this->Parts->find('all', ['contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
            $cat = TableRegistry::get('Categories')->find();
            $this->set('parts', $query);
            $this->set('categories', $cat);

        }
        public function get_cat()
        {
            return TableRegistry::get('Categories')->find();

        }
    }
