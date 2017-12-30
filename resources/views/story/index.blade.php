@extends('layouts.app')

@section('content')
  <div class="container">
    <h3>Your Stories</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-book" aria-hidden="true"></i> New Story
    </button>
    @foreach($stories as $story)
      <p class="lead">
        <a href="/story/newpage/{{$story->id}}">{{$story->title}}</a>
      </p>
    @endforeach
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">New Story</h4>
          </div>
          <form method="POST" action="/story/create">
            <div class="modal-body">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="form-group">
                <div class="col-xs-6">
                  <label class="control-label">Title:</label>
                </div>
                <div class="col-xs-6">
                  <input class="form-control" id="title" name="title" />
                </div>
              </div>
              <br/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Create</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection