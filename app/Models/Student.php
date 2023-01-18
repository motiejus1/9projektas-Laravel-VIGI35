<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; //trait

//veikia per duomenu baze

class Student extends Model
{
    use HasFactory, Sortable;

    //stulpeliai pagal kuriuos rikiuojama
    public $sortable = ['id', 'name', 'surname', 'email', 'avg_grade'];



    //uzpildomi

    //kurie laukai gali buti uzpildyti

}
