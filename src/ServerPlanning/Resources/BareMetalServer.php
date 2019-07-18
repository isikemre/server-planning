<?php

namespace ServerPlanning\Resources;

class BareMetalServer extends ServerResources
{

    protected $virtualMachines = [];

    /**
     * Adds the given virtual machine and if it's added it will return true, otherwise false.
     * @param VServer $virtualMachine
     * @return bool
     */
    public function addVirtualMachine(VServer $virtualMachine): bool
    {
        if ($this->fitsIn($virtualMachine)) {
            $this->virtualMachines[] = $virtualMachine;
            return true;
        }
        return false;
    }

    public function fitsIn(VServer $vServer): bool
    {
        $sum = ServerResources::sumResources($this->virtualMachines);
        $sum->addResources($vServer);

        return $this->cpu >= $sum->cpu &&
            $this->ram >= $sum->ram &&
            $this->hdd >= $sum->hdd;
    }

    public static function createFromResources(ServerResources $serverResources)
    {
        return new BareMetalServer($serverResources->cpu, $serverResources->ram, $serverResources->hdd);
    }

    public function __toString()
    {
        return sprintf('Bare Metal Server [CPU: %d, RAM: %d, HDD: %d] with %d vServers',
            $this->cpu, $this->ram, $this->hdd, count($this->virtualMachines));
    }

}