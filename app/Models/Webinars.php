<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class webinars extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'webinars';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'web_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'link',
        'sched',
        "user_id",
        "sub_id",
        "type_id",
    ];
}
