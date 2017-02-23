<?php
namespace App\Lib;

use App\Message;
use App\User;
use Mail;
class Email implements \SplObserver{
    public function update(\SplSubject $subject) {
        $user = User::find($subject->getUserId());
        Mail::send('email', ['content' => $subject->getContent()], function($message) use ($user){
            $message->to($user->email, $user->name)->subject("Thông báo từ hệ thống Let's Support");
        });
    }
}