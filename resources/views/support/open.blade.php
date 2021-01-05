@extends('layouts.main')
@section('title')
    Support Center
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Ticket</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('support.ticket', ['action' => 'open']) }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" name="subject"
                                           placeholder="Ticket Subject.."
                                           value="{{ old('subject') }}">
                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong> {{ $errors->first('subject') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="narration" rows="6"
                                      placeholder="Narration..">{{ old('narration') }}</textarea>
                            @if ($errors->has('narration'))
                                <span class="invalid-feedback d-block" role="alert">
                                            <strong> {{ $errors->first('narration') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <a href="{{ route('support.ticket') }}" class="btn btn-secondary">Cancel</a>
                        <button class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
