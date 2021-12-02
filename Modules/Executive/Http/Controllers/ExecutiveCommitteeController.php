<?php


  namespace Modules\Executive\Http\Controllers;


  use Illuminate\Routing\Controller;
  use Modules\Executive\Repositories\Contracts\ExecutiveMemberContract;
  use Modules\Executive\Repositories\Contracts\RegionalCoordinatorContract;

  class ExecutiveCommitteeController extends Controller
  {
    public $executiveContract, $coordinatorContract;
    public function __construct(ExecutiveMemberContract $executiveContract, RegionalCoordinatorContract $coordinatorContract)
    {
      $this->executiveContract = $executiveContract;
      $this->coordinatorContract = $coordinatorContract;
    }

    public function executives()
    {
      $executives = $this->executiveContract->all();
      $president = $executives->where('member_type','executive')->where('designation','President')->first();
      $vicePresidents =  $executives->where('member_type','executive')->where('designation','Vice-President');
      $immPastPresident = $executives->where('member_type','executive')->where('designation','Imm. Past President');
      $generalSecretaries =  $executives->where('member_type','executive')->where('designation','General Secretary');
      $treasurers =  $executives->where('member_type','executive')->where('designation','Treasurer');
      $jointSecretary = $executives->where('member_type','executive')->where('designation','Joint Secretary');
      $executiveMembers =  $executives->where('member_type','executive')->where('designation','Member');

      $sciChairman = $executives->where('member_type','scientific')->where('designation','Chairman')->first();
      $sciMembers = $executives->where('member_type','scientific')->where('designation','Member');

      $coordinators = $this->coordinatorContract->all();

      return view('executive::executives',compact(
        'president',
        'vicePresidents',
        'immPastPresident',
        'generalSecretaries',
        'treasurers',
        'jointSecretary',
        'executiveMembers',
        'sciChairman',
        'sciMembers',
        'coordinators'
      ));
    }
  }
