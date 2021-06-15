<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'sort', 'status', 'url', 'type', 'controller', 'function', 'columnTemplate', 'contentTemplate', 'page',
    ];

    protected $casts = [
        'detail' => 'json',
        'status' => 'boolean',
    ];

    /**
     * 处理url.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return $this->url;
    }

    /**
     * 获取栏目关联单文章.
     */
    public function page(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Content::class, 'category_id');
    }

    /**
     * 获取栏目关联列表内容.
     */
    public function list(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Content::class, 'category_id', 'id');
    }
}
