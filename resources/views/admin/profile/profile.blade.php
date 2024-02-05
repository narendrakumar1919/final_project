@extends('partial.base')
@section('main')
    <!-- Page Content -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">
            @if(session('success'))
            <div class="alert alert-danger">
                Profile Updated successfully
            </div>
        @endif

            <div class="block pull-r-l">
                <div class="block-header bg-body-light">
                    <h3 class="block-title">
                        <i class="fa fa-fw fa-pencil font-size-default mr-5"></i>Profile
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                            data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    {{ Form::open(['url' => route('admin.updateProfile', $data->id), 'method' => 'PUT', 'files' => true]) }}
                        <div class="form-group mb-15">
                            <label for="side-overlay-profile-name">Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="side-overlay-profile-name"
                                    name="name" placeholder="Your name.." value="{{$data->name}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-15">
                            <label for="side-overlay-profile-email">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="side-overlay-profile-email"
                                    name="email" placeholder="Your email.."
                                    value="{{$data->email}}">
                                <input type="hidden" class="form-control" id="side-overlay-profile-email"
                                    name="currentEmail" placeholder="Your email.."
                                    value="{{$data->email}}">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>

                                </div>

                            </div>
                            @error('email')
                            <div id="email_error_text">

                                    {{$message}}

                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-15">
                            <label for="side-overlay-profile-mobile">Mobile</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="side-overlay-profile-mobile"
                                    name="mobile" value="{{$data->mobile}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group mb-15">
                            <label for="side-overlay-profile-password">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="side-overlay-profile-password"
                                    name="side-overlay-profile-password" placeholder="New Password..">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-asterisk"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-15">
                            <label for="side-overlay-profile-password-confirm">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control"
                                    id="side-overlay-profile-password-confirm"
                                    name="side-overlay-profile-password-confirm" placeholder="Confirm New Password..">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-asterisk"></i>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-large btn-alt-primary">
                                    <i class="fa fa-refresh mr-5"></i> Update
                                </button>
                            </div>
                        </div>
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

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest') !!}

@endpush

@push('css')
<style>
    #email_error_text {
        color: red
    }
</style>
@endpush
