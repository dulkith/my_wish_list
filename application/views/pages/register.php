<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
         src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>

<div id="testContainer" class="container">
    <div class="col-md-12 mt-2 pt-3 mb-4">
        <h1>Register</h1>
    </div>

    <div class="mx-4 row">
        <div class="col-12">
            <label class="wish-list-form-label">Name</label>
        </div>
        <div class="col-sm-6 col-12 ">
            <input id="firstName" name="firstName"
                   class="wish-list-form-input" placeholder="First Name">
            <span class="error-messages mt-3"><?php echo form_error('firstName'); ?></span>
        </div>
        <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
            <input id="lastName" name="lastName" class="wish-list-form-input" placeholder="Last Name">
            <span class="error-messages"><?php echo form_error('lastName'); ?></span>
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
            <input id="passwordConfirmation" name="passwordConfirmation" class="wish-list-form-input"
                   placeholder="Password Confirmation">
            <span class="error-messages"><?php echo form_error('passwordConfirmation'); ?></span>
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
        <button id="registerSubmitBtn" type="submit" class="btn btn-outline-danger btn-lg checkout-btn">
            SUBMIT
        </button>
    </div>
</div>


<script language="javascript">
    var Register = Backbone.Model.extend({
        urlRoot: function () {
            return "<?php echo base_url() ?>index.php/api/userV1/users/userAction/register";
        },
        idAttribute: "",
        defaults: {
            firstName: "",
            lastName: "",
            email: "",
            password: "",
            mobile: ""
        }
    });

    var UserRegisterView = Backbone.View.extend({
        el: "#testContainer",
        initialize: function () {
            console.log('Initializing Register View');
        },
        render: function () {
            return this;
        },
        events: {
            "click #registerSubmitBtn": 'register',
        },
        register: function () {
            console.log('Start registration...');
            // create the model here
            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var passwordConfirmation = $('#passwordConfirmation').val();
            var mobile = $('#mobile').val();

            // validate password confirmation
            if (password !== passwordConfirmation) {
                // password confirmation error message display
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords are missed matched',
                    text: 'Please try again!',
                    timer: 4000,
                    timerProgressBar: true,
                    footer: '<a href>Why do I have this issue?</a>'
                })
            } else if (!password) {
                // no password error message display
                Swal.fire({
                    icon: 'error',
                    title: 'Please enter your password',
                    text: 'Please try again!',
                    timer: 4000,
                    timerProgressBar: true,
                    footer: '<a href>Why do I have this issue?</a>'
                })
            } else {

                var registerModel = new Register();
                var registerFromData = {
                    'firstName': firstName,
                    'lastName': lastName,
                    'email': email,
                    'password': password,
                    'mobile': mobile,
                }

                registerModel.save(registerFromData, {
                    async: false,
                    success: async function (model, response, options) {
                        // login successful message display
                        Swal.fire({
                            icon: 'success',
                            title: 'Register Successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        console.log(response);
                        console.log(model);
                        console.log(options);
                        // redirect to home page
                        await sleep(2000);
                        location.href = "<?php echo base_url() ?>index.php/Login";
                    },
                    error: function (model, xhr, options) {
                        console.log(xhr);
                        // login error message display
                        Swal.fire({
                            icon: 'error',
                            title: xhr.responseJSON,
                            text: 'Please try again!',
                            timer: 4000,
                            timerProgressBar: true,
                            footer: '<a href>Why do I have this issue?</a>'
                        })
                    }
                });
            }
        }
    });

    var userRegisterView = new UserRegisterView();

</script>

