<?php
namespace App\Lib;

use App\Message;
use App\User;
use Twilio;
class Mobile implements \SplObserver{
    // public function __construct() {
    // }
    public function update(\SplSubject $subject) {
        $user = User::find($subject->getUserId());
        $number = substr($user->phone, 1);
        $number = '+84'.$number;
        $twilio = new Twilio('ACa1b9743c069051ae045d25911c10080d', '65ce0ba46b90f0ced7f59f09d5939748', '+14433414773');
        //var_dump($twilio);
        $twilio->message($number, $subject->getContent());
    }
}