<?php

declare(strict_types=1);

namespace AppBundle\Managers;

use AppBundle\Entity\Chat;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class ChatManager.
 */
class ChatManager
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
            $this->repository = $this->entityManager->getRepository(Chat::class);
        }

        return $this->repository;
    }


    /**
     * @param int $limit
     * @return Chat
     */
    public function findLastId(int $limit): Chat
    {

        return $this->getRepository()->createQueryBuilder('chat')
            ->setMaxResults($limit)
            ->orderBy('chat.id', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

}
