<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<div id="cms-edit-prod-main" class="inner-main col-md-10 mx-auto p-5">
    <h1 id="title-one" class="active-title page-title">Edit Product</h1>
    <?= $this->Form->create($part, ['id' => "edit-prod-form"]) ?>

        <div id="one" class="active-slide form-slide col-md-5 mx-auto">
            <div class="form-group">
                <?php 
                    echo $this->Form->input('categoryID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $cat,
                        'label' => 'Category',
                        'class' => 'accept form-control',
                        'value' => $part->categoryID
                    ]);

                    echo $this->Form->input('newcat', 
                    [
                        'type' => 'text',
                        'label' => false,
                        'class' => 'hidden form-control',
                        'id' => 'newcat',
                        'placeholder' => 'Enter new category'
                    ]);
                ?>
            </div>

            <div class="row no-gutters">
                <div class="col-sm-6">
                    <label>Product Status</label>
                    <div class="form-group">
                        <?php if($part->new_list != 1) {
                            echo $this->Form->input('new_list',
                            [
                                'type' => 'checkbox',
                                'label' => false,
                                'class' => 'form-check-input'
                            ]);
                        } else {
                            echo $this->Form->input('new_list',
                            [
                                'type' => 'checkbox',
                                'label' => false,
                                'class' => 'form-check-input',
                                'checked'
                            ]);
                        } 
                        ?>
                        <label class="form-check-label">New</label>
                    </div>
                </div>
                <div class="col-sm-6">
                <label>Expiration (days)</label>
                    <?php
                        if($part->new_list == 1) {
                            $opts = array();
                            for($x = 0; $x <= 90; $x++) {
                                array_push($opts, $x);
                            }
                            echo $this->Form->input('expires',
                            [
                                'type' => 'select',
                                'multiple' => false,
                                'options' => $opts,
                                'label' => false,
                                'class' => 'form-control',
                                'value' => $part->expires
                            ]);
                        } else {
                            echo $this->Form->input('expires',
                            [
                                'type' => 'select',
                                'multiple' => false,
                                'options' => [
                                    ['text' => '30', 'value' => 30],
                                    ['text' => '60', 'value' => 60],
                                    ['text' => '90', 'value' => 90]
                                ],
                                'label' => false,
                                'class' => 'form-control'
                            ]);
                        }
                    ?>
                </div>
            </div>

            <label>Style</label>
            <div class="form-group">
                <?php echo $this->Form->control('styleID',
                    [
                        'templates'  =>[ 'inputContainer' => '<div class="input form-check form-check-inline {{type}}{{required}}">{{content}}</div>'],
                        'type' => 'radio',
                        'multiple' => false,
                        'options' => $style,
                        'label' => False,
                        'class' => 'form-check-input',
                        'value' => $part->styleID
                    ]);?>
            </div>

            <div class="form-group">
                <?php 
                    echo $this->Form->input('typeID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $type,
                        'label' => 'Type',
                        'class' => 'accept form-control',
                        'value' => $part->typeID
                    ]);

                    echo $this->Form->input('newtype', 
                    [
                        'type' => 'text',
                        'label' => false,
                        'class' => 'hidden form-control',
                        'id' => 'newtype',
                        'placeholder' => 'Enter new type'
                    ]);
                ?>
            </div>

            <div class="form-group">
                <?php 
                    echo $this->Form->input('seriesID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $series,
                        'label' => 'Series',
                        'class' => 'accept form-control',
                        'value' => $part->seriesID
                    ]);

                    echo $this->Form->input('newseries', 
                    [
                        'type' => 'text',
                        'label' => false,
                        'class' => 'accept hidden form-control',
                        'id' => 'newseries',
                        'placeholder' => 'Enter new series'
                    ]);
                ?>

            </div>
            <div class="form-group">
                <?php
                    echo $this->Form->input('connectionID',
                    [
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $conn,
                        'id'=> 'connectionid',
                        'label' => 'Short Description',
                        'class' => 'accept form-control',
                        'value' => $part->connectionID
                    ]);

                    echo $this->Form->input('newconn', 
                    [
                        'type' => 'text',
                        'label' => false,
                        'class' => 'accept hidden form-control',
                        'id' => 'newconn',
                        'placeholder' => 'Enter new short description'
                    ]);
                ?>
            </div>

            <p class="text-right"><?= $this->Form->submit('Next',array('class'=>'btn btn-primary'));?>

            </p>
        </div><!-- #one end -->
    <?= $this->Form->end(); ?>
</div><!-- #cms-edit-prod-main end -->

<script>
    var idArr = [];

    function createArr(sel) {
        sel.find('option')
        .each(function(index) {
            var idInt = parseInt($(this).attr('value'));
            idArr.push(idInt);
        });
        var max = idArr[0];
        for(var i = 1; i < idArr.length; i++) {
            if (idArr[i] > max) {
                max = idArr[i];
            }
        }
        return max;
    }

    function catAdd() {
        var select = $("#add-prod-form").find('#categoryid');
        var last = createArr(select);
        var added = last + 1;
        var name = $("#cat").val();
        $.get('/admin/catadd?name='+name, function(d) {
            $('#categoryid').prepend($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);
        });
    }

    function typeAdd() {
        var select = $("#add-prod-form").find('#typeid');
        var last = createArr(select);
        var added = last + 1;
        var name=$("#type").val();
        $.get('/admin/typeadd?name='+name, function(d) {
            $('#typeid').append($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);

        });
    }

    function seriesAdd() {
        var select = $("#add-prod-form").find('#seriesid');
        var last = createArr(select);
        var added = last + 1;
        var name=$("#series").val();
        $.get('/admin/seriesadd?name='+name, function(d) {
            $('#seriesid').append($('<option>', {
                value: added,
                text: name,
                selected: selected
            }));
            location.reload(false);
        });
    }

    function connAdd() {
        var select = $("#add-prod-form").find('#connectionid');
        var last = createArr(select);
        var added = last + 1;
        var name=$("#conn").val();
        $.get('/admin/connadd?name='+name, function(d) {
            $('#connectionid').append($('<option>', {
                value: added,
                text: name,
                selected: selected
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

    jQuery(document).ready(function() {
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

        $("select.accept.form-control").on("change", function () {
            var next = $(this).parent("div.input.select").next('div.input.text').find('.hidden')
            next.show();
        });

        $("#edit-prod-form div.input.checkbox").addClass('form-check form-check-inline');
    })
</script>