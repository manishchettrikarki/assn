<?php


  namespace App\Http\Controllers;
  use Illuminate\Http\Request;
  use App\Jobs\SendContactMail;
  use Illuminate\Routing\Controller;
  use App\Http\Request\ContactMailRequest;

  class ContactController extends Controller
  {
    public function __construct()
    {
    }

    public function contact()
    {
      return view(' contact');
    }

    public function sendContactMail(ContactMailRequest $request)
    {
      $name = $request->name;
      $address = $request->address;
      $mail = $request->email;
      $phone = $request->phone;
      $message = $request->message;
      $callMe = ($request->has('callme'))?true:false;
      dispatch((new SendContactMail($name, $mail, $message, $callMe, $address, $phone))->delay(now()->addMinute()));
      return redirect()
        ->back()
        ->with('success','Your message has been received');
    }
  }
