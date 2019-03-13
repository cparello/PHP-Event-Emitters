<?php
class EventEmitter {

    private static $events = array(); // all subscriptions

    public function __construct() {}

// calls the last subscription on the stack

    public function emit($name, $data) {
//        echo "emit\n";
        if(count(self::$events)){
            call_user_func(self::$events[$name], $data);
        }

    }

// adds subscriptions to the stack

    public function subscribe($name, $callback) {
//        echo "subscribe\n";
        self::$events[$name] = $callback;
//        var_dump(self::$events);
    }

}

$emitter = new EventEmitter;

$error_callback = function($data) {
    echo "Error 1. {$data["message"]} \n";
};

$error_callback2 = function($data) {
    echo "Error 2. {$data["message"]} \n";
};

$success_callback = function($data) {
    echo "SUCCESS! {$data["message"]} \n";
};

$emitter->emit("error", ["message" => "Error one."]);

$emitter->subscribe("error", $error_callback);
$emitter->emit("error", ["message" => "Second error."]);

$emitter->subscribe("error", $error_callback2);
$emitter->emit("error", ["message" => "Yet another error."]);

$emitter->subscribe("success", $success_callback);
$emitter->emit("success", ["message" => "Great success!."]);


