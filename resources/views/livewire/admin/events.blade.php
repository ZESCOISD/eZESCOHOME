{{-- @livewire('livewire-pagination') --}}

@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
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

                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('categories.manage') }}'">Categories</div>
                        @role('admin')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('status.manage') }}'">Status</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('roles.manage') }}'">Roles</div>
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('permissions.manage') }}'">Permissions</div>
                        @endrole

                        @role('admin')
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('users.manage') }}'">Users</div>
                        @else
                            <div id="login-nav-bar-links" type="button"
                                onclick=" window.location='{{ route('users.manage') }}'">Profile</div>
                        @endrole
                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('reports.manage') }}'">Reports</div>
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
                    <div id="align-right"
                        class="col-lg-2 col-md-4 col-sm-12 col-xs-12 d-flex justify-content-end align-items-end">
                        <div id="logout" type="button" wire:click="logout"> Logout</div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="text-center" id="admin-menu-text">
            Events
        </div>
        <div class="container-fluid">

            <div class="container mt-5">
                <div class="table-wrapper">
                    <div class="table-title mb-5">
                        <div class="row">

                            <div class="col-sm-4">
                                <h2>Manage <b>Events</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control border-end-0 border rounded-pill"
                                    wire:model.defer="search_event" type="search" placeholder="Search..."
                                    id="search-input">

                                <span class="input-group-append">
                            </div>
                            <div class="col-sm-4">

                                @can('create')
                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addEventModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                            Event</span></button>
                                @endcan

                                @role('admin')
                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addEventModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                            Event</span></button>
                                @endrole

                                <div wire:ignore.self class="modal fade" id="addEventModal" tabindex="-1"
                                    role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
                                        <div class="modal-content">
                                            <div style="background-color:cadetblue; color:white;"
                                                class="modal-header">
                                                <h5 class="modal-title text-white" id="addEventModalLabel">Enter event
                                                    details</h5>
                                                <button id="modal-close" wire:click="closeModal" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div wire:loading wire:target="saveEvent" class="loading-bar"></div>
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
                                                <form wire:submit.prevent="saveEvent">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="event_name">Event
                                                            Name</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="event_name" id="event_name"
                                                            placeholder="Event Name" required>
                                                        @error('event_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="event_description">Event
                                                            Description</label>
                                                        <textarea name="description" wire:model.defer="event_description" id="description" class="form-control mb-1"
                                                            cols="30" rows="10" placeholder="Event Description" required>

                                                                                 </textarea>
                                                        @error('event_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="venue">Venue</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="venue" id="venue"
                                                            placeholder="Venue" required>
                                                        @error('venue')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="venue">Fee</label>
                                                        <input type="number" class="form-control mb-1"
                                                            wire:model.defer="fee" id="venue"
                                                            placeholder="fee" required>
                                                        @error('fee')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="time">Time</label>
                                                        <input type="Time" class="form-control mb-1"
                                                            wire:model.defer="time" id="time"
                                                            placeholder="Time" required>
                                                        @error('time')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="department">Actual Date Of
                                                            Event</label>
                                                        <input type="date" class="form-control mb-1"
                                                            wire:model.defer="date" id="date"
                                                            placeholder="Date" required>
                                                        @error('date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="start_date">Show From</label>

                                                        <input type="date" class="form-control mb-1"
                                                            wire:model.defer="start_date" id="start_date"
                                                            placeholder="start date End date" required>
                                                        @error('start_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="end_date">Show Till</label>
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
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Description</th>
                                <th>Venue</th>
                                <th>fee</th>
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
                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                            <label for="checkbox1"></label>
                                        </span>
                                    </td>
                                    <td>{{ $upcoming_event->id }}</td>
                                    <td>{{ $upcoming_event->event_name }}</td>
                                    <td>{{ $upcoming_event->event_description }}</td>
                                    <td>{{ $upcoming_event->venue }}</td>
                                    <td>{{ $upcoming_event->fee }}</td>
                                    <td>{{ $upcoming_event->time }}</td>
                                    <td>{{ $upcoming_event->date }}</td>
                                    <td>{{ $upcoming_event->start_date }}</td>
                                    <td>{{ $upcoming_event->end_date }}</td>
                                    <td>
                                        @can('update')
                                            <a type="button" href="#editEventModal" data-toggle="modal"
                                                data-target="#updateEventModal"
                                                wire:click="editEvent({{ $upcoming_event->id }})" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>
                                        @endcan

                                        @role('admin')
                                            <a type="button" href="#updateEventModal" data-toggle="modal"
                                                data-target="#updateEventModal"
                                                wire:click="editEvent({{ $upcoming_event->id }})" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>
                                        @endrole

                                        @can('delete')
                                            <a type="button" href="#deleteEventModal" data-toggle="modal"
                                                data-target="#deleteEventModal"
                                                wire:click="deleteEvent({{ $upcoming_event->id }})" class="delete"
                                                data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                    title="Delete">&#xE872;</i></a>
                                        @endcan

                                        @role('admin')
                                            <a type="button" href="#deleteEventModal" data-toggle="modal"
                                                data-target="#deleteEventModal"
                                                wire:click="deleteEvent({{ $upcoming_event->id }})" class="delete"
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

                        {{ $upcoming_events->links() }}

                    </div>
                </div>
            </div>


            <div wire:ignore.self id="editEventModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">

                        <form wire:submit.prevent="editEvent">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Event</h4>
                                <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>

                            <style>
                                input {
                                    margin-bottom: 9px;
                                }
                            </style>
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
                                    <label>Name Of Event</label>
                                    <input type="text" class="form-control" wire:model.defer="event_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Event Description</label>
                                    <input type="text" class="form-control" wire:model.defer="event_description"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Venue</label>
                                    <input type="text" class="form-control" wire:model.defer="venue" required>
                                </div>
                                <div class="form-group">
                                    <label>Fee</label>
                                    <input type="number" class="form-control" wire:model.defer="fee" required>
                                </div>
                                <div class="form-group">
                                    <label>Time Of Event</label>
                                    <input type="time" class="form-control" wire:model.defer="time" required>
                                </div>
                                <div class="form-group">
                                    <label>Actual Date Of Event</label>
                                    <input type="date" class="form-control" wire:model.defer="date" required
                                        placeholder="Actual Date Of Event">
                                </div>
                                <div class="form-group">
                                    <label>Advertisement Start Date</label>
                                    <input type="date" class="form-control" wire:model.defer="start_date" required
                                        placeholder="Advertisement Start Date">
                                </div>
                                <div class="form-group">
                                    <label>Advertisement End Date</label>
                                    <input type="date" class="form-control" wire:model.defer="end_date" required
                                        placeholder="Advertisement End Date">
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



            <div wire:ignore.self id="updateEventModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">
                        <form wire:submit.prevent="updateEvent">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Update Event</h4>
                                <button type="button" id="" class="close" wire:click="closeModal"
                                    data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="updateEvent" class="loading-bar">
                            </div>
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
                                    <label>Event Name</label>
                                    <input type="text" class="form-control" wire:model.defer="event_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Event Description</label>
                                    <input type="text" class="form-control" wire:model.defer="event_description"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Venue</label>
                                    <input type="text" class="form-control" wire:model.defer="venue" required>
                                </div>
                                <div class="form-group">
                                    <label>Fee</label>
                                    <input type="number" class="form-control" wire:model.defer="fee" required>
                                </div>
                                <div class="form-group">
                                    <label>Time</label>
                                    <input type="time" class="form-control" wire:model.defer="time" required>
                                </div>
                                <div class="form-group">
                                    <label>Actual Date Of Event</label>
                                    <input type="date" class="form-control" wire:model.defer="date" required
                                        placeholder="Actual Date Of Event">
                                </div>
                                <div class="form-group">
                                    <label>Advertisement Start Date</label>
                                    <input type="date" class="form-control" wire:model.defer="start_date" required
                                        placeholder="Advertisement Start Date">
                                </div>
                                <div class="form-group">
                                    <label>Advertisement End Date</label>
                                    <input type="date" class="form-control" wire:model.defer="end_date" required
                                        placeholder="Advertisement End Date">
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

    </body>

</div>


@push('custom-scripts')
    <script src="{{ asset('/js/adminmanagement.js') }}"></script>
@endpush
