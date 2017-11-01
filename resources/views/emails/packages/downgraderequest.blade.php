<!doctype html>
<html lang="en">
   <head>
     
   </head>
   <body>
     
        <p> Hi {{ $data->first_name ." " .$data->last_name }} </p>
        <p> This is to notify you that that you can now downgrade to your requested package since your previous one has expired.</p>
        <p> Details of package request: </p>
        <p> Package Name: {{ $data->name }}</p>
        <p> Price: {{ $data->price }}</p>
        <p> Employee Forms Limit: {{ $data->terms_forms }}</p>
        <p> Support: {{ $data->support }}</p>
        <p> Admins Limit: {{ $data->admins }}</p>

        <p> Click the link below to downgrade: </p>
        <a target="_blank" href="{{ url('/') .'/upgrade-downgrade' }}">{{ url('/') .'/upgrade-downgrade' }}</a>
   </body>
</html>