@extends('user.layout')
@section('title')
 {{__('message.Doctor Register')}}
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
                        <h1>{{__('message.Doctor Register')}}</h1>
                    </div>
                </div>
            </div>
            <div class="lower-content">
                <div class="auto-container">
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{url('/')}}">{{__('message.Home')}}</a></li>
                        <li>{{__('message.Doctor Register')}}</li>
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
                            <h3>{{__('message.Doctor Register')}}</h3>
                            <a href="{{url('doctorlogin')}}">{{__("message.Already a Doctor")}}</a>
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
                            <form action="{{url('postdoctorregister')}}" method="post" class="registration-form">
                                {{csrf_field()}}
                                 <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="fr" >{{__('message.Name')}}</label>
                                <input type="text" id="name" name="name" placeholder="{{__('message.Your name')}}" required="" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="fr">{{__('message.Phone Number')}}</label>
                                <input type="text" name="phone" id="phone" placeholder="{{__('message.Enter Your Phone number')}}" required="" value="+880" maxlength="14" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="fr">{{__('message.Email')}}</label>
                                <input type="email" name="email" id="email" placeholder="{{__('message.Your email')}}" required="" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="fr">{{__('message.Password')}}</label>
                                <input type="password" name="password" id="pwd" placeholder="{{__('message.Enter password')}}" required="" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="fr">{{__('message.Confirm password')}}</label>
                                <input type="password" name="cpassword" id="cpwd" onchange="checkbothpassword(this.value)" placeholder="{{__('message.Enter Confirm password')}}" required="" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class="custom-check-box fr">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control material-checkbox">
                                            <input type="checkbox" class="material-control-input" name="agree" value="1" required="" />
                                            <span class="material-control-indicator"></span>
                                             <span class="description">{{__('message.I accept')}} <a href="{{url('/')}}">{{__('message.terms')}}</a> {{__('message.and')}} <a href="{{url('/')}}">{{__('message.conditions')}}</a> {{__('message.and general policy')}}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                <button type="submit" class="theme-btn-one">{{__('message.Register Now')}}<i class="icon-Arrow-Right"></i></button>
                            </div>
                        </div>
                            </form>
                            <div class="text"><span>{{__('message.or')}}</span></div>

                            <div class="login-now"><p>{{__('message.Already have an account')}} <a href="{{url('doctorlogin')}}">{{__('message.Login Now')}}</a></p></div>
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
@stop
