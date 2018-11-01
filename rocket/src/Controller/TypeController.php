<?php 

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\Type;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;


class TypeController extends BaseController{
        
    /** 
     * @Route("/api/types", name="api_types", methods={"GET"})
    */
    public function types(){
        $em = $this->doctrine->getEntityManager();

        return new JsonResponse(
            $this->serializer->serialize(
                $em->getRepository(Type::class)->findAll(),
                'json'
            )
        );
    }

    /** 
     * @Route("/api/types/{id}", name="api_type", methods={"GET"})
    */
    public function type(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        return new Response(
            $this->serializer->serialize(
                $em->getRepository(Type::class)->findOneBy(
                    [
                        'id' => $id
                    ]
                ),
                'json'
            )
        );
    }

    /** 
     * @Route("/api/crud/types/add", name="api_crud_types_add", methods={"POST"})
    */
    public function add(Request $request){
        $em = $this->doctrine->getEntityManager();

        $type = new Type();

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
     * @Route("/api/crud/types/edit/{id}", name="api_crud_types_edit", methods={"PUT"})
    */
    public function edit(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(Type::class)->findOneBy(
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
     * @Route("/api/crud/types/delete/{id}", name="api_crud_types_delete", methods={"DELETE"})
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
