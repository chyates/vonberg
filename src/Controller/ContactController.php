<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;


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
        }    }

    public function stp()
    {

        $data = [];
        $this->loadModel('StpUsers');
        $emp=$this->StpUsers->newEntity();
        if($this->request->is('post')) {
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);
            if($result=$this->StpUsers->save($emp)) {
                $email = new Email('default');
                $email->from(['info@vonberg.com' => 'Vonberg Valve'])
                    ->to('darren.mckeeman@gmail.com')
                    ->template('default', 'default')
                    ->viewVars(['data'=> $result])
                    ->subject('File Request from an End User')
                    ->send();

                $data['response'] = "Success: data saved";
                //echo $result->id;
            }
            else {
                $data['response'] = "Error: some error";
                //print_r($emp);
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