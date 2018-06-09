<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;



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
        $this->loadModel('Parts');
        $query =  $this->Parts->find('all', ['conditions' => ['Parts.seriesID' => $id], 'contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications', 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]);
        $part = $query->first();
        $this->set('part', $part);

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
        $seriesID = $this->request->query('seriesID');
        $q = $this->request->query('q');
        $rows=NULL;
   /*     if (is_null($seriesID) && empty($q)) {
            // break out here
            $series = TableRegistry::get('Series')->find();
            $this->set(compact('series'));
            $rows = NULL;
        }*/
        if ($q) {
            $conn = ConnectionManager::get('default');
            $like_where = 'mp.model_text LIKE "%' . $q . '%"';
            $query = 'SELECT p.partID, s.name as series, st.name as style, c.name as conn, ty.name as tipe, mp.unit_price, mp.model_text
            FROM
              model_tables as mt LEFT JOIN parts as p ON mt.partID = p.partID
            LEFT JOIN model_table_rows as mtr ON mt.model_tableID = mtr.model_tableID
            LEFT JOIN model_prices as mp ON mp.model_text = mtr.model_table_row_text
            LEFT JOIN series as s ON p.seriesID = s.seriesID
            LEFT JOIN styles as st ON p.styleID = st.styleID
            LEFT JOIN connections as c ON p.connectionID = c.connectionID
            LEFT JOIN types as ty ON p.typeID = ty.typesID
            WHERE
            ' . $like_where . '
            ORDER BY
                mp.model_text,st.name';
            $stmt = $conn->execute($query);
            $rows = $stmt->fetchAll('assoc');
        } elseif ($seriesID) {
            $conn = ConnectionManager::get('default');
            $like_where = 'mp.model_text LIKE "%' . $q . '%"';

            $query = 'SELECT
    p.partID,
    s.name as series,
    st.name as style,
    c.name as conn,
    ty.name as tipe,
    mp.unit_price,
    mp.model_text  
FROM
    series as s,
    styles as st,
    connections as c,
    parts as p,
    types as ty,
    model_prices as mp,
    model_table_rows as mtr,
    model_tables as mt
WHERE
	s.seriesID = '.$seriesID.'
AND
	s.seriesID = p.seriesID
AND
	p.partID = mt.partID
AND
	mt.model_tableID = mtr.model_tableID
AND
	mtr.model_table_row_text = mp.model_text
AND
    p.styleID = st.styleID
AND
    p.connectionID  = c.connectionID
AND
	p.typeID = ty.typesID
ORDER BY
    mp.model_text,s.name';
            $stmt = $conn->execute($query);
            $rows = $stmt->fetchAll('assoc');
        }
        $this->set('prices', $rows);
        $series = TableRegistry::get('Series')->find();
        $this->set(compact('series'));
    }

    public function new()
    {
        
    }
}
