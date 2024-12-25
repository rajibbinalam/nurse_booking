@extends('user.layout')
@section('title')
{{__('message.Forgot Password')}}
@stop
@section('meta-data')
<meta property="og:type" content="website" />
<meta property="og:url" content="{{__('message.System Name')}}" />
<meta property="og:title" content="{{__('message.System Name')}}" />
<meta property="og:image" content="{{asset('image_web/').'/'.$setting->favicon}}" />
<meta property="og:image:width" content="250px" />
<meta property="og:image:height" content="250px" />
<meta property="og:site_name" content="{{__('message.System Name')}}" />
<meta property="og:description" content="{{__('message.meta_description')}}" />
<meta property="og:keyword" content="{{__('message.Meta Keyword')}}" />
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
                <h1>{{__('message.Forgot Password')}}</h1>
            </div>
        </div>
    </div>
    <div class="lower-content">
        <div class="auto-container">
            <ul class="bread-crumb clearfix">
                <li><a href="{{url('/')}}">{{__('message.Home')}}</a></li>
                <li>{{__('message.Forgot Password')}}</li>
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
                    <h3>{{__('message.Forgot Password')}}</h3>
                    <a href="{{url('patientlogin')}}">{{__('message.Already a User')}}</a>
                </div>
                <div class="inner">
                    <div class="row clearfix otp-div" style="display: block;">
                        <div class="otp-send-div">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label>{{__('message.Phone')}}</label>
                                <input type="text" id="phone" placeholder="Enter Phone" style="width: 100%" required="" value="+880" maxlength="14">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn-one" onclick="sendOTP()">OTP Send<i class="icon-Arrow-Right"></i></button>
                            </div>
                        </div>

                        <div class="otp-verify-div" style="display: none;">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="fr">Enter OTP</label>
                                <input type="text" name="otp" id="otp" placeholder="Enter Your OTP number" maxlength="4" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn-one" onclick="verfyOTP()">Verify OTP<i class="icon-Arrow-Right"></i></button>
                            </div>
                        </div>


                    </div>

                    <form action="{{url('postforgotpassword')}}" method="post" class="registration-form" style="display: none" id="forget-password-form">
                        {{csrf_field()}}
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label>{{__('message.Email')}}</label>
                                <input type="email" name="email" placeholder="{{__('message.Enter Email Address')}}" required="">
                                {{-- <input type="text" name="phone" id="fotget_pass_phone" required="" readonly> --}}
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn-one">{{__('message.Forgot Password')}}<i class="icon-Arrow-Right"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="text"><span>{{__('message.or')}}</span></div>

                    <div class="login-now">
                        <p>{{__('message.Already have an account')}}<a href="{{url('patientlogin')}}">{{__('message.Log In')}}</a></p>
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
<input type="hidden" id="code">
@stop
@section('footer')
<script>
    function sendOTP(){
        var phone = $('#phone').val();
        if(phone == ''){
            alert('Please enter phone number');
            return false;
        }
        $.ajax({
            url: "{{url('send-otp')}}",
            type: 'POST',
            data: {
                phone: phone,
                type: 'forgot',
                _token: "{{csrf_token()}}"
            },
            success: function(data){
                console.log(data);
                if(data.status == 'success'){
                    $('.otp-send-div').hide();
                    $('.otp-verify-div').show();
                    $('#code').val(data.code);
                }else{
                    alert('OTP not sent. There is some issue. Msg: '+data.msg);
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    }


    function verfyOTP(){
        let otpCode = $('#code').val();
        let enterOTPCode = $('#otp').val();
        if(otpCode == enterOTPCode){
            $('.otp-verify-div').hide();
            $('.otp-send-div').hide();
            // $('#forget-password-form').show();
            setTimeout(() => {
                window.location.href = "{{url('resetpassword/')}}/"+$('#code').val();
            }, 100);
        }else{
            alert('OTP not matched');
        }
    }
</script>
@stop
