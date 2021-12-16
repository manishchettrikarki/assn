<?php


namespace Modules\Executive\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Executive\Http\Requests\MembershipRequest;
use Modules\Executive\Jobs\SendMembershipRequest;

class MembershipController extends Controller
{
    public function __construct()
    {
    }

    public function showForm(){
        return view('executive::membership-form');
    }

    public function sendRegistrationRequest(MembershipRequest $request) {

        $requirements = [
            'option_1'=>'Has participated in at least one ASSN conference Plus Has participated in at least one course organized by ASSN or endorsed by ASSN',
            'option_2'=>'Has done fellowship of at least 3 months duration recognized by ASSN',
            'option_3'=>'Has done fellowship recommended by ASSN',
            'option_4'=>'Has participated in at least one ASSN conference or Has participated in at least One course organized by ASSN or endorsed by ASSN or Has presented paper in ASSN conference Plus Has done International course recognized by ASSN like AO Spine Principle course',
        ];

        $applicant = array();
        $applicant['criteria'] = $requirements[$request->q_1];
        $applicant['designation'] = $request->designation;
        $applicant['name'] = $request->full_name;
        $applicant['email'] = $request->email;
        $applicant['mobile'] = $request->mobile;
        $applicant['dob'] = $request->dob;
        $applicant['citizenship'] = $request->citizenship;
        $applicant['gender'] = $request->gender;
        $applicant['per_address'] = $request->per_address;
        $applicant['res_phone'] = $request->res_phone;
        $applicant['temp_address'] = $request->temp_address;
        $applicant['temp_phone'] = $request->temp_phone;
        $applicant['po_box'] = $request->po_box;
        $applicant['pro_address'] = $request->pro_address;
        $applicant['pro_contact'] = $request->pro_contact;
        $applicant['pro_po_box'] = $request->pro_po_box;
        $applicant['clinic'] = $request->clinic;
        $applicant['pro_phone'] = $request->pro_phone;
        $applicant['clinic_po_box'] = $request->clinic_po_box;
        $applicant['nmc'] = $request->nmc;
        $applicant['other_reg'] = $request->other_reg;
        $applicant['speciality'] = $request->speciality;
        $applicant['uni1_degree'] = $request->uni1_degree;
        $applicant['uni1_name'] = $request->uni1_name;
        $applicant['uni1_year'] = $request->uni1_year;
        $applicant['uni2_degree'] = $request->uni2_degree;
        $applicant['uni2_name'] = $request->uni2_name;
        $applicant['uni2_year'] = $request->uni2_year;
        $applicant['uni3_degree'] = $request->uni3_degree;
        $applicant['uni3_name'] = $request->uni3_name;
        $applicant['uni3_year'] = $request->uni3_year;
        $applicant['sponsor'] = $request->sponsor;

        $tempFolder = uniqid();
        Storage::disk('temp')->makeDirectory($tempFolder,0777);

        if($request->hasFile('pp_image')) {
            $photoFilename = 'photo.' . $request->file('pp_image')->getClientOriginalExtension();
            Storage::disk('temp')->putFileAs($tempFolder, $request->file('pp_image'), $photoFilename);
            $applicant['photo'] = $photoFilename;
        } else {
            $applicant['photo'] = false;
        }

        if($request->hasFile('signature')){
            $otherFilename = 'other.'.$request->file('signature')->getClientOriginalExtension();
            Storage::disk('temp')->putFileAs($tempFolder,$request->file('signature'),$otherFilename);
            $applicant['signature'] = $otherFilename;
        } else {
            $applicant['signature'] = false;
        }
        $applicant['folder'] = $tempFolder;


        dispatch(new SendMembershipRequest($applicant));


        return redirect()->route('membership.form')
            ->with('success','Your form has been received.');

    }
}
