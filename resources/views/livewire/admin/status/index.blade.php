<div>
    @push('custom-styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href='/css/adminmanagement.css'>
    @endpush
    @role('admin')

    <body id="manage-body">

    @include('layouts.admin_nav')

  
    <div class="text-center" id="admin-menu-text">
        Product Status
    </div>
    <div class="container">
        <div class="table-wrapper mt-5">
            <div class="table-title">
                <div class="row">

                    <div class="col-sm-4">
                        <h2>Manage <b>product status</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control border-end-0 border rounded-pill" wire:model="search"
                               type="search" placeholder="Search..." id="search-input">
                        <span class="input-group-append"></span>
                    </div>
                    <div class="col-sm-4">
                        {{-- <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a> --}}
                        <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addStatusModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                        Status</span></button>
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
                    <th>Status id</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                </tr>
                </thead>
                <tbody>
                @forelse($statuses as $status)
                    <tr>
                        <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                            <label for="checkbox1"></label>
                                        </span>
                        </td>
                        <td>{{ $status->status_id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->code }}</td>
                        <td>{{ $status->created_at }}</td>
                        <td>{{ $status->updated_at }}</td>
                        <td>
                            <a href="#editStatusModal" class="edit" data-toggle="modal"
                               data-target="#updateStatusModal"
                               wire:click="editStatus({{ $status->status_id }})"><i class="material-icons"
                                                                                    data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteStatusModal" class="delete" data-toggle="modal"
                               data-target="#deleteStatusModal"
                               wire:click="deleteStatus({{ $status->status_id }})"><i class="material-icons"
                                                                                      data-toggle="tooltip"
                                                                                      wire:click="closeModal"
                                                                                      title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No records found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="clearfix">
                {{ $statuses->links() }}
            </div>

            <!-- Create Modal HTML -->
            @include('livewire.admin.status.create')

            <!-- Edit Modal HTML -->
            @include('livewire.admin.status.edit')

            <!-- Delete Modal HTML -->
            @include('livewire.admin.status.delete')

        </div>
    </div>

    </body>
    @else
        <div class="row d-flex justify-content-sm-center">
            <div
                class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                <div id="access-denied-card" class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img id="img-access-denied" class="img-responsive"
                                     src="{{ asset('/img/access-denied.png') }}" alt="access-denied">
                            </div>
                            <div class="col-lg-6">
                                <h2>Insufficient permissions to access this page,
                                    contact the administrator to enquire about your permissions
                                </h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endrole



        @push('custom-scripts')
            <script src="{{ asset('/js/adminmanagement.js') }}"></script>
        @endpush
</div>
