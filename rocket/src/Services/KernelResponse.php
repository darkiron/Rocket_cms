<?php 

namespace App\Services;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class KernelResponse{

    public function onKernelResponse(FilterResponseEvent $event){
        $response = $event->getResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
    }
}