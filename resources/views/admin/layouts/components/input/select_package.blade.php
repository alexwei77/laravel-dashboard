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

<select name="package" class="form-control">
    <option></option>
    @foreach ($packages as $package_option)
                <option
                        value="{!! $package_option->id !!}"
                        {{ $package->id == $package_option->id ? 'selected' : null}}
                >{{ $package_option->name }}</option>
    @endforeach
</select>
