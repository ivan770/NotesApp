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
                        <form action="/settings" method="POST" id="settings-form">
                        @csrf
                            <div class="siimple-form">
                                <div class="siimple-form-title">Change account info</div>
                                <div class="siimple-form-field">
                                    <div class="siimple-form-field-label">E-mail</div>
                                    <input type="text" class="siimple-input siimple-input--fluid" placeholder="{{ $email }}" name="email">
                                </div>
                                <div class="siimple-form-field">
                                    <div class="siimple-btn siimple-btn--primary" onclick="document.getElementById('settings-form').submit()">Apply</div>
                                </div>
                            </div>
                        </form>
                        <form action="/password" method="POST" id="password-form">
                        @csrf
                            <div class="siimple-form">
                                <div class="siimple-form-title">Change password</div>
                                <div class="siimple-form-field">
                                    <div class="siimple-form-field-label">Old password</div>
                                    <input type="password" class="siimple-input siimple-input--fluid" name="oldpass">
                                </div>
                                <div class="siimple-form-field">
                                    <div class="siimple-form-field-label">New password</div>
                                    <input type="password" class="siimple-input siimple-input--fluid" name="newpass">
                                </div>
                                <div class="siimple-form-field">
                                    <div class="siimple-btn siimple-btn--primary" onclick="document.getElementById('password-form').submit()">Apply</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                </div>
            </div>
@endsection