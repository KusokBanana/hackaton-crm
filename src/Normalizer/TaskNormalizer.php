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
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Task;
    }
}
