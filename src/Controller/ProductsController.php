<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


class ProductsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'search']
        ]);
    }

    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index','catalog','view','new','search', 'customization', 'prices']);
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
        $part =  $this->Parts->get($id, ['contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications', 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]);
        $this->set('part', $part);

    }
    public function pricing($id=null)
    {
        // $this->loadModel('ModelPrices');
        // $series = TableRegistry::get('Series')->find();

        // $query = $this->ModelPrices
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            // ->find('search', ['search' => $this->request->getQueryParams()]);
            // You can add extra things to the query if you need to
            //->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);

        // $this->set('prices', $this->paginate($query));
        // $this->set(compact('series'));


    }
    public function get_cat()
    {
        return TableRegistry::get('Categories')->find();

    }

    public function get_series()
    {
        return TableRegistry::get('Series')->find();

    }


    public function catalog($cat = null)
    {
        $this->viewBuilder()->setLayout('default');
        $this->loadModel('Parts');
        if (!empty($cat)) {
        $query =  $this->Parts->find('all',
            [   'conditions' => ['Parts.categoryID' => $cat],
                'contain' => ['Connections', 'Types','Series','Styles', 'Categories']
                ])
            ->order(['typeID'=>'ASC']);
        } else {
        $query = $this->Parts->find('all', ['conditions' => ['Parts.categoryID' => $cat],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]);
        }

        $types = TableRegistry::get('Types')->find();
        $cat2 = TableRegistry::get('Categories')->get($cat);
        $textblocks = TableRegistry::get('TextBlocks')->find();
        $specs = TableRegistry::get('Specifications')->find();



        $this->set('types', $types);
        $this->set('parts', $query);
        $this->set('category', $cat2);

    }

    public function types($type = null) 
    {
        $spaceType = str_replace('-', ' ', $type);
        $upperSpace = ucwords($spaceType);
        $this->loadModel('Parts');
        if (!empty($upperSpace)) {
        $query =  $this->Parts->find('all',
            [   'conditions' => ['Parts.typeID' => $upperSpace],
                'contain' => ['Connections', 'Types','Series','Styles', 'Categories']
                ])
            ->order(['typeID'=>'ASC']);
        } else {
        $query = $this->Parts->find('all', ['conditions' => ['Parts.typeID' => $upperSpace],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]);
        }

        $type2 = TableRegistry::get('Types')->get($upperSpace);
        // $cat2 = TableRegistry::get('Categories')->get($cat);
        // $textblocks = TableRegistry::get('TextBlocks')->find();
        // $specs = TableRegistry::get('Specifications')->find();



        $this->set('types', $type2);
        $this->set('parts', $query);
        // $this->set('category', $cat2);

    }

    public function search()
    {
        $this->loadModel('Parts');
        $query = $this->Parts
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams(),'recursive' => 2])
            // You can add extra things to the query if you need to
            ->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);

        $this->set('parts', $this->paginate($query));
    }

    public function customization()
    {
        
    }

    public function prices()
    {
        $this->loadModel('ModelPrices');
        $series = TableRegistry::get('Series')->find();

        $query = $this->ModelPrices
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams()]);
            // You can add extra things to the query if you need to
            //->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);

        $this->set('prices', $this->paginate($query));
        $this->set(compact('series'));
    }

    public function new()
    {
        
    }
}
