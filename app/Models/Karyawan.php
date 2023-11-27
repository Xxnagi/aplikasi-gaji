<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Karyawan extends Model
{
    use HasFactory, Sluggable;

    protected $with = ['gaji', 'jabatan'];

    protected $fillable = ['name', 'email', 'gaji_id', 'jabatan_id', 'nomor_handphone'];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        });

        $query->when($filters['gaji'] ?? false, fn ($query, $gaji) => $query->whereHas('gaji', fn ($query) =>
        $query->where('gaji', $gaji)));

        $query->when($filters['jabatan'] ?? false, fn ($query, $jabatan) => $query->whereHas('jabatan', fn ($query) =>
        $query->where('gaji', $jabatan)));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
