<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use validate;
use Sentinel;
use DB;
use DataTables;
use App\Models\Services;
use App\Models\Doctors;
use App\Models\Setting;
use App\Models\Review;
use App\Models\Newsletter;
use App\Models\Schedule;
use App\Models\BookAppointment;
use App\Models\SlotTiming;
use App\Models\FavoriteDoc;
use App\Models\Contact;
use App\Models\Patient;
use App\Models\Resetpassword;
use App\Models\About;
use App\Models\Privecy;
use App\Models\Doctor_Hoilday;
use App\Models\Code;
use App\Models\PaymentGatewayDetail;
use App\Models\PrivecyApp;
use App\Models\DataDeletion;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;
use Mail;
use Nette\Utils\Random;

class FrontController extends Controller
{

    public function savereview(Request $request){
        $data = new Review();
        $data->user_id = $request->user_id;
        $data->rating = $request->rating3;
        $data->doc_id = $request->doctor_id;
        $data->description = $request->description;
        $data->save();
        return redirect()->back();
    }

    public function showhome(){

        $doctor= DB::table( 'doctors' )
                                ->join( 'review', 'review.doc_id', '=', 'doctors.id' )
                                ->groupBy( 'doctors.id' )
                                ->select( 'doctors.id', DB::raw( 'AVG( review.rating ) as avgratting' ) )
                                ->orderby('id','DESC')
        		   				->where("is_approve","1")
                                ->take(8)
                                ->get();
                $main_array=array();
               foreach ($doctor as $k) {
                  $ls=Doctors::find($k->id);
                  $ls->avgratting=Review::where('doc_id',$k->id)->avg('rating');
                  $ls->totalreview=count(Review::where('doc_id',$k->id)->get());
                  if(!empty(Session::get("user_id"))&&Session::get('role_id')=='1'){
                    $lsfav=FavoriteDoc::where("doctor_id",$k->id)->where("user_id",Session::get("user_id"))->first();
                    if($lsfav){
                        $ls->is_fav=1;
                    }else{
                        $ls->is_fav=0;
                    }

                  }else{
                    $ls->is_fav=0;
                  }

                  $main_array[]=$ls;
               }


               $setting=Setting::find(1);
               $department=Services::take(8)->get();
              return view('user.home')->with("department",$department)->with("doctorlist",$main_array)->with("setting",$setting);



        $code = env('code');
        $package = env('package');

        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.envato.com/v3/market/author/sale?code=' . $code,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer Igf12kV2GgnOVTvuv1AdWQAWink7uB9c',
                    'Cookie: __cf_bm=fS06Rel_QX0e62g2A88TYW_sNDVtCvNpyFB6wj21sYY-1706253864-1-AUlsl/at+BpzxXplae3YQYTZhFup7YpSd7oAHIm40gp9lDUY2Jaw8BzvYaRkF4gmmW94NjYHS5X9a1SLaICEDRY='
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // return $response;
            $responseArray = json_decode($response, true);

            if (isset($responseArray['error']) && $responseArray['error'] === 'Blocked') {
                return array("status" => 0, "msg" => "error");
                // return response()->json($responseArray);
            } else {

                $data = Code::where('code', $code)->first();

                if ($data) {
                    $data1 = Code::where('code', $code)->where('package', $package)->first();
                    if ($data1) {
                        // return array("status" => 1, "msg" => "Details Already saved");
                        return view('user.home')->with("department",$department)->with("doctorlist",$main_array)->with("setting",$setting);
                    } else {
                        return array("status" => 0, "msg" => "error");
                    }
                } else {
                    $data3 = Code::where('package', $package)->first();
                    if ($data3) {
                        return array("status" => 0, "msg" => "error");
                    } else {
                        $data = new Code();
                        $data->code = $code;
                        $data->name = env('name');
                        $data->type = env('type');
                        $data->package = $package;
                        $data->save();

                        // return array("status" => 1, "msg" => "Details Save Success");
                        return view('user.home')->with("department",$department)->with("doctorlist",$main_array)->with("setting",$setting);
                    }
                }

            }
    }

     public function deposit_payment(Request $request)
    {
        // dd($request);
        // die("AA");
        if($request->input('payment_type')==2)
        {

            $id = Session::get('user_id');
            $sub_amout=Subscription::where('id',$request->get("sub_plan"))->first();

            $data=new Subscriber();
            $data->doctor_id=$id;
            $data->subscription_id=$request->get("sub_plan");
            $data->payment_type = $request->input('payment_type');
            $data->amount = $sub_amout->price;
            $data->date= $this->getsitedateall();
            $data->description=$request->get("description");
            $data->status ="1";
            if($request->hasFile('file'))
            {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/upload/bank_receipt/';
                $picture = time() . '.' . $extension;
                $destinationPath = public_path() . $folderName;
                $request->file('file')->move($destinationPath, $picture);
                $data->deposit_image =$picture;
            }
            $data->save();
            if($data){

                    Session::flash('message',"Subscription Book Successfully");
                    Session::flash('alert', 'sucess');

            }else {
                    Session::flash('message',"Something Getting Worng");
                    Session::flash('alert', 'danger');
            }

            return redirect()->back();
        }

    }

    public function braintree_payment(Request $request)
    {

        if($request->input('payment_type')==1)
        {
            $id = Session::get('user_id');
            $sub_amout=Subscription::where('id',$request->get("sub_plan"))->first();

            $gateway = new \Braintree\Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId'  => env('BRAINTREE_MERCHANT_ID'),
                'publicKey'   => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey'  => env('BRAINTREE_PRIVATE_KEY')
             ]);
            $nonce = $request->get("payment_method_nonce");
            $result = $gateway->transaction()->sale([
                          'amount' => $sub_amout->price,
                          'paymentMethodNonce' => $nonce,
                          'options' => [
                              'submitForSettlement' => true
                          ]
                      ]);
            if ($result->success) {
                  $transaction = $result->transaction;
                  DB::beginTransaction();
                  try {

                            $data=new Subscriber();
                            $data->doctor_id=$id;
                            $data->payment_type = $request->input('payment_type');
                            $data->amount = $sub_amout->price;
                            $data->date= $this->getsitedateall();
                            $data->subscription_id=$request->get("sub_plan");

                            $data->status ="2";
                            $data->transaction_id=$transaction->id;
                            $data->save();

                            DB::commit();
                            Session::flash('message',"Subscription Book Successfully");
                            Session::flash('alert', 'sucess');

                        }catch (\Exception $e) {
                              DB::rollback();
                                /*$response['success']="0";
                                $response['register']=$e;*/
                                Session::flash('message',"Something Getting Worng");
                                Session::flash('alert', 'danger');
                        }
                 }else{
                        $errorString = "";
                            foreach($result->errors->deepAll() as $error) {
                                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                            }
                       /* $response['success']="0";
                        $response['register']=$errorString;*/
                        Session::flash('message',"Something Getting Worng");
                        Session::flash('alert', 'danger');

                }

