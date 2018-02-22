<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Participant_marketer;
use App\Thread_marketer;
use App\Message_marketer;
use App\Admin;

class MessagesinfluencerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['auth','isVerified']);
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        // $threads = Thread_marketer::getAllLatest()->get();

        // $threads = Thread_marketer::with('participants.messages')->get();
        
        $threads = Thread_marketer::with(['participants_only_marketer', 'messages'])
                    // ->where('participants.user_type' , 'influencer')
                    ->orderBy('id' , 'DESC')
                    ->get();
        // $threads = Thread_marketer::with(['users_id'])->get();
    
        // vv($threads);
        return view('messenger_influencer.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread_marketer::with('messages')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }
        $users = "";
        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        // $userId = Auth::id();
        // $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
        $date = new Carbon();
        $participant = Participant_marketer::with('messages')
                            ->where('thread_id', $id)
                            // ->where('user_id' , Auth::guard('jobseeker')->user()->id)
                            ->where('user_type' , 'marketer')
                            ->update([
                                'last_read' => $date,
                                'unread' => 2,
                                ]);
                            // ->update([  ]);
        
        // $thread->markAsRead($userId);
        // vv($thread);
        return view('messenger_influencer.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = Admin::get();

        return view('messenger_influencer.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        // vv("here");
        $input = Input::all();

        $thread = Thread_marketer::create([
            'subject' => $input['subject'],
        ]);

        // Message
        Message_marketer::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::user()->id,
            'body'      => $input['message'],
            'unread'    => 1,
            'user_type' => 'influencer',
        ]);

        // Sender
        Participant_marketer::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::user()->id,
            'last_read' => new Carbon,
            'unread'    => 1,
            'user_type' => 'influencer',
        ]);

        // Recipients
        if (Input::has('recipients')) {
            Participant_marketer::create([
                'thread_id' => $thread->id,
                'user_id'   => $input['recipients'][0],
                'last_read' => new Carbon,
                'unread'    => 2,
                'user_type' => 'marketer',
            ]);
            // $thread->addParticipant($input['recipients']);
        }

        return redirect()->route('messages_influencer');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread_marketer::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages_influencer');
        }

        // $thread->activateAllParticipants();

        // Message
        Message_marketer::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::user()->id,
            'user_type' => 'influencer',
            'body' => Input::get('message'),
            'unread' => 1,            
        ]);

        // Add replier as a participant
        $participant = Participant_marketer::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::user()->id,
            'user_type' => 'influencer',

        ]);
        $participant->last_read = new Carbon;
        $participant->unread = 1;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect()->route('messages_influencer.show', $id);
    }
}
