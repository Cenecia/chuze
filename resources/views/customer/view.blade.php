@extends('layouts.app')

@section('content')
  <div class="container">
    <a href="/customer/" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    <h3>{{$customer->name}}</h3>
    <form method="POST" action="/customer/update/{{$customer->id}}">
      <fieldset>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group row">
          <div class="col-xs-5 col-sm-3">
            <label class="control-label">Name:</label>
          </div>
          <div class="col-xs-7 col-sm-3">
            <input class="form-control" id="name" name="name" value="{{$customer->name}}" />
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xs 12 col-sm-6">
            <button type="submit" class="btn btn-info pull-right">
              <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Update
            </button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
@endsection