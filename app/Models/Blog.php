<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function store($data)
    {
        $data['owner_id'] = Auth::user()->id;
        return $this->create($data);
    }

    public function modify($data, $id)
    {
        return $this->find($id)
                ->update($data);
    }

    public function remove($id)
    {
        return $this->find($id)->delete();
    }

    public function getAll()
    {
        return $this->orderBy('created_at','desc')->paginate(5);
    }

    public function show($id)
    {
        return $this->find($id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function getAllUsingTags($tag)
    {
        return $this->where('tag',$tag)->orderBy('created_at','desc')->paginate(5);
    }
}
