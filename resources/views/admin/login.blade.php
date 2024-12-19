<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
       @php
        $fav = app\models\Setting::find(1)->title;
        @endphp

      <title>{{__("message.Log In")}} | {{$fav}}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta content='{{__("message.System Name")}}' name="description" />
      <meta content='{{__("message.System Name")}}' name="author" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="{{url('/')}}" />
      <meta property="og:title" content='{{__("message.System Name")}}' />
      <meta property="og:image" content="{{Session::get('favicon')}}" />
      <meta property="og:image:width" content="250px" />
      <meta property="og:image:height" content="250px" />
      <meta property="og:site_name" content='{{__("message.System Name")}}' />
      <meta property="og:description" content='{{__("message.meta_description")}}' />
      <meta property="og:keyword" content='{{__("message.Meta Keyword")}}' />
      <link rel="shortcut icon" href="{{Session::get('favicon')}}" />
      <link href="{{asset('admin_design/layouts/vertical/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
      <link href="{{asset('admin_design/layouts/vertical/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
      @if(__("message.RTL")==0)
      <link href="{{asset('admin_design/layouts/vertical/assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
      @else
      <link href="{{asset('admin_design/layouts/vertical/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
      @endif
   </head>
   <body class="authentication-bg">
      <div class="home-btn d-none d-sm-block"></div>
      <div class="account-pages my-5 pt-sm-5">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="text-center">
                     <a href="index.html" class="mb-5 d-block auth-logo">
                     <img src="{{Session::get('logo')}}" alt="" height="50" class="logo logo-dark" />
                     <img src="{{Session::get('logo')}}" alt="" height="50" class="logo logo-light" />
                     </a>
                  </div>
               </div>
            </div>
            <div class="row align-items-center justify-content-center">
               <div class="col-md-8 col-lg-6 col-xl-5">
                  <div class="card">
                     <div class="card-body p-4">
                        <div class="text-center mt-2">
                           <h5 class="text-primary">{{__("message.Welcome Back")}}</h5>
                           <p class="text-muted">{{__("message.Sign in to continue to Admin")}}</p>
                        </div>
                        @if(Session::has('message'))
                        <div class="col-sm-12">
                           <div class="alert  {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                              {{ Session::get('message') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                        </div>
                        @endif
                        <div class="p-2 mt-4">
                           <form action="{{url('admin/postlogin')}}" class="custom-validation" method="post">
                              {{csrf_field()}}
                              <div class="form-group">
                                 <label for="username">{{__("message.Email")}}</label>
                                 <input
                                    type="email"
                                    required
                                    class="form-control"
                                    id="email"
                                    placeholder='{{__("message.Enter Email Address")}}'
                                    parsley-type="email"
                                    value="{{isset($_COOKIE['email'])?$_COOKIE['email']:'admin@gmail.com'}}"
                                    name="email"
                                    />
                              </div>
                              <div class="form-group">
                                 <label for="password">{{__("message.Password")}}</label>
                                 <input type="password" required class="form-control" id="password" name="password" placeholder='{{__("message.Enter password")}}' value="{{isset($_COOKIE['password'])?$_COOKIE['password']:'123'}}" />
                              </div>
                              <div class="custom-control custom-checkbox">
                                 @if(isset($_COOKIE['rem_me']))
                                 <input type="checkbox" class="custom-control-input" id="auth-remember-check" value="1" name="remember_me" checked />
                                 @else
                                 <input type="checkbox" class="custom-control-input" id="auth-remember-check" value="1" name="remember_me" />
                                 @endif
                                 <label class="custom-control-label" for="auth-remember-check">{{__('message.Remember me')}}</label>
                              </div>
                              <div class="mt-3 text-right">
                                 <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">{{__('message.Log In')}}</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  {{-- <div class="mt-5 text-center">
                     <p>© {{date('Y')}} {{__("message.System Name")}} <i class="mdi mdi-heart text-danger"></i> {{__("message.by Admin Panel")}}</p>
                  </div> --}}
               </div>
            </div>
         </div>
      </div>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/metismenu/metisMenu.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/simplebar/simplebar.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/node-waves/waves.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/js/app.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/libs/parsleyjs/parsley.min.js')}}"></script>
      <script src="{{asset('admin_design/layouts/vertical/assets/js/pages/form-validation.init.js')}}"></script>
   </body>
</html>
