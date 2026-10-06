@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h2 mb-1">Videos</h1><p class="text-muted mb-0">Upload MP4/WebM/MOV files or add a hosted video URL.</p></div>
    <span class="badge text-bg-light p-2">{{ $items->total() }} videos</span>
</div>

<div class="card p-4 mb-4">
    <h5 class="mb-3">Add video</h5>
    <form method="post" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label required">Title</label><input class="form-control" name="title" maxlength="150" required></div>
            <div class="col-md-6"><label class="form-label">Hosted video URL</label><input class="form-control" name="video_url" type="url" placeholder="https://..."></div>
            <div class="col-md-8"><label class="form-label">Upload video file</label><input class="form-control" name="video_file" type="file" accept="video/mp4,video/webm,video/quicktime"><div class="form-text">Maximum 50 MB. Provide either a URL or a file.</div></div>
            <div class="col-md-4"><label class="form-label">Thumbnail</label><input class="form-control" name="thumbnail" type="file" accept="image/jpeg,image/png,image/webp"></div>
            <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="3" maxlength="2000"></textarea></div>
            <div class="col-md-3"><label class="form-label">Display order</label><input class="form-control" name="sort_order" type="number" min="0" value="0"></div>
            <div class="col-md-3 d-flex align-items-end"><div class="form-check form-switch mb-2"><input class="form-check-input" name="status" type="checkbox" value="1" checked><label class="form-check-label">Published</label></div></div>
        </div>
        <button class="btn btn-dark mt-3" type="submit"><i class="bi bi-cloud-arrow-up me-1"></i> Add Video</button>
    </form>
</div>

<div class="row g-4">
@forelse($items as $item)
    <div class="col-xl-6">
        <div class="card h-100 overflow-hidden">
            @if($item->video_path)
                <video class="w-100" style="height:240px;object-fit:cover;background:#111" controls preload="metadata" src="{{ asset('storage/'.$item->video_path) }}"></video>
            @elseif($item->video_url)
                <div class="ratio ratio-16x9"><iframe src="{{ $item->video_url }}" title="{{ $item->title }}" allowfullscreen></iframe></div>
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:240px"><i class="bi bi-play-btn fs-1 text-muted"></i></div>
            @endif
            <div class="p-4">
                <div class="d-flex justify-content-between gap-2"><h5>{{ $item->title }}</h5><span class="badge {{ $item->status ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status ? 'Published' : 'Hidden' }}</span></div>
                <p class="text-muted small">{{ $item->description }}</p>
                <details class="mt-3"><summary class="fw-semibold">Edit video</summary>
                    <form method="post" action="{{ route('admin.videos.update',$item) }}" enctype="multipart/form-data" class="pt-3">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6"><label class="form-label">Title</label><input class="form-control" name="title" value="{{ $item->title }}" required></div>
                            <div class="col-md-6"><label class="form-label">Hosted URL</label><input class="form-control" name="video_url" type="url" value="{{ $item->video_url }}"></div>
                            <div class="col-md-7"><label class="form-label">Replace uploaded file</label><input class="form-control" name="video_file" type="file" accept="video/mp4,video/webm,video/quicktime"></div>
                            <div class="col-md-5"><label class="form-label">Replace thumbnail</label><input class="form-control" name="thumbnail" type="file" accept="image/jpeg,image/png,image/webp"></div>
                            <div class="col-12"><textarea class="form-control" name="description" maxlength="2000">{{ $item->description }}</textarea></div>
                            <div class="col-md-3"><input class="form-control" name="sort_order" type="number" min="0" value="{{ $item->sort_order }}"></div>
                            <div class="col-md-3 d-flex align-items-center"><div class="form-check form-switch"><input class="form-check-input" name="status" type="checkbox" value="1" @checked($item->status)><label class="form-check-label">Published</label></div></div>
                        </div>
                        <button class="btn btn-dark btn-sm mt-3">Save changes</button>
                    </form>
                </details>
                <form method="post" action="{{ route('admin.videos.delete',$item) }}" class="mt-3" data-confirm="This video will be permanently deleted.">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit"><i class="bi bi-trash me-1"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="col-12"><div class="card p-5 text-center text-muted">No videos added yet.</div></div>
@endforelse
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
