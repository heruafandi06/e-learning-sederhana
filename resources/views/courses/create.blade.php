@if (Auth::user())
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Course</div>

                <div class="card-body">
                  <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group {{ $errors->has('course_name') ? 'has-error' : '' }}">
                          <label for="course_name" class="control-label">Course Name</label>
                          <input type="text" id="course_name" class="form-control" name="course_name" placeholder="Course Name">
                          @if ($errors->has('course_name'))
                              <span class="help-block" style="color:red;">{{ $errors->first('course_name') }}</span>
                          @endif
                      </div>
                      <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                          <label for="duration" class="control-label">Duration</label>
                          <input type="text" id="duration" class="form-control" name="duration" placeholder="Duration">
                          @if ($errors->has('duration'))
                              <span class="help-block" style="color:red;">{{ $errors->first('duration') }}</span>
                          @endif
                      </div>
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                          <label for="description" class="control-label">Description</label>
                          <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                          @if ($errors->has('description'))
                              <span class="help-block">{{ $errors->first('description') }}</span>
                          @endif
                      </div>
                      <div class="form-group {{ $errors->has('file_upload') ? 'has-error' : '' }}">
                          <label for="file" class="control-label">File Upload</label>
                          <input type="file" id="file" class="form-control" name="file_upload" >
                          @if ($errors->has('file_upload'))
                              <span class="help-block" style="color:red;">{{ $errors->first('file_upload') }}</span>
                          @endif
                      </div>
                      <div class="form-group">
                          <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-md btn-primary">Save</button>
                          <a href="{{ route('courses.index') }}" class="btn btn-default">Back</a>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif
