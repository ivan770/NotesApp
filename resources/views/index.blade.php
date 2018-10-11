@extends('layouts.base')

@section('main')

        @if($auth)

        <script src="{{ asset('js/notes.js') }}"></script>

        @endif

        <div class="siimple-tabs siimple-tabs--boxed">
            <a href="/"><div class="siimple-tabs-item siimple-tabs-item--selected">Home</div></a>
            <a href="/account"><div class="siimple-tabs-item">{{ $username }}</div></a>
        </div>

        <div class="siimple-grid">
            <div class="siimple-grid-row">
                <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                <div class="siimple-grid-col siimple-grid-col--6 siimple-grid-col--sm-12" id="main">
                @if($auth)
                    <form action="/new" method="POST" id="new-form">
                    @csrf
                        <div class="siimple-card">
                            <div class="siimple-card-body">
                                <div class="siimple-form">
                                    <div class="siimple-form-field">
                                        <div class="siimple-form-field-label">Title</div>
                                        <input type="text" class="siimple-input siimple-input--fluid" name="title" id="title">
                                        <div class="siimple-field-helper">Max: 256</div>
                                    </div>
                                    <div class="siimple-form-field">
                                        <div class="siimple-form-field-label">Body</div>
                                        <textarea class="siimple-textarea siimple-textarea--fluid" name="body" id="body"></textarea>
                                        <div class="siimple-field-helper">Max: 5000</div>
                                    </div>
                                    <div class="siimple-form-field">
                                        <label class="siimple-label">Public note:
                                        <div class="siimple-switch">
                                            <input type="checkbox" id="public">
                                            <label for="public"></label>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="siimple-form-field">
                                        <div class="siimple-btn siimple-btn--primary" onclick="newNote(document.getElementById('title').value, document.getElementById('body').value, document.getElementById('public').checked)">Create</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        var tx = document.getElementsByTagName('textarea');
                        for (var i = 0; i < tx.length; i++) {
                            tx[i].setAttribute('style', 'height:' + (tx[i].scrollHeight) + 'px;overflow-y:hidden;resize:none;');
                            tx[i].addEventListener("input", OnInput, false);
                        }

                        function OnInput() {
                            this.style.height = 'auto';
                            this.style.height = (this.scrollHeight) + 'px';
                        }
                    </script>
                    <div class="siimple-alert siimple-alert--error" id="offline" style="display: none">
                        <div class="siimple-alert-title">Connection error</div>
                        Internet connection is missing.
                    </div>
                    <div class="siimple-card" style="display: none" id="loader">
                        <div class="siimple-card-body">
                            <div class="siimple-spinner siimple-spinner--primary"></div>
                        </div>
                    </div>
                    <div id="cards"></div>
                @else
                    <div class="siimple-card">
                        <div class="siimple-card-body">
                            <div class="siimple-card-title">Welcome to NotesApp</div>
                            Start creating notes by logging in or registering at 'Account' section.
                        </div>
                    </div>
                @endif
                </div>
                <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
            </div>
        </div>

        @if($auth)
        <script src="{{ asset('js/check.js') }}"></script>
        <script>getNote()</script>
        @endif
@endsection