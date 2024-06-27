<?php

namespace App\DataFixtures;

use App\Entity\Director;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DirectorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer 10 réalisateurs connus
        $directors = [
            ['name' => 'Steven Spielberg', 'nationality' => 'USA'],
            ['name' => 'Martin Scorsese', 'nationality' => 'USA'],
            ['name' => 'Francis Ford Coppola', 'nationality' => 'USA'],
            ['name' => 'Quentin Tarantino', 'nationality' => 'USA'],
            ['name' => 'Robert Zemeckis', 'nationality' => 'USA'],
            ['name' => 'Ridley Scott', 'nationality' => 'UK'],
            ['name' => 'Alfred Hitchcock', 'nationality' => 'UK'],
            ['name' => 'David Lean', 'nationality' => 'UK'],
            ['name' => 'Christopher Nolan', 'nationality' => 'UK'],
            ['name' => 'James Cameron', 'nationality' => 'UK'],
            ['name' => 'George Lucas', 'nationality' => 'UK'],
        ];

        foreach ($directors as $director) {
            $d = new Director();
            $d->setName($director['name']);
            $d->setNationality($director['nationality']);
            $manager->persist($d);
        }

        $manager->flush();
    }
}
