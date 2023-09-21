<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Modelmhs extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'mhsnim';
    public $timestamps = false;

    public $sortable = [
        'mhsnim', 'mhsnama', 'mhstelp', 'mhsalamat',
    ];
}
