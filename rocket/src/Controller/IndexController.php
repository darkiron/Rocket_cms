<?php

namespace App\Controller;

use App\Controller\BaseController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Routing\RouterInterface;

use App\Entity\ContentType;

class IndexController extends BaseController{

    /** 
     * @Route("/api", name="api_endpoint", methods={"GET"})
    */
    public function index(RouterInterface $router){
        $em = $this->doctrine->getEntityManager();

        //var_dump(get_class_methods($router->getRouteCollection()));
        //api_content
        $result['contents'] = [
            'path' => $router->getRouteCollection()->get('api_contents')->getPath(),
            'method' => $router->getRouteCollection()->get('api_contents')->getMethods(),
        ];

        //api_types
        $result['types'] = [
            'path' => $router->getRouteCollection()->get('api_contents')->getPath(),
            'method' => $router->getRouteCollection()->get('api_contents')->getMethods(),
        ];
        return new JsonResponse($result);
    }
}
