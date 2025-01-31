@extends('layouts.app') @section('content')

<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="card shadow border-0 mb-7">
                <div class="card-header add_cat">
                    <h5 class="mb-0">Add Link</h5>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="bi bi-check-circle"></i></span>
                        <span class="alert-text">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
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
                    <form action="{{ route('links.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Link Title:</label>
                            <input type="text" name="title" class="form-control" id="title" name="title" required />
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- URL Link --}}
                        <div class="mb-3">
                            <label for="url" class="form-label">URL Link:</label>
                            <input type="url" class="form-control" id="url" name="link" required />
                            @error('link')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- short link optional --}}
                        <div class="mb-3">
                            <label for="short_link" class="form-label">Short Link: (Optional)</label>
                            <input type="text" name="shortLink" class="form-control" id="short_link" placeholder="Short Link" />
                            @error('shortLink ')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" style="width: 20%;">Add Link</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection
