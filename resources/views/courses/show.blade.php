@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Courses</div>

                <div class="card-body">
                  @if (Auth::user()->role_id == '2')
                    <a href="{{ route('courses.create') }}">
                      <button class="btn btn-sm btn-primary">Add new courses</button>
                    </a><br><br>
                  @endif
                  <div class="media">
                    <div class="media-body">
                      @if ($message = Session::get('message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif

                        @if (preg_match('/.doc/i', $courses->file_upload ))
                          <img class="mr-3" src="{{ asset('img/word.png') }}" alt="Course 1" width="60px" style="float:left;">
                        @elseif (preg_match('/.pptx/i', $courses->file_upload ))
                          <img class="mr-3" src="{{ asset('img/ppt.jpg') }}" alt="Course 1" width="60px" height="70px" style="float:left;">
                        @elseif (preg_match('/.pdf/i', $courses->file_upload ))
                          <img class="mr-3" src="{{ asset('img/pdf.jpg') }}" alt="Course 1" width="60px" style="float:left;">
                        @endif
                        <!-- {{ Storage::path($courses->file_upload) }} -->

                        <h5 class="mt-0">
                          <b>
                            <a href="{{ route('courses.show', $courses->id) }}">
                              {{ $courses->course_name }}
                            </a>
                          </b>
                          @if (Auth::user()->role_id == '2')
                            <!-- <i style="float:right; font-size:12px;">Change</i> -->
                          @elseif (Auth::user()->role_id == '1')
                              <a href="{{ route('download.show', $courses->id) }}">
                              <button class="btn btn-sm btn-danger" style="float:right;">
                                <b style="font-size:12px;">Download</b>
                              </button>
                            </a>
                          @endif
                        </h5>
                        <div>Created:
                          @if (Auth::user()->role_id == '1')
                            {{ $courses->User->name }} at
                          @endif
                          {{ $courses->created_at }}</div>
                        <div>Duration: {{ $courses->duration }} hours</div>
                        <br>
                        <div>Description: {{ $courses->description }}</div>
                        <br>
                        Share:
                        <a href="http://www.facebook.com/share.php?u={{ route('courses.show', $courses->id) }}" target="_blank">
                          <img src="{{ asset('img/fb.png') }}" alt="Share facebook" width="21px">
                        </a>
                        <a href="http://twitter.com/intent/tweet?url={{ route('courses.show', $courses->id) }}" target="_blank">
                          <img src="{{ asset('img/twt.jpg') }}" alt="Share twitter" width="20px">
                        </a>
                        <hr>

                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
