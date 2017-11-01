@NOT USED
<p class="text-danger"><strong>Be careful with group selection, if you give admin access.. they can access admin section</strong></p>
<div class="form-group {{ $errors->first('group', 'has-error') }}">
    <label for="group" class="col-sm-2 control-label">Group *</label>
    <div class="col-sm-10">
        <select class="form-control " title="Select group..." name="groups[]" id="groups" required>
            <option value="">Select</option>
            @foreach($roles as $role)
                <option value="{!! $role->id !!}" {{ (array_key_exists($role->id, $userRoles) ? ' selected="selected"' : '') }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div
    {!! $errors->first('group', '<span class="help-block">:message</span>') !!}>
</div>

<div class="form-group">
    <label for="activate" class="col-sm-2 control-label"> Activate User</label>
    <div class="col-sm-10">
        <input id="activate" name="activate" type="checkbox" class="pos-rel p-l-30 custom-checkbox" value="1" @if($status) checked="checked" @endif  >
        <span>To activate your account click the check box</span>
    </div>
</div>
