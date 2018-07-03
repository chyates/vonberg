<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Mailer\Email;
// use Cake\Network\Email;
use Cake\ORM\TableRegistry;

class ContactController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['stp','index', 'process']);
        $this->Security->setConfig('unlockedActions', ['stp']);
        if ($this->request->param('action') === 'stp') {
            $this->eventManager()->off($this->Csrf);
        }
        $this->viewBuilder()->setLayout('default');

    }

    public function index()
    {
        $this->loadModel('Contacts');
        $cat=$this->Contacts->newEntity();
        if($this->request->is('post')) {
            $cat=$this->Contacts->patchEntity($cat,$this->request->data);
            if($result=$this->Contacts->save($cat)) {
                $this->redirect(array('action' => 'success'));
            }
            else {
                echo "Error: some error";
            }
        }    
    }

    public function stp()
    {

        $data = [];
        $this->loadModel('StpUsers');
        $this->loadModel('StpFile');
        $this->loadModel('Parts');

        // instantiate empty STP user and STP file objects:
        $emp=$this->StpUsers->newEntity();
        // $association = $this->StpFile->newEntity();

        if($this->request->is('post')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);

            if($result=$this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                $data['debug'] = $result;
                $models = [];
                $this->Flash->success(__('The request has been saved.'));

                // $this->loadModel('ModelTableRows');
                // foreach ($this->request->data['model'] as $model) {
                //     $files=$this->StpFile->newEntity();
                //     $files->stp_userID = $result->stp_userID;
                //     $files->partID = $final_id;
                //     $files->modelID = $model;
                //     $files = $this->StpFile->save($files);

                //     if (strval($model) != 0) {
                //         $tables = $this->ModelTableRows->find('all', array(
                //             'conditions' => array(
                //                 'model_table_rowID' => $model,
                //             ),
                //         ))->first();
                //         array_push($models, $tables);
                //     }
                // }
                // Send email to client:
                // $attachments = $file_array;
                $email = new Email('default');
                $email->from(['do-not-reply@vonberg.com'])
                    ->to(['chyatesil@gmail.com', 'Carolyn Yates'])
                    // $email->addTo('jlevon@vonberg.com');
                    // $email->addTo('Mwhite@vonberg.com');*/
                    ->subject('File Request from '.$this->request->data['email'])
                    ->viewVars(['data'=> $result, 'models' => $models])
                    ->template('stp_email','default')
                    ->send();
            }
            else {
                $data['response'] = "Error: some error";
                print_r($emp);
                $this->Flash->success(__('The request has not been saved.'));
            }
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');

    }
    public function process()
    {

    }
    public function success()
    {

    }
}