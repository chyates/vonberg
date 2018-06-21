<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
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
                echo $result->id;
            }
            else {
                echo "Error: some error";
                //print_r($emp);
            }
        }    }

    public function stp()
    {

        $data = [];
        $this->loadModel('StpUsers');
        $this->loadModel('StpFile');
        $this->loadModel('Parts');

        $file_table = TableRegistry::get('StpFile');

        // instantiate empty STP user and STP file objects:
        $emp=$this->StpUsers->newEntity();
        $association = $this->StpFile->newEntity();

        // extract part id from url:
        $part_id = '';
        $curr_url = $this->request->here;
        for($j = 0; $j < strlen($curr_url); $j++) {
            if($curr_url[$j] == 'w') {
                for($x = $j +2; $x < strlen($curr_url); $x++) {
                    $part_id .= $curr_url[$x];
                }
            }
        }

        if($this->request->is('post')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);
            $model_count = 0;

            if($result=$this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                // for($i = 0; $i < $this->request->data.length; $i++) {
                //     if($this->request->data[$i]['model'] !== '0') {
                //         $association->set(

                //         )
                //     }
                // }
                //echo $result->id;
                // Send email to client:
                // $attachment = 
                // $email = new Email();
                // $email->setFrom(['cyates@trunkclub.com' => 'My Site'])
                //     ->setTo('chyatesil@gmail.com')
                //     ->setSubject('Testing STP email functionality')
                //     ->attachments()
                //     ->send('Example message');
            }
            else {
                $data['response'] = "Error: some error";
                //print_r($emp);
            }
            $association->set([
                'stp_userID' => $emp->$stp_userID,
                'partID' => $part_id,
                'modelID' => 67140
            ]);
            $file_table->save($association);
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');

    }
    public function process()
    {

    }
}