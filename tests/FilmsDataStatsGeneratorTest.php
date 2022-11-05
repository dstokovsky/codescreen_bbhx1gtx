<?php

use PHPUnit\Framework\TestCase;
include_once("src/FilmsAPIService.php");
include_once("src/FilmsDataStatsGenerator.php");
class FilmsDataStatsGeneratorTest extends TestCase {

    const RIDLEY_SCOTT_DIRECTOR = "Ridley Scott";

    protected static $generator;

    public static function setUpBeforeClass(): void
    {
      static::$generator = new FilmsDataStatsGenerator(new FilmsAPIService(new \GuzzleHttp\Client()));
    }

    public function testBestRatedFilm() {
	    $this->assertEquals("Gladiator", static::$generator->getBestRatedFilm(self::RIDLEY_SCOTT_DIRECTOR));
    }

    public function testDirectorWithMostFilms() {
	    $this->assertEquals("Ridley Scott", static::$generator->getDirectorWithMostFilms());
    }

    public function testGetAverageRating() {
	    $this->assertEquals(6.9, static::$generator->getAverageRating(self::RIDLEY_SCOTT_DIRECTOR));	
    }

    public function testGetShortestDaysBetweenReleases() {
	    $this->assertEquals(29, static::$generator->getShortestNumberOfDaysBetweenFilmReleases(self::RIDLEY_SCOTT_DIRECTOR));	
    }		

}
