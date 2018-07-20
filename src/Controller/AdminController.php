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


class AdminController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        // allow all action
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
        $this->set('dealer_time', filemtime(WWW_ROOT.'csv/upload_dealers.csv'));
        $this->set('catalog_time', filemtime(WWW_ROOT.'img/pdfs/VONBERG-Product_Catalog.pdf'));
    }

    public function new()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', array('conditions' => array('new_list' => 1), 'order'=>array('last_updated DESC')))->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]));
        
        $this->set('parts', $query);
        $this->set('pagename', 'New Products');
    }
    
    public function products()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query = $this->paginate($this->Parts->find('all', array('order' => array('last_updated DESC')))->contain(['Connections', 'Types', 'Series', 'Styles', 'Categories']));

        $this->set('parts', $query);
        $this->set('pagename', 'All Products');
    }

    // category pages
    public function catalog($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        // query for main categories:
        $query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.categoryID =' => $id],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));

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

        $type_query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.typeID =' => $id], 'order' => 'Series.name ASC', 'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
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

    // AJAX functions from add/edit product 1 slide modals
    public function catAdd() 
    {
        $this->loadModel('Categories');
        $cat=$this->Categories->newEntity();
        if($this->request->is('ajax')) {
            $this->autoRender=false;
            $this->request->data['name']=$this->request->query['name'];
            $cat=$this->Categories->patchEntity($cat,$this->request->data);
            if($result=$this->Categories->save($cat)) {
                echo $result->id;
            }
            else {
                // echo "Error: some error";
            }
        }
    }

    public function typeAdd()
    {
        $this->loadModel('Types');
        $cat = $this->Types->newEntity();
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->request->data['name']=$this->request->query['name'];
            $cat = $this->Types->patchEntity($cat, $this->request->data);
            if ($result = $this->Types->save($cat)) {
                echo $result->id;
            } else {
                // echo "Error: some error";
            }
        }
    }

    public function seriesAdd() 
    {
        $this->loadModel('Series');
        $cat=$this->Series->newEntity();
        if($this->request->is('ajax')) {
            $this->autoRender=false;
            $this->request->data['name']=$this->request->query['name'];
            $cat=$this->Series->patchEntity($cat,$this->request->data);
            if($result=$this->Series->save($cat)) {
                echo $result->id;
            } else {
                // echo "Error: some error";
            }
        }
    }

    public function connAdd() 
    {
        $this->loadModel('Connections');
        $cat=$this->Connections->newEntity();
        if($this->request->is('ajax')) {
            $this->autoRender=false;
            $this->request->data['name']=$this->request->query['name'];
            $cat=$this->Connections->patchEntity($cat,$this->request->data);
            if($result=$this->Connections->save($cat)) {
                echo $result->id;
            } else {
                // echo "Error: some error";
            }
        }
    }

    public function partAdd() 
    {
        if($this->request->is('post')) {
            $this->loadModel('Parts');

            $data = [];
            $part=$this->Parts->newEntity();
            $part=$this->Parts->patchEntity($part,$this->request->data);
            if($result=$this->Parts->save($part)) {
                $data['response'] = "Success: data saved";
            }
            else {
                $data['response'] = "Error: some error";
            }
            $this->redirect(array('controller' => 'admin', 'action' => 'editProductTwo', $part->partID));
        }
    }

    // AJAX function to toggle new status, products + catalog + type pages
    public function checkNew() 
    {
        $this->loadModel('Parts');
        if($this->request->is('ajax')) {
            $this->autoRender = false;
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
                // return json_encode($part);
            } else {
                // echo "Error: some error";
            }
        }
    }

    public function addProduct()
    {
        $this->viewBuilder()->setLayout('admin');
        $data = [];
        
        // load variables to generate form options:
        $cat = TableRegistry::get('Categories')->find('list')->orderAsc('name');
        $type = TableRegistry::get('Types')->find('list')->orderAsc('name');
        $style = TableRegistry::get('Styles')->find('list')->orderAsc('name');
        $series = TableRegistry::get('Series')->find('list')->orderAsc('name');
        $conn = TableRegistry::get('Connections')->find('list')->orderAsc('name');
            
        if($this->request->is('post') || $this->request->is('put'))  {
            // create part:
            $this->loadModel('Parts');
            $part=$this->Parts->newEntity();
            $part->seriesID = $this->request->data['seriesID'];
            $part->styleID = $this->request->data['styleID'];
            $part->categoryID = $this->request->data['categoryID'];
            $part->typeID = $this->request->data['typeID'];
            $part->connectionID = $this->request->data['connectionID'];
            $part->expires = intval($this->request->data['expires']);
            $part->new_list = intval($this->request->data['new_list']);

            // save part:
            if($result=$this->Parts->save($part)) {
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
        $part=$this->Parts->get($id);
        $data = [];
        if($this->request->is('post') || $this->request->is('put'))  {
            $data['debug'] = "passing post";
            $part=$this->Parts->patchEntity($part,$this->request->data);
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
        // first call: load appropriate variables--existing text blocks + specs, part data, DB data for form options:
        $this->loadModel('Parts');
        $this->loadModel('Specifications');
        $this->loadModel('TextBlocks');
        $this->loadModel('TextBlockBullets');
        $part = $this->Parts->get($id);        

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
                'partID' => $id,
            ),
        ));

        // if the part doesn't exist, populate all specifications in dropdown
        $genSpecs = TableRegistry::get('Specifications')->find('all', array(
            'field' => 'spec_name',
            'group' => 'spec_name',
            'order' => 'spec_name ASC'
        ), 'list');

        
        // second call: user has filled out the form--submit the data
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
                array_push($operations, $name_text);
            }

            $feat_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'feat_bullet_text') !== false);
            }, 2);
            foreach($feat_rows as $feat_name => $name_text) {
                array_push($features, $name_text);
            }

            $names_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'spec_name') !== false);
            }, 2);
            foreach($names_rows as $specif_name => $name_text) {
                array_push($spec_names, $name_text);
            }

            $vals_rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'spec_value') !== false);
            }, 2);
            foreach($vals_rows as $val_name => $name_text) {
                array_push($spec_vals, $name_text);
            }

            $name_index = 0;
            for($h = 0; $h < count($spec_names); $h++) {
                $specifications[$h][$spec_names[$h]] = $spec_vals[$h];
            }

            // new operations + features objects: 
            $new_ops = $this->TextBlocks->newEntity();
            $new_ops->partID = $part->partID;
            $new_ops->order_num = 1;
            $new_ops->header = "Operation";
            
            $new_feats = $this->TextBlocks->newEntity();
            $new_feats->partID = $part->partID;
            $new_feats->order_num = 2;
            $new_feats->header = "Features";
            
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
            $part->description = $this->request->data['description'];
            $part->last_updated = date("Y-m-d H:i:s");
            if($this->Parts->save($part)){
                $this->redirect(array('action' => 'editProductThree', $part->partID));
            }
        }

        // set view variables
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
        $part = $this->Parts->get($id);
        $this->set('part', $part);
        $this->loadModel('ModelTables');
        $this->loadModel('ModelTableHeaders');
        $this->loadModel('ModelTableRows');

        $found = $this->ModelTables->find('all')->where(['partID' => $id])->toList();
        $this->set('found', $found);
        // handle form submission
        if ($this->request->is('post') || $this->request->is('put'))  {
            // load vars for model tables
            $headerTable = TableRegistry::get('ModelTableHeaders');
            $rowsTable = TableRegistry::get('ModelTableRows');
            $m_tables = TableRegistry::get('ModelTables');
            if(!empty($found)) {   
                $m_tables->deleteAll(['partID' => $id]);
                // delete headers and rows to put them back in
                $headerTable->deleteAll(['model_tableID' => $found[0]->model_tableID]);
                $rowsTable->deleteAll(['model_tableID' => $found[0]->model_tableID]);
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
                            // The variable entity contains the id now
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
                    
                    foreach ($hz_data as $cell ) {   # allow for empty cells EXCEPT in the first column
                        $order_num++;
                        $new = $rowsTable->newEntity();
                        $new->model_tableID = $table->model_tableID;
                        $new->model_table_row_text = $cell;
                        $new->order_num = $order_num;
                        if ($this->ModelTableRows->save($new)) {
                            // The variable entity contains the id now
                            $model_table_header_id = $new->model_table_headerID;
                            $this->redirect(array('action' => 'editProductFour', $part->partID));
                        } else {
                            // $this->Flash->error(__('Error saving model table rows'));
                            $debug = debug($new);
                        }
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
            if(!empty($this->request->data['schematic']['name']))
            {
                $file = $this->request->data['schematic']; //put the data into a var for easy use
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/schematic_drawing.jpg');
                    // $this->Flash->success(__('The file SCHEMATIC_DRAWING.JPG was saved.', h($part->partid)));
                }
            }
            if(!empty($this->request->data['performance']['name']))
            {
                $file = $this->request->data['performance'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/typical_performance.jpg');
                    // $this->Flash->success(__('The file TYPICAL_PERFORMANCE.JPG was saved.', h($part->partid)));
                }
            }
            if(!empty($this->request->data['hydraulic']['name']))
            {
                $file = $this->request->data['hydraulic'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/hydraulic_symbol.jpg');
                    // $this->Flash->success(__('The file HYDRAULIC_SYMBOL.JPG was saved.', h($part->partid)));
                }
            }
            if(!empty($this->request->data['ordering']['name']))
            {
                $file = $this->request->data['ordering'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                if(in_array($ext, $arr_ext))
                {
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/ordering_information.jpg');
                    // $this->Flash->success(__('The file ORDERING_INFORMATION.JPG was saved.', h($part->partid)));
                }
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

        $count=0;
        if (!file_exists(WWW_ROOT.'img/parts/'.strval($id))) {
            mkdir(WWW_ROOT.'img/parts/'.strval($id), 0777, true);
        }
        $part = $this->Parts->get($id, [
            'contain' => ['Series','Specifications','TextBlocks' => ['TextBlockBullets']]
        ]);

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
        $part = $this->Parts->get($id);

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
                print_r($this->request->data['app_file']);
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
            // $this->Flash->success(__('The resource with id: {0} has been deleted.', h($id)));
            return $this->redirect($this->referer());
        }
    }

    public function generatePDF()
    {
        $this->viewBuilder()->setLayout('admin');

        // load variables to generate form options:
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

        // handle submit
        if($this->request->is('post') || $this->request->is('put'))  {
            // $this->redirect(array('controller' => 'admin', 'action' => 'generatePdf2'));
        }

        // set variables for form data:
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
        $pricing = TableRegistry::get('ModelPrices')->find('all');

        if($this->request->is('post') || $this->request->is('put'))  {
            $id = intval($this->request->data['id']);
            $model_text = $this->request->data['model_text'];
            $unit_price = $this->request->data['unit_price'];

            $target = TableRegistry::get('ModelPrices')->get($id);
            $target->model_text = $model_text;
            $target->unit_price = $unit_price;

            TableRegistry::get('ModelPrices')->save($target);
        }

        $this->set('prices', $pricing);
        $this->set(compact('series'));
    }

    public function priceImport() 
    {
        if($_FILES['csv']){
            $filename = explode('.', $_FILES['csv']['name']);
            if($filename[1]=='csv'){
                $MP = TableRegistry::get('ModelPrices');
                $old = $MP->find('all')->toArray();
                foreach ($old as $o) {
                    $MP->delete($o);
                }

                $handle = fopen($_FILES['csv']['tmp_name'], "r");
                while (($line = fgetcsv($handle)) !== FALSE) {
                    $newEntry = $MP->newEntity();
                    $newEntry->unit_price = array_pop($line);
                    $newEntry->model_text = array_pop($line);
                    $MP->save($newEntry);
                }
                fclose($handle);
            }
        }
        $this->render(FALSE);
        //$this->Flash->set('Model Prices Imported');
        return $this->redirect($this->referer());
    }

    public function priceExport()
    {
        $this->loadModel('ModelPrices');
        $data = $this->ModelPrices->find('all')->toArray();
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
        $this->set('stp_users', $this->paginate($stp_users));
    }

    public function stpExport()
    {
        $data = TableRegistry::get('StpUsers')->find('all')->orderDesc('stp_userID');
        $file_data = TableRegistry::get('StpFile')->find('all')->orderDesc('stp_userID');
        $_serialize = ['data', 'file_data'];
        $_header = ['User ID', 'Email', 'First Name', 'Last Name', 'Company', 'Last Login', 'Files Acquired'];
        $this->response->download('stp_downloads.csv'); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', 'file_data', '_serialize', '_header'));
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
