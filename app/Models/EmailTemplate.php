<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use SoftDeletes;

    protected $table = 'email_templates';

    protected $fillable = [
        'name',
        'key',
        'function_name',
        'controller',
        'subject',
        'body',
        'description',
        'is_active',
        'is_custom_to',
        'is_custom_cc',
        'is_custom_bcc',
    ];
}
