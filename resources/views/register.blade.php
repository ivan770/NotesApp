@extends('layouts.base')

@section('main')

        <div class="siimple-tabs siimple-tabs--boxed">
            <a href="/"><div class="siimple-tabs-item">Home</div></a>
            <a href="/account"><div class="siimple-tabs-item siimple-tabs-item--selected">Account</div></a>
        </div>

        <form action="/register" method="POST" id="register-form">
        @csrf

            <div class="siimple-grid">
                <div class="siimple-grid-row">
                    <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                    <div class="siimple-grid-col siimple-grid-col--6 siimple-grid-col--sm-12">
                        @isset($error)
                            <div class="siimple-tip siimple-tip--error">
                                Incorrect account details.
                            </div>
                        @endisset

                        <div class="siimple-form">
                            <div class="siimple-form-title">Create new account</div>
                            <div class="siimple-form-detail">Account required to use NotesApp services</div>
                            <div class="siimple-form-field">
                                <div class="siimple-form-field-label">Username</div>
                                <input type="text" class="siimple-input siimple-input--fluid" name="username">
                            </div>
                            <div class="siimple-form-field">
                                <div class="siimple-form-field-label">Password</div>
                                <input type="password" class="siimple-input siimple-input--fluid" name="password">
                            </div>
                            <div class="siimple-form-field">
                                <div class="siimple-form-field-label">E-mail</div>
                                <input type="email" class="siimple-input siimple-input--fluid" name="email">
                            </div>
                            <div class="siimple-form-field">
                                <div class="siimple-btn siimple-btn--primary" onclick="document.getElementById('register-form').submit()">Register</div>
                            </div>
                        </div>
                    </div>
                    <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                </div>
            </div>

        </form>

@endsection