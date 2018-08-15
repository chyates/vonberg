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
            'actions' => ['index']
        ]);
    }

    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index','catalog','view','new','search', 'customization', 'prices','type']);
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
            $query =  $this->Parts->find('all', array(
                'conditions' => array('Parts.categoryID' => $cat),
                'order' => array('Types.name' => 'ASC', 'Series.name' => 'ASC'),
                'contain' => array('Connections', 'Types','Series','Styles', 'Categories')
            ));
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

    public function type($type = null)
    {
        $spaceType = str_replace('-', ' ', $type);
        $upperSpace = ucwords($spaceType);
        $this->loadModel('Parts');
        if (!empty($upperSpace)) {
            $query =  $this->Parts->find('all', ['conditions' => ['Parts.typeID' => $upperSpace], 'contain' => ['Connections', 'Types','Series','Styles', 'Categories']])->order(['Series.name'=>'ASC']);
        } else {
            $query = $this->Parts->find('all', ['conditions' => ['Parts.typeID' => $upperSpace],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]);
        }

        $type2 = TableRegistry::get('Types')->get($upperSpace);
        $cat = TableRegistry::get('Categories')->find();

        $this->set('category', $cat);
        $this->set('types', $type2);
        $this->set('parts', $query);
    }

    public function search()
    {
        $this->loadModel('Parts');
        $this->loadModel('Specifications');
        $this->loadModel('TextBlockBullets');
        $this->loadModel('TextBlocks');
        $this->loadModel('ModelTableRows');
        $this->loadModel('ModelTables');
        
        // $found = array();
        if($this->request->is('post') || $this->request->is('put')) {
            // $this->request->data['lookup'] = $this->request->['lookup'];

            $l = ConnectionManager::get('default');
            $like_str = ' LIKE "%' . $this->request->data['lookup'] . '%"';
            $lookup ="SELECT p.partID
            FROM
                model_tables as mt JOIN parts as p ON mt.partID = p.partID
            JOIN model_table_rows as mtr ON mt.model_tableID = mtr.model_tableID
            JOIN series as s ON p.seriesID = s.seriesID
            JOIN types as ty ON p.typeID = ty.typesID
            WHERE p.description" . $like_str . " OR
            s.name" . $like_str . " OR
            ty.name" . $like_str . " OR
            mtr.model_table_row_text" . $like_str . " OR
            mtr.model_table_row_text ='" . $this->request->data['lookup'] . "'
            GROUP BY s.name";

            $res = $l->execute($lookup);
            $found = $res->fetchAll();
            $final = array();
            
            for($p = 0; $p < count($found); $p++) {
                $each_part = $this->Parts->get($found[$p], ['contain' => ['Connections', 'Categories', 'Styles', 'Types', 'Series']]);
                array_push($final, $each_part);
                }
            }

        $this->set('parts', $final);
    }

    public function customization()
    {
        
    }

    public function prices()
    {
        $seriesID = $this->request->query('seriesID');
        $q = $this->request->query('q');
        $rows=NULL;
        if ($q) {
            $conn = ConnectionManager::get('default');
            $like_where = 'mp.model_text LIKE "%' . $q . '%"';

            // echo $like_where;
            $query = "SELECT mp.model_text, mp.unit_price, mp.description
            FROM
                model_prices as mp
            WHERE " . $like_where . "
            ORDER BY mp.model_text";

            $stmt = $conn->execute($query);
            $rows = $stmt->fetchAll('assoc');
            $this->set('no_series', $rows);
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
                mp.model_text';

            $stmt = $conn->execute($query);
            $rows = $stmt->fetchAll('assoc');
            $this->set('prices', $rows);
        }

        $this->loadModel('ModelPrices');
        $dropdown = $this->ModelPrices->find('all')->orderAsc('model_text');

        $this->loadModel('Series');
        $matchingTasks= $this->Series->association('Parts')->find()->select(['seriesID'])->distinct();
        $series = $this->Series->find()->where(['seriesID IN' => $matchingTasks])->orderAsc('name');

        $this->set(compact('series'));
    }

    public function new()
    {
        $this->loadModel('Parts');
        $else_query = $this->Parts->find('all', array('limit'=>10, 'group' =>array('typeID'), 'order'=>array('last_updated DESC')))->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);
        $new_query = $this->Parts->find('all', array('conditions' => array('new_list' => 1), 'order'=>array('last_updated DESC')))->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);

        if(count($new_query) < 1) {
            echo "Did not find new products";
            $this->set('parts', $else_query);
        } else {
            // echo "Found new products";
            $this->set('parts', $new_query);
        }
        // $this->set('parts',$query);
    }
}