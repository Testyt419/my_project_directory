<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EventsController extends AbstractController
{
    #[Route('/events/{id}', name: 'event_show')]
    public function show( Event $event): Response
    {   
        $namearray = $event->getUsers();
        
        return $this->render('events/show.html.twig', [
            'event' => $event,
            'namearray' => $namearray
        ]);
    }

    #[Route('/events/join/{id}', name: 'event_join')]
    public function joinEvent(EntityManagerInterface $entityManager, Event $event): RedirectResponse
    {
        $event->addUser($this->GetUser());
        $entityManager->flush($event);

        return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
    }

    #[Route('/events/leave/{id}', name: 'event_leave')]
    public function leaveEvent(EntityManagerInterface $entityManager, Event $event): RedirectResponse
    {
        $event->removeUser($this->GetUser());
        $entityManager->flush($event);

        return $this->redirectToRoute('event_show', ['id' => $event->getId()]);
    }

    #[Route('/events', name: 'app_events')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        return $this->render('events/events.html.twig', ['events' => $events]);
    }
}
