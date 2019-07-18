<?php


use ServerPlanning\Resources\VServer;
use PHPUnit\Framework\TestCase;

class VServerTest extends TestCase
{

    public function testToString()
    {
        //given
        $vServer = new VServer(1, 4, 100);
        $expectedString = sprintf('VServer [CPU: %d, RAM: %d, HDD: %d]', 1, 4, 100);

        //then
        $this->assertEquals($expectedString, $vServer->toString());
    }
}
