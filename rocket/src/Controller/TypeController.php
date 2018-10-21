<?php 

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\Type;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class TypeController extends BaseController{
        
    /** 
     * @Route("/api/types", name="api_types")
    */
    public function types(){
        $em = $this->doctrine->getEntityManager();

        return new JsonResponse(
            $em->getRepository(Type::class)->findAll()
        );

    }
}