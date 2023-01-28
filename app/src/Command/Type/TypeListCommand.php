<?php

namespace App\Command\Type;

use App\Handler\Type\TypeListHandler;
use App\Model\Risk;
use App\Model\Type;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:type:list',
    description: 'mostra tutte le tipologie di asset'
)]
class TypeListCommand extends Command
{

    public function __construct(
        private TypeListHandler $handler
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $types = $this->handler->handle();

        $table = new Table($output);
        $table->setHeaderTitle("Lista delle tipologie di asset");
        $table->setHeaders(['id', 'Name', 'code']);

        /** @var Type $type */
        foreach ($types as $type) {
            $table->addRow([$type->getId()->toRfc4122(), $type->getName(), $type->getCode()]);

        }

        $table->render();

        return Command::SUCCESS;
    }
}