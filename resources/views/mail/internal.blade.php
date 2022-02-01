<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h3>Dear Mr. / Mrs {{$nama}}</h3>

    We hereby remind the existence of a document {{$cat}}  
    <br>with document number <b style="color:red">@if ($nodoc == '') No Document ID! @else {{$nodoc}} @endif</b>
    <br>(Please Check The Attachment Below)
    <br>which will expire in the near future. 
    <br>Expired date <b style="color:red">{{$exp}} </b>
    <br>
    <br>Thank You.
    <br>Bibliotek Teams.
    <p style="color:red">{{$easter}}</p>
    
</body>
</html>



 
 
 
 
  
  
  
