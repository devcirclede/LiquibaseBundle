<?php
declare(strict_types = 1);

namespace Freesoftde\LiquibaseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FreesoftdeLiquibaseBundle extends Bundle
{

    public function getPath()
    {
        return dirname(__DIR__);
    }
}