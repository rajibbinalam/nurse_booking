@extends('admin.layout')
@section('title')
{{__("message.save")}} {{__("Patient")}} | {{__("message.Admin")}} {{__("Patient")}}
@stop
@section('meta-data')
@stop
@section('content')
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-flex align-items-center justify-content-between">
                  <h4 class="mb-0">{{__("message.save")}} {{__("Patient")}}</h4>
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/patients')}}">{{__("Patient")}}</a></li>
                        <li class="breadcrumb-item active">{{__("message.save")}} {{__("Patient")}}</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: flex;justify-content: center;">
            <div class="col-8">
               <div class="card">
                  <div class="card-body">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <div class="mar20">
                                    <div id="uploaded_image">
                                       <div class="upload-btn-wrapper">
                                          <button  type="button" class="btn imgcatlog">
                                          <input type="hidden" name="real_basic_img" id="real_basic_img" value="<?= isset($patient->image)?$patient->image:""?>"/>
                                          <?php
                                             if(isset($patient->image)){
                                                 $path=asset('upload/profile')."/".$patient->image;
                                             }
                                             else{
                                                 $path=asset('upload/profile/profile.png');
                                             }
                                             ?>
                                          <img src="{{$path}}" alt="..." class="img-thumbnail imgsize"  id="basic_img" >
                                          </button>
                                          <input type="hidden" name="basic_img" id="basic_img1"/>
                                          <input type="file" name="upload_image" id="upload_image" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="name">{{__("message.Name")}}<span class="reqfield"></span></label>
                                 <input readonly type="text" class="form-control" placeholder='{{__("message.Enter Doctor Name")}}' id="name" name="name" required="" value="{{isset($patient->name)?$patient->name:''}}">
                              </div>
                              <div class="form-group">
                                 <label for="name">{{__("Gender")}}<span class="reqfield"></span></label>
                                 <input readonly type="text" class="form-control" placeholder='{{__("message.Enter Doctor Name")}}' id="name" name="name" required="" value="{{isset($patient->gender)?$patient->gender:''}}">
                              </div>
                              <div class="form-group">
                                 <label for="name">{{__("Age")}}<span class="reqfield"></span></label>
                                 <input readonly type="text" class="form-control" placeholder='{{__("message.Enter Doctor Name")}}' id="name" name="name" required="" value="{{isset($patient->age)?$patient->age:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="phoneno">{{__("message.Phone")}}<span class="reqfield"></span></label>
                                 <input readonly type="text" class="form-control" id="phoneno" placeholder='{{__("message.Enter Phone")}}' name="phoneno" required="" value="{{isset($patient->phone)?$patient->phone:''}}">
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label for="email">{{__("message.Email")}}<span class="reqfield"></span></label>
                                 <input readonly type="email" class="form-control" id="email" placeholder='{{__("message.Enter Email Address")}}' name="email" required="" <?= isset($id)&&$id!=0?'readonly':""?> value="{{isset($patient->email)?$patient->email:''}}">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 p-0"  id="addressorder">
                           <label>{{__("message.Address")}}<span class="reqfield"></span></label>
                           <input readonly type="text" id="us2-address" name="address" value="{{ $patient->address }}" placeholder='{{__("message.Search Location")}}' required data-parsley-required="true" required=""/>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5>Patient Document: </h5>
                            </div>
                            @if (!empty($patient->document4))
                            <div class="col-md-6 mb-5">
                                <label for="">NID Front</label>
                                <a href="{{asset('upload/user_document').'/'.$patient->document4}}" class="ml-5" target="_blank">Download</a>
                            </div>
                            @endif
                            @if (!empty($patient->document1))
                            <div class="col-md-6 mb-5">
                                <label for="">NID Back</label>
                                <a href="{{asset('upload/user_document').'/'.$patient->document1}}" class="ml-5" target="_blank">Download</a>
                            </div>
                            @endif
                            @if (!empty($patient->document2))
                            <div class="col-md-6 mb-5">
                                <label for="">Document One</label>
                                <a href="{{asset('upload/user_document').'/'.$patient->document2}}" class="ml-5" target="_blank">Download</a>
                            </div>
                            @endif
                            @if (!empty($patient->document3))
                            <div class="col-md-6 mb-5">
                                <label for="">Document Two</label>
                                <a href="{{asset('upload/user_document').'/'.$patient->document3}}" class="ml-5" target="_blank">Download</a>
                            </div>
                            @endif
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('footer')
@stop
