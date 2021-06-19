<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'category_id', 'sort', 'status', 'page_id', 'redirect',
    ];

    /**
     * 为 array / JSON 序列化准备日期格式.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    protected $casts = [
        'detail' => 'json',
        'status' => 'boolean',
    ];
}
