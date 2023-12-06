<div>
    @push('custom-styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href='/css/adminmanagement.css'>
    @endpush
    @role('admin')

    <body id="manage-body">

   

    @include('layouts.admin_nav')



    <div class="text-center" id="admin-menu-text">
        Product Contact Group
    </div>
    <div class="container">
        <div class="table-wrapper mt-5">
            <div class="table-title">
                <div class="row">

                    <div class="col-sm-4">
                        <h2>Manage <b>Contact Group</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control border-end-0 border rounded-pill" wire:model="search"
                               type="search" placeholder="Search..." id="search-input">
                        <span class="input-group-append"></span>
                    </div>
                    <div class="col-sm-4">
                        <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addContactGroupModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                        Contact Group</span></button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Office Location</th>
                    <th>Office Address</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                </tr>
                </thead>
                <tbody>
                @forelse($contact_groups as $contact_group)
                    <tr>
                        <td>{{ $contact_group->name }}</td>
                        <td>{{ $contact_group->phone }}</td>
                        <td>{{ $contact_group->email }}</td>
                        <td>{{ $contact_group->location }}</td>
                        <td>{{ $contact_group->location }}</td>
                        <td>{{ $contact_group->office_address }}</td>
                        <td>{{ $contact_group->created_at }}</td>
                        <td>{{ $contact_group->updated_at }}</td>
                        <td>
                        <a href="#viewContactGroupModal" class="edit" data-toggle="modal"
                               data-target="#viewContactGroupModal"
                               wire:click="findContactGroup({{ $contact_group->id }})">
                               <i class="material-icons" data-toggle="tooltip" title="View">&#xe40c;</i>
                            </a>

                            <a href="#editContactGroupModal" class="edit" data-toggle="modal"
                               data-target="#updateContactGroupModal"
                               wire:click="editContactGroup({{ $contact_group->id }})"><i class="material-icons"
                                                                                    data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#deleteContactGroupModal" class="delete" data-toggle="modal"
                               data-target="#deleteContactGroupModal"
                               wire:click="deleteContactGroup({{ $contact_group->id }})"><i class="material-icons"
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
                {{ $contact_groups->links() }}
            </div>

            <!-- Create Modal HTML -->
            @include('livewire.admin.contact-groups.create')

            <!-- Edit Modal HTML -->
            @include('livewire.admin.contact-groups.edit')

            <!-- Delete Modal HTML -->
            @include('livewire.admin.contact-groups.delete')

            <!-- Attach Product Modal HTML -->
            @include('livewire.admin.contact-groups.attach-product')

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
