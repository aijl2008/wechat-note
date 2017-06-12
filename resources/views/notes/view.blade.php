@extends('notes::layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <article>
                <h3 class="post-meta">
                    <form method="POST" action="{!! route('notes.note.destroy', $note->id) !!}"
                          accept-charset="UTF-8">
                        @if (Auth::check())
                            {{ csrf_field() }}
                            <input name="_method" value="DELETE" type="hidden">
                            <a href="{!! route('notes.note.edit', $note->id) !!}"> <span
                                        class="glyphicon glyphicon-edit"></span></a>
                            <a href="###"><span
                                        class="glyphicon glyphicon-trash"></span></a>
                        @endif
                        <span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}
                    </form>
                </h3>
                @if ($note->content) {!! nl2br($note->content)  !!}@endif
                @if ($note->image)<img src="/image/note/{{ $note->id }}" class="img-responsive"/>@endif
                <hr>
            </article>
        </div>
    </div>
@endsection