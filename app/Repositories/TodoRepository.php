<?php
namespace App\Repositories;
use App\Todo;

class TodoRepository{

    public function create($task){
        $status=0;
        $todo=Todo::create([
            "task"=>$task,
            "status"=>$status
        ]);

        return $todo;
    }

    public function markTodoAsCompleted($todo_id){
        $todo=Todo::find($todo_id);
        $todo->status=1;
        $todo->save();
        return $todo;
    }

    public function clearAllTodos(){
        Todo::truncate();
    }
}