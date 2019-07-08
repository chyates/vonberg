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

    <title>Vonberg Valve, Inc. | Hydraulic Innovation</title>
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
jQuery(document).ready(function($) {
    $("#cms-prod-cat-main").find('input[name="new_list"]').change(function(){
        var hidden = $(this).prev();
        var check = $("#cms-prod-cat-main").find(this);
        var id = $(hidden).val();
        var label;
        if($(hidden).siblings('label.form-check-label').length > 0) {
            label = $(hidden).siblings('label.form-check-label');
            label.remove();
        } else {
            label = "<label class='form-check-label'>30 days</label>";
            $(check).parent().append(label);
        }
        $.get('/admin/checknew?id='+id, function(data) {

        });
    })

// fxn to insert input fields upon add bullet click:
    $("a.add-bullet.plus").click(function(e){
        e.preventDefault()
        var tableSlide = $(".table-create-box").find(this)
        var featSlide = $(".form-slide .w-bullet").find(this)

        if(featSlide.length > 0) {
            let parent = $(this).parent()
            let cl = $(parent).attr('class')
            let last
            let text
            let id
            let newFirst
            let newText
            let newSelect
            let divRow
            
            if(cl.indexOf('operation') != -1) {
                divRow = "<div class='input text'>"
                if(!$(parent).find("input[name='op_bullet_text_1']").length ) {
                    newFirst = "<input type='text' name='op_bullet_text_1' class='form-control' placeholder='Enter bullet copy...' id='1' />"
                    divRow += newFirst
                } else {
                    last = $(parent).find("input[name*='op_bullet_text']").last()
                    id = parseInt($(last).attr('id'))
                    newText = "<input type='text' name='op_bullet_text_"+(id+1)+"' class='form-control' placeholder='Enter bullet copy...' id='"+(id+1)+"' />"
                    divRow += (newText + "</div>")
                }
                $(parent).find("a.add-bullet.plus").before(divRow)
            } if(cl.indexOf('features') != -1) {
                divRow = "<div class='input text'>"
                if(!$(parent).find("input[name='feat_bullet_text_1']").length ) {
                    newFirst = "<input type='text' name='feat_bullet_text_1' class='form-control' placeholder='Enter bullet copy...' id='1' />"
                    divRow += newFirst
                } else {
                    last = $(parent).find("input[name*='feat_bullet_text']").last()
                    id = parseInt($(last).attr('id'))
                    newText = "<input type='text' name='feat_bullet_text_"+(id+1)+"' class='form-control' placeholder='Enter bullet copy...' id='"+(id+1)+"' />"
                    divRow += (newText + "</div>")
                }
                $(parent).find("a.add-bullet.plus").before(divRow)
            } if(cl.indexOf('specifications') != -1) {
                if(!$(parent).find('select[name="spec_name_1"]').length) {
                    let hidden = $("#cms-edit-prod-main").find('select[name="default-ops"]').clone()
                    newFirst = "<select name='spec_name_1' class='accept form-control' id='1'>"
                    newText = "<input type='text' name='spec_value_1' class='form-control' placeholder='Enter bullet copy...' id='1' />"
                    let options = $(hidden).find('option')
                    let vals = []
                    $(options).each(function(index){
                        vals.push($(this).attr('value'))
                    })
                    let custom = "<option value='-1'>Add new specification</option>"
                    newFirst += custom
                    for(x = 0; x < vals.length; x++) {
                        let newOpt
                        if(x == 0) {
                            newOpt = "<option selected value='" + vals[x] + "'>" + vals[x] + "</option>"
                        } else {
                            newOpt = "<option value='" + vals[x] + "'>" + vals[x] + "</option>"
                        }
                        newFirst += newOpt
                    }
                    newFirst += "</select>"
                    divRow = "<div class='row'><div class='col-sm-6 spec-left'>"
                    divRow += newFirst + "</div><div class='col-sm-6 spec-right'><div class='input text'>" + newText + "</div></div></div>"
                    $(parent).find('a.add-bullet.plus').before(divRow)
                } else {
                    let clone = $(parent).find("select[name*='spec_name']").last()
                    last = $(parent).find(".row").last().find('.spec-left.col-sm-6').last().find(":last-child")
                    text = $(parent).find("input[name*='spec_value']").last()
                    id = parseInt($(clone).attr('id'))
                    newSelect = $(clone).clone()
                    if($(newSelect).hasClass('hidden')) {
                        $(newSelect).toggleClass('hidden')
                    }
                    newText = $(text).clone()
                    $(newSelect).attr('id', (id+1))
                        .attr('name', 'spec_name_'+(id+1))
                        .attr('value', "")
                    $(newText).attr('id', (id+1))
                        .attr('name', 'spec_value_'+(id+1))
                        .attr('value', "")
                        .attr('placeholder', 'Enter bullet copy')
                    $(last).after(newSelect)
                    $(text).after(newText)
                }
            } 
        } else if(tableSlide.length > 0) {
            let colCount = 0;
            let rowCount = 0;
            if(!$(".creation-row #2.data-column").length) {
                colCount = 1;
            } else {
                $(".creation-row .data-column").each(function(index) {
                    colCount++
                })
            }

            $(".creation-row .data-column").find("input[id$='-1']").each(function(index) {
                rowCount++;
            });

            if( $(this).hasClass('model-column') ){
                colCount += 1;
                var existingRow = $(".creation-row");
                var newColDiv = "<div class='data-column' id='"+colCount+"'>"
                var colHead;

                for(var j = 0; j < rowCount; j++) {
                    var newCol = "<input type='text' class='model-row-input form-control' name='table_row_"+(j+2)+"-"+colCount+"' placeholder='Enter value' id='"+(j+2)+"-"+colCount+"'/>";
                    if(j < 1) {
                        newColDiv += "<div class='input text'>"
                        colHead = "<input type='text' class='model-header-input form-control' name='table_header_"+(j+1)+"-"+colCount+"' placeholder='Enter table header' id='"+(j+1)+"-"+colCount+"'/>";
                        newColDiv += colHead;
                        newColDiv += "</div><div class='input text'>"
                        newColDiv += newCol;
                        newColDiv += "</div>"
                    } else if(j < rowCount-1){
                        newColDiv += "<div class='input text'>"
                        newColDiv += newCol;
                        newColDiv += "</div>"
                    }
                }
                newColDiv += "</div>";
                existingRow.find('.data-column').last().after(newColDiv);

                var currentWidth = parseInt($("#three .buffer-div .table-create-box").css("width")) +200;
                if(colCount > 8) {
                    $("#three .buffer-div .table-create-box").css("width", currentWidth);
                }
            } else if( $(this).hasClass('model-row') ){
                rowCount += 1;
                var newRow;
                var rowDiv;
                
                for(var k = 0; k < colCount; k++) {
                    rowDiv = "<div class='input text'>"
                    if(k == 0) {
                        newRow = "<input type='text' class='model-row-input form-control' id='"+rowCount+"-"+(k+1)+"' name='table_row_"+rowCount+"-"+(k+1)+"' placeholder='Enter model'/>";
                        newRow += "</div>"
                        rowDiv += newRow
                    } else {
                        newRow = "<input type='text' class='model-row-input form-control' id='"+rowCount+"-"+(k+1)+"' name ='table_row_"+rowCount+"-"+(k+1)+"' placeholder='Enter value'/>";
                        newRow += "</div>"
                        rowDiv += newRow
                    }
                    if(k < colCount) {
                        $("div#"+(k+1)+".data-column").append(rowDiv);
                    }
                }
            }
        }
    });

    $("a.add-bullet.del").click(function(e){
        e.preventDefault()
        let row
        let lastRow
        let leftLast
        let rightLast
        let extraSel
        if($(this).siblings('div.input.text').length > 0) {
            lastRow = $(this).parent().find('div.input.text').last()
            $(lastRow).remove()  
        } if ($(this).parent('div.row.specifications').length > 0) {
            lastRow = $(this).parent().find('.row').last()
            row = $(this).parent().find('div.row').last().find('.col-sm-6.spec-left')
            if($(row).children().length > 1) {
                leftLast = $(row).children().last()
                rightLast = $(this).parent().find('div.row').find('.col-sm-6.spec-right').children().find('input[type=text]').last()
                if($(leftLast).prev().is('select.accept.form-control.hidden')) {
                    extraSel = $(leftLast).prev()
                    $(extraSel).remove()
                    if($(row).children().length < 1) {
                        $(row).parent().remove()
                    }
                }
                $(leftLast).remove()
                $(rightLast).remove()
            } else {
                lastRow = $(this).parent().find('div.row').last()
                lastRow.remove()
            }
        }
    })

    // erase val of MTR input if backspace key is struck
    $("#three .creation-row .data-column div.input.text").find('input').keyup(function(e){
        if(e.keyCode == 8) {
            $(this).val("")
        }
    })

    // to delete empty rows/columns in model table 
    let colCheck
    let rowCheck
    let ecCount = 0
    let erCount = 0
    let rowArr = []
    let colArr = []
    $(".empty-text p.empty-err a.add-bullet.del").click(function(e){
        if($(this).hasClass('e-row')) {
            let lr = $("#three .creation-row .data-column").find('input[id$="-1"]').last()
            let lrID = parseInt($(lr).attr('id').substring(0, $(lr).attr('id').indexOf("-")))
            for(var r = 1; r <= lrID; r++) {
                rowCheck = $("#three .creation-row .data-column").find("input[id^='"+r+"-']")
                for(var t = 0; t < rowCheck.length; t++) {
                    if($(rowCheck[t]).val() == "" ) {
                        erCount++
                    }
                }
                if(erCount == rowCheck.length) {
                        rowArr.push(r)
                    erCount = 0
                }
            }
            for(var e = 0; e <= rowArr.length; e++) {
                let foundRow = $("#three .creation-row .data-column").find("input[id^='"+rowArr[e]+"']")
                $(foundRow).parent().remove()
            }
            rowArr = []
        } else if($(this).hasClass('e-col')) {
            colCheck = $("#three .creation-row .data-column")

            $(colCheck).each(function(index){
                let downCheck = $(this).children().find('input')
                $(downCheck).each(function(index){
                    if($(this).val() == "") {
                        ecCount++
                    }
                    if(ecCount == downCheck.length) {
                        let cID = $(this).attr('id').substring(parseInt($(this).attr('id').indexOf("-")+1), $(this).attr('id').length)
                        if(!colArr.includes(cID)) {
                            colArr.push(cID)
                        }
                        ecCount = 0
                    } else if(index == downCheck.length-1 && ecCount != 0) {
                        ecCount = 0
                    }
                })
            })
            for(var c = 0; c < colArr.length; c++) {
                let rc = $("#three .creation-row #" + colArr[c] + ".data-column")
                $(rc).remove()
            }
        }
    })

    // update input value on keypress, model table slide edit product form:
    $("#three .creation-row .data-column").find("input[type=text]").on("keypress", function() {
        if($(this).val() != "") {
            $(this).attr('value', "");
        }
    })

    var lastA = $('.admin-nav').find('#users-dropdown');
    lastA.next().addClass('nav-link nav-item');

    $('#image-file').change(function() {
        var filename = $('#image-file').val();
        $('#file-test').html(filename);
    });

    $('#stp-file').change(function() {
        var filename = $('#stp-file').val();
        $('#file-test-2').html(filename);
    });

    $(".update-button").hide();
    $(".spec-row.row").find("input[type=text].form-control").keypress(function() {
        $(this).parents('.col-md-4').siblings('.col-md-5').find(".update-button").show();
    });

    $(".fileContainer").find("input[type=file]").change(function() {
        var filename = $(this).val();
        var toChange;
        var nextUpdate;
        var hiddenTitle;
        var hiddenAdd;
        var form;
        var substr = filename.slice(12).replace(/[^\w\s?.]|_/g, "").replace(/\s+/g, "_");

        // edit resource file from cateogry/general pages
        if($(this).parents('.col-md-5').length > 0) {
            toChange = $(this).parents('label.fileContainer').next('p.file-text');
            nextUpdate = $(this).parents('label.fileContainer').siblings('div.submit').find('input.update-button');
            var techID = $(this).parents(".edit-rsrc-form").find("input[name='id']");
            form = $(this).parents('.edit-rsrc-form');
            hiddenTitle = $(form).find("input[name='tech_title']");
            hiddenAdd = $(form).find('input[name="filepath"]');
            $(nextUpdate).show();
            $(toChange).text(substr);
            $(hiddenAdd).attr('value', substr);
        }

        // add new resource file from add resource form
        if($(this).parents().prev('#up-label-addrsrc').length > 0) {
            toChange = $(this).parents('label.fileContainer').next('p.file-text');
            hiddenAdd = $(this).parent('div.input.file').siblings('input[type=hidden]');
            $(toChange).text(substr);
            $(hiddenAdd).val(substr);
        }

        // file add for product forms, slides 4/5
        if($(this).parents('.model-table-data').length > 0) {
            hiddenAdd = $(this).parents('label.fileContainer').find('input[type=file]')
            toChange = $(this).parents('label.fileContainer').siblings('p.file-text');
            $(toChange).html(substr);
            if($(this).parent().siblings('button.update-button').length > 0) {
                $(this).parents().siblings('button.update-button').toggleClass('dark light').show();
            }
            $(hiddenAdd).attr('value', substr)
        }

        // model pricing file add
        if($(this).parents('.fileContainer').siblings('label.sr-only').length > 0) {
            toChange = $(this).parents('.form-group').siblings('p.file-text');
            $(toChange).html(substr);
            if($(this).parents('.form-group').siblings('button.update-button').length > 0) {
                $(this).parents('.form-group').siblings('button.update-button').show();
            }
        }
        $(this).parents('label.fileContainer').toggleClass('dark light');
    })
})
</script>

</body>
</html>