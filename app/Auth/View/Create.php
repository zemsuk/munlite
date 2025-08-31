<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row ">
        <div class="col-md-8">
            <img class="img-fluid" src="https://img.freepik.com/free-vector/secure-login-concept-illustration_114360-4320.jpg">
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">

            <div class="card mb-3">

            <div class="card-body">

                <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                </div>

                <form class="row g-3 needs-validation" action="/register" method="post" novalidate>
                <div class="col-12">
                    <label for="yourName" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" id="yourName" required>
                    <div class="invalid-feedback">Please, enter your name!</div>
                </div>

                <div class="col-12">
                    <label for="yourEmail" class="form-label">Your Email</label>
                    <input type="email" name="email" class="form-control" id="yourEmail" required>
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                </div>

                <div class="col-12">
                    <label for="yourUsername" class="form-label">Phone</label>
                    <input type="text" name="phone_number" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Please enter your phone number.</div>
                </div>

                <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                </div>
                <div class="col-12">
                    <label for="countryInfo" class="form-label">Country</label>
                    <select name="country_id" class="form-select" id="countryInfo" required>
                        <option value="">Please Choose</option>
                        <?php foreach($countries as $country) { ?>
                        <option value="<?= $country->id ?>"><?= $country->c_name ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Please enter your password!</div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                </div>
                <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="/login">Log in</a></p>
                </div>
                </form>

            </div>
            </div>

            <div class="credits">
            Designed by <a href="https://webpoka.com/">webpoka</a>
            </div>

        </div>
        </div>
    </div>

    </section>

