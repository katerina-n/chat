<?php
declare(strict_types=1);
namespace AppBundle\Service;

use AppBundle\Entity\Account;
use AppBundle\Entity\Message;
use AppBundle\Managers\ChatManager;
use AppBundle\Entity\Chat;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ChatService
 */
class ChatService
{
    /**
     * @var ChatManager
     */
    protected $chatManagers;
    /**
     * @var PaginatorInterface
     */
    protected $knpPagination;
    /**
     * ChatService constructor.
     * @param ChatManager $chatManagers
     * @param PaginatorInterface $knpPagination
     */
    public function __construct(ChatManager $chatManagers, PaginatorInterface $knpPagination)
    {
        $this->chatManagers = $chatManagers;
        $this->knpPagination = $knpPagination;
    }

    /**
     * @param array $array
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveinDatebase(array $array): void
    {
        for ($i = 0; $i <= count($array) - 1; $i++) {
            $account = new Account();
            $account->setType('visitor')
                    ->setName($array[$i]->getObj())
                    ->setEmail('user1@user');
            $chat = new Chat();
            $chat->setAgents($account)
                 ->setVisitor($account);

            $message = new Message();
            $message->setText($array[$i]->getChat())
                    ->setDatetime($array[$i]->getDate())
                    ->setChat($chat);
            $this->chatManagers->getEntityManager()->persist($account);
            $this->chatManagers->getEntityManager()->persist($chat);
            $this->chatManagers->getEntityManager()->persist($message);
            $this->chatManagers->getEntityManager()->flush();

            }
    }

    /**
     * @param array $array
     * @param int $page
     */
    public function outputChatWithPagination(array $array, int $page = 1)
    {

        return $this->knpPagination->paginate($array, $page, 5);
    }




}