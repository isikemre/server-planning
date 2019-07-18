<?php


use PHPUnit\Framework\TestCase;
use ServerPlanning\Resources\BareMetalServer;
use ServerPlanning\Resources\ServerResources;
use ServerPlanning\Resources\VServer;

class BareMetalServerTest extends TestCase
{

    public function testAddVirtualMachine()
    {
        //given
        $bareMetal = new BareMetalServer(8, 32, 1000);
        $virtualMachine = new VServer(6, 24, 600);

        //when
        $added = $bareMetal->addVirtualMachine($virtualMachine);

        //then
        $this->assertTrue($added, "The bare metal server should add the vServer with lower specs");
    }

    public function testFailingAddVirtualMachine()
    {
        //given
        $bareMetal = new BareMetalServer(8, 32, 1000);
        $virtualMachine = new VServer(2, 64, 100);

        //when
        $added = $bareMetal->addVirtualMachine($virtualMachine);

        //then
        $this->assertFalse($added, "The bare metal server should NOT add the vServer with lower specs");
    }

    public function testCreateFromResources()
    {
        //given
        $resources = new ServerResources(4, 16, 500);

        //when
        $bareMetalFromResources = BareMetalServer::createFromResources($resources);

        //then
        $this->assertTrue(
            $bareMetalFromResources->equals($resources),
            "The bare metal server should equals with the given server resources"
        );
    }

    public function testToString()
    {
        //given
        $bareMetal = new BareMetalServer(8, 32, 1000);
        $expectedString = sprintf('Bare Metal Server [CPU: %d, RAM: %d, HDD: %d] with %d vServers', 8, 32, 1000, 0);

        //then
        $this->assertEquals($expectedString, $bareMetal->toString());
    }

    public function testFitsIn()
    {
        //given
        $bareMetal = new BareMetalServer(8, 32, 1000);
        $virtualMachine = new VServer(100, 24, 6000);

        //when
        $fitsIn = $bareMetal->fitsIn($virtualMachine);

        //then
        $this->assertFalse($fitsIn, "The vServer with higher specs should not fit into the given bare metal server");
    }
}
