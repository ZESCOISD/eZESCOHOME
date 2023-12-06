<div wire:ignore.self class="modal fade" id="viewContactGroupModal" tabindex="-1" role="dialog"
     aria-labelledby="viewContactGroupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewContactGroupLabel">Products attached to Contact Group</h5>
                <button id="modal-close" type="button" class="close"
                        wire:click="closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading wire:target="attachContactGroup" class="loading-bar"></div>

            <div class="modal-body">


            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Action </th>
                </tr>
                </thead>
                <tbody>
                @forelse( $myProducts as $product)
                    <tr>
                        <td>{{ $product->name ?? "-"}}</td>
                        <td>{{ $product->category->name ?? "-" }}</td>
                        <td>
                        <button style="background-color: rgb(153, 150, 150)" class='btn btn-sm '
                                type="button" wire:click="detachProduct({{$product->id}})"
                                class="btn btn-secondary"  > Detach
                        </button>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No records found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <hr>

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
                
                <form wire:submit.prevent="attachContactGroup">
                    @csrf
                    
                    <div class="col-md-6 mt-2">
                                <div class="form-group ">
                                    <label for="product_id">Product<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="product_id" required
                                            wire:model.defer="product_id">
                                        <option value="0">Select an Option</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
