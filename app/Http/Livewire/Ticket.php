<?php

namespace App\Http\Livewire;

use App\Models\Ticket as SupportTicket;
use Livewire\Component;

class Ticket extends Component
{
    public $active;

    protected $listeners = ['TicketSelected'];

    public function TicketSelected($ticket)
    {
        $this->active = $ticket;
    }

    public function render()
    {
        return view('livewire.ticket' , [ 'tickets' => SupportTicket::all()]);
    }
}
