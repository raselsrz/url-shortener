


@extends('layouts.app')
@section('content')

<div class="h-screen flex-grow-1 overflow-y-lg-auto">

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
    
            <div class="card shadow border-0 mb-7">
                
                <div class="card-header add_cat">
                    <h5 class="mb-0">Add Link</h5>
                </div>
                </div>
    
            <div class="card shadow border-0 mb-7 add-container">
                <div class="card-body">
                    <form action="/admin/insert_post" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Link Title:</label>
                            <input type="text" name="title" class="form-control" id="title" name="title" required>
                        </div>

                        {{-- URL Link --}}
                        <div class="mb-3">
                            <label for="url" class="form-label">URL Link:</label>
                            <input type="text" name="url" class="form-control" id="url" name="url" required>
                        </div>

                        {{-- short link optional --}}
                        <div class="mb-3">
                            <label for="short_link" class="form-label">Short Link: (Optional)</label>
                            <input type="text" name="short_link" class="form-control" id="short_link" name="short_link">
                        </div>
    
    
                        <button type="submit" class="btn btn-sm bg-surface-secondary btn-neutral" style="width: 20%; " >Add Post</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    </div>

@endsection