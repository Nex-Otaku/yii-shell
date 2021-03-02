<?php

namespace NexOtaku\YiiShell;

use Psr\Container\ContainerInterface;
use Psy\Configuration;
use Psy\Shell;
use Psy\VersionUpdater\Checker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShellCommand extends Command
{
    protected static $defaultName = 'shell';

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Interactive REPL shell')
            ->setHelp('Tell you app what to do.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ServiceLocator::getInstance()->registerContainer($this->container);

        $config = Configuration::fromInput($input);
        $config->setUpdateCheck(Checker::NEVER);
        $config->setStartupMessage('Let\'s make Yii great again!');
        $shell = new Shell($config);
        $shell->setIncludes($this->getIncludes());

        return $shell->run();
    }

    private function getIncludes(): array
    {
        return [
            __DIR__ . DIRECTORY_SEPARATOR . 'functions.php',
        ];
    }
}