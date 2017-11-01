@if (empty($countries) || empty($regions))
    @php
        $regions = $countries = [];
        foreach (\Countries::all() as $country) {
            $countries[] = [
                'name' => $country->name->common,
                'cca2' => $country->cca2,
                'region' => $country->region,
                'cca3' => $country->cca3,
            ];
            $regions[$country->region ? $country->region : 'Other'] = true;
        }
    @endphp
@endif

<select id="country" name="country" class="form-control">
    <option></option>
    @foreach ($regions as $region)
        <optgroup label="{{ $region }}">
            @foreach ($countries as $key => $val)
                @if ($val['region'] == $region)
                    <option
                            value="{!! $val['cca2'] !!}"
                            {{ in_array(old('country', $user['country']), [$val['cca2'], $val['cca3']]) ? 'selected' : null}}
                    >{{ $val['name'] }}</option>
                @endif
            @endforeach
        </optgroup>
    @endforeach
</select>
