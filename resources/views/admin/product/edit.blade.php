@extends('partial.base')
@section('main')
    <!-- Page Content -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Categories</h3>
                </div>
                <div class="block-content">
                    {!! Form::model($edit, ['url' => route('products.update', $edit->id), 'method' => 'PUT', 'files' => true]) !!}
                    @include('admin.product.form')
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <!-- END Page Content -->

    </main>
    <!-- END Page Content -->
@endsection
@push('script')
    <!-- Laravel Javascript Validation -->


        <script>
            selectImage.onchange = evt => {
                preview = document.getElementById('preview');
                preview.style.display = 'block';
                const [file] = selectImage.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        </script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ProductUpdateRequest') !!}

@endpush
