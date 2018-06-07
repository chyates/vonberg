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
            $this->set('id', $id);
            $cat1 = TableRegistry::get('Categories')->find()->where(['categoryID' => $id])->first();
            $this->set('categories', $cat);
            $this->set('pagename', $cat1->name);

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

        public function addProduct()
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function editProduct()
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function generatePDF()
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function modelPricing()
        {
            $this->viewBuilder()->setLayout('admin');
            $this->loadModel('ModelPrices');
            $series = TableRegistry::get('Series')->find();

            $pricing = TableRegistry::get('ModelPrices')->find();

            $this->set('prices', $pricing);
            $this->set(compact('series'));
        }

        public function manageResources() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function editResources() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function addResource() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function editGeneralInformation() 
        {
            $this->viewBuilder()->setLayout('admin');
        }
        
        public function editTechnicalDocumentation() 
        {
            $this->viewBuilder()->setLayout('admin');
        }
        
        public function editApplicationInformation() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function generalInformation() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function technicalDocumentation() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function applicationInformation() 
        {
            $this->viewBuilder()->setLayout('admin');
        }
        
        public function downloadSTP()
        {
            $this->viewBuilder()->setLayout('admin');
        }
    }
