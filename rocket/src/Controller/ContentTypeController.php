<?php 

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\ContentType;
use App\Form\ContentTypeType;
use App\Entity\Content;
use App\Entity\AttributeValue;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use App\Services\FileService;

class ContentTypeController extends BaseController{
        
    /** 
     * @Route("/api/contenttypes", name="api_content_types", methods={"GET"})
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
     * @Route("/api/contenttypes/{id}", name="api_content_types_show", methods={"GET"})
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
     * @Route("/api/crud/contenttypes/add", name="api_crud_content_types_add", methods={"GET","POST"})
    */
    public function add(Request $request){
        $em = $this->doctrine->getEntityManager();

        $type = new ContentType();

        $form = $this->factory->createBuilder(ContentTypeType::class, $type)->getForm();

        $data = $this->formErrors->getDatas($request);
        // var_dump($data);
        //die('foo');

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
     * @Route("/api/crud/contenttypes/edit/{id}", name="api_crud_content_types_edit", methods={"GET","PUT"})
    */
    public function edit(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(ContentType::class)->findOneBy(
            [
                'id' => $id,
            ]
        );

        if(null !== $type){
            $form = $this->factory->createBuilder(ContentTypeType::class, $type)->getForm();

            $data = $this->formErrors->getDatas($request);
    
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
     * @Route("/api/crud/contenttypes/delete/{id}", name="api_crud_content_types_delete", methods={"DELETE", "OPTIONS"})
    */
    public function delete(Request $request, $id){
        $em = $this->doctrine->getEntityManager();

        $type = $em->getRepository(ContentType::class)->findOneBy(
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

    /**
     * @Route("/api/{type}", methods={"GET"})
     */
    public function listeCustom($type){
        $em = $this->doctrine->getEntityManager();

        $typeObj = $em->getRepository(ContentType::class)->findOneByTitle($type);

        if(null == $typeObj)
            throw new Exception(sprintf('Type %s does not exist!', $type));
        
        $list = $em->getRepository(Content::class)->findByType($typeObj);

        if(null === $list)
            $list = [];
        
        return new Response(
            $this->serializer->serialize(
                $list,
                'json',
                ['groups' => ['content']]
            )
        );
    }

    /**
     * @Route("/api/{type}/{id}", methods={"GET"})
     */
    public function custom($type, $id){
        
    }

    /**
     * @Route("/api/crud/{type}/add", methods={"GET", "POST"})
     */
    public function addCustom(Request $request, $type, FileService $fileService){
        $em = $this->doctrine->getEntityManager();

        $fileType = false;

        $typeObj = $em->getRepository(ContentType::class)->findOneByTitle($type);

        if(null == $typeObj)
            throw new Exception(sprintf('Type %s does not exist!', $type));
        
        $form = $this->factory->createBuilder(FormType::class, []);

        foreach ($typeObj->getAttributes() as $attribute) {
            $options = [];

            if ($attribute->getType() === 'Symfony\Component\Form\Extension\Core\Type\DateTimeType')
                $options = ['widget' => 'single_text','format' => 'dd/M/yy','html5' => true];
            
            if ($attribute->getType() === 'Symfony\Component\Form\Extension\Core\Type\FileType')
                $fileType = $attribute->getTitle();


            $form->add($attribute->getTitle(), $attribute->getType(), $options);
        }

        $form = $form->getForm();

        $data = $this->formErrors->getDatas($request);
        
        if ($fileType)
            $data = $fileService->getFile($data, $fileType, $request);

        if ($request->getMethod() !== 'GET')
            $form->submit($data);

        if($form->isSubmitted() && $form->isValid()){
            $content = new Content;
            $content->setType($typeObj);

            foreach ($typeObj->getAttributes() as $attribute) {
                $value = new AttributeValue;
                $value->setAttribute($attribute)
                    ->setValue($data[$attribute->getTitle()])
                    ->setContent($content)
                ;
                $content->addAttribute($value);
            }

            $em->persist($content);
            $em->flush();

            return new Response(
                $this->serializer->serialize(
                    $content,
                    'json',
                    ['groups' => ['content']]
                )
            );
        }

        if($request->getMethod() !== 'GET')
            return new JsonResponse($this->formErrors->getErrors($form),  500);

        return new JsonResponse($this->formErrors->DiscoverForm($form));
    }

    /**
     * @Route("/api/crud/{type}/{id}/edit", methods={"PUT"})
     */
    public function editCustom($type, $id){

    }

    /**
     * @Route("/api/crud/{type}/{id}/delete",  methods={"DELETE", "OPTIONS"})
     */
    public function deleteCustom($type, $id){

    }
}
