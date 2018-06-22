<div id="contact-main-container" class="inner-main col-lg-8 col-12 mx-auto p-md-5 p-3">
    <div class="row no-gutters px-md-5 justify-content-sm-between">
        <div class="col-lg-4 col-sm-5 mr-sm-5 py-2 contact-left">
            <div class="contact-block p-4">
                <h3 class="product-name">Vonberg Valve, Inc.</h3>
                <p>3800 Industrial Avenue<br>Rolling Meadows, IL<br>60008-1085 USA</p>
                <p>Phone: (847) 259-3800<br>Fax: (847) 259-3997<br>Email: info@vonberg.com</p>
            </div>
        </div><!-- .contact-left end -->
        <div class="col-sm-6 contact-right">
            <h1 class="page-header">Contact Us</h1>

            <!-- Contact form begin -->
            <?php 
                echo $this->Form->create('Contact', array(
                    'id' => 'contact-form',
                    'class' => 'needs-validation',
                    'novalidate'
                ));

                echo $this->Form->control('name', ['type' => 'text', 'class' => 'form-control','required']);
                echo $this->Form->control('company', ['type' => 'text', 'class' => 'form-control']);
                echo $this->Form->control('phone', ['type' => 'tel', 'class' => 'form-control', 'required']);
                echo $this->Form->control('email', ['type' => 'email', 'class' => 'form-control','required']);
            echo $this->Form->control('manufacturer', ['value' => Null,'type' => 'hidden', 'class' => 'form-inline']);
            echo $this->Form->control('manufacturer', ['value' => 'Manufacturer','type' => 'checkbox', 'class' => 'form-inline']);
            echo $this->Form->control('distributor', ['value' => Null,'type' => 'hidden', 'class' => 'form-inline']);
            echo $this->Form->control('distributor', ['value' => 'Distributor','type' => 'checkbox', 'class' => 'form-inline']);
            echo $this->Form->control('enduser', ['value' => Null,'type' => 'hidden', 'class' => 'form-inline']);
            echo $this->Form->control('enduser', ['value' => 'End User','type' => 'checkbox', 'class' => 'form-inline']);
                echo $this->Form->control('contactme', ['type' => 'textarea', 'class' => 'form-control', 'required']);
            ?>

                <div class="row no-gutters">
                    <div class="col-6 my-auto">
                        <p class="text-left my-auto">*required fields</p>
                    </div>
                    <?php echo $this->Form->submit(); ?>
                </div>
                
               <?php echo $this->Form->end(); ?><!-- Contact form end -->
        </div><!-- .contact-right end -->
    </div><!-- .row no-gutters end -->
</div><!-- #contact-main-container end -->

<script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                console.log("Hit form validation function");
                if (form.checkValidity() === false) {
                    console.log("Form is invalid, check");
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
  })();

jQuery(document).ready(function(){
// add divs for bootstrap validation
    var feedback = '<div class="invalid-feedback">This field is required.</div>';
    $("textarea").after(feedback);
    $("input").each(function(index) {
        $(this).after(feedback)
    });

// add form-group class to trigger validations
    $("#contact-form div.input").addClass('form-group');
    $("#contact-form div.checkbox").addClass('form-check form-check-inline');

// format checkboxes + submit row
    var rowLabel = $("#contact-form div.select").find("label").first();
    rowLabel.next("input[type=hidden]").wrapAll('<div class="row no-gutters" />');

    var submit = $("#contact-form div.submit");
    submit.addClass('col-6 text-right');
    submit.find('input[type=submit]').addClass('btn btn-primary');
})
</script>