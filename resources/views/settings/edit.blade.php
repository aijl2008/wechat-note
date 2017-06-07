@extends('notes::layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">

                <div class="panel-heading clearfix">

                    <div class="pull-left">
                        <h4 class="mt-5 mb-5">{{ !empty($setting->name) ? $setting->name : 'setting' }}</h4>
                    </div>

                </div>

                <div class="panel-body">

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" enctype="multipart/form-data"
                          action="{{ route('settings.setting.update') }}"
                          accept-charset="UTF-8" class="form-horizontal">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        @include ('notes::settings.form', [
                                                    'setting' => $setting,
                                                  ])

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection