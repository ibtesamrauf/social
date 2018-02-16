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


class MessagesmarketerController extends Controller
{

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
// alert-info
        // $count1 = \App\Exceptions\Handler::newMessageCount();
        // vv($count1);
        // for user id
        // vv(Auth::guard('jobseeker')->user()->id);


        // All threads, ignore deleted/archived participants
        // $threads = Thread_marketer::getAllLatest()->get();

        // $threads = Thread_marketer::with('participants.messages')->get();
        
        $threads = Thread_marketer::with(['participants_only_influencer', 'messages'])
                            ->orderBy('id' , 'DESC')
                            ->get();

        // All threads that user is participating in
        // $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();
        // vv($threads[0]->participants[0]->unread);
        // foreach ($threads[0]->participants as $key => $value) {
        //     v($value);
        //     # code...
        // }
            // vv($threads);

        return view('messenger_marketer.index', compact('threads'));
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
                            ->where('user_type' , 'influencer')
                            ->update([
                                'last_read' => $date,
                                'unread' => 2,
                                ]);
                            // ->update([  ]);
        
        // $thread->markAsRead($userId);
        // vv($thread);
        return view('messenger_marketer.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger_marketer.create', compact('users'));
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
            'user_id'   => Auth::guard('jobseeker')->user()->id,
            'body'      => $input['message'],
            'unread'    => 2,
            'user_type' => 'marketer',
        ]);

        // Sender
        Participant_marketer::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::guard('jobseeker')->user()->id,
            'last_read' => new Carbon,
            'unread'    => 1,
            'user_type' => 'marketer',
        ]);

        // Recipients
        if (Input::has('recipients')) {
            Participant_marketer::create([
                'thread_id' => $thread->id,
                'user_id'   => $input['recipients'][0],
                'last_read' => new Carbon,
                'unread'    => 1,
                'user_type' => 'influencer',
            ]);
            // $thread->addParticipant($input['recipients']);
        }

        return redirect()->route('messages_marketer');
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

            return redirect()->route('messages_marketer');
        }

        // $thread->activateAllParticipants();

        // Message
        Message_marketer::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::guard('jobseeker')->user()->id,
            'user_type' => 'marketer',
            'body' => Input::get('message'),
            'unread' => 1,            
        ]);

        // Add replier as a participant
        $participant = Participant_marketer::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::guard('jobseeker')->user()->id,
            'user_type' => 'marketer',

        ]);
        $participant->last_read = new Carbon;
        $participant->unread = 1;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect()->route('messages_marketer.show', $id);
    }
}
