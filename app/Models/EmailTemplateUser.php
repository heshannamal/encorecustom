<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplateUser extends Model
{
    // use SoftDeletes;

    protected $table = 'email_template_users';

    protected $fillable = [
        'template_id',
        'type',
        'user_id',
    ];

    public static function getEmailsByType(int $templateId, int $type): array
    {
        $userIds = self::where('template_id', $templateId)
                        ->where('type', $type)
                        ->pluck('user_id');

        return \App\Models\User::whereIn('id', $userIds)
                    ->pluck('email')
                    ->toArray();
    }

    public function template() {
        return $this->belongsTo(EmailTemplate::class);
    }
}
