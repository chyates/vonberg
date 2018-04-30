<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


class ProductsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index','new']);
        $this->viewBuilder()->setLayout('default');

    }
    public function index()
    {
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', ['contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
        $cat = TableRegistry::get('Categories')->find();
        $types = TableRegistry::get('Types')->find();

        $this->set('types', $types);
        $this->set('parts', $query);
        $this->set('category', $cat);

    }
    public function view($id=null)
    {
        $this->loadModel('Parts');
        $part =  $this->Parts->get($id, ['contain' => ['Connections', 'Types','Series','Styles', 'Categories']]);

        $this->set('part', $part);

    }
    public function get_cat()
    {
        return TableRegistry::get('Categories')->find();

    }

    public function new()
    {
        $this->viewBuilder()->setLayout('default');
    }
    public function catalog($cat = null)
    {
        $this->viewBuilder()->setLayout('default');
        $this->loadModel('Parts');
        if (!empty($cat)) {
        $query =  $this->Parts->find('all',
            [
                'contain' => ['Connections', 'Types','Series','Styles', 'Categories']
                ])
            ->order(['typeID'=>'desc'])
            ->group(['typeID']);
        } else {
        $query = $this->Parts->find('all', ['conditions' => ['Parts.categoryID' => $cat],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]);
        }
        $types = TableRegistry::get('Types')->find();
        $cat2 = TableRegistry::get('Categories')->get($cat);


        $this->set('types', $types);
        $this->set('parts', $query);
        $this->set('category', $cat2);

    }
}
