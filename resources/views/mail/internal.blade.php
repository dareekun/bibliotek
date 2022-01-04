@component('mail::message')
Dear Mr. / Mrs {{$nama}},  {{-- use double space for line break --}}

We hereby remind the existence of a document {{$cat}}  
with document number {{$nodoc}}  
which will expire in the near future.  
Expired date {{$exp}}

@component('mail::button', ['url' => 'http://158.118.35.59:8000/detail/$link'])
View Document
@endcomponent
Thank You.  
  
<p style="color:red">{{$easter}}</p>
@endcomponent