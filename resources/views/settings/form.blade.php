<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
               value="{{ old('name', isset($setting->name) ? $setting->name : null) }}" required="true">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
    <label for="logo" class="col-md-2 control-label">Logo</label>
    <div class="col-md-10">
        <input type="file" name="photo"/>
        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
        @if (isset($setting->logo))<img src="/image/setting/{{ $setting->id }}" class="img-responsive"/>@endif
    </div>
</div>

