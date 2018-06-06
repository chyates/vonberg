<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Vonberg Dev Site';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>Vonberg Valve, Inc.</title>
</head>

<body>
    <div id="cms-site-container" class="outer-container container-fluid">
        <?= $this->element('admin_nav') ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <?= $this->element('footer') ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <?php echo $this->Html->script('/js/jquery.geocomplete.min.js');?>
    <script>
    // $(function(){
    // $("#geocomplete").geocomplete({ details: "form" })
    // });
    jQuery(document).ready(function($) {
    // fxn to flip through form slides
        // first next link:
        $("#next-one").click(function() {
            $("#title-one, #title-two").toggleClass('inactive-title', 'active-title');
            $("#one, #two").toggleClass('inactive-slide', 'active-slide');
        });
        // first back link:
        $("#back-two").click(function() {
            $("#title-one, #title-two").toggleClass('inactive-title', 'active-title');
            $("#one, #two").toggleClass('inactive-slide', 'active-slide');
        });

        // second next link:
        $("#next-two").click(function() {
            $("#title-two, #title-three").toggleClass('inactive-title', 'active-title');
            $("#two, #three").toggleClass('inactive-slide', 'active-slide');
        });
        // second back link:
        $("#back-three").click(function() {
            $("#title-two, #title-three").toggleClass('inactive-title', 'active-title');
            $("#two, #three").toggleClass('inactive-slide', 'active-slide');
        });

        // third next link:
        $("#next-three").click(function() {
            $("#title-three, #title-four").toggleClass('inactive-title', 'active-title');
            $("#three, #four").toggleClass('inactive-slide', 'active-slide');
        });
        // third back link:
        $("#back-four").click(function() {
            $("#title-three, #title-four").toggleClass('inactive-title', 'active-title');
            $("#three, #four").toggleClass('inactive-slide', 'active-slide');
        });

        // fourth next link:
        $("#next-four").click(function() {
            $("#title-four, #title-five").toggleClass('inactive-title', 'active-title');
            $("#four, #five").toggleClass('inactive-slide', 'active-slide');
        });
        // last back link:
        $("#back-five").click(function() {
            $("#title-four, #title-five").toggleClass('inactive-title', 'active-title');
            $("#four, #five").toggleClass('inactive-slide', 'active-slide');
        });

    // fxn to insert input fields upon add bullet click:
        // features bullets
        var rowCount = 1;
        var colCount = 1;
        $(".add-bullet").click(function(e) {
            e.preventDefault();
            var tableSlide = $(".table-create-box").find(this);
            var featSlide = $(".form-slide .w-bullet").find(this);

            if(tableSlide.length > 0) {
                if( $(this).hasClass('model-column') ){
                    var existingRow = $(".creation-row");
                    var newColDiv = "<div class='data-column'>"
                    var colHead;
                    var newCol = "<input type='text' class='model-row-input form-control' placeholder='Enter value' />";
                    for(var j = 0; j < rowCount; j++) {
                        if(j < 1) {
                            colHead = "<input type='text' class='model-header-input form-control' placeholder='Enter table header' />";
                            newColDiv += colHead;
                            newColDiv += newCol;
                        } else {
                            newColDiv += newCol;
                        }
                    }
                    colCount++;
                    newColDiv += "</div>";
                    existingRow.find('.data-column').last().after(newColDiv);
                    var currentWidth = parseInt($("#three .buffer-div .table-create-box").css("width")) +200;
                    if(colCount > 8) {
                        $("#three .buffer-div .table-create-box").css("width", currentWidth);
                    }
                } else if ( $(this).hasClass('model-row') ){
                    var dataRowCheck = $(".creation-row .data-column").find('.model-row-input:last-child');
                    var firstRowCheck = $(".creation-row .data-column .model-name-input");
                    var newFirst = "<input type='text' class='model-header-input form-control' placeholder='Enter model'/>";
                    firstRowCheck.after(newFirst);
                    var newRow = "<input type='text' class='model-row-input form-control' placeholder='Enter value' />";
                    dataRowCheck.after(newRow);
                    rowCount += 1;
                }
            } else if(featSlide.length > 0) {
                var newBullet = "<input type='text' class='form-control' placeholder='Enter bullet copy...' />";
                var newSelect = "<select class='form-control' name='product-specification'><option value='Select...' selected disabled>Select...</option></select>";
                $(this).closest('.w-bullet').find('select').first().after(newSelect);
                $(this).closest(".w-bullet").find("input[type=text]").first().after(newBullet);
            }
        });

        $('#image-file').change(function() {
            var filename = $('#image-file').val();
            $('#file-test').html(filename);
        });

        $('#stp-file').change(function() {
            var filename = $('#stp-file').val();
            $('#file-test-2').html(filename);
        });

        $(".update-button").hide();
        $(".fileContainer input[type=file]").change(function() {
            var filename = $(this).val();
            var toChange = $(this).closest('td').children('.file-text');
            var nextUpdate = $(this).closest('td').children('.update-button');

            $(toChange).html(filename);
            $(nextUpdate).show();
        });
    });
    </script>

</body>
</html>
