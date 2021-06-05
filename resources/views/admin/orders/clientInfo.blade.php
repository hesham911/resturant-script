@if ($client != null)
{{-- <select class="btn btn-danger" name="client_phone" id="orderClientPhone">
    <option value="">اختر الهاتف</option>
    @foreach ($client->user->phones->pluck('number') as $phone)
        <option  value="{{$phone}}" {{(old('client_phone')==$phone)? 'selected':''}}>
            {{$phone}} </option>
    @endforeach
</select> --}}
<input value="{{$client->client->id}}" name="client_id" hidden>
<input value="{{$client->name}}" readonly id="orderClientPhone" class="btn btn-danger">
<select class="btn btn-danger" name="client_zone" id="orderClientZone">
    <option value="">اختر العنوان</option>
    @foreach ($client->client->zones as $zone)
    <option  value="{{$zone->name}} - {{$zone->pivot->address}}">
        {{$zone->name}}-{{$zone->pivot->address}} </option>
    @endforeach
</select>
@endif
