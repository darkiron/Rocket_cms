<?php 

namespace App\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\Exception;


class FileService{


    private $container;

    public function __construct(ContainerInterface $container){
       $this->container = $container;
    }

    public function getFile($data, $nameField, $request){
        $file = $request->files->get($nameField);

        if (null === $data)
            $data = $request->request->all();

        if (null !== $file){
            try {
                $file->move(
                    $this->container->getParameter('upload_directory'),
                    $file->getClientOriginalName()
                );
            } catch (FileException $e) {
                throw new Exception(sprintf('message : %s', $e->getMessage), 500);
            }

            $data[$nameField] = $file->getClientOriginalName();
        } else {
            
        }

        return $data;
    }
}
