@NOT USED
<div class="form-group {{ $errors->first('first_name', 'has-error') }}">
    <label for="first_name" class="col-sm-2 control-label">First Name *</label>
    <div class="col-sm-10">
        <input id="first_name" name="first_name" type="text"
               placeholder="First Name" class="form-control required"
               value="{!! old('first_name', $user->first_name) !!}"/>
    </div>
    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('last_name', 'has-error') }}">
    <label for="last_name" class="col-sm-2 control-label">Last Name *</label>
    <div class="col-sm-10">
        <input id="last_name" name="last_name" type="text" placeholder="Last Name"
               class="form-control required"
               value="{!! old('last_name', $user->last_name) !!}"/>
    </div>
    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('email', 'has-error') }}">
    <label for="email" class="col-sm-2 control-label">Email *</label>
    <div class="col-sm-10">
        <input id="email" name="email" placeholder="E-Mail" type="text"
               class="form-control required email"
               value="{!! old('email', $user->email) !!}"/>
    </div>
    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('password', 'has-error') }}">
    <p class="text-warning">If you don't want to change password... please leave them empty</p>
    <label for="password" class="col-sm-2 control-label">Password </label>
    <div class="col-sm-10">
        <input id="password" name="password" type="password" placeholder="Password"
               class="form-control" value="{!! old('password') !!}"/>
    </div>
    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
    <label for="password_confirm" class="col-sm-2 control-label">Confirm Password </label>
    <div class="col-sm-10">
        <input id="password_confirm" name="password_confirm" type="password"
               placeholder="Confirm Password " class="form-control"
               value="{!! old('password_confirm') !!}"/>
    </div>
    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
</div>
