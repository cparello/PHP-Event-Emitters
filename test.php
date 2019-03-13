<?php

//
// Question #1
// Pub/Sub Challenge
//
//
// 1. The goal is to build a very simple PubSub/event class in PHP.
//    We will create an EventEmitter object and then we'll subscribe to events and trigger them.
//    Subscribing to an event simply adds a callback to be run when the event is triggered.
//    Triggering an event (emit) should run all the attached callbacks.
// 2. Don't overthink it. The solution should only take a few minutes and a few lines of code.
//    Build only what you need to get the desired ouput.
//
// Constraints:
// 1. Although we only use error/success events, please build the class to handle arbitrary events.
// 2. Events data will always be an associative array.
// 3. A callback should always be safe to call.
//

class EventEmitter {

    private static $events = array();

    public function __construct() {}

    public function emit($name, $data) {
        if(count(self::$events)){
            call_user_func(self::$events[$name], $data);
        }
    }

    public function subscribe($name, $callback) {
        self::$events[$name] = $callback;
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

// Expected output:

// Error 1. Second error.
// Error 1. Yet another error.
// Error 2. Yet another error.
// SUCCESS! Great success!



/*

 -----------------------------------------------------------------------

  Question #2
  MySQL Queries

-- Use the following SQL Dump to write SQL queries for the 5 questions below:

CREATE TABLE Employees
    (EmployeeID int auto_increment primary key,
     DepartmentID int,
     BossID int,
     Name varchar(100),
     Salary int);

CREATE TABLE
  Departments
    (DepartmentID int auto_increment primary key,
     Name varchar(30));

INSERT INTO
  Departments
    (DepartmentID ,Name)
VALUES
    (1, "Sales"),
    (2, "Support"),
    (3, "Development");

INSERT INTO
  Employees
    (EmployeeID,
     DepartmentID,
     BossID,
     Name,
     Salary)
VALUES
    (1, 1, 1, "Jimbo Jones", 200000),
    (2, 1, 1, "John Doe", 250000),
    (3, 3, 3, "Nerdy Dev", 130000),
    (4, 3, 3, "Kevin Mitnick", 40000),
    (5, 2, 5, "Janice Smith", 50000),
    (6, 2, 5, "Support #2", 45000),
    (7, 2, 5, "Support #3", 55000),
    (8, 3, 5, "Support Dev", 75000);


-- Write the following queries:

-- 1. List employees (names) who have a bigger salary than their boss

SELECT  e.name FROM  Employees AS  e
  JOIN  Employees AS  b ON  e.BossId = b.EmployeeID
  WHERE  e.Salary > b.Salary

-- 2. List departments that have less than 3 people in it

      SELECT d.Name, COUNT(e.EmployeeID) as count FROM Departments d JOIN Employees AS e ON d.DepartmentID=e.DepartmentID GROUP BY e.DepartmentID HAVING COUNT < 3

-- 3. List all departments along with the total salary there

SELECT d.Name, SUM(e.Salary) as Total FROM Departments d JOIN Employees AS e ON d.DepartmentID=e.DepartmentID GROUP BY e.DepartmentID

-- 4. List employees that don't have a boss in the same department

SELECT  e.Name FROM  Employees AS  e
 JOIN  Employees AS  b ON  e.BossID = b.EmployeeID
 WHERE  b.DepartmentID != e.DepartmentID

-- 5. List all departments along with the number of people there

SELECT d.Name, COUNT(e.DepartmentID) as Total FROM Departments d JOIN Employees AS e ON d.DepartmentID=e.DepartmentID GROUP BY e.DepartmentID
-----------------------------------------------------------------------

  Question #3
  JavaScript

// 1. What do you think the expected output is for the following code? Can you explain why it's not working as expected?
the for loop runs first which makes the value of i 5 then it gets printed 5 times
// 2. Rewrite the code to produce the expected output (important: we need to keep the 1000ms interval!)

 for (var i=1; i<=5; ++i) {
 (function(i){
  setTimeout(() => console.log(i), 1000);
  })(i);
}

*/
