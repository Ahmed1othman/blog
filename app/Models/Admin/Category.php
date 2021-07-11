<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'admin_id',
        'state',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        '_token'
    ];
    public $timestamps = true;



    public function getActive(): string
    {
        return   $this ->state == 1 ? 'Active' : 'Disable';
    }

    //relations
    public function createdBy(){
        return $this->belongsTo('App\Models\Admin\Admin','admin_id','id');
    }

    //relations
    public function posts(){
        return $this->hasMany('App\Models\Admin\Post','category_id','id');
    }


}
