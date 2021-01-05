<li class="media mt-4">
    <div class="media-object avatar mr-4"
         style="background-image: url({{ $message->author->photo }})">
    </div>
    <div class="media-body">
        <strong> {{ $message->author->name }}</strong>
        <br>
        {!! str_replace("\n","<br>", $message->narration) !!}
        @if($message->attachments->count()>0)
            <br>
            <br>
            <strong>
                <p>
                                                <span><i class="fe fe-paperclip"></i> <span
                                                            id="attachment-count">{{$message->attachments->count()}}</span> {{ str_plural("Attachment",$message->attachments->count()) }} </span>
                </p>
            </strong>
            <div class="attachment">
                @foreach($message->attachments as $attachment)
                    <div class="file-box">
                        <a href="{{$attachment->attachable->link}}" target="_blank"
                           style="text-decoration: none">
                            <div class="file">
                                @if(starts_with( $attachment->attachable->mime_type,"image" ))
                                    <div class="image">
                                        <img alt="image" class="img-fluid"
                                             src="{{ $attachment->attachable->link }}">
                                    </div>
                                @else
                                    <div class="icon"><i class="fe fe-file"></i></div>
                                @endif

                                <div class="file-name">
                                    {{ $attachment->attachable->name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</li>
