<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileUploadController extends AbstractController
{
    #[Route('/file/upload', name: 'app_file_upload')]
    public function upload(Request $request): Response
    {
        dd($request);
        if ($request->files->get('file')) {
            $file = $request->files->get('file');

           
            $fileName = $file->getClientOriginalName();

            
            try {
                $file->move(
                    $this->getParameter('uploads_dir'), 
                    $fileName
                );
            } catch (FileException $e) {
               
            }

            return $this->json(['status' => 'success', 'message' => 'File uploaded successfully']);
        }

        return $this->json(['status' => 'error', 'message' => 'No file received']);
        
    }
}
