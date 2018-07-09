<script type="text/javascript">
    var lastColId = parseInt($('#'+colCount+".data-column").find('input[type=text]').last().attr('id'));
    var dataRowCheck = $(".creation-row .data-column").find('.model-row-input:last-child');
    var eachRowId = parseInt($(".creation-row .data-column").find('input[type=text]').last().attr('id'));
    var firstRowCheck = $(".creation-row .data-column .model-name-input:last-child");
    var newNameId = parseInt($(newFirst).attr('id'));
    var new
    var newFirst = "<input type='text' class='model-name-input form-control' id='"+newNameId+"'name ='model_name_" +newNameId+ "' placeholder='Enter model'/>";

    firstRowCheck.after(newFirst);
    var newRow = "<input type='text' class='model-row-input form-control' id='"+(newNameId+1)+"' name ='table_row_" +(newNameId+1)+ "' placeholder='Enter value' />";
    dataRowCheck.after(newRow);
}
</script>

    $files=$this->StpFile->newEntity();
    $files->stp_userID = $result->stp_userID;
    $files->partID = $final_id;
    $files->modelID = $model;
    $files = $this->StpFile->save($files);

    $paths_2 .= $model;

    // Send email to client:
    $attachments = $file_array;
    $email = new Email('default');
    $email->from(['do-not-reply@vonberg.com'])
        ->to(['chyatesil@gmail.com', 'Carolyn Yates'])
        $email->addTo('jlevon@vonberg.com');
        $email->addTo('Mwhite@vonberg.com');*/
        ->subject('File Request from '.$this->request->data['email'])
        ->viewVars(['data'=> $result, 'models' => $models])
        ->template('stp_email','default')
        ->send();

        if($this->request->is('post') || $this->request->is('put')) {
            // update STP user object
            $emp=$this->StpUsers->patchEntity($emp,$this->request->data);

            if($result=$this->StpUsers->save($emp)) {
                $data['response'] = "Success: data saved";
                $data['debug'] = $result;
                $models = [];
                $this->Flash->success(__('The request has been saved.'));
                
                // $file_paths = '';

                // foreach ($this->request->data['model'] as $model) {
                //     array_push($models, $model);
                // }
                Email::deliver('chyatesil@gmail.com', 'STP File Request From: '.$this->request->data['first_name']." ".$this->request->data['last_name'], 'Please respond to: '.$this->request->data['email'].' with the following *no-zero* files: space ', ['from' => 'do-not-reply@vonberg.com']);
        } else {
            $data['response'] = "Error: some error";
            print_r($emp);
            $this->Flash->success(__('The request has not been saved.'));
        }
?>