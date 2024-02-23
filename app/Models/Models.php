<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;



    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'models';




    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'models_id';




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'body_style',
        'options_id',
        'suppliers_id'
    ];
}
