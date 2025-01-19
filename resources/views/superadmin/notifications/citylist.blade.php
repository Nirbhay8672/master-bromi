<option value="">Selecte City</option>
@foreach ($cities as $city)
    <option value="{{ $city->id }}">{{ $city->name }}</option>
@endforeach