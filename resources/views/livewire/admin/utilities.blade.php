@push('custom-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
@endpush
<div>

    <head>
        <title>eszesco home</title>
        @livewireStyles


    </head>



    <body id="utility-bg">
        <nav wire:ignore class="navbar navbar-inverse navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <a onclick=" window.location='{{ route('admin-menu') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50"
                                class="d-inline-block align-text-top"></a>
                    </a>
                </div>

                <ul class="nav navbar-nav navbar-right navbar-item text-center">

                    <li>
                        <a id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('products.manage') }}'">Products</a>
                    </li>

                    <li>
                        <a id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('status.manage') }}'">
                            Status</a>
                    </li>

                    <li>
                        <a id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('roles.manage') }}'">
                            Roles</a>
                    </li>
                    <li>
                        <a id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('permissions.manage') }}'">Permissions</a>
                    </li>

                    <li>
                        <a id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('users.manage') }}'">
                            Users</a>
                    </li>

                    <li>
                        <a id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('reports.manage') }}'">
                            Reports</a>
                    </li>

                    <li>
                        <a id="login-nav-bar-links" type="button" wire:click="logout"> Logout</a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="text-center" id="admin-menu-text">
            Utilities
        </div>
        <div class="container-fluid">

            <!-- start of new row -->

            <div class="col-xl-12 col-lg-12 col-md-12 mt-3">
                <div wire:ignore.self class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            
                            <li class="nav-item"><a class="nav-link active" href="#notices"
                                    data-toggle="tab">Notices</a></li>
                            <li class="nav-item"><a class="nav-link" href="#events" data-toggle="tab">Events</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#FAQ" data-toggle="tab">FAQ</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#carousel" data-toggle="tab">Home Carousel</a>
                                
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#suggestion_box" data-toggle="tab">Suggestion Box</a>
                            
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body" id="events-bg-card">
                        <div class="tab-content">
                            <div class="active tab-pane" id="notices">
                                <!-- Post -->
                                <div wire:ignore.self id="notice">

                                    <div class="container mt-5">
                                        <div class="table-wrapper">
                                            <div class="table-title mb-5">
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <h2>Important <b>notice</b></h2>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input class="form-control border-end-0 border rounded-pill"
                                                            wire:model.defer="search_event" type="search"
                                                            placeholder="Search..." id="search-input">
                                                        {{-- <button onclick="clearInput()" type="button">click me</button> --}}
                                                        <span class="input-group-append">
                                                    </div>
                                                    <div class="col-sm-4">

                                                        {{-- <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a> --}}
                                                        @role('admin')
                                                            <button id="btn-add-new" type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#addNoticeModal"><i
                                                                    class="material-icons">&#xE147;</i> <span>Add New
                                                                    Notice</span></button>
                                                        @endrole
                                                        <div wire:ignore.self class="modal fade" id="addNoticeModal"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="addNoticeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" style="max-width: 80%;"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div style="background-color:cadetblue; color:white;"
                                                                        class="modal-header">
                                                                        <h5 class="modal-title text-white"
                                                                            id="addNoticeModalLabel">Enter notice
                                                                            details</h5>
                                                                        <button id="modal-close" wire:click="closeModal"
                                                                            type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div wire:loading wire:target="saveNotice"
                                                                        class="loading-bar"></div>
                                                                    <div class="modal-body ">
                                                                        @if (session()->has('savesuccessful'))
                                                                            <div id="dismiss"
                                                                                class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                                role="alert"
                                                                                style="border:none; font-size: 12px;">
                                                                                <p class="mt-3">
                                                                                    {{ session('savesuccessful') }}</p>
                                                                                <button style="color:white;"
                                                                                    type="button"
                                                                                    class="btn-close mt-1"
                                                                                    data-dismiss="alert"
                                                                                    wire:click="closeModal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                        @endif
                                                                        <form wire:submit.prevent="saveNotice">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="notice_name">Name of
                                                                                    notice</label>
                                                                                <input type="text"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="notice_name"
                                                                                    id="notice_name"
                                                                                    placeholder="name of notice"
                                                                                    required>
                                                                                @error('notice_name')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="description">Description</label>
                                                                                <textarea name="description" wire:model.defer="description" id="description" class="form-control mb-1"
                                                                                    cols="30" rows="10" placeholder="Notice Description" required>

                                                        </textarea>
                                                                                @error('description')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror

                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="staff_name">Author of
                                                                                    Notice</label>
                                                                                <input type="text"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="staff_name"
                                                                                    id="staff_name"
                                                                                    placeholder="Author of Notice"
                                                                                    required>
                                                                                @error('staff_name')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="staff_title">Staff
                                                                                    title</label>
                                                                                <input type="text"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="staff_title"
                                                                                    id="staff_title"
                                                                                    placeholder="Position Of Staff"
                                                                                    required>
                                                                                @error('staff_title')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="department">Staff
                                                                                    title</label>
                                                                                <input type="text"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="department"
                                                                                    id="department"
                                                                                    placeholder="Department " required>
                                                                                @error('department')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="start_date">Start
                                                                                    Date</label>

                                                                                <input type="date"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="start_date"
                                                                                    id="start_date"
                                                                                    placeholder="End date" required>
                                                                                @error('start_date')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="end_date">End Date</label>
                                                                                <input type="date"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="end_date"
                                                                                    id="end_date"
                                                                                    placeholder="End date" required>
                                                                                @error('end_date')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="modal-footer mt-3 text-center"
                                                                                id="modal-footer">
                                                                                <button
                                                                                    style="background-color: #1bad6c"
                                                                                    type="submit"
                                                                                    class="btn btn-danger">submit</button>
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
                                                                    <input type="checkbox" id="checkbox1"
                                                                        name="options[]" value="1">
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
                                                                    <a type="button" href="#updateNoticeModal"
                                                                        data-toggle="modal"
                                                                        data-target="#updateNoticeModal"
                                                                        wire:click="editNotice({{ $notice->id }})"
                                                                        class="edit"><i class="material-icons"
                                                                            data-toggle="tooltip"
                                                                            title="Edit">&#xE254;</i></a>
                                                                    <a type="button" href="#deleteNoticeModal"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteNoticeModal"
                                                                        wire:click="deleteNotice({{ $notice->id }})"
                                                                        class="delete" data-toggle="modal"><i
                                                                            class="material-icons" data-toggle="tooltip"
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
                                                                <p class="mt-3">{{ session('updatesuccessful') }}</p>
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
                                                    <div wire:loading wire:target="updateNotice" class="loading-bar"></div>
                                                    <div class="modal-body">
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
                                                    <div wire:loading wire:target="destroyNotice" class="loading-bar"></div>
                                                    <div class="modal-body">
                                                        @if (session()->has('deletesuccessful'))
                                                            <div id="dismiss"
                                                                class="alert alert-info mt-3 text-bg-success  p-2 text-center "
                                                                style="border:none; font-size: 12px;">
                                                                <p class="mt-3">{{ session('deletesuccessful') }}</p>
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
                                                        <p id="del-status">Are you sure you want to delete this Record?</p>
                                                        <p class="text-warning"><small>This action cannot be undone.</small></p>
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
                                </div>
                            </div>
                            <div class="tab-pane" id="events">
        
                                    <div class="container mt-5">
                                        <div class="table-wrapper">
                                            <div class="table-title mb-5">
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <h2>Manage <b>Events</b></h2>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input class="form-control border-end-0 border rounded-pill"
                                                            wire:model.defer="search_event" type="search"
                                                            placeholder="Search..." id="search-input">
                                                      
                                                        <span class="input-group-append">
                                                    </div>
                                                    <div class="col-sm-4">

                                                        @role('admin')
                                                            <button id="btn-add-new" type="button"
                                                                class="btn btn-primary" data-toggle="modal"
                                                                data-target="#addEventModal"><i
                                                                    class="material-icons">&#xE147;</i> <span>Add New
                                                                    Event</span></button>
                                                        @endrole
                                                        <div wire:ignore.self class="modal fade" id="addEventModal"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="addEventModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" style="max-width: 80%;"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div style="background-color:cadetblue; color:white;"
                                                                        class="modal-header">
                                                                        <h5 class="modal-title text-white"
                                                                            id="addEventModalLabel">Enter notice
                                                                            details</h5>
                                                                        <button id="modal-close"
                                                                            wire:click="closeModal" type="button"
                                                                            class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div wire:loading wire:target="saveEvent"
                                                                        class="loading-bar"></div>
                                                                    <div class="modal-body ">
                                                                        @if (session()->has('savesuccessful'))
                                                                            <div id="dismiss"
                                                                                class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                                role="alert"
                                                                                style="border:none; font-size: 12px;">
                                                                                <p class="mt-3">
                                                                                    {{ session('savesuccessful') }}</p>
                                                                                <button style="color:white;"
                                                                                    type="button"
                                                                                    class="btn-close mt-1"
                                                                                    data-dismiss="alert"
                                                                                    wire:click="closeModal"
                                                                                    aria-label="Close">
                                                                                </button>
                                                                            </div>
                                                                        @endif
                                                                        <form wire:submit.prevent="saveNotice">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="event_name">Event
                                                                                    Name</label>
                                                                                <input type="text"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="event_name"
                                                                                    id="event_name"
                                                                                    placeholder="Event Name" required>
                                                                                @error('event_name')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="event_description">Event
                                                                                    Description</label>
                                                                                <textarea name="description" wire:model.defer="event_description" id="description" class="form-control mb-1"
                                                                                    cols="30" rows="10" placeholder="Event Description" required>

                                                                                 </textarea>
                                                                                @error('event_description')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror

                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="venue">Venue</label>
                                                                                <input type="text"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="venue"
                                                                                    id="venue" placeholder="Venue"
                                                                                    required>
                                                                                @error('venue')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="time">Time</label>
                                                                                <input type="Time"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="time"
                                                                                    id="time" placeholder="Time"
                                                                                    required>
                                                                                @error('time')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="department">Actual Date Of Event</label>
                                                                                <input type="date"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="date"
                                                                                    id="date" placeholder="Date"
                                                                                    required>
                                                                                @error('date')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="start_date">Show From</label>

                                                                                <input type="date"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="start_date"
                                                                                    id="start_date"
                                                                                    placeholder="start date End date" required>
                                                                                @error('start_date')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="end_date">Show Till</label>
                                                                                <input type="date"
                                                                                    class="form-control mb-1"
                                                                                    wire:model.defer="end_date"
                                                                                    id="end_date"
                                                                                    placeholder="End date" required>
                                                                                @error('end_date')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="modal-footer mt-3 text-center"
                                                                                id="modal-footer">
                                                                                <button
                                                                                    style="background-color: #1bad6c"
                                                                                    type="submit"
                                                                                    class="btn btn-danger">submit</button>
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
                                                        <th>ID</th>
                                                        <th>Event Name</th>
                                                        <th>Description</th>
                                                        <th>Venue</th>
                                                        <th>Time</th>
                                                        <th>Date</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- <livewire:UpcomingEvent /> --}}
                                                    @forelse($upcoming_events as $upcoming_event)
                                                        <tr>
                                                            <td>
                                                                <span class="custom-checkbox">
                                                                    <input type="checkbox" id="checkbox1"
                                                                        name="options[]" value="1">
                                                                    <label for="checkbox1"></label>
                                                                </span>
                                                            </td>
                                                            <td>{{ $upcoming_event->id }}</td>
                                                            <td>{{ $upcoming_event->events_name }}</td>
                                                            <td>{{ $upcoming_event->event_description }}</td>
                                                            <td>{{ $upcoming_event->venue }}</td>
                                                            <td>{{ $upcoming_event->time }}</td>
                                                            <td>{{ $upcoming_event->date }}</td>
                                                            <td>{{ $upcoming_event->start_date }}</td>
                                                            <td>{{ $upcoming_event->end_date }}</td>
                                                            <td>
                                                                @role('admin')
                                                                    <a type="button" href="#updateNoticeModal"
                                                                        data-toggle="modal"
                                                                        data-target="#updateNoticeModal"
                                                                        wire:click="editNotice({{ $notice->id }})"
                                                                        class="edit"><i class="material-icons"
                                                                            data-toggle="tooltip"
                                                                            title="Edit">&#xE254;</i></a>
                                                                    <a type="button" href="#deleteNoticeModal"
                                                                        data-toggle="modal"
                                                                        data-target="#deleteNoticeModal"
                                                                        wire:click="deleteNotice({{ $notice->id }})"
                                                                        class="delete" data-toggle="modal"><i
                                                                            class="material-icons" data-toggle="tooltip"
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
                                    <div wire:ignore.self id="editEventModal" class="modal fade">
                                        <div class="modal-dialog modal-dialog-centered" role="document">>
                                            <div class="modal-content">

                                                <form wire:submit.prevent="editEvent">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Event</h4>
                                                        <button type="button" class="close" wire:click="closeModal"
                                                            data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @if (session()->has('updatesuccessful'))
                                                            <div id="dismiss"
                                                                class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                role="alert" style="border:none; font-size: 12px;">
                                                                <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                                                <button style="color:white;" type="button"
                                                                    class="btn-close mt-1" data-dismiss="alert"
                                                                    wire:click="closeModal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label>Name Of Event</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="event_name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Event Description</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="event_description" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Venue</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="venue" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Time</label>
                                                            <input type="time" class="form-control"
                                                                wire:model.defer="time" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control"
                                                                wire:model.defer="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="start_date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="end_date" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input style="background-color: #1bad6c" type="submit"
                                                            class="btn btn-info" value="Save">
                                                        <input style="background-color: rgb(153, 150, 150)" type="button"
                                                            class="btn btn-default" wire:click="closeModal"
                                                            data-dismiss="modal" value="Cancel">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Updates the modal --}}
                                    <div wire:ignore.self id="updateEventModal" class="modal fade">
                                        <div class="modal-dialog modal-dialog-centered" role="document">>
                                            <div class="modal-content">
                                                <form wire:submit.prevent="updateEvent">

                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Event</h4>
                                                        <button type="button" id="" class="close"
                                                            wire:click="closeModal" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div wire:loading wire:target="updateEvent" class="loading-bar">
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (session()->has('updatesuccessful'))
                                                            <div id="dismiss"
                                                                class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                role="alert" style="border:none; font-size: 12px;">
                                                                <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                                                <button style="color:white;" type="button"
                                                                    class="btn-close mt-1" wire:click="closeModal"
                                                                    data-dismiss="alert" aria-label="Close">
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label>Event Name</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="event_name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Event Description</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="event_description" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Venue</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="venue" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Time</label>
                                                            <input type="time" class="form-control"
                                                                wire:model.defer="time" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control"
                                                                wire:model.defer="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="start_date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="end_date" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input style="background-color: #1bad6c" type="submit"
                                                            class="btn btn-info" value="Save">
                                                        <input style="background-color: rgb(153, 150, 150)" type="button"
                                                            class="btn btn-default" wire:click="closeModal"
                                                            data-dismiss="modal" value="Cancel">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of update modal --}}

                                    <!-- Delete Modal HTML -->
                                    <div wire:ignore.self id="deleteEventModal" class="modal fade">
                                        <div class="modal-dialog modal-dialog-centered" role="document">">
                                            <div class="modal-content">

                                                <form wire:submit.prevent="destroyEvent">

                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Event</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div wire:loading wire:target="destroyEvent" class="loading-bar">
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (session()->has('deletesuccessful'))
                                                            <div id="dismiss"
                                                                class="alert alert-info mt-3 text-bg-success  p-2 text-center "
                                                                style="border:none; font-size: 12px;">
                                                                <p class="mt-3">{{ session('deletesuccessful') }}</p>
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
                                                        <p id="del-status">Are you sure you want to delete this Record?</p>
                                                        <p class="text-warning"><small>This action cannot be
                                                                undone.</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input id="del" style="background-color: red; color:white;"
                                                            type="submit" class="btn btn-danger" value="Delete">
                                                        <input style="background-color: grey; color:white;" type="button"
                                                            class="btn btn-default" wire:click="closeModal"
                                                            data-dismiss="modal" value="Cancel">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of row -->
                                {{-- </div> --}}

                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="FAQ">
                                <div class="container mt-5">
                                        <div class="table-wrapper">
                                            <div class="table-title mb-5">
                                                <div class="row">
                                    
                                                    <div class="col-sm-4">
                                                        <h2>Manage <b>FAQ</b></h2>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input class="form-control border-end-0 border rounded-pill" wire:model.defer="search_faq"
                                                            type="search" placeholder="Search..." id="search-input">
                                                      
                                                        <span class="input-group-append">
                                                    </div>
                                                    <div class="col-sm-4">
                                    
                                                        @role('admin')
                                                        <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#addFaqModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                                                Faq</span></button>
                                                        @endrole
                                                        <div wire:ignore.self class="modal fade" id="addFaqModal" tabindex="-1" role="dialog"
                                                            aria-labelledby="addFaqModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
                                                                <div class="modal-content">
                                                                    <div style="background-color:cadetblue; color:white;" class="modal-header">
                                                                        <h5 class="modal-title text-white" id="addFaqModalLabel">Enter notice
                                                                            details</h5>
                                                                        <button id="modal-close" wire:click="closeModal" type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div wire:loading wire:target="saveFaq" class="loading-bar"></div>
                                                                    <div class="modal-body ">
                                                                        @if (session()->has('savesuccessful'))
                                                                        <div id="dismiss"
                                                                            class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                            role="alert" style="border:none; font-size: 12px;">
                                                                            <p class="mt-3">
                                                                                {{ session('savesuccessful') }}</p>
                                                                            <button style="color:white;" type="button" class="btn-close mt-1"
                                                                                data-dismiss="alert" wire:click="closeModal" aria-label="Close">
                                                                            </button>
                                                                        </div>
                                                                        @endif
                                                                        <form wire:submit.prevent="saveFaq">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="event_name">Question</label>
                                                                                <input type="text" class="form-control mb-1" wire:model.defer="question"
                                                                                    id="question" placeholder="Faq Question" required>
                                                                                @error('question')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                    
                                                                            <div class="form-group">
                                                                                <label for="faq_answer">Event
                                                                                    Description</label>
                                                                                <textarea name="description" wire:model.defer="answer"
                                                                                    id="faq_answer" class="form-control mb-1" cols="30" rows="10"
                                                                                    placeholder="Faq Answer" required>
                                    
                                                                                            </textarea>
                                                                                @error('event_description')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                    
                                                                            </div>
                                    
                                                                            
                                                                            <div class="modal-footer mt-3 text-center" id="modal-footer">
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
                                                        <th>ID</th>
                                                        <th>Faq Question</th>
                                                        <th>Faq Answer</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    @forelse($faqs as $faq)
                                                    <tr>
                                                        <td>
                                                            <span class="custom-checkbox">
                                                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                                                <label for="checkbox1"></label>
                                                            </span>
                                                        </td>
                                                        <td>{{ $faq->id }}</td>
                                                        <td>{{ $faq->question }}</td>
                                                        <td>{{ $faq->answer }}</td>
                                                        <td>{{ $faq->date }}</td>
                                        
                                                      
                                                            @role('admin')
                                                            <a type="button" href="#updateNoticeModal" data-toggle="modal" data-target="#updateNoticeModal"
                                                                wire:click="editNotice({{ $notice->id }})" class="edit"><i class="material-icons"
                                                                    data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                                            <a type="button" href="#deleteNoticeModal" data-toggle="modal" data-target="#deleteNoticeModal"
                                                                wire:click="deleteNotice({{ $notice->id }})" class="delete" data-toggle="modal"><i
                                                                    class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
                                    <div wire:ignore.self id="editFaqModal" class="modal fade">
                                        <div class="modal-dialog modal-dialog-centered" role="document">>
                                            <div class="modal-content">
                                    
                                                <form wire:submit.prevent="editFaq">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Faq</h4>
                                                        <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                    
                                                    <div class="modal-body">
                                                        @if (session()->has('updatesuccessful'))
                                                        <div id="dismiss"
                                                            class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                            role="alert" style="border:none; font-size: 12px;">
                                                            <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert"
                                                                wire:click="closeModal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label>Question</label>
                                                            <input type="text" class="form-control" wire:model.defer="question" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Answer</label>
                                                            <input type="text" class="form-control" wire:model.defer="answer" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control" wire:model.defer="date" required>
                                                        </div>
                                                      
                                                    <div class="modal-footer">
                                                        <input style="background-color: #1bad6c" type="submit" class="btn btn-info" value="Save">
                                                        <input style="background-color: rgb(153, 150, 150)" type="button" class="btn btn-default"
                                                            wire:click="closeModal" data-dismiss="modal" value="Cancel">
                                    
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Updates the modal --}}
                                    <div wire:ignore.self id="updateFaqModal" class="modal fade">
                                        <div class="modal-dialog modal-dialog-centered" role="document">>
                                            <div class="modal-content">
                                                <form wire:submit.prevent="updateFaq">
                                    
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Faq</h4>
                                                        <button type="button" id="" class="close" wire:click="closeModal" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div wire:loading wire:target="updateFaq" class="loading-bar">
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (session()->has('updatesuccessful'))
                                                        <div id="dismiss"
                                                            class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                            role="alert" style="border:none; font-size: 12px;">
                                                            <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                                            <button style="color:white;" type="button" class="btn-close mt-1" wire:click="closeModal"
                                                                data-dismiss="alert" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        @endif
                                                       <div class="form-group">
                                                            <label>Question</label>
                                                            <input type="text" class="form-control" wire:model.defer="question" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Answer</label>
                                                            <input type="text" class="form-control" wire:model.defer="answer" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" class="form-control" wire:model.defer="date" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input style="background-color: #1bad6c" type="submit" class="btn btn-info" value="Save">
                                                        <input style="background-color: rgb(153, 150, 150)" type="button" class="btn btn-default"
                                                            wire:click="closeModal" data-dismiss="modal" value="Cancel">
                                    
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of update modal --}}
                                    
                                    <!-- Delete Modal HTML -->
                                    <div wire:ignore.self id="deleteFaqModal" class="modal fade">
                                        <div class="modal-dialog modal-dialog-centered" role="document">">
                                            <div class="modal-content">
                                    
                                                <form wire:submit.prevent="destroyFaq">
                                    
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Faq</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div wire:loading wire:target="destroyFaq" class="loading-bar">
                                                    </div>
                                                    <div class="modal-body">
                                                        @if (session()->has('deletesuccessful'))
                                                        <div id="dismiss" class="alert alert-info mt-3 text-bg-success  p-2 text-center "
                                                            style="border:none; font-size: 12px;">
                                                            <p class="mt-3">{{ session('deletesuccessful') }}</p>
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
                                                        <p id="del-status">Are you sure you want to delete this Record?</p>
                                                        <p class="text-warning"><small>This action cannot be
                                                                undone.</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input id="del" style="background-color: red; color:white;" type="submit" class="btn btn-danger"
                                                            value="Delete">
                                                        <input style="background-color: grey; color:white;" type="button" class="btn btn-default"
                                                            wire:click="closeModal" data-dismiss="modal" value="Cancel">
                                    
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of row -->
                                    {{-- </div> --}}
                            </div>

                            <div class="tab-pane" id="carousel">
                            <div class="container mt-5">
                                    <div class="table-wrapper">
                                        <div class="table-title mb-5">
                                            <div class="row">
                                
                                                <div class="col-sm-4">
                                                    <h2>Manage <b>Home Carousel</b></h2>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control border-end-0 border rounded-pill" wire:model.defer="search_carousel"
                                                        type="search" placeholder="Search..." id="search-input">
                                        
                                                    <span class="input-group-append">
                                                </div>
                                                <div class="col-sm-4">
                                
                                                    @role('admin')
                                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#addSlideModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                                            Slide</span></button>
                                                    @endrole
                                                    <div wire:ignore.self class="modal fade" id="addSlideModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="addSlideModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
                                                            <div class="modal-content">
                                                                <div style="background-color:cadetblue; color:white;" class="modal-header">
                                                                    <h5 class="modal-title text-white" id="addSlideModalLabel">Enter notice
                                                                        details</h5>
                                                                    <button id="modal-close" wire:click="closeModal" type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div wire:loading wire:target="saveSlide" class="loading-bar"></div>
                                                                <div class="modal-body ">
                                                                    @if (session()->has('savesuccessful'))
                                                                    <div id="dismiss"
                                                                        class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                                        role="alert" style="border:none; font-size: 12px;">
                                                                        <p class="mt-3">
                                                                            {{ session('savesuccessful') }}</p>
                                                                        <button style="color:white;" type="button" class="btn-close mt-1"
                                                                            data-dismiss="alert" wire:click="closeModal" aria-label="Close">
                                                                        </button>
                                                                    </div>
                                                                    @endif
                                                                    <form wire:submit.prevent="saveSlide">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="slide_name">Slide Name</label>
                                                                            <input type="text" class="form-control mb-1" wire:model.defer="slide_name"
                                                                                id="slide_name" placeholder="Name of Slide" required>
                                                                            @error('slide_name')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                
                                                                        <div class="form-group">
                                                                        <label for="image">Image</label>
                                                                            <input type="file" class="form-control mb-1" wire:model.defer="image"
                                                                                id="image" placeholder="image" required>
                                                                            @error('image')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                        
                                                                        <div class="modal-footer mt-3 text-center" id="modal-footer">
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
                                                    <th>ID</th>
                                                    <th>Name Of Slide</th>
                                                    <th>image</th>
                                                    <th>Date Created</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @forelse($slides as $slide)
                                                <tr>
                                                    <td>
                                                        <span class="custom-checkbox">
                                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                                            <label for="checkbox1"></label>
                                                        </span>
                                                    </td>
                                                    <td>{{ $slide->id }}</td>
                                                    <td>{{ $slide->name }}</td>
                                                    <td>{{ $slide->image }}</td>
                                                    <td>{{ $slide->created_at }}</td>
                                                    
                                                    <td>
                                                        @role('admin')
                                                        <a type="button" href="#updateSlideModal" data-toggle="modal" data-target="#updateSlideModal"
                                                            wire:click="editSlide({{ $slide->id }})" class="edit"><i class="material-icons"
                                                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                                        <a type="button" href="#deleteSlideModal" data-toggle="modal" data-target="#deleteSlideModal"
                                                            wire:click="deleteSlide({{ $slide->id }})" class="delete" data-toggle="modal"><i
                                                                class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
                                
                                            {{ $slides->links() }}
                                
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Edit Modal HTML -->
                                <div wire:ignore.self id="editSlideModal" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered" role="document">>
                                        <div class="modal-content">
                                
                                            <form wire:submit.prevent="editSlide">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Slide</h4>
                                                    <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                </div>
                                
                                                <div class="modal-body">
                                                    @if (session()->has('updatesuccessful'))
                                                    <div id="dismiss"
                                                        class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                        role="alert" style="border:none; font-size: 12px;">
                                                        <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                                        <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert"
                                                            wire:click="closeModal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label>Name Of Slide</label>
                                                        <input type="text" class="form-control" wire:model.defer="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="text" class="form-control" wire:model.defer="image" required>
                                                    </div>
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <input style="background-color: #1bad6c" type="submit" class="btn btn-info" value="Save">
                                                    <input style="background-color: rgb(153, 150, 150)" type="button" class="btn btn-default"
                                                        wire:click="closeModal" data-dismiss="modal" value="Cancel">
                                
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Updates the modal --}}
                                <div wire:ignore.self id="updateSlideModal" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered" role="document">>
                                        <div class="modal-content">
                                            <form wire:submit.prevent="updateSlide">
                                
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Slide</h4>
                                                    <button type="button" id="" class="close" wire:click="closeModal" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                </div>
                                                <div wire:loading wire:target="updateSlide" class="loading-bar">
                                                </div>
                                                <div class="modal-body">
                                                    @if (session()->has('updatesuccessful'))
                                                    <div id="dismiss"
                                                        class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                                        role="alert" style="border:none; font-size: 12px;">
                                                        <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                                        <button style="color:white;" type="button" class="btn-close mt-1" wire:click="closeModal"
                                                            data-dismiss="alert" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    @endif
                                                   <div class="form-group">
                                                        <label>Name Of Slide</label>
                                                        <input type="text" class="form-control" wire:model.defer="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="text" class="form-control" wire:model.defer="image" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input style="background-color: #1bad6c" type="submit" class="btn btn-info" value="Save">
                                                    <input style="background-color: rgb(153, 150, 150)" type="button" class="btn btn-default"
                                                        wire:click="closeModal" data-dismiss="modal" value="Cancel">
                                
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- end of update modal --}}
                                
                                <!-- Delete Modal HTML -->
                                <div wire:ignore.self id="deleteSlideModal" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered" role="document">">
                                        <div class="modal-content">
                                
                                            <form wire:submit.prevent="destroySlide">
                                
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Slide</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div wire:loading wire:target="destroySlide" class="loading-bar">
                                                </div>
                                                <div class="modal-body">
                                                    @if (session()->has('deletesuccessful'))
                                                    <div id="dismiss" class="alert alert-info mt-3 text-bg-success  p-2 text-center "
                                                        style="border:none; font-size: 12px;">
                                                        <p class="mt-3">{{ session('deletesuccessful') }}</p>
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
                                                    <p id="del-status">Are you sure you want to delete this Record?</p>
                                                    <p class="text-warning"><small>This action cannot be
                                                            undone.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input id="del" style="background-color: red; color:white;" type="submit" class="btn btn-danger"
                                                        value="Delete">
                                                    <input style="background-color: grey; color:white;" type="button" class="btn btn-default"
                                                        wire:click="closeModal" data-dismiss="modal" value="Cancel">
                                
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of row -->
                                {{-- </div> --}}
                            </div>

                            <div class="tab-pane" id="suggestion_box">
                                <div class="container mt-5">
                                    <div class="table-wrapper">
                                        <div class="table-title mb-5">
                                            <div class="row">
                            
                                                <div class="col-sm-4">
                                                    <h2>Manage <b>Suggestions</b></h2>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control border-end-0 border rounded-pill" wire:model.defer="search_suggestion"
                                                        type="search" placeholder="Search..." id="search-input">
                                                
                                                    <span class="input-group-append">
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
                                                    <th>ID</th>
                                                    <th>Subject</th>
                                                    <th>System Name</th>
                                                    <th>Suggestion</th>
                                                    <th>Date Submitted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        
                                                @forelse($suggestions as $suggestion)
                                                <tr>
                                                    <td>
                                                        <span class="custom-checkbox">
                                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                                            <label for="checkbox1"></label>
                                                        </span>
                                                    </td>
                                                    <td>{{ $suggestion->id }}</td>
                                                    <td>{{ $suggestion->subject }}</td>
                                                    <td>{{ $suggestion->system_name }}</td>
                                                    <td class="text-truncate" style="max-width: 80px;">{{ $suggestion->suggestion }}</td>
                                                    <td>{{ $suggestion->date }}</td>
                                                     
                                                       <a type="button" href="#viewModal" data-toggle="modal" data-target="#viewModal"
                                                        wire:click.prevent="viewItem({{$suggestion->id}})"><i class="bi bi-eye-fill"></i></a>
                                                        @role('admin')
                                                        <a type="button" href="#deleteSuggestionModal" data-toggle="modal"
                                                            data-target="#deleteSuggestionModal" wire:click="deleteSuggestion({{ $suggestion->id }})"
                                                            class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
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
                            
                                            {{ $suggestion->links() }}
                            
                                        </div>
                                    </div>
                                </div>
                            
                                <div wire:ignore.self id="viewModal" class="modal fade">
                                    <div style="max-width: 80%;" id="viewModal-dialog" class="modal-dialog modal-dialog-centered modal-lg"
                                        role="document">
                                        <div class="modal-content" id="viewModal-content">
                                            <form wire:submit.prevent="viewItem">
                                                @csrf
                                                <div style="background-color:cadetblue;" class="modal-header">
                                                    <h3 style="color:white;" class="modal-title">Item Details</h3>
                                                </div>
                                                <div class="modal-body text-center">
                                
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class=" mb-2">
                                                                <div class="-body">
                                                                    <i style="font-size:25px;" class="bi bi-filter-square-fill"></i>
                                                                    <h5>Subject</h5>
                                                                    <input style="width:300px;" class="text-center p-2" id="view-item-inputs"
                                                                        type="text" form-group wire:model.prevent="subject" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class=" mb-2">
                                                                <div class="-body">
                                                                    <i style="font-size:25px;" class="bi bi-collection-fill"></i>
                                                                    <h5>System Name</h5>
                                                                    <input style="overflow-x: scroll;" class="text-center p-2" id="view-item-inputs"
                                                                        type="text" form-group wire:model.prevent="system_name" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                    <hr>
                                                                                                
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class=" mb-2">
                                                                <div class="-body">
                                                                    <i style="font-size:25px;" class="bi bi-info-circle-fill"></i>
                                                                    <h5>Suggestion</h5>
                                                                    <textarea style="width:300px;" class="text-center p-2" id="view-item-inputs"
                                                                        type="text" form-group wire:model.prevent="suggestion" readonly>
                                                                        </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                    <hr>
                                                
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class=" mb-2">
                                                                <div class="-body">
                                                                    <i style="font-size:25px;" class="bi bi-calendar-check-fill"></i>
                                                                    <h5>Date Submitted</h5>
                                                                    <input id="view-item-inputs" class="text-center p-2" type="text" form-group
                                                                        wire:model.prevent="created_at" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                   
                                                    </div>
                                
                                                    <hr>
                                                    <div class="modal-footer">
                                                        <input style="background-color: rgb(153, 150, 150)" type="button" class="btn btn-default"
                                                            data-dismiss="modal" value="Close">
                                
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Delete Modal HTML -->
                                <div wire:ignore.self id="deleteSuggestionModal" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered" role="document">">
                                        <div class="modal-content">
                            
                                            <form wire:submit.prevent="destroySuggestion">
                            
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Suggestion</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div wire:loading wire:target="destroySuggestion" class="loading-bar">
                                                </div>
                                                <div class="modal-body">
                                                    @if (session()->has('deletesuccessful'))
                                                    <div id="dismiss" class="alert alert-info mt-3 text-bg-success  p-2 text-center "
                                                        style="border:none; font-size: 12px;">
                                                        <p class="mt-3">{{ session('deletesuccessful') }}</p>
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
                                                    <p id="del-status">Are you sure you want to delete this Record?</p>
                                                    <p class="text-warning"><small>This action cannot be
                                                            undone.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input id="del" style="background-color: red; color:white;" type="submit" class="btn btn-danger"
                                                        value="Delete">
                                                    <input style="background-color: grey; color:white;" type="button" class="btn btn-default"
                                                        wire:click="closeModal" data-dismiss="modal" value="Cancel">
                            
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of row -->
                                {{--
                            </div> --}}
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


        </div>
    </body>
</div>

@push('custom-scripts')
    <script src="{{ asset('/js/adminmanagement.js') }}"></script>
@endpush
