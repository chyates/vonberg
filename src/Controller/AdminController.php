<?php
/**
 * Created by PhpStorm.
 * User: lycurgus
 * Date: 4/23/18
 * Time: 3:14 PM
 */

namespace App\Controller;

use App\Controller\File;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

class AdminController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
        $this->loadComponent('Flash');
    }

    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->Security->setConfig('unlockedActions', ['editProduct','editProductTwo','editProductThree','editProductFour','editProductFive', 'editApplicationInformation', 'editGeneralInformation', 'editTechnicalDocumentation', 'addResource']);
    }

    // main page 
    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', ['contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
        $cat = TableRegistry::get('Categories')->find();
        $this->set('parts', $query);
        $this->set('categories', $cat);
        $this->set('dealer_time', filemtime(WWW_ROOT.'csv/distributors.csv'));
        $this->set('model_time', filemtime(WWW_ROOT.'csv/model_prices.csv'));
        $this->set('catalog_time', filemtime(WWW_ROOT.'img/pdfs/VONBERG-Product_Catalog.pdf'));
    }

    public function new()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', array('conditions' => array('new_list' => 1), 'order'=>array('expires DESC')))->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]));

        $this->set('parts', $query);
        $this->set('pagename', 'New Products');
    }

    public function duplicate($id)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $this->loadModel('ModelTables');
        $this->loadModel('ModelTableRows');
        $this->loadModel('ModelTableHeaders');
        $this->loadModel('Specifications');
        $this->loadModel('TextBlocks');
        $this->loadModel('TextBlockBullets');

        $copy = $this->Parts->get($id, ['contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications', 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]);
        $dupe = $this->Parts->newEntity();
        
        // parts table duplication:
        $dupe->categoryID = $copy->categoryID;
        $dupe->typeID = $copy->typeID;
        $dupe->seriesID = $copy->seriesID;
        $dupe->styleID = $copy->styleID;
        $dupe->connectionID = $copy->connectionID;
        $dupe->description = $copy->description;
        $dupe->new_list = 1;
        $dupe->expires = 30;

        if($this->Parts->save($dupe)) {
            // specs duplication
            if(!empty($copy->specifications)) {
                foreach($copy->specifications as $old_spec) {
                    $new_spec = $this->Specifications->newEntity();
                    $new_spec->spec_name = $old_spec->spec_name;
                    $new_spec->partID = $dupe->partID;
                    $new_spec->spec_value = $old_spec->spec_value;
                    $this->Specifications->save($new_spec);
                }
            }
            
            // text block/bullets duplication
            if(!empty($copy->text_blocks)) {
                foreach($copy->text_blocks as $old_block) {
                    $new_tb = $this->TextBlocks->newEntity();
                    $new_tb->partID = $dupe->partID;
                    $new_tb->order_num = $old_block->order_num;
                    $new_tb->header = $old_block->header;
                    $this->TextBlocks->save($new_tb);
                    
                    if(!empty($old_block->text_block_bullets)) {
                        foreach($old_block->text_block_bullets as $old_bullet){
                            $new_tbb = $this->TextBlockBullets->newEntity();
                            $new_tbb->text_blockID = $new_tb->text_blockID;
                            $new_tbb->bullet_text = $old_bullet->bullet_text;
                            $new_tbb->order_num = $old_block->order_num;
                            $this->TextBlockBullets->save($new_tbb);
                        }
                    }
                }
            }
            
            // model table + headers/rows duplication
            if(!empty($copy->model_table)) {
                $new_mt = $this->ModelTables->newEntity();
                $new_mt->order_num = 1;
                $new_mt->partID = $dupe->partID;
                $this->ModelTables->save($new_mt);
                
                if(!empty($copy->model_table->model_table_headers)) {
                    foreach($copy->model_table->model_table_headers as $old_header) {
                        $new_mth = $this->ModelTableHeaders->newEntity();
                        $new_mth->model_tableID = $new_mt->model_tableID;
                        $new_mth->model_table_text = $old_header->model_table_text;
                        $new_mth->order_num = $old_header->order_num;
                        $this->ModelTableHeaders->save($new_mth);
                    }
                }
                
                if(!empty($copy->model_table->model_table_rows)) {
                    foreach($copy->model_table->model_table_rows as $old_row) {
                        $new_mtr = $this->ModelTableRows->newEntity();
                        $new_mtr->model_tableID = $new_mt->model_tableID;
                        $new_mtr->model_table_row_text = $old_row->model_table_row_text;
                        $new_mtr->order_num = $old_row->order_num;
                        $this->ModelTableRows->save($new_mtr);
                    }
                }
            }
            $this->redirect(array('controller' => 'admin', 'action' => 'editProduct', $dupe->partID));
        }
    }
    
    public function products()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query = $this->paginate($this->Parts->find('all', array(
            'order' => array( 'Parts.expires' => 'DESC', 'Series.name' => 'ASC')))->contain(['Connections', 'Types', 'Series', 'Styles', 'Categories']));

        $this->set('parts', $query);
        $this->set('pagename', 'All Products');
    }

    // category pages
    public function catalog($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.categoryID =' => $id],'contain' => ['Connections', 'Types','Series','Styles', 'Categories'], 'order' => array( 'Parts.expires' => 'DESC', 'Series.name' => 'ASC')]));

        $cat = TableRegistry::get('Categories')->find();
        $cat1 = TableRegistry::get('Categories')->find()->where(['categoryID' => $id])->first();
        $this->set('categories', $cat);
        $this->set('parts', $query);
        $this->set('id', $id);
        $this->set('pagename', $cat1->name);            
    }

    // subcategory pages
    public function type($id)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $subcat = TableRegistry::get('Types')->find();

        $type_query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.typeID =' => $id], 'order' => array('Parts.expires' => 'DESC', 'Series.name ASC'), 'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
        $subcat1 = TableRegistry::get('Types')->find()->where(['typesID' => $id])->first();
        $this->set('parts', $type_query);
        $this->set('id', $id);
        $this->set('pagename', $subcat1->name);
    }
    
    public function get_cat()
    {
        return TableRegistry::get('Categories')->find();
    }

    public function view()
    {
        $this->viewBuilder()->setLayout('admin');
        $cat = TableRegistry::get('Categories')->find();
        $this->set('categories', $cat);
    }

    public $components=array('RequestHandler');

    // AJAX function to toggle new status, products + catalog + type pages
    public function checkNew() 
    {
        $this->loadModel('Parts');
        if($this->request->is('ajax')) {
            $part = $this->Parts->get(intval($this->request->query['id']));

            if($part->new_list == 0) {
                $part->new_list = 1;
                $part->expires = 30;
            } else {
                $part->new_list = 0;
                $part->expires = 0;
            }
            if($result = $this->Parts->save($part)) {
                $data['response'] = $part->expires;
            } else {
                // echo "Error: some error";
            }
        }
    }

    public function addProduct()
    {
        $this->viewBuilder()->setLayout('admin');
        $data = [];
        $this->loadModel('Parts');
        $this->loadModel('Series');
        $this->loadModel('Types');
        $this->loadModel('Categories');
        $this->loadModel('Connections');
        
        // load variables to generate form options:
        $cat = TableRegistry::get('Categories')->find('list')->orderAsc('name');
        $type = TableRegistry::get('Types')->find('list')->orderAsc('name');
        $style = TableRegistry::get('Styles')->find('list')->orderAsc('name');
        $series = TableRegistry::get('Series')->find('list')->orderAsc('name');
        $conn = TableRegistry::get('Connections')->find('list')->orderAsc('name');
            
        if($this->request->is('post') || $this->request->is('put'))  {
            // create part:
            $part = $this->Parts->newEntity();

            if(!empty($this->request->data['styleID'])) {
                $part->styleID = $this->request->data['styleID'];
            }

            if(!empty($this->request->data['newcat'])) {
                $new_cat = $this->Categories->newEntity();
                $new_cat->name = $this->request->data['newcat'];
                if($this->Categories->save($new_cat)) {
                    $part->categoryID = $new_cat->categoryID;
                }
            } else if(!empty($this->request->data['categoryID'])) {
                $part->categoryID = $this->request->data['categoryID'];
            }

            if(!empty($this->request->data['newseries'])) {
                $new_sr = $this->Series->newEntity();
                $new_sr->name = $this->request->data['newseries'];
                if($this->Series->save($new_sr)) {
                    $part->seriesID = $new_sr->seriesID;
                }
            } else if(!empty($this->request->data['seriesID'])) {
                $part->seriesID = $this->request->data['seriesID'];
            }

            if(!empty($this->request->data['newtype'])) {
                $new_type = $this->Types->newEntity();
                $new_type->name = $this->request->data['newtype'];
                if($this->Types->save($new_type)) {
                    $part->typeID = $new_type->typesID;
                }
            } else if(!empty($this->request->data['typeID'])) {
                $part->typeID = $this->request->data['typeID'];
            }

            if(!empty($this->request->data['newconn'])) {
                $new_conn = $this->Connections->newEntity();
                $new_conn->name = $this->request->data['newconn'];
                if($this->Connections->save($new_conn)) {
                    $part->connectionID = $new_conn->connectionID;
                }
            } else if(!empty($this->request->data['connectionID'])) {
                $part->connectionID = $this->request->data['connectionID'];
            }

            if(!empty($this->request->data['expires'])) {
                $part->expires = intval($this->request->data['expires']);
            }
            
            if(!empty($this->request->data['new_list'])) {
                $part->new_list = intval($this->request->data['new_list']);
            }

            // save part:
            if($result = $this->Parts->save($part)) {
                $data['response'] = "Success: data saved";
            } else {
                $data['response'] = "Error: some error";
            }
            $this->redirect(array('controller' => 'admin', 'action' => 'editProductTwo', $part->partID));
        }

        // set variables for form data:
        $this->set('cat', $cat);
        $this->set('conn', $conn);
        $this->set(compact('series'));
        $this->set('type', $type);
        $this->set('style', $style);
    }

    public function editProduct($id)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $this->loadModel('Series');
        $this->loadModel('Types');
        $this->loadModel('Styles');
        $this->loadModel('Connections');
        $this->loadModel('Categories');

        $part = $this->Parts->get($id, ['contain' => ['Series']]);
        $data = [];
        if($this->request->is('post') || $this->request->is('put'))  {
            $data['debug'] = "passing post";

            if($this->request->data['styleID'] != $part->styleID && !empty($this->request->data['styleID'])) {
                $part->styleID = $this->request->data['styleID'];
            }

            if(!empty($this->request->data['newcat'])) {
                $new_cat = $this->Categories->newEntity();
                $new_cat->name = $this->request->data['newcat'];
                if($this->Categories->save($new_cat)) {
                    $part->categoryID = $new_cat->categoryID;
                }
            } else if($this->request->data['categoryID'] != $part->categoryID && !empty($this->request->data['categoryID'])) {
                $part->categoryID = $this->request->data['categoryID'];
            }

            if(!empty($this->request->data['newseries'])) {
                $new_sr = $this->Series->newEntity();
                $new_sr->name = $this->request->data['newseries'];
                if($this->Series->save($new_sr)) {
                    $part->seriesID = $new_sr->seriesID;
                }
            } elseif($this->request->data != $part->seriesID && !empty($this->request->data['seriesID'])) {
                $part->seriesID = $this->request->data['seriesID'];
            }

            if(!empty($this->request->data['newtype'])) {
                $new_type = $this->Types->newEntity();
                $new_type->name = $this->request->data['newtype'];
                if($this->Types->save($new_type)) {
                    $part->typeID = $new_type->typesID;
                }
            } elseif($this->request->data['typeID'] != $part->typeID && !empty($this->request->data['typeID'])) {
                $part->typeID = $this->request->data['typeID'];
            }

            if(!empty($this->request->data['newconn'])) {
                $new_conn = $this->Connections->newEntity();
                $new_conn->name = $this->request->data['newconn'];
                if($this->Connections->save($new_conn)) {
                    $part->connectionID = $new_conn->connectionID;
                }
            } elseif($this->request->data['connectionID'] != $part->connectionID && !empty($this->request->data['connectionID'])) {
                $part->connectionID = $this->request->data['connectionID'];
            }

            if($part->expires != intval($this->request->data['expires'])) {
                $part->expires = intval($this->request->data['expires']);
            }

            if($part->new_list != intval($this->request->data['new_list'])) {
                $part->new_list = intval($this->request->data['new_list']);
            }

            if($result=$this->Parts->save($part)) {
                $data['response'] = "Success: data saved";
            }
            else {
                $data['response'] = "Error: some error";
            }
            $this->redirect(array('controller' => 'admin', 'action' => 'editProductTwo', $part->partID));
        }

        $this->loadModel('TextBlocks');
        $opblock = $this->TextBlocks->find('all',array(
            'conditions' => array(
                'partID' => $id,
            ),
            'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text']]),
        ));

        $cat = TableRegistry::get('Categories')->find('list');
        $type = TableRegistry::get('Types')->find('list');
        $style = TableRegistry::get('Styles')->find('list');
        $series = TableRegistry::get('Series')->find('list');
        $conn = TableRegistry::get('Connections')->find('list');

        $this->set('cat', $cat);
        $this->set('data', $data);
        $this->set('conn', $conn);
        $this->set(compact('series'));
        $this->set('part', $part);
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('conn', $conn);
        $this->set('opblock', $opblock);
    }

    public function editProductTwo($id)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $this->loadModel('Specifications');
        $this->loadModel('TextBlocks');
        $this->loadModel('TextBlockBullets');
        $part = $this->Parts->get($id, ['contain' => ['Series']]);        

        $cat = TableRegistry::get('Categories')->find('list');
        $type = TableRegistry::get('Types')->find('list');
        $style = TableRegistry::get('Styles')->find('list');
        $series = TableRegistry::get('Series')->find('list');

        $part_ops = $this->TextBlocks->find('all', array(
            'conditions' => array(
                'partID' => $id,
                'order_num' => 1
            ),
            'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text',
            'TextBlockBullets.order_num',
            'TextBlockBullets.text_block_bulletID']]),
        ));

        $part_feats = $this->TextBlocks->find('all', array(
            'conditions' => array(
                'partID' => $id,
                'order_num' => 2
            ),
            'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text',
            'TextBlockBullets.order_num',
            'TextBlockBullets.text_block_bulletID']]),
        ));
        // specifications
        $specs = $this->Specifications->find('all',array(
            'conditions' => array(
                'partID' => $id
            ),
            'order' => 'spec_name ASC'
        ));

        // if the part doesn't exist, populate all specifications in dropdown
        $genSpecs = TableRegistry::get('Specifications')->find('all', array(
            'field' => 'spec_name',
            'group' => 'spec_name',
            'order' => 'spec_name ASC'
        ), 'list');

        if ($this->request->is('post') || $this->request->is('put'))  {
            $tb_table = TableRegistry::get('TextBlocks');
            $specs_table = TableRegistry::get('Specifications');
            $ops_tbs = $this->TextBlocks->find('all')->where(['partID' => $part->partID, 'order_num' => 1])->first();
            $feats_tbs = $this->TextBlocks->find('all')->where(['partID' => $part->partID, 'order_num' => 2]);
            $specs_rec = $this->Specifications->find('all')->where(['partID' => $part->partID])->first();

            // delete existing records to create new ones from form data:
            if(!empty($ops_tbs)) {
                $op_block = $this->TextBlocks->find('all')->where(['partID' => $part->partID])->first();
                $tb_table->deleteAll(['partID' => $op_block->partID]);
            }

            if(!empty($specs_rec)) {
                $specs_table->deleteAll(['partID' => $specs_rec->partID]);
            }
            // create arrays to hold form data:
            $operations = array();
            $features = array();
            $specifications = array();
            $spec_names = array();
            $spec_vals = array();
            // loop over form data and insert into arrays
            $ops_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'op_bullet_text') !== false);
            }, 2);
            foreach($ops_rows as $op_name => $name_text) {
                if(!empty($name_text)) {
                    array_push($operations, $name_text);
                }
            }

            $feat_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'feat_bullet_text') !== false);
            }, 2);
            foreach($feat_rows as $feat_name => $name_text) {
                if(!empty($name_text)) {
                    array_push($features, $name_text);
                }
            }

            $names_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'spec_name') !== false);
            }, 2);
            foreach($names_rows as $specif_name => $name_text) {
                if($name_text != -1 && !empty($name_text)) {
                    array_push($spec_names, $name_text);
                }
            }
            
            $vals_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'spec_value') !== false);
            }, 2);
            foreach($vals_rows as $val_name => $name_text) {
                if(!empty($name_text)) {
                    array_push($spec_vals, $name_text);
                }
            }
            
            $long = count($spec_names);
            $short = count($spec_vals);
            if($short > $long) {
                $short = count($spec_names);
                $long = count($spec_vals);
            }
            for($h = 0; $h < $short; $h++) {
                if($spec_names[$h] != "" && $spec_vals[$h] != "") {
                    $specifications[$h][$spec_names[$h]] = $spec_vals[$h];
                }
            }

            // new operations + features objects:
            $new_ops = $this->TextBlocks->newEntity();
            if(count($operations) != 0) {
                $new_ops->partID = $part->partID;
                $new_ops->order_num = 1;
                $new_ops->header = "Operation";
            } 
            
            $new_feats = $this->TextBlocks->newEntity();
            if(count($features) != 0) {
                $new_feats->partID = $part->partID;
                $new_feats->order_num = 2;
                $new_feats->header = "Features";
            }
            
            if($this->TextBlocks->save($new_ops) && $this->TextBlocks->save($new_feats)) {
                // create new text block bullet associations w/ newly created objects
                for($i = 0; $i < count($operations); $i++) {
                    $op_bullet = $this->TextBlockBullets->newEntity();
                    $op_bullet->text_blockID = $new_ops->text_blockID;
                    $op_bullet->bullet_text = $operations[$i];
                    $op_bullet->order_num = $i+1;
                    if($this->TextBlockBullets->save($op_bullet)) {
                        // $this->Flash->success(__('The new operation bullets have been saved outside of found ops block')); 
                    }
                }
                
                for($j = 0; $j < count($features); $j++) {
                    $feat_bullet = $this->TextBlockBullets->newEntity();
                    $feat_bullet->text_blockID = $new_feats->text_blockID;
                    $feat_bullet->bullet_text = $features[$j];
                    $feat_bullet->order_num = $j + 1;
                    if($this->TextBlockBullets->save($feat_bullet)) {
                        // $this->Flash->success(__('The new feature bullets have been saved'));
                    }
                }
            }

            // new specs objects
            $spec_order = 1;
            for($k = 0; $k < count($specifications); $k++) {
                $new_spec = $this->Specifications->newEntity();
                $new_spec->partID = $part->partID;
                $new_spec->spec_name = key($specifications[$k]);
                $new_spec->spec_value = $specifications[$k][$new_spec->spec_name];
                $new_spec->order_num = $spec_order;
                $spec_order++;
                if($this->Specifications->save($new_spec)) {
                    // $this->Flash->success(__('The new specifications have been saved'));
                }
            }

            // update part with description and timestamp
            if(!empty($this->request->data['description'])) {
                $part->description = $this->request->data['description'];
            }
            $part->last_updated = date("Y-m-d H:i:s");

            if($this->Parts->save($part)){
                $this->redirect(array('action' => 'editProductThree', $part->partID));
            }
        }

        $this->set('cat', $cat);
        $this->set(compact('series'));
        $this->set('part', $part);
        $this->set('specs', $specs);
        $this->set('all_specs', $genSpecs);
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('opblock', $part_ops);
        $this->set('featblock', $part_feats);
    }

    public function editProductThree($id)
    {
        // load appropriate variables
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $part = $this->Parts->get($id, ['contain' => ['Series']]);
        $this->set('part', $part);
        $this->loadModel('ModelTables');
        $this->loadModel('ModelTableHeaders');
        $this->loadModel('ModelTableRows');

        $found = $this->ModelTables->find('all', ['conditions' => ['partID' => $id]])->first();
        // handle form submission
        if ($this->request->is('post') || $this->request->is('put'))  {
            // load vars for model tables
            $headerTable = TableRegistry::get('ModelTableHeaders');
            $rowsTable = TableRegistry::get('ModelTableRows');
            $m_tables = TableRegistry::get('ModelTables');

            if(!empty($found)) {
                $m_tables->delete($found);
                $headerTable->deleteAll(['model_tableID' => $found->model_tableID]);
                $rowsTable->deleteAll(['model_tableID' => $found->model_tableID]);
            }

                $table = $this->ModelTables->newEntity();
                $table->partID = $part->partID;
                $table->order_num = 1;

                if($this->ModelTables->save($table)) {                   
                    $headerCounter = 0;
                    foreach (array_filter($this->request->data, function($key) {
                        $header = strpos($key, 'table_header');
                        return ($header === 0);
                    }, 2) as $header) {
                        $headerCounter++;
                        $top = $headerTable->newEntity();
                        $top->model_tableID = $table->model_tableID;
                        $top->model_table_text = $header;
                        $top->order_num = $headerCounter;
                        if ($this->ModelTableHeaders->save($top)) {
                            $model_table_header_id = $top->model_table_headerID;
                        } else {
                            // $this->Flash->error(__('Error saving model table headers'));
                        }
                    }

                    $order_num = 0;
                    $vt_data = array_filter($this->request->data, function($key) {
                        return (strpos($key, 'table_row') === 0);
                    }, 2);

                    $hz_data = array();
                    foreach ($vt_data as $key => $val) {
                        $hz_data[substr($key, 10)] = $val;
                    }

                    uksort($hz_data, function($a, $b) {
                        $ax = strpos($a, '-');
                        $arow = intval(substr($a, 0, $ax));
                        $acol = intval(substr($a, $ax + 1));

                        $bx = strpos($b, '-');
                        $brow = intval(substr($b, 0, $bx));
                        $bcol = intval(substr($b, $bx + 1));

                        $retval = 0;
                        if ($arow < $brow) {$retval = -1;}
                        else if ($brow < $arow) {$retval = 1;}
                        else if ($acol < $bcol) {$retval = -1;}
                        else if ($bcol < $acol) {$retval = 1;}
                        else {$retval = 0;}
                        return $retval;
                    });
                    
                    foreach ($hz_data as $cell ) {
                        $order_num++;
                        $new = $rowsTable->newEntity();
                        $new->model_tableID = $table->model_tableID;
                        $new->model_table_row_text = $cell;
                        $new->order_num = $order_num;
                        if ($this->ModelTableRows->save($new)) {
                            $model_table_header_id = $new->model_table_headerID;
                        } else {
                            // $this->Flash->error(__('Error saving model table rows'));
                            $debug = debug($new);
                        }
                        $this->redirect(array('action' => 'editProductFour', $part->partID));
                    }
                } else {
                    // $this->Flash->error(__('Error saving model table'));
                }
        } else {
            $tables = $this->ModelTables->find('all',array(
                'conditions' => array(
                    'partID' => $id ),
                'contain' => array(
                    'ModelTableHeaders',
                    'ModelTableRows'),
            ))->first();
            
            if(count($tables) < 1) {
                // echo "No current tables found";
            } else {
                $this->set('table', $tables);
            }
        }
    }

    public function editProductFour($id)
    {
        $this->viewBuilder()->setLayout('admin');
        if (!file_exists(WWW_ROOT.'img/parts/'.strval($id))) {
            mkdir(WWW_ROOT.'img/parts/'.strval($id), 0777, true);
        }

        $this->loadModel('Parts');
        $part = $this->Parts->get($id, [
            'contain' => ['Series']
        ]);

        if ($this->request->is('post') || $this->request->is('put')) {
            if(!empty($this->request->data['thumbnail']['name']))
            {
                $file = $this->request->data['thumbnail'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');

                if(in_array($ext, $arr_ext))
                {
                    // James: I'm forcing all files to be named .jpg even when they aren't jpgs so we can delete them more easily
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/thumbnail.jpg');
                    // $this->Flash->success(__('The file SCHEMATIC_DRAWING.JPG was saved.', h($part->partid)));
                }
            } elseif (isset($this->request->data['kill-thumbnail']) && $this->request->data['kill-thumbnail']) {
                unlink(WWW_ROOT . 'img/parts/' . strval($id) . '/thumbnail.jpg');
            }

            if(!empty($this->request->data['product_image']['name']))
            {
                $file = $this->request->data['product_image']; 
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); 

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/product_image.jpg');
                    // $this->Flash->success(__('The file PRODUCT IMAGE was saved.', h($part->partid)));
                }
            } elseif (isset($this->request->data['kill-product_image']) && $this->request->data['kill-product_image']) {
                unlink(WWW_ROOT . 'img/parts/' . strval($id) . '/product_image.jpg');
            }

            if(!empty($this->request->data['schematic']['name']))
            {
                $file = $this->request->data['schematic'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/schematic_drawing.jpg');
                    // $this->Flash->success(__('The file SCHEMATIC_DRAWING.JPG was saved.', h($part->partid)));
                }
            } elseif (isset($this->request->data['kill-schematic']) && $this->request->data['kill-schematic']) {
                unlink(WWW_ROOT . 'img/parts/' . strval($id) . '/schematic_drawing.jpg');
            }

            if(!empty($this->request->data['ordering']['name']))
            {
                $file = $this->request->data['ordering'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/ordering_information.jpg');
                    // $this->Flash->success(__('The file ORDERING_INFORMATION.JPG was saved.', h($part->partid)));
                }
            } elseif (isset($this->request->data['kill-ordering']) && $this->request->data['kill-ordering']) {
                unlink(WWW_ROOT . 'img/parts/' . strval($id) . '/ordering_information.jpg');
            }

            if(!empty($this->request->data['performance']['name']))
            {
                $file = $this->request->data['performance'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png');

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/typical_performance.jpg');
                    // $this->Flash->success(__('The file TYPICAL_PERFORMANCE.JPG was saved.', h($part->partid)));
                }
            } elseif (isset($this->request->data['kill-performance']) && $this->request->data['kill-performance']) {
                unlink(WWW_ROOT . 'img/parts/' . strval($id) . '/typical_performance.jpg');
            }

            if(!empty($this->request->data['graph']['name']))
            {
                $file = $this->request->data['graph'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('pdf');

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/' . strval($id) . '/performance_graphs.pdf');
                    $this->Flash->success(__('The file PERFORMANCE GRAPHS was saved.', h($part->partid)));
                }
            } elseif (isset($this->request->data['kill-graph']) && $this->request->data['kill-graph']) {
                unlink(WWW_ROOT . 'img/parts/' . strval($id) . '/performance_graphs.pdf');
            }

            $this->redirect(array('action' => 'editProductFive',$part->partID));
        }

        $this->loadModel('TextBlocks');
        $opblock = $this->TextBlocks->find('all',array(
            'conditions' => array(
                'partID' => $id,
            ),
            'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text']]),
        ));

        $cat = TableRegistry::get('Categories')->find('list');
        $type = TableRegistry::get('Types')->find('list');
        $style = TableRegistry::get('Styles')->find('list');
        $series = TableRegistry::get('Series')->find('list');

        $this->set('cat', $cat);
        $this->set(compact('series'));
        $this->set('part', $part);
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('opblock', $opblock);
    }

    public function editProductFive($id)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $count = 0;
        $part = $this->Parts->get($id, [
            'contain' => ['Series','Specifications','TextBlocks' => ['TextBlockBullets']]
        ]);

        if (!file_exists(WWW_ROOT.'img/parts/'.strval($id))) {
            mkdir(WWW_ROOT.'img/parts/'.strval($id), 0777, true);
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $files = $this->request->data['stp_files'];
            foreach ($files as $file){
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
                $arr_ext = array('stp', 'pdf', 'txt'); 
                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($part->partID).'/'.strval($this->request->data['filename'][$count]).'.stp');
                    // $this->Flash->success(__('The STP file  was saved.', h($part->partid)));
                }
                ++$count;
            }

            $this->redirect(array('action' => 'index'));
        }

        $this->loadModel('ModelTables');
        $this->loadModel('Parts');
        $table = $this->ModelTables->find('all',array(
            'conditions' => array(
                'partID' => $id,
            ),
            'contain' => array('ModelTableHeaders', 'ModelTableRows'),
        ))->first();

        $this->set('table', $table);
        $this->set('part', $part);
    }

    public function partDelete($id)
    {
        $this->loadModel('Parts');
        $this->Security->validatePost = false;
        $part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            return $this->redirect($this->referer());
        }
    }

    public function replaceCatalog() 
    {
        if(file_exists(WWW_ROOT.'img/pdfs/VONBERG-Product_Catalog.pdf')) {
            unlink(WWW_ROOT.'img/pdfs/VONBERG-Product_Catalog.pdf');
        }

        $new_pdf = $this->request->data['catalog_file'];
        move_uploaded_file($new_pdf['tmp_name'], WWW_ROOT . 'img/pdfs/VONBERG-Product_Catalog.pdf');
        $this->render(FALSE);
        return $this->redirect($this->referer());
    }

    public function manageResources() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $gen_query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 2]]);
        $tech_query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 1]]);
        $app_query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 3]]);

        $this->set('generals', $gen_query);
        $this->set('technicals', $tech_query);
        $this->set('applications', $app_query);
    }

    public function generalInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 2]]);

        $this->set('specs', $query);
    }

    public function technicalDocumentation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 1]]);

        $this->set('specs', $query);
    }

    public function applicationInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 3]]);

        $this->set('specs', $query);
    }

    public function addResource() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        if($this->request->is('post') || $this->request->is('put')) {
            $spec = $this->TechnicalSpecs->newEntity();
            $spec->files = strval($this->request->data['filepath']);
            $spec->resource = intval($this->request->data['resource']);
            $spec->title = $this->request->data['title'];
            $spec->last_updated = date("Y-m-d H:i:s");
            
            if(!empty($this->request->data['file']['name']))
            {
                $file = $this->request->data['file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            }
                
            if ($this->TechnicalSpecs->save($spec)) {
                $this ->redirect(array('action' => 'index'));
            } else {
                // $this->Flash->error(__('The resource could not be saved.'));
            }
        }
    }

    public function editResources() 
    {
        $this->viewBuilder()->setLayout('admin');

        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 2]]);
        $query2 =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 1]]);
        $query3 =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 3]]);

        if($this->request->is('post') || $this->request->is('put')) {
            $id = intval($this->request->data['id']);
            
            if(!empty($this->request->data['gen_file']['name']))
            {
                $resource = TableRegistry::get('TechnicalSpecs')->get($id);
                $resource->resource = 2;
                $resource->last_updated = date("Y-m-d H:i:s");

                if(!empty($this->request->data['tech_title'])) {
                    $title = $this->request->data['tech_title'];
                    $resource->title = $title;
                }
                
                if(!empty($this->request->data['filepath'])) {
                    $path = $this->request->data['filepath'];
                    $resource->files = $path;
                }
            
                $file = $this->request->data['gen_file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            } else {
                // print_r($this->request->data['gen_file']);
            }

            if(!empty($this->request->data['tech_file']['name']))
            {
                $resource = TableRegistry::get('TechnicalSpecs')->get($id);
                $resource->resource = 3;
                $resource->last_updated = date("Y-m-d H:i:s");

                if(!empty($this->request->data['tech_title'])) {
                    $title = $this->request->data['tech_title'];
                    $resource->title = $title;
                }
                
                if(!empty($this->request->data['filepath'])) {
                    $path = $this->request->data['filepath'];
                    $resource->files = $path;
                }
            
                $file = $this->request->data['tech_file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            } else {
                // print_r($this->request->data['tech_file']);
            }

            if(!empty($this->request->data['app_file']['name']))
            {
                $resource = TableRegistry::get('TechnicalSpecs')->get($id);
                $resource->resource = 1;
                $resource->last_updated = date("Y-m-d H:i:s");

                if(!empty($this->request->data['tech_title'])) {
                    $title = $this->request->data['tech_title'];
                    $resource->title = $title;
                }
                
                if(!empty($this->request->data['filepath'])) {
                    $path = $this->request->data['filepath'];
                    $resource->files = $path;
                }
            
                $file = $this->request->data['app_file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            } else {
                // print_r($this->request->data['app_file']);
            }
            
            TableRegistry::get('TechnicalSpecs')->save($resource);
            return $this->redirect($this->referer());
        }

        $this->set('generals', $query);
        $this->set('technicals', $query2);
        $this->set('applications', $query3);
    }

    public function editGeneralInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 2]]);

        if($this->request->is('post') || $this->request->is('put')) {
            $id = intval($this->request->data['id']);
            
            $resource = TableRegistry::get('TechnicalSpecs')->get($id);
            $resource->resource = 2;
            $resource->last_updated = date("Y-m-d H:i:s");

            if(!empty($this->request->data['gen_file']['name']))
            {
                $file = $this->request->data['gen_file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            } else {
                print_r($this->request->data['gen_file']);
            }
            
            if(!empty($this->request->data['tech_title'])) {
                $title = $this->request->data['tech_title'];
                $resource->title = $title;
            }
            
            if(!empty($this->request->data['filepath'])) {
                $path = $this->request->data['filepath'];
                $resource->files = $path;
            }
            
            TableRegistry::get('TechnicalSpecs')->save($resource);
            return $this->redirect($this->referer());
        }

        $this->set('specs', $query);
    }
    
    public function editTechnicalDocumentation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 1]]);

        if($this->request->is('post') || $this->request->is('put')) {
            $id = intval($this->request->data['id']);
            
            $resource = TableRegistry::get('TechnicalSpecs')->get($id);
            $resource->resource = 1;
            $resource->last_updated = date("Y-m-d H:i:s");

            if(!empty($this->request->data['tech_file']['name']))
            {
                $file = $this->request->data['tech_file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            } else {
                print_r($this->request->data['tech_file']);
            }
            
            if(!empty($this->request->data['tech_title'])) {
                $title = $this->request->data['tech_title'];
                $resource->title = $title;
            }
            
            if(!empty($this->request->data['filepath'])) {
                $path = $this->request->data['filepath'];
                $resource->files = $path;
            }
            
            TableRegistry::get('TechnicalSpecs')->save($resource);
            return $this->redirect($this->referer());
        }
        $this->set('specs', $query);
    }
    
    public function editApplicationInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all', ['conditions' => ['resource' => 3]]);

        if($this->request->is('post') || $this->request->is('put')) {
            $id = intval($this->request->data['id']);
            
            $resource = TableRegistry::get('TechnicalSpecs')->get($id);
            $resource->resource = 3;
            $resource->last_updated = date("Y-m-d H:i:s");

            if(!empty($this->request->data['app_file']['name']))
            {
                $file = $this->request->data['app_file'];
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/pdfs/technical_specifications/' . $this->request->data['filepath']);
            } else {
                // print_r($this->request->data['app_file']);
            }
            
            if(!empty($this->request->data['tech_title'])) {
                $title = $this->request->data['tech_title'];
                $resource->title = $title;
            }
            
            if(!empty($this->request->data['filepath'])) {
                $path = $this->request->data['filepath'];
                $resource->files = $path;
            }
            
            TableRegistry::get('TechnicalSpecs')->save($resource);
            return $this->redirect($this->referer());
        }

        $this->set('specs', $query);
    }

    public function resourceDelete($id)
    {
        $this->loadModel('TechnicalSpecs');
        $spec = $this->TechnicalSpecs->get($id);
        if ($this->TechnicalSpecs->delete($spec)) {
            return $this->redirect($this->referer());
        }
    }

    public function generatePDF()
    {
        $this->viewBuilder()->setLayout('admin');

        $cat = TableRegistry::get('Categories')->find('list')->orderAsc('name');
        $type = TableRegistry::get('Types')->find('list')->orderAsc('name');
        $style = TableRegistry::get('Styles')->find('list')->orderAsc('name');
        $series = TableRegistry::get('Series')->find('list')->orderAsc('name');
        $conn = TableRegistry::get('Connections')->find('list')->orderAsc('name');
        $this->loadModel('Specifications');

        $genSpecs = TableRegistry::get('Specifications')->find('all', array(
            'field' => 'spec_name',
            'group' => 'spec_name',
            'order' => 'spec_name ASC'
        ), 'list');

        $this->set('cat', $cat);
        $this->set('conn', $conn);
        $this->set(compact('series'));
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('all_specs', $genSpecs);
    }

    public function modelPricing()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('ModelPrices');
        $series = TableRegistry::get('Series')->find('all');
        $pricing = TableRegistry::get('ModelPrices')->find('all')->orderAsc('model_text');
        $query =  $this->ModelPrices->find('all', ['order' => array('model_text' => 'ASC')]);

        if($this->request->is('post') || $this->request->is('put'))  {
            $id = intval($this->request->data['id']);
            $model_text = $this->request->data['model_text'];
            $unit_price = $this->request->data['unit_price'];

            $target = $this->ModelPrices->get($id);
            $target->model_text = $model_text;
            $target->unit_price = $unit_price;

            $this->ModelPrices->save($target);
            return $this->redirect($this->referer());
        }

        $this->set('prices', $query);
        $this->set(compact('series'));
    }

    public function addPrice()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('ModelPrices');
        if($this->request->is('post') || $this->request->is('put')) {
            $new_price = $this->ModelPrices->newEntity();
            $new_price->model_text = $this->request->data['add_text'];
            $new_price->unit_price = $this->request->data['add_price'];
            if(!empty($this->request->data['description'])) {
                $new_price->description = $this->request->data['description'];
            }

            $this->ModelPrices->save($new_price);
            return $this->redirect($this->referer());
        }
    }

    public function priceImport() 
    {
        if($_FILES['csv']){
            $filename = explode('.', $_FILES['csv']['name']);
            if($filename[1] =='csv'){
                $MP = TableRegistry::get('ModelPrices');
                $old = $MP->find('all')->toArray();
                foreach ($old as $o) {
                    $MP->delete($o);
                }

                $handle = fopen($_FILES['csv']['tmp_name'], "r");
                while (($line = fgetcsv($handle)) !== FALSE) {
                    $newEntry = $MP->newEntity();
                    $newEntry->unit_price = array_pop($line);
                    $newEntry->description = array_pop($line);
                    $newEntry->model_text = array_pop($line);
                    $MP->save($newEntry);
                }
                fclose($handle);
            }

            if(file_exists(WWW_ROOT.'csv/model_prices.csv')) {
                unlink(WWW_ROOT.'csv/model_prices.csv');
            }
    
            $new_model_file = $_FILES['csv'];
            move_uploaded_file($new_model_file['tmp_name'], WWW_ROOT . 'csv/model_prices.csv');
        }
        $this->render(FALSE);
        return $this->redirect($this->referer());
    }

    public function priceExport()
    {
        $this->loadModel('ModelPrices');
        $data = $this->ModelPrices->find('all', array('fields' => array('ModelPrices.model_text', 'ModelPrices.description', 'ModelPrices.unit_price')))->orderAsc('model_priceID')->toArray();
        $_serialize = 'data';
        $this->response->download('model_prices.csv');
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }

    public function downloadSTP()
    {
        $this->viewBuilder()->setLayout('admin');
        $stp_users = TableRegistry::get('StpUsers')->find('all')->orderDesc('last_login');
        $stp_users->contain(['StpFile'=>['Parts','ModelTableRows']]);
        $this->set('stp_users', $stp_users);
    }

    public function stpExport()
    {
        $data = TableRegistry::get('StpUsers')->find('all')->orderDesc('stp_userID');
        $l = ConnectionManager::get('default');
        $lookup = "SELECT stp_users.email, stp_users.first_name, stp_users.last_name, stp_users.company, DATE(stp_users.last_login), stp_userxstp_file.modelID FROM stp_userxstp_file JOIN stp_users ON stp_users.stp_userID = stp_userxstp_file.stp_userID ORDER BY stp_userxstp_file.stp_userxstp_fileID DESC";
        $stmt = $l->execute($lookup);
        $res = $stmt->fetchAll();

        $_serialize = 'res';
        $_header = ['Email', 'First Name', 'Last Name', 'Company', 'Last Login', 'Files Requested'];
        $this->response->download('stp_downloads.csv'); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('res', '_serialize', '_header'));
    }

    public function contacts()
    {
        $this->viewBuilder()->setLayout('admin');
        $contacts = TableRegistry::get('Contacts')->find('all')->orderDesc('date_submitted');
        $this->set('contacts', $this->paginate($contacts));
    }

    public function contactExport()
    {
        $data = TableRegistry::get('Contacts')->find()->orderDesc('date_submitted');
        $_serialize = 'data';
        $this->response->download('contacts.csv'); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }
}