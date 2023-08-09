<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, BlogService $blog) 
    {
        if($request->get('tags') != '')
        {
            $blogs = $blog->getAllUsingTags($request->get('tags'));   
        }
        else{
            $blogs = $blog->getAll(); 
        }
        return view('home.index',compact('blogs'));
    }
}
