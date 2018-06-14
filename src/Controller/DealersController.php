<?php
namespace App\Controller;

use App\Controller\AppController;
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
       // allow all action
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
        $uploadData = '';
        if ($this->request->is('post')) {
            if(!empty($this->request->data['upload']['name'])){
                $fileName = $this->request->data['upload']['name'];
                $options = array(
                    // Refer to php.net fgetcsv for more information
                    'length' => 0,
                    'delimiter' => ',',
                    'enclosure' => '"',
                    'escape' => '\\',
                    // Generates a Model.field headings row from the csv file
                    'headers' => true,
                );
                $uploadPath = WWW_ROOT.'/csv/';
                $uploadFile = $uploadPath.$fileName;
                move_uploaded_file($this->request->data['upload']['tmp_name'], WWW_ROOT . 'csv' .DS. $this->request->data['upload']['name']);
                $uploadData = $this->Dealers->importCsv($uploadFile, $options);
                $this->Flash->success(__('The dealers have been saved.'));
                //return $this->redirect($this->referer());
                //return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('Please choose a file to upload.'));
            }

        }

        $dealers = $this->paginate($this->Dealers);
        $this->set(compact('dealers'));
        $this->viewBuilder()->setLayout('admin');
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
        $this->set('uploadData', $uploadData);
   
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
        $data = $this->Dealers->find()->all();
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
        $filepath = WWW_ROOT.'/csv/dealers.csv';
        $this->Dealers->exportCsv($filepath, $data, $options);
        return $this->redirect('/csv/dealers.csv');    }

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
