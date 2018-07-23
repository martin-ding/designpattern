<?php

/*创建一个命令对象*/
interface Command
{
    public function execute();
}

/*车库门打开命令 实现了Command命令*/
class GarageDoorOpenCommand implements Command
{
    protected $garageDoor;

    public function __construct(GarageDoor $garageDoor)
    {
        $this->garageDoor = $garageDoor;
    }

    public function execute()
    {
        $this->garageDoor->open();
    }
}

/*仓库打开程序*/
class GarageDoor
{
    public function open()
    {
        echo "garage door is opening ..... <br/>";
    }
}

/*相当于服务员 能够接受命令*/
class RemoteController
{
    protected $command;

    public function setCommand(Command $command)
    {
        $this->command = $command;
    }

    public function executeCommand()
    {
        $this->command->execute();
    }
}

$controller = new RemoteController();
$controller->setCommand(new GarageDoorOpenCommand(new GarageDoor()));
$controller->executeCommand();
