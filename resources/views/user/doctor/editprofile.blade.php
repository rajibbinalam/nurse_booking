@extends('user.layout')
@section('title')
{{__("message.My Profile")}}
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
                <h1>{{__("message.My Profile")}}</h1>
            </div>
        </div>
    </div>
    <div class="lower-content">
        <ul class="bread-crumb clearfix">
            <li><a href="{{url('/')}}">{{__("message.Home")}}</a></li>
            <li>{{__("message.My Profile")}}</li>
        </ul>
    </div>
</section>
<section class="doctors-dashboard bg-color-3">
    <div class="left-panel">
        <div class="profile-box">
            <div class="upper-box">
                <figure class="profile-image">
                    @if($doctordata->image!="")
                    <img src="{{asset('upload/doctors').'/'.$doctordata->image}}" alt="">
                    @else
                    <img src="{{asset('front_pro/assets/images/resource/profile-2.png')}}" alt="">
                    @endif
                </figure>
                <div class="title-box centred">
                    <div class="inner">
                        <h3>{{$doctordata->name}}</h3>
                        <p>{{isset($doctordata->departmentls)?$doctordata->departmentls->name:""}}</p>
                    </div>
                </div>
            </div>
            <div class="profile-info">
                <ul class="list clearfix">
                    <li><a href="{{url('doctordashboard')}}"><i class="fas fa-columns"></i>{{__('message.Dashboard')}}</a></li>
                    <li><a href="{{url('doctorappointment')}}"><i class="fas fa-calendar-alt"></i>{{__('message.Appointment')}}</a></li>
                    <li><a href="{{url('doctortiming')}}"><i class="fas fa-clock"></i>{{__('message.Schedule Timing')}}</a></li>
                    <li><a href="{{url('doctorreview')}}"><i class="fas fa-star"></i>{{__('message.Reviews')}}</a></li>
                    <li><a href="{{url('doctor_hoilday')}}"><i class="fas fa-star"></i>{{__('message.My Hoilday')}}</a></li>
                    <li><a href="{{url('doctoreditprofile')}}" class="current"><i class="fas fa-user"></i>{{__('message.My Profile')}}</a></li>
                    <li><a href="{{url('paymenthistory')}}"><i class="fas fa-user"></i>{{__('message.Payment History')}}</a></li>
                    <li><a href="{{url('doctorchangepassword')}}"><i class="fas fa-unlock-alt"></i>{{__('message.Change Password')}}</a></li>
                    <li><a href="{{url('logout')}}"><i class="fas fa-sign-out-alt"></i>{{__("message.Logout")}}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="right-panel">
        <div class="content-container">
            <div class="outer-container">
                <div class="add-listing my-profile">
                    <div class="single-box">
                        <div class="title-box">
                            <h3>{{__("message.My Profile")}}</h3>
                        </div>
                        <div class="inner-box">
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
                            <form action="{{url('updatedoctor')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="profile-title">
                                    <div class="image-box">
                                        @if($doctordata->image!="")
                                        <img src="{{asset('upload/doctors').'/'.$doctordata->image}}" alt="" accept="image/*" style="max-height: 150px; max-width: 140px;">
                                        @else
                                        <img src="{{asset('front_pro/assets/images/resource/profile-2.png')}}" alt="" style="max-height: 150px; max-width: 140px;">
                                        @endif
                                    </div>
                                    <div class="upload-photo">
                                        <input type="file" name="upload_image" accept="image/*" style="background: transparent; box-shadow: none">
                                        <span></span>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>{{__('message.Name')}}</label>
                                        <input type="text" name="name" id="name" placeholder="{{__('message.Enter Doctor Name')}}" required="" value="{{isset($doctordata->name)?$doctordata->name:''}}">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <div class="seldoctor">
                                            <label>{{__('Services')}} *</label>
                                            <select name="department_id" id="department_id" required>
                                                <option value="">{{__('message.Select Specialist')}}</option>
                                                @foreach($department as $dp)
                                                <option value="{{$dp->id}}" <?= isset($doctordata->department_id)&&$dp->id==$doctordata->department_id?'selected="selected"':""?>>{{$dp->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>{{__('message.Email')}}</label>
                                        <input type="email" name="email" placeholder="{{__('message.Your email')}}" required="" id="email" value="{{isset($doctordata->email)?$doctordata->email:''}}">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>{{__('message.Phone no')}}</label>
                                        <input type="text" name="phoneno" id="phoneno" placeholder="{{__('message.Enter Phone No')}}" required="" value="{{isset($doctordata->phoneno)?$doctordata->phoneno:''}}">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 form-group">
                                        <label>{{__('Gender')}} *</label>
                                        <select name="gender" class="form-control" id="" required>
                                            <option value="" selected disabled>Choose One</option>
                                            <option value="1" {{ $doctordata->gender == 1 ? 'selected' : '' }}>Male</option>
                                            <option value="2" {{ $doctordata->gender == 2 ? 'selected' : '' }}>Female</option>
                                            <option value="3" {{ $doctordata->gender == 3 ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6 form-group">
                                        <label for="consultation_fees">{{__("Fee")}}<span class="reqfield">*</span></label>
                                        <input type="number" name="consultation_fees" value="{{isset($doctordata->consultation_fees)?$doctordata->consultation_fees:''}}" class="form-control" id="consultation_fees" min="1" step="0.01" style="width: 60%; display: inline;">
                                        <span>/Shift</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 form-group">
                                        <label for="age">{{__("Age")}}<span class="reqfield">*</span></label>
                                        <input type="number" name="age" value="{{isset($doctordata->age)?$doctordata->age:''}}" class="form-control" id="age" min="1" required>
                                    </div>

                                    {{-- <div class="col-lg-4 col-md-4 col-sm-6 form-group">
                                        <label>{{__('message.Working Time')}}</label>
                                        <input type="text" name="working_time" placeholder="{{__('message.Enter Working Time')}}" id="working_time" value="{{isset($doctordata->working_time)?$doctordata->working_time:''}}">
                                    </div> --}}
                                    {{-- <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>{{__('message.Facebook Url')}}</label>
                                        <input type="text" name="facebook_url" id="facebook_url" placeholder="{{__('message.Enter Facebook Url')}}" value="{{isset($doctordata->facebook_url)?$doctordata->facebook_url:''}}">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>{{__('message.Twitter Url')}}</label>
                                        <input type="text" id="twitter_url" name="twitter_url" placeholder="{{__('message.Enter Twitter Url')}}" value="{{isset($doctordata->twitter_url)?$doctordata->twitter_url:''}}">
                                    </div> --}}

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>{{__('message.About Us')}}</label>
                                        <textarea name="aboutus" id="aboutus" placeholder="{{__('message.Enter About Doctor')}}">{{isset($doctordata->aboutus)?$doctordata->aboutus:''}}</textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>{{__('message.Services')}}</label>
                                        <textarea name="services" id="services" placeholder="{{__('message.Enter Description about Services')}}">{{isset($doctordata->services)?$doctordata->services:''}}</textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>{{__('Experience')}}</label>
                                        <textarea name="healthcare" id="healthcare" placeholder="{{__('message.Enter Health Care')}}">{{isset($doctordata->healthcare)?$doctordata->healthcare:''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 p-0" id="addressorder">
                                    <label>{{__("message.Address")}}<span class="reqfield">*</span></label>
                                    <input type="text" id="us2-address" name="address" placeholder='{{__("message.Search Location")}}' data-parsley-required="true" />
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 p-1 mt-4" id="document1">
                                        <label>{{__("Last education certificate : ")}}<span class="reqfield">@if (empty($doctordata->document)) * @endif</span></label>
                                        <input type="file" id="us2-address" class="form-control" name="document" @if (empty($doctordata->document)) required @endif/>
                                        @if (!empty($doctordata->document))
                                            <a href="{{asset('upload/doctor_document').'/'.$doctordata->document}}" target="_blank">Download Document</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 p-1 mt-4" id="document2">
                                        <label>{{__("NID / birth certificate : ")}}<span class="reqfield">@if (empty($doctordata->document1)) * @endif</span></label>
                                        <input type="file" id="us2-address" class="form-control" name="document1" @if (empty($doctordata->document1)) required @endif />
                                        @if (!empty($doctordata->document1))
                                            <a href="{{asset('upload/doctor_document').'/'.$doctordata->document1}}" target="_blank">Download Document</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 p-1 mt-4" id="document3">
                                        <label>{{__("Diploma/Certification : ")}}<span class="reqfield">@if (empty($doctordata->document2)) * @endif</span></label>
                                        <input type="file" id="us2-address" class="form-control" name="document2" @if (empty($doctordata->document2)) required @endif />
                                        @if (!empty($doctordata->document2))
                                            <a href="{{asset('upload/doctor_document').'/'.$doctordata->document2}}" target="_blank">Download Document</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 p-1 mt-4" id="document4">
                                        <label>{{__("Experience (if you have): ")}}<span class="reqfield">*</span></label>
                                        <input type="file" id="us2-address" class="form-control" name="document3" />
                                        @if (!empty($doctordata->document3))
                                            <a href="{{asset('upload/doctor_document').'/'.$doctordata->document3}}" target="_blank">Download Document</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="map" id="maporder">
                                    <div class="form-group">
                                        <div class="col-md-12 p-0">
                                            <div id="us2"></div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="lat" id="us2-lat" value="{{isset($doctordata->lat)?$doctordata->lat:Config::get('mapdetail.lat')}}" />
                                <input type="hidden" name="lon" id="us2-lon" value="{{isset($doctordata->lon)?$doctordata->lon:Config::get('mapdetail.long')}}" />

                        </div>

                    </div>
                    <div class="btn-box">
                        <button class="theme-btn-one" type="submit">{{__('message.Save Change')}}<i class="icon-Arrow-Right"></i></button>
                        <a href="{{url('changepassword')}}" class="cancel-btn">{{__('message.Cancel')}}</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
