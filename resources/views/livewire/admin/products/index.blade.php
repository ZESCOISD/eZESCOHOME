@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/adminmanagement.css">

    {{--  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
      <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@endpush

<div>

    <div id="manage-body">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-start align-items-start">
                        <a class="navbar-brand" onclick=" window.location='{{ route('admin-menu') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50"
                                 class="d-inline-block align-text-top"></a>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('categories.manage') }}'"> Categories
                        </div>
                        @role('admin')
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('status.manage') }}'">Status
                        </div>
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('roles.manage') }}'">Roles
                        </div>
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('permissions.manage') }}'">Permissions
                        </div>
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('users.manage') }}'">Users
                        </div>
                        @else
                            <div id="login-nav-bar-links" type="button"
                                 onclick=" window.location='{{ route('users.manage') }}'">Profile
                            </div>
                            @endrole
                            <div id="login-nav-bar-links" type="button"
                                 onclick=" window.location='{{ route('reports.manage') }}'"> Reports
                            </div>
                            <div id="login-nav-bar-links" class="dropdown">
                                <div class="dropdown-toggle" id="dropdownMenuButton" type="button" aria-haspopup="true"
                                     data-toggle="dropdown" aria-expanded="false">Utilties
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('notices.manage') }}'">Notices</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('events.manage') }}'">Events</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('faqs.manage') }}'">FAQ's</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('suggestions.manage') }}'">Suggestion Box</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('slides.manage') }}'">Slides</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('quotes.manage') }}'">Quote Of the Day</a>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-end align-items-end">
                        <div id="logout" type="button" wire:click="logout"> Logout</div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="text-center" id="admin-menu-text">
            Products
        </div>
        <div class="container-fluid mt-5">

            <div class="table-wrapper justify-content-center align-items-center table-wrapper table-responsive">
                <div class="table-title">
                    <div class="row">

                        <div class="col-sm-4">
                            <h2>Manage <b>products</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control border-end-0 border rounded-pill" wire:model="search"
                                   type="search" placeholder="Search..." id="search-input">
                            <span class="input-group-append"></span>
                        </div>
                        <div class="col-sm-4">
                            @can('create')
                                <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addProductModal"><i class="material-icons">&#xE147;</i> <span>Add new
                                        product</span></button>
                            @endcan

                            @role('admin')
                            <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addProductModal"><i class="material-icons">&#xE147;</i> <span>Add new
                                        product</span></button>
                            @endrole
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                        </th>
                        <th>product id</th>
                        <th>name</th>
                        {{-- <th>icon link</th> --}}
                        <th>category id</th>
                        <th>status Id</th>
                        <th>number of clicks</th>
                        <th>url</th>
                        <th>test url</th>
                        <th>lead developer</th>
                        <th>Total developers</th>
                        <th>short description</th>
                        <th>long description</th>
                        <th>tutorial url</th>
                        <th>date launched</th>
                        <th>date_decommissioned</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                            </td>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            {{-- <td>{{$product->icon_link}}</td> --}}
                            <td>{{ $product->category_id }}</td>
                            <td>{{ $product->status->name ?? "" }}</td>
                            <td>{{ $product->heart_beat ?? "off" }}</td>
                            <td>{{ $product->number_of_clicks }}</td>
                            <td>{{ $product->url }}</td>
                            <td>{{ $product->test_url }}</td>
                            <td>{{ $product->leadDeveloper->name ?? "--" }}</td>
                            <td>{{ $product->developers->count() ?? "--" }}</td>
                            <td class="text-truncate" style="max-width: 80px;">{{ $product->short_description }}
                            </td>
                            <td class="text-truncate" style="max-width: 80px;">{{ $product->long_description }}
                            </td>
                            <td>{{ $product->tutorial_url }}</td>
                            <td>{{ $product->date_launched }}</td>
                            <td>{{ $product->date_decommissioned }}</td>

                            <td>
                                @can('update')
                                    <a type="button" href="#editProductModal" data-toggle="modal"
                                       data-target="#updateProductModal"
                                       wire:click="editProduct({{ $product->id }})" class="edit"><i
                                            class="material-icons" data-toggle="tooltip"
                                            title="Edit">&#xE254;</i></a>
                                @endcan

                                @role('admin')
                                <a type="button" href="#editProductModal" data-toggle="modal"
                                   data-target="#updateProductModal"
                                   wire:click="editProduct({{ $product->id }})" class="edit"><i
                                        class="material-icons" data-toggle="tooltip"
                                        title="Edit">&#xE254;</i></a>
                                @endrole

                                @can('delete')
                                    <a type="button" href="#deleteProductModal" data-toggle="modal"
                                       data-target="#deleteProductModal"
                                       wire:click="deleteProduct({{ $product->id }})" class="delete"
                                       data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                              title="Delete">&#xE872;</i></a>
                                @endcan

                                @role('admin')
                                <a type="button" href="#deleteProductModal" data-toggle="modal"
                                   data-target="#deleteProductModal"
                                   wire:click="deleteProduct({{ $product->id }})" class="delete"
                                   data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                          title="Delete">&#xE872;</i></a>
                                @endrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="16">No records found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="clearfix">
                    {{ $products->links() }}
                </div>
            </div>

            @include('livewire.admin.products.create')
            @include('livewire.admin.products.edit')

        </div>

    </div>
</div>




@push('custom-scripts')

    <script>
        $(document).ready(function () {
            $('#developers').select2();
            $('#developers').on('change', function (e) {
                var data = $('#developers').select2("val");
            @this.set('developers', data);
            });
        });
    </script>

    <script src="{{ asset('/js/adminmanagement.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2({
                placeholder: 'Select an option',
                dropdownParent: $('#addProductModal'),
                theme: "classic"
            });

        });
    </script>
@endpush
