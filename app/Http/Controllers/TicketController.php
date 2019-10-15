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
        $tickets = Ticket::all();
        return view('tickets/index', compact('tickets'));
    }

    public function show($id){
        $ticket = Ticket::find($id);
        //$this->authorize('view', $ticket);
        $comments = $ticket->comments;
        return view('tickets/show', compact('ticket', 'comments'));
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
