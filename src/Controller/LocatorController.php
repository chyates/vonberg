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
        $this->Auth->allow(['index']);
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('vonberg');
        $query = array();
        $lat = '';
        $lng = '';

        if ($this->request->is('post')) {
            $myTable = TableRegistry::get('Dealers');

            $lat_query = $myTable->find('all', array('conditions'=> ['Dealers.zip' => $this->request->data['zip']]))->select(['lat'])->first();
            $lng_query = $myTable->find('all', array('conditions' => ['Dealers.zip' => $this->request->data['zip']]))->select(['lng'])->first();

            $lat = intval($lat_query->lat);
            $lng = intval($lng_query->lng); 

            $options = [
                'latitude' => $lat,
                'longitude' => $lng,
                'radius' => 200
            ];

            $query = $myTable->find('bydistance', $options)->select(['name','address1','address2', 'city','state','zip','telephone', 'lat', 'lng']);
        }
        $this->set('query', $query);
    }
}
