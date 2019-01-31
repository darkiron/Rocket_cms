<?php

namespace App\Controller;

use App\Controller\BaseController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Routing\RouterInterface;

use App\Form\ContentTypeType;
use App\Form\AttributeTypeType;

use App\Entity\ContentType;
use App\Entity\AttributeType;
use Twig\Environment;

class IndexController extends BaseController{

    /** 
     * @Route("/api", name="api_endpoint", methods={"GET"})
    */
    public function index(RouterInterface $router, Request $request){
        $em = $this->doctrine->getEntityManager();

        $search = $request->get('search', null);

        $result = [];

        foreach ($router->getRouteCollection() as $key => $route) {

            if(null === $search){
                $result[] = [ 
                    'name' => $key,
                    'path' => $route->getPath(),
                    'method' => $route->getMethods(),
                ];
            }
            elseif(preg_match('#'.$search.'#', $key, $match)){
                $result[] = [ 
                    'name' => $key,
                    'path' => $route->getPath(),
                    'method' => $route->getMethods(),
                ];
            }
           
        }

        //var_dump(get_class_methods($router->getRouteCollection()));
        //api_content
       /* $result['contents'] = [
            'path' => $router->getRouteCollection()->get('api_contents')->getPath(),
            'method' => $router->getRouteCollection()->get('api_contents')->getMethods(),
        ];*/
 
        return new JsonResponse($result);
    }

     /** 
     * @Route("/test", name="test", methods={"GET"})
    */
    public function test(RouterInterface $router, Request $request, Environment $twig){
        $form = $this->factory->createBuilder(ContentTypeType::class, new ContentType)->getForm();
        //$form = $this->factory->createBuilder(AttributeTypeType::class, new AttributeType)->getForm();
        //var_dump($form->createView()->offsetGet('attributes')->offsetGet('vars'));
        // die; 

        return new Response($twig->render('/test.html.twig', ['form' => $form->createView()]));

    }
}
