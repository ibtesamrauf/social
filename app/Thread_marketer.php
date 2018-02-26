<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent; 
class Thread_marketer extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'threads';
    // protected static $tables = [];
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';    

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
 
 
    protected $fillable = ['subject','belongs_to'];
    
    // public function ImageDesc(){
    //     return $this->hasMany('App\Image_order');
    // }
    
    // public function HotspotInfo(){
    //     return $this->hasMany('App\Hot_spot_info');
    // }
 	
 	public function messages()
    {
        return $this->hasMany('App\Message_marketer', 'thread_id', 'id');
    }


    /**
     * Participants relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @codeCoverageIgnore
     */
    public function participants_only_marketer()
    {
        return $this->hasMany('App\Participant_marketer', 'thread_id', 'id')
                        ->where('user_type', '=', 'marketer');
    }

    public function participants_only_influencer()
    {
        return $this->hasMany('App\Participant_marketer', 'thread_id', 'id')
                        ->where('user_type', '=', 'influencer');
    }

    public function participants_only_my_messages_marketer()
    {
        return $this->hasMany('App\Participant_marketer', 'thread_id', 'id')
                        ->where('user_id', '=', \Auth::guard('jobseeker')->user()->id);
    }

    public function participants_only_my_messages_influencer()
    {
        return $this->hasMany('App\Participant_marketer', 'thread_id', 'id')
                        ->where('user_id', '=', \Auth::user()->id);
    }

    public function users_id(){
        return $this->belongsToMany('App\User', 'participants', 'thread_id', 'user_id')
            ->select('first_name', 'email');
    }

    public function influencer_only(){
        return $this->where('user_type' , 'influencer');
    }

    /**
     * User's relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     * @codeCoverageIgnore
     */
    // public function users()
    // {
    //     return $this->belongsToMany('App\Participant_marketer', 'thread_id', 'user_id');
    // }


    // /**
    //  * Returns the latest message from a thread.
    //  *
    //  * @return \Cmgmyr\Messenger\Models\Message
    //  */
    // public function getLatestMessageAttribute()
    // {
    //     return $this->messages()->latest()->first();
    // }    

    // /**
    //  * Returns the user object that created the thread.
    //  *
    //  * @return Models::user()
    //  */
    // public function creator()
    // {
    //     if (is_null($this->creatorCache)) {
    //         $firstMessage = $this->messages()->withTrashed()->oldest()->first();
    //         $this->creatorCache = $firstMessage ? $firstMessage->user : Models::user();
    //     }

    //     return $this->creatorCache;
    // }

    // /**
    //  * Returns all of the latest threads by updated_at date.
    //  *
    //  * @return self
    //  */
    // public static function getAllLatest()
    // {
    //     return self::latest('updated_at');
    // }

    // /**
    //  * Returns all threads by subject.
    //  *
    //  * @param string $subject
    //  * @return self
    //  */
    // public static function getBySubject($subject)
    // {
    //     return self::where('subject', 'like', $subject)->get();
    // }

    // /**
    //  * Returns an array of user ids that are associated with the thread.
    //  *
    //  * @param null $userId
    //  *
    //  * @return array
    //  */
    // public function participantsUserIds($userId = null)
    // {
    //     $users = $this->participants()->withTrashed()->select('user_id')->get()->map(function ($participant) {
    //         return $participant->user_id;
    //     });

    //     if ($userId) {
    //         $users->push($userId);
    //     }

    //     return $users->toArray();
    // }

    // /**
    //  * Returns threads that the user is associated with.
    //  *
    //  * @param Builder $query
    //  * @param $userId
    //  *
    //  * @return Builder
    //  */
    // public function scopeForUser(Builder $query, $userId)
    // {
    //     $participantsTable = static::$tables['participants'];
    //     $threadsTable = static::$tables['threads'];

    //     return $query->join($participantsTable, $this->getQualifiedKeyName(), '=', $participantsTable . '.thread_id')
    //         ->where($participantsTable . '.user_id', $userId)
    //         ->where($participantsTable . '.deleted_at', null)
    //         ->select($threadsTable . '.*');
    // }

    // /**
    //  * Returns threads with new messages that the user is associated with.
    //  *
    //  * @param Builder $query
    //  * @param $userId
    //  *
    //  * @return Builder
    //  */
    // public function scopeForUserWithNewMessages(Builder $query, $userId)
    // {
    //     $participantTable = static::$tables['participants'];
    //     $threadsTable = static::$tables['threads'];

    //     return $query->join($participantTable, $this->getQualifiedKeyName(), '=', $participantTable . '.thread_id')
    //         ->where($participantTable . '.user_id', $userId)
    //         ->whereNull($participantTable . '.deleted_at')
    //         ->where(function (Builder $query) use ($participantTable, $threadsTable) {
    //             $query->where($threadsTable . '.updated_at', '>', $this->getConnection()->raw($this->getConnection()->getTablePrefix() . $participantTable . '.last_read'))
    //                 ->orWhereNull($participantTable . '.last_read');
    //         })
    //         ->select($threadsTable . '.*');
    // }

    // /**
    //  * Returns threads between given user ids.
    //  *
    //  * @param Builder $query
    //  * @param array $participants
    //  *
    //  * @return Builder
    //  */
    // public function scopeBetween(Builder $query, array $participants)
    // {
    //     return $query->whereHas('participants', function (Builder $q) use ($participants) {
    //         $q->whereIn('user_id', $participants)
    //             ->select($this->getConnection()->raw('DISTINCT(thread_id)'))
    //             ->groupBy('thread_id')
    //             ->havingRaw('COUNT(thread_id)=' . count($participants));
    //     });
    // }

    // /**
    //  * Add users to thread as participants.
    //  *
    //  * @param array|mixed $userId
    //  */
    // // public function addParticipant($userId)
    // // {
    // //     $userIds = is_array($userId) ? $userId : (array) func_get_args();

    // //     collect($userIds)->each(function ($userId) {
    // //         Models::participant()->firstOrCreate([
    // //             'user_id' => $userId,
    // //             'thread_id' => $this->id,
    // //         ]);
    // //     });
    // // }

    // // /**
    // //  * Remove participants from thread.
    // //  *
    // //  * @param array|mixed $userId
    // //  */
    // // public function removeParticipant($userId)
    // // {
    // //     $userIds = is_array($userId) ? $userId : (array) func_get_args();

    // //     Models::participant()->where('thread_id', $this->id)->whereIn('user_id', $userIds)->delete();
    // // }

    // /**
    //  * Mark a thread as read for a user.
    //  *
    //  * @param int $userId
    //  */
    // public function markAsRead($userId)
    // {
    //     try {
    //         $participant = $this->getParticipantFromUser($userId);
    //         $participant->last_read = new Carbon();
    //         $participant->save();
    //     } catch (ModelNotFoundException $e) { // @codeCoverageIgnore
    //         // do nothing
    //     }
    // }

    // /**
    //  * See if the current thread is unread by the user.
    //  *
    //  * @param int $userId
    //  *
    //  * @return bool
    //  */
    // public function isUnread($userId)
    // {
    //     try {
    //         $participant = $this->getParticipantFromUser($userId);

    //         if ($participant->last_read === null || $this->updated_at->gt($participant->last_read)) {
    //             return true;
    //         }
    //     } catch (ModelNotFoundException $e) { // @codeCoverageIgnore
    //         // do nothing
    //     }

    //     return false;
    // }

    // /**
    //  * Finds the participant record from a user id.
    //  *
    //  * @param $userId
    //  *
    //  * @return mixed
    //  *
    //  * @throws ModelNotFoundException
    //  */
    // public function getParticipantFromUser($userId)
    // {
    //     return $this->participants()->where('user_id', $userId)->firstOrFail();
    // }

    // /**
    //  * Restores all participants within a thread that has a new message.
    //  */
    // public function activateAllParticipants()
    // {
    //     $participants = $this->participants()->withTrashed()->get();
    //     foreach ($participants as $participant) {
    //         $participant->restore();
    //     }
    // }

    // /**
    //  * Generates a string of participant information.
    //  *
    //  * @param null  $userId
    //  * @param array $columns
    //  *
    //  * @return string
    //  */
    // public function participantsString($userId = null, $columns = ['name'])
    // {
    //     // $participantsTable = static::$tables['participants'];
    //     // $usersTable = static::$tables['users'];
    //     // $userPrimaryKey = Models::user()->getKeyName();

    //     // $selectString = $this->createSelectString($columns);

    //     // $participantNames = $this->getConnection()->table($usersTable)
    //     //     ->join($participantsTable, $usersTable . '.' . $userPrimaryKey, '=', $participantsTable . '.user_id')
    //     //     ->where($participantsTable . '.thread_id', $this->id)
    //     //     ->select($this->getConnection()->raw($selectString));

    //     // if ($userId !== null) {
    //     //     $participantNames->where($usersTable . '.' . $userPrimaryKey, '!=', $userId);
    //     // }

    //     // return $participantNames->implode('name', ', ');
    // }

    // /**
    //  * Checks to see if a user is a current participant of the thread.
    //  *
    //  * @param $userId
    //  *
    //  * @return bool
    //  */
    // public function hasParticipant($userId)
    // {
    //     $participants = $this->participants()->where('user_id', '=', $userId);
    //     if ($participants->count() > 0) {
    //         return true;
    //     }

    //     return false;
    // }

    // /**
    //  * Generates a select string used in participantsString().
    //  *
    //  * @param $columns
    //  *
    //  * @return string
    //  */
    // protected function createSelectString($columns)
    // {
    //     $dbDriver = $this->getConnection()->getDriverName();
    //     $tablePrefix = $this->getConnection()->getTablePrefix();
    //     $usersTable = static::$tables['users'];

    //     switch ($dbDriver) {
    //     case 'pgsql':
    //     case 'sqlite':
    //         $columnString = implode(" || ' ' || " . $tablePrefix . $usersTable . '.', $columns);
    //         $selectString = '(' . $tablePrefix . $usersTable . '.' . $columnString . ') as name';
    //         break;
    //     case 'sqlsrv':
    //         $columnString = implode(" + ' ' + " . $tablePrefix . $usersTable . '.', $columns);
    //         $selectString = '(' . $tablePrefix . $usersTable . '.' . $columnString . ') as name';
    //         break;
    //     default:
    //         $columnString = implode(", ' ', " . $tablePrefix . $usersTable . '.', $columns);
    //         $selectString = 'concat(' . $tablePrefix . $usersTable . '.' . $columnString . ') as name';
    //     }

    //     return $selectString;
    // }

    // /**
    //  * Returns array of unread messages in thread for given user.
    //  *
    //  * @param $userId
    //  *
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function userUnreadMessages($userId)
    // {
    //     $messages = $this->messages()->get();

    //     try {
    //         $participant = $this->getParticipantFromUser($userId);
    //     } catch (ModelNotFoundException $e) {
    //         return collect();
    //     }

    //     if (!$participant->last_read) {
    //         return $messages;
    //     }

    //     return $messages->filter(function ($message) use ($participant) {
    //         return $message->updated_at->gt($participant->last_read);
    //     });
    // }

    // /**
    //  * Returns count of unread messages in thread for given user.
    //  *
    //  * @param $userId
    //  *
    //  * @return int
    //  */
    // public function userUnreadMessagesCount($userId)
    // {
    //     return $this->userUnreadMessages($userId)->count();
    // }
}
