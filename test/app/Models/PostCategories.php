<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostCategories extends Pivot
{
    use HasFactory;

    protected $table = 'post_categories';

}
