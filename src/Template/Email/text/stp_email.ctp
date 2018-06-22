<p>New contact form entry from </p>
<p>
    Requesting the following files:

<P>
<?php foreach ($models as $model){
    echo "Model number: ".$model->model_table_row_text;
echo "filename -- : ".$model->model_table_row_text.".stp";
echo "<BR>";
}?>
</p>
<p>
