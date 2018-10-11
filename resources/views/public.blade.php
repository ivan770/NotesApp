@extends('layouts.base')

@section('main')

        <div class="siimple-tabs siimple-tabs--boxed">
            <a href="/"><div class="siimple-tabs-item">Home</div></a>
            <div class="siimple-tabs-item siimple-tabs-item--selected">Public note</div>
        </div>

        <div class="siimple-grid">
            <div class="siimple-grid-row">
                <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                <div class="siimple-grid-col siimple-grid-col--6 siimple-grid-col--sm-12">
                @if($notes)
                    @foreach ($notes as $note)
                        <div class="siimple-card">
                            <div class="siimple-card-body">
                                <div class="siimple-card-title">{{ $note->title }}</div>
                                {!! nl2br(e($note->body)) !!}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="siimple-card">
                        <div class="siimple-card-body">
                            <div class="siimple-card-title">Note not found :(</div>
                            Make sure that you are trying to see public note
                        </div>
                    </div>
                @endif
                </div>
                <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
            </div>
        </div>
@endsection