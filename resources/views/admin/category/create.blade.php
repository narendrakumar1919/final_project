@extends('partial.base')
@section('main')
    <!-- Page Content -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">
            <div class="block">
                @if(session('success'))
                <div class="alert alert-danger">
                    Category added successfully
                </div>
            @endif
                <div class="block-header block-header-default">
                    <h3 class="block-title">Category</h3>
                </div>
                <div class="block-content">
                    {{ Form::open(['url' => route('categories.store'), 'method' => 'POST', 'files' => true]) }}
                    @csrf
                    @include('admin.category.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- END Page Content -->

    </main>
    <!-- END Page Content -->
@endsection
@push('script')
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

{!! JsValidator::formRequest('App\Http\Requests\CategoryRequest') !!}
@endpush
