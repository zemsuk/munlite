<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row ">
        <div class="col-md-8">
            <img class="img-fluid" src="https://img.freepik.com/free-vector/account-concept-illustration_114360-399.jpg">
        </div>
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <!-- <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
            </a>
            </div> -->
            <!-- End Logo -->

            <div class="card mb-3">

            <div class="card-body">

                <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                </div>

                <form class="row g-3 needs-validation" action="/verify" method="post">

                <div class="col-12">
                    <label for="yourUsername" class="form-label">Phone</label>
                    <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-telephone"></i></span>
                    <input type="text" name="phone" class="form-control" required>
                    <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                </div>

                <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-asterisk"></i></span>
                    <input type="password" name="password" class="form-control" required>
                    <div class="invalid-feedback">Please enter your Password.</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </div>
                <div class="col-12">
                    <p class="small mb-0">Don't have account? <a href="/register">Create an account</a></p>
                </div>
                </form>

            </div>
            </div>
        </div>
        </div>
    </div>

</section>
<h3>Login Form</h3>
<form action="/verify" method="post">
    <div>
        Phone <input name="phone" />
    </div>
    <div>
        Password <input name="password"/>
    </div>
    
    <button name='submit'>Login</button>
    </form>
    <a href="/register">Register</a>