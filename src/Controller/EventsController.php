<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\RegEventFormType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EventsController extends AbstractController
{
    #[Route('/events/{id}', name: 'event_show')]
    public function show(EntityManagerInterface $EntityManager, int $id, Request $request): Response
    {
        /** @var \App\Entity\Event $event */
        $event = $EntityManager->getRepository(Event::class)->find($id);
        
        if (!$event) {
            throw $this->createNotFoundException(
                'No event found for id '.$id
            );
        }

        $form = $this->createform(RegEventFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->getData()['isAttending']){
                $event->addUser($this->GetUser());
                $EntityManager->flush($event); 
            }
            else{
                $event->removeUser($this->getUser());
                $EntityManager->flush($event);
            }
        }

        $namearray=[];
        $userarray=$event->getUsers();
        foreach($userarray as $user){
            array_push($namearray, $user->getUsername());
        }
        

        return $this->render('events/show.html.twig', ['event' => $event, 'form' => $form, 'namearray' => $namearray]);
    }

    #[Route('/events', name: 'app_events')]
    public function index(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
        return $this->render('events/events.html.twig', ['events' => $events]);
    }
}
