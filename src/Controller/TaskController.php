<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Task;
use App\Repository\ClientRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    private ClientRepository $clientRepository;
    private EntityManagerInterface $entityManager;
    private TaskRepository $taskRepository;

    public function __construct(
        ClientRepository $clientRepository,
        EntityManagerInterface $entityManager,
        TaskRepository $taskRepository
    )
    {
        $this->clientRepository = $clientRepository;
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/tasks/active", name="tasks-active")
     */
    public function active(): JsonResponse
    {
        $filter = ['status' => [Task::TASK_STATUS_OPENED]];
        $order = ['createdAt' => 'DESC'];
        $tasks = $this->taskRepository->findBy($filter, $order, 100);
        $total = $this->taskRepository->count($filter);

        return $this->json([
            'data' => $tasks,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/tasks/inactive", name="tasks-inactive")
     */
    public function inactive(): JsonResponse
    {
        $filter = ['status' => [Task::TASK_STATUS_FAIL, Task::TASK_STATUS_SUCCESS]];
        $order = ['closedAt' => 'DESC'];
        $tasks = $this->taskRepository->findBy($filter, $order, 100);
        $total = $this->taskRepository->count($filter);

        return $this->json([
            'data' => $tasks,
            'total' => $total,
        ]);
    }

    /**
     * @Route("/tasks/create", name="tasks-create", methods={"GET"}) // todo POST
     */
    public function create(Request $request): Response
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
            $request->query->get('phone') === 'true',
            $request->query->get('email') === 'true',
            $request->query->get('chat') === 'true',
        );

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/tasks/complete", name="tasks-complete", methods={"GET"}) // todo POST
     */
    public function complete(Request $request): Response
    {
        $id = $request->query->get('id');

        $task = $this->taskRepository->find($id);

        if (!$task instanceof Task) {
            throw new NotFoundHttpException('Unknown task');
        }

        $status = $request->query->get('status');

        if (!in_array($status, [Task::TASK_STATUS_SUCCESS, Task::TASK_STATUS_FAIL])) {
            throw new BadRequestHttpException('Incorrect status');
        }

        $description = $request->query->get('description');

        $task->close($status, $description);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/tasks/restore", name="tasks-restore", methods={"GET"}) // todo POST
     */
    public function restore(Request $request): Response
    {
        $id = $request->query->get('id');

        $task = $this->taskRepository->find($id);

        if (!$task instanceof Task) {
            throw new NotFoundHttpException('Unknown task');
        }

        $task->restore();

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
