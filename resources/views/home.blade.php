@extends('layouts.app')

@section('content')
    @if(isset($success))
        <div class="card {{ $success ? 'success' : 'failed' }}">
            {!! $message !!}
        </div>
    @endif
    <div class="two-col-grid">
        <div class="card">
            <h2>Existing credentials</h2>
            @if(Auth::user()->credentials()->count() > 0)
            <table>
                <thead>
                <tr><td>Login</td><td>Alias</td><td>Actions</td></tr>
                </thead>
                @foreach(Auth::user()->credentials()->get() as $credentials)
                    <tr>
                        <td>{{ $credentials->id }}</td>
                        <td>{{ $credentials->name }}</td>
                        <td>
                            <form method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $credentials->id }}">
                                <button type="submit" name="action" value="resetPassword" class="button">Reset password</button>
                                <button type="submit" name="action" value="delete" class="button">Delete credentials</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
                <i>No Credentials yet</i>
            @endif
        </div>
        <div class="card">
            <h2>Create new credentials</h2>
            <form method="post">
                @csrf
                <input type="hidden" value="create" name="action">
                <div style="margin: 10px 0; max-width: 450px;">
                    <input type="text" name="name" id="createCredentialsName" required>
                    <label for="createCredentialsName">Alias</label>
                </div>
                <button class="button" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection
