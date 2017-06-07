<div class="form-group {{ $errors->has('openid') ? 'has-error' : '' }}">
    <label for="openid" class="col-md-2 control-label">Openid</label>
    <div class="col-md-10">
        <input class="form-control" name="openid" type="text" id="openid"
               value="{{ old('openid', isset($note->openid) ? $note->openid : null) }}">
        {!! $errors->first('openid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
    <label for="nickname" class="col-md-2 control-label">Nickname</label>
    <div class="col-md-10">
        <input class="form-control" name="nickname" type="text" id="nickname"
               value="{{ old('nickname', isset($note->nickname) ? $note->nickname : null) }}">
        {!! $errors->first('nickname', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label for="content" class="col-md-2 control-label">Content</label>
    <div class="col-md-10">
        <textarea rows="10" class="form-control" name="content" type="text" id="content"
        >{{ old('content', isset($note->content) ? $note->content : null) }}</textarea>
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
    <label for="image" class="col-md-2 control-label">Image</label>
    <div class="col-md-10">
        <input type="file" name="photo"/>
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        @if (isset($note->image))<img src="/image/note/{{ $note->id }}" class="img-responsive"/>@endif
    </div>
</div>

