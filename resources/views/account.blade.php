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
                        <div class="siimple-form">
                            <div class="siimple-form-title">Account info</div>
                            <div class="siimple-form-field">
                                <div class="siimple-form-field-label">Username</div>
                                <input type="text" class="siimple-input siimple-input--fluid" value="{{ $username }}" disabled>
                            </div>
                            <div class="siimple-form-field">
                                <div class="siimple-form-field-label">E-mail</div>
                                <input type="text" class="siimple-input siimple-input--fluid" value="{{ $email }}" disabled>
                            </div>
                            <div class="siimple-form-field">
                                <form action="/logout" method="POST" id="logout-form">
                                @csrf
                                    <div class="siimple-btn siimple-btn--primary" onclick="document.getElementById('logout-form').submit()">Log out</div>
                                    <a href="/settings"><div class="siimple-btn siimple-btn--light">Settings</div></a>
                                </form>
                            </div>
                        </div>
                        <div class="siimple-table">
                            <div class="siimple-table-header">
                                <div class="siimple-table-row">
                                    <div class="siimple-table-cell">IP</div>
                                    <div class="siimple-table-cell">Date (GMT)</div>
                                </div>
                            </div>
                            <div class="siimple-table-body">
                                @foreach ($ips as $ip)
                                    <div class="siimple-table-row">
                                        <div class="siimple-table-cell">{{ $ip->ip }}</div>
                                        <div class="siimple-table-cell">{{ $ip->time }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-hide"></div>
                </div>
            </div>
@endsection