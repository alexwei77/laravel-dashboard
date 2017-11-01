<!doctype html>
<html lang="en">
   <head>
     
   </head>
   <body>
     
        <p> Hi {{ $request->first_name }}</p>
        <p> This is to notify you that {{ $user->companyname }} invited you to be one of their admins on StaffLife.</p>
        <p>Please click the link below to accept the invitation. </p>
        <a target="_blank" href="{{ url('/') .'/register/' .$request->first_name .'/' .$request->last_name .'/' .$request->email }}">{{ url('/') }}</a>
   </body>
</html>