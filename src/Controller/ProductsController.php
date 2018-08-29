<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
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
        $this->loadModel('StpUsers');
        $this->loadModel('StpFile');
        // $this->loadModel('Parts');
        $this->loadModel('ModelTableRows');
        $stp_table = TableRegistry::get('StpFile');
        $redir = array('reload' => 'no');
        // $redir['reload'] = 'false';

        // instantiate empty STP user and STP file objects:
        $emp = $this->StpUsers->newEntity();

        if($this->request->is('post') || $this->request->is('put')) {
            // update STP user object
            $emp = $this->StpUsers->patchEntity($emp,$this->request->data);
            // $emp->
            if($result = $this->StpUsers->save($emp)) {
                // Send email to client:
                $file_paths = '';
                if(!empty($this->request->data['model'])) {
                    foreach($this->request->data['model'] as $str_model) {
                        if(strval($str_model) != "0") {
                            $file_paths .= 'Model ';
                            $file_paths .= strval($str_model);
                            $file_paths .= ".stp, ";
                        }
                    }
                }

                $data['response'] = "Success: data saved";
                $data['debug'] = $result;
                $models = [];
                // $this->Flash->success(__('The request has been saved.'));
                foreach ($this->request->data['model'] as $model) {
                    $cmd_vars = 'DB=' . 'vvi_dev' . ' ';
                    $cmd_vars .= 'USERID=' . $result->stp_userID . ' ';
                    $cmd_vars .= 'PARTID=' . $this->request->data['part'] . ' ';
                    $cmd_vars .= 'MODELID=' . $model . ' ';
                    exec($cmd_vars . '/home/impact_vvi/.nvm/versions/node/v8.11.3/bin/node /home/impact_vvi/db_routines/doTheStp.js');
                }
                exec('DB=vvi_dev /home/impact_vvi/.nvm/versions/node/v8.11.3/bin/node /home/impact_vvi/db_routines/getMeACsv.js');

                Email::deliver('chyatesil@gmail.com', 'STP File Request From: ' . $this->request->data['first_name'] . " " . $this->request->data['last_name'], 'Please respond to: ' . $this->request->data['email'] . ' with the following files: ' . $file_paths, ['from' => 'do-not-reply@vonberg.com']);
                Email::deliver('whyyesitscar@gmail.com', 'STP File Request From: ' . $this->request->data['first_name'] . " " . $this->request->data['last_name'], 'Please respond to: ' . $this->request->data['email'] . ' with the following files: ' . $file_paths, ['from' => 'do-not-reply@vonberg.com']);
                $redir['reload'] = 'yes';
                $this->set('r_check', $redir);
                // return $this->redirect($this->referer());
                // $this->autoRender = false;
            }
            else {
                $data['response'] = "Error: some error";
                // print_r($emp);
                // $this->Flash->success(__('The request has not been saved.'));
            }
        }
        $part =  $this->Parts->get($id, ['contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications', 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]);
        $this->set('redirect', $redir);
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
        $this->loadModel('Parts');
        $seriesID = $this->request->query('seriesID');
        $q = $this->request->query('q');
        $rows=NULL;
        if ($q) {
            $conn = ConnectionManager::get('default');
            $like_where = 'mp.model_text LIKE "%' . $q . '%"';

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

            if(empty($rows)) {
                $empty = $this->Parts->find('all', ['conditions' => ['Parts.seriesID' => $seriesID], 'contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications', 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]);

                $this->set('empty_prices', $empty);
            }
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
        $else_query = $this->Parts->find('all', array(
            'limit'=>10, 
            'group' => array('typeID'), 
            'order'=>array('last_updated DESC')))->contain(
                ['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]
            );
        $new_query = $this->Parts->find('all', array(
            'conditions' => array('new_list' => 1), 
            'order'=>array('Types.name' => 'ASC', 'Parts.expires' => 'ASC'),
            'contain' => array('Connections', 'Types', 'Series', 'Styles', 'Categories'))
        );

        if(count($new_query) < 1) {
            echo "Did not find new products";
            $this->set('parts', $else_query);
        } else {
            $this->set('parts', $new_query);
        }
    }
}