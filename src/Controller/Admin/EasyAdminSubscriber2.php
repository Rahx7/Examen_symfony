<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager )
    {
       // $this->entityManager = $entityManager;
        // $this->request = $request;Request $request

    }

    public static function getSubscribedEvents()
    {
        return [
            // BeforeEntityPersistedEvent::class => ['beforePersist'],
            // BeforeEntityUpdatedEvent::class => ['beforeUpdate'], 
        ];
    }

    public function beforePersist(BeforeEntityUpdatedEvent $event)
    {
        //$entity = $event->getEntityInstance();
        dump($event);
        //dump($this->request);

    }

    public function beforeUpdate(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        dump($entity);
        dump($this->request);
    }

}