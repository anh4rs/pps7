<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'gurues';
    protected $fillable = ['namaGuru','slug','uuid','nik','nip','nuptk','noHp','jabatan','isActive'];
  
}
