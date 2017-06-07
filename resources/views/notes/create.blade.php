@extends('notes::layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <div class="panel panel-default">

                <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Note</h4>
            </span>

                    <div class="btn-group btn-group-sm pull-right" role="group">
                        <a href="{{ route('notes.note.index') }}" class="btn btn-primary" title="Show all notes">
                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        </a>
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

                    <form method="POST" enctype="multipart/form-data" action="{{ route('notes.note.store') }}"
                          accept-charset="UTF-8" class="form-horizontal">
                        {{ csrf_field() }}
                        @include ('notes::notes.form')

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <input class="btn btn-primary" type="submit" value="Add">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection


