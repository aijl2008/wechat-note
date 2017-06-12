@extends('notes::layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            @foreach ($notes as $note)
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
                    @if ($note->abstract) {!! nl2br($note->abstract)  !!}@endif
                    @if ($note->image)<img src="/image/note/{{ $note->id }}" class="img-responsive"/>@endif
                    <hr>
                </article>
            @endforeach
            <ul class="pager">
                @if ($notes->currentPage() > 1)
                    <li class="previous">
                        <a href="{!! $notes->url($notes->currentPage() - 1) !!}">
                            <i class="fa fa-angle-left fa-lg"></i>
                            Previous
                        </a>
                    </li>
                @endif
                @if ($notes->hasMorePages())
                    <li class="next">
                        <a href="{!! $notes->nextPageUrl() !!}">
                            Next
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <script type="application/javascript">
        $(function () {
            $(".glyphicon-trash").click(function () {
                if (confirm("confirm delete?")) {
                    $(this).parent().parent().submit();
                }
            });
        });
    </script>
@endsection