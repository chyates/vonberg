<div id="response">
  <?php
    // $xml = Xml::fromArray(['parts' => $parts]);
    // echo $xml->asXML();
    // print_r($parts);
    foreach($parts as $part) { ?>
      <div class="part">
        <div><?php print_r($part);?></div>
        <div class="id"><?php echo $part->partID; ?></div>
        <div class="type"><?php echo $part->type->name; ?></div>
        <div class="category"><?php echo $part->category->name; ?></div>
        <div class="style"><?php echo $part->style->name; ?></div>
        <div class="series">
          <?php
            if (!empty($part->series->name)) {
              echo $part->series->name;
            } elseif (empty($part->series->name || $part->seriesID == '0')) {
              echo 'No series';
            }
          ?>
        </div>
        <div class="connection"><?php echo $part->connection->name; ?></div>
        <div class="description"><?php echo $part->description; ?></div>
        <div class="last-updated"><?php echo $part->last_updated; ?></div>
        <?php $i = 0;
        foreach ($part->text_blocks as $block) {
          if ($i === 0) {
            ?><div class="operations"><?php
          } else {
            ?><div class="features"><?php
          }
          foreach ($block->text_block_bullets as $bullet) {
            ?><div><?php echo $bullet->bullet_text; ?></div><?php
          }
          ?></div><?php
          $i++;
        } ?>
        <div class="specifications"><?php
          foreach ($part->specifications as $spec) { ?>
            <div>
              <div class="name"><?php echo $spec->spec_name; ?></div>
              <div class="value"><?php echo $spec->spec_value; ?></div>
            </div>
          <?php }
        ?></div>
        <div class="table">
          <div class="header"><?php
            foreach ($part->model_table->model_table_headers as $header) {
              ?><div><?php echo $header->model_table_text; ?></div><?php
            }
          ?></div><?php
          foreach($part->model_table->model_table_rows as $row) {
            ?><div class="row"><?php
              echo $row->model_table_row_text;
            // if(strpos($row->model_table_row_text, $w_ds) !== false) {
            //   $last_space = strpos($row->model_table_row_text, $w_ds);
            //   $up_text = substr_replace($row->model_table_row_text, "<br>", $last_space+2, 0);
            // }
            // if(!empty($up_text)) {
            //   echo '<div>'.$up_text.'</div>';
            //   $up_text = NULL;
            // } else if(!empty($row->model_table_row_text)){
            //   echo '<div>'.$row->model_table_row_text.'</div>';
            // }
            ?></div><?php
          } ?>
        </div>
      </div>
    <?php }
  ?>
</div>