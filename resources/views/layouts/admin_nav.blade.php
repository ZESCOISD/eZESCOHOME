<nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-start align-items-start">
                        <a class="navbar-brand" onclick=" window.location='{{ route('admin-menu') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50"
                                 class="d-inline-block align-text-top"></a>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('admin-menu') }}'"> Home
                        </div>
                        <div id="login-nav-bar-links" type="button" class='active'
                             onclick=" window.location='{{ route('categories.manage') }}'"> Categories
                        </div>
                        @role('admin')
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('status.manage') }}'">Status
                        </div>
                        <div id="login-nav-bar-links" type="button"
                         onclick=" window.location='{{ route('products.manage') }}'"> Products
                    </div>
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('roles.manage') }}'">Roles
                        </div>
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('permissions.manage') }}'">Permissions
                        </div>
                        <div id="login-nav-bar-links" type="button"
                             onclick=" window.location='{{ route('users.manage') }}'">Users
                        </div>
                        @else
                            <div id="login-nav-bar-links" type="button"
                                 onclick=" window.location='{{ route('users.manage') }}'">Profile
                            </div>
                            @endrole
                            <div id="login-nav-bar-links" type="button"
                                 onclick=" window.location='{{ route('reports.manage') }}'"> Reports
                            </div>
                            <div id="login-nav-bar-links" class="dropdown">
                                <div class="dropdown-toggle" id="dropdownMenuButton" type="button" aria-haspopup="true"
                                     data-toggle="dropdown" aria-expanded="false">Utilties
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('notices.manage') }}'">Notices</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('events.manage') }}'">Events</a>
                                    <a class="dropdown-item"
                                       onclick=" window.location='{{ route('contact.group.manage') }}'">Contact Groups</a>
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
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 d-flex justify-content-end align-items-end">
                        <div id="logout" type="button" wire:click="logout"> Logout</div>
                    </div>
                </div>
            </div>
        </nav>