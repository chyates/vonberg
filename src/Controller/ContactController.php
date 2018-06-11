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

    }

    public function stp()
    {
        $data = [];

        $emp = $this->StpUsers->newEntity();
        if ($this->request->is('ajax')) {

            $this->request->data['model'] = $this->request->query['model'];
            $this->request->data['name'] = $this->request->query['name'];
            $this->request->data['email'] = $this->request->query['email'];
            $this->request->data['company'] = $this->request->query['company'];
            $emp = $this->StpUsers->patchEntity($emp, $this->request->data);
            if ($result = $this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                //echo $result->id;
            } else {
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
}