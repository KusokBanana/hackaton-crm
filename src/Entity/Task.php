<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ORM\Table(name="tasks")
 */
class Task
{
    const TASK_STATUS_OPENED = 'opened';
    const TASK_STATUS_SUCCESS = 'success';
    const TASK_STATUS_FAIL = 'fail';

    const TASK_STATUSES = [
        self::TASK_STATUS_OPENED,
        self::TASK_STATUS_SUCCESS,
        self::TASK_STATUS_FAIL,
    ];

    const TASK_TYPE_MORTGAGE = 'mortgage';
    const TASK_TYPE_CONSUMER_CREDIT = 'consumer_credit';
    const TASK_TYPE_CREDIT_CARD = 'credit_card';

    const TASK_TYPES = [
        self::TASK_TYPE_MORTGAGE,
        self::TASK_TYPE_CONSUMER_CREDIT,
        self::TASK_TYPE_CREDIT_CARD,
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="id", initialValue=1)
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private Client $client;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $closedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $type;

    /**
     * @ORM\Column(type="boolean", options={ "default": false })
     */
    private bool $phone;

    /**
     * @ORM\Column(type="boolean", options={ "default": false })
     */
    private bool $email;

    /**
     * @ORM\Column(type="boolean", options={ "default": false })
     */
    private bool $chat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $status;

    public function __construct(
        Client $client,
        string $name,
        ?string $description = null,
        ?string $type = null,
        ?\DateTimeInterface $date = null,
        bool $phone = false,
        bool $email = false,
        bool $chat = false
    )
    {
        $this->createdAt = new \DateTime();
        $this->status = self::TASK_STATUS_OPENED;

        $this->client = $client;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->date = $date;
        $this->phone = $phone;
        $this->email = $email;
        $this->chat = $chat;
    }

    public function close(string $status, ?string $description): void
    {
        $this->status = $status;
        $this->closedAt = new \DateTime();
        $this->description = $description ?: $this->description;
    }

    public function restore(): void
    {
        $this->status = self::TASK_STATUS_OPENED;
        $this->closedAt = null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function getClosedAt(): ?\DateTimeInterface
    {
        return $this->closedAt;
    }

    public function getPhone(): bool
    {
        return $this->phone;
    }

    public function getEmail(): bool
    {
        return $this->email;
    }

    public function getChat(): bool
    {
        return $this->chat;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
