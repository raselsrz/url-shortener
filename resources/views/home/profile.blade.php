@extends('layouts.app')
@section('content')


<div class="h-screen flex-grow-1 overflow-y-lg-auto">

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
    
            <div class="card shadow border-0 mb-7">
                
                <div class="card-header add_cat">
                    <h5 class="mb-0">Add Post</h5>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="bi bi-check-circle"></i></span>
                        <span class="alert-text">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="bi bi-exclamation-triangle"></i></span>
                        <span class="alert-text">{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="bi bi-exclamation-triangle"></i></span>
                        <span class="alert-text">{{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


            </div>
    
            <div class="card shadow border-0 mb-7 add-container">
                <div class="card-body">
                    <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- name --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Name</label>
                            <input type="text"  class="form-control" id="title" name="name" required value="{{ $user->name }}" />
                        </div>

                        {{-- email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ $user->email }}" />
                        </div>

                        {{-- password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="password" required />
                        </div>

                        {{-- password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password" required />
                        </div>
    
    
    
                        <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" style="width: 20%; " >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>
 

@endsection