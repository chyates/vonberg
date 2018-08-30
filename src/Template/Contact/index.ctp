<div id="contact-main-container" class="inner-main col-lg-8 col-12 mx-auto p-md-5 p-3">
    <h1 id="m-header" class="page-header">Contact Us</h1>
    <div class="row no-gutters px-md-5">
        <div class="col-md-4 py-2 contact-left">
            <div class="contact-block p-4">
                <h3 class="product-name">Vonberg Valve, Inc.</h3>
                <p>3800 Industrial Avenue<br>Rolling Meadows, IL<br>60008-1085 USA</p>
                <p>Phone: (847) 259-3800<br>Fax: (847) 259-3997<br>Email: info@vonberg.com</p>
            </div>
        </div><!-- .contact-left end -->
        <div class="col-md-6 contact-right">
            <h1 id="dt-header" class="page-header">Contact Us</h1>

            <!-- Contact form begin -->
            <?php 
                echo $this->Form->create('Contact', array(
                    'id' => 'contact-form',
                    'class' => 'needs-validation',
                    'novalidate'
                )); ?>
                
                <div class="form-group">
                    <?php 
                        echo $this->Form->control('name', 
                        [
                            'label' => 'Full Name*', 
                            'type' => 'text', 
                            'class' => 'form-control',
                            'required'
                        ]); 
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        echo $this->Form->control('company', 
                        [
                            'type' => 'text', 
                            'class' => 'form-control'
                        ]); 
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        echo $this->Form->control('phone', 
                        [
                            'label' => 'Phone*', 
                            'type' => 'tel', 
                            'class' => 'form-control', 
                            'required'
                        ]); 
                    ?>
                </div>

                <div class="form-group">
                    <?php 
                        echo $this->Form->control('email', 
                        [
                            'label' => 'Email*', 
                            'type' => 'email', 
                            'class' => 'form-control',
                            'required'
                        ]); 
                    ?>
                </div>

                <div class="form-group">
                    <label id="user-role" >What is your role?</label>
                    <div class="form-check form-check-inline check-req">
                        <?php 
                            echo $this->Form->control('manufacturer', 
                            [
                                'label' => [
                                    'text' => 'Manufacturer', 
                                    'class' => 'form-check-label'
                                ], 
                                'value' => 'Manufacturer',
                                'type' => 'checkbox', 
                                'class' => 'form-check-input',
                                'hiddenField' => false
                            ]); 
                        ?>
                    </div>

                    <div class="form-check form-check-inline check-req">
                        <?php 
                            echo $this->Form->control('distributor', 
                            [
                                'label' => [
                                    'text' => 'Distributor', 
                                    'class' => 'form-check-label'
                                ], 
                                'value' => 'Distributor',
                                'type' => 'checkbox', 
                                'class' => 'form-check-input',
                                'hiddenField' => false
                            ]); 
                        ?>
                    </div>

                    <div class="form-check form-check-inline check-req">
                        <?php 
                            echo $this->Form->control('enduser', 
                            [
                                'label' => [
                                    'text' => 'End User', 
                                    'class' => 'form-check-label'
                                ], 
                                'value' => 'End User',
                                'type' => 'checkbox', 
                                'class' => 'form-check-input',
                                'hiddenField' => false
                            ]); 
                        ?>
                    </div>
                    <p id="check-validity" class="invalid-feedback" style="display: none;">
                        Please select a checkbox.
                    </p>
                </div>

                <div class="form-group">
                    <?php 
                        echo $this->Form->control('contactme', 
                        [
                            'label' => 'Remarks, Special Requests, or Questions*', 
                            'type' => 'textarea', 
                            'class' => 'form-control', 
                            'required'
                        ]); 
                    ?>
                </div>

                <div class="form-group">
                    <?= $this->Recaptcha->display() ?>
                    <?php 
                        if(isset($recaptcha_passed)) { 
                            echo '<div class="invalid-feedback" style="display: block;">Recaptcha must be passed successfully.</div>';
                        }
                    ?>
                </div>

                <div class="row no-gutters justify-content-between">
                    <div class="col-6 my-auto">
                        <p class="text-left my-auto">*required fields</p>
                    </div>
                    <?php echo $this->Form->submit('SUBMIT', array('class' => 'btn btn-primary')); ?>
                </div>
                
               <?php 
                    $this->Form->unlockField('g-recaptcha-response');
                    echo $this->Form->end(); 
               ?><!-- Contact form end -->
        </div><!-- .contact-right end -->
    </div><!-- .row no-gutters end -->
</div><!-- #contact-main-container end -->

<script type="text/javascript">
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        var checkboxes = document.querySelectorAll('.check-req');
        var checkStatus = [];
        var showDiv = document.getElementById('check-validity');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                console.log("Hit form validation function");
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    console.log("Form is invalid, check");
                    for(var i = 0; i < checkboxes.length; i++) {
                        var divs = checkboxes[i].children;
                        for(var j = 0; j < divs.length; j++) {
                            var labels = divs[j].children;
                            for(var k = 0; k < labels.length; k++) {
                                var inputs = labels[k].children;
                                for(var m = 0; m < inputs.length; m++) {
                                    if(inputs[m].checked) {
                                        checkStatus.push(inputs[m].checked);
                                    }
                                }
                            }

                        }
                    }
                    if (checkStatus.length < 1) {
                        showDiv.style.display = 'block';
                    }
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
  })();
</script>