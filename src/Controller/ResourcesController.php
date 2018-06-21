<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class ResourcesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index', 'info', 'generalInformation', 'technicalDocumentation', 'applicationInformation']);
        $this->viewBuilder()->setLayout('default');

    }

    public function index()
    {
        $this->loadModel('ModelPrices');
        $this->loadModel('TechnicalSpecs');

        $query = $this->ModelPrices
        // Use the plugins 'search' custom finder and pass in the
        // processed query params
        ->find('search', ['search' => $this->request->getQueryParams()]);
        // You can add extra things to the query if you need to
        //->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);
        $query2 =  $this->TechnicalSpecs->find('all',
        [   'conditions' => ['resource' => 1], 'limit' => 3]);
        $query3 =  $this->TechnicalSpecs->find('all',
        [   'conditions' => ['resource' => 3]]);
        $query4 =  $this->TechnicalSpecs->find('all',
        [   'conditions' => ['resource' => 2]]);
        
        $series = TableRegistry::get('Series')->find()->orderAsc('name');
        
        
        $this->set('prices', $this->paginate($query));
        $this->set('generals', $query4);
        $this->set('technicals', $query2);
        $this->set('applications', $query3);
        $this->set(compact('series'));
    }

    public function generalInformation()
    {

        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 2]]);
        $this->set('specs', $query);


    }

    public function technicalDocumentation()
    {
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 1]]);
        $this->set('specs', $query);

    }

    public function applicationInformation()
    {
        $this->loadModel('TechnicalSpecs');
        $query =  $this->TechnicalSpecs->find('all',
            [   'conditions' => ['resource' => 3]]);
        $this->set('specs', $query);

    }
}