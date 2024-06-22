<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'name',
        'kategori_menu_id',
        'description',
        'price',
        'image',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class, 'kategori_menu_id');
    }
}
