@extends('admin.layout.layout')

@section('content')

<section class="section contact">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Contact Us</h5>

            <form action="{{ route('contactus.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    {{-- <label class="form-label" for="basic-default-message">Content</label> --}}
                    <textarea id="content" name="content" class="form-control"
                        placeholder="Enter Content">{{ old('content', $contact->content ?? '') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</section>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
// Apply CKEditor to the description textarea
CKEDITOR.replace('content');
</script>
@endsection




