<?php
declare(strict_types=1);
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Chat
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChatRepository")
 */
class Chat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Many Chats have One Account.
     *
     * @ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="id")
     * @JoinColumn(name="visitor_id", referencedColumnName="id")
     */
    private $visitor;

    /**
     * Many Chats have One Account.
     *
     * @ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="id")
     * @JoinColumn(name="agent_id", referencedColumnName="id")
     */
    private $agents;

    /**
     * One Chat has Many Messages.
     *
     * @OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="chat")
     */
    private $messages;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set visitorId.
     *
     * @param integer $visitor
     *
     * @return Chat
     */
    public function setVisitor($visitor)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * Get visitorId.
     *
     * @return mixed
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * Set agentsId.
     *
     * @param array $agents
     *
     * @return Chat
     */
    public function setAgents($agents)
    {
        $this->agents = $agents;

        return $this;
    }

    /**
     * Get agents.
     *
     * @return mixed
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * Gets Messages.
     *
     * @return ArrayCollection|Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Sets Messages.
     *
     * @param ArrayCollection|Message[] $messages
     *
     * @return $this
     */
    public function setMessages($messages): self
    {
        foreach ($messages as $message) {
            $this->addMessage($message);
        }

        return $this;
    }

    /**
     * Add message.
     *
     * @param Message $message
     *
     * @return $this
     */
    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $message->setChat($this);
            $this->messages->add($message);
        }

        return $this;
    }

    /**
     * Remove message.
     *
     * @param Message $message
     *
     * @return $this
     */
    public function removeMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->removeElement($message);
        }
        return $this;
    }
}
