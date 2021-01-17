<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
         src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>

<div class="container">
    <div class="col-md-12 mt-2 pt-3 mb-4">
        <h1>Register</h1>
    </div>

    <form action="<?php echo base_url("index.php/register/submit"); ?>" method="post">
        <div class="mx-4 row">
            <div class="col-12">
                <label class="wish-list-form-label">Name</label>
            </div>
            <div class="col-sm-6 col-12 ">
                <input id="first-name" name="first-name"
                       class="wish-list-form-input" placeholder="First Name">
                <span class="error-messages mt-3"><?php echo form_error('first-name'); ?></span>
            </div>
            <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
                <input id="last-name" name="last-name" class="wish-list-form-input" placeholder="Last Name">
                <span class="error-messages"><?php echo form_error('last-name'); ?></span>
            </div>
        </div>

        <div class="mt-3 mx-4 row">
            <div class="col-12">
                <label class="wish-list-form-label">Email</label>
            </div>
            <div class="col-12">
                <input id="email" name="email" class="wish-list-form-input datepicker" placeholder="Enter email address"
                       type="text">
                <span class="mt-3 error-messages"><?php echo form_error('email'); ?></span>
            </div>
        </div>

        <div class="mt-3 mx-4 row">
            <div class="col-12">
                <label class="wish-list-form-label">Password</label>
            </div>
            <div class="col-sm-6 col-12 ">
                <input id="password" name="password"
                       class="wish-list-form-input" placeholder="Enter new password">
                <span class="error-messages mt-3"><?php echo form_error('password'); ?></span>
            </div>
            <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
                <input id="last-name" name="password-confirmation" class="wish-list-form-input"
                       placeholder="Password Confirmation">
                <span class="error-messages"><?php echo form_error('password-confirmation'); ?></span>
            </div>
        </div>

        <div class="mx-4 mt-3 row">
            <div class="col-12">
                <label class="wish-list-form-label">Mobile Number</label>
            </div>
            <div class="col-12">
                <input id="mobile" name="mobile" class="wish-list-form-input" placeholder="Enter your mobile number"
                       type="text">
                <span class="mt-3 error-messages"><?php echo form_error('mobile'); ?></span>
            </div>
        </div>

        <div class="col-12 mt-5 mb-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-danger btn-lg checkout-btn">
                SUBMIT
            </button>
        </div>
    </form>


</div>


