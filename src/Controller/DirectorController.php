<?php

namespace App\Controller;

use App\Entity\Director;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/directors', name: 'app_api_director')]
class DirectorController extends AbstractController
{
    #[Route('/', name: 'get_directors', methods: ['GET'])]
    public function getAll(EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $directors = $em->getRepository(Director::class)->findAll();
        $data = $serializer->serialize($directors, 'json');
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: 'get_director', methods: ['GET'])]
    public function get(Director $director, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($director, 'json'), 200, [], true);
    }

    #[Route('/', name: 'create_director', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request, SerializerInterface $serializer): JsonResponse
    {
        try {
            // get json data from request
            $data = json_decode($request->getContent(), true);

            $name = $data['name'];
            $nationality = $data['nationality'];
            // check if all required fields are present
            if ($name == null || $nationality == null) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }

            // check if data is valid
            if (!is_string($name) || !is_string($nationality)) {
                return new JsonResponse(['error' => 'Invalid data'], 400);
            }

            // create director object
            $director = new Director();
            $director->setName($name);
            $director->setNationality($nationality);
            $em->persist($director);
            $em->flush();

            return new JsonResponse($serializer->serialize($director, 'json'), 201, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/{id}', name: 'update_director', methods: ['PUT'])]
    public function update(Director $director, EntityManagerInterface $em, Request $request, SerializerInterface $serializer): JsonResponse
    {
        try {
            // get json data from request
            $data = json_decode($request->getContent(), true);

            $name = $data['name'];
            $nationality = $data['nationality'];
            // check if all required fields are present
            if ($name == null || $nationality == null) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }

            // check if data is valid
            if (!is_string($name) || !is_string($nationality)) {
                return new JsonResponse(['error' => 'Invalid data'], 400);
            }

            // update director object
            $director->setName($name);
            $director->setNationality($nationality);
            $em->persist($director);
            $em->flush();


            return new JsonResponse($serializer->serialize($director, 'json'), 200, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/{id}', name: 'delete_director', methods: ['DELETE'])]
    public function delete(Director $director, EntityManagerInterface $em): JsonResponse
    {
        try {
            $em->remove($director);
            $em->flush();

            return new JsonResponse(['message' => 'Director deleted successfully']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
