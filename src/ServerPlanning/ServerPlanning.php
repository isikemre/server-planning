<?php

namespace ServerPlanning;


use Exception;
use ServerPlanning\Exceptions\ResourcesTooHighException;
use ServerPlanning\Resources\BareMetalServer;
use ServerPlanning\Resources\ServerResources;
use ServerPlanning\Resources\VServer;

class ServerPlanning
{

    /**
     * @param ServerResources $serverInfo
     * @param VServer[] $virtualMachines
     * @return int
     * @throws Exception
     */
    public static function calculate(ServerResources $serverInfo, array $virtualMachines): int
    {
        if ($serverInfo->isOneOfThemHigher($virtualMachines)) {
            throw new ResourcesTooHighException("One of the given virtual machines has higher specs then the server itself.");
        }

        /** @var BareMetalServer[] $requiredServers */
        $requiredServers = [];

        foreach ($virtualMachines as $virtualMachine) {
            $added = false;

            // does it fit into a bare metal server?
            foreach ($requiredServers as $requiredServer) {
                if ($requiredServer->addVirtualMachine($virtualMachine)) {
                    $added = true;
                    break;
                }
            }

            if (!$added) {
                $newBareMetal = BareMetalServer::createFromResources($serverInfo);
                $newBareMetal->addVirtualMachine($virtualMachine);
                $requiredServers[] = $newBareMetal;
            }
        }

        return count($requiredServers);
    }

}