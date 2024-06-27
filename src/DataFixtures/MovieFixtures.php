<?php

namespace App\DataFixtures;

use App\Entity\Director;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movies = [
            ['title' => 'The Shawshank Redemption', 'note' => 9.5, 'releaseDate' => '2002-01-01', 'description' => 'A life sentence is handed down for a crime that has not been committed.', 'director' => 1],
            // Films pour Steven Spielberg
            ['title' => 'Jurassic Park', 'note' => 8.1, 'releaseDate' => '1993-06-11', 'description' => 'A theme park suffering from dinosaur-related incidents.', 'director' => 1],
            ['title' => 'E.T. the Extra-Terrestrial', 'note' => 7.8, 'releaseDate' => '1982-06-11', 'description' => 'A troubled child summons the courage to help a friendly alien escape Earth.', 'director' => 1],
            // Films pour Martin Scorsese
            ['title' => 'Goodfellas', 'note' => 8.7, 'releaseDate' => '1990-09-19', 'description' => 'The story of Henry Hill and his life in the mob.', 'director' => 2],
            ['title' => 'Taxi Driver', 'note' => 8.3, 'releaseDate' => '1976-02-08', 'description' => 'A mentally unstable veteran works as a nighttime taxi driver.', 'director' => 2],
            // Films pour Francis Ford Coppola
            ['title' => 'The Godfather', 'note' => 9.2, 'releaseDate' => '1972-03-24', 'description' => 'The aging patriarch of an organized crime dynasty transfers control of his empire to his reluctant son.', 'director' => 3],
            ['title' => 'Apocalypse Now', 'note' => 8.4, 'releaseDate' => '1979-08-15', 'description' => 'A journey into the heart of darkness during the Vietnam War.', 'director' => 3],
            // Films pour Quentin Tarantino
            ['title' => 'Pulp Fiction', 'note' => 8.9, 'releaseDate' => '1994-10-14', 'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife intertwine in four tales of violence and redemption.', 'director' => 4],
            ['title' => 'Inglourious Basterds', 'note' => 8.3, 'releaseDate' => '2009-08-21', 'description' => 'A plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers.', 'director' => 4],
            // Films pour Robert Zemeckis
            ['title' => 'Forrest Gump', 'note' => 8.8, 'releaseDate' => '1994-07-06', 'description' => 'The story of a man with a low IQ who accomplished great things in his life.', 'director' => 5],
            ['title' => 'Back to the Future', 'note' => 8.5, 'releaseDate' => '1985-07-03', 'description' => 'A young man is accidentally sent thirty years into the past in a time-traveling DeLorean.', 'director' => 5],
            // Films pour Ridley Scott
            ['title' => 'Alien', 'note' => 8.5, 'releaseDate' => '1979-05-25', 'description' => 'The crew of a commercial spacecraft encounter a deadly lifeform.', 'director' => 6],
            ['title' => 'Gladiator', 'note' => 8.5, 'releaseDate' => '2000-05-05', 'description' => 'A former Roman General sets out to exact vengeance against the corrupt emperor.', 'director' => 6],
            // Films pour Alfred Hitchcock
            ['title' => 'Psycho', 'note' => 8.5, 'releaseDate' => '1960-06-16', 'description' => 'A secretary embezzles money and ends up at a secluded motel.', 'director' => 7],
            ['title' => 'Vertigo', 'note' => 8.3, 'releaseDate' => '1958-05-09', 'description' => 'A former police detective juggles wrestling with his personal demons and becoming obsessed with a hauntingly beautiful woman.', 'director' => 7],
            // Films pour David Lean
            ['title' => 'Lawrence of Arabia', 'note' => 8.3, 'releaseDate' => '1962-12-10', 'description' => 'The story of T.E. Lawrence and his adventures in the Arabian Peninsula during World War I.', 'director' => 8],
            ['title' => 'The Bridge on the River Kwai', 'note' => 8.2, 'releaseDate' => '1957-10-02', 'description' => 'British POWs are forced to build a railway bridge for their captors in Burma.', 'director' => 8],
            // Films pour Christopher Nolan
            ['title' => 'Inception', 'note' => 8.8, 'releaseDate' => '2010-07-16', 'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology.', 'director' => 9],
            ['title' => 'The Dark Knight', 'note' => 9.0, 'releaseDate' => '2008-07-18', 'description' => 'Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'director' => 9],
            // Films pour James Cameron
            ['title' => 'Avatar', 'note' => 7.8, 'releaseDate' => '2009-12-18', 'description' => 'A paraplegic Marine dispatched to the moon Pandora on a unique mission.', 'director' => 10],
            ['title' => 'Titanic', 'note' => 7.8, 'releaseDate' => '1997-12-19', 'description' => 'A seventeen-year-old aristocrat falls in love with a kind but poor artist.', 'director' => 10],
            // Films pour George Lucas
            ['title' => 'Star Wars: Episode IV - A New Hope', 'note' => 8.6, 'releaseDate' => '1977-05-25', 'description' => 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee, and two droids to save the galaxy.', 'director' => 11],
            ['title' => 'Star Wars: Episode V - The Empire Strikes Back', 'note' => 8.7, 'releaseDate' => '1980-05-21', 'description' => 'After the rebels are brutally overpowered by the Empire, Luke Skywalker begins his Jedi training with Yoda.', 'director' => 11],
        ];

        foreach ($movies as $movie) {
            $director = $manager->getRepository(Director::class)->find($movie['director']);
            $m = new Movie();
            $m->setTitle($movie['title']);
            $m->setNote($movie['note']);
            $m->setReleaseDate(\DateTime::createFromFormat('Y-m-d', $movie['releaseDate']));
            $m->setDescription($movie['description']);
            $m->setDirector($director);
            $manager->persist($m);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [DirectorFixtures::class];
    }
}
