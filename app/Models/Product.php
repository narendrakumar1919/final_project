<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'category_id',
        'description',
        'image',
        'date',
        'status'
    ];


    /**
     * Get the post that owns the comment.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