            return redirect()->back();

        }
    }


    public function postforgotpassword(Request $request){
        $checkmobile=Patient::where("email",$request->get("email"))->first();
        $checkdoctor = Doctors::where("email",$request->get("email"))->first();
        if($checkmobile){
            $code=mt_rand(100000, 999999);
            $store=array();
            $store['email']=$checkmobile->email;
            $store['name']=$checkmobile->name;
            $store['code']=$code;
            $add=new ResetPassword();
            $add->user_id=$checkmobile->id;
            $add->code=$code;
            $add->type=1;
            $add->save();
            try {
                    Mail::send('email.forgotpassword', ['user' => $store], function($message) use ($store){
                    $message->to($store['email'],$store['name'])->subject(__("message.System Name"));
                });
            } catch (\Exception $e) {
            }

            Session::flash('message',__("message.Mail Send Successfully"));
            Session::flash('alert', 'sucess');

        }elseif($checkdoctor){
            $code=mt_rand(100000, 999999);
            $store=array();
            $store['email']=$checkdoctor->email;
            $store['name']=$checkdoctor->name;
            $store['code']=$code;
            $add=new ResetPassword();
            $add->user_id=$checkdoctor->id;
            $add->code=$code;
            $add->type=2;
            $add->save();
            try {
                    Mail::send('email.forgotpassword', ['user' => $store], function($message) use ($store){
                    $message->to($store['email'],$store['name'])->subject(__("message.System Name"));
                });
            } catch (\Exception $e) {
            }

            Session::flash('message',__("message.Mail Send Successfully"));
            Session::flash('alert', 'sucess');
        }else{
            Session::flash('message',__("message.error mail sending"));
            Session::flash('alert', 'danger');

        }
        return redirect()->back();
    }
    public function addnewsletter(Request $request){
		$email = $request->get("email");
        $getemail=Newsletter::where("email",$email)->first();
        if(empty($getemail)){
            $store=new Newsletter();
            $store->email=$email;
            $store->save();
        }
        return "done";
    }

    public function viewspecialist(){
       $setting=Setting::find(1);
       $department=Services::all();
       return view('user.viewspecialist')->with("department",$department)->with("setting",$setting);
    }





     public function rattinglinescal($id){
        $totalreview=count(Review::where("doc_id",$id)->get());
        if($totalreview!=0){
           $str5=0;
           $str4=0;
           $str3=0;
           $str2=0;
           $str1=0;
           $str5=count(Review::where("doc_id",$id)->where("rating",5)->get())*100/$totalreview;
           $str4=count(Review::where("doc_id",$id)->where("rating",4)->get())*100/$totalreview;
           $str3=count(Review::where("doc_id",$id)->where("rating",3)->get())*100/$totalreview;
           $str2=count(Review::where("doc_id",$id)->where("rating",2)->get())*100/$totalreview;
           $str1=count(Review::where("doc_id",$id)->where("rating",1)->get())*100/$totalreview;
           return array("start5"=>$str5,"start4"=>$str4,"start3"=>$str3,"start2"=>$str2,"start1"=>$str1);
        }else{
           return array("start5"=>0,"start4"=>0,"start3"=>0,"start2"=>0,"start1"=>0);
        }
     }



    public function viewdoctor($id){
        $data=Doctors::with('departmentls')->find($id);
        if($data){
            $data->reviewslist=Review::with('patientls')->where("doc_id",$data->id)->get();
            $data->avgratting=Review::where("doc_id",$data->id)->avg('rating');
            $data->totalreview=count(Review::where("doc_id",$data->id)->get());
            $data->startrattinglines=$this->rattinglinescal($data->id);
            if(!empty(Session::get("user_id"))&&Session::get('role_id')=='1'){
                    $lsfav=FavoriteDoc::where("doctor_id",$id)->where("user_id",Session::get("user_id"))->first();
                    if($lsfav){
                        $data->is_fav=1;
                    }else{
                        $data->is_fav=0;
                    }

                  }else{
                    $data->is_fav=0;
                  }
        }else{
			return redirect("/");
		}


        $day=date('N',strtotime(date("Y-m-d")))-1;
        $datasc=Schedule::with('getslotls')->where("doctor_id",$id)->where("day_id",$day)->get();
        $main=array();
        if(count($datasc)>0){
            foreach ($datasc as $k) {
                $slotlist=array();
                $slotlist['id']=$k->id;
                $slotlist['title']=$k->start_time." - ".$k->end_time;
                if(count($k->getslotls)>0){
                  foreach ($k->getslotls as $b) {
                      $ka=array();
                      $getappointment=BookAppointment::where("date",date("Y-m-d"))->where("slot_id",$b->id)->first();
                      $ka['id']=$b->id;
                      $ka['name']=$b->slot;
                      if($getappointment){
                          $ka['is_book']='1';
                      }else{
                          $ka['is_book']='0';
                      }
                      $slotlist['slottime'][]=$ka;

                  }
              }
              $main[]=$slotlist;

            }
        }

        $setting=Setting::find(1);
        $gateway = new \Braintree\Gateway([
                      'environment' => env('BRAINTREE_ENV'),
                      'merchantId'  => env('BRAINTREE_MERCHANT_ID'),
                      'publicKey'   => env('BRAINTREE_PUBLIC_KEY'),
                      'privateKey'  => env('BRAINTREE_PRIVATE_KEY')
                 ]);
        $token=$gateway->ClientToken()->generate();
        $date = $this->getsitedate();

        $arr = array();
         $data1 = PaymentGatewayDetail::all();
         foreach ($data1 as $k) {
            $arr[$k->gateway_name."_".$k->key] = $k->value;
         }

        $getdoctorhoilday = Doctor_Hoilday::where("start_date","<=",$date)->where("end_date",">=",$date)->where("doctor_id",$id)->first();
        return view("user.viewdoctor")->with("data",$data)->with("setting",$setting)->with("schedule",$main)->with("token",$token)->with("getdoctorhoilday",$getdoctorhoilday)->with("paymentdetail",$arr);
    }

    public function searchdoctor(Request $request){
        $setting=Setting::find(1);
        $services=Services::all();
        $term=$request->get("term");
        $type=$request->get("type");
        if(!empty($term)&&!empty($type)){//11
            $doctorslist=Doctors::with('departmentls')->where("department_id",$type)->Where('name', 'like', '%' . $term . '%')->where("is_approve","1")->paginate(10);
        }else if(!empty($term)&&empty($type)){//10
            $doctorslist=Doctors::with('departmentls')->where("is_approve","1")->Where('name', 'like', '%' . $term . '%')->paginate(10);
        }else if(empty($term)&&!empty($type)){//01
            $doctorslist=Doctors::with('departmentls')->where("is_approve","1")->where("department_id",$type)->paginate(10);
        }else{//00
            $doctorslist=Doctors::with('departmentls')->where("is_approve","1")->paginate(10);
        }

          if(!empty($term)&&!empty($type)){//11
            $doctorslistmap=Doctors::with('departmentls')->where("is_approve","1")->where("department_id",$type)->Where('name', 'like', '%' . $term . '%')->get();
        }else if(!empty($term)&&empty($type)){//10
            $doctorslistmap=Doctors::with('departmentls')->where("is_approve","1")->Where('name', 'like', '%' . $term . '%')->get();
        }else if(empty($term)&&!empty($type)){//01
            $doctorslistmap=Doctors::with('departmentls')->where("is_approve","1")->where("department_id",$type)->get();
        }else{//00
            $doctorslistmap=Doctors::with('departmentls')->where("is_approve","1")->get();
        }



        foreach ($doctorslist as $k) {
            $k->avgratting=Review::where('doc_id',$k->id)->avg('rating');
            $k->totalreview=count(Review::where('doc_id',$k->id)->get());
            if(!empty(Session::get("user_id"))&&Session::get('role_id')=='1'){
              $lsfav=FavoriteDoc::where("doctor_id",$k->id)->where("user_id",Session::get("user_id"))->first();
              if($lsfav){
                  $k->is_fav=1;
              }else{
                  $k->is_fav=0;
              }

            }else{
              $k->is_fav=0;
            }
        }

        return view("user.searchdoctor")->with("services",$services)->with("setting",$setting)->with("doctorlist",$doctorslist)->with("term",$term)->with("type",$type)->with("doctorslistmap",$doctorslistmap);
    }

    public function contactus(){
        $setting=Setting::find(1);
        return view("user.contactus")->with("setting",$setting);
    }

    public function privacy_policy(){
        $setting=Setting::find(1);
        return view("user.privacy_policy")->with("setting",$setting);
    }

    public function aboutus(){
        $setting=Setting::find(1);
        $data=About::find(1);
        return view("user.aboutus",compact('setting','data'));
    }

    public function patientlogin(){
        $setting=Setting::find(1);
        return view("user.patient.login")->with("setting",$setting);
    }

    public function patientregister(){
        $data['setting']=Setting::find(1);

        $patientRegNumber = FacadesSession::get('patient_reg_number');
        $timestamp = FacadesSession::get('patient_reg_number_timestamp');

        if ($patientRegNumber && (time() - $timestamp) <= 300) {
            $data['patient_reg_number'] = $patientRegNumber;
            $data['patient_reg_otp_verified'] = FacadesSession::get('patient_reg_otp_verified');
        } else {
            FacadesSession::forget('patient_reg_number');
            FacadesSession::forget('patient_reg_number_timestamp');
            FacadesSession::forget('patient_reg_otp_verified');
            $data['patient_reg_otp_verified'] = null;
            $data['patient_reg_number'] = null;
        }
        return view("user.patient.register")->with($data);
    }

    public function forgotpassword(){
       $setting=Setting::find(1);
       return view("user.patient.forgot")->with("setting",$setting);
    }

    public function doctorlogin(){

        FacadesSession::forget('doctor_reg_number');
        FacadesSession::forget('doctor_reg_number_timestamp');
         FacadesSession::forget('doctor_reg_otp_verified');
       $setting=Setting::find(1);
       return view("user.doctor.login")->with("setting",$setting);
    }

    public function doctorregister(){
       $data['setting'] = $setting =Setting::find(1);
       $doctorRegNumber = FacadesSession::get('doctor_reg_number');
       $timestamp = FacadesSession::get('doctor_reg_number_timestamp');

       if ($doctorRegNumber && (time() - $timestamp) <= 300) {
           $data['doctor_reg_otp_verified'] = FacadesSession::get('doctor_reg_otp_verified');
              $data['doctor_reg_number'] = $doctorRegNumber;
       } else {
           FacadesSession::forget('doctor_reg_number');
           FacadesSession::forget('doctor_reg_number_timestamp');
            FacadesSession::forget('doctor_reg_otp_verified');
           $data['doctor_reg_otp_verified'] = null;
           $data['doctor_reg_number'] = null;
       }

       return view("user.doctor.register")->with($data);
    }


    public function sendotp(Request $request){
        $base_url = config('app.base_url');
        $key = config('app.smkey');
        $count = config('app.count');
        $otp_code = random_int(1000, 9999);
        $sms = "Your OTP code is: ".$otp_code;
        $phone = $request->get('phone');

        if($request->get('type') == 'doctor'){
            FacadesSession::put('doctor_reg_number', $phone);
            FacadesSession::put('doctor_reg_otp', $otp_code);
            FacadesSession::put('doctor_reg_number_timestamp', time());
        }else{
            FacadesSession::put('patient_reg_number', $phone);
            FacadesSession::put('patient_reg_otp', $otp_code);
            FacadesSession::put('patient_reg_number_timestamp', time());
        }

        if($request->get('type') == 'forgot'){

            $patient=Patient::where("phone",$request->get("phone"))->first();
            $checkdoctor = Doctors::where("phoneno",$request->get("phone"))->first();

            if($patient){
                $add=new ResetPassword();
                $add->user_id=$patient->id;
                $add->code=$otp_code;
                $add->type=1;
                $add->save();
            }elseif($checkdoctor){
                $add=new ResetPassword();
                $add->user_id=$checkdoctor->id;
                $add->code=$otp_code;
                $add->type=2;
                $add->save();
            }else{
                return response()->json(['status' => 'error', 'message' => 'Phone number not found']);
            }

        }

        if (substr($phone, 0, 4) !== "+880") {
            $phone = "+880" . $phone;
        }

		$data = array(
		    "to" => $phone,
		    "token" => $key,
		    "message" => $sms
		);
        // return response()->json(['status' => 'success', 'message' => $otp_code, 'code' => $otp_code]);
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,$base_url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $smsresponse = curl_exec($curl);
            curl_close($curl);

            Log::info('SMS notification sended on phone #'.$phone);
            Log::info('SMS Response: '.$smsresponse);

            // return $smsresponse;
            return response()->json(['status' => 'success', 'message' => $smsresponse, 'code' => $otp_code]);
        } catch (\Throwable $th) {
            Log::error('SMS notification failed on phone #'.$phone);
            Log::error('SMS Response: '.$th->getMessage());
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function verifyotp(Request $request){
        $otp = $request->get('otp');
        $type = $request->get('type');
        $phone = $request->get('phone');
        if($type == 'doctor'){
            $ss_otp_code = FacadesSession::get('doctor_reg_otp');
            $ss_phone = FacadesSession::get('doctor_reg_number');
            if($phone == $ss_phone && $otp == $ss_otp_code){
                FacadesSession::put('doctor_reg_otp_verified', 1);
                return response()->json(['status' => 'success', 'message' => 'OTP verified successfully']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'OTP verification failed']);
            }
        }else{
            $ss_otp_code = FacadesSession::get('patient_reg_otp');
            $ss_phone = FacadesSession::get('patient_reg_number');
            if($phone == $ss_phone && $otp == $ss_otp_code){
                FacadesSession::put('patient_reg_otp_verified', 1);
                return response()->json(['status' => 'success', 'message' => 'OTP verified successfully']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'OTP verification failed']);
            }
        }


    }

    public function getslotlist(Request $request){
        $data=SlotTiming::where("schedule_id",$request->get("s_id"))->get();
        $date = $request->get("date");
        $getdoctorhoilday = Doctor_Hoilday::where("start_date","<=",$date)->where("end_date",">=",$date)->where("doctor_id",$request->get("doctor_id"))->first();
        if(empty($getdoctorhoilday)){
            foreach ($data as $k) {
                      $getappointment=BookAppointment::where("date",date("Y-m-d",strtotime($request->get("date"))))->where("slot_id",$k->id)->first();
                      if($getappointment){
                          $k->is_book='1';
                      }else{
                          $k->is_book='0';
                      }
            }
            return json_encode($data);
        }else{
            return 0;
        }

    }

    public function getschedule(Request $request){
      $day=date('N',strtotime($request->get("date")))-1;
      $datasc=Schedule::with('getslotls')->where("doctor_id",$request->get("doctor_id"))->where("day_id",$day)->get();
      return json_encode($datasc);
    }

    public function savecontact(Request $request){
        $store=new Contact();
        $store->name=$request->get("name");
        $store->email=$request->get("email");
        $store->phone=$request->get("phone");
        $store->subject=$request->get("subject");
        $store->message=$request->get("message");
        $store->save();
        Session::flash('message',__('message.Thank you for getting in touch!'));
        Session::flash('alert', 'danger');
        return redirect()->back();
    }

    public function privacy_front_app(){
        $data=About::find(1);
        $setting=Setting::find(1);
        return view('user.privacypolicy',compact('data','setting'));
    }

    public function accountdeletion(){
        $data=About::find(1);
        $setting=Setting::find(1);
        return view('user.accountdeletion',compact('data','setting'));
    }

    public function about(){
      $data=About::find(1);
      $setting=Setting::find(1);
      return view('admin.about',compact('data','setting'));
    }

    public function admin_privacy(){
      $data=About::find(1);
      $setting=Setting::find(1);
      return view('admin.terms',compact('data','setting'));
    }

    public function privacy_admin(){
      $data=About::find(1);
      $setting=Setting::find(1);
      return view('user.terms',compact('data','setting'));
    }

    public function app_privacy(){
      $data=About::find(1);
      $setting=Setting::find(1);
      return view('admin.privecy-app',compact('data','setting'));
    }

    public function data_deletion(){
      $data=About::find(1);
      $setting=Setting::find(1);
      return view('admin.data-deletion',compact('data','setting'));
    }

   public function edit_about(Request $request){
      $data=About::find(1);
       $setting=Setting::find(1);
       $data->about = $request->get('about');
       $data->save();
      return redirect('admin/about');
    }

    public function edit_terms(Request $request){
      $data=About::find(1);
      $setting=Setting::find(1);
      $data->trems = $request->get('trems');
       $data->save();
      return redirect('admin/Terms_condition');
    }

    public function edit_app_privacy(Request $request){
      $data=About::find(1);
      $setting=Setting::find(1);
      $data->privacy = $request->get('privacy');
       $data->save();
      return redirect('admin/app_privacy');
    }

    public function edit_data_deletion(Request $request){
      $data=About::find(1);
      $setting=Setting::find(1);
      $data->data_deletion = $request->get('data_deletion');
       $data->save();
      return redirect('admin/data_deletion');
    }
}
