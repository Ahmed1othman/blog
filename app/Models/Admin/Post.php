<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_title',
        'post_body',
        'admin_id',
        'category_id',
        'photo',
        'state',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        '_token'
    ];
    public $timestamps = true;



    //relations
    public function createdBy(){
        return $this->belongsTo('App\Models\Admin\Admin','admin_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Admin\Category','category_id','id');
    }


    public function getActive(): string
    {
        return   $this ->state == 1 ? 'Active' : 'Disable';
    }

    //relations


}
