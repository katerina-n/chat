<?php
declare(strict_types=1);
namespace AppBundle\Managers;

use AppBundle\Entity\Message;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class MessagesManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * AbstractManager constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Gets EntityManager.
     *
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }



    /**
     * @return EntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        if (!$this->repository) {
            $this->repository = $this->entityManager->getRepository(Message::class);
        }

        return $this->repository;
    }




}