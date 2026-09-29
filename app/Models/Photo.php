<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Photo extends Model

{

    use HasFactory;



    protected $fillable = ['path', 'caption', 'category'];

} // Hakikisha juu umeweka: use App\Models\Photo;

$totalPhotos = \App\Models\Photo::count();