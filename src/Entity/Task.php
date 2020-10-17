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
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $date;

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

    public function __construct(
        Client $client,
        string $name,
        ?string $description,
        ?string $type,
        ?\DateTimeInterface $date,
        bool $phone,
        bool $email,
        bool $chat
    )
    {
        $this->client = $client;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->date = $date;
        $this->phone = $phone;
        $this->email = $email;
        $this->chat = $chat;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
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
}
