@extends('partial.base')
@section('main')
    <!-- Page Content -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content">
            <div class="content">
                @if(session('success'))
                <div class="alert alert-success">
                    Product added successfully
                </div>
            @endif

            <div class="row mb-5">
                <div class="col-lg-12">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>

            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Products</h3>
                </div>
                <div class="block-content block-content-full">
                    <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table id='datatable_ajax' class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;"></th>
                                <th style="width: 10%;">Product Name</th>
                                <th style="width: 5%;">Category Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 25%;">Discription</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">photo</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">status</th>
                                <th class="d-none d-sm-table-cell" style="width: 5%;">Action</th>
                                {{-- <th class="d-none d-sm-table-cell" style="width: 5%;">Delete</th>
                          <th class="text-center" style="width: 15%;">Profile</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($user as $item)
                      <tr>
                          <td class="text-center">1</td>
                          <td class="font-w600">{{$item->auther_name}}</td>
                          <td class="d-none d-sm-table-cell">{{$item->title}}</td>
                          <td class="d-none d-sm-table-cell">{{$item->description}}</td>
                          <td><img src="{{ asset('assets/media/photos/'.$item->image) }}" alt="img" width="50%" height="50%"></td>
                          <td>@if ($item->status == 1)
                                active
                              @else
                                Not-active
                              @endif
                          </td>
                          <td><button class="changeStatus" data-id="{{ $item->id }}" data-status="{{ $item->status }}">Change Status</button></td>
                          <td><button class="changeStatus" data-id="{{ $item->id }}" data-status="{{ $item->status }}">edit</button></td>
                          <td><button id="deleteProduct" data-id="{{ $item->id}}"  >Del</button></td>
                          <td class="text-center">
                              <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                                  <i class="fa fa-user"></i>
                              </button>
                          </td>
                      </tr>
                    @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Page Content -->
        </div>
    </main>
    <!-- END Page Content -->
@endsection

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        let blogUrl = '{{ route('products.index') }}';
    </script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">

            var oTable = $('#datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                // paging: false,

                ajax: {
                url: "{{ route('products.store') }}",
                data: function (d) {
                    d.status = $('#status').val(),
                    d.category_id=$('#category_id').val()
                }
          },
                columns: [{
                        data: 'id',
                        name: 'products.id'
                    },
                    {
                        data: 'product_name',
                        name: 'products.product_name',
                        render: function(data, type, row, meta) {
                            return `<a href="{{ url('/') }}/products/${row['id']}">${data}</a>`;

                        }

                    },
                    {
                        data: 'category_name',
                        name: 'categories.category_name',
                        // render: function(data, type, row, meta) {
                        //     return data.name;
                        // }
                    },
                    {
                        data: 'description',
                        name: 'products.description'
                    },
                    {
                        data: 'image',
                        name: 'products.image',
                        render: function(data, type, row, meta) {
                            return `<img src="{{ asset('assets/media/photos') }}/${data}" alt="img" width="50%" height="50%">`
                        }
                    },
                    {
                        data: 'status',
                        name: 'products.status',
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            if (data==1) {
                                return `<button id="changeStatus" class="btn btn-success" data-id="${row['id']}" data-status="${0}"data-toggle="tooltip" title="Change Status">active</button>`

                            } else {
                                return `<button id="changeStatus" class="btn btn-danger" data-id="${row['id']}" data-status="${1}" data-toggle="tooltip" title="Change Status">Not-active</button>`
                            }

                        }
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a href="{{ url('/') }}/products/${row['id']}/edit" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">
                                  <i class="fa fa-edit"></i>
                              </a> <button type="button" id="deleteProduct" class="btn btn-sm btn-secondary" data-id="${row['id']}" data-toggle="tooltip" title="Delete">
                                  <i class="fa fa-remove"></i>
                              </button>`
                        }
                    },
                ]
            });

            $(document).on("click", "#submitbtn", function() {
           console.log('success');
            oTable.draw();

        });



        $(document).on("click", "#deleteProduct", function(event) {


            var form =  $(this).closest("form");

        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this record?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {

        var id = $(this).attr("data-id");
            var token = "{{ csrf_token() }}";
            console.log(id, token)
            $.ajax({
                url: "{{ url('products') }}/" + id,
                type: 'DELETE',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                success: function() {
                    oTable.draw();
                    console.log("it Work");
                },
                error: function() {
                    console.log("it's error");
                }
            });

    }
});


            // alert('xyz');
            // var id = $(this).data("id");
            // var id = $(this).attr("data-id");
            // var token = "{{ csrf_token() }}";
            // console.log(id, token)
            // $.ajax({
            //     url: "{{ url('products') }}/" + id,
            //     type: 'DELETE',
            //     dataType: "JSON",
            //     data: {
            //         "id": id,
            //         "_method": 'DELETE',
            //         "_token": token,
            //     },
            //     success: function() {
            //         oTable.draw();
            //         console.log("it Work");
            //     },
            //     error: function() {
            //         console.log("it's error");
            //     }
            // });

            console.log("It failed");
        });

        $(document).on("click", "#changeStatus", function(event){

                    var form =  $(this).closest("form");
                    var id = $(this).attr("data-status");

        event.preventDefault();
        var text = (id == 0) ? "If you deactivate this, it will not be available for users." : "If you activate this, it will be available for users.";
        swal({
            title: "Are you sure!",
            text: text,
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Deactivate!'
        }).then((willDelete) => {
    if (willDelete) {
            var id = $(this).data("id");
            var status = $(this).data("status");
            var token = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ url('product') }}/" + id,
                type: 'PUT',
                dataType: "JSON",
                data: {
                    "id": id,
                    "status": status,
                    "_method": 'PUT',
                    "_token": token,
                },
                success: function() {
                    oTable.draw();
                    console.log("Change status operation successful");
                },
                error: function() {
                    console.log("Error in change status operation");
                }
            });
        }
        });
     });
    </script>
@endpush

@push('script')
<style>
    #datatable_ajax_filter  {
        margin-left: 320;
    }
</style>
@endpush


