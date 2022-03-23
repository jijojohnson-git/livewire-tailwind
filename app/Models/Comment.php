<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'ticket_id','images'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    //accessor
    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }

    //mutators
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }
}
