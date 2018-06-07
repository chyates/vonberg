<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class ContactController extends AppController
{
    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index', 'process']);
        $this->viewBuilder()->setLayout('default');

    }

    public function index()
    {

    }

    public function process() 
    {
        
    }
}