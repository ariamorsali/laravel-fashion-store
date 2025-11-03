@extends('admin.layouts.master2')

@section('head-tag')
    <title>Create Admin Ticket</title>
@endsection

@section('content')
    <section class="container-fluid px-0">
        <nav style="background-color: #eee; height: 2.25rem" class="my-4 rounded ps-2" aria-label="breadcrumb">
            <ol class="breadcrumb p-1 ">
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">Ticket</a></li>
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">Admin Ticket</a></li>
                <li class="breadcrumb-item active">Create Admin Ticket</li>
            </ol>
        </nav>
        <section class="main-body-container">
            <section>
                <h3 class="mt-2">Create Admin Ticket</h3>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-3 mb-3 border-bottom pb-3">
                <a href="{{ route('admin.ticket.admin.index') }}" class="btn btn-dark btn-sm">Cancel</a>
            </section>

            <section>
                <form action="{{ route('admin.ticket.admin.store') }}" method="post">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6 my-3">
                            <div class="form-group">
                                <label>admin</label>
                                <select class="form-control form-control-sm" id="admin_id" name="admin_id">
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->id }}"
                                            @if ($admin->id == old('admin_id')) selected @endif>
                                            {{ $admin->fullName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('admin_id')
                                <div class="text-danger" style="margin-top: 9px; font-size: 12px; font-weight: 400;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-3">
                            <div class="form-group">
                                <label>category</label>
                                <select class="form-control form-control-sm" id="category_id" name="category_id">
                                    @foreach ($ticketCategories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == old('category_id')) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="text-danger" style="margin-top: 9px; font-size: 12px; font-weight: 400;">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </section>


                        <section class="col-12 my-3 d-flex justify-content-end">
                            <button class="btn btn-primary">Submit</button>
                        </section>

                    </section>
                </form>
            </section>
        </section>
    @endsection
