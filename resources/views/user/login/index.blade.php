<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('user-assets/css/face.css') }}">
<link rel="stylesheet" href="{{ asset('user-assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('user-assets/css/media.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/img/logos/icon.png') }}">
    <title>Signin & Sign up</title>

    <style>
      .svg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
   
}
    </style>
  </head>

  <body>
  
    <div class="wrapper">
      <div class="form-container sign-up">
        <form class="form-up" method="POST" action="{{ route('user.store') }}">
        @csrf
          <h2>sign up</h2>
          <div class="form-group">
            <input id="signup-us" type="text" required name="name" />
            <i class="fas fa-user"></i>
            <label for="">username</label>
          </div>
          <div class="form-group">
            <input id="signup-em" type="email" required name="email" />
            <i class="fas fa-at"></i>
            <label for="">email</label>
          </div>
          @error('email')
          <p class='error up-error'>{{ $message }} </p>
          @enderror
          <div class="form-group">
            <input class="secure-text" id="signup-pw" type="password" required name="password" />
            <i class="fas fa-lock"></i>
            <label for="">password</label>
          </div>
          @error('password')
          <p class='error up-error'>{{ $message }} </p>
          @enderror
          <div class="form-group">
            <input class="secure-text" id="signup-pwm" type="password" required name="password_confirmation" />
            <i class="fas fa-lock"></i>
            <label for="">confirm password</label>
          </div>
          <button id="signup" type="submit" class="btn">sign up</button>
          <div class="link">
            <p class="error up-error"></p>
            <label>or</label>

                  
      <!--google sign up start-->
      <div class="google-logup"
      id="g_id_onload"
      data-client_id="364521177272-dco06l33lfdv9at0ra5pkg5tjr3bdc8b.apps.googleusercontent.com"
      data-context="signin"
      data-ux_mode="popup"
      data-param="up"
      data-callback="auth_info"
      data-auto_prompt="false"
      ></div>

      <div
      class="g_id_signin"
      data-type="standard"
      data-shape="rectangular"
      data-theme="outline"
      data-text="continue_with"
      data-size="large"
      data-logo_alignment="left"
      ></div>
      <!--google sign up End-->

<!---->
            <p>
              You already have an account?<a href="#" class="signin-link">
                sign in</a
              >
            </p>
          </div>
        </form>
      </div>
      <div class="form-container sign-in">
        <form class="form-lg" action="./php/check_login.php">
          <!-- 3d face start-->
          <div class="face-3d">
            <img src="{{ asset('assets/img/logos/logo.png') }}" style="width: 100%;height: 100%;object-fit: cover;" alt="" srcset="">
          </div>
          <!-- 3d face end-->
          <h2>login</h2>
          <div class="form-group">
            <input id="login_em" type="text" required />
            <i class="fas fa-user"></i>
            <label id="login_em_label" for="">Email</label>
          </div>
          <div class="form-group">
            <input class="secure-text" id="login_pw" type="password" required />
            <i class="fas fa-lock"></i>
            <label id="login_pw_label" for="">password</label>
          </div>

      
            <label id="showPasswordToggle" for="showPasswordCheck"
            >Show
            <input id="showPasswordCheck" type="checkbox" />
            <div class="indicator"></div>
          </label>
       
          <!-- <div class="forgot-pass">
            <a href="#">forgot password?</a>
          </div> -->
          <button type="submit" class="btn">login</button>
          <div class="link">
            <p class="error lg-error"></p>
            <label>or</label>

<!--google login start-->
            <div class="google-login"
            id="g_id_onload1"
            data-client_id="364521177272-dco06l33lfdv9at0ra5pkg5tjr3bdc8b.apps.googleusercontent.com"
            data-context="signin"
            data-ux_mode="popup"
            data-param="in"
            data-callback="auth_info"
            data-auto_prompt="false"
          ></div>
    
          <div
            class="g_id_signin"
            data-type="standard"
            data-shape="rectangular"
            data-theme="outline"
            data-text="continue_with"
            data-size="large"
            data-logo_alignment="left"
          ></div>
          <!--google login End-->

          <p>
            Don't have an account?<a href="#" class="signup-link"> sign up</a>
          </p>

          
        </div>

        


          </div>
        </form>
      </div>
    </div>
    <script
      src="https://kit.fontawesome.com/9e5ba2e3f5.js"
      crossorigin="anonymous"
    ></script>

    <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"
  ></script>
  <script type="text/javascript">
    (function () {
      emailjs.init({
        publicKey: "uoHhCYT1WpaarOefU",
      });
    })();
  </script>
    <script src="{{ asset('user-assets/js/script.js') }}"></script>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@3.1.2/build/jwt-decode.min.js"></script>
    
  </body>
</html>
