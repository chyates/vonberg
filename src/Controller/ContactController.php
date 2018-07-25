<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

class ContactController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
        $this->loadComponent('Recaptcha.Recaptcha', [
            'enable' => true,     // true/false
            'sitekey' => '6LfrHFYUAAAAAMT5xPdA-HLr-5kqefg-q-mrNK3y', //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
            'secret' => '6LfrHFYUAAAAAHPykY9ZAs4C8pnwXZnVr9jsogs1',
            'type' => 'image',  // image/audio
            'theme' => 'light', // light/dark
            'lang' => 'en',      // default en
            'size' => 'normal'  // normal/compact
        ]);
    }

    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['stp','index', 'process']);
        $this->Security->setConfig('unlockedActions', ['stp']);
        if ($this->request->param('action') === 'stp') {
            $this->eventManager()->off($this->Csrf);
        }
        $this->viewBuilder()->setLayout('default');

    }

    public function index()
    {
        $this->viewBuilder()->setLayout('vonberg');
        $this->loadModel('Contacts');
        $cat=$this->Contacts->newEntity();
        if($this->request->is('post')) {
            if ($this->request->is('post')) {
                if ($this->Recaptcha->verify()) { 
                    $cat=$this->Contacts->patchEntity($cat,$this->request->data);
                    if($result=$this->Contacts->save($cat)) {
                        $this->redirect(array('action' => 'success'));
                    }
                    else {
                        echo "Error: some error";
                    }
                } else {
                    $recaptcha_passed = false;
                    $this->set(compact('recaptcha_passed'));
                }
            }
        }    
    }

    public function stp()
    {
        $data = [];
        $this->loadModel('StpUsers');
        $this->loadModel('StpFile');
        $stp_table = TableRegistry::get('StpFile');
        $this->loadModel('Parts');
        $this->loadModel('ModelTableRows');

        // instantiate empty STP user and STP file objects:
        $emp=$this->StpUsers->newEntity();

        if($this->request->is('post') || $this->request->is('put')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);
            if($result=$this->StpUsers->save($emp)) {
                // Send email to client:
                $file_paths = '';
                if(!empty($this->request->data['model'])) {
                    foreach($this->request->data['model'] as $str_model) {
                        if(strval($str_model) != "0") {
                            $file_paths .= strval($str_model);
                            $file_paths .= ".stp, ";
                        }
                    }
                }

                Email::deliver('info@vonberg.com', 'STP File Request From: '.$this->request->data['first_name']." ".$this->request->data['last_name'], 'Please respond to: '.$this->request->data['email'].' with the following files: '.$file_paths, ['from' => 'do-not-reply@vonberg.com']);
                $data['response'] = "Success: data saved";
                $data['debug'] = $result;
                $models = [];
                // $this->Flash->success(__('The request has been saved.'));
                foreach ($this->request->data['model'] as $model) {
                    $cmd_vars = 'DB=' . 'vvi_dev' . ' ';
                    $cmd_vars .= 'USERID=' . $result->stp_userID . ' ';
                    $cmd_vars .= 'PARTID=' . $this->request->data['part'] . ' ';
                    $cmd_vars .= 'MODELID=' . $model . ' ';
                    exec($cmd_vars . '/home/impact_vvi/.nvm/versions/node/v8.11.3/bin/node /home/impact_vvi/db_routines/doTheStp.js');
                }
                exec('DB=vvi_dev /home/impact_vvi/.nvm/versions/node/v8.11.3/bin/node /home/impact_vvi/db_routines/getMeACsv.js');
            }
            else {
                $data['response'] = "Error: some error";
                // print_r($emp);
                // $this->Flash->success(__('The request has not been saved.'));
            }
        }
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }        
            
    public function process()
    {
        $this->viewBuilder()->setLayout('vonberg');
    }
    public function success()
    {
        $this->viewBuilder()->setLayout('vonberg');
    }
}