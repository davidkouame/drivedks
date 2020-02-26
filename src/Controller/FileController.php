<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Helpers;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class FileController
{

    private $fileRepository;
    private $entityManager;
    private $helpers;
    public function __construct(EntityManagerInterface $entityManager, Helpers $helpers)
    {
        $this->fileRepository = $entityManager->getRepository(File::class);
        $this->entityManager = $entityManager;
        $this->helpers          = $helpers;
    }


    /**
     * @Route("/api/v1/files", name="files", methods={"GET","HEAD"})
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $search = $request->query->get('search');
        $page = $request->query->get('page');
        $files = null;
        if($search){
            if($page){
                $files = $this->fileRepository->findLikeByFileNamePaginate($search, $page);
            }else{
                $files = $this->fileRepository->findLikeByFileName($search);
            }
        }else{
            if($page){
                $files = $this->fileRepository->findAllPaginnate($page);
            }else{
                $files = $this->fileRepository->findAll($page);
            }
        }
        return $this->helpers->apiArrayResponseBuilder(200, 'success', $files);
    }

    /**
     * @Route("/api/v1/files", name="create_files", methods={"POST"})
     */
    public function create(Request $request)
    {
        $file = null;
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);

            $base64Image = $parametersAsArray['file']; 
            $filePath = tempnam(sys_get_temp_dir(), 'UploadedFile');
            $data = base64_decode($base64Image);
            file_put_contents($filePath, $data);
            $error = null;
            $mimeType = null;
            $test = true;
            $originalName = $parametersAsArray['file_name'];
            $upload = new UploadedFile($filePath, $originalName, $mimeType, $error, $test);
            $filename = $this->upload($upload);
            $file = new File();
            $file->setFileName($parametersAsArray['file_name']);
            $file->setContentType($parametersAsArray['content_type']);
            $file->setFileSize($upload->getMaxFilesize());
            $file->setDiskName($filename);
            $file->setUserId($parametersAsArray['user_id']);
            $file->setCreated(new \DateTime("now"));
            $file->setUpdated(new \DateTime("now"));
            $this->entityManager->persist($file);
            $this->entityManager->flush();
        }
        // return $this->helpers->apiArrayResponseBuilder(200, 'success', $file);
        return $this->helpers->apiArrayResponseBuilder(200, 'success', $file);
    }

    // /**
    //  * @Route("/api/v1/files/{id}", name="delete_files", methods={"GET","HEAD"})
    //  */
    // public function show($id)
    // {
    //     $file = $this->fileRepository->find($id);
    //     return $this->helpers->apiArrayResponseBuilder(200, 'success', $file);
    // }

    /**
     * @Route("/api/v1/files/{diskname}", name="show_files", methods={"GET","HEAD"})
      */
    public function show($diskname){
        $package = new Package(new EmptyVersionStrategy());
        echo $package->getUrl('/image.png');
        echo $diskname;
        die("");
    }

    /**
     * @Route("/api/v1/files/delete/{id}", name="delete_files", methods={"GET","HEAD"})
     */
    public function delete($id)
    {
        $file = $this->fileRepository->find($id);
        if(!$file){
            return $this->helpers->apiArrayResponseBuilder(404, 'Sorry, row does not exist !');
        }
        $this->entityManager->remove($file);
        $this->entityManager->flush();
        return $this->helpers->apiArrayResponseBuilder(200, 'success',['id' => $id]);
    }

    public function extractBase64String(string $base64Content)
    {

        $data = explode( ';base64,', $base64Content);
        return $data[1];

    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = "bdbsdhsggbdh".'-'.uniqid().'.'.$file->guessExtension();

        try {
            // $file->move($this->getTargetDirectory(), $fileName);
            $file->move("/Applications/MAMP/htdocs/drive/public/assets", $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
            dump("une erreur");
        }

        return $fileName;
    }
}