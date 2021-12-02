<?php


  namespace Modules\Executive\Http\Controllers;


  use Illuminate\Routing\Controller;
  use Modules\Executive\Repositories\Contracts\MemberContract;

  class MemberController extends Controller
  {
    public $memberContract;
    public function __construct(MemberContract $memberContract)
    {
      $this->memberContract = $memberContract;
    }

    public function members(){
      $members = $this->memberContract->paginate();
      return view('executive::members',compact('members'));
    }
  }
