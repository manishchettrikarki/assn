<?php


namespace Modules\Executive\Http\Controllers;


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

        $applicant = array();
        $applicant['title'] = $request->title;
        $applicant['name'] = $request->name;
        $applicant['country'] = $request->country;
        $applicant['state'] = $request->state;
        $applicant['city'] = $request->city;
        $applicant['pincode'] = $request->pinCode;
        $applicant['email'] = $request->email;
        $applicant['mobile'] = $request->mobile;
        $applicant['landline'] = $request->landline;
        $applicant['clinic'] = $request->clinic;
        $applicant['gender'] = $request->gender;
        $applicant['dob'] = $request->dob;

        $tempFolder = uniqid();
        Storage::disk('temp')->makeDirectory($tempFolder,0777);
        $photoFilename = 'photo.'.$request->file('photo')->getClientOriginalExtension();
        Storage::disk('temp')->putFileAs($tempFolder,$request->file('photo'),$photoFilename);
        $applicant['photo'] = $photoFilename;

        $mbbsFilename = 'mbbs.'.$request->file('mbbs')->getClientOriginalExtension();
        Storage::disk('temp')->putFileAs($tempFolder,$request->file('mbbs'),$mbbsFilename);
        $applicant['mbbs'] = $mbbsFilename;

        $orthoFilename = 'ortho.'.$request->file('ortho')->getClientOriginalExtension();
        Storage::disk('temp')->putFileAs($tempFolder,$request->file('ortho'),$orthoFilename);
        $applicant['ortho'] = $orthoFilename;

        if($request->hasFile('other')){
            $otherFilename = 'other.'.$request->file('other')->getClientOriginalExtension();
            Storage::disk('temp')->putFileAs($tempFolder,$request->file('other'),$otherFilename);
            $applicant['other'] = $otherFilename;
        } else {
            $applicant['other'] = false;
        }
        $applicant['folder'] = $tempFolder;

        dispatch(new SendMembershipRequest($applicant));

        return redirect()->route('membership.form')
            ->with('success','Your form has been received.');

    }
}
