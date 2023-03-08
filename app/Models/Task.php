<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    public const STATUS_NOT_STARTED = 0;
    public const STATUS_STARTED = 1;
    public const STATUS_PENDING = 2;

    protected $fillable = [
        'todo_list_id',
        'label_id',
        'title',
        'description',
        'status',
    ];

    public function todo_list(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}
