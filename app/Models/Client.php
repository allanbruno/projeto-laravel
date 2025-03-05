<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'image', 'status',
    ];

    public function scopeSearch(Builder $query, ?string $search = ''): Builder
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    public function scopeDefaultOrder(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active' => '<span class="badge bg-success">Ativo</span>',
            'inactive' => '<span class="badge bg-danger">Inativo</span>',
            default => '<span class="badge bg-secondary">Indefinido</span>',
        };
    }

}
