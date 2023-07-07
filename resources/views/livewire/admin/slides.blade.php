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
            Home Carousel
        </div>
        <div class="container-fluid">

            <div class="container mt-5">
                <div class="table-wrapper">
                    <div class="table-title mb-5">
                        <div class="row">

                            <div class="col-sm-4">
                                <h2>Manage <b>Home Carousel</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control border-end-0 border rounded-pill"
                                    wire:model.defer="search_slide" type="search" placeholder="Search..."
                                    id="search-input">

                                <span class="input-group-append">
                            </div>
                            <div class="col-sm-4">

                                @role('admin')
                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addSlideModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                            Slide</span></button>
                                @endrole
                                <div wire:ignore.self class="modal fade" id="addSlideModal" tabindex="-1"
                                    role="dialog" aria-labelledby="addSlideModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 80%;"
                                        role="document">
                                        <div class="modal-content">
                                            <div style="background-color:cadetblue; color:white;" class="modal-header">
                                                <h5 class="modal-title text-white" id="addSlideModalLabel">Enter slide
                                                    details</h5>
                                                <button id="modal-close" wire:click="closeModal" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
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
                                                        <button style="color:white;" type="button"
                                                            class="btn-close mt-1" data-dismiss="alert"
                                                            wire:click="closeModal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                @endif
                                                <form wire:submit.prevent="saveSlide">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="slide_name">Slide Name</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="name" id="name"
                                                            placeholder="Name of Slide" required>
                                                        @error('slide_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="image">Image</label>
                                                        <input type="file" class="form-control mb-1"
                                                            wire:model.defer="image" placeholder="image">
                                                        @if ($image)
                                                            <img src="{{ $image->temporaryUrl() }}"
                                                                style="width:50%; " alt="">
                                                        @endif
                                                        @error('image')
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
                                            <a type="button" href="#updateSlideModal" data-toggle="modal"
                                                data-target="#updateSlideModal"
                                                wire:click="editSlide({{ $slide->id }})" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>
                                            <a type="button" href="#deleteSlideModal" data-toggle="modal"
                                                data-target="#deleteSlideModal"
                                                wire:click="deleteSlide({{ $slide->id }})" class="delete"
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
                                        <button style="color:white;" type="button" class="btn-close mt-1"
                                            data-dismiss="alert" wire:click="closeModal" aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Name Of Slide</label>
                                    <input type="text" class="form-control" wire:model.defer="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" wire:model.defer="edit_image">
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
            <div wire:ignore.self id="updateSlideModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">
                        <form wire:submit.prevent="updateSlide">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Update Slide</h4>
                                <button type="button" id="" class="close" wire:click="closeModal"
                                    data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="updateSlide" class="loading-bar">
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
                                    <label>Name Of Slide</label>
                                    <input type="text" class="form-control" wire:model.defer="name" required>
                                </div>
                                <div class="form-group">

                                    <label>Image</label>
                                    <input type="file" class="form-control" wire:model.defer="edit_image">
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
            <div wire:ignore.self id="deleteSlideModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">">
                    <div class="modal-content">

                        <form wire:submit.prevent="destroySlide">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Slide</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="destroySlide" class="loading-bar">
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
