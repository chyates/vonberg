<?php
namespace App\Controller;

use App\Controller\File;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;


// App::uses('AppController', 'Controller');
class ApiController extends AppController
{
  public function beforeFilter(Event $event)
  {
      // allow all action
      $this->Auth->allow(['index','allProducts']);
      // $this->viewBuilder()->setLayout('default');

  }

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
  }

  public function index()
  {
    // return 'youuuu';
  }

  public function allProducts()
  {
    $this->loadModel('Parts');
    // $this->set('parts', $this->Parts->find('all'));
    $parts = $this->Parts->find('all', ['contain' => ['Connections', 'Types','Series','Styles', 'Categories', 'Specifications' => ['sort' => ['Specifications.spec_name' => 'ASC']], 'TextBlocks' => ['TextBlockBullets'],'ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]]);
    $this->set('parts', $parts);
    // $this->set('_serialize', 'parts');
  }
}
