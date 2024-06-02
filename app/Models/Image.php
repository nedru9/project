<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Image extends Model
{
    use Sortable;
    use HasFactory;
    protected $table = 'images';
    protected $guarded = false;
    protected $fillable = [
        'id',
        'name',
        'created_at'
    ];
    public $sortable = [
        'name',
        'created_at'
    ];
    protected $primaryKey = 'id';
}
