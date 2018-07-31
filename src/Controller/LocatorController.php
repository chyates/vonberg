<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Geo\Geocoder\Geocoder;
use Cake\Http\Client;

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
            $address = urlencode($this->request->data['zip']);
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyCeCUFNTzQXY_J_HYtw6JAhr6fyCl5RoZE";
            $resp_json = file_get_contents($url);
            $resp = json_decode($resp_json, true);

            if($resp['status'] == 'OK') {
                $lat = $resp['results'][0]['geometry']['location']['lat'];
                $lng = $resp['results'][0]['geometry']['location']['lng'];

                $options = [
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'radius' => 200
                ];
                    
                $query = $myTable->find('bydistance', $options)->select(['name','address1','address2', 'city','state','zip','telephone', 'lat', 'lng']);
            }
        }
        $this->set('query', $query);
    }
}
