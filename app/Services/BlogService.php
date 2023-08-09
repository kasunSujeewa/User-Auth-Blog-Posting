<?php
namespace App\Services;



use App\Models\Blog;

class BlogService
{
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function store($data) : void 
    {
        $blog = $this->blog->store($data);

    }
    public function modify($data, $id) : void 
    {
        $blog = $this->blog->modify($data, $id);

    }
    public function remove($id) : void 
    {
        $blog = $this->blog->remove($id);

    }
    public function getAll() : object 
    {
        $blogs = $this->blog->getAll();
        return $blogs;

    }
    public function show($data) : void 
    {
        $blog = $this->blog->store($data);

    }

    public function getAllUsingTags($tag): object
    {
        return $this->blog->getAllUsingTags($tag);
    }

}