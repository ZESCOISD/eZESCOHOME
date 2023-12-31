<div wire:ignore.self class="modal fade" id="addContactGroupModal" tabindex="-1" role="dialog"
     aria-labelledby="addContactGroupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContactGroupLabel">Enter Contact Group details</h5>
                <button id="modal-close" type="button" class="close"
                        wire:click="closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading wire:target="saveContactGroup" class="loading-bar"></div>

            <div class="modal-body">
                @if (session()->has('save_successful'))
                    <div id="dismiss"
                         class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                         role="alert" style="border:none; font-size: 12px;">
                        <p class="mt-3">{{ session('save_successful') }}</p>
                        <button style="color:white;" type="button"
                                class="btn-close mt-1" wire:click="closeModal"
                                data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                
                <form wire:submit.prevent="saveContactGroup">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control mb-1"
                               wire:model.defer="name" id="name" placeholder="name"
                               required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control mb-1"
                               wire:model.defer="description" id="description" placeholder="Code"
                               required>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="office_address">Office Number</label>
                        <input type="text" class="form-control mb-1"
                               wire:model.defer="office_address" id="office_address" placeholder="Office Number"
                               required>
                        @error('office_address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control mb-1"
                               wire:model.defer="location" id="location" placeholder="Location e.g Lusaka HQ"
                               required>
                        @error('location')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-1"
                               wire:model.defer="email" id="email" placeholder="Email"
                               required>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone/Extension</label>
                        <input type="text" class="form-control mb-1"
                               wire:model.defer="phone" id="phone" placeholder="Phone/Extension"
                               required>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="modal-footer mt-3" id="modal-footer">
                        <button style="background-color: #1bad6c" type="submit"
                                class="btn btn-danger">submit
                        </button>
                        <button style="background-color: rgb(153, 150, 150)"
                                type="button" wire:click="closeModal"
                                class="btn btn-secondary" data-dismiss="modal">Close
                        </button>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
