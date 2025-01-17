@extends('layout.admin-layout')
@section('title')
    Edit Referral Trial | Admin
@endsection
@section('admin_content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Referral Settings</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin-home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Edit Referral Trial</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Edit Referral Setting</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="py-2">
                            @foreach ($errors->all() as $error)
                                <x-alert type="danger" :message="$error" />
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('referrals.update', $referral->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="form-label">Invite Count</label>
                                <input type="number" class="form-control" name="invite_count"
                                    value="{{ $referral->invite_count }}" placeholder="Number of Invites" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Trial Duration (in hours)</label>
                                <input type="number" class="form-control" name="trial_duration"
                                    placeholder="Trial Duration (in hours)" value="{{ $referral->trial_duration }}"
                                    required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-600">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection
@section('admin_scripts')
@endsection
