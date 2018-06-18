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
            <form id="contact-form" class="needs-validation" novalidate>
                <div class="form-group">
                    <label>Full Name*</label>
                    <input type="text" name="customer-name" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter your full name.
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" name="customer-company" class="form-control">
                </div>

                <div class="form-group">
                    <label>Phone*</label>
                    <input type="tel" name="customer-phone" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter your phone number.
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address*</label>
                    <input type="email" class="form-control" name="customer-email" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>

                <div class="form-group">
                    <div class="row no-gutters">
                        <label>What is your role?</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="model" value="model1">
                        <label class="form-check-label">Manufacturer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="model" value="model2">
                        <label class="form-check-label">Distributor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="model" value="model3">
                        <label class="form-check-label">End user</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Remarks, Special Requests, or Questions*:</label>
                    <textarea name="customer-comments" class="form-control" rows="4" cols="50" required></textarea>
                    <div class="invalid-feedback">
                        Please include a message.
                    </div>
                </div>

                <div class="g-recaptcha mb-3" data-sitekey="6LfrHFYUAAAAAMT5xPdA-HLr-5kqefg-q-mrNK3y"></div>

                <div class="form-group row no-gutters">
                    <div class="col-6 my-auto">
                        <p class="my-auto text-left">*required fields</p>
                    </div>
                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
                    </div>
                </div>

            </form>

        </div><!-- .contact-right end -->
    </div>
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
</script>