<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'status',
        'check_out_by',
    ];

    public static function manipulateViewData()
    {
        return  DB::table('books')
            ->join('users', 'books.check_out_by', '=', 'users.id')
            ->select('books.*', 'users.name')
            ->paginate(10);
    }
}
