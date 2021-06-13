<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    /**
     * 为 array / JSON 序列化准备日期格式.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $fillable = [
        'label', 'column', 'note', 'value', 'type', 'scope',
    ];

    protected $casts = [
        'note' => 'json',
        'value' => 'json',
    ];
}
