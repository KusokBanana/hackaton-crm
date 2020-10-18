<?php

namespace App\Command;

use App\Entity\Client;
use App\Entity\Prediction;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateTasksCommand extends Command
{
    private const MINIMUM_CHANCE = 0.9;
    protected static $defaultName = 'app:generate-tasks';
    private EntityManagerInterface $entityManager;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Generate tasks by predictions')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->addMortgage();
        $this->addConsumerCredit();
        $this->addCreditCard();

        return Command::SUCCESS;
    }

    private function addMortgage(): void
    {
        $expr = $this->entityManager->getExpressionBuilder();

        $result = $this->entityManager->createQueryBuilder()
            ->select('IDENTITY(predictions.client) as id')
            ->from(Prediction::class, 'predictions')
            ->leftJoin(
                Task::class,
                'task',
                Join::WITH,
                sprintf("predictions.client = task.client AND task.type = '%s'", Task::TASK_TYPE_MORTGAGE),
            )
            ->where(
                $expr->andX(
                    $expr->gt('predictions.mortgageChance', ':chance'),
                    $expr->isNull('task.id'),
                )
            )
            ->setParameter('chance', self::MINIMUM_CHANCE)
            ->getQuery()->getArrayResult();

        foreach ($result as $item) {

            /** @var Client $client */
            $client = $this->entityManager->getReference(Client::class, $item['id']);

            $task = new Task($client, 'Обсудить ипотеку', null, Task::TASK_TYPE_MORTGAGE);

            $this->entityManager->persist($task);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    private function addConsumerCredit(): void
    {
        $expr = $this->entityManager->getExpressionBuilder();

        $result = $this->entityManager->createQueryBuilder()
            ->select('IDENTITY(predictions.client) as id')
            ->from(Prediction::class, 'predictions')
            ->leftJoin(
                Task::class,
                'task',
                Join::WITH,
                sprintf("predictions.client = task.client AND task.type = '%s'", Task::TASK_TYPE_CONSUMER_CREDIT),
            )
            ->where(
                $expr->andX(
                    $expr->gt('predictions.consumerCreditChance', ':chance'),
                    $expr->isNull('task.id'),
                )
            )
            ->setParameter('chance', self::MINIMUM_CHANCE)
            ->getQuery()->getArrayResult();

        foreach ($result as $item) {

            /** @var Client $client */
            $client = $this->entityManager->getReference(Client::class, $item['id']);

            $task = new Task($client, 'Обсудить потребительский кредит', null, Task::TASK_TYPE_CONSUMER_CREDIT);

            $this->entityManager->persist($task);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    private function addCreditCard(): void
    {
        $expr = $this->entityManager->getExpressionBuilder();

        $result = $this->entityManager->createQueryBuilder()
            ->select('IDENTITY(predictions.client) as id')
            ->from(Prediction::class, 'predictions')
            ->leftJoin(
                Task::class,
                'task',
                Join::WITH,
                sprintf("predictions.client = task.client AND task.type = '%s'", Task::TASK_TYPE_CREDIT_CARD),
            )
            ->where(
                $expr->andX(
                    $expr->gt('predictions.creditCardChance', ':chance'),
                    $expr->isNull('task.id'),
                )
            )
            ->setParameter('chance', self::MINIMUM_CHANCE)
            ->getQuery()->getArrayResult();

        foreach ($result as $item) {

            /** @var Client $client */
            $client = $this->entityManager->getReference(Client::class, $item['id']);

            $task = new Task($client, 'Обсудить приобретение кредитной карты', null, Task::TASK_TYPE_CREDIT_CARD);

            $this->entityManager->persist($task);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}
