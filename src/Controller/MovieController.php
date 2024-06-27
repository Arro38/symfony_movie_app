<?php

namespace App\Controller;

use App\Entity\Director;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/movies', name: 'app_api_movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'get_movies', methods: ['GET'])]
    public function getAll(EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $movies = $em->getRepository(Movie::class)->findAll();
        $data = $serializer->serialize($movies, 'json');
        return new JsonResponse($data, 200, [], true);
    }

    #[Route('/{id}', name: 'get_movie', methods: ['GET'])]
    public function get(Movie $movie, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($movie, 'json'), 200, [], true);
    }

    #[Route('/', name: 'create_movie', methods: ['POST'])]
    public function create(EntityManagerInterface $em, SerializerInterface $serializer, Request $request): JsonResponse
    {
        try {
            // get json data from request
            $data = json_decode($request->getContent(), true);

            $title = $data['title'];
            $note = $data['note'];
            $releaseDate = $data['releaseDate']; //Format : dd-mm-yyyy
            $description = $data['description'];
            $directorId = $data['director'];
            // check if all required fields are present
            if ($title == null || $note == null || $releaseDate == null || $description == null || $directorId == null) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }

            // check if director exists
            $director = $em->getRepository(Director::class)->find($directorId);
            if (!$director) {
                return new JsonResponse(['error' => 'Director not found'], 400);
            }

            // check if data is valid
            if (!is_numeric($note)) {
                return new JsonResponse(['error' => 'Invalid data'], 400);
            }

            // check if releaseDate is valid
            if (!preg_match('/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/', $releaseDate)) {
                return new JsonResponse(['error' => 'Invalid data'], 400);
            }

            // Convert to Date object
            $releaseDate  = \DateTime::createFromFormat('d-m-Y', $releaseDate);

            $movie = new Movie();
            $movie->setTitle($title);
            $movie->setNote($note);
            $movie->setReleaseDate($releaseDate);
            $movie->setDescription($description);
            $movie->setDirector($director);
            $em->persist($movie);
            $em->flush();


            return new JsonResponse($serializer->serialize($movie, 'json'), 201, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/{id}', name: 'update_movie', methods: ['PUT'])]
    public function update(Movie $movie, EntityManagerInterface $em, Request $request, SerializerInterface $serializer): JsonResponse
    {
        try {
            // get json data from request
            $data = json_decode($request->getContent(), true);

            $title = $data['title'];
            $note = $data['note'];
            $releaseDate = $data['releaseDate'];
            $description = $data['description'];
            $directorId = $data['director'];
            // check if all required fields are present
            if ($title == null || $note == null || $releaseDate == null || $description == null || $directorId == null) {
                return new JsonResponse(['error' => 'Missing required fields'], 400);
            }

            // check if director exists
            $director = $em->getRepository(Director::class)->find($directorId);
            if (!$director) {
                return new JsonResponse(['error' => 'Director not found'], 400);
            }

            // check if data is valid
            if (!is_numeric($note)) {
                return new JsonResponse(['error' => 'Invalid data'], 400);
            }
            // Convert to Date object
            $releaseDate  = \DateTime::createFromFormat('d-m-Y', $releaseDate);

            $movie->setTitle($title);
            $movie->setNote($note);
            $movie->setReleaseDate($releaseDate);
            $movie->setDescription($description);
            $movie->setDirector($director);
            $em->persist($movie);
            $em->flush();

            return new JsonResponse($serializer->serialize($movie, 'json'), 200, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/{id}', name: 'delete_movie', methods: ['DELETE'])]
    public function delete(Movie $movie, EntityManagerInterface $em): JsonResponse
    {
        try {
            $em->remove($movie);
            $em->flush();

            return new JsonResponse(['message' => 'Movie deleted successfully']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
