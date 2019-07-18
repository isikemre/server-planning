<?php

namespace ServerPlanning\Resources;


class ServerResources
{
    protected $cpu;

    protected $ram;

    protected $hdd;

    /**
     * ServerResources constructor.
     * CPU is measured in cores, RAM is measured in GB, HDD is measured GB
     * @param int $cpu
     * @param int $ram
     * @param int $hdd
     */
    public function __construct(int $cpu, int $ram, int $hdd)
    {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

    /**
     * @return int
     */
    public function getCpu(): int
    {
        return $this->cpu;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return int
     */
    public function getHdd(): int
    {
        return $this->hdd;
    }

    /**
     * Adds the resources of this ServerResources instance with the given one.
     * @param ServerResources $serverResources
     * @return ServerResources
     */
    protected function addResources(ServerResources $serverResources): ServerResources
    {
        $this->cpu += $serverResources->cpu;
        $this->ram += $serverResources->ram;
        $this->hdd += $serverResources->hdd;
        return $this;
    }

    /**
     * Returns true if one of the given ServerResources has higher specs then this instance.
     * @param ServerResources[] $manyServerResources
     * @return bool
     */
    public function isOneOfThemHigher(array $manyServerResources)
    {
        foreach ($manyServerResources as $server) {
            if ($server->cpu > $this->cpu || $server->ram > $this->ram || $server->hdd > $this->hdd) {
                return true;
            }
        }
        return false;
    }

    public function equals(ServerResources $serverResources) {
        return $this->cpu === $serverResources->cpu &&
            $this->ram === $serverResources->ram &&
            $this->hdd === $serverResources->hdd;
    }

    public function toString()
    {
        return $this->__toString();
    }

    public function __toString()
    {
        return sprintf('[CPU: %d, RAM: %d, HDD: %d]', $this->cpu, $this->ram, $this->hdd);
    }

    /**
     * Creates a new ServerResources instance with the summary of the given ones.
     * @param ServerResources[] $serverResources
     * @return ServerResources
     */
    public static function sumResources(array $serverResources)
    {
        $summary = new ServerResources(0, 0, 0);
        foreach ($serverResources as $server) {
            $summary->addResources($server);
        }
        return $summary;
    }

}