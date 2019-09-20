<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Priority;
use App\Product;
use App\Type;

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
        $priorities = Priority::all();
        $products = Product::all();
        $types = Type::all();
        
        return view('tickets/create', compact('priorities', 'products', 'types'));
    }

    public function store() {
        $ticket = request()->all()['ticket'];
        $ticket['user_id'] = auth()->user()->id;
        $ticket = Ticket::create($ticket);
        return redirect()->action(
            'TicketController@show', ['id' => $ticket->id]
        );
    }
}
