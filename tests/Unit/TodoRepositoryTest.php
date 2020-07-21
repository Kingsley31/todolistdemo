<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\TodoRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function testThatRepositoryCanCreateATodo()
    {
        //Given
        $task="Make tea";
        //When
        $todo_repository=new TodoRepository();
        $todo=$todo_repository->create($task);
        //Expect
        $this->assertEquals($todo->task,$task);
        $this->assertDatabaseHas("todos",["task"=>$task,"status"=>0]);
    }

    public function testThatRepositoryCanMarkTodoAsCompleted(){
        //Given
        $todo_repository=new TodoRepository();
        $task="Make tea";
        $todo=$todo_repository->create($task);

        //When
        $todo=$todo_repository->markTodoAsCompleted($todo->id);
        //Expect
        $this->assertEquals($todo->status,1);
    }

    public function testThatRepositoryCanClearAllTodosInDb(){
        //Given
            $todo_repository=new TodoRepository();
            $task="Make tea";
            $todo=$todo_repository->create($task);
        //When
        $todo_repository->clearAllTodos();
        //Expect
        $this->assertDatabaseMissing("todos",["task"=>$task]);
    }

   
}
