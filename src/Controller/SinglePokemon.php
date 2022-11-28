<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Pokemon;


class SinglePokemon extends AbstractController
{   
    #[Route('/singlePokemon', name: 'app_single_pokemon')]
    public function index(): Response
    {
        $pokemon = "pikachu";
        // fetch le "pokemon"
        $client = HttpClient::create();
        $url = 'https://pokeapi.co/api/v2/pokemon/'.$pokemon;
        $response = $client->request('GET', $url);
        $statusCode = $response->getStatusCode();
        $content = $response->toArray();

        // stocker temporairement la data
        $name = $content["name"];
        $pokemonOrder = $content["order"];
        $stats = $content["stats"];
        $types = $content["types"];
        $weight = $content["weight"];
        $species = $content["species"];
        $base_experience = $content["base_experience"];


        

        return $this->render('pokemon/single.html.twig',['name' => $name, 'pokemonOrder' => $pokemonOrder, 'stats' => $stats, 'types' => $types, 'weight' => $weight, 'species' => $species, "base_experience" => $base_experience]);

    }
}