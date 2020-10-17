<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ORM\Table(name="clients")
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $age;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private string $genderCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $city;

    /**
     * @ORM\Column(type="float")
     */
    private float $mortgageDebt;

    /**
     * @ORM\Column(type="float")
     */
    private float $consumerCreditDebt;

    /**
     * @ORM\Column(type="float")
     */
    private float $cardCreditDebt;

    /**
     * @ORM\Column(type="float")
     */
    private float $currentInvoice;

    /**
     * @ORM\Column(type="float")
     */
    private float $cardInvoice;

    /**
     * @ORM\Column(type="float")
     */
    private float $savingsInvoice;

    /**
     * @ORM\Column(type="float")
     */
    private float $deposit;

    /**
     * @ORM\Column(type="float")
     */
    private float $salary;

    /**
     * @ORM\Column(type="float")
     */
    private float $transactionCost;

    /**
     * @ORM\OneToOne(targetEntity=TransactionsTotal::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private TransactionsTotal $transactionsTotal;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="client", orphanRemoval=true)
     */
    private Collection $transactions;

    /**
     * @ORM\OneToOne(targetEntity=Prediction::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private Prediction $prediction;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getGenderCode(): string
    {
        return $this->genderCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getMortgageDebt(): float
    {
        return $this->mortgageDebt;
    }

    public function getConsumerCreditDebt(): float
    {
        return $this->consumerCreditDebt;
    }

    public function getCardCreditDebt(): float
    {
        return $this->cardCreditDebt;
    }

    public function getCurrentInvoice(): float
    {
        return $this->currentInvoice;
    }

    public function getCardInvoice(): float
    {
        return $this->cardInvoice;
    }

    public function getSavingsInvoice(): float
    {
        return $this->savingsInvoice;
    }

    public function getDeposit(): float
    {
        return $this->deposit;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getTransactionCost(): float
    {
        return $this->transactionCost;
    }

    public function getTransactionsTotal(): TransactionsTotal
    {
        return $this->transactionsTotal;
    }

    public function setTransactionsTotal(TransactionsTotal $transactionsTotals): self
    {
        $this->transactionsTotal = $transactionsTotals;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setClient($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->contains($transaction)) {
            $this->transactions->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getClient() === $this) {
                $transaction->setClient(null);
            }
        }

        return $this;
    }

    public function getPrediction(): ?Prediction
    {
        return $this->prediction;
    }

    public function setPrediction(Prediction $prediction): self
    {
        $this->prediction = $prediction;

        // set the owning side of the relation if necessary
        if ($prediction->getClient() !== $this) {
            $prediction->setClient($this);
        }

        return $this;
    }
}
