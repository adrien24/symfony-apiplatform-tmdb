<?php
namespace App\Command;


use App\Entity\Movies;
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
#[AsCommand(name: 'app:create-user')]
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
            $response = $this->client->request(
                'GET',
                $url
            );
            $statusCode = $response->getStatusCode();
            if($statusCode == 200){
                $content = $response->toArray();
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

        $entityManager->flush();

        return Command::SUCCESS;
    }
}