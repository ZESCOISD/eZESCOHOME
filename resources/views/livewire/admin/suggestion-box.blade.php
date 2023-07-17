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
                            <div id="login-nav-bar-links" type="button" onclick=" window.location='{{ route('users.manage') }}'">Profile</div>
                        @endrole
                        <div id="login-nav-bar-links" type="button"
                            onclick=" window.location='{{ route('reports.manage') }}'">Reports</div>
                        <div id="login-nav-bar-links" class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton" type="button" aria-haspopup="true" data-toggle="dropdown"
                                aria-expanded="false">Utilties</div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" onclick=" window.location='{{ route('notices.manage') }}'">Notices</a>
                                <a class="dropdown-item" onclick=" window.location='{{ route('events.manage') }}'">Events</a>
                                <a class="dropdown-item" onclick=" window.location='{{ route('faqs.manage') }}'">FAQ's</a>
                                <a class="dropdown-item" onclick=" window.location='{{ route('suggestions.manage') }}'">Suggestion Box</a>
                                <a class="dropdown-item" onclick=" window.location='{{ route('slides.manage') }}'">Slides</a>
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
            Suggesition Box
        </div>
        <div class="container-fluid">

            <div class="container mt-5">
                <div class="table-wrapper">
                    <div class="table-title mb-5">
                        <div class="row">

                            <div class="col-sm-4">
                                <h2>Manage <b>Suggestions</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control border-end-0 border rounded-pill"
                                    wire:model.defer="search_suggestion" type="search" placeholder="Search..."
                                    id="search-input">

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
                                    <td class="text-truncate" style="max-width: 80px;">
                                        {{ $suggestion->suggestion }}</td>
                                    <td>{{ $suggestion->date }}</td>

                                    <td>

                                        <a type="button" href="#viewModal" data-toggle="modal" data-target="#viewModal"
                                            wire:click.prevent="viewItem({{ $suggestion->id }})"><i
                                                class="bi bi-eye-fill"></i></a>
                                        @can('delete')
                                            <a type="button" href="#deleteSuggestionModal" data-toggle="modal"
                                                data-target="#deleteSuggestionModal"
                                                wire:click="deleteSuggestion({{ $suggestion->id }})" class="delete"
                                                data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                    title="Delete">&#xE872;</i></a>
                                        @endcan

                                        @role('admin')
                                        <a type="button" href="#deleteSuggestionModal" data-toggle="modal" data-target="#deleteSuggestionModal"
                                            wire:click="deleteSuggestion({{ $suggestion->id }})" class="delete" data-toggle="modal"><i class="material-icons"
                                                data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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

                        {{ $suggestions->links() }}

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
                                                <input style="width:300px;" class="text-center p-2"
                                                    id="view-item-inputs" type="text" form-group
                                                    wire:model.prevent="subject" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class=" mb-2">
                                            <div class="-body">
                                                <i style="font-size:25px;" class="bi bi-collection-fill"></i>
                                                <h5>System Name</h5>
                                                <input style="overflow-x: scroll;" class="text-center p-2"
                                                    id="view-item-inputs" type="text" form-group
                                                    wire:model.prevent="system_name" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class=" mb-2">
                                            <div class="-body">
                                                <i style="font-size:25px; text-align:right;"
                                                    class="bi bi-info-circle-fill"></i>
                                                <h5>Suggestion</h5>
                                                <textarea style="width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group
                                                    wire:model.prevent="suggestion" readonly>
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
                                                <input id="view-item-inputs" class="text-center p-2" type="text"
                                                    form-group wire:model.prevent="created_at" readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="modal-footer">
                                    <input style="background-color: rgb(153, 150, 150)" type="button"
                                        class="btn btn-default" data-dismiss="modal" value="Close">

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
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="destroySuggestion" class="loading-bar">
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



        </div>

    </body>



</div>


@push('custom-scripts')
    <script src="{{ asset('/js/adminmanagement.js') }}"></script>
@endpush
