<!-- Delete Modal HTML -->
<div wire:ignore.self id="deleteContactGroupModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="destroyContactGroup">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Delete Contact Group</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                </div>
                <div wire:loading wire:target="destroyContactGroup" class="loading-bar"></div>

                <div class="modal-body">
                    @if (session()->has('delete_successful'))
                        <div class="alert alert-success mt-3 text-bg-success p-2 text-center"
                             style="border:none; font-size: 12px;">
                            <p class="mt-3">{{ session('delete_successful') }}</p>
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
