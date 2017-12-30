@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <ul class="list-group">
          @foreach($pages as $p)
            <a href="/story/editpage/<?=$p->id?>" class="list-group-item <?=$p->id == $page->id ? "active" : ""?>"><?=$p->title?> 
              @if($p->btn_count > 0)
                <span class="badge"><?=$p->btn_count?></span>
              @endif
            </a>
          @endforeach
          <a href="/story/newpage/<?=$page->story_id?>" class="list-group-item list-group-item-info <?=0 == $page->id ? "active" : ""?>">New Page</a>
        </ul>
      </div>
      <div class="col-sm-9">
        <form method="POST" action="/story/addpage">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <input type="hidden" name="id" id="id" value="<?=$page->id ?>">
          <input type="hidden" name="story_id" id="story_id" value="<?=$page->story_id ?>">
          <fieldset>
            <div class="form-group">
              <label for="content">Page Title </label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Page Title" value="<?=$page->title?>" required/>
            </div>
            <div class="form-group">
              <label for="content">Page Content </label>
              <textarea class="form-control story-content" name="content" id="content" placeholder="Page Content Here" required><?=$page->content?></textarea>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                @if($page->id != 0)
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-link" aria-hidden="true"></i> Add a button
                  </button>
                @endif
                <button type="submit" class="btn btn-success pull-right">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                </button>
              </div>
            </div>
          </fieldset>
        </form>
        @if(count($buttons) > 0)
          <h3>Buttons</h3>
          @foreach($buttons as $btn)
            <div class="row">
              <div class="col-xs-12">
                <button class="btn btn-default"><?=$btn->text?></button> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?=$btn->title?><br/>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
  @if($page->id != 0)
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add a Button</h4>
          </div>
          <form method="POST" action="/story/addbutton">
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12">
                  <div class="alert alert-info">
                    Note: If you have made any changes to the page you must save before adding a button, or your changes will be lost.
                  </div>
                </div>
              </div>
              <fieldset>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="page_id" id="page_id" value="<?=$page->id ?>">
                <div class="form-group row">
                  <div class="col-xs-6">
                    <label class="control-label">Button Text:</label>
                  </div>
                  <div class="col-xs-6">
                    <input class="form-control" id="button_text" name="button_text" />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-6">
                    <label class="control-label">Links to Page:</label>
                  </div>
                  <div class="col-xs-6">
                    <select class="form-control" name="link_to" id="link_to">
                      @foreach($pages as $p)
                        <option value="<?=$p->id?>"><?=$p->title?></option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </fieldset>
              <br/>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add</button>
            </div>
          </div>
        </div>
      </div>
    @endif
@endsection