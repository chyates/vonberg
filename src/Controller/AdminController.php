<?php
/**
 * Created by PhpStorm.
 * User: lycurgus
 * Date: 4/23/18
 * Time: 3:14 PM
 */

    namespace App\Controller;

    use App\Controller\AppController;
    use App\Controller\File;
    use Cake\ORM\TableRegistry;
    use Cake\View\View;
    use Cake\View\ViewBuilder;



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
            $this->set('dealer_time',filemtime(WWW_ROOT.'csv/upload_dealers.csv'));
            $this->set('catalog_time',filemtime(WWW_ROOT.'img/pdfs/VONBERG-Product_Catalog.pdf'));

        }
        public function get_cat()
        {
            return TableRegistry::get('Categories')->find();

        }
        public $components=array('RequestHandler');
        public function catAdd() {
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
                $this->request->data['name'] = $this->request->query['name'];
                $cat = $this->Types->patchEntity($cat, $this->request->data);
                if ($result = $this->Types->save($cat)) {
                    echo $result->id;
                } else {
                    echo "Error: some error";
                    //print_r($emp);
                }
            }
        }
        public function seriesAdd() {
        $this->loadModel('Series');
        $cat=$this->Series->newEntity();
        if($this->request->is('ajax')) {
            $this->autoRender=false;
            $this->request->data['name']=$this->request->query['name'];
            $cat=$this->Series->patchEntity($cat,$this->request->data);
            if($result=$this->Series->save($cat)) {
                echo $result->id;
            }
            else {
                echo "Error: some error";
                //print_r($emp);
                }
            }
        }
        public function connAdd() {
        $this->loadModel('Connections');
        $cat=$this->Connections->newEntity();
        if($this->request->is('ajax')) {
            $this->autoRender=false;
            $this->request->data['name']=$this->request->query['name'];
            $cat=$this->Connectionss->patchEntity($cat,$this->request->data);
            if($result=$this->Connections->save($cat)) {
                echo $result->id;
            }
            else {
                echo "Error: some error";
                //print_r($emp);
                }
            }
        }
        public function partAdd() {
            $this->loadModel('Parts');
            $cat=$this->Connections->newEntity();
            if($this->request->is('ajax')) {
                $this->loadModel('Parts');
                $part = $this->Parts->newEntity();
                $part = $this->Parts->patchEntity($part, $this->request->data);
                $part->last_updated = date("Y-m-d H:i:s");
                if($this->Parts->save($part)){
                    $this->redirect(array('action' => 'editProductTwo',$part->partID));
                }
            }
        }

        public function addProduct()
        {
            $this->viewBuilder()->setLayout('admin');
            $cat = TableRegistry::get('Categories')->find('list');
            $type = TableRegistry::get('Types')->find('list');
            $style = TableRegistry::get('Styles')->find('list');
            $series = TableRegistry::get('Series')->find('list');
            $conn = TableRegistry::get('Connections')->find('list');
            $this->set('cat', $cat);
            $this->set('conn', $conn);
            $this->set(compact('series'));
            $this->set('type', $type);
            $this->set('style', $style);
        }

        public function editProduct($id)
        {
            $this->viewBuilder()->setLayout('admin');
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

            $this->set('cat', $cat);
            $this->set(compact('series'));
            // Save logic goes here
            $this->set('part', $part);
            $this->set('type', $type);
            $this->set('style', $style);
            $this->set('opblock', $opblock);

        }

        public function editProductOne($id)
        {
            $this->viewBuilder()->setLayout('admin');
            if ($this->request->is('post')) {
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
            if ($this->request->is('post')) {
                $this->loadModel('Parts');
                $part = $this->Parts->get($id);
                $part = $this->Parts->patchEntity($part, $this->request->data);
                $part->last_updated = date("Y-m-d H:i:s");
                if($this->Parts->save($part)){
                    $this->Flash->success(__('The resource with id: {0} has been saved.', h($part->partid)));
                    $this->redirect(array('action' => 'editProductThree',$part->partID));
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

            $this->set('cat', $cat);
            $this->set(compact('series'));
            // Save logic goes here
            $this->set('part', $part);
            $this->set('type', $type);
            $this->set('style', $style);
            $this->set('opblock', $opblock);

        }
        public function editProductThree($id)
        {
            $this->viewBuilder()->setLayout('admin');
            if ($this->request->is('post')) {
                $this->loadModel('Parts');
                $part = $this->Parts->get($id);
                $part = $this->Parts->patchEntity($part, $this->request->data);
                $part->last_updated = date("Y-m-d H:i:s");
                if($this->Parts->save($part)){
                    $this->Flash->success(__('The resource with id: {0} has been saved.', h($part->partid)));
                    $this->redirect(array('action' => 'editProductFour',$part->partID));
                }
            }

            $this->loadModel('ModelTables');
            $tables = $this->ModelTables->find('all',array(
                'conditions' => array(
                    'partID' => $id,
                ),
                'contain' => array('ModelTableHeaders', 'ModelTableRows'),
            ))->first();
            $this->set('table', $tables);

        }
        public function editProductFour($id)
        {
            $this->viewBuilder()->setLayout('admin');
            if ($this->request->is('post')) {
                $this->loadModel('Parts');
                $part = $this->Parts->get($id);
                $part = $this->Parts->patchEntity($part, $this->request->data);
                $part->last_updated = date("Y-m-d H:i:s");
                if($this->Parts->save($part)){
                    $this->Flash->success(__('The resource with id: {0} has been saved.', h($part->partid)));
                    $this->redirect(array('action' => 'editProductFive',$part->partID));
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
            $this->viewBuilder()->setLayout('admin');
            if ($this->request->is('post')) {
                $this->loadModel('Parts');
                $part = $this->Parts->get($id);
                $part = $this->Parts->patchEntity($part, $this->request->data);
                $part->last_updated = date("Y-m-d H:i:s");
                if($this->Parts->save($part)){
                    $this->Flash->success(__('The resource with id: {0} has been saved.', h($part->partid)));
                    $this->redirect(array('action' => 'index'));
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

            $this->set('cat', $cat);
            $this->set(compact('series'));
            // Save logic goes here
            $this->set('part', $part);
            $this->set('type', $type);
            $this->set('style', $style);
            $this->set('opblock', $opblock);

        }

        public function generatePDF()
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function new()
        {
            $this->viewBuilder()->setLayout('admin');

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
