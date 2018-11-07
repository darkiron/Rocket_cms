<?php 

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\Content;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;


class ContentController extends BaseController{
        
    /** 
     * @Route("/api/contents", name="api_contents", methods={"GET"})
    */
    public function contents(){
        $em = $this->doctrine->getEntityManager();

        return new Response(
            $this->serializer->serialize(
                $em->getRepository(Content::class)->findAll(),
                'json'
            )
        );
    }

    /** 
     * @Route("/api/contents/{id}", name="api_content", methods={"GET"})
    */
    public function type(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        return new Response(
            $this->serializer->serialize(
                $em->getRepository(Content::class)->findOneBy(
                    [
                        'id' => $id
                    ]
                ),
                'json'
            )
        );
    }

    /** 
     * @Route("/api/crud/contents/add", name="api_crud_contents_add", methods={"POST"})
    */
    public function add(Request $request){
        $em = $this->doctrine->getEntityManager();

        $type = new Content();

        $form = $this->factory->createBuilder(TypeType::class, $type)->getForm();

        $data = json_decode($request->getContent(), true);

        $form->submit($data);

        if($form->isValid()){
            $em->persist($type);
            $em->flush();

            return new Response(
                $this->serializer->serialize(
                    $type,
                    'json'
                )
            );
        }

        return new JsonResponse($this->formErrors->getErrors($form),  500);
    }

    /** 
     * @Route("/api/crud/contents/edit/{id}", name="api_crud_contents_edit", methods={"PUT"})
    */
    public function edit(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(Content::class)->findOneBy(
            [
                'id' => $id,
            ]
        );

        if(null !== $type){
            $form = $this->factory->createBuilder(TypeType::class, $type)->getForm();

            $data = json_decode($request->getContent(), true);
    
            $form->submit($data);
    
            if($form->isValid()){
                $em->persist($type);
                $em->flush();
    
                return new Response(
                    $this->serializer->serialize(
                        $type,
                        'json'
                    )
                );
            }

            return new JsonResponse($this->formErrors->getErrors($form),  500);
        }

        throw new Exception(sprintf('Type %s does not exist', $id));

    }
    
    /** 
     * @Route("/api/crud/contents/delete/{id}", name="api_crud_contents_delete", methods={"DELETE"})
    */
    public function delete(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(Content::class)->findOneBy(
            [
                'id' => $id,
            ]
        );

        if(null !== $type){
            $em->remove($type);
            $em->flush();

            return new Response(null, 204);
        }

        throw new Exception(sprintf('Type %s does not exist', $id));

    }
}
