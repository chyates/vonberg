<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ContactController extends AppController
{
    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['stp','index', 'process']);
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
        if ($this->request->is('ajax')) {
            $stp_users = TableRegistry::get('StpUsers');
            $stp_users = $stp_users->newEntity();
            $this->request->data['first_name'] = $this->query['first_name'];
            $this->request->data['last_name'] = $this->query['last_name'];
            $this->request->data['email'] = $this->query['email'];
            $this->request->data['company'] = $this->query['company'];
            $emp = $stp_users->patchEntity($emp, $this->request->data);
            if ($result = $this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                //echo $result->id;
            } else {
                $data['response'] = "Error: some error";
                print_r($emp);
            }
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
    public function process()
    {

    }
}