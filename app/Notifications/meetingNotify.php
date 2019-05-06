<?php

namespace App\Notifications;

use Illuminate\Database\Eloquent\Model;

use App\User;

class meetingNotify extends Model
{
    protected $table = 'meeting_notifies';

    protected $fillable = [
        'user_id',
        'user_autor_id',
        'title',
        'texto',
        'read',
        'table_references',
        'table_references_id',
    ];


    protected function notificacoes(){
    	return meetingNotify::where('user_id', auth()->user()->id)->get();
    }

    protected function notificacoesNoLidas(){
    	return meetingNotify::where('user_id', auth()->user()->id)->where('read', false)->count();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
