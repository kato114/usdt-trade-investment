@extends('layouts.main')
@section('title')
    Mail Box
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Compose Mail</h3>
            <div class="card-options">
            </div>
        </div>
        <div class="card-body">
            <form method="post">
                @csrf
                @if(!isset($recipients))
                    <div class="form-group">
                        <h3>Select Clubs</h3>
                        <div class="selectgroup selectgroup-pills">
                            @foreach($clubs as $club)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="value[]" value="{{ $club }}"
                                           class="selectgroup-input"
                                           checked="">
                                    <span class="selectgroup-button">{{ $club }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="">Start Composing</button>
                @else
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject"
                               placeholder="Well, she turned me into a newt.">
                    </div>
                    <label>Body</label>
                    <textarea rows="30" id="mail" name="body"></textarea>
                    <div class="mt-6">
                        <button class="btn btn-primary float-right ml-2">Send</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
    <script>
        $(document).on('turbolinks:load', function () {
            var baseConfig = {
                selector: "textarea#mail",
                convert_urls: false,
                autosave_ask_before_unload: false,
                powerpaste_allow_local_images: true,
                plugins: [
                    "anchor autolink codesample colorpicker fullscreen help image imagetools",
                    " lists link media noneditable preview",
                    " searchreplace table template textcolor visualblocks wordcount"
                ],
                toolbar:
                    "insertfile a11ycheck undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
                content_css: [
                    "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
                    "//www.tiny.cloud/css/content-standard.min.css"
                ]
            };
            let editor = tinymce.init(baseConfig);
        })

    </script>
@endsection
