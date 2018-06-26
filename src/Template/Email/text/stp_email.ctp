New STP file request from: <?php echo $this->request->data['first_name'] . $this->request->data['last_name']; ?>
Requesting the following files:

<?php foreach ($models as $model){
    echo "Model number: ". $model->model_table_row_text . "\t Filename: " . $model->model_table_row_text . ".stp";
}?>