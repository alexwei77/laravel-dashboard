<!doctype html>
<html lang="en">
   <head>
     
   </head>
   <body>
     
        <p> Hi there </p>
        <p> This is to notify you that {{ $user->companyname }} has requested to view your profile on StaffLife.</p>
        <p>Regards</p>
        <p>StaffLife Team</p>
         @if($employeeDetails->status == 0)
        <!--<p>Do you want to see how the companies that you worked for scored you on StaffLife? click the link below to signup. </p>
        <a target="_blank" href="{{ url('/') .'/register' }}">{{ url('/') .'/register' }}</a>-->
         @endif
   </body>
</html>