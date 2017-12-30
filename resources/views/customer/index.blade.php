@extends('layouts.app')

@section('content')
  <div class="container">
    <h3>Customers</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-user-plus" aria-hidden="true"></i> Add Customer
    </button>
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Created Date</th>
          <td></td>
        </tr>
      </thead>
      <tbody>
      @foreach($customers as $customer)
        <tr>
          <td>
            {{$customer->name}}
          </td>
          <td>
            {{ \Carbon\Carbon::parse($customer->created_at)->format('d/m/Y')}}
          </td>
          <td>
            <a href="/customer/view/{{$customer->id}}" class="btn btn-primary btn-sm">
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Select
            </a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
          </div>
          <form method="POST" action="/customer/add">
            <div class="modal-body">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="form-group">
                <div class="col-xs-6">
                  <label class="control-label">Name:</label>
                </div>
                <div class="col-xs-6">
                  <input class="form-control" id="name" name="name" />
                </div>
              </div>
              <br/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection