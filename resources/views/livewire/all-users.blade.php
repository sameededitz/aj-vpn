<div>
    <table class="table display responsive bordered-table mb-0" id="myTable" data-page-length='10'>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Premium</th>
                <th scope="col">Last Login</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="javascript:void(0)" class="text-primary-600"> {{ $loop->iteration }} </a></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->purchases ? 'Premium' : 'Free' }}</td>
                    <td>
                        @if ($user->purchases)
                            <button type="submit" wire:click="clearPurchase({{ $user->id }})"
                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="ic:sharp-clear"></iconify-icon>
                            </button>
                        @else
                            <button type="submit" wire:click="openModal({{ $user->id }})"
                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="fluent:money-16-regular"></iconify-icon>
                            </button>
                        @endif
                    </td>
                    <td>{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</td>
                    <td>C: {{ $user->created_at->diffForHumans() }}<br>U: {{ $user->updated_at->diffForHumans() }}
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('user-referrals', $user->id) }}"
                                class="w-32-px me-4 h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:link-linear"></iconify-icon>
                            </a>
                            <a href="{{ route('edit-admin', $user->id) }}"
                                class="w-32-px me-4 h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <form action="{{ route('delete-user', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Add Purchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addPurchase">
                        <div class="mb-3">
                            <label for="plan_id" class="form-label">Plan</label>
                            <select name="plan_id" wire:model.blur="plan_id" class="form-select">
                                <option selected>Select Plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('open-modal', event => {
        var myModal = new bootstrap.Modal(document.getElementById('purchaseModal'));
        myModal.show();
    });

    window.addEventListener('close-modal', event => {
        setTimeout(function() {
            var modal = bootstrap.Modal.getInstance(document.querySelector('#purchaseModal'));
            modal.hide();
        }, 2000);
    });

    window.addEventListener('alert_add', event => {
        console.log(event.detail);
        alert('Purchase Added Succesfully');
    });
    window.addEventListener('alert_clear', event => {
        console.log(event.detail);
        alert('Cleared All Purchases of User');
    });
</script>
