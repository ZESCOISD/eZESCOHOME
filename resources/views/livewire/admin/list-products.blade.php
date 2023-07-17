@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/adminmanagement.css">
@endpush

<div>

    <body id="manage-body">
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
                            onclick=" window.location='{{ route('categories.manage') }}'"> Categories</div>
                        @role('admin')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('status.manage') }}'">Status</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('roles.manage') }}'">Roles</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('permissions.manage') }}'">Permissions</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('users.manage') }}'">Users</div>
                        @else
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('users.manage') }}'">Profile</div>
                        @endrole
                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('reports.manage') }}'"> Reports</div>
                        <div id="login-nav-bar-links" class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton" type="button" aria-haspopup="true"
                                data-toggle="dropdown" aria-expanded="false">Utilties</div>
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
                            <span class="input-group-append">
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
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->name }}</td>
                                {{-- <td>{{$product->icon_link}}</td> --}}
                                <td>{{ $product->category_id }}</td>
                                <td>{{ $product->status_id }}</td>
                                <td>{{ $product->number_of_clicks }}</td>
                                <td>{{ $product->url }}</td>
                                <td>{{ $product->test_url }}</td>
                                <td>{{ $product->lead_developer }}</td>
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
                                            wire:click="editProduct({{ $product->product_id }})" class="edit"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Edit">&#xE254;</i></a>
                                    @endcan

                                    @role('admin')
                                        <a type="button" href="#editProductModal" data-toggle="modal"
                                            data-target="#updateProductModal"
                                            wire:click="editProduct({{ $product->product_id }})" class="edit"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Edit">&#xE254;</i></a>
                                    @endrole

                                    @can('delete')
                                        <a type="button" href="#deleteProductModal" data-toggle="modal"
                                            data-target="#deleteProductModal"
                                            wire:click="deleteProduct({{ $product->product_id }})" class="delete"
                                            data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                title="Delete">&#xE872;</i></a>
                                    @endcan

                                    @role('admin')
                                        <a type="button" href="#deleteProductModal" data-toggle="modal"
                                            data-target="#deleteProductModal"
                                            wire:click="deleteProduct({{ $product->product_id }})" class="delete"
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




            <div wire:ignore.self class="modal fade" id="addProductModal" tabindex="-1" role="dialog"
                aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" style="max-width: 80%;" role="document">
                    <div class="modal-content">
                        <div style="background-color:cadetblue;" class="modal-header">
                            <h5 style="color:white;" class="modal-title" id="addProductModalLabel">Enter product
                                details</h5>
                            <button id="modal-close" type="button" class="close" wire:click="closeModal"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div wire:loading wire:target="saveProduct" class="loading-bar"></div>

                        <div class="modal-body" id="modal-body">
                            @if (session()->has('savesuccessful'))
                                <div id="dismiss"
                                    class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                    role="alert" style="border:none; font-size: 12px;">
                                    <p class="mt-3">{{ session('savesuccessful') }}</p>
                                    <button style="color:white;" type="button" class="btn-close mt-1"
                                        wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif
                            <form wire:submit.prevent="saveProduct">
                                @csrf

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" wire:model.defer="name"
                                                    name="name" placeholder="name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="category_id">Category</label>
                                                <select class="form-control" id="category_id"
                                                    wire:model.defer="category_id">
                                                    <option value="0">Select an Option</option>
                                                    @foreach ($categoriesfields as $category)
                                                        <option value="{{ $category->category_id }}">
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="icon_Link">Product Icon</label>
                                                <input type="file" class="form-control" name="icon_link"
                                                    wire:model.defer="icon_link" placeholder="Product Icon">
                                                @error('icon_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="system_cover_image">Cover Photo</label>
                                                <input type="file" class="form-control" name="system_cover_image"
                                                    wire:model.defer="system_cover_image"
                                                    placeholder="system cover image">
                                                @error('system_cover_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- @if ($preview_image)
                                        Photo Preview:
                                        <img src="{{ $preview_image }}">
                                        @endif --}}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="video">Tutorial Video</label>
                                                <input type="file" class="form-control" name="video"
                                                    wire:model.defer="video" placeholder="Tutorial Video">
                                                @error('video')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- @if ($preview_image)
                                        Photo Preview:
                                        <img src="{{ $preview_image }}">
                                        @endif --}}

                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="user_manual">User guide</label>
                                                <input class="form-control" type="file" name="user_manual"
                                                    accept=".pdf" wire:model.defer="user_manual"
                                                    placeholder="User guide">
                                                @error('user_manual')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group mt-2">
                                                <label for="status_id">Status</label>
                                                <select class="form-control" id="status_id"
                                                    wire:model.defer="status_id">
                                                    <option value="0">Select an Option</option>
                                                    @foreach ($statusfields as $statusfield)
                                                        <option value="{{ $statusfield->status_id }}">
                                                            {{ $statusfield->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-3">
                                            <div class="form-group ">
                                                <label for="url">Url</label>
                                                <input type="url" class="form-control" name="url"
                                                    wire:model.defer="url" placeholder="url">
                                                @error('url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group ">
                                                <label for="cost_saving">$ Cost Savings</label>
                                                <input type="number" class="form-control" name="cost_saving"
                                                    wire:model.defer="cost_saving"
                                                    placeholder="cost saving in dollars">
                                                @error('cost_saving')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="test_url">Test Url</label>
                                                <input type="url" class="form-control" name="test_url"
                                                    wire:model.defer="test_url" placeholder="Test Url">
                                                @error('test_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="lead_developer">Lead Developer</label>
                                                <select class="form-control" id="lead_developer"
                                                    wire:model.defer="lead_developer" required>
                                                    <option value="0">Select an Option</option>
                                                    @foreach ($leaddevs as $developer)
                                                        <option
                                                            value="{{ $developer->fname }} {{ $developer->sname }}">
                                                            {{ $developer->fname }} {{ $developer->sname }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group ">
                                                <label for="short_description">short Description</label>
                                                <textarea type="text" class="form-control" name="short_description" wire:model.defer="short_description"
                                                    placeholder="Short Description"></textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group ">
                                                <label for="long_description">Long Description</label>
                                                <textarea type="text" class="form-control" name="long_description" wire:model.defer="long_description"
                                                    placeholder="Long Description"></textarea>
                                                @error('long_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="form-group ">
                                                <label for="tutorial_url">Tutorial Url</label>
                                                <input type="url" class="form-control" name="tutorial_url"
                                                    wire:model.defer="tutorial_url" placeholder="Tutorial Url">
                                                @error('tutorial_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mt-2">
                                            <div class="form-group ">
                                                <label for="date_launched">Date Launched</label>
                                                <input type="date" class="form-control"
                                                    wire:model.defer="date_launched" placeholder="Date Launched">
                                                @error('date_launched')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-group dates ">
                                                <label for="date_decommissioned">Date Decommissioned</label>
                                                <input type="date" class="form-control"
                                                    wire:model.defer="date_decommissioned"
                                                    placeholder="Date Decommissioned">
                                                @error('date_decommissioned')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer text-center d-flex justify-content-end align-end">
                                    <button style="background-color: #1bad6c" type="submit"
                                        class="btn btn-danger">submit</button>
                                    <button style="background-color: rgb(153, 150, 150)" type="button"
                                        wire:click="closeModal" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- End of add modal --}}

            <!-- Edit Modal HTML -->
            <div wire:ignore.self id="editProductModal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Enter product details</h5>
                        </div>
                        <form wire:submit.prevent="editProduct">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" wire:model.defer="name"
                                                name="name" placeholder="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category_id"
                                                wire:model.defer="category_id">
                                                <option value="0">Select an Option</option>
                                                @foreach ($categoriesfields as $category)
                                                    <option value="{{ $category->category_id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{--
                                @foreach ($product as $type => $files)
                                <label>{{ ucfirst($type) }}:</label>
                                <select wire:model="product.{{ $type }}">
                                    <option value="">Select a file</option>
                                    @foreach ($files as $file)
                                    <option value="{{ $file }}">{{ $file }}</option>
                                    @endforeach
                                </select>
                                @endforeach --}}

                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="icon_Link">Product Icon</label>
                                            <input type="file" class="form-control" name="icon_link"
                                                wire:model.defer="icon_link" placeholder="Product Icon"
                                                accept="image/png, image/jpeg">
                                            @error('icon_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="system_cover_image">Cover Photo</label>
                                            <input type="file" class="form-control" name="system_cover_image"
                                                wire:model.defer="system_cover_image"
                                                placeholder="system cover image">
                                            @error('system_cover_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="video">Tutorial Video</label>
                                            <input type="file" class="form-control" name="video"
                                                wire:model.defer="video" placeholder="Tutorial Video">
                                            @error('video')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="user_manual">User guide</label>
                                            <input class="form-control" type="file" name="user_manual"
                                                accept=".pdf" wire:model.defer="user_manual"
                                                placeholder="User guide">
                                            @error('user_manual')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group mt-2">
                                            <label for="status_id">Status</label>
                                            <select class="form-control" id="status_id" wire:model.defer="status_id">
                                                <option value="0">Select an Option</option>
                                                @foreach ($statusfields as $statusfield)
                                                    <option value="{{ $statusfield->status_id }}">
                                                        {{ $statusfield->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <div class="form-group ">
                                            <label for="url">Url</label>
                                            <input type="url" class="form-control" name="url"
                                                wire:model.defer="url" placeholder="url">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group ">
                                            <label for="cost_saving">$ Cost Savings</label>
                                            <input type="number" class="form-control" name="cost_saving"
                                                wire:model.defer="cost_saving" placeholder="cost saving in dollars">
                                            @error('cost_saving')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="test_url">Test Url</label>
                                            <input type="url" class="form-control" name="test_url"
                                                wire:model.defer="test_url" placeholder="Test Url">
                                            @error('test_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="lead_developer">Lead Developer</label>
                                            <select class="form-control" id="lead_developer"
                                                wire:model.defer="lead_developer" required>
                                                <option value="0">Select an Option</option>
                                                @foreach ($leaddevs as $developer)
                                                    <option value="{{ $developer->fname }} {{ $developer->sname }}">
                                                        {{ $developer->fname }} {{ $developer->sname }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group ">
                                            <label for="short_description">short Description</label>
                                            <textarea type="text" class="form-control" name="short_description" wire:model.defer="short_description"
                                                placeholder="Short Description"></textarea>
                                            @error('short_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group ">
                                            <label for="long_description">Long Description</label>
                                            <textarea type="text" class="form-control" name="long_description" wire:model.defer="long_description"
                                                placeholder="Long Description"></textarea>
                                            @error('long_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group ">
                                            <label for="tutorial_url">Tutorial Url</label>
                                            <input type="url" class="form-control" name="tutorial_url"
                                                wire:model.defer="tutorial_url" placeholder="Tutorial Url">
                                            @error('tutorial_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="date_launched">Date Launched</label>
                                            <input type="date" class="form-control"
                                                wire:model.defer="date_launched" placeholder="Date Launched">
                                            @error('date_launched')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group dates ">
                                            <label for="date_decommissioned">Date Decommissioned</label>
                                            <input type="date" class="form-control"
                                                wire:model.defer="date_decommissioned"
                                                placeholder="Date Decommissioned">
                                            @error('date_decommissioned')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center d-flex justify-content-center align-middle">
                                <button style="background-color: #1bad6c" type="submit"
                                    class="btn btn-danger">Update</button>
                                <button style="background-color: rgb(153, 150, 150)" type="button"
                                    wire:click="closeModal" class="btn btn-secondary"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Updates the modal --}}
            <div wire:ignore.self id="updateProductModal" class="modal fade " tabindex="-1" role="dialog"
                aria-labelledby="updateProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
                    <div class="modal-content">
                        <div style="background-color:cadetblue;" class="modal-header">
                            <h5 style="color:white;" class="modal-title" id="addProductModalLabel">Update product
                                details</h5>
                        </div>
                        <form wire:submit.prevent="updateProduct">
                            @csrf
                            <div wire:loading wire:target="updateProduct" class="loading-bar"></div>
                            @if (session()->has('updatesuccessful'))
                                <div id="dismiss"
                                    class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                    role="alert" style="border:none; font-size: 12px;">
                                    <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                    <button style="color:white;" type="button" class="btn-close mt-1"
                                        wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" wire:model.defer="name"
                                                name="name" placeholder="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category_id"
                                                wire:model.defer="category_id">
                                                <option value="0">Select an Option</option>
                                                @foreach ($categoriesfields as $category)
                                                    <option value="{{ $category->category_id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="icon_Link">Product Icon</label>
                                            <input type="file" class="form-control" name="icon_link"
                                                wire:model.defer="icon_link" placeholder="Product Icon">
                                            @error('icon_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="system_cover_image">Cover Photo</label>
                                            <input type="file" class="form-control" name="system_cover_image"
                                                wire:model.defer="system_cover_image"
                                                placeholder="system cover image">
                                            @error('system_cover_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- @if ($preview_image)
                                        Photo Preview:
                                        <img src="{{ $preview_image }}">
                                        @endif --}}
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="video">Tutorial Video</label>
                                            <input type="file" class="form-control" name="video"
                                                wire:model.defer="video" placeholder="Tutorial Video">
                                            @error('video')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- @if ($preview_image)
                                        Photo Preview:
                                        <img src="{{ $preview_image }}">
                                        @endif --}}

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="user_manual">User guide</label>
                                            <input class="form-control" type="file" name="user_manual"
                                                accept=".pdf" wire:model.defer="user_manual"
                                                placeholder="User guide">
                                            @error('user_manual')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group mt-2">
                                            <label for="status_id">Status</label>
                                            <select class="form-control" id="status_id" wire:model.defer="status_id">
                                                <option value="0">Select an Option</option>
                                                @foreach ($statusfields as $statusfield)
                                                    <option value="{{ $statusfield->status_id }}">
                                                        {{ $statusfield->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <div class="form-group ">
                                            <label for="url">Url</label>
                                            <input type="url" class="form-control" name="url"
                                                wire:model.defer="url" placeholder="url">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group ">
                                            <label for="cost_saving">$ Cost Savings</label>
                                            <input type="number" class="form-control" name="cost_saving"
                                                wire:model.defer="cost_saving" placeholder="cost saving in dollars">
                                            @error('cost_saving')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="test_url">Test Url</label>
                                            <input type="url" class="form-control" name="test_url"
                                                wire:model.defer="test_url" placeholder="Test Url">
                                            @error('test_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="lead_developer">Lead Developer</label>
                                            <select class="form-control" id="lead_developer"
                                                wire:model.defer="lead_developer" required>
                                                <option value="0">Select an Option</option>
                                                @foreach ($leaddevs as $developer)
                                                    <option value="{{ $developer->fname }} {{ $developer->sname }}">
                                                        {{ $developer->fname }} {{ $developer->sname }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group ">
                                            <label for="short_description">short Description</label>
                                            <textarea type="text" class="form-control" name="short_description" wire:model.defer="short_description"
                                                placeholder="Short Description"></textarea>
                                            @error('short_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group ">
                                            <label for="long_description">Long Description</label>
                                            <textarea type="text" class="form-control" name="long_description" wire:model.defer="long_description"
                                                placeholder="Long Description"></textarea>
                                            @error('long_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="form-group ">
                                            <label for="tutorial_url">Tutorial Url</label>
                                            <input type="url" class="form-control" name="tutorial_url"
                                                wire:model.defer="tutorial_url" placeholder="Tutorial Url">
                                            @error('tutorial_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <label for="date_launched">Date Launched</label>
                                            <input type="date" class="form-control"
                                                wire:model.defer="date_launched" placeholder="Date Launched">
                                            @error('date_launched')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group dates ">
                                            <label for="date_decommissioned">Date Decommissioned</label>
                                            <input type="date" class="form-control"
                                                wire:model.defer="date_decommissioned"
                                                placeholder="Date Decommissioned">
                                            @error('date_decommissioned')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center d-flex justify-content-end align-end">
                                <button style="background-color: #1bad6c" type="submit"
                                    class="btn btn-danger">Update</button>
                                <button style="background-color: rgb(153, 150, 150)" type="button"
                                    wire:click="closeModal" class="btn btn-secondary"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end of update modal --}}

            <!-- Delete Modal HTML -->
            <div wire:ignore.self id="deleteProductModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="destroyProduct">
                            @csrf


                            <div class="modal-header">
                                <h4 class="modal-title">Delete Product</h4>
                                <button type="button" id="modal-close" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="destroyProduct" class="loading-bar"></div>
                            <div class="modal-body">
                                @if (session()->has('deletesuccessful'))
                                    <div class="alert alert-success text-bg-success p-2 text-center"
                                        style="border:none; font-size: 12px;">
                                        <p class="mt-3">{{ session('deletesuccessful') }}</p>
                                    </div>
                                    <style>
                                        #del {
                                            display: none;
                                        }

                                        #del-status {
                                            display: none;
                                        }
                                    </style>
                                @endif
                                <p id="del-status">Are you sure you want to delete this Record?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input id="del" style="background-color: red; color:white:" type="submit"
                                    class="btn btn-danger" value="Delete">
                                <input style="background-color: grey; color:white:" type="button"
                                    class="btn btn-default" wire:click="closeModal" data-dismiss="modal"
                                    value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </body>
</div>




@push('custom-scripts')
    <script src="{{ asset('/js/adminmanagement.js') }}"></script>
@endpush
