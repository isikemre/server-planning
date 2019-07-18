<?php

namespace ServerPlanning\Resources;


class VServer extends ServerResources
{

    public function __toString()
    {
        return sprintf('VServer [CPU: %d, RAM: %d, HDD: %d]', $this->cpu, $this->ram, $this->hdd);
    }

}