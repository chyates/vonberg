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
    $this->Auth->allow([ 'index', 'general-information', 'technical-documentation', 'application-information']);
        }

    public function index()
    {

    }

    public function generalInformation()
    {

    }

    public function technicalDocumentation()
    {

    }

    public function applicationInformation()
    {

    }
}