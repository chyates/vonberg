<?php
namespace App\Controller;

use App\Controller\File;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Dealers Controller
 *
 * @property \App\Model\Table\DealersTable $Dealers
 *
 * @method \App\Model\Entity\Dealer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DealersController extends AppController
{
     public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['view', 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    /**
     * View method
     *
     * @param string|null $id Dealer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $dealer = $this->Dealers->get($id, [
            'contain' => []
        ]);

        $this->set('dealer', $dealer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('admin');
        $dealer = $this->Dealers->newEntity();
        if ($this->request->is('post')) {
            $dealer = $this->Dealers->patchEntity($dealer, $this->request->getData());
            if ($this->Dealers->save($dealer)) {
                $this->Flash->success(__('The dealer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dealer could not be saved. Please, try again.'));
        }
        $this->set(compact('dealer'));
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('admin');

        $uploadData = '';
        if ($this->request->is('post')) {
            if($_FILES['upload']) {
                $filename = explode('.', $_FILES['upload']['name']);
                if($filename[1] == 'csv') {
                    $dists = TableRegistry::get('Dealers');
                    $d_old = $dists->find('all')->toArray();
                    foreach($d_old as $d) {
                        $dists->delete($d);
                    }
    
                    $handle = fopen($_FILES['upload']['tmp_name'], "r");
                    while(($line = fgetcsv($handle)) !== FALSE) {
                        $new_dist = $dists->newEntity();
                        $new_dist->price_class = array_pop($line);
                        $new_dist->fax = array_pop($line);
                        $new_dist->long = array_pop($line);
                        $new_dist->lat = array_pop($line);
                        $new_dist->telephone = array_pop($line);
                        $new_dist->zip = array_pop($line);
                        $new_dist->state = array_pop($line);
                        $new_dist->country = array_pop($line);
                        $new_dist->city = array_pop($line);
                        $new_dist->address2 = array_pop($line);
                        $new_dist->address1 = array_pop($line);
                        $new_dist->name = array_pop($line);
                        if($dists->save($new_dist)) {
                            $this->Flash->success(__('The dealers have been saved. '));
                        } else {
                            $this->Flash->error(__('Please choose a file to upload.'));
                        }
                    }
                    fclose($handle);
                }

                if(file_exists(WWW_ROOT.'csv/dealers.csv')) {
                    unlink(WWW_ROOT.'csv/dealers.csv');
                }
        
                $new_dist_file = $_FILES['upload'];
                move_uploaded_file($new_dist_file['tmp_name'], WWW_ROOT . 'csv/distributors.csv');
                $this->render(FALSE);
                return $this->redirect($this->referer());
            }
        }

        $dealers = $this->paginate($this->Dealers);
        $this->set(compact('dealers'));
    	$options = array(
            // Refer to php.net fgetcsv for more information
            'length' => 0,
            'delimiter' => ',',
            'enclosure' => '"',
            'escape' => '\\',
            // Generates a Model.field headings row from the csv file
            'headers' => true,
            // If true, String $content is the data, not a path to the file
            'text' => false,
        );
        // $this->set('uploadData', $uploadData);
    }


    /**
     * Edit method
     *
     * @param string|null $id Dealer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $dealer = $this->Dealers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dealer = $this->Dealers->patchEntity($dealer, $this->request->getData());
            if ($this->Dealers->save($dealer)) {
                $this->Flash->success(__('The dealer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dealer could not be saved. Please, try again.'));
        }
        $this->set(compact('dealer'));
    }

    public function dealerExport()
    {
        $this->loadModel('Dealers');

        $data = $this->Dealers->find()->all();
        $_serialize = 'data';
        // $_headers = ['name', 'address1', 'address2', 'city', 'country', 'state', 'zip', 'telephone', 'fax', 'price_class'];
        $_extract = ['name', 'address1', 'address2', 'city', 'country', 'state', 'zip', 'telephone', 'fax', 'price_class'];
        $this->response->download('distributors.csv');
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_serialize', '_extract'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dealer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->setLayout('admin');
        $this->request->allowMethod(['post', 'delete']);
        $dealer = $this->Dealers->get($id);
        if ($this->Dealers->delete($dealer)) {
            $this->Flash->success(__('The dealer has been deleted.'));
        } else {
            $this->Flash->error(__('The dealer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
