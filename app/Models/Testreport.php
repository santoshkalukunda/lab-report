<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testreport extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
}
