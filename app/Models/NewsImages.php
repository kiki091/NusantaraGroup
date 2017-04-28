<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImages extends Model
{
    protected $table = 'news_images';

    public $timestamp = true;

    protected $fillable = [
	    'filename', 
        'created_at', 
        'updated_at', 
	    'news_id'
    ];

    /**
     * @param $query
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

}
