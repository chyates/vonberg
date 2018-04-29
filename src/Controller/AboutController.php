<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class AboutController extends AppController
{
    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['index']);
    }
    public function index()
    {

    }
}
