<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    @component('components.header')@endcomponent
</head>

<body>
    <div class="main" id="root">
        <section class="signup" style="margin-bottom: 0px;">
            <div class="container">
                <div class="signup-content">
            
                        <div class="signup-form">
                            <h2 class="form-title">Sign up</h2>
                            <form class="register-form" id="register-form" action="{{url('register')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="name" id="username" placeholder="Your Name" class="validate" data-validate="true" data-text="Please Enter Username..." data-max-value="12" data-min-value="6" />
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" id="email" placeholder="Your Email" class="validate" data-validate="true" data-text="Please Enter Email..."/>
                                </div>
                                <div class="form-group">
                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="pass" placeholder="Password" class="validate" data-validate="true" data-text="Please Enter Passwords..." data-max-value="12" data-min-value="6" />
                                </div>
                                <div class="form-group">
                                    <input type="file" name="image" id="" class="validate form-control" data-validate="false" />
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term validate" data-validate="true" data-text="Please Select Checkbox..."/>
                                    <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all Terms of service</label>
                                </div>
                                
                                <!-- <div class="form-group form-button">
                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                                </div> -->

                                <button class="btn btn-primary" type="submit">
                                    <span>Register</span>
                                    <span class="spinner-border spinner-border-sm visually-hidden submit_load" role="status" aria-hidden="true"></span>
                                </button>
                            </form>
                        </div>
                        
                        <div class="signup-image">
                            <figure><img src="{{url('assets/authentication/images/signup-image.jpg')}}" alt="sing up image"></figure>
                            <a href="{{url('login')}}" class="signup-image-link">I am already member</a>
                        </div>
                  
                </div>
                <div class="settingAccount">
                    <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="registerTxt h4 text-primary"></span>
                </div>
            </div>
        </section>
    </div>

    @component('components.footer')@endcomponent
</body>

</html>
<script type="module">
    import {authentication} from "./assets/js/authentication.js";
    const validate = new authentication();
    const formInput = document.querySelectorAll(".validate");

    let form = document.getElementById("register-form");
    let next_step = false;let success = formInput.length - 1;let errors = 0;

    form.addEventListener("submit", (e) => {
        let error = 0;
        error = errors;
        formInput.forEach((input, index) => {

            if (input.getAttribute("data-validate") == "true") {
                if (input.value == "") {
                    error++;
                    if (error == 1) {validate.message(input.getAttribute("data-text"),"error");}
                } else {

                    if (input.getAttribute("type") == "email") { next_step = validate.emailValidate(input.value) == true ? true : false;} else { next_step = true;}

                     // Checkbox check

                     if(index == 4){if (input.getAttribute("type") == "checkbox") {next_step = validate.check_checkbox(input);} else {next_step = true; }}

                    // if any error then stop next step..

                    if (next_step) {validate.set_success(input);} else {validate.message(input.getAttribute("data-text"),"error");error++;}

                }
            }

        });

        if (error == 0) { let formData = new FormData(form);validate.request("register","post","{{ csrf_token() }}",formData,"register") }
        e.preventDefault();
    });
</script>