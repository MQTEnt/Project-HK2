<?php
namespace App\Lib;

class NotiRequirement implements \SplSubject{
    private $observers = array();
    private $content;
    private $user_id;
    private $requirement_id;
    public function __construct($user_id, $requirement_id) {
        $this->user_id = $user_id;
        $this->requirement_id = $requirement_id;
    }

    //Add observer
    public function attach(\SplObserver $observer) {
        $this->observers[] = $observer;
    }
    
    //Remove observer
    public function detach(\SplObserver $observer) {
        
        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }
    
    //Push notification
    public function pushNoti($content) {
        $this->content = $content;
        $this->notify();
    }
    
    public function getContent() {
        return $this->content;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getRequirementId() {
        return $this->requirement_id;
    }
    //Notify observers
    public function notify() {
        foreach ($this->observers as $value) {
            $value->update($this);
        }
    }
}
