<!doctype html>
<html lang="en">
   <head>
     
   </head>
   <body>
     
        <p> Hi {{ $employee_name }} </p>
        <p> Your latest ratings are as follows: <br /><br /> </p>
        @foreach ($companies as $company)
            <p> Company: {{ $company }}</p>
            @foreach ($reviewers[$company] as $reviewer )
                <p> Reviewer: {{ $reviewer }}</p>
                <p> Reviews: 
                @foreach ($reviews[$reviewer] as $review)
                    {{$review}} <br />
                @endforeach
                </p>
            @endforeach        
        @endforeach
   </body>
</html>