<?php 

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\Content;
use App\Form\ContentType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;


class FileController extends BaseController{
        
    /** 
     * @Route("/api/getfiles", name="api_files", methods={"GET"})
    */
    public function index(ContainerInterface $container){
        $em = $this->doctrine->getEntityManager();

        $files = scandir($container->getParameter('upload_directory'));

        if ($files) {
            return new Response(
                $this->serializer->serialize(
                    $files,
                    'json'
                )
            );
        }
    }
}
