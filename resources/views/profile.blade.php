@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header text-center">Profile</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Registered At:</strong> {{ $user->created_at->format('d-M-Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection