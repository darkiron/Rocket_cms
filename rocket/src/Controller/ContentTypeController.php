<?php 

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\ContentType;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;


class ContentTypeController extends BaseController{
        
    /** 
     * @Route("/api/types", name="api_types", methods={"GET"})
    */
    public function types(){
        $em = $this->doctrine->getEntityManager();

        return new Response(
            $this->serializer->serialize(
                $em->getRepository(ContentType::class)->findAll(),
                'json'
            )
        );
    }

    /** 
     * @Route("/api/types/{id}", name="api_types_show", methods={"GET"})
    */
    public function type(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        return new Response(
            $this->serializer->serialize(
                $em->getRepository(ContentType::class)->findOneBy(
                    [
                        'id' => $id
                    ]
                ),
                'json'
            )
        );
    }

    /** 
     * @Route("/api/crud/types/add", name="api_crud_types_add", methods={"GET","POST"})
    */
    public function add(Request $request){
        $em = $this->doctrine->getEntityManager();

        $type = new ContentType();

        $form = $this->factory->createBuilder(TypeType::class, $type)->getForm();

        $data = json_decode($request->getContent(), true);

        if($request->getMethod() !== 'GET')
            $form->submit($data);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($type);
            $em->flush();

            return new Response(
                $this->serializer->serialize(
                    $type,
                    'json'
                )
            );
        }

        if($request->getMethod() !== 'GET')
            return new JsonResponse($this->formErrors->getErrors($form),  500);

        return new JsonResponse($this->formErrors->DiscoverForm($form));
    }

    /** 
     * @Route("/api/crud/types/edit/{id}", name="api_crud_types_edit", methods={"GET","PUT"})
    */
    public function edit(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(ContentType::class)->findOneBy(
            [
                'id' => $id,
            ]
        );

        if(null !== $type){
            $form = $this->factory->createBuilder(TypeType::class, $type)->getForm();

            $data = json_decode($request->getContent(), true);
    
            if($request->getMethod() !== 'GET')
                $form->submit($data);

            if($form->isSubmitted() && $form->isValid()){
                $em->persist($type);
                $em->flush();
    
                return new Response(
                    $this->serializer->serialize(
                        $type,
                        'json'
                    )
                );
            }

            if($request->getMethod() !== 'GET')
                return new JsonResponse($this->formErrors->getErrors($form),  500);

            return new JsonResponse($this->formErrors->DiscoverForm($form));
        }

        throw new Exception(sprintf('Type %s does not exist', $id));

    }
    
    /** 
     * @Route("/api/crud/types/delete/{id}", name="api_crud_types_delete", methods={"DELETE", "OPTIONS"})
    */
    public function delete(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(Type::class)->findOneBy(
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
