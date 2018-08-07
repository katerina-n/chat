<?php
declare(strict_types=1);
namespace AppBundle\Service;

use AppBundle\Entity\ChatMessages;
use AppBundle\Managers\ChatManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class MessageService
 * @package AppBundle\Service
 */
class MessageService
{
    /**
     * @var ChatManager
     */
    protected $chatManagers;

    /**
     * MessageService constructor.
     * @param ChatManager $chatManagers
     */
    public function __construct(ChatManager $chatManagers)
    {
        $this->chatManagers = $chatManagers;

    }

}