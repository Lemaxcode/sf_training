<?php

namespace App\EventListener;


use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;


class AddMyCorpHeaderListener
{
  public function addHeader(ResponseEvent $event)
  {
    $response = $event->getResponse();

    $response->headers->add([
      'X-DEVELOPED-BY' => 'MyCorp'
    ]);
  }
}