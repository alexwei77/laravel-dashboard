@NOT USED
<div class="form-group {{ $errors->first('gender', 'has-error') }}">
    <label for="email" class="col-sm-2 control-label">Gender </label>
    <div class="col-sm-10">
        <select class="form-control" title="Select Gender..." name="gender">
            <option value="">Select</option>
            <option value="male" @if($user->gender === 'male') selected="selected" @endif >MALE</option>
            <option value="female" @if($user->gender === 'female') selected="selected" @endif >FEMALE</option>
            <option value="other" @if($user->gender === 'other') selected="selected" @endif >OTHER</option>

        </select>
    </div>
    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group required {{ $errors->first('country', 'has-error') }}">
    <label for="country" class="col-sm-2 control-label">Country </label>
    <div class="col-sm-10">
        {!! Form::select('country', $countries,old('country',$user->country),array('class' => 'form-control')) !!}

    </div>
    {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('state', 'has-error') }}">
    <label for="state" class="col-sm-2 control-label">State </label>
    <div class="col-sm-10">
        <input id="state" name="state" type="text" class="form-control"
               value="{!! old('state', $user->state) !!}"/>
    </div>
    {!! $errors->first('state', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('city', 'has-error') }}">
    <label for="city" class="col-sm-2 control-label">City </label>
    <div class="col-sm-10">
        <input id="city" name="city" type="text" class="form-control"
               value="{!! old('city', $user->city) !!}"/>
    </div>
    {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('address', 'has-error') }}">
    <label for="address" class="col-sm-2 control-label">Address </label>
    <div class="col-sm-10">
        <input id="address" name="address" type="text" class="form-control"
               value="{!! old('address', $user->address) !!}"/>
    </div>
    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('postal', 'has-error') }}">
    <label for="postal" class="col-sm-2 control-label">Postal/zip</label>
    <div class="col-sm-10">
        <input id="postal" name="postal" type="text" class="form-control"
               value="{!! old('postal', $user->postal) !!}"/>
    </div>
    {!! $errors->first('postal', '<span class="help-block">:message</span>') !!}
</div>