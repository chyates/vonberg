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
        $series = TableRegistry::get('Series')->find();

        $query = $this->ModelPrices
            // Use the plugins 'search' custom finder and pass in the
            // processed query params
            ->find('search', ['search' => $this->request->getQueryParams()]);
            // You can add extra things to the query if you need to
            //->contain(['Connections', 'Types','Series','Styles', 'Categories','ModelTables'=> ['ModelTableRows']]);

        $this->set('prices', $this->paginate($query));
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