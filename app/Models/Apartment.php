<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'municipality',
        'postal_code',
        'province',
        'img_name',
        'img',
        'is_visible',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

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

    public static function getApi()
    {
        $apiUrl = 'https://api.tomtom.com/search/2/geocode/';
        $apiKey = 'key=5SpDBwX41WJf17bsPmyNJnysKu2nuS3l';

        $response = Http::get('https://api.tomtom.com/search/2/geocode/Via%Ostilia,&23&00184.json?key=5SpDBwX41WJf17bsPmyNJnysKu2nuS3l');

        $json_data = $response->json();

        return $json_data;
    }
}
