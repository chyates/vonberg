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
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon-32x32.png">

    <title>Vonberg Valve, Inc.</title>
</head>

<body>
    <div id="cms-site-container" class="outer-container container-fluid">
        <?= $this->element('admin_nav') ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <?= $this->element('footer') ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <?php echo $this->Html->script('/js/jquery.geocomplete.min.js');?>

    <script>

        function catAdd() {
            var curr = $("#add-prod-form").find('#categoryid').children('option').last().attr('value');
            var last = parseInt(curr) + 1;
            var name=$("#cat").val();
            $.get('/admin/catadd?name='+name, function(d) {
                $('#categoryid').prepend($('<option selected="selected">', {
                    value: last,
                    text: name,

                }));
                location.reload(false);

            });
        }

        function typeAdd() {
            var curr = $("#add-prod-form").find('#typeid').children('option').last().attr('value');
            var last = parseInt(curr) + 1;
            var name=$("#type").val();
            $.get('/admin/typeadd?name='+name, function(d) {
                $('#typeid').append($('<option selected="selected">', {
                    value: last,
                    text: name
                }));
                location.reload(false);

            });
        }

        function seriesAdd() {
            var curr = $("#add-prod-form").find('#seriesid').children('option').last().attr('value');
            var last = parseInt(curr) + 1;
            var name=$("#series").val();
            $.get('/admin/seriesadd?name='+name, function(d) {
                $('#seriesid').append($('<option selected="selected">', {
                    value: last,
                    text: name
                }));
                location.reload(false);
            });
        }

        function connAdd() {
            var curr = $("#add-prod-form").find('#connectionid').children('option').last().attr('value');
            var last = parseInt(curr) + 1;
            // var modal = $('#add-conn-modal');
            var name=$("#conn").val();
            $.get('/admin/connadd?name='+name, function(d) {
                $('#connectionid').append($('<option selected="selected">', {
                    value: last,
                    text: name
                }));
                location.reload(false);
            });
        }

        function partAdd() {
            $.ajax({
                url: '/admin/part_add',
                type:"POST",
                data:$('#add-prod-form').serialize(),
                success:function(response) {
                    //document.getElementById("total_items").value=response;
                    //alert("good");
                    alert("success:  "+response);
                    location.reload(false);
                },
                error: function (jqXHR,exception) {

                    console.log(jqXHR);
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.'+jqXHR.statusText;
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }

                    alert(msg);
                }
            });
            location.reload(false);
        }
        // $(function(){
    // $("#geocomplete").geocomplete({ details: "form" })
    // });
    jQuery(document).ready(function($) {
        // add "add series" to select
        $('#seriesid').prepend($('<option>', {
            value: 0,
            text: 'Add new series...'
        }));
        $('#categoryid').prepend($('<option>', {
            value: 0,
            text: 'Add new category...'
        }));
        $('#typeid').prepend($('<option>', {
            value: 0,
            text: 'Add new type...'
        }));
        $('#connectionid').prepend($('<option>', {
            value: 0,
            text: 'Add new short description...',
            id: 'testID'
        }));

        // if add series is clicked do this.
        $("#seriesid").on("change", function () {
            $modal = $('#add-series-modal');
            if($(this).val() === '0'){
                $modal.modal('show');
            }
        });
        // if add type is clicked do this.
        $("#typeid").on("change", function () {
            $modal = $('#add-type-modal');
            if($(this).val() === '0'){
                $modal.modal('show');
            }
        });
        // if add category is clicked do this.
        $("#categoryid").on("change", function () {
            $modal = $('#add-cat-modal');
            if($(this).val() === '0'){
                $modal.modal('show');
            }
        });
        // if add series is clicked do this.
        $("#connectionid").on("change", function () {
            $modal = $('#add-conn-modal');
            if($(this).val() === '0'){
                $modal.modal('show');
            }
        });
        // fxn to flip through form slides
        // first next link:
        // first back link:
        // last back link:
        // define the function within the global scope
        $('#delete-check-modal').on('show.bs.modal', function(e) {
            $(this).find('form').attr('action', $(e.relatedTarget).data('action'));
        });

        $('#delete-check-modal').on('show.bs.modal', function(event) {
            $("#partname").val($(event.relatedTarget).data('file'));
        });

        var lastA = $('.admin-nav').find('.cms-greyed');
        console.log("Last link: ", lastA);
        lastA.next().addClass('nav-link').addClass('nav-item');


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
        $(".fileContainer").find("input[type=file]").change(function() {
            var filename = $(this).val();

            var toChange = $(this).closest('.form-group').next('p.file-text');
            var homeChange = $(this).closest('.fileContainer').next('p.file-text');
            console.log("Found home change", homeChange.html());

            var nextUpdate = $(this).closest('.form-group').siblings('.update-button');
            var homeUpdate = $(this).closest('.fileContainer').siblings('.update-button');
            console.log("Found home update", homeUpdate.html());

            if(toChange.length > 0) {
                console.log("Inside first if check");
                $(toChange).html(filename);
                $(nextUpdate).show();
            } else if(homeChange) {
                console.log("Inside else check");
                $(homeChange).html(filename);
                $(homeUpdate).show();
            }
        });

        $(".rsrc-table").find("input[type=text].form-control.form-control-sm").keypress(function() {
            console.log("Title has been changed");
            $(this).parent().siblings("td").find(".update-button").show();
        })
    });
    </script>

</body>
</html>
