<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $guarded = [];
    protected $casts = ['sizes' => 'array', 'colors' => 'array', 'surfaces' => 'array'];
    public function getRouteKeyName(): string { return 'slug'; }
}
