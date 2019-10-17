<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Priority;
use App\Product;
use App\Type;
use App\Status;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::all();
        $statuses = Status::find([1, 2, 3, 6]);
        return view('tickets/index', compact('tickets', 'statuses'));
    }

    public function show($id){
        $ticket = Ticket::find($id);
        //$this->authorize('view', $ticket);
        $comments = $ticket->comments;
        $statuses = Status::find([1, 2, 3, 6]);
        return view('tickets/show', compact('ticket', 'comments', 'statuses'));
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
        $ticket['status_id'] = 1;
        $ticket = Ticket::create($ticket);
        return redirect()->action(
            'TicketController@show', ['id' => $ticket->id]
        );
    }
}
