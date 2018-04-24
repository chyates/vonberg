<?php
/**
 * Created by PhpStorm.
 * User: lycurgus
 * Date: 4/23/18
 * Time: 3:14 PM
 */

    namespace App\Controller;

    use App\Controller\AppController;

    class AdminController extends AppController
    {

        public function index()
        {
            $this->viewBuilder()->setLayout('admin');

        }
    }
