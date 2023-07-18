<div>
    @push('custom-styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/adminmanagement.css') }}">
    @endpush



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
                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('products.manage') }}'"> Products</div>

                        @role('admin')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('status.manage') }}'"> Status</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('roles.manage') }}'"> Roles</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('permissions.manage') }}'"> Permissions</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('reports.manage') }}'"> Reports</div>
                        @endrole

                        @role('management')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('reports.manage') }}'"> Reports</div>
                        @endrole

                        @role('developer')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('reports.manage') }}'"> Reports</div>
                        @endrole

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
        @role('admin')
            <div class="text-center" id="admin-menu-text">
                Users
            </div>
        @else
            <div class="text-center" id="admin-menu-text">
                Manage Profile
            </div>
        @endrole
        <div class="container-xl">

            {{-- Tabs --}}

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card card-primary card-outline card-tabs mt-5">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs">
                                @role('admin')
                                    <li class="nav-item">
                                        <a class="nav-link {{ $activeTab === 'tab1' ? 'active' : '' }}"
                                            wire:click="$set('activeTab', 'tab1')" href="#" role="tab">Users</a>
                                    </li>
                                @endrole
                                <li class="nav-item">
                                    <a class="nav-link {{ $activeTab === 'tab2' ? 'active' : '' }}"
                                        wire:click="$set('activeTab', 'tab2')" href="#" role="tab">Manage
                                        Password</a>
                                </li>


                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                @role('admin')
                                    <div class="tab-pane {{ $activeTab === 'tab1' ? 'active' : '' }}" id="tab1">
                                        <div class="table-responsive mt-5">
                                            <div class="table-wrapper">
                                                <div class="table-title">
                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <h2>Manage <b>users</b></h2>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <input class="form-control border-end-0 border rounded-pill"
                                                                wire:model="search" type="search"
                                                                placeholder="Enter ID..." name="id"
                                                                id="search-input">
                                                            <span class="input-group-append">
                                                        </div>

                                                        <div class="col-sm-4">

                                                            <a id="btn-add-new" href="#addUserModal"
                                                                class="btn btn-success" data-toggle="modal"><i
                                                                    class="material-icons">&#xE147;</i> <span>Add New
                                                                    User</span></a>

                                                            <div wire:ignore.self class="modal fade" id="addUserModal"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="addUserModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="addCategoryModalLabel">Enter user
                                                                                details
                                                                            </h5>
                                                                            <button id="modal-close" type="button"
                                                                                class="close" wire:click="closeModal"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div wire:loading wire:target="register"
                                                                            class="loading-bar"></div>

                                                                        <div class="modal-body">

                                                                            @if (session()->has('registeredsuccessful'))
                                                                                <div id="dismiss"
                                                                                    class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                                    role="alert"
                                                                                    style="border:none; font-size: 12px;">
                                                                                    <p class="mt-3">
                                                                                        {{ session('registeredsuccessful') }}
                                                                                    </p>
                                                                                    <button style="color:white;"
                                                                                        type="button"
                                                                                        class="btn-close mt-1"
                                                                                        data-dismiss="alert"
                                                                                        aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                            @endif

                                                                            <form wire:submit.prevent="register">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="name">First
                                                                                        name</label>
                                                                                    <input type="text"
                                                                                        class="form-control mb-1"
                                                                                        wire:model.defer="fname"
                                                                                        id="name"
                                                                                        placeholder="first name" required>
                                                                                    @error('fname')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="name">Last name</label>
                                                                                    <input type="text"
                                                                                        class="form-control mb-1"
                                                                                        wire:model.defer="sname"
                                                                                        id="name"
                                                                                        placeholder="last name" required>
                                                                                    @error('sname')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="name">email</label>
                                                                                    <input type="email"
                                                                                        class="form-control mb-1"
                                                                                        wire:model.defer="email"
                                                                                        id="name" placeholder="email"
                                                                                        required>
                                                                                    @error('email')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="name">staff
                                                                                        number</label>
                                                                                    <input type="number"
                                                                                        class="form-control mb-1"
                                                                                        wire:model.defer="staff_number"
                                                                                        id="name"
                                                                                        placeholder="staff number"
                                                                                        required>
                                                                                    @error('staff_number')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label for="name">Role Type</label>
                                                                                    <select class="form-control"
                                                                                        id="role_name" name="role_name"
                                                                                        wire:model.defer="role_name">
                                                                                        <option name="role_name"
                                                                                            value="0">Select a role
                                                                                        </option>
                                                                                        @foreach ($roles as $role)
                                                                                            <option name="role_name"
                                                                                                value="{{ $role->name }}">
                                                                                                {{ $role->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('role_name')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="name">Password</label>
                                                                                    <input type="password"
                                                                                        class="form-control mb-1"
                                                                                        wire:model.defer="password"
                                                                                        id="name"
                                                                                        placeholder="password" required>
                                                                                    @error('password')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="name">Password
                                                                                        Confirmation</label>
                                                                                    <input type="password"
                                                                                        class="form-control mb-1"
                                                                                        wire:model.defer="password_confirmation"
                                                                                        id="name"
                                                                                        placeholder="confirm password"
                                                                                        required>
                                                                                    @error('password_confirmation')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="modal-footer mt-3"
                                                                                    id="modal-footer">
                                                                                    <button
                                                                                        style="background-color: #1bad6c"
                                                                                        type="submit"
                                                                                        class="btn btn-danger">Add
                                                                                        user</button>
                                                                                    <button
                                                                                        style="background-color: rgb(153, 150, 150)"
                                                                                        type="button"
                                                                                        wire:click="closeModal"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Close</button>

                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                            <th>User ID</th>
                                                            <th> First name </th>
                                                            <th> Last name</th>
                                                            <th>Email</th>
                                                            <th>Staff Number</th>
                                                            <th>Role Type</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($users as $user)
                                                            <tr>
                                                                <td>
                                                                    <span class="custom-checkbox">
                                                                        <input type="checkbox" id="checkbox1"
                                                                            name="options[]" value="1">
                                                                        <label for="checkbox1"></label>
                                                                    </span>
                                                                </td>
                                                                <td>{{ $user->user_id }}</td>
                                                                <td>{{ $user->fname }}</td>
                                                                <td>{{ $user->sname }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->staff_number }}</td>
                                                                <td>{{ $user->name }}</td>

                                                                <td>

                                                                    <a href="#editUserModal" class="edit"
                                                                        data-toggle="modal" data-target="#updateUserModal"
                                                                        wire:click="editUser({{ $user->user_id }})"><i
                                                                            class="material-icons" data-toggle="tooltip"
                                                                            title="Edit">&#xE254;</i></a>


                                                                    <a href="#deleteUserModal" class="delete"
                                                                        data-toggle="modal" data-target="#deleteUserModal"
                                                                        wire:click="deleteUser({{ $user->user_id }})"><i
                                                                            class="material-icons" data-toggle="tooltip"
                                                                            title="Delete">&#xE872;</i></a>

                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="19">No records found
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                <div class="clearfix">
                                                    {{ $users->links() }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endrole
                                <div class="tab-pane  {{ $activeTab === 'tab2' ? 'active' : '' }}" id="tab2"
                                    role="tabpanel">
                                    <div wire:loading wire:target="updatePassword" class="loading-bar"></div>

                                    @if (session()->has('passwordupdatesuccessful'))
                                        <div id="dismiss"
                                            class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                            role="alert" style="border:none; font-size: 12px;">
                                            <p class="mt-3">{{ session('passwordupdatesuccessful') }}</p>
                                            <button style="color:white;" type="button" class="btn-close mt-1"
                                                data-dismiss="alert" aria-label="Close">
                                            </button>
                                        </div>
                                    @endif
                                    <form wire:submit.prevent="updatePassword">
                                        @csrf
                                        @role('admin')
                                            <div class="form-group">
                                                <label for="name">staff number</label>
                                                <input type="number" class="form-control mb-3"
                                                    wire:model.defer="update_staff_number" id="name"
                                                    placeholder="staff number" required>
                                                @error('staff_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endrole
                                        <div class="form-group">
                                            <label for="name" id="password">Password</label>
                                            <input type="password" class="form-control mb-3"
                                                wire:model.defer="update_password" id="password"
                                                placeholder="password" required>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Password Confirmation</label>
                                            <input type="password" class="form-control mb-3"
                                                wire:model.defer="update_password_confirmation"
                                                id="update_password_confirmation" placeholder="confirm password"
                                                required>
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer mt-3" id="modal-footer">
                                            <button style="background-color: #1bad6c" type="submit"
                                                class="btn btn-danger">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        @role('admin')
            <div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
                aria-labelledby="editUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 80%;" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Update User Details</h5>
                            <button id="modal-close" type="button" class="close" wire:click="closeModal"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if (session()->has('updatesuccessful'))
                                <div class="alert alert-success mt-3 text-bg-success p-2 text-center"
                                    style="border:none; font-size: 12px;">
                                    <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                </div>
                            @endif
                            <form wire:submit.prevent="editUser">
                                @csrf
                                <div class="form-group">
                                    <label for="name">First name</label>
                                    <input type="text" class="form-control mb-1" wire:model.defer="fname"
                                        id="name" placeholder="first name" required>
                                    @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Last name</label>
                                    <input type="text" class="form-control mb-1" wire:model.defer="sname"
                                        id="name" placeholder="last name" required>
                                    @error('sname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">email</label>
                                    <input type="email" class="form-control mb-1" wire:model.defer="email"
                                        id="name" placeholder="email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">staff number</label>
                                    <input type="text" class="form-control mb-1" wire:model.defer="staff_number"
                                        id="name" placeholder="staff number" required>
                                    @error('staff_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="name">Role ID</label>
                                    <select class="form-control" id="role_name" name="role_name"
                                        wire:model.defer="role_name">
                                        @foreach ($roles as $role)
                                            <option name="role_name" value="{{ $role->name }}">{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="modal-footer mt-3" id="modal-footer">
                                    <button style="background-color: #1bad6c" type="submit"
                                        class="btn btn-danger">update</button>
                                    <button style="background-color: #619bff" id="reset-btn" onclick="hideContent()"
                                        type="button" class="btn btn-danger">Reset Password</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

        <!-- Update Modal HTML -->
        <div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" role="dialog"
            aria-labelledby="updateUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 80%;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModalLabel">Update User Details</h5>
                        <button id="modal-close" type="button" wire:click="closeModal" class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div wire:loading wire:target="updateUser" class="loading-bar"></div>

                    <div class="modal-body">

                        {{--  --}}
                        @if (session()->has('updatesuccessful'))
                            <div id="dismiss"
                                class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                role="alert" style="border:none; font-size: 12px;">
                                <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                <button style="color:white;" type="button" class="btn-close mt-1"
                                    data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @endif

                        <form wire:submit.prevent="updateUser">
                            @csrf
                            <div class="form-group">
                                <label for="name">First name</label>
                                <input type="text" class="form-control mb-1" wire:model.defer="fname"
                                    id="name" placeholder="first name" required>
                                @error('fname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Last name</label>
                                <input type="text" class="form-control mb-1" wire:model.defer="sname"
                                    id="sname" placeholder="last name" required>
                                @error('sname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">email</label>
                                <input type="email" class="form-control mb-1" wire:model.defer="email"
                                    id="email" placeholder="email" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">staff number</label>
                                <input type="text" class="form-control mb-1" wire:model.defer="staff_number"
                                    id="staff_number" placeholder="staff number" required>
                                @error('staff_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="name">Role ID</label>
                                <select class="form-control" id="role_name" name="role_name"
                                    wire:model.defer="role_name">
                                    @foreach ($roles as $role)
                                        <option name="role_name" value="{{ $role->name }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="modal-footer mt-3" id="modal-footer">
                                <button style="background-color: #1bad6c" type="submit"
                                    class="btn btn-danger">update</button>



                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Delete Modal HTML -->
        <div wire:ignore.self id="deleteUserModal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="destroyUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete User</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div wire:loading wire:target="destroyUser" class="loading-bar"></div>

                        <div class="modal-body">
                            @if (session()->has('deletesuccessful'))
                                <div class="alert alert-success mt-3 text-bg-success p-2 text-center"
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
                            <input id="del" style="background-color: red; color:white;" type="submit"
                                class="btn btn-danger" value="Delete">
                            <input style="background-color: grey; color:white;" type="button"
                                class="btn btn-default" wire:click="closeModal" data-dismiss="modal" value="Cancel">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>



    @push('custom-styles')
        <script src="{{ asset('js/adminmanagement.js') }}"></script>
    @endpush

</div>
