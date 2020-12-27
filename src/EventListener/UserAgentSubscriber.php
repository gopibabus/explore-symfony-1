<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserAgentSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            RequestEvent::class => 'onKernelRequest'
        ];
    }

    public function onKernelRequest(RequestEvent $requestEvent)
    {
        if (!$requestEvent->isMasterRequest()) {
            return;
        }
        $request = $requestEvent->getRequest();

        //This is the way we hack controller
        /*$request->attributes->set('_controller', function($slug = null){
            return new Response('This is the way we hack to display our custom Controller Output');
        });*/

        $userAgent = $request->headers->get('User-Agent');
        $this->logger->info(sprintf('The user Agent is "%s"', $userAgent));

        /*
        $isMac = stripos($userAgent, 'Mac') !== false;
        $request->attributes->set('isMac', $isMac);
        */
    }
}