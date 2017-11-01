@NOT USED
<div class="form-group {{ $errors->first('dob', 'has-error') }}">
    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
    <div class="col-sm-10">
        <input id="dob" name="dob" type="text" class="form-control"
               data-date-format="YYYY-MM-DD" value="{!! old('dob', $user->dob) !!}"
               placeholder="yyyy-mm-dd"/>
    </div>
    {!! $errors->first('dob', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
    <label for="pic" class="col-sm-2 control-label">Profile picture</label>
    <div class="col-sm-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                @if($user->pic)
                    <img src="{!! url('/').'/uploads/users/'.$user->pic !!}" alt="profile pic">
                @else
                    <img src="http://placehold.it/200x200" alt="profile pic">
                @endif
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail"
                 style="max-width: 200px; max-height: 200px;"></div>
            <div>
                <span class="btn btn-default btn-file">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input id="pic" name="pic_file" type="file"
                           class="form-control"/>
                </span>
                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"
                   style="color: black !important;">Remove</a>
            </div>
        </div>
        {!! $errors->first('pic_file', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group  {{ $errors->first('pic', 'has-error') }}">
    <label for="bio" class="col-sm-2 control-label">Bio
        <small>(brief intro)</small>
    </label>
    <div class="col-sm-10">
                                                    <textarea name="bio" id="bio" class="form-control resize_vertical"
                                                              rows="4">{!! old('bio', $user->bio) !!}</textarea>
    </div>
    {!! $errors->first('bio', '<span class="help-block">:message</span>') !!}
</div>