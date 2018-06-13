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

        }
        public function get_cat()
        {
            return TableRegistry::get('Categories')->find();

        }

        public function addProduct()
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function editProduct($id)
        {
            $this->viewBuilder()->setLayout('admin');
            $this->loadModel('TextBlocks');
            $this->loadModel('Parts');
            $opblock = $this->TextBlocks->find('list',array(
                'conditions' => array(
                    'partID' => $id,
                    'header' => 'Operation'
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
        }

        public function editResources() 
        {
            $this->viewBuilder()->setLayout('admin');
        }

        public function addResource() 
        {
            $this->viewBuilder()->setLayout('admin');
            if ($this->request->is('post')) {
                $specTable = TableRegistry::get('TechnicalSpecs');
                $spec = $specTable->newEntity();
                $spec['file'] = $this->request->data['file'];
                $spec['resource'] = $this->request->data['resource'];
                $spec['title'] = $this->request->data['title'];
                if ($spec->save()) {
                    $this ->Session -> setFlash(__('The Resource has been saved'));
                    $this ->redirect(array('action' => 'index'));
                } else {
                    $this -> Session -> setFlash(__('The Resource could not be saved. Please, try again.'));
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

        public function resourceDelete($id)
        {
            $this->loadModel('TechnicalSpecs');
            $spec = $this->TechnicalSpecs->get($id);
            if ($this->TechnicalSpecs->delete($spec)) {
                $this->Flash->success(__('The resource with id: {0} has been deleted.', h($id)));
                return $this->redirect($this->referer());
            }
        }

        public function downloadSTP()
        {
            $this->viewBuilder()->setLayout('admin');
            $stp_users = TableRegistry::get('StpUsers')->find('all')->orderDesc('last_login');
            $stp_users->contain(['StpFile'=>['Parts','ModelTableRows']]);
            $this->set('stp_users', $this->paginate($stp_users));

        }
    }
