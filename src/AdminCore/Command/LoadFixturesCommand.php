<?php

namespace App\AdminCore\Command;

use App\AdminCore\Fixtures\ProductFixtures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:fixtures:load')]
class LoadFixturesCommand extends Command
{
    /**
     * @var int
     */
    private int $numberToLoad;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, string $name = null)
    {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        for ($i = 0; $i < $this->random(); $i++)
        {
            $product = (new ProductFixtures)->create();
            $em = $this->entityManager;
            $em->persist($product);
        }

        try
        {
            $em->flush();
        }
        catch (\Exception $exception)
        {
            $output->writeln('Unable to flush fixtures : ' . $exception->getMessage());
            return Command::FAILURE;
        }

        $output->writeln("Successfully generated fixtures");
        return Command::SUCCESS;
    }

    /**
     * Generate random number of fixtures to load
     * Min 10 Max 30
     *
     * @return int
     */
    private function random(): int
    {
        $this->numberToLoad = mt_rand(10, 30);

        return $this->numberToLoad;
    }
}