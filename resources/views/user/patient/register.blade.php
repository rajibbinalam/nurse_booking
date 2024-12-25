@extends('user.layout')
@section('title')
{{__('message.User Register')}}
@stop
@section('meta-data')
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{__('message.System Name')}}"/>
<meta property="og:title" content="{{__('message.System Name')}}"/>
<meta property="og:image" content="{{asset('image_web/').'/'.$setting->favicon}}"/>
<meta property="og:image:width" content="250px"/>
<meta property="og:image:height" content="250px"/>
<meta property="og:site_name" content="{{__('message.System Name')}}"/>
<meta property="og:description" content="{{__('message.meta_description')}}"/>
<meta property="og:keyword" content="{{__('message.Meta Keyword')}}"/>
<link rel="shortcut icon" href="{{asset('image_web/').'/'.$setting->favicon}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
@section('content')
<section class="page-title-two">
   <div class="title-box centred bg-color-2">
      <div class="pattern-layer">
         <div class="pattern-1" style="background-image: url('{{asset('front_pro/assets/images/shape/shape-70.png')}}');"></div>
         <div class="pattern-2" style="background-image: url('{{asset('front_pro/assets/images/shape/shape-71.png')}}');"></div>
      </div>
      <div class="auto-container">
         <div class="title">
            <h1>{{__('message.User Register')}}</h1>
         </div>
      </div>
   </div>
   <div class="lower-content">
      <div class="auto-container">
         <ul class="bread-crumb clearfix">
            <li><a href="{{url('/')}}">{{__('message.Home')}}</a></li>
            <li>{{__('message.User Register')}}</li>
         </ul>
      </div>
   </div>
</section>
<section class="registration-section bg-color-3">
   <div class="pattern">
      <div class="pattern-1" style="background-image: url('{{asset('front_pro/assets/images/shape/shape-85.png')}}');"></div>
      <div class="pattern-2" style="background-image: url('{{asset('front_pro/assets/images/shape/shape-86.png')}}');"></div>
   </div>
   <div class="auto-container">
      <div class="inner-box">
         <div class="content-box">
            <div class="title-box">
               <h3>{{__('message.User Register')}}</h3>
               <a href="{{url('patientlogin')}}">{{__('message.Already a User')}}</a>
            </div>
            <div class="inner">
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
               <div id="registererror">
               </div>
               @if ($patient_reg_number)
               <form action="{{url('userpostregister')}}" method="post" class="registration-form">
                  {{csrf_field()}}
                  <div class="row clearfix">
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>{{__('message.Name')}}</label>
                        <input type="text" id="name" name="name" placeholder="{{__('message.Your name')}}" required="" value="{{old('name')}}" onkeyup="restrictToString(this)" />
                        @if ($errors->has('name'))
                          	<span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>{{__('message.Phone')}}</label>
                        <input type="text" name="phone" id="phone" placeholder="{{__('message.Enter Your Phone number')}}" value={{ $patient_reg_number }} value="+880{{old('phone')}}" maxlength="14" readonly/>
                        @if ($errors->has('phone'))
                          	<span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>{{__('message.Email')}}</label>
                        <input type="email" name="email" id="email" placeholder="{{__('message.Your email')}}" required="" value="{{old('email')}}"/>
                        @if ($errors->has('email'))
                          	<span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>{{__('message.Password')}}</label>
                        <input type="password" name="password" id="pwd" placeholder="{{__('message.Enter password')}}" required="" value="{{old('password')}}" onkeyup="checkPasswordStrength()" />
                        <div id="password-error" style="color: red;"></div>
                        @if ($errors->has('password'))
                          	<span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>{{__('message.Confirm password')}}</label>
                        <input type="password" name="password_confirmation" id="cpwd"  placeholder="{{__('message.Enter Confirm password')}}" required="" onchange="checkbothpassword(this.value)"/>
                        <div id="cpassword-error" style="color: red;"></div>
                        @if ($errors->has('password_confirmation'))
                          	<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <div class="custom-check-box">
                           <div class="custom-controls-stacked">
                              <label class="custom-control material-checkbox">
                              <input type="checkbox" class="material-control-input" name="agree" value="1" />
                              <span class="material-control-indicator"></span>
                              <span class="description">{{__('message.I accept')}} <a href="{{url('/')}}">{{__('message.terms')}}</a> {{__('message.and')}} <a href="{{url('/')}}">{{__('message.conditions')}}</a> {{__('message.and general policy')}}</span>
                              </label>
                           </div>
                        </div>
                         @if ($errors->has('agree'))
                          	<span class="text-danger">{{ $errors->first('agree') }}</span>
                        @endif
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                        <button type="submit" class="theme-btn-one">{{__('message.Register Now')}}<i class="icon-Arrow-Right"></i></button>
                     </div>
                  </div>
               </form>
               @else
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label class="fr">{{__('message.Phone Number')}}</label>
                            <input type="text" name="phone" id="phone" placeholder="{{__('message.Enter Your Phone number')}}" required="" value="+880" maxlength="14" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group otp-div" style="display: none">
                            <label class="fr">Enter OTP</label>
                            <input type="text" name="otp" id="otp" placeholder="Enter Your OTP number" maxlength="4" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group otp-submit-btn" style="display: none">
                            <button type="button" class="theme-btn-one" onclick="verifyOTP()">OTP Verify<i class="icon-Arrow-Right"></i></button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group otp-sent-btn">
                            <button type="button" class="theme-btn-one" id="otp-verify" onclick="sendOTP()">Send OTP<i class="icon-Arrow-Right"></i></button>
                        </div>
                    </div>
                    @endif
               <div class="text"><span>{{__('message.or')}}</span></div>
               <div class="login-now">
                  <p>{{__('message.Already have an account')}} <a href="{{url('patientlogin')}}">{{__('message.Login Now')}}</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="agent-section" style="background: aliceblue;">
   <div class="auto-container">
      <div class="inner-container bg-color-2">
         <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 left-column">
               <div class="content_block_3">
                  <div class="content-box">
                     <h3>{{__('message.Emergency call')}}</h3>
                     <div class="support-box">
                        <div class="icon-box"><i class="fas fa-phone"></i></div>
                        <span>{{__('message.Telephone')}}</span>
                        <h3><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></h3>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 right-column">
               <div class="content_block_4">
                  <div class="content-box">
                     <h3>{{__('message.Sign up for Newsletter today')}}</h3>
                     <form action="#" method="post" class="subscribe-form">
                        <div class="form-group">
                           <input type="email" name="email" id="emailnews" placeholder="{{__('message.Your email')}}" required="">
                           <button type="button" onclick="addnewsletter()" class="theme-btn-one">{{__('message.Submit now')}}<i class="icon-Arrow-Right"></i></button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@stop
