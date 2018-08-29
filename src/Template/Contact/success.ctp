<div id="contact-main-container" class="inner-main col-lg-8 col-12 mx-auto p-md-5 p-3">
    <div class="row no-gutters px-md-5">
        <div class="col-md-4 py-2 contact-left">
            <div class="contact-block p-4">
                <h3 class="product-name">Vonberg Valve, Inc.</h3>
                <p>3800 Industrial Avenue<br>Rolling Meadows, IL<br>60008-1085 USA</p>
                <p>Phone: (847) 259-3800<br>Fax: (847) 259-3997<br>Email: info@vonberg.com</p>
            </div>
        </div><!-- .contact-left end -->
        <div class="col-sm-6 contact-right">
            <h1 class="page-header">Thank You!</h1>
<P>We've received your message. Someone will contact you as soon as possible.</P>

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