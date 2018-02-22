<?php

// namespace Cmgmyr\Messenger\Models;
namespace App;

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Model as Eloquent;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Eloquent; 

class Message_marketer extends Eloquent
{
    // use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    // protected $touches = ['thread'];

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['thread_id', 'user_id', 'user_type', 'body', 'unread'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * {@inheritDoc}
     */
    // public function __construct(array $attributes = [])
    // {
    //     // $this->table = Models::table('messages');

    //     parent::__construct($attributes);
    // }

    /**
     * Thread relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function thread()
    {
        return $this->belongsTo('App\Thread_marketer', 'thread_id', 'id');
    }

    /**
     * User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id' , 'id');
    }

    public function marketer()
    {
        return $this->belongsTo('App\Admin', 'user_id' , 'id');
    }

    /**
     * Participants relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @codeCoverageIgnore
     */
    public function participants()
    {
        return $this->hasMany('App\Participant_marketer', 'thread_id', 'thread_id');
    }

    /**
     * Recipients of this message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function recipients()
    // {
    //     return $this->participants()->where('user_id', '!=', $this->user_id);
    // }

    /**
     * Returns unread messages given the userId.
     *
     * @param Builder $query
     * @param $userId
     * @return Builder
     */
    // public function scopeUnreadForUser(Builder $query, $userId)
    // {
    //     return $query->has('thread')
    //         ->where('user_id', '!=', $userId)
    //         ->whereHas('participants', function (Builder $query) use ($userId) {
    //             $query->where('user_id', $userId)
    //                 ->where(function (Builder $q) {
    //                     $q->where('last_read', '<', DB::raw($this->getTable() . '.created_at'))
    //                         ->orWhereNull('last_read');
    //                 });
    //         });
    // }
}