@section('footer')
<script>
    function restrictToString(obj) {
        let value = $(obj).val();
        let originalValue = value;

        value = value.replace(/[^A-Za-z\s]/g, '');

        if (originalValue !== value) {
            $('.name-field-error').html('Only letters and spaces are allowed.');
        } else {
            $('.name-field-error').html('');
        }

        $(obj).val(value);
    }


    function sendOTP(){
        var phone = $('#phone').val();
        if(phone == ''){
            alert('Please enter phone number');
            return false;
        }
        let otpDiv = $('.otp-div');
        let otpSubmitBtn = $('.otp-submit-btn');
        let otpSentBtn = $('.otp-sent-btn');
        $.ajax({
            url: "{{url('send-otp')}}",
            type: 'POST',
            data: {
                phone: phone,
                type: 'patient',
                _token: "{{csrf_token()}}"
            },
            success: function(data){
                // console.log(data);
                if(data.status == 'success'){
                    otpDiv.show();
                    otpSubmitBtn.show();
                    $('#phone').attr('readonly', true);
                    otpSentBtn.hide();
                }else{
                    alert('OTP not sent. There is some issue');
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    }

    function verifyOTP(){
        var otp = $('#otp').val();
        var phone = $('#phone').val();
        if(otp == ''){
            alert('Please enter OTP');
            return false;
        }
        $.ajax({
            url: "{{url('verify-otp')}}",
            type: 'POST',
            data: {
                phone: phone,
                otp: otp,
                type: 'patient',
                _token: "{{csrf_token()}}"
            },
            success: function(data){
                console.log(data);
                if(data.status == 'success'){
                    $('#registererror').html('<div class="alert alert-success">OTP verified successfully</div>');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }else{
                    alert('OTP not verified. Please try again');
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    }
</script>
@stop
