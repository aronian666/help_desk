<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Priority;
use App\Product;
use App\Type;
use App\Status;
use App\User;
use App\Attachment;

class TicketController extends Controller
{
    public function index(){
        $user = Auth()->user();
        $tickets = Ticket::orderBy('id')->get();
        $statuses = Status::find([1, 2, 3, 6]);
        return view('tickets/index', compact('tickets', 'statuses', 'user'));
    }

    public function show($id){
        $ticket = Ticket::find($id);
        $user = Auth()->user();
        $technicals = $ticket->technical ? [$ticket->technical] : User::where('role_id', 3)->get();
        $comments = $ticket->comments;
        $statuses = Status::find([1, 2, 3, 6]);
        $attachments = $ticket->attachments;
        $colors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black'];
        return view('tickets/show', compact('attachments', 'technicals', 'ticket', 'comments', 'statuses', 'user', 'colors'));
    }

    public function create(){
        $this->authorize('create', Ticket::class);
        $priorities = Priority::all();
        $user = Auth()->user();
        $products = Product::all();
        $types = Type::all();
        $colors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black'];
        return view('tickets/create', compact('priorities', 'products', 'types', 'colors', 'user'));
    }

    public function store(Request $request) {
        $ticket = request()->all()['ticket'];
        $ticket['user_id'] = auth()->user()->id;
        $ticket['status_id'] = 1;
        $ticket = Ticket::create($ticket);
        if (request()->all()['ticket']['attachments']){
            foreach (request()->all()['ticket']['attachments'] as $attachment) {
                $attachment['ticket_id'] = $ticket->id;
                $attachment['user_id'] = auth()->user()->id;
                Attachment::create($attachment);
            }
        }
        return redirect()->action(
            'TicketController@show', ['id' => $ticket->id]
        );
    }

    public function update(Request $request, $id) {
        //dd($request->all()['ticket']);
        $ticket = Ticket::find($id);
        $ticket->update($request->all()['ticket']);
        return redirect()->action(
            'TicketController@show', ['id' => $ticket->id]
        );
    }
}
