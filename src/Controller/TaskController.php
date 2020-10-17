<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Task;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    private ClientRepository $clientRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ClientRepository $clientRepository, EntityManagerInterface $entityManager)
    {
        $this->clientRepository = $clientRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/tasks", name="task", methods={"GET"}) // todo POST
     */
    public function create(Request $request)
    {
        $clientId = $request->query->get('client_id');

        $client = $this->clientRepository->find($clientId);

        if (!$client instanceof Client) {
            throw new BadRequestHttpException('Unknown client_id');
        }

        $name = $request->query->get('name');

        if (!is_string($name)) {
            throw new BadRequestHttpException('Incorrect name');
        }

        $date = $request->query->get('date');
        $date = $date ? \DateTime::createFromFormat('Y-m-d', $date) : null;

        $task = new Task(
            $client,
            $request->query->get('name'),
            $request->query->get('description'),
            $request->query->get('type'),
            $date,
            (bool) $request->query->get('phone'),
            (bool) $request->query->get('email'),
            (bool) $request->query->get('chat'),
        );

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
