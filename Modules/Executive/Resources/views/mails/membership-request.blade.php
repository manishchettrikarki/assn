@component('mail::message')
  # New Membership Request

  Your have new membership request from {{ $applicant['name'] }}!

  @component('mail::panel')
    <strong style="text-align: center">{{ $applicant['criteria'] }}</strong><br>

  @endcomponent

  @component('mail::panel')
    <strong style="text-align: center">Personal Information</strong><br>
    Name: {{ $applicant['name'] }} <br>
    Email: {{ $applicant['email'] }}<br>
    Mobile: {{ $applicant['mobile'] }}<br>
    DOB: {{ $applicant['dob'] }}<br>
    Citizenship: {{ $applicant['citizenship'] }}<br>
    Gender: {{ ucfirst($applicant['gender']) }}<br>
  @endcomponent

  @component('mail::panel')
    <strong style="text-align: center">Address</strong><br>
    Permanent Address: {{ $applicant['per_address'] }} <br>
    Phone: {{ $applicant['res_phone'] }}<br><br>
    Temporary Address: {{ $applicant['temp_address'] }}<br>
    Phone: {{ $applicant['temp_phone'] }}<br>
    P.O. Box: {{ $applicant['po_box'] }}<br><br>
    Office/Hospital: {{ $applicant['pro_address'] }}<br>
    Contact: {{ $applicant['pro_contact'] }}<br>
    P.O. Box: {{ $applicant['pro_po_box'] }}<br><br>
    Clinic: {{ $applicant['clinic'] }}<br>
    Phone: {{ $applicant['pro_phone'] }}<br>
    P.O. Box: {{ $applicant['clinic_po_box'] }}<br><br>
  @endcomponent

  @component('mail::panel')
    <strong style="text-align: center">Professional Details</strong><br>
    NMC Number: {{ $applicant['nmc'] }} <br>
    Other Reg. No: {{ $applicant['other_reg'] }}<br>
    Speciality: {{ $applicant['speciality'] }}<br><br>
    Degree: {{ $applicant['uni1_degree'] }}<br>
    University: {{ $applicant['uni1_name'] }}<br>
    Year: {{ $applicant['uni1_year'] }}<br><br>
    Degree: {{ $applicant['uni2_degree'] }}<br>
    University: {{ $applicant['uni2_name'] }}<br>
    Year: {{ $applicant['uni2_year'] }}<br><br>
    Degree: {{ $applicant['uni3_degree'] }}<br>
    University: {{ $applicant['uni3_name'] }}<br>
    Year: {{ $applicant['uni3_year'] }}<br><br>
  @endcomponent
  @if(isset($applicant['sponsor']))
  @component('mail::panel')
    <strong style="text-align: center">Sponsored By: {{ $applicant['sponsor'] }}</strong><br>
  @endcomponent
  @endif


  Thanks,<br>
  {{ site('name') }}
@endcomponent