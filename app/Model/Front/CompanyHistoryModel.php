<?php

namespace App\Model\Front;

use Illuminate\Database\Eloquent\Model;

class CompanyHistoryModel extends Model
{
    protected $table = 'company_history';
    protected $fillable = ['title', 'year', 'side_description', 'description', 'meta_title', 'meta_keyword', 'meta_description'];
}
