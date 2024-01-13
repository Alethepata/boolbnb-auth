<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    public function Services()
    {
        return $this->belongsToMany(Service::class);
    }

    public static function generateSlug($string)
    {

        $slug =  Str::slug($string, '-');
        $original_slug = $slug;

        $exists = Apartment::where('slug', $slug)->first();
        $c = 1;

        while ($exists) {
            $slug = $original_slug . '-' . $c;
            $exists = Apartment::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}