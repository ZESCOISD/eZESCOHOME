{{-- @livewire('livewire-pagination') --}}

@push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/adminmanagement.css">
@endpush

<div>

    <body id="manage-body">
    
    @include('layouts.admin_nav')

        <div class="text-center" id="admin-menu-text">
            Quote of the Day
        </div>
        <div class="container-fluid">

            <div class="container mt-5">
                <div class="table-wrapper">
                    <div class="table-title mb-5">
                        <div class="row">

                            <div class="col-sm-4">
                                <h2>Manage <b>Quote's</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control border-end-0 border rounded-pill"
                                    wire:model.defer="search_quote" type="search" placeholder="Search..."
                                    id="search-input">

                                <span class="input-group-append">
                            </div>
                            <div class="col-sm-4">

                                @can('create')
                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addQuoteModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                            Quote</span></button>
                                @endcan

                                @role('admin')
                                    <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addQuoteModal"><i class="material-icons">&#xE147;</i> <span>Add New
                                            Quote</span></button>
                                @endrole
                                <div wire:ignore.self class="modal fade" id="addQuoteModal" tabindex="-1"
                                    role="dialog" aria-labelledby="addQuoteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 80%;"
                                        role="document">
                                        <div class="modal-content">
                                            <div style="background-color:cadetblue; color:white;"
                                                class="modal-header">
                                                <h5 class="modal-title text-white" id="addQuoteModalLabel">Enter quote
                                                    details</h5>
                                                <button id="modal-close" wire:click="closeModal" type="button"
                                                    class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div wire:loading wire:target="saveQuote" class="loading-bar"></div>
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
                                                <form wire:submit.prevent="saveQuote">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="quote">Quote</label>
                                                        <textarea class="form-control" placeholder="Quote of the Day" name="quote" id="quote" cols="30"
                                                            rows="10" wire:model.defer="quote">
                                                            Quote
                                                        </textarea>
                                                        @error('quote')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Author">Author</label>
                                                        <input type="text" class="form-control mb-1"
                                                            wire:model.defer="author" placeholder="Author">
                                                        @error('author')
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
                                <th>Quote</th>
                                <th>Author</th>
                                <th>Date Created</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse($quotes as $quote)
                                <tr>
                                    <td>
                                        <span class="custom-checkbox">
                                            <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                            <label for="checkbox1"></label>
                                        </span>
                                    </td>
                                    <td>{{ $quote->id }}</td>
                                    <td class="text-truncate" style="max-width: 80px;">
                                        {{ $quote->quote }}</td>
                                    <td>{{ $quote->author }}</td>
                                    <td>{{ $quote->created_at }}</td>

                                    <td>
                                        @can('update')
                                            <a type="button" href="#updateQuoteModal" data-toggle="modal"
                                                data-target="#updateQuoteModal"
                                                wire:click="editQuote({{ $quote->id }})" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>
                                        @endcan

                                        @role('admin')
                                            <a type="button" href="#updateQuoteModal" data-toggle="modal"
                                                data-target="#updateQuoteModal"
                                                wire:click="editQuote({{ $quote->id }})" class="edit"><i
                                                    class="material-icons" data-toggle="tooltip"
                                                    title="Edit">&#xE254;</i></a>
                                        @endrole

                                        @can('delete')
                                            <a type="button" href="#deleteQuoteModal" data-toggle="modal"
                                                data-target="#deleteQuoteModal"
                                                wire:click="deleteQuote({{ $quote->id }})" class="delete"
                                                data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                    title="Delete">&#xE872;</i></a>
                                        @endcan

                                        @role('admin')
                                            <a type="button" href="#deleteQuoteModal" data-toggle="modal"
                                                data-target="#deleteQuoteModal"
                                                wire:click="deleteQuote({{ $quote->id }})" class="delete"
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

                        {{ $quotes->links() }}

                    </div>
                </div>
            </div>

            <!-- Edit Modal HTML -->
            <div wire:ignore.self id="editQuoteModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">

                        <form wire:submit.prevent="editQuote">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Quote</h4>
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
                                    <label>Quote</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="10"
                                        wire:model.defer="quote">
                                        Quote
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" class="form-control" wire:model.defer="author">
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
            <div wire:ignore.self id="updateQuoteModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">>
                    <div class="modal-content">
                        <form wire:submit.prevent="updateQuote">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Update Quote</h4>
                                <button type="button" id="" class="close" wire:click="closeModal"
                                    data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="updateQuote" class="loading-bar">
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
                                    <label>Quote</label>
                                    <textarea class="form-control" name="" id="" cols="30" rows="10"
                                        wire:model.defer="quote">
                                        Quote
                                    </textarea>

                                </div>
                                <div class="form-group">

                                    <label>Author</label>
                                    <input type="text" class="form-control" wire:model.defer="author">
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
            <div wire:ignore.self id="deleteQuoteModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">">
                    <div class="modal-content">

                        <form wire:submit.prevent="destroyQuote">

                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Quote</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div wire:loading wire:target="destroyQuote" class="loading-bar">
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
                                <p id="del-status">Are you sure you want to delete this Quote?
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
