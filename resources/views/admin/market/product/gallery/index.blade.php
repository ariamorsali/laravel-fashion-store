@extends('admin.layouts.master2')

@section('head-tag')
    <title>Gallery</title>
@endsection

@section('content')
    <section class="container-fluid px-0">
        <nav style="background-color: #eee; height: 2.25rem" class="my-4 rounded ps-2" aria-label="breadcrumb">
            <ol class="breadcrumb p-1 ">
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#" style="text-decoration: none">market</a></li>
                <li class="breadcrumb-item active">gallery</li>
            </ol>
        </nav>
        <section class="main-body-container">
            <section>
                <h3 class="mt-2 mb-4">Gallery</h3>
            </section>

            @include('admin.alerts.alert-section.success')
            @include('admin.alerts.alert-section.error')

            <section class="d-flex align-items-center mt-4 mb-3 border-bottom pb-2">
                <div class="me-auto" style="max-width: 16rem;">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="search..">
                </div>
                <section class="d-flex justify-content-between align-items-center mt-3 mb-3 pb-2">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-dark btn-sm">Cancel</a>
                    <a href="{{ route('admin.market.gallery.create', $product) }}" class="btn btn-dark btn-sm mx-1">Create
                        new gallery</a>
                </section>
            </section>


            <section class="table-responsive">
                <table class="table table-hover table-striped" style="text-align: center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> Setting</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($product->images as $image)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img class="rounded" src="{{ asset($image->image['indexArray'][$image->image['currentImage']]) }}"
                                        alt="" width="80" height="70">
                                </td>

                                <td class="width-16-rem text-center">
                                    <form class="d-inline" action="{{ route('admin.market.gallery.destroy', ['product' => $product, 'gallery' => $image]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm width-6-rem mi delete" type="submit"><i
                                                class="fa fa-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </section>
        </section>

    </section>
@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
