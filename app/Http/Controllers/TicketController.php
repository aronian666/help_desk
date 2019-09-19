<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketController extends Controller
{
    public function index(){
        $tickets = auth()->user()->tickets;
        return view('tickets/index', compact('tickets'));
    }

    public function show($id){
        $ticket = Ticket::find($id);
        $this->authorize('view', $ticket);
        return view('tickets/show', compact('ticket'));
    }

    public function create(){
        return 'este es para crear';
    }
}
