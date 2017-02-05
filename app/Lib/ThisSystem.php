<?php
namespace App\Lib;

use App\Message;

class ThisSystem implements \SplObserver{
    // public function __construct() {
    // }
    public function update(\SplSubject $subject) {
        Message::create([
            'content' => $subject->getContent(),
            'user_id' => $subject->getUserId(),
            'opened' => 0,
            'requirement_id' => $subject->getRequirementId()
        ]);
    }
}