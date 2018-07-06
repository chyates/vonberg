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
        $this->loadModel('ModelTableRows');

        // extract part id from url:
        $part_id = '';
        $curr_url = $this->request->here;
        for($j = 0; $j < strlen($curr_url); $j++) {
            if($curr_url[$j] == '/' && $curr_url[$j-1] == 'w') {
                for($x = $j; $x < strlen($curr_url); $x++) {
                    $part_id .= $curr_url[$x];
                }
            }
        }
        $final_id = intval($part_id);

        // instantiate empty STP user and STP file objects:
        $emp=$this->StpUsers->newEntity();
        // $association = $this->StpFile->newEntity();

        if($this->request->is('post')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);
            if($result=$this->StpUsers->save($emp)) {
                // Send email to client:
                $file_paths = '';
                if(!empty($this->request->data['model'])) {
                    foreach($this->request->data['model'] as $str_model) {
                        if(strval($str_model) != "0") {
                            $file_paths .= strval($str_model);
                            $file_paths .= ".stp, ";
                        }
                    }
                }
                Email::deliver('info@vonberg.com', 'STP File Request From: '.$this->request->data['first_name']." ".$this->request->data['last_name'], 'Please respond to: '.$this->request->data['email'].' with the following files: '.$file_paths, ['from' => 'do-not-reply@vonberg.com']);
                $data['response'] = "Success: data saved";
                $data['debug'] = $result;
                $models = [];
                $this->Flash->success(__('The request has been saved.'));
                // foreach ($this->request->data['model'] as $model) {
                //     $files=$this->StpFile->newEntity();
                //     $files->stp_userID = $result->stp_userID;
                //     $files->partID = $final_id;
                //     $files->modelID = intval($model);
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