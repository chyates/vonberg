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
        $this->loadModel('Contacts');
        $cat=$this->Contacts->newEntity();
        if($this->request->is('post')) {
            $cat=$this->Contacts->patchEntity($cat,$this->request->data);
            if($result=$this->Contacts->save($cat)) {
                $this->redirect(array('action' => 'success'));
            }
            else {
                echo "Error: some error";
            }
        }    }

    public function stp()
    {

        $data = [];
        $this->loadModel('StpUsers');
        $this->loadModel('StpFile');
        $this->loadModel('Parts');

        // extract part id from url:
        $part_id = '';
        $curr_url = $this->request->here;
        for($j = 0; $j < strlen($curr_url); $j++) {
            if($curr_url[$j] == 'w') {
                for($x = $j +2; $x < strlen($curr_url); $x++) {
                    $part_id .= $curr_url[$x];
                }
            }
        }
        $final_id = (int)$part_id;

        $query =  $this->Parts->find('all', ['conditions' => ['Parts.partID' => $final_id], 'contain' => ['ModelTables' => ['ModelTableHeaders','ModelTableRows'] ]])->toList();
        // $results = $query->all();
        // $models = $results->toList();
        $id_array = array();
        $file_array = array();
        $file_path = '/img/parts/' . $part_id . '/';

        foreach($query->model_tables->model_table_rows as $file_id) {
            if($file_id->order_num == 1) {
                array_push($id_array, $file_id->model_table_rowID);
            }
        }

        for($x = 0; $x < count($id_array); $x++) {
            $file_path .= $id_array[$x];
            $file_path .= '.stp';
            array_push($file_array, $file_path);
        }

        $file_table = TableRegistry::get('StpFile');

        // instantiate empty STP user and STP file objects:
        $emp=$this->StpUsers->newEntity();
        // $association = $this->StpFile->newEntity();

        if($this->request->is('post')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);
            $models = [];
            $this->loadModel('ModelTableRows');
            foreach ($this->request->data['model'] as $model) {
                if (strval($model) != 0) {
                    $tables = $this->ModelTableRows->find('all', array(
                        'conditions' => array(
                            'model_table_rowID' => $model,
                        ),
                    ))->first();
                    array_push($models, $tables);
                }
            }

            if($result=$this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                $data['debug'] = $result;

                //echo $result->id;
                // Send email to client:
                // $attachments = $file_array;
                $email = new Email('default');
                $email->from(['do-not-reply@vonberg.com', 'VVI STP Request'])
                    ->to('darren.mckeeman@gmail.com')
/*                    $email->addTo('jlevon@vonberg.com');
                    $email->addTo('Mwhite@vonberg.com');*/
                    ->addTo(['Clientservices@impactnetworking.com'])
                    ->addTo(['cyates@trunkclub.com' => 'Carolyn Yates'])
                    ->subject('File Request from '.$this->request->data['first_name'])
                    ->viewVars(['data'=> $result, 'models' => $models])
                    ->template('stp_email','default')
                    /* ->attachments([
                            'stp.stp' => [
                            'file' => 'vvi.impactpreview.com/img/parts/14/10923.STP',
                            'mimetype' => 'application/step'
                            ]
                        ])*/
                    ->send();
            }
            else {
                $data['response'] = "Error: some error";
                print_r($emp);
            }
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');

    }
    public function process()
    {

    }
    public function success()
    {

    }
}