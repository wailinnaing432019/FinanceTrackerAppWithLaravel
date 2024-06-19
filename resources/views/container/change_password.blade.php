@extends('container.index')
@section('content')
    <div class="row">
        <div class="col-5 offset-3">
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Change Password</h5>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="" class="mb-1">Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control"
                                id="" aria-describedby="emailHelp" placeholder="Enter Name">
                            @error('name')
                                <span class="text-danger t-8">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-1">Email</label>
                            <input type="text" name="email" value="{{ auth()->user()->email }}" class="form-control"
                                id="" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email')
                                <span class="text-danger t-8">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Change Password</h5>
                    <form method="POST" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="" class="fs-6">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id=""
                                aria-describedby="emailHelp" placeholder="Enter Current Password">
                            @error('current_password')
                                <span class="text-danger t-8">sfsdfs {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="fs-6">New Password</label>
                            <input type="password" name="password" class="form-control" id=""
                                aria-describedby="emailHelp" placeholder="Enter New Password">
                            @error('password')
                                <span class="text-danger t-8">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="fs-6">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id=""
                                aria-describedby="emailHelp" placeholder="Re-type new Password">
                        </div>
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
            <div class="card mb-5">

                <div class="card-body">

                    <p class="fs-6">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.
                    </p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Delete Account
                    </button>

                    <!-- Modal -->
                    <div class="modal fade " id="exampleModal"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">

                                        <h2 class="">
                                            Are you sure you want to delete your account?
                                        </h2>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter your password" />

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
