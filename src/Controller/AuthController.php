<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Annotation\Method;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Controller\Helpers;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController
{
    private $userRepository;
    private $entityManager;
    private $helpers;
    public function __construct(EntityManagerInterface $entityManager, Helpers $helpers)
    {
        $this->userRepository = $entityManager->getRepository(User::class);
        $this->entityManager = $entityManager;
        $this->helpers          = $helpers;
    }

    /**
     * @Route("/auth/register", name="register_user", methods={"POST"})
     */
    public function registerLogin(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = null;
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
            $user = new User();
            /*$user->setName($parametersAsArray['name']);
            $user->setSurname($parametersAsArray['surname']);
            $user->setEmail($parametersAsArray['email']);
            $user->setTel($parametersAsArray['tel']);
            $user->setPassword("bdhsbdhsbh");
            $user->setCreated(new \DateTime("now"));
            $user->setUpdated(new \DateTime("now"));
            $this->entityManager->persist($user);
            $this->entityManager->flush();*/
            $email = $parametersAsArray['email'];
            $password = $parametersAsArray['password'];
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                "azertyuiop"
            ));
            // $user->setActive(1); //enable or disable
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }
        return $this->helpers->apiArrayResponseBuilder(200, 'success', $user);
    }

    /**
     * @Route("/api/v1/auth/login", name="login_user", methods={"POST"})
     */
    public function login(Request $request)
    {
        dd("fff");
        if ($content = $request->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        $user = $this->userRepository->find(1);
        $data = ["statut_code" => 200, "message" => "Success", "token" => "bdhqsbdhsbds"];
        return $this->helpers->apiArrayResponseBuilder(200, 'success', ["token" => "token"]);
    }
}