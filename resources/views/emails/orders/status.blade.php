@component('mail::message')
# Order Status
Order Code : <b>{{$data['oc']}} </b>
Your Order Status is now <b>{{$data['status']}}</b>

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks for Ordering,<br>
{{ config('app.name') }}
@endcomponent
\
