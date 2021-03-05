<?php

namespace NexOtaku\YiiShell;

use Psr\Container\ContainerInterface;
use Psy\Configuration;
use Psy\Shell;
use Psy\VersionUpdater\Checker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Yiisoft\Yii\Console\CommandLoader;

class ShellCommand extends Command
{
    protected static $defaultName = 'shell';

    private ContainerInterface $container;

    private CommandLoaderInterface $commandLoader;

    public function __construct(ContainerInterface $container, CommandLoaderInterface $commandLoader)
    {
        parent::__construct();
        $this->container = $container;
        $this->commandLoader = $commandLoader;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Interactive REPL shell')
            ->setHelp('Tell you app what to do.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $config = Configuration::fromInput($input);
        $config->setUpdateCheck(Checker::NEVER);
        $config->setStartupMessage('Let\'s make Yii great again!');
        $shell = new Shell($config);
        $shell->addCommands($this->getCommands());
        $shell->setScopeVariables([
            'app' => $this->container,
        ]);

        return $shell->run();
    }

    protected function getCommands()
    {
        $names = $this->commandLoader->getNames();
        $commands = array_map(fn($name) => $this->commandLoader->get($name), $names);

        return $commands;
    }

}
