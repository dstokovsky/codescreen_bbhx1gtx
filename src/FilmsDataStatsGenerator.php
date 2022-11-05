<?php

include_once("src/FilmsAPIService.php");

/**
 * Generates various statistics about the films data set returned by the given FilmsAPIService
 */
class FilmsDataStatsGenerator {

    private $service;

    public function __construct(FilmsAPIService $service)
    {
        $this->service = $service;
    }

    /**
     * Retrieves the name of the best rated film that was directed by the director with the given name.
     *
     * @param directorName the name of the director
     * @return the name of the best rated film that was directed by the director with the given name
     * @throws InvalidArgumentException if the service contains no films directed by the given director
    */
    public function getBestRatedFilm(string $directorName): string
    {
        $films = $this->service->getFilmData();

        $filmRatings = [];
        foreach ($films as $film) {
            if ($film['directorName'] === $directorName) {
                $filmRatings[$film['name']] = $film['rating'];
            }
        }

        arsort($filmRatings);

        return array_key_first($filmRatings);
    }

    /**
     * Retrieves the name of the director who has directed the most films in the CodeScreen Film service.
     *
     * @return the name of the director who has directed the most films in the CodeScreen Film service.
    */
    public function getDirectorWithMostFilms(): string
    {
        $films = $this->service->getFilmData();

        $filmDirectors = [];
        foreach ($films as $film) {
            if (!isset($filmDirectors[$film['directorName']])) {
                $filmDirectors[$film['directorName']] = 1;
            }
            else {
                $filmDirectors[$film['directorName']]++;
            }
        }

        arsort($filmDirectors);

        return array_key_first($filmDirectors);
    }

    /**
     * Retrieves the average rating for the films directed by the given director, rounded to 1 decimal place.
     *
     * @param directorName the name of the director
     * @return the average rating for the films directed by the given director
     * @throws InvalidArgumentException if the service contains no films directed by the given director
    */
    public function getAverageRating(string $directorName): float
    {
        $films = $this->service->getFilmData();

        $ratingsSum = $filmsCounter = 0;
        foreach ($films as $film) {
            if ($film['directorName'] === $directorName) {
                $ratingsSum += $film['rating'];
                $filmsCounter++;
            }
        }

        return $filmsCounter > 0 ? round($ratingsSum / $filmsCounter, 1) : 0;
    }

    /**
     * Retrieves the shortest number of days between any two film releases directed by the given director.
     *
     * For example, if the service returns the following 3 films,
     *
     * {
     *    "name": "Batman Begins",
     *    "length": 140,
     *    "rating": 8.2,
     *    "releaseDate": "2006-06-16",
     *    "directorName": "Christopher Nolan"
     * },
     * {
     *    "name": "Interstellar",
     *    "length": 169,
     *    "rating": 8.6,
     *    "releaseDate": "2014-11-07",
     *    "directorName": "Christopher Nolan"
     * },
     * {
     *    "name": "Prestige",
     *    "length": 130,
     *    "rating": 8.5,
     *    "releaseDate": "2006-11-10",
     *    "directorName": "Christopher Nolan"
     * }
    *
    * then this method should return 147 for Christopher Nolan, as Prestige was released 147 days after Batman Begins.
    *
    * @param directorName the name of the director
    * @return the shortest number of days between any two film releases directed by the given director
    * @throws InvalidArgumentException if the service contains no films directed by the given director
    */
    public function getShortestNumberOfDaysBetweenFilmReleases(string $directorName): int
    {
        $films = $this->service->getFilmData();

        $directorFilms = [];
        foreach ($films as $film) {
            if ($film['directorName'] === $directorName) {
                $directorFilms[] = $film['releaseDate'];
            }
        }

        if (empty($directorFilms)) {
            return 0;
        }

        rsort($directorFilms);

        $theDate = new \Carbon\Carbon($directorFilms[0]);
        $days = [];
        for($i = 1; $i < count($directorFilms); $i++) {
            $currentFilmDate = new Carbon\Carbon($directorFilms[$i]);
            $days[] = $theDate->diffInDays($currentFilmDate);
            $theDate = $currentFilmDate;
        }

        return min($days);
    }
    
}
