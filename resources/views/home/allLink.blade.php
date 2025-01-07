@extends('layouts.app')
@section('content')


<div class="h-screen flex-grow-1 overflow-y-lg-auto">
        
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <!-- Card stats -->
            
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">All Links</h5>
                </div>

                <div class="col text-end">
                    <a href="{{route('add')}}" class="btn btn-sm btn-primary">Add Link</a>
                </div>

                <div class="table-responsive">
                <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Main Link</th>
                                        <th scope="col">Short Link</th>
                                        <th scope="col">Added On</th>
                                        <th scope="col">Edit / Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if($links->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">No Link Found</td>
                                    </tr>
                                    @endif


                                    @foreach($links as $link)

                                    <tr>
                                        <td>
                                            {{ $link->title }}
                                        </td>
                                        <td>
                                            {{ $link->link }}
                                        </td>
                                        <td>
                                           {{ $link->shortLink }}
                                        </td>

                                        <td>
                                            {{ $link->created_at->format('d M, Y') }}
                                        </td>

                                        <td class="text-end">

                                            {{-- view --}}
                                            <a class="btn btn-sm btn-neutral" target="_blank" href="{{ route('shortLink', $link->shortLink) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            
                                            {{-- edit --}}

                                            <a class="btn btn-sm btn-neutral" href="{{ route('links.edit', $link->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            
                                            {{-- delete --}}
                                            <a class="btn btn-sm btn-neutral" href="{{ route('links.delete', $link->id) }}" onclick="return confirm('Are you sure you want to delete this link?')">
                                                <i class="bi bi-trash"></i>
                                            </a>                                   
                                        </td>
                                    </tr>

                                    @endforeach


                                </tbody>
                            </table>

                </div>
               
                @if($links->count() >10)
                <div class="card-footer border-0 py-5">
                    <span class="text-muted text-sm">Showing {{ $links->count() }} to {{ $links->count() }} of {{ $links->count() }} entries</span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if($links->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $links->previousPageUrl() }}">Previous</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @endif
                    
                            <!-- Page Numbers -->
                            @for($i = 1; $i <= $links->lastPage(); $i++)
                                <li class="page-item {{ $i == $links->currentPage() ? 'active' : '' }}">
                                    <a class="page-link {{ $i == $links->currentPage() ? 'bg-info text-white border-info' : '' }}" href="{{ $links->url($i) }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor
                    
                            <!-- Next Page Link -->
                            @if($links->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $links->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    
                </div>
                @endif
            </div>
        </div>
    </main>
</div>

@endsection