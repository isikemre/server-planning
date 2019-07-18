<?php


use ServerPlanning\Resources\ServerResources;
use PHPUnit\Framework\TestCase;

class ServerResourcesTest extends TestCase
{

    public function testEquals()
    {
        //given
        $one = new ServerResources(12, 18, 500);
        $two = new ServerResources(12, 18, 501);

        //then
        $equals = $one->equals($two);

        $this->assertFalse($equals, "The given server resources shouldn't be equal");
    }

    public function testSumResources()
    {
        //given
        $toSum = [
            new ServerResources(12, 16, 500),
            new ServerResources(6, 8, 250),
            new ServerResources(6, 8, 250),
            new ServerResources(24, 32, 1000)
        ];

        //when
        $summed = ServerResources::sumResources($toSum);

        //then
        $this->assertEquals(48, $summed->getCpu(), "CPU should be 48 cores");
        $this->assertEquals(64, $summed->getRam(), "RAM should be 64GB");
        $this->assertEquals(2000, $summed->getHdd(), "HDD should be 2000GB");

    }

    public function testIsOneOfThemHigher()
    {
        //given
        $baseServerResources = new ServerResources(18, 24, 800);
        $virtualMachines = [
            new ServerResources(12, 16, 500),
            new ServerResources(6, 8, 250),
            new ServerResources(6, 8, 250),
            new ServerResources(24, 32, 1000)
        ];

        //when
        $isOneOfThemHigher = $baseServerResources->isOneOfThemHigher($virtualMachines);

        //then
        $this->assertTrue($isOneOfThemHigher, "One of the given virtual machines should be higher");
    }

    public function testToString()
    {
        //given
        $serverResources = new ServerResources(9, 9, 200);
        $expectedString = sprintf('[CPU: %d, RAM: %d, HDD: %d]', 9, 9, 200);

        //then
        $this->assertEquals(
            $expectedString,
            $serverResources->toString(),
            "The expected string should be: $expectedString"
        );
    }
}
