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
        $this->Security->setConfig('unlockedActions', ['editProduct','editProductTwo','editProductThree','editProductFour','editProductFive']);

    }

    public function view()
    {
        $this->viewBuilder()->setLayout('admin');
        $cat = TableRegistry::get('Categories')->find();
        $this->set('categories', $cat);

    }

    public function catalog($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        // query for main categories:
        $query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.categoryID =' => $id],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));

            $cat = TableRegistry::get('Categories')->find();
            $this->set('parts', $query);
            $this->set('id', $id);
            $cat1 = TableRegistry::get('Categories')->find()->where(['categoryID' => $id])->first();
            $this->set('categories', $cat);
            $this->set('pagename', $cat1->name);            
    }

    public function type($id)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');

        $type_query =  $this->paginate($this->Parts->find('all', ['conditions' => ['Parts.typeID =' => $id],'contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
        $subcat = TableRegistry::get('Types')->find();
        $this->set('parts', $type_query);
        $this->set('id', $id);
        $subcat1 = TableRegistry::get('Types')->find()->where(['typesID' => $id])->first();
        $this->set('subcats', $subcat);
        $this->set('pagename', $subcat1->name);
    }


    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', ['contain' => ['Connections', 'Types','Series','Styles', 'Categories']]));
        $cat = TableRegistry::get('Categories')->find();
        $this->set('parts', $query);
        $this->set('categories', $cat);
        $this->set('dealer_time',filemtime(WWW_ROOT.'csv/upload_dealers.csv'));
        $this->set('catalog_time',filemtime(WWW_ROOT.'img/pdfs/VONBERG-Product_Catalog.pdf'));

    }
    
    public function get_cat()
    {
        return TableRegistry::get('Categories')->find();

    }

    public $components=array('RequestHandler');

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
                echo "Error: some error";
                //print_r($emp);
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
                echo "Error: some error";
                //print_r($emp);
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
                echo "Error: some error";
                //print_r($emp);
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
                echo "Error: some error";
                //print_r($emp);
            }
        }
    }

    public function partAdd() 
    {
        if($this->request->is('post')) {
            $data = [];
            $this->loadModel('Parts');
            $part=$this->Parts->newEntity();
            $part=$this->Parts->patchEntity($part,$this->request->data);
            if($result=$this->Parts->save($part)) {
                $data['response'] = "Success: data saved";
            }
            else {
                $data['response'] = "Error: some error";
                //print_r($emp);
            }
            $this->redirect(array('controller' => 'admin', 'action' => 'editProductTwo', $part->partID));
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
                //print_r($emp);
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
                //print_r($emp);
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
        // required
        $this->set(compact('series'));
        // Save logic goes here
        $this->set('part', $part);
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('conn', $conn);
        $this->set('opblock', $opblock);
    }

    public function editProductOne($id)
    {
        $this->viewBuilder()->setLayout('admin');
        if ($this->request->is('post') || $this->request->is('put'))  {
            $this->loadModel('Parts');
            $part = $this->Parts->get($id);
            $part = $this->Parts->patchEntity($part, $this->request->data);
            $part->last_updated = date("Y-m-d H:i:s");
            if($this->Parts->save($part)){
                $this->Flash->success(__('The resource with id: {0} has been saved.', h($part->partid)));
                $this->redirect(array('action' => 'editProductTwo',$part->partID));
            }
        }
        $this->loadModel('TextBlocks');
        $this->loadModel('Parts');
        $opblock = $this->TextBlocks->find('all',array(
            'conditions' => array(
                'partID' => $id,
            ),
            'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text']]),
        ));
        $part = $this->Parts->get($id);

        $cat = TableRegistry::get('Categories')->find('list');
        $type = TableRegistry::get('Types')->find('list');
        $style = TableRegistry::get('Styles')->find('list');

        $series = TableRegistry::get('Series')->find('list');
        $conn = TableRegistry::get('Connections')->find('list');
        $this->set('conn', $conn);
        $this->set('cat', $cat);
        $this->set(compact('series'));
        // Save logic goes here
        $this->set('part', $part);
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('opblock', $opblock);
    }

    public function editProductTwo($id)
    {
        $this->viewBuilder()->setLayout('admin');

        // first call: load appropriate variables--existing text blocks + specs, part data, DB data for form options:
        $this->loadModel('TextBlocks');
        $this->loadModel('TextBlockBullets');
        $this->loadModel('Parts');
        $this->loadModel('Specifications');
        $part = $this->Parts->get($id);
        $cat = TableRegistry::get('Categories')->find('list');
        $type = TableRegistry::get('Types')->find('list');
        $style = TableRegistry::get('Styles')->find('list');
        $series = TableRegistry::get('Series')->find('list');

        // if the part already exists, populate the associated data:
            // operations + features
        $opblock = $this->TextBlocks->find('all',array(
            'conditions' => array(
                'partID' => $id,
            ),
            'contain' => array('TextBlockBullets' => ['fields' => ['TextBlockBullets.text_blockID','TextBlockBullets.bullet_text']]),
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
            // manual part creation:
            $operations = array();
            $features = array();
            $specifications = array();
            $spec_names = array();
            $spec_vals = array();

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
            // new operations + features + specs objects:
            $new_ops = $this->TextBlocks->newEntity();
            $new_ops->partID = $part->partID;
            $new_ops->order_num = 1;
            $new_ops->header = "Operation";

            $new_feats = $this->TextBlocks->newEntity();
            $new_feats->partID = $part->partID;
            $new_feats->order_num = 2;
            $new_feats->header = "Features";

            if($this->TextBlocks->save($new_ops) && $this->TextBlocks->save($new_feats)) {
                $this->Flash->success(__('Operations array: {0}', $operations));
                // create new text block bullet associations w/ newly created objects
                for($i = 0; $i < count($operations); $i++) {
                    $op_bullet = $this->TextBlockBullets->newEntity();
                    $op_bullet->text_blockID = $new_ops->text_blockID;
                    $op_bullet->bullet_text = $operations[$i];
                    $op_bullet->order_num = $i+1;
                    if($this->TextBlockBullets->save($op_bullet)) {
                        $this->Flash->success(__('The new operation bullets have been saved')); 
                    }
                }

                for($j = 0; $j < count($features); $j++) {
                    $feat_bullet = $this->TextBlockBullets->newEntity();
                    $feat_bullet->text_blockID = $new_feats->text_blockID;
                    $feat_bullet->bullet_text = $features[$j];
                    $feat_bullet->order_num = $j + 1;
                    if($this->TextBlockBullets->save($feat_bullet)) {
                        $this->Flash->success(__('The new feature bullets have been saved'));
                    }
                }
            }

            $spec_order = 1;
            for($k = 0; $k < count($specifications); $k++) {
                $new_spec = $this->Specifications->newEntity();
                $new_spec->partID = $part->partID;
                $new_spec->spec_name = key($specifications[$k]);
                $new_spec->spec_value = $specifications[$k][$new_spec->spec_name];
                $new_spec->order_num = $spec_order;
                $spec_order++;
                if($this->Specifications->save($new_spec)) {
                    $this->Flash->success(__('The new specifications have been saved'));
                }
            }

            // update part with description and timestamp
            $part->description = $this->request->data['description'];
            $part->last_updated = date("Y-m-d H:i:s");
            if($this->Parts->save($part)){
                $this->Flash->success(__('The resource with id: {0} has been saved.', $part->partid));
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
        $this->set('opblock', $opblock);
    }

    public function editProductThree($id)
    {
        // load appropriate variables
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $part = $this->Parts->get($id);
        $this->set('part', $part);

        // handle form submission
        if ($this->request->is('post') || $this->request->is('put'))  {
            // load vars for model tables
            $this->loadModel('ModelTables');
            $headerTable = TableRegistry::get('ModelTableHeaders');
            $rowsTable = TableRegistry::get('ModelTableRows');
            $found = $this->ModelTables->find('all')->where(['partID >' => $id])->first();
            if(!empty($found)) {
                $table = $this->ModelTables->find('all')->where(['partID >' => $id])->first();
                // delete headers and rows to put them back in
                $headerTable->deleteAll(['model_tableID' => $table->model_tableID]);
                $rowsTable->deleteAll(['model_tableID' => $table->model_tableID]);
            } else {
                $table = $this->ModelTables->newEntity();
            }

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
                if ($headerTable->save($top)) {
                    // The variable entity contains the id now
                    $model_table_header_id = $top->model_table_headerID;
//                    $debug = debug($top);
//                    $this->set('debug', $debug);
                } else {

                }
            }
            $order_num = 0;
            $rows = array_filter($this->request->data, function($key) {
                return (strpos($key, 'model_name') === 0);
            }, 2);

            $cells = array();

            foreach ($rows as $name => $val) {
                $n = substr($name, 11);
                $x = strpos($n, '-');
                $rowNum = substr($name, 11, $x);
                $arr = array_filter($this->request->data, function($key){
                    global $rowNum;
                    return (strpos($key, 'table_row_' . $rowNum));
                }, 2);
                $arr[$name] = $val;
                array_push($cells, $arr);
            }

            foreach ($cells as $row ) {   # allow for empty cells EXCEPT in the first column
                foreach ($row as $cell) {
                    $order_num++;

                    $new = $rowsTable->newEntity();
                    $new->model_tableID = $table->model_tableID;
                    $new->model_table_row_text = $cell;
                    $new->order_num = $order_num;
                    if ($rowsTable->save($new)) {
                        // The variable entity contains the id now
                        $model_table_header_id = $new->model_table_headerID;
                    } else {
                        $debug = debug($new);
                    }
                }
            }
        } else {
            
            $this->loadModel('ModelTables');
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
        if (!file_exists(WWW_ROOT.'img/parts/'.strval($id))) {
            mkdir(WWW_ROOT.'img/parts/'.strval($id), 0777, true);
        }
        $this->loadModel('Parts');
        $part = $this->Parts->get($id, [
            'contain' => ['Series']
        ]);
        $this->viewBuilder()->setLayout('admin');
        if ($this->request->is('post')) {
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
                    $this->Flash->success(__('The file SCHEMATIC_DRAWING.JPG was saved.', h($part->partid)));
                }
            }
            if(!empty($this->request->data['performance']['name']))
            {
                $file = $this->request->data['performance']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/typical_performance.jpg');
                    $this->Flash->success(__('The file TYPICAL_PERFORMANCE.JPG was saved.', h($part->partid)));
                }
            }
            if(!empty($this->request->data['hydraulic']['name']))
            {
                $file = $this->request->data['hydraulic']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/hydraulic_symbol.jpg');
                    $this->Flash->success(__('The file HYDRAULIC_SYMBOL.JPG was saved.', h($part->partid)));
                }
            }
            if(!empty($this->request->data['ordering']['name']))
            {
                $file = $this->request->data['ordering']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                //only process if the extension is valid
                if(in_array($ext, $arr_ext))
                {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($id).'/ordering_information.jpg');
                    $this->Flash->success(__('The file ORDERING_INFORMATION.JPG was saved.', h($part->partid)));
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
        // Save logic goes here
        $this->set('part', $part);
        $this->set('type', $type);
        $this->set('style', $style);
        $this->set('opblock', $opblock);
    }

    public function editProductFive($id)
    {
        $count=0;
        $this->viewBuilder()->setLayout('admin');
        if (!file_exists(WWW_ROOT.'img/parts/'.strval($id))) {
            mkdir(WWW_ROOT.'img/parts/'.strval($id), 0777, true);
        }
        $this->loadModel('Parts');
        $part = $this->Parts->get($id, [
            'contain' => ['Series','Specifcations','TextBlocks' => ['TextBlockBullets']]
        ]);
//           full contain for reference ['contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications', 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]
        $this->viewBuilder()->setLayout('admin');
        if ($this->request->is('post')) {
            $files = $this->request->data['stp_files'];
            foreach ($files as $file){
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('stp'); //set allowed extensions
                if(in_array($ext, $arr_ext))
                {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/parts/'.strval($part->partID).'/'.strval($this->request->data['filename'][$count]).'.stp');
                    $this->Flash->success(__('The STP file  was saved.', h($part->partid)));
                }
                ++$count;
            }

            $this->redirect(array('action' => 'category',$part->catID));
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

        // Save logic goes here
        $this->set('part', $part);
        $this->set('table', $table);

    }

    public function generatePDF()
    {
        $this->viewBuilder()->setLayout('admin');
    }

    public function new()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Parts');
        $query =  $this->paginate($this->Parts->find('all', array('limit'=>10, 'group' =>array('typeID'), 'order'=>array('last_updated DESC')))->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]));

        // $query = $this->Parts->find('all', array('limit'=>10, 'group' =>array('typeID'), 'order'=>array('last_updated DESC')))->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);

        // $this->loadModel('Parts');
        // $this->set('parts',$query);

        $this->set('parts', $query);
        $this->set('pagename', 'New Products');

    }


    public function priceExport()
    {
        $this->loadModel('ModelPrices');
        $data = $this->ModelPrices->find('all')->toArray();

        $_serialize = 'data';

        $this->response->download('model_prices.csv'); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }


    public function priceImport() {
        if(isset($_POST["submit"])){
            if($_FILES['file']['csv']){
                $filename = explode('.', $_FILES['file']['csv']);
                debug($filename);
                if($filename[1]=='csv'){

                    $handle = fopen($_FILES['file']['csv'], "r");
                    while ($data = fgetcsv($handle)){
                        $item1 = $data[0];

                        $data = array(
                            'fieldName' => $item1
                        );
                        //  $item2 = $data[1];
                        //  $item3 = $data[2];
                        //  $item4 = $data[3];
                        $Applicant = $this->Applicants->newEntity($data);
                        $this->Applicants->save($Applicant);
                    }
                    fclose($handle);
                }
            }
        }
        $this->render(FALSE);
        $this->Flash->set('Model Prices Imported');
        return $this->redirect($this->referer());
    }


    public function modelPricing()
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('ModelPrices');
        $series = TableRegistry::get('Series')->find('all');

        $pricing = TableRegistry::get('ModelPrices')->find('all');

        $this->set('prices', $pricing);
        $this->set(compact('series'));
    }

    public function manageResources() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 2]]);
        $this->set('generals', $query);
        $query2 =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 1]]);
        $this->set('technicals', $query2);
        $query3 =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 3]]);
        $this->set('applications', $query3);
    }

    public function editResources() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->viewBuilder()->setLayout('admin');
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 2]]);
        $this->set('generals', $query);
        $query2 =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 1]]);
        $this->set('technicals', $query2);
        $query3 =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 3]]);
        $this->set('applications', $query3);
    }

    public function addResource() 
    {
        $this->viewBuilder()->setLayout('admin');
            $this->loadModel('TechnicalSpecs');
            if($this->request->is('post')) {
                $spec = $this->TechnicalSpecs->newEntity();
                $spec = $this->TechnicalSpecs->patchEntity($spec, $this->request->data);
                $spec->last_updated = date("Y-m-d H:i:s");
                if ($this->TechnicalSpecs->save($spec)) {
                    $this->Flash->success(__('The resource has been saved.'));
                    $this ->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The resource with could not be saved.'));
                }
            }

    }

    public function editGeneralInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 2]]);
        $this->set('specs', $query);
    }
    
    public function editTechnicalDocumentation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 1]]);
        $this->set('specs', $query);
    }
    
    public function editApplicationInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 3]]);
        $this->set('specs', $query);
    }

    public function generalInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 2]]);
        $this->set('specs', $query);

    }

    public function technicalDocumentation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 1]]);
        $this->set('specs', $query);

    }

    public function applicationInformation() 
    {
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 3]]);
        $this->set('specs', $query);

    }

    public function stpExport()
    {
        $data = TableRegistry::get('StpUsers')->find()->orderDesc('last_login');


        $_serialize = 'data';

        $this->response->download('stp_downloads.csv'); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }

    public function contactExport()
    {
        $data = TableRegistry::get('Contacts')->find()->orderDesc('date_submitted');


        $_serialize = 'data';

        $this->response->download('contacts.csv'); // <= setting the file name
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize'));
    }

    public function resourceDelete($id)
    {
        $this->loadModel('TechnicalSpecs');
        $spec = $this->TechnicalSpecs->get($id);
        if ($this->TechnicalSpecs->delete($spec)) {
            $this->Flash->success(__('The resource with id: {0} has been deleted.', h($id)));
            return $this->redirect($this->referer());
        }
    }

    public function partDelete($id)
    {
        $this->loadModel('Parts');
        $this->Security->validatePost = false;
        $part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            $this->Flash->success(__('The part with id: {0} has been deleted.', h($id)));
            return $this->redirect($this->referer());
        }
    }


    public function contacts()
    {
        $this->viewBuilder()->setLayout('admin');
        $contacts = TableRegistry::get('Contacts')->find('all')->orderDesc('date_submitted');
        $this->set('contacts', $this->paginate($contacts));

    }
    public function downloadSTP()
    {
        $this->viewBuilder()->setLayout('admin');
        $stp_users = TableRegistry::get('StpUsers')->find('all')->orderDesc('last_login');
        $stp_users->contain(['StpFile'=>['Parts','ModelTableRows']]);
        $this->set('stp_users', $this->paginate($stp_users));

    }
}
