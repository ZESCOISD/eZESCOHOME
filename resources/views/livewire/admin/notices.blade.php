{{-- @livewire('livewire-pagination') --}}

@push('custom-styles')
    <link rel="stylesheet" href="/css/adminmanagement.css">
@endpush

<div>

    <body id="manage-body">
        <nav class="navbar navbar-light bg-light">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12 d-flex justify-content-start align-items-start">
                        <a class="navbar-brand" onclick=" window.location='{{ route('admin-menu') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50"
                                class="d-inline-block align-text-top"></a>
                    </div>
                    <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('products.manage') }}'">Products</div>
                        @role('admin')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('status.manage') }}'">Status</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('roles.manage') }}'">Roles</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('permissions.manage') }}'">Permissions</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('users.manage') }}'">Users</div>
                        @endrole
                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('reports.manage') }}'">Reports</div>
                    </div>
                    <div id="align-right"
                        class="col-lg-2 col-md-4 col-sm-12 col-xs-12 d-flex justify-content-end align-items-end">
                        <div id="logout" type="button" wire:click="logout"> Logout</div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="text-center" id="admin-menu-text">
            Categories
        </div>
        <div class="container-fluid">

            <!-- start of new row -->
            <div class="container mt-5">
                <div class="table-wrapper">
                    <div class="table-title mb-5">
                        <div class="row">

                            <div class="col-sm-4">
                                <h2>Important <b>notice</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control border-end-0 border rounded-pill"
                                    wire:model.defer="search_notice" type="search" placeholder="Search..."
                                    id="search-input">
                                {{-- <button onclick="clearInput()" type="button">click me</button> --}}
                                <span class="input-group-append">
                            </div>
                            <div class="col-sm-4">

                                {{-- <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a> --}}
                                @role('admin')
                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addNoticeModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                            Notice</span></button>
                                @endrole
                                <div wire:ignore.self class="modal fade" id="addNoticeModal" tabindex="-1"
                                    role="dialog" aria-labelledby="addNoticeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
                                        <div class="modal-content">
                                            <div style="background-color:cadetblue; color:white;" class="modal-header">
                                                <h5 class="modal-title text-white" id="addNoticeModalLabel">Enter notice
                                                    details</h5>
                                                <button id="modal-close" wire:click="closeModal" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div wire:loading wire:target="saveNotice" class="loading-bar"></div>
                                            <div class="modal-body ">
                                                @if (session()->has('savesuccessful'))
                                                    <div id="dismiss"
                                                        class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                        role="alert" style="border:none; font-size: 12px;">
                                                        <p class="mt-3">
                                                            {{ session('savesuccessful') }}</p>
                                                        <button style="color:white;" type="button"
                                                            class="btn-close mt-1" data-dismiss="alert"
                                                            wire:click="closeModal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                @endif
                                                <form wire:submit.prevent="saveNotice">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="notice_name">Name of
                                                            notice</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="notice_name" id="notice_name"
                                                            placeholder="name of notice" required>
                                                        @error('notice_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" wire:model.defer="description" id="description" class="form-control mb-1"
                                                            cols="30" rows="10" placeholder="Notice Description" required>

                                                        </textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="staff_name">Author of
                                                            Notice</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="staff_name" id="staff_name"
                                                            placeholder="Author of Notice" required>
                                                        @error('staff_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="staff_title">Staff
                                                            title</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="staff_title" id="staff_title"
                                                            placeholder="Position Of Staff" required>
                                                        @error('staff_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="department">Staff
                                                            title</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="department" id="department"
                                                            placeholder="Department " required>
                                                        @error('department')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="start_date">Start
                                                            Date</label>

                                                        <input type="date" class="form-control mb-1"
                                                            wire:model.defer="start_date" id="start_date"
                                                            placeholder="End date" required>
                                                        @error('start_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="end_date">End Date</label>
                                                        <input type="date" class="form-control mb-1"
                                                            wire:model.defer="end_date" id="end_date"
                                                            placeholder="End date" required>
                                                        @error('end_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="modal-footer mt-3 text-center" id="modal-footer">
                                                        <button style="background-color: #1bad6c" type="submit"
                                                            class="btn btn-danger">submit</button>
                                                        <button style="background-color: rgb(153, 150, 150)"
                                                            type="button" wire:click="closeModal"
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
                                <th>Notice ID</th>
                                <th>Notice Title</th>
                                <th>Notice Description</th>
                                <th>Author</th>
                                <th>Position Of Author</th>
                                <th>Dept</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notices as $notice)
                                <tr>
                                    <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                            <label for="checkbox1"></label>
                                        </span>
                                    </td>
                                    <td>{{ $notice->id }}</td>
                                    <td>{{ $notice->notice_name }}</td>
                                    <td>{{ $notice->description }}</td>
                                    <td>{{ $notice->staff_name }}</td>
                                    <td>{{ $notice->staff_title }}</td>
                                    <td>{{ $notice->department }}</td>
                                    <td>{{ $notice->start_date }}</td>
                                    <td>{{ $notice->end_date }}</td>
                                    <td>
                                        @role('admin')
                                            <a type="button" href="#updateNoticeModal" data-toggle="modal"
                                                data-target="#updateNoticeModal"
                                                wire:click="editNotice({{ $notice->id }})" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>
                                            <a type="button" href="#deleteNoticeModal" data-toggle="modal"
                                                data-target="#deleteNoticeModal"
                                                wire:click="deleteNotice({{ $notice->id }})" class="delete"
                                                data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                    title="Delete">&#xE872;</i></a>
                                        @endrole
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="10">No records found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="clearfix">

                        {{ $notices->links() }}

                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div wire:ignore.self id="editNoticeModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">

                        <form wire:submit.prevent="editNotice">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Notice</h4>
                                <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>

                            <div class="modal-body">
                                @if (session()->has('updatesuccessful'))
                                    <div id="dismiss"
                                        class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                        role="alert" style="border:none; font-size: 12px;">
                                        <p class="mt-3">{{ session('updatesuccessful') }}
                                        </p>
                                        <button style="color:white;" type="button" class="btn-close mt-1"
                                            data-dismiss="alert" wire:click="closeModal" aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Name Of Notice</label>
                                    <input type="text" class="form-control" wire:model.defer="notice_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" wire:model.defer="description"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Staff Name</label>
                                    <input type="text" class="form-control" wire:model.defer="staff_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Position Of Staff</label>
                                    <input type="text" class="form-control" wire:model.defer="staff_title"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Department Of Stuff</label>
                                    <input type="text" class="form-control" wire:model.defer="department"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" class="form-control" wire:model.defer="start_date"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="text" class="form-control" wire:model.defer="end_date" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input style="background-color: #1bad6c" type="submit" class="btn btn-info"
                                    value="Save">
                                <input style="background-color: rgb(153, 150, 150)" type="button"
                                    class="btn btn-default" wire:click="closeModal" data-dismiss="modal"
                                    value="Cancel">

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Updates the modal --}}
            <div wire:ignore.self id="updateNoticeModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">
                        <form wire:submit.prevent="updateNotice">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Update Notice</h4>
                                <button type="button" id="" class="close" wire:click="closeModal"
                                    data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="updateNotice" class="loading-bar">
                            </div>
                            <div class="modal-body">
                                @if (session()->has('updatesuccessful'))
                                    <div id="dismiss"
                                        class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                        role="alert" style="border:none; font-size: 12px;">
                                        <p class="mt-3">{{ session('updatesuccessful') }}
                                        </p>
                                        <button style="color:white;" type="button" class="btn-close mt-1"
                                            wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Name Of Notice</label>
                                    <input type="text" class="form-control" wire:model.defer="notice_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" wire:model.defer="description"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Staff Name</label>
                                    <input type="text" class="form-control" wire:model.defer="staff_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Position Of Staff</label>
                                    <input type="text" class="form-control" wire:model.defer="staff_title"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Department Of Stuff</label>
                                    <input type="text" class="form-control" wire:model.defer="department"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" class="form-control" wire:model.defer="start_date"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="text" class="form-control" wire:model.defer="end_date" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input style="background-color: #1bad6c" type="submit" class="btn btn-info"
                                    value="Save">
                                <input style="background-color: rgb(153, 150, 150)" type="button"
                                    class="btn btn-default" wire:click="closeModal" data-dismiss="modal"
                                    value="Cancel">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end of update modal --}}

            <!-- Delete Modal HTML -->
            <div wire:ignore.self id="deleteNoticeModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">">
                    <div class="modal-content">

                        <form wire:submit.prevent="destroyNotice">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Notice</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="destroyNotice" class="loading-bar">
                            </div>
                            <div class="modal-body">
                                @if (session()->has('deletesuccessful'))
                                    <div id="dismiss"
                                        class="alert alert-info mt-3 text-bg-success  p-2 text-center "
                                        style="border:none; font-size: 12px;">
                                        <p class="mt-3">{{ session('deletesuccessful') }}
                                        </p>
                                        <style>
                                            #del {
                                                display: none;
                                            }

                                            #del-status {
                                                display: none;
                                            }
                                        </style>
                                    </div>
                                @endif
                                <p id="del-status">Are you sure you want to delete this Record?
                                </p>
                                <p class="text-warning"><small>This action cannot be
                                        undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input id="del" style="background-color: red; color:white;" type="submit"
                                    class="btn btn-danger" value="Delete">
                                <input style="background-color: grey; color:white;" type="button"
                                    class="btn btn-default" wire:click="closeModal" data-dismiss="modal"
                                    value="Cancel">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end of row -->
            <!-- end of row -->
        </div>

    </body>



</div>


@push('custom-scripts')
    <script src="{{ asset('/js/adminmanagement.js') }}"></script>
@endpush
