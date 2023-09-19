<div>
    <div>
        @push('custom-styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href='/css/adminmanagement.css'>
        @endpush
        @role('admin')
        <body id="manage-body">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-start align-items-start">
                            <a class="navbar-brand" onclick=" window.location='{{ route('admin-menu') }}'">
                                <img src="/img/Zesco.png" alt="" width="125" height="50" class="d-inline-block align-text-top"></a>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                            <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('categories.manage') }}'"> Categories</div>
                            <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('products.manage') }}'"> Products</div>
                            <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('status.manage') }}'"> Status</div>
                            <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('permissions.manage') }}'"> Permissions</div>
                            <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('users.manage') }}'"> Users</div>
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
              <div class="text-center" id="admin-menu-text">
               Roles
              </div>
            <div class="container">
                <div class="table-wrapper mt-5">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-4">
                                <h2>Manage <b>roles</b></h2>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control border-end-0 border rounded-pill" wire:model="search" type="search" placeholder="Search..." id="search-input">
                                <span class="input-group-append">
                            </div>
                            <div class="col-sm-4">
                                 <button id="btn-add-new" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal"><i class="material-icons">&#xE147;</i> <span>Add New Role</span></button>

                                <div wire:ignore.self  class="modal fade"  id="addRoleModal"  tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true">
                                <div  class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addRoleModalLabel">Enter role details</h5>
                                        <button id="modal-close" type="button" class="close" wire:click="closeModal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                  <div wire:loading wire:target="saveRole" class="loading-bar"></div>

                                    <div  class="modal-body">

                                        @if (session()->has('savesuccessful'))

                                            <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                                                <p class="mt-3">{{ session('savesuccessful') }}</p>
                                                <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                                                </button>
                                            </div>
                                        @endif
                                        <form wire:submit.prevent="saveRole">
                                            @csrf
                                        <div class="form-group">
                                            <label for="name">Role name</label>
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
                            <th>Role id</th>
                            <th>Access Type </th>
                            <th>Guard Name</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->guard_name}}</td>
                                <td>{{$role->created_at}}</td>
                                <td>{{$role->updated_at}}</td>
                                <td>
                                    <a wire:ignore href="#editRoleModal" class="edit" data-toggle="modal" data-target="#updateRoleModal" wire:click="editRole({{$role->id}})"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a wire:ignore href="#deleteRoleModal" class="delete" data-toggle="modal" data-target="#deleteRoleModal" wire:click="deleteRole({{$role->id}})"><i class="material-icons" data-toggle="tooltip" wire:click="closeModal" title="Delete">&#xE872;</i></a>
                                    <a wire:ignore href="#viewRoleModal" class="view" data-toggle="modal" data-target="#assignRoleModal" wire:click="viewRole({{$role->id}})"><i class="bi bi-eye-fill"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="7">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="clearfix">
                        {{ $roles->links() }}
                    </div>

                    <!-- Edit Modal HTML -->
        <!-- Edit Modal HTML -->
            <div wire:ignore.self  class="modal fade"  id="editRoleModal"  tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
                <div  class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Update role</h5>
                        <button id="modal-close" type="button" class="close" wire:click="closeModal"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div  class="modal-body">
                        @if (session()->has('updatesuccessful'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('updatesuccessful') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                        <form wire:submit.prevent="editRole">
                            @csrf
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control mb-1" wire:model.defer="name" id="name" placeholder="name" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="modal-footer mt-3" id="modal-footer">
                            <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >update</button>
                            <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
                    </div>
                </div>

                <!-- View Modal HTML -->
            <div wire:ignore.self  class="modal fade"  id="viewRoleModal"  tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
                <div  class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Role Details</h5>
                        <button id="modal-close" type="button" class="close" wire:click="closeModal"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div  class="modal-body">
                        @if (session()->has('givepermissionsuccessful'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('givepermissionsuccessful') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @endif

                        {{-- <div>
                            <h5>Current Permissions for Role</h5>
                            @if ($role->permissions)
                                 @foreach ($role->permissions as $role_permission)
                                   <p>{{$role_permission->name}}</p>
                                 @endforeach
                            @else
                                 <p style="font-size: 12px;">No permissions attached to this Role</p>
                            @endif
                        </div> --}}
                        <hr>
                        <form wire:submit.prevent="givePermission">
                            @csrf

                            <div><h5>Assign Permission to Role</h5></div>

                            <div class="form-group m-2">
                                <select style="width:250px; height:40px;" name="permission_name" id="permissions" wire:model.defer="permission_id">
                                    <option value="0">-- Select Permission --</option>
                                    @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endforeach
                                </select>
                                @error('permission_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        <div class="modal-footer mt-3" id="modal-footer">
                            <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >Assign</button>
                            <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>

                </div>
                    </div>
                </div>


                        <!-- Add Permission -->
            <div wire:ignore.self  class="modal fade"  id="assignRoleModal"  tabindex="-1" role="dialog" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
                <div  class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="assignRoleModalLabel">Manage Permissions To Role</h5>

                        <button id="modal-close" type="button" class="close"  data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div wire:loading wire:target="givePermission" class="loading-bar"></div>
                    <div wire:loading wire:target="sync_Permission" class="loading-bar"></div>
                    {{-- <div wire:loading wire:target="revokePermission" class="loading-bar"></div> --}}

                    <div  class="modal-body">


                        @if (session()->has('givepermissionsuccessful'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('givepermissionsuccessful') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @elseif(session()->has('message'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-danger  p-2 text-center fade show"
                            role="alert" style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('message') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @elseif(session()->has('nopermission'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-danger  p-2 text-center fade show" role="alert"
                            style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('nopermission') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @elseif(session()->has('empty'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 p-2 text-center fade show" role="alert"
                            style="border:none; background-color:orange; font-size: 12px;">
                            <p class="mt-3">{{ session('empty') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        @elseif(session()->has('syncsuccess'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert"
                            style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('syncsuccess') }}</p>
                            <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert"
                                aria-label="Close">
                            </button>
                        </div>
                        @elseif(session()->has('syncerror'))
                        <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-danger  p-2 text-center fade show" role="alert"
                            style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('syncsuccess') }}</p>
                            <button style="color:rgb(255, 255, 255);" type="button" class="btn-close mt-1" data-dismiss="alert"
                                aria-label="Close">
                            </button>
                        </div>
                        @endif

                            {{-- @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission => )
                            <p>{{$role_permission->name}}</p>
                            @endforeach
                            @else
                            <p style="font-size: 12px;">No permissions attached to this Role</p>
                            @endif --}}

                        {{-- <div>
                            <h5>Current Permissions for Role</h5>
                            @if ($current_role == [])
                              <p style="font-size: 12px;">No Permissions Attached to Role</p>
                            @else
                                    @foreach($current_role as $role_permission)

                                    <div>

                                        <ul class="horizontal-list">

                                            <li><span style="font-size: 20px; color:rgb(255, 166, 0);">{{$role_permission->name}}</span></li>
                                            <a wire:ignore href="#deletePermissionModal" class="delete text-center" data-toggle="modal"
                                                data-target="#deletePermissionModal"  wire:click="deletePermission({{$role_permission->id}})"><i
                                                    class="material-icons" data-toggle="tooltip" wire:click="closeModal" style="color: red;
                                                    margin-left:10px;" wire:change="$emit('viewUpdated', $event.target.role_id)"
                                                    title="Delete">&#xE872;</i></a>


                                        </ul>
                                    </div>


                                    @endforeach

                            @endif
                        </div> --}}


                        <div wire:ignore.self id="deletePermissionModal" class="modal fade">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 80%; max-width:" role="document">
                                <div class="modal-content">
                                    <form wire:submit.prevent="revokePermission">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Role</h4>
                                            <button type="button" class="close" wire:click="close"  data-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div wire:loading wire:target="revokePermission" class="loading-bar"></div>

                                        <div class="modal-body">
                                            @if (session()->has('revoked'))
                                            <div id="dismiss" class="alert alert-info mt-3 text-bg-success  text-center " role="alert"
                                                style="border:none; font-size: 12px;">
                                                <p class="mt-3">{{ session('revoked') }}</p>

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
                                            <input id="del" style="background-color: red; color:white;" type="submit" class="btn btn-danger"
                                                value="Delete">
                                            <input style="background-color: grey; color:white;" type="button" class="btn btn-default"
                                                wire:click="close"  data-dismiss="modal" value="Cancel">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <form wire:submit.prevent="givePermission">
                            @csrf

                            <div><h5>Assign Permission to Role</h5></div>

                            <div class="form-group m-2">
                                <select style="width:250px; height:40px;" name="permission_name" id="permissions" wire:model.defer="permission_id" required>
                                    <option value="0" required>-- Select Permission --</option>
                                    @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                                    @endforeach
                                </select><br>
                                    @error('permission_id')
                                    <span class="text-danger">Field is required</span>
                                    @enderror
                                <br>
                                <div style="display: flex; flex-direction:row;">
                                <p style="font-size: 20px; margin-right:10px; margin-top:7px;">Sync Permissions
                                    </p>
                                        {{-- <p style="font-size: 20px;">Sync</p> --}}
                                        <i type="button" wire:click="sync_Permission"  style="color: #1bad6c; font-weight:bold; font-size: 30px; "
                                            class="bi bi-arrow-repeat"></i>
                                    </div>


                                @error('message')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="modal-footer mt-3" id="modal-footer">
                                <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >Assign</button>
                                <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
                    </div>
                </div>

                {{-- Updates the modal --}}
                <div wire:ignore.self  class="modal fade"  id="updateRoleModal"  tabindex="-1" role="dialog" aria-labelledby="updateRoleModalLabel" aria-hidden="true">
                    <div  class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateRoleModalLabel">Update role</h5>
                            <button id="modal-close" type="button" class="close" wire:click="closeModal"  data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div wire:loading wire:target="updateRole" class="loading-bar"></div>

                        <div  class="modal-body">
                            @if (session()->has('updatesuccessful'))
                            <div id="dismiss" class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show" role="alert" style="border:none; font-size: 12px;">
                                <p class="mt-3">{{ session('updatesuccessful') }}</p>
                                <button style="color:white;" type="button" class="btn-close mt-1" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @endif
                            <form wire:submit.prevent="updateRole">
                                @csrf
                            <div class="form-group">
                                <label for="name">name</label>
                                <input type="text" class="form-control mb-1" wire:model.defer="name" id="name" placeholder="name" required>
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="modal-footer mt-3" id="modal-footer">
                                <button style="background-color: #1bad6c" type="submit" class="btn btn-danger" >update</button>
                                <button style="background-color: rgb(153, 150, 150)" type="button" wire:click="closeModal"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                        </div>
                    </div>
                {{-- end of update modal --}}

                <!-- Delete Modal HTML -->
                <div wire:ignore.self id="deleteRoleModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form wire:submit.prevent="destroyRole">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Role</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                               <div wire:loading wire:target="destroyRole" class="loading-bar"></div>

                                <div class="modal-body">
                                    @if (session()->has('deletesuccessful'))
                                    <div id="dismiss" class="alert alert-info mt-3 text-bg-success  text-center " role="alert" style="border:none; font-size: 12px;">
                                        <p class="mt-3">{{ session('deletesuccessful') }}</p>

                                    </div>
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

</div>
