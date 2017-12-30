<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth;
use App\Http\Requests;
use App\Story;
use App\Page;
use App\Button;

class StoryController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
  
    public function index(Request $request) 
    {
        if ($request->user()) {
            $userid = $request->user()->id;
            //var_dump($userid);
            $stories = Story::where('user_id', $userid)->get();
            //var_dump($stories);
        }
        return view('story/index', ['stories' => $stories]);
    }
    
    //
    public function create(Request $request) 
    {
        if ($request->isMethod('post')) {
            //
            $title = $request->input('title');
            $now = Date('Y-m-d h:m:s');
            $storyID = Story::insertGetId([
              'title' => $title,
              'user_id' => $request->user()->id,
              'created_at' => $now, 
              'updated_at' => $now
            ]);
        }
        return redirect("story/newpage/$storyID");
    }
  
    public function newPage($id)
    {
        $pages = Page::where('story_id', $id)->get();
        $page = new Page();
        $page->story_id = $id;
        $buttons = array();
        return view('story/page', ['page' => $page, 'pages' => $pages, 'buttons' => $buttons]);
    }
  
    public function addpage(Request $request)
    {
        if ($request->isMethod('post')) {
              //
              $storyID = $request->story_id;
              $content = $request->input('content');
              $title = $request->input('title');
              $now = Date('Y-m-d h:m:s');
              if($request->input('id')){
                $page_id = $request->input('id');
                Page::where('id', $page_id)->update([
                    'content' => $content,
                    'updated_at' => $now,
                    'title' => $title
                  ]);
              }
              else {
                  $pageID = Page::insertGetId([
                    'content' => $content,
                    'story_id' => $storyID,
                    'created_at' => $now, 
                    'updated_at' => $now,
                    'title' => $title
                  ]);
              }
        }
        return redirect("story/newpage/$storyID");
    }
  
    public function editpage($id)
    {
        $page = Page::where('id', $id)->first();
        $pages = Page::where('story_id', $page->story_id)->get();
        $allButtons = Button::where('pages.story_id', $page->story_id)
                                   ->join('pages', 'page_id', '=', 'pages.id')
                                   ->get();
        foreach($pages as $pg) {
            $count = 0;
            foreach($allButtons as $btn) {
                if($btn->page_id == $pg->id){
                    $count++;
                }
            }
            $pg->btn_count = $count;
        }
          
        
        $buttons = Button::where('page_id', $id)
                                ->join('pages', 'buttons.page_link', '=', 'pages.id')
                                ->select('buttons.*','pages.title')
                                ->get();
//         foreach($pages as $pg){
//             $pg->buttons = array();
//             foreach($button as $btn){
//                 if($btn->page_id == )
//             }
//         }
          
        return view('story/page', ['page' => $page, 'pages' => $pages, 'buttons' => $buttons]);
    }
  
    public function addbutton(Request $request)
    {
        $page_id = $request->page_id;
        $link_to = $request->link_to;
        $text = $request->input('button_text');
        $now = Date('Y-m-d h:m:s');
        $button_id = Button::insertGetId([
          'page_id' => $page_id,
          'page_link' => $link_to,
          'created_at' => $now, 
          'updated_at' => $now,
          'text' => $text
        ]);
      
        return redirect("story/editpage/$page_id");
    }
}
