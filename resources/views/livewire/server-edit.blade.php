<div>
    @if ($errors->any())
        <div class="py-2">
            @foreach ($errors->all() as $error)
                <x-alert type="danger" :message="$error" />
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="row gy-3">
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" wire:model.live="name" value="{{ $name }}" class="form-control"
                    placeholder="Server Name">
            </div>
            <div class="col-12">
                <label class="form-label">Status</label>
                <select class="form-select" wire:model="status">
                    <option selected>Select Status</option>
                    <option value="1">Premium</option>
                    <option value="0">Free</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label mt-3">Server Image</label>
                <div class="upload-image-wrapper d-flex align-items-center gap-3">
                    <div
                        class="uploaded-img position-relative h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 ">
                        <button type="button"
                            class="uploaded-img__remove position-absolute top-0 end-0 z-1 text-2xxl line-height-1 me-8 mt-8 d-flex"
                            wire:click="removeImage">
                            <iconify-icon icon="radix-icons:cross-2" class="text-xl text-danger-600"></iconify-icon>
                        </button>
                        <img id="uploaded-img__preview" class="w-100 h-100 object-fit-cover"
                            src="{{ $image ? $image->temporaryUrl() : $server->getFirstMediaUrl('server_logo') }}"
                            alt="server_image">
                    </div>

                    <label
                        class="upload-file h-120-px w-120-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1"
                        for="upload-file">
                        <iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon>
                        <span class="fw-semibold text-secondary-light">Upload</span>
                        <input id="upload-file" wire:model="image" type="file" hidden>
                        <div wire:loading wire:target="image">Uploading...</div>
                    </label>
                </div>
                <p class="text-sm mt-1 mb-0">If You Upload a New Image, then old image will be deleted</p>
                <p class="text-sm mt-1 mb-3">The New Image Should be Less than 20MB.</p>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-600">Update</button>
            </div>
        </div>
    </form>
</div>
