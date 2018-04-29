<?php
namespace App\Controller;

use App\Controller\AppController;

class ResourcesController extends AppController
{
    public function beforeFilter()
    {
        // allow all action
        $this->Auth->allow(['index']);
    }
    public function index()
    {

    }
}
