<?php declare(strict_types = 1);

namespace App\Normalizer;

use App\Entity\Task;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class TaskNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function normalize($result, string $format = null, array $context = []): array
    {
        /** @var Task $result */

        $client = $result->getClient();
        $prediction = $client->getPrediction();

        return [
            'id'          => $result->getId(),
            'created_at'  => $result->getCreatedAt(),
            'name'        => $result->getName(),
            'description' => $result->getDescription(),
            'date'        => $this->normalizer->normalize($result->getDate()),
            'type'        => $result->getType(),
            'phone'       => $result->getPhone(),
            'email'       => $result->getEmail(),
            'chat'        => $result->getChat(),
            'client'      => [
                'id'     => $client->getId(),
                'age'    => $client->getAge(),
                'gender' => $client->getGenderCode(),
                'active' => $client->getCity(),
                'prediction' => [
                    'mortgage_chance'        => $prediction->getMortgageChance(),
                    'consumer_credit_chance' => $prediction->getConsumerCreditChance(),
                    'get_credit_card_chance' => $prediction->getCreditCardChance(),
                ],
            ]
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Task;
    }
}
