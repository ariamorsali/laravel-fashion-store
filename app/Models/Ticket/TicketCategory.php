<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function adminAccesses()
    {
        return $this->hasMany(AdminTicket::class, 'category_id');
    }

    public function admins()
    {
        return $this->belongsToMany(
            User::class,
            'ticket_admin_access',
            'category_id',
            'admin_id'
        );
    }
}
