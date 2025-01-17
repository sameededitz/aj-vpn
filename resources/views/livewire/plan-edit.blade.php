<div>
    @if ($errors->any())
        <div class="py-2">
            @foreach ($errors->all() as $error)
                <x-alert type="danger" :message="$error" />
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="update">
        <div class="row gy-3">
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" wire:model.blur="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-12">
                <label class="form-label">Price</label>
                <input type="number" wire:model.blur="price" class="form-control" placeholder="Price">
            </div>
            <div class="col-12">
                <label class="form-label">Duration</label>
                <select wire:model.live="duration" class="form-control" required>
                    <option selected>Select Duration</option>
                    <option value="weekly"> Weekly </option>
                    <option value="monthly"> Monthly </option>
                    <option value="6-month"> 6 Months </option>
                    <option value="yearly"> Yearly </option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <input type="text" wire:model.blur="description" class="form-control" placeholder="Description">
            </div>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary-600">Update</button>
        </div>
    </form>
</div>
