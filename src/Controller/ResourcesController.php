<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class ResourcesController extends AppController
{

  public function beforeFilter(Event $event)
    {
       // allow all action
    $this->Auth->allow([ 'index','info']);
    $this->viewBuilder()->setLayout('default');

    }

    public function index()
    {

    }
    public function info()
    {

    }
}