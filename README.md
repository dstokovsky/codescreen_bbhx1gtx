# Denis Stokovsky's assessment

The CodeScreen Film API is a service that contains one endpoint,<br/>
`GET https://app.codescreen.com/api/assessments/films`, which returns the details of a large number of different films.

When you send an `HTTP GET` request to the endpoint, the response will be a `200 OK`, which includes a body containing a list of film data in `JSON` format. 
<br>

For authentication, you need to send your API token in the `Authorization HTTP header` using the [Bearer authentication scheme](https://tools.ietf.org/html/draft-ietf-oauth-v2-bearer-20#section-2.1). Your API token is `8c5996d5-fb89-46c9-8821-7063cfbc18b1`.

Here is an example of how to send the request from cURL:

    curl -H "Authorization: Bearer 8c5996d5-fb89-46c9-8821-7063cfbc18b1" \
    https://app.codescreen.com/api/assessments/films
    
An example response is the following:

     [
       {
         "name": "Batman Begins",
         "length": 140,
         "rating": 8.2,
         "releaseDate": "2006-06-16",
         "directorName": "Christopher Nolan"
       },
       {
         "name": "Alien",
         "length": 117,
         "rating": 8.4,
         "releaseDate": "1979-09-06",
         "directorName": "Ridley Scott"
       }
     ]


The `name` field represents the name of the film. The `length` field represents the duration of the film in minutes. The `rating` is the <a href="https://www.imdb.com/" target="_blank">`IMDb`</a> rating for the film, out of 10.
The `releaseDate` is the date in which the film was released in the United Kingdom, and the `directorName` field is the name of the film's director.

## Your Task

You are required to implement the methods in the [FilmsAPIService](src/FilmsAPIService.php) and [FilmsDataStatsGenerator](src/FilmsDataStatsGenerator.php) classes in such a way that
all the unit tests in [FilmsDataStatsGeneratorTest](tests/FilmsDataStatsGeneratorTest.php) pass.

[FilmsAPIService](src/FilmsAPIService.php) should be implemented in such a way that you only need to call out to the CodeScreen Films API
endpoint once per full run of the [FilmsDataStatsGeneratorTest](tests/FilmsDataStatsGeneratorTest.php) test suite.

## Requirements

The [FilmsDataStatsGeneratorTest](tests/FilmsDataStatsGeneratorTest.php) file class should not be modified. If you would like to add your own unit tests you
can add these in a separate class.

The `composer.json` file should only be modified to add any third-party dependencies required for your solution.

You are free to use whichever libraries you want (PHP or third-party) when implementing your solution. </br>
Note we recommend using the <a href="http://docs.guzzlephp.org/en/stable/" target="_blank">`Guzzle`</a> PHP client library to interact with the CodeScreen Films API service.

Your solution also must use `PHP version 8.0`.

##

This test should take no longer than 2 hours to complete successfully.

Good luck!

## License

At CodeScreen, we strongly value the integrity and privacy of our assessments. As a result, this repository is under exclusive copyright, which means you **do not** have permission to share your solution to this test publicly (i.e., inside a public GitHub/GitLab repo, on Reddit, etc.). <br>

## Submitting your solution

Please push your changes to the `main branch` of this repository. You can push one or more commits. <br>

Once you are finished with the task, please click the `Submit Solution` link on <a href="https://app.codescreen.com/candidate/6b083001-c1b7-4503-9156-8deb9745ccc9" target="_blank">this screen</a>.