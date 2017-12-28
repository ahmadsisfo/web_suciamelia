<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
                <div class="card" style="z-index:1029">
                <div class="card-header header-raised header-primary text-center" data-header-animation="false" data-background-color="orange">
                    <h2 class="card-title">Login</h2>
                    <p class="card-title">Please fill out the following fields to login:</p>
                </div>
                <div class="card-content">
                    <form id="login-form" action="/suciamelia/backend/web/index.php?r=site%2Flogin" method="post">
<input type="hidden" name="_csrf-backend" value="hV-MfuDPaHL2PmXGN5eVLgUe6vz3WXMUNYMqP1XOdrq0C_8Pmbc4Rp9UKYtc9aJKUimrrsIcBVBh12F4BLoQwg==">
                    <div class="form-group field-loginform-username required is-empty has-error">
<label class="control-label" for="loginform-username">Username</label>
<input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" autofocus="" aria-required="true" aria-invalid="true">

<p class="help-block help-block-error">Username cannot be blank.</p>
<span class="material-input"></span></div>
                    <div class="form-group field-loginform-password required is-empty">
<label class="control-label" for="loginform-password">Password</label>
<input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" aria-required="true">

<p class="help-block help-block-error"></p>
<span class="material-input"></span></div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group field-loginform-rememberme">
<div class="checkbox">
<label for="loginform-rememberme">
<input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked=""><span class="checkbox-material"><span class="check"></span></span>
Remember Me
</label>
<p class="help-block help-block-error"></p>

</div>
</div>                    </div>
                    <div class="col-md-6">
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-primary" name="login-button">Login</button>                        </div>
                    </div>
                    </div>

                </form>                </div>
            </div>
        </div>
            <div class="col-lg-4">
                <div class="card card-signup">
                        <form class="form" method="" action="">
                                <div class="header header-primary text-center">
                                        <h4>Sign Up</h4>
                                        <div class="social-line">
                                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                                        <i class="fa fa-facebook-square"></i>
                                                </a>
                                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                                        <i class="fa fa-twitter"></i>
                                                </a>
                                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                                        <i class="fa fa-google-plus"></i>
                                                </a>
                                        </div>
                                </div>
                                <p class="text-divider">Or Be Classical</p>
                                <div class="content">

                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="material-icons">face</i>
                                                </span>
                                                <div class="form-group is-empty"><input type="text" class="form-control" placeholder="First Name..."><span class="material-input"></span></div>
                                        </div>

                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="material-icons">email</i>
                                                </span>
                                                <div class="form-group is-empty"><input type="text" class="form-control" placeholder="Email..."><span class="material-input"></span></div>
                                        </div>

                                        <div class="input-group">
                                                <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                </span>
                                                <div class="form-group is-empty"><input type="password" placeholder="Password..." class="form-control"><span class="material-input"></span></div>
                                        </div>

                                        <!-- If you want to add a checkbox to this form, uncomment this code

                                        <div class="checkbox">
                                                <label>
                                                        <input type="checkbox" name="optionsCheckboxes" checked>
                                                        Subscribe to newsletter
                                                </label>
                                        </div> -->
                                </div>
                                <div class="footer text-center">
                                        <a href="#pablo" class="btn btn-simple btn-primary btn-lg">Get Started</a>
                                </div>
                        </form>
                </div>
            </div>
        </div>

    </div>
</div>
