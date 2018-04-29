<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ProductsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index','new']);
        $this->viewBuilder()->setLayout('default');

    }
    public function index()
    {

    }
    public function new()
    {
        $this->viewBuilder()->setLayout('default');
    }
}
