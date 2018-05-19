<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\Message;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Events\MessageWasReceived;
use Illumminate\Database\Eloquent\Model;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{

    function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = "messages.page." . request('page', 1); // message.page.#página

        $messages = Cache::remember($key, 5, function(){
            return Message::with(['user', 'note', 'tags'])
                        ->orderBy('created_at', request('sorted', 'DESC'))
                        ->Paginate(5);
        });
    
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(config('services.mailgun.domain'));
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar
        $this->validate($request,[
        'nombre'=> 'required',
        'email'=> 'required|email',
        'mensaje'=> 'required|min:5'
        ]);

        $message = Message::create($request->all());

        if (auth()->check())
            {
                auth()->user()->messages()->save($message);
            }

        Cache::flush();

        event(new MessageWasReceived ($message));

    // Redireccionar

    return redirect()->route('mensajes.create')->with('info', 'Hemos recibido tu mensaje');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Cache::remember("messages.{$id}", 5, function() use($id){
            return Message::findOrFail($id);
        });
        
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $message = Cache::remember("messages.{$id}", 5, function() use($id){
            return Message::findOrFail($id);
        });

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Validar
        $this->validate($request,[
        'nombre'=> 'required',
        'email'=> 'required|email',
        'mensaje'=> 'required|min:5'
        ]);

        Message::findOrFail($id)->update($request->all());
      
        //Redireccionamos

        Cache::flush();

        return redirect()->route('mensajes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminamos mensaje
        Message::findOrFail($id)->delete();

        Cache::flush();
        
        //Redireccionamos
        return redirect()->route('mensajes.index');    

    }
}
