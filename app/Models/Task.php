<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'todo_list_id',
        'title',
    ];

    public function todo_list(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }
}
