<?php

namespace App\Entity;

use App\Repository\TransactionsTotalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionsTotalRepository::class)
 * @ORM\Table(name="transactions_totals")
 */
class TransactionsTotal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="id", initialValue=1)
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, mappedBy="TransactionsTotals", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private Client $client;

    /**
     * @ORM\Column(type="float")
     */
    private float $retailCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $retailCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $autoCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $autoCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $phoneCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $phoneCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $utilitiesCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $utilitiesCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $nationCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $nationCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $personalCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $personalCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $shopsCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $shopsCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $clothesCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $clothesCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $rentCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $rentCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $contractCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $contractCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $transportCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $transportCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $buildingCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $buildingCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $profCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $prodCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $businessCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $businessCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $feeCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $feeCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $airCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $airCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $vendorsCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $vendorsCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $hotelsCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $hotelsCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $entertainmentCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $entertainmentCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $financeCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $financeCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $otherCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $otherCount;

    /**
     * @ORM\Column(type="float")
     */
    private float $totalCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $totalCount;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRetailCost(): float
    {
        return $this->retailCost;
    }

    public function getRetailCount(): int
    {
        return $this->retailCount;
    }

    public function getAutoCost(): float
    {
        return $this->autoCost;
    }

    public function getAutoCount(): int
    {
        return $this->autoCount;
    }

    public function getPhoneCost(): float
    {
        return $this->phoneCost;
    }

    public function getPhoneCount(): int
    {
        return $this->phoneCount;
    }

    public function getUtilitiesCost(): float
    {
        return $this->utilitiesCost;
    }

    public function getUtilitiesCount(): int
    {
        return $this->utilitiesCount;
    }

    public function getNationCost(): float
    {
        return $this->nationCost;
    }

    public function getNationCount(): int
    {
        return $this->nationCount;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        // set the owning side of the relation if necessary
        if ($client->getTransactionsTotal() !== $this) {
            $client->setTransactionsTotal($this);
        }

        return $this;
    }
}
