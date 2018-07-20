<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class LocatorController extends AppController
{

    public function beforeFilter(Event $event)
    {
       // allow all action
        $this->Auth->allow([ 'index']);
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('vonberg');
        $query= array();
        $lat='';
        $lng='';
            if ($this->request->is('post')) 
                {
                $pages ='';
                    if ($this->request->is('post')) {
        $myTable = TableRegistry::get('Dealers');
        $options = [
            'latitude' => $this->request->data['lat'],
            'longitude' => $this->request->data['lng'],
            'radius' => 200
        ];
        $lat=$this->request->data['lat'];
        $lng=$this->request->data['lng'];
        $query = $myTable
            ->find('bydistance', $options)
            ->select(['name','address1','address2', 'city','state','zip','telephone','fax', 'lat', 'lng']);
                        }	
                }
        $this->set('query', $query);
        $this->set('lat', $lat);
        $this->set('lng', $lng);
    }
}
