
{{-- Updates the modal --}}
<div wire:ignore.self id="updateProductModal" class="modal fade " tabindex="-1" role="dialog"
     aria-labelledby="updateProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 80%;" role="document">
        <div class="modal-content">
            <div style="background-color:cadetblue;" class="modal-header">
                <h5 style="color:white;" class="modal-title" id="addProductModalLabel">Update product
                    details</h5>
            </div>
            <form wire:submit.prevent="updateProduct">
                @csrf
                <div wire:loading wire:target="updateProduct" class="loading-bar"></div>

                <div class="modal-body">

                    <span class="text-success mt-3">DETAILS</span>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model.defer="name"
                                       required name="name" placeholder="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="category_id">Category<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="category_id" required
                                        wire:model.defer="category_id">
                                    <option value="0">Select an Option</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="icon_Link">Product Icon</label>
                                <input type="file" class="form-control" name="icon_link"
                                       wire:model.defer="icon_link" placeholder="Product Icon">
                                @error('icon_link')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="system_cover_image">Cover Photo</label>
                                <input type="file" class="form-control" name="system_cover_image"
                                       wire:model.defer="system_cover_image"
                                       placeholder="system cover image">
                                @error('system_cover_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <div class="form-group mt-2">
                                <label for="status_code">Product State <span class="text-danger">*</span></label>
                                <select class="form-control" id="status_code" required
                                        wire:model.defer="status_code">
                                    <option value="0">Select an Option</option>
                                    @foreach ($statusfields as $statusfield)
                                        <option value="{{ $statusfield->code }}">
                                            {{ $statusfield->name }}</option>
                                    @endforeach
                                </select>
                                @error('status_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8 mt-3">
                            <div class="form-group ">
                                <label for="url">Production Url <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" name="url" required
                                       wire:model.defer="url" placeholder="url">
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mt-2">
                            <div class="form-group ">
                                <label for="short_description">Short Description <span
                                        class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="short_description"
                                          wire:model.defer="short_description"
                                          required placeholder="Short Description"></textarea>
                                @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mt-2">
                            <div class="form-group ">
                                <label for="long_description">Long Description <span
                                        class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" name="long_description"
                                          wire:model.defer="long_description"
                                          required placeholder="Long Description"></textarea>
                                @error('long_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mt-2">
                            <div class="form-group ">
                                <label for="dev_launch_date">Development Start Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" required
                                       wire:model.defer="dev_launch_date" placeholder="Dev Date Launch">
                                @error('dev_launch_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mt-2">
                            <div class="form-group ">
                                <label for="date_launched">Production Launch Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" required
                                       wire:model.defer="date_launched" placeholder="Date Launched">
                                @error('date_launched')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mt-2">
                            <div class="form-group dates ">
                                <label for="date_decommissioned">Date Decommissioned</label>
                                <input type="date" class="form-control"
                                       wire:model.defer="date_decommissioned"
                                       placeholder="Date Decommissioned">
                                @error('date_decommissioned')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <span class="text-success mt-3">COST</span>
                    </div>
                    <div class="row">

                        <div class="col-md-4 mt-3">
                            <div class="form-group ">
                                <label for="market_value">$ Market Value <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="market_value"
                                       wire:model.defer="market_value" required
                                       placeholder="market value in dollars">
                                @error('market_value')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group ">
                                <label for="project_cost">$ Project Cost</label>
                                <input type="number" class="form-control" name="project_cost"
                                       wire:model.defer="project_cost"
                                       placeholder="project cost in dollars">
                                @error('project_cost')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="form-group ">
                                <label for="cost_saving">$ Cost Savings</label>
                                <input type="number" class="form-control" name="cost_saving"
                                       wire:model.defer="cost_saving"
                                       placeholder="cost saving in dollars">
                                @error('cost_saving')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <span class="text-success mt-3">IP ADDRESSES</span>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div class="form-group ">
                                <label for="test_ip_address">Test IP</label>
                                <input type="text" class="form-control" name="test_ip_address"
                                       wire:model.defer="test_ip_address"
                                       placeholder="10.0.0.0">
                                @error('test_ip_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mt-3">
                            <div class="form-group ">
                                <label for="prod_ip_address">Prod IP</label>
                                <input type="text" class="form-control" name="prod_ip_address"
                                       wire:model.defer="prod_ip_address"
                                       placeholder="10.0.0.0">
                                @error('prod_ip_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group ">
                                <label for="public_ip_address">Public IP</label>
                                <input type="text" class="form-control" name="public_ip_address"
                                       wire:model.defer="public_ip_address"
                                       placeholder="10.0.0.0">
                                @error('public_ip_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mt-3">
                            <div class="form-group ">
                                <label for="dr_ip_address">Disaster Recovery IP</label>
                                <input type="text" class="form-control" name="dr_ip_address"
                                       wire:model.defer="dr_ip_address"
                                       placeholder="10.0.0.0">
                                @error('dr_ip_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <span class="text-success mt-3">TUTORIALS</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="video">Tutorial Video</label>
                                <input type="file" class="form-control" name="video"
                                       wire:model.defer="video" placeholder="Tutorial Video">
                                @error('video')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="user_manual">User guide</label>
                                <input class="form-control" type="file" name="user_manual"
                                       accept=".pdf" wire:model.defer="user_manual"
                                       placeholder="User guide">
                                @error('user_manual')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="test_url">Test Url <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" name="test_url" required
                                       wire:model.defer="test_url" placeholder="Test Url">
                                @error('test_url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group ">
                                <label for="tutorial_url">Tutorial Url</label>
                                <input type="url" class="form-control" name="tutorial_url"
                                       wire:model.defer="tutorial_url" placeholder="Tutorial Url">
                                @error('tutorial_url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @if (session()->has('update_successful'))
                                <div id="dismiss"
                                     class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                                     role="alert" style="border:none; font-size: 12px;">
                                    <p class="mt-3">{{ session('update_successful') }}</p>
                                    <button style="color:white;" type="button" class="btn-close mt-1"
                                            wire:click="closeModal" data-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="modal-footer text-center d-flex ">
                    <div class="row">
                        <div class="col-12">
                    <button style="background-color: #1bad6c" type="submit"
                            class="btn btn-danger">Update
                    </button>
                    <button style="background-color: rgb(153, 150, 150)" type="button"
                            wire:click="closeModal" class="btn btn-secondary"
                            data-dismiss="modal">Close
                    </button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
{{-- end of update modal --}}

