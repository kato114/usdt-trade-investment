<form method="post"
      action="{{ $route }}"
      enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-auto">
                        <span class="avatar avatar-xl"
                              style="background-image: url({{ auth()->user()->photo }})"></span>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="5" placeholder="Response..." name="narration"></textarea>
                @if ($errors->has('narration'))
                    <span class="invalid-feedback d-block" role="alert">
                                            <strong> {{ $errors->first('narration') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="attachment" id="file-box">
                </div>
                <div class="clearfix"></div>
            </div>
            <input type="file" id="file" multiple style="display: none">
            <div class="form-group">
                <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                        <input type="radio" class="selectgroup-input"
                               checked="">
                        <span class="selectgroup-button selectgroup-button-icon" onclick="attachFile()"><i
                                    class="fe fe-paperclip"></i></span>
                    </label>
                </div>
                <button class="btn btn-primary">Send</button>
                @if(user()->role =='admin')
                    <a onclick="return confirm('Are you sure?')"
                       href="{{ route('support.resolution',['action'=>'close','ticket' => $ticket]) }}"
                       class="btn btn-danger mr-2">Close</a>
                @endif
            </div>
        </div>
    </div>
</form>
@section('scripts')
    @parent
    <script>
        function attachFile() {
            $("#file").trigger("click");
        }

        function deleteAttachment(action) {
            var file = $(action).closest(".file-box");
            file.remove();
        }

        $(document).ready(function () {
            $("#file").on("change", function () {
                for (var i = 0, numFiles = $(this)[0].files.length; i < numFiles; i++) {
                    var file = $(this)[0].files[i];
                    if (file.type.startsWith('image/')) {
                        var reader = new FileReader();
                        reader.onload = (function (file) {
                            return function (e) {
                                var template = '<div class="file-box"><div class="file">' +
                                    '</span><div class="image">' +
                                    '<img alt="image" class="img-fluid" src="{2}">' +
                                    '</div><div class="file-name">{0}' +
                                    '<input type="hidden" name="file[]" value="{0}">' +
                                    '<input type="hidden" name="attachment[]" value="{1}">' +
                                    '<span class="attachment-delete float-right fe fe-trash" onclick="deleteAttachment(this);">' +
                                    '</div></div></div></div></div>';

                                $("#file-box").append(template.format(file.name, e.target.result, e.target.result));
                            };
                        })(file);
                        reader.readAsDataURL(file);
                    } else {
                        var reader = new FileReader();
                        reader.onload = (function (file) {
                            return function (e) {
                                var template = '<div class="file-box"><div class="file"><div class="icon">' +
                                    '<i class="fe fe-file"></i>' +
                                    '</div><div class="file-name">{0}' +
                                    '<input type="hidden" name="attachment[]" value="{1}">' +
                                    '<input type="hidden" name="file[]" value="{0}">' +
                                    '<span class="attachment-delete float-right fe fe-trash" onclick="deleteAttachment(this);">' +
                                    '</div></div></div>';
                                $("#file-box").append(template.format(file.name, e.target.result));
                            };
                        })(file);
                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>
@endsection
