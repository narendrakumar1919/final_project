@extends('partial.base')
@section('main')
{{ Breadcrumbs::render('products.show',$show) }}
    <!-- Page Content -->
    <main id="main-container">
    <div class="bg-primary">
    <div class="bg-pattern bg-black-op-25" style="background-image: url('assets/media/various/bg-pattern.png');">
        <!-- Page Content -->
        <div class="bg-pattern bg-black-op-25" style="background-image: url('assets/media/various/bg-pattern.png');">
            <div class="content content-top text-center">
                <div class="py-50">
                    <h1 class="font-w700 text-white mb-10">Product</h1>
                    <h2 class="h4 font-w400 text-white-op">Product Detail</h2>
                </div>
            </div>


        </div>

    </div>

</div>

    <!-- END Hero -->

    <!-- Blog and Sidebar -->
    <div class="content">

        <div class="row items-push py-30">
            <!-- Posts -->

            <div class="col-xl-8">
                <div class="mb-50">
                    <div class="overflow-hidden rounded mb-20" style="height: 400px;">
                        <a class="img-link" href="be_pages_generic_story.html">
                            <img class="img-fluid" src="{{asset('assets/media/photos/'.$show->image)}}" alt="" width="80%">
                        </a>

                    </div>


                    <div class="text-muted mb-10">
                        <span class="mr-15">
                            <i class="fa fa-fw fa-calendar mr-5"></i>{{$show->date}}
                        </span>
                        <a class="text-muted mr-15" href="#">
                            <i class="fa fa-fw fa-user mr-5"></i>{{$show->product_name}}
                        </a>
                        <a class="text-muted" href="javascript:void(0)">
                            <i class="fa fa-fw fa-tag mr-5"></i>{{$show->category->category_name}}
                        </a>
                        <a href="{{  route('products.edit', ['product' => $show->id])}}" class="btn btn-sm btn-secondary
                             ml-10"><i class="fa fa-edit"> Edit</i></a>
                    </div>
                    <p>{{$show->description}}</p>

                    <br>

                </div>

                <hr class="d-xl-none">
            </div>
            <!-- END Posts -->

            <!-- Sidebar -->

            <!-- END Sidebar -->
            </div>
        </div>


            </main>
            <!-- END Page Content -->
        @endsection


