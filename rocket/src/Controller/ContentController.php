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
     * @Route("/api/contents/{id}", name="api_contents_show", methods={"GET"})
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
     * @Route("/api/crud/contents/add", name="api_crud_contents_add", methods={"GET","POST"})
    */
    public function add(Request $request){
        $em = $this->doctrine->getEntityManager();

        $type = new Content();

        $form = $this->factory->createBuilder(ContentType::class, $type)->getForm();

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
     * @Route("/api/crud/contents/edit/{id}", name="api_crud_contents_edit", methods={"GET","PUT"})
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
