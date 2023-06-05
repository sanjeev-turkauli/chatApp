<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title }}</title>
    @component('components.header')@endcomponent
</head>

<body>
    <div class="main" id="root">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{url('assets/authentication/images/signin-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{url('/')}}" class="signup-image-link">Create an account</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form class="register-form" id="login-form" style="padding: 5px;">
                            @csrf
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email" class="validate" data-validate="true" data-text="Please Enter Email ID..."/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" class="validate" data-validate="true" data-text="Please Enter Password..."/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <button class="btn btn-primary" type="submit">
                                <span>Login</span>
                                <span class="spinner-border spinner-border-sm visually-hidden submit_login" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @component('components.footer')@endcomponent
</body>
</html>
<script type="module">
    import { authentication } from "./assets/js/authentication.js";
    let auth = new authentication();
    let loginForm = document.querySelector(".register-form");
    let inputs = document.querySelectorAll(".validate");
    
    

    loginForm.addEventListener("submit",(e)=>{
        let formData = new FormData(loginForm);let error = 0;

        inputs.forEach((inputs,index)=>{
            if(inputs.getAttribute("data-validate") == "true"){
                if(inputs.value == ""){
                    error++;
                    if(error == 1){
                        auth.message(inputs.getAttribute("data-text"),"error");
                    }
                }
            }
        });

        if(error == 0){auth.request("login","post","{{ csrf_token() }}",formData,"login");}
        e.preventDefault();
    })
</script>
