<?php

namespace App\Entity;

use App\Repository\PredictionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PredictionRepository::class)
 * @ORM\Table(name="predictions")
 */
class Prediction
{

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="prediction", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Client $client;

    /**
     * @ORM\Column(type="float")
     */
    private float $mortgageChance;

    /**
     * @ORM\Column(type="float")
     */
    private float $consumerCreditChance;

    /**
     * @ORM\Column(type="float")
     */
    private float $creditCardChance;

    /**
     * @ORM\Column(type="float", options={ "default": 0 })
     */
    private float $sumChance;

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getMortgageChance(): float
    {
        return $this->mortgageChance;
    }

    public function getConsumerCreditChance(): float
    {
        return $this->consumerCreditChance;
    }

    public function getCreditCardChance(): float
    {
        return $this->creditCardChance;
    }

    public function getSumChance(): float
    {
        return $this->sumChance;
    }
}
