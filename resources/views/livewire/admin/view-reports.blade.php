<div>
    @push('custom-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/adminmanagement.css">  
    @endpush

    <body id="report-body">  
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
                        @role('admin')
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('status.manage') }}'"> Status</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('roles.manage') }}'">Roles</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('permissions.manage') }}'">Permissions</div>
                        <div id="login-nav-bar-links" type="button"  onclick=" window.location='{{ route('users.manage') }}'">Users</div>
                        @else
                        <div id="login-nav-bar-links" type="button" onclick=" window.location='{{ route('users.manage') }}'">Profile</div>
                        @endrole
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
           Reports
          </div>
          <div class="row">
            <div class="col">
                <div id="overall-accessed-card" class="card shadow m-3">
                    <div class="card-header">
                        <h5>Overall Accessed System</h5> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>System name</p>
                            </div>
                            <div class="col-sm-6">
                                @if($frequentlyAccessed == null)
                                   <p></p>
                                @else
                                <p>{{$frequentlyAccessed->name}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Number of clicks</p>
                            </div>
                            <div class="col-sm-6">
                                @if($frequentlyAccessed == null)
                                   <p></p>
                                @else
                                <p>{{$frequentlyAccessed->number_of_clicks}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="highest-traffic-today" class="card shadow m-3">
                    <div class="card-header">
                        <h5>Highest traffic today</h5> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>system name</p>
                            </div>
                            <div class="col-sm-6">
                                @if($frequentlyAccessedToday==null)
                                <p>No system with traffic</p>
                                @else
                                <p>{{$frequentlyAccessedToday->product_name }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- <hr> --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Number of clicks</p>
                            </div>
                            <div class="col-sm-6">
                                @if($frequentlyAccessedToday==null)
                                <p>No system with traffic</p>
                              @else
                              <p>{{$frequentlyAccessedToday->number_of_clicks }}</p>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="overall-least-accessed" class="card shadow m-3">
                    <div class="card-header">
                        <h5>Overall Least Accessed</h5> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>System name</p>
                            </div>
                            <div class="col-sm-6">

                                @if($leastAccessed == null )
                                    <p></p>
                                @else
                                <p>{{$leastAccessed->name}}</p>
                                @endif

                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Number of clicks</p>
                            </div>
                            <div class="col-sm-6">
                                @if($leastAccessed == null )
                                    <p></p>
                                @else
                                <p>{{$leastAccessed->number_of_clicks}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="overall-active-systems" class="card shadow m-3">
                    <div class="card-header">
                        <h5>Overall Active Systems</h5> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Total</p>
                            </div>
                            <div class="col-sm-6">
                                @if($totalActiveSystems == null )
                                    <p></p>
                                @else
                                    <p>{{$totalActiveSystems}}</p>
                                @endif
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <hr>
          
         <form wire:submit.prevent="searching">
            @csrf
            <div class="row m-2">
                <div class="col-lg-2 mt-3">
                        <select class="form-select" wire:model.defer="selectedReportType" aria-label="Default select example" required>
                            <option  value="">-- Select Report Type --</option>
                            <option value="1">System Report</option>
                            <option value="2">Frequently Accessed</option>
                            <option value="3">Active System's</option>
                            <option value="4">Deactivated System's</option>
                            <option value="5">System's in Production</option>
                            <option value="6">System's in Development</option>
                            <option value="7">Decommissioned System's</option>
                            <option value="8">System Developer</option>
                            <option value="9">Suggestions</option>
                          </select>
                </div>
                <div class="col-lg-2 mt-3">
                    <input style="width: 250px" type="text" id="report-serach-field" wire:model.defer="search" class="form-control" placeholder="Search...">
                    
                </div>

                <div class="col-lg-2 mt-3">

                    <button style="width: 150px; background-color:cornflowerblue; color:white;" type="submit" id="submitButton"  wire:click="searching" class="form-control">search</button>
                </div>
                <div class="col-lg-6 d-flex jutify-content-end align-items-end">
                    <div id="date_start">
                        <label for="start_date">From</label>
                        <input type="date" id="start_date" wire:model.defer="from" class="form-control ">
                       
                    </div>
                    <div id="date_end">
                       
                        <label for="end_date">To</label>
                        <input type="date" id="end_date" wire:model.defer="to" class="form-control">
                    </div>
                </div>
              </div>
         </form>
          <hr>
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm responsive" cellspacing="0" width="100%">
                        <thead>
                            @if($selectedReportType === "0")

                            <tr id="table-header">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                            @elseif($selectedReportType === "9")
                            <tr id="table-header">
                                <th>Suggestion id</th>
                                <th>Subject</th>
                                <th>System Name</th>
                                <th>Suggestion</th>
                                <th>View suggestion</th>
                            </tr>
                            @else
                            <tr id="table-header">
                                <th>product id</th>
                                <th>name</th>
                                <th>number of clicks</th>
                                <th>url</th>
                                <th>lead developer</th>
                                <th>short description</th>
                                <th>date launched</th>
                                <th>View</th>
                            </tr>
                            @endif
                        </thead>
                        <tbody >
                                                            
                            @if ($selectedReportType === "0")
                            <tr>
                                <td class="text-center" colspan="16">No records found</td>
                            </tr>
                            @elseif($selectedReportType === "9")
                                   @if(count($suggestions) > 0)
                                        @foreach ($suggestions as $suggestion)
                                        <tr>
                                            <td>{{$suggestion->id}}</td>
                                            <td>{{$suggestion->subject}}</td>
                                            <td>{{$suggestion->system_name}}</td>
                                            <td class="text-truncate" style="max-width: 80px;">{{$suggestion->suggestion}}</td>
                                            <td>
                                                <a type="button" href="#viewSuggestionModal" data-toggle="modal" data-target="#viewSuggestionModal"
                                                    wire:click.prevent="viewSuggestion({{$suggestion->id}})"><i class="bi bi-eye-fill"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="16">No records found</td>
                                    </tr>
                                    @endif
                            @else
                             @if(count($products) > 0)
                                            @foreach ($products as $product)
                                            <tr>
                                                <td>{{$product['product_id']}}</td>
                                                <td>{{$product['name']}}</td>
                                                <td>{{$product['number_of_clicks']}}</td>
                                                <td>{{$product['url']}}</td>
                                                <td>{{$product['lead_developer']}}</td>
                                                <td class="text-truncate" style="max-width: 80px;">{{$product['short_description']}}</td>
                                                <td>{{$product['date_launched']}}</td>
                                                <td>
                                                    <a type="button" href="#viewModal" data-toggle="modal" data-target="#viewModal" wire:click.prevent="viewItem({{$product['product_id']}})"><i class="bi bi-eye-fill"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                     @else
                                    <tr>
                                        <td class="text-center" colspan="16">No records found</td>
                                    </tr>
                                @endif
                            @endif    

                        </tbody>
                      </table>
                      <div class="clearfix">
                        {{-- @if($suggested)
                            {{$suggested->link()}}
                        @endif --}}
                    </div>
                </div>
              </div>
          </div>
          


           <div wire:ignore.self id="viewModal" class="modal fade">
            <div style="max-width: 80%;" id="viewModal-dialog" class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" id="viewModal-content">
                    <form wire:submit.prevent="viewItem">
                        @csrf
                        <div style="background-color:cadetblue;" class="modal-header">						
                            <h3 style="color:white;" class="modal-title">Item Details</h3>
                        </div>
                        <div  class="modal-body text-center">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-filter-square-fill"></i>
                                        <h5>Product name</h5>
                                        <input style="width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="name" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-collection-fill"></i>
                                        <h5>Category</h5>
                                        <input style="overflow-x: scroll;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="category_name" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-cloud-fill"></i>
                                        <h5>Product Status</h5>
                                        <input style="overflow-x: scroll;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="status_name" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-person-badge-fill"></i>
                                        <h5>Lead Developer</h5>
                                        <input style="width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="lead_developer" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-link"></i>
                                        <h5>Product Url</h5>
                                        <input style="overflow-x: scroll; width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="url" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-box-arrow-up-right"></i>
                                        <h5>Test Url</h5>
                                        <input style="width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="test_url" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-info-circle-fill"></i>
                                        <h5>Short Description</h5>
                                        <textarea style="width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="short_description" readonly>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-file-text-fill"></i>
                                        <h5>Long Description</h5>
                                        <textarea style="width:300px;" class="text-center p-2" id="view-item-inputs" type="text" form-group wire:model.prevent="long_description" readonly>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        {{-- <div class="row">
                           
                        </div>

                        <hr> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-calendar-check-fill"></i>
                                        <h5>Date launched</h5>
                                        <input id="view-item-inputs" class="text-center p-2" type="text" form-group wire:model.prevent="date_launched" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" mb-2">
                                    <div class="-body">
                                        <i style="font-size:25px;" class="bi bi-calendar-x-fill"></i>
                                        <h5>Date Decommissioned</h5>
                                        <input id="view-item-inputs" class="text-center p-2" type="text" form-group wire:model.prevent="date_decommissioned" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="modal-footer">
                            <input style="background-color: rgb(153, 150, 150)" type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
          
        {{-- end of Viewing element modal  --}}
    </body>

</div>
@push('custom-scripts')
<script src="{{asset('js/adminmanagement.js')}}"></script> 
@endpush