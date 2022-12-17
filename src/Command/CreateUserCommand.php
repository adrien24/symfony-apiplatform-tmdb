<?php
namespace App\Command;


use App\Entity\Animes;
use App\Entity\Memes;
use App\Entity\Movies;
use App\Entity\Posts;
use App\Entity\Series;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:create-tables')]
class CreateUserCommand extends Command
{
    private $client;

    public function __construct(private ManagerRegistry $doctrine, HttpClientInterface $client)
    {
        $this->doctrine = $doctrine;
        $this->client = $client;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command will add 100 film to the database');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $entityManager = $this->doctrine->getManager();

        // Movies
        for($i = 2; $i <= 100; $i++){
            $url = 'https://api.themoviedb.org/3/movie/'.$i.'?api_key=a769aba61ba3f4584d34a56d5f6ece11&language=fr-FR';
            $responseMovies = $this->client->request(
                'GET',
                $url
            );
            $statusCode = $responseMovies->getStatusCode();
            if($statusCode == 200){
                $content = $responseMovies->toArray();
                $movies = new Movies();
                $movies->setTitle($content['title']);
                $movies->setDescription($content['overview']);
                if($content['production_companies']){
                    $movies->setProductionCompanies([$content['production_companies'][0]['name']]);
                }else{
                    $movies->setProductionCompanies([NULL]);
                }

                if($content['genres']) {
                    $movies->setGenre([$content['genres'][0]['name']]);
                }else{
                    $movies->setGenre([NULL]);
                }

                $entityManager->persist($movies);
            }
        }

        // Series

        for($i = 2; $i <= 100; $i++){
            $urlSeries = 'https://api.themoviedb.org/3/tv/'.$i.'?api_key=a769aba61ba3f4584d34a56d5f6ece11&language=fr-FR';
            $responseSeries = $this->client->request(
                'GET',
                $urlSeries
            );
            $statusCode = $responseSeries->getStatusCode();
            if($statusCode == 200){
                $content = $responseSeries->toArray();
                $series = new Series();
                $series->setName($content['name']);
                $series->setDescription($content['overview']);
                if($content['backdrop_path']){
                    $series->setBackdropPath($content['backdrop_path']);
                }else{
                    $series->setBackdropPath("null");
                }

                if($content['languages']){
                    $series->setLanguages($content['languages'][0]);
                }else{
                    $series->setLanguages("null");
                }

                if($content['episode_run_time']) {
                    $series->setEpisodeTime($content['episode_run_time'][0]);
                }else{
                    $series->setEpisodeTime(0);
                }
                $series->setNumberEpisodes($content['number_of_episodes']);


                $entityManager->persist($series);
            }
        }

        // Animes

        for($i = 2; $i <= 100; $i++){
            $urlSeries = 'https://kitsu.io/api/edge/anime?filter[categories]=adventure&page[limit]=1&page[offset]=' . $i;
            $responseAnimes = $this->client->request(
                'GET',
                $urlSeries
            );
            $statusCode = $responseAnimes->getStatusCode();
            if($statusCode == 200){
                $content = $responseAnimes->toArray();
                $animes = new Animes();
                $animes->setType($content['data'][0]['type']);
                if($content['data'][0]['attributes']['synopsis']){
                    $animes->setSynopsis($content['data'][0]['attributes']['synopsis']);
                }else{
                    $animes->setSynopsis("null");
                }

                $animes->setName($content['data'][0]['attributes']['canonicalTitle']);
                $animes->setStatus($content['data'][0]['attributes']['status']);
                $animes->setImage($content['data'][0]['attributes']['posterImage']['large']);
                if($content['data'][0]['attributes']['episodeCount']){
                    $animes->setEpisodeCount($content['data'][0]['attributes']['episodeCount']);
                }else{
                    $animes->setEpisodeCount(0);
                }

                $animes->setPoster([$content['data'][0]['attributes']['posterImage']]);


                $entityManager->persist($animes);
            }
        }

        // Memes

        for($i = 0; $i <= 99; $i++){
            $urlSeries = 'https://api.imgflip.com/get_memes';
            $responseMemes = $this->client->request(
                'GET',
                $urlSeries
            );
            $statusCode = $responseMemes->getStatusCode();
            if($statusCode == 200){
                $content = $responseMemes->toArray();
                $memes = new Memes();
                if($content['data']['memes'][$i]){
                    $memes->setName($content['data']['memes'][$i]['name']);
                    $memes->setUrl($content['data']['memes'][$i]['url']);
                    $memes->setWidth($content['data']['memes'][$i]['width']);
                    $memes->setHeight($content['data']['memes'][$i]['height']);
                    $memes->setBoxCount($content['data']['memes'][$i]['box_count']);
                    $memes->setCaptions($content['data']['memes'][$i]['captions']);
                }
                $entityManager->persist($memes);
            }
        }

        // Memes

        for($i = 10; $i <= 300; $i++){
            $urlPosts = 'https://techcrunch.com/wp-json/wp/v2/posts/'.$i;
            $responsePosts = $this->client->request(
                'GET',
                $urlPosts
            );
            $statusCode = $responsePosts->getStatusCode();
            if($statusCode == 200){
                $content = $responsePosts->toArray();
                $posts = new Posts();

                    $posts->setDate($content['date']);
                    $posts->setSlug($content['slug']);
                    $posts->setType($content['type']);
                    $posts->setTitle($content['title']['rendered']);


                $entityManager->persist($posts);
            }
        }

        $entityManager->flush();

        return Command::SUCCESS;
    }
}