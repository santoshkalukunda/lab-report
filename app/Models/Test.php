<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function parentTest()
    {
        return $this->belongsTo(Test::class, 'parent_id');
    }

    public function childTests()
    {
        return $this->hasMany(Test::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function testreport()
    {
        return $this->hasMany(Testreport::class);
    }

}
