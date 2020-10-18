<?php declare(strict_types = 1);

namespace App\Normalizer;

use App\Entity\Client;
use App\Entity\Prediction;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class PredictionNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    public function normalize($result, string $format = null, array $context = []): array
    {
        /** @var Prediction $result */

        return [
            'mortgage_chance'        => $result->getMortgageChance(),
            'consumer_credit_chance' => $result->getConsumerCreditChance(),
            'credit_card_chance'     => $result->getCreditCardChance(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Prediction;
    }
}
