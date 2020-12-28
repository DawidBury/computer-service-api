<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUsersCommand extends Command
{
    protected static $defaultName = 'app:create-users';
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Creates new users.')->setHelp('This command allows you to create users');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '===Users Creator===',
            '',
        ]);

        $this->userService->createBasicUsers();

        $output->writeln('===END===');
        return Command::SUCCESS;
    }
}
