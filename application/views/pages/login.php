<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
         src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>

<div id="testContainer" class="container container-login">
    <div class="col-md-12 mt-2 pt-3 mb-4">
        <h1>Login</h1>
    </div>

    <div class="mt-3 mx-4 row">
        <div class="col-12">
            <label class="wish-list-form-label">Email</label>
        </div>
        <div class="col-sm-6 col-12 ">
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
    </div>

    <div class="col-6 mt-5 mb-3 d-flex justify-content-center">
        <div class="col-sm-3 col-12 ">
            <button id="loginSubmitBtn" class="btn btn-outline-danger btn-lg checkout-btn" type="submit">
                SUBMIT
            </button>
        </div>
    </div>

    <script language="javascript">
        // $(document).ready(function () {
        //
        // }
        var Login = Backbone.Model.extend({
            urlRoot: function () {
                return "<?php echo base_url() ?>index.php/api/userV1/users/userAction/login";
            },
            idAttribute: "",
            defaults: {
                email: "",
                password: ""
            }
        });

        var UserLoginView = Backbone.View.extend({
            el: "#testContainer",
            initialize: function () {
                console.log('Initializing Login View');
            },
            render: function () {
                return this;
            },
            events: {
                "click #loginSubmitBtn": 'login',
            },
            login: function () {
                console.log('Start Login...');
                // create the model here
                var email = $('#email').val();
                var password = $('#password').val();

                console.log(email);
                console.log(password);

                var loginModel = new Login();
                var credentials = {
                    'email': email,
                    'password': password,
                }
                loginModel.save(credentials, {
                    async: false,
                    success: async function (model, response, options) {
                        // login successful message display
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successfully!',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        console.log(response);
                        console.log(model);
                        console.log(options);
                        // set login session data
                        sessionStorage.myWishListUserid = model.attributes.user.id;
                        sessionStorage.myWishListUserFname = model.attributes.user.fname;
                        sessionStorage.myWishListUserLname = model.attributes.user.lname;
                        sessionStorage.myWishListUserMobile = model.attributes.user.mobile;
                        // redirect to home page
                        await sleep(2000);
                        location.href = "<?php echo base_url() ?>index.php/WishListHome";
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
            },
        });

        var userLoginView = new UserLoginView();

    </script>


