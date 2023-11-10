<?php

namespace App\Controller;

use app\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EventsController extends AbstractController
{
    #[Route('/events/{id}', name: 'event_show')]
    public function show(EventRepository $eventRepository, int $id): Response
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            throw $this->createNotFoundException(
                'No event found for id '.$id
            );
        }

        return $this->render('events/show.html.twig', ['event' => $event]);
    }

    #[Route('/events', name: 'app_events')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
        return $this->render('events/events.html.twig', ['events' => $events]);
    }
}
