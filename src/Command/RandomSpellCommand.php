<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomSpellCommand extends Command
{
    protected static $defaultName = 'random-spell';

    protected function configure()
    {
        $this
            ->setDescription('Cast a random Spell')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your Name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'Yell!!')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');

        if ($yourName) {
            $io->note(sprintf('Hi %s', $yourName));
        }

        $spells = [
          'hakjgfkajsfk',
          'bjabfijkansjfk',
          'uahdfihafsas',
          'bajfbjkanfsjk'
        ];

        $spell = $spells[array_rand($spells)];

        if ($input->getOption('yell')) {
            $spell = strtoupper($spell);
        }

        $io->success($spell);

        return Command::SUCCESS;
    }
}
