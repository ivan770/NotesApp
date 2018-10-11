@extends('layouts.base')

@section('main')

        <div class="siimple-tabs siimple-tabs--boxed">
            <a href="/"><div class="siimple-tabs-item">Home</div></a>
            <a href="/account"><div class="siimple-tabs-item siimple-tabs-item--selected">{{ $username }}</div></a>
        </div>

            <div class="siimple-grid">
                <div class="siimple-grid-row">
                    <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                    <div class="siimple-grid-col siimple-grid-col--6 siimple-grid-col--sm-12">
                        <form action="/edit" method="POST" id="edit-form">
                            <input type="hidden" value="{{ $id }}" name="id">
                            @csrf
                            <div class="siimple-form">
                                <div class="siimple-form-field">
                                    <div class="siimple-form-field-label">Body</div>
                                    <textarea class="siimple-textarea siimple-textarea--fluid" name="body" id="body">{{ $note }}</textarea>
                                    <div class="siimple-field-helper">Max: 5000</div>
                                </div>
                                <div class="siimple-form-field">
                                    <div class="siimple-btn siimple-btn--primary" onclick="document.getElementById('edit-form').submit()">Save</div>
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
                    </div>
                    <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                </div>
            </div>
@endsection