<div>
    @push('custom-styles')
        <link rel="stylesheet" href="{{ asset('css/adminmenu.css') }}">
    @endpush

    <body id="manage-body">
        <nav class="navbar navbar-inverse navbar-fixed-top bg-light">

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <a onclick=" window.location='{{ route('ezesco-home') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50"
                                class="d-inline-block align-text-top"></a>
                    </a>
                </div>

                <ul class="nav navbar-nav navbar-right navbar-item text-center">
                    <li>
                        <div id="logout" type="button" wire:click="logout"> Logout</div>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="text-center" id="admin-menu-text">
            Admin Panel
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center" id="card-menus">
                <div id="card-category" class="col-lg-3">

                    <div class="card shadow rounded" id="card">

                        <!-- beginong of categories -->
                        <div class="card-body">

                            <!-- add category start -->
                            <p class="card-text">Add a category for <br>products</p>
                            <!-- beginning of modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Categories</h5>
                                            <button id="modal-close" type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <button id="modal-btn"
                                                onclick=" window.location='{{ route('categories.manage') }}'"
                                                type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Manage Categories
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of modal -->
                        </div>
                        <div class="card-footer text-center">
                            <div type="button" class="card-link">
                                <p type="button" data-toggle="modal" data-target="#staticBackdrop">
                                    Categories
                                    <i class="bi bi-arrow-right-circle-fill"></i>

                                </p>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- End of Add category button -->

                <div class="col-lg-3 justify-content-center">
                    <div class="card shadow rounded" id="card">
                        <div class="card-body">
                            <p class="card-text">Add a product into a particular <br>category</p>



                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Products</h5>
                                            <button id="modal-close" type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addProductModal">Add Product</button> --}}
                                            <button id="modal-btn" type="button"
                                                onclick=" window.location='{{ route('products.manage') }}'"
                                                class="btn btn-secondary" data-dismiss="modal">Manage Products</button>


                                            {{-- manage products modal --}}

                                            <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog"
                                                aria-labelledby="addProductModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addProductModalLabel">Enter
                                                                category details</h5>
                                                            <button id="modal-close" type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            {{-- end of manage products modal --}}

                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- end of modal -->


                        </div>
                        <div class="card-footer text-center">
                            <div type="button" class="card-link">
                                <p type="button" data-toggle="modal" data-target="#staticBackdrop2">Products
                                    <i class="bi bi-arrow-right-circle-fill"></i>

                                </p>

                            </div>

                        </div>
                    </div>
                </div>

                @role('admin')
                    <div class="col-lg-3 d-flex justify-content-start align-items-start">
                        <div class="card shadow rounded" id="card">
                            <div class="card-body">
                                <p class="card-text">Product<br>status</p>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop8" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Status</h5>
                                                <button id="modal-close" type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                {{-- start of product satus --}}

                                                <button id="modal-btn" type="button" class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                    onclick=" window.location='{{ route('status.manage') }}'">Manage
                                                    Product Status</button>
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- end of modal -->
                            </div>
                            <div class="card-footer text-center">
                                <div type="button" class="card-link">
                                    <p type="button" data-toggle="modal" data-target="#staticBackdrop8">Manage product
                                        status
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3 justify-content-center">
                        <div class="card shadow rounded" id="card">
                            <div class="card-body">
                                <p class="card-text">Manage system<br>users</p>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#staticBackdrop4">Manage users</button> --}}
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop4" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Manage Users</h5>
                                                <button id="modal-close" type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <button id="modal-btn" type="button" class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                    onclick=" window.location='{{ route('users.manage') }}'">Manage
                                                    users</button>

                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- end of modal -->
                            </div>
                            <div class="card-footer text-center">
                                <div type="button" class="card-link">
                                    <p type="button" data-toggle="modal" data-target="#staticBackdrop4">Manage Users
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 d-flex justify-content-start align-items-start">
                        <div class="card shadow rounded" id="card">
                            <div class="card-body">
                                <p class="card-text">Manage system<br>permissions</p>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop5" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Permissions</h5>
                                                <button id="modal-close" type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                {{-- End of permissions --}}

                                                <button id="modal-btn" type="button" class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                    onclick=" window.location='{{ route('permissions.manage') }}'">Manage
                                                    Permissions</button>

                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- end of modal -->
                            </div>
                            <div class="card-footer text-center">
                                <div type="button" class="card-link">
                                    <p type="button" data-toggle="modal" data-target="#staticBackdrop5">Permissions
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 d-flex justify-content-start align-items-start">
                        <div class="card shadow rounded" id="card">
                            <div class="card-body">
                                <p class="card-text">Manage system<br>roles</p>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop6" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Roles</h5>
                                                <button id="modal-close" type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                {{-- start of roles --}}

                                                <button id="modal-btn" type="button" class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                    onclick=" window.location='{{ route('roles.manage') }}'">Manage
                                                    roles</button>

                                                {{-- End of roles --}}

                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of modal -->
                            </div>
                            <div class="card-footer text-center">
                                <div type="button" class="card-link">
                                    <p type="button" data-toggle="modal" data-target="#staticBackdrop6">Roles
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endrole

                <div class="col-lg-3 justify-content-center">
                    <div class="card shadow rounded" id="card">
                        <div class="card-body">
                            <p class="card-text">Builds reports on various dashboard activities</p>

                        </div>
                        <div class="card-footer text-center">
                            <div type="button" class="card-link">
                                <p type="button" onclick=" window.location='{{ route('reports.manage') }}'">
                                    Reports
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 justify-content-center">
                    <div class="card shadow rounded" id="card">
                        <div class="card-body">
                            <p class="card-text">Customise landing page content</p>

                        </div>
                        <div class="card-footer text-center">
                            <div type="button" class="card-link">
                                <p type="button" onclick=" window.location='{{ route('utilities.manage') }}'">
                                    Utilities
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </body>


</div>
