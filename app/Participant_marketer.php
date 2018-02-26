<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent; 

class Participant_marketer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'participants';

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
 
    protected $fillable = ['thread_id', 'user_id', 'user_type', 'unread' ,'last_read'];
    
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

    public function user_marketer()
    {
        return $this->belongsTo('App\Admin', 'user_id' , 'id');
    }
}
