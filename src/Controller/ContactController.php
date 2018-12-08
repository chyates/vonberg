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
            'sitekey' => '6LfSzmYUAAAAADY5KtrQSU4asZlDHXgnb_8-rfWY', //if you don't have, get one: https://www.google.com/recaptcha/intro/index.html
            'secret' => '6LfSzmYUAAAAADVwd3pSZfGdsJ7IoiHN6RenPAoa',
            'type' => 'image',  // image/audio
            'theme' => 'light', // light/dark
            'lang' => 'en',      // default en
            'size' => 'normal'  // normal/compact
        ]);
    }

    public function beforeFilter(Event $event)
    {
        // allow all action
        $this->Auth->allow(['stp','index', 'process','success']);
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
        $cat = $this->Contacts->newEntity();
        $message = '';
        if ($this->request->is('post') || $this->request->is('put')) {
            // print_r($this->request->data);
            // if(empty($this->request->data['distributor'])) {
            //     echo "Empty distributor";
            // }
            if ($this->Recaptcha->verify()) { 
                $cat->name = $this->request->data['name'];
                if(!empty($this->request->data['company'])) {
                    $cat->company = $this->request->data['company'];
                }
                $cat->phone = $this->request->data['phone'];
                $cat->email = $this->request->data['email'];

                if(empty($this->request->data['distributor'])) {
                    $cat->distributor = 0;
                } else {
                    $cat->distributor = 'Distributor';
                }
                if(empty($this->request->data['manufacturer'])) {
                    $cat->manufacturer = 0;
                } else {
                    $cat->manufacturer = 'Manufacturer';
                }
                if(empty($this->request->data['enduser'])) {
                    $cat->enduser = 0;
                } else {
                    $cat->enduser = 'End User';
                }

                // if(!empty($this->request->data['distributor'])) {
                //     $cat->distributor = $this->request->data['distributor'];
                // }
                // if(!empty($this->request->data['manufacturer'])) {
                //     $cat->manufacturer = $this->request->data['manufacturer'];
                // }
                // if(!empty($this->request->data['enduser'])) {
                //     $cat->enduser = $this->request->data['enduser'];
                // }

                $cat->contactme = $this->request->data['contactme'];

                if($result = $this->Contacts->save($cat)) {
                    $message .= 'Name: ';
                    $message .= $this->request->data['name'];
                    $message .= "\n";
                    $message .= 'Phone: ';
                    $message .= $this->request->data['phone'];
                    $message .= "\n";
                    $message .= 'Email: ';
                    $message .= $this->request->data['email'];
                    $message .= "\n";
                    $message .= 'Role: ';

                    if(!empty($this->request->data['manufacturer'])) {
                        $message .= $this->request->data['manufacturer'];
                    } else if(!empty($this->request->data['distributor'])) {
                        $message .= $this->request->data['distributor'];
                    } else if(!empty($this->request->data['enduser'])) {
                        $message .= $this->request->data['enduser'];
                    }

                    $message .= "\n";
                    $message .= 'Additional comments: ';
                    $message .= $this->request->data['contactme'];
                    $subject = "Vonberg Contact Form Request";
                    // echo $message;
                    // Email::deliver('tatan42@gmail.com', $subject, $message, ['from' => 'do-not-reply@vonberg.com']);
                    Email::deliver('whyyesitscar@gmail.com', $subject, $message, ['from' => 'do-not-reply@vonberg.com']);
                    // Email::deliver('mwhite@vonberg.com', $subject, $message, ['from' => 'do-not-reply@vonberg.com']);

                    $this->redirect(
                        ['controller' => 'Contact', 'action' => 'success']
                    );
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

    public function stp()
    {
        $data = [];
        $stp_table = TableRegistry::get('StpFile');
        $this->loadModel('StpUsers');
        $this->loadModel('StpFile');
        $this->loadModel('Parts');
        $this->loadModel('ModelTableRows');

        // instantiate empty STP user and STP file objects:
        $emp = $this->StpUsers->newEntity();

        if($this->request->is('post') || $this->request->is('put')) {
            // update STP user object
            $emp = $this->StpUsers->patchEntity($emp,$this->request->data);
            // $emp->
            if($result = $this->StpUsers->save($emp)) {
                // Send email to client:
                $file_paths = '';
                if(!empty($this->request->data['model'])) {
                    foreach($this->request->data['model'] as $str_model) {
                        if(strval($str_model) != "0") {
                            $file_paths .= 'Model ';
                            $file_paths .= strval($str_model);
                            $file_paths .= ".stp, ";
                        }
                    }
                }

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

                Email::deliver('chyatesil@gmail.com', 'STP File Request From: ' . $this->request->data['first_name'] . " " . $this->request->data['last_name'], 'Please respond to: ' . $this->request->data['email'] . ' with the following files: ' . $file_paths, ['from' => 'do-not-reply@vonberg.com']);
                Email::deliver('whyyesitscar@gmail.com', 'STP File Request From: ' . $this->request->data['first_name'] . " " . $this->request->data['last_name'], 'Please respond to: ' . $this->request->data['email'] . ' with the following files: ' . $file_paths, ['from' => 'do-not-reply@vonberg.com']);
                return $this->redirect($this->referer());
                // $this->autoRender = false;
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