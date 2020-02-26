<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

Class Helpers {

	public function apiArrayResponseBuilder($statusCode = null, $message = null, $data = [], $errorMessage = null)
	{
		$arr = [
			'status_code' => (isset($statusCode)) ? $statusCode : 500,
			'message' => (isset($message)) ? $message : 'error'
		];
		if ($data) {
			$arr['data'] = $data;
        }else{
			$arr['data'] = [];
		}
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
		$data = $arr;
        $jsonContent = $serializer->serialize($data, 'json');
        $response = new Response();
        $response->setContent($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
		return $response;
	}
}