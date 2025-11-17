@extends('admin.layouts.master2')

@section('head-tag')
    <title>Show User</title>
@endsection

@section('content')
    <section class="container-fluid px-0">
        <nav style="background-color: #eee; height: 2.25rem" class="my-4 rounded ps-2" aria-label="breadcrumb">
            <ol class="breadcrumb p-1 ">
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">User</a></li>
                <li class="breadcrumb-item active">Show User</li>
            </ol>
        </nav>
        <section class="main-body-container">
            <section>
                <h3 class="mt-2">Show User</h3>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-3 mb-3 border-bottom pb-3">
                <a href="{{ route('admin.user.customer.index') }}" class="btn btn-dark btn-sm">Cancel</a>
            </section>

            <section class="card mb-3">
                <section class="card-header text-white bg-success">
                    {{ $comment->user->fullName ?? 'User deleted' }} - {{ $comment->user->id ?? '-' }}
                </section>
                <section class="card-body">
                    <h5 class="card-title my-2">
                        Post code : {{ $comment->commentable->id }} , Post details : {{ $comment->commentable->name }}
                    </h5>
                    <p class="card-text mt-4">{{ $comment->body }}</p>

                </section>

            </section>


        </section>
    @endsection
