<div>
    @push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href='/css/adminmanagement.css'>  
    @endpush
    @role('admin')

    <body id="manage-body">
       
        <nav class="navbar navbar-light bg-light">
        <div wire:loading wire:target="logout" class="loading-bar"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-start align-items-start">
                        <a class="navbar-brand" onclick=" window.location='{{ route('admin-menu') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50" class="d-inline-block align-text-top"></a>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('categories.manage') }}'"> Categories</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('products.manage') }}'"> Products</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('roles.manage') }}'">Roles</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('permissions.manage') }}'">Permissions</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('users.manage') }}'">Users</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('reports.manage') }}'"> Reports</div>
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
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-end align-items-end">
                        <div id="logout" type="button" wire:click="logout"> Logout</div>
                    </div>
                </div>
           </div>
           </nav>
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
                            <input class="form-control border-end-0 border rounded-pill" wire:model="search" type="search" placeholder="Search..." id="search-input">
                            <span class="input-group-append">
                        </div>
                        <div class="col-sm-4">
                            {{-- <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a> --}}
                            <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStatusModal"><i class="material-icons">&#xE147;</i> <span>Add New Status</span></button>
    
                            <div wire:ignore.self  class="modal fade"  id="addStatusModal"  tabindex="-1" role="dialog" aria-labelledby="addStatusLabel" aria-hidden="true">
                            <div  class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStatusLabel">Enter status details</h5>
                                    <button id="modal-close" type="button" class="close" wire:click="closeModal" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <div wire:loading wire:target="saveStatus" class="loading-bar"></div>

                                <div  class="modal-body">
                                    @if (session()->has('savesuccessful'))
                                    <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                                        <p class="mt-3">{{ session('savesuccessful') }}</p>
                                        <button style="color:white;" type="button" class="btn-close mt-1" wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                                        </button>
                                    </div>
                                    @endif	
                                    <form wire:submit.prevent="saveStatus">
                                        @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control mb-1" wire:model.defer="name" id="name" placeholder="name" required>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="modal-footer mt-3" id="modal-footer">
                                        <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >submit</button>
                                            <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    
    
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
                        <th>Status id</th>
                        <th>Name </th>
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
                            <td>{{$status->status_id}}</td>
                            <td>{{$status->name}}</td>
                            <td>{{$status->created_at}}</td>
                            <td>{{$status->updated_at}}</td>
                            <td>
                                <a href="#editStatusModal" class="edit" data-toggle="modal" data-target="#updateStatusModal" wire:click="editStatus({{$status->status_id}})"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteStatusModal" class="delete" data-toggle="modal" data-target="#deleteStatusModal" wire:click="deleteStatus({{$status->status_id}})"><i class="material-icons" data-toggle="tooltip" wire:click="closeModal" title="Delete">&#xE872;</i></a>
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
    
                <!-- Edit Modal HTML -->
    <!-- Edit Modal HTML -->
        <div wire:ignore.self  class="modal fade"  id="editStatuModal"  tabindex="-1" role="dialog" aria-labelledby="editStatuModalLabel" aria-hidden="true">
            <div  class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStatuModalLabel">Update status</h5>
                    <button id="modal-close" type="button" class="close" wire:click="closeModal"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div  class="modal-body">
                   
                    <form wire:submit.prevent="editStatus">
                        @csrf
                        @if (session()->has('updatesuccessful'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('updatesuccessful') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @endif	
                        <label for="name">name</label>
                        <input type="text" class="form-control mb-1" wire:model.defer="name" id="name" placeholder="name" required>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                       </div>
                    
                       <div class="modal-footer mt-3" id="modal-footer">
                        <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >Update</button>
                        <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>

    
                       </div>
                    </form>
                </div>
            </div>
                </div>
            </div>
    
    
            {{-- Updates the modal --}}
            <div wire:ignore.self  class="modal fade"  id="updateStatusModal"  tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                <div  class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStatusModalLabel">Update status</h5>
                        <button id="modal-close" type="button" class="close" wire:click="closeModal"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div wire:loading wire:target="updateStatus" class="loading-bar"></div>

                    <div  class="modal-body">
                        @if (session()->has('updatesuccessful'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('updatesuccessful') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @endif	
                        <form wire:submit.prevent="updateStatus">
                            @csrf
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control mb-1" wire:model.defer="name" id="name" placeholder="name" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="modal-footer mt-3" id="modal-footer">
                            <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >Update</button>
                            <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    
        
                        </div>
                        </form>
                    </div>
                </div>
                    </div>
                </div>
            {{-- end of update modal --}}
    
            <!-- Delete Modal HTML -->
            <div wire:ignore.self id="deleteStatusModal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="destroyStatus">
                            @csrf
                            <div class="modal-header">						
                                <h4 class="modal-title">Delete Status</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                        <div wire:loading wire:target="destroyStatus" class="loading-bar"></div>

                            <div class="modal-body">
                                @if (session()->has('deletesuccessful'))
                                <div class="alert alert-success mt-3 text-bg-success p-2 text-center" style="border:none; font-size: 12px;">
                                    <p class="mt-3">{{ session('deletesuccessful') }}</p></div>
                                    <style> #del{ display: none; } #del-status{ display: none; }</style>
                            @endif					
                                <p id="del-status">Are you sure you want to delete this Record?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input id="del" style="background-color: red; color:white;" type="submit" class="btn btn-danger" value="Delete">
                                <input style="background-color: grey; color:white;"  type="button" class="btn btn-default" wire:click="closeModal" data-dismiss="modal" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
             <!-- end of row -->
    
            </div>
        </div>
       
    </body>
    @else
    <div class="row d-flex justify-content-sm-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
            <div id="access-denied-card" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                             <img id="img-access-denied" class="img-responsive" src="{{asset('/img/access-denied.png')}}" alt="access-denied">
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

    <script src="{{asset('/js/adminmanagement.js')}}"></script> 
    
    @endpush
</div>
