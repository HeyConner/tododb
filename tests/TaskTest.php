<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class TaskTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown(){
            Task::deleteAll();
        }

        function test_save()
        {
            $description = "Wash the dog";
            $test_task = new Task($description);

            $test_task->save();

            $result = Task::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Task($description);
            $test_task->save();
            $test_task2 = new Task($description2);
            $test_task2->save();

            $result = Task::getAll();

            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_getId()
        {
            $description = "Wash the dog";
            $id = 1;
            $test_Task = new Task($description, $id);

            $result = $test_Task->getId();

            $this->assertEquals(1, $result);
        }

        function test_find(){
            $description = "FIRST TASK";
            $description2 = "last task";
            $test_task = new Task($description);
            $test_task->save();

            $test_task2 = new Task($description2);
            $test_task2->save();

            $id = $test_task->getId();
            $result = Task::find($id);

            $this->assertEquals($test_task, $result);
        }
    }
?>
