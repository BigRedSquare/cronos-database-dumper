<?php

namespace CodeWave\CronosDatabaseDumperBundle\Dumper;

use CodeWave\CronosDatabaseDumperBundle\Cron\CronConfiguration;
use CodeWave\MysqlDumperCommandBundle\Command\MysqlDumperCommand;

class MysqlDumperCommandBuilder
{
    /** @var CronConfiguration */
    private $configuration;
    /** @var  string */
    private $rootPath;

    public function __construct(CronConfiguration $configuration, $rootPath)
    {
        $this->configuration = $configuration;
        $this->rootPath = $rootPath;
    }

    /** @return string */
    public function buildCmd()
    {
        $dumperCommand = new MysqlDumperCommand();
        $dumperCommandName = $dumperCommand->getName();

        $cmd = $this->configuration->getPhpPath() . ' ' .
            $this->rootPath . '/console ' .
            $dumperCommandName . ' --env='.$this->configuration->getEnv()
            . ' --path=' . $this->configuration->getDumpsLocation()
        ;

        return $cmd;
    }
}