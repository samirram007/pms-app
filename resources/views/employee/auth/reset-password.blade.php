@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 m-0">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Change Password</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('employee.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">change-passowrd</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3 bg-white shadow h-100">

                <!-- Validation Errors -->
                {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                <div class="row justify-content-center">
                    <div class="col-md-4 justify-content-center rounded-lg border border-primary p-3">
                        <form method="POST" action="{{ route('employee.password.update') }}" >
                            @csrf
                            <!-- Password Reset Token -->
                            {{-- <input type="hidden" name="token" value="{{ $request->route('token') }}"> --}}
                            {{-- current password --}}
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control"
                                    placeholder="Enter Current Password">
                            </div>
                            <!-- New Password -->
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter New Password">
                            </div>
                            {{-- confirm new password --}}
                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Enter Confirm New Password">
                            </div>

                            <hr class="bg-info">

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-info">
                                    <span class="iconify" data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
