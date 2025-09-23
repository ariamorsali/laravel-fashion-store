<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('children');
    }
}
