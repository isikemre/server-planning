<?php


use PHPUnit\Framework\TestCase;
use ServerPlanning\Exceptions\ResourcesTooHighException;
use ServerPlanning\ServerPlanning;
use ServerPlanning\Resources\ServerResources;
use ServerPlanning\Resources\VServer;

class ServerPlanningTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function testCalculate()
    {
        //given
        $resources = new ServerResources(8, 32, 1000);
        $virtualMachines = [
            new VServer(4, 16, 100),
            new VServer(2, 8, 100),
            new VServer(8, 32, 300)
        ];

        //when
        $count = ServerPlanning::calculate($resources, $virtualMachines);

        //then
        $this->assertEquals(2, $count);
    }

    /**
     * @throws Exception
     */
    public function testResourcesTooHighException()
    {
        //given
        $resources = new ServerResources(8, 32, 1000);
        $virtualMachines = [
            new VServer(4, 16, 100),
            new VServer(9, 1, 20), //this one is higher (only cpu)
            new VServer(2, 8, 100)
        ];

        //then
        $this->expectException(ResourcesTooHighException::class);

        //when
        ServerPlanning::calculate($resources, $virtualMachines);
    }

}
