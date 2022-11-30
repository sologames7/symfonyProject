<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Pokemon;


class Pokemons extends AbstractController
{   
    #[Route('/pokemons', name: 'app_all_pokemons')]
    public function index(): Response
    {   
            $search = "";
            // fetch la liste
            $client = HttpClient::create();
            $url = 'https://pokeapi.co/api/v2/pokemon?limit=10000';
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();
            $content = $response->toArray();

            if(!isset($_GET['search'])){
                $pokemonsToDisplay= [];
                foreach ($content["results"] as $key => $pokemon) {

                    preg_match('/([^\/]+)(?=[^\/]*\/?$)/', $pokemon['url'], $pokemonId);
                    $pokemon['url'] = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/".$pokemonId[0].".png";
                    array_push($pokemonsToDisplay, $pokemon);
                }
            }else{
                $pokemonsToDisplay= [];
                foreach ($content["results"] as $key => $pokemon) {

                    preg_match('/([^\/]+)(?=[^\/]*\/?$)/', $pokemon['url'], $pokemonId);
                    $pokemon['url'] = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/".$pokemonId[0].".png";
                    if(strstr($pokemon['name'], $_GET['search'])){
                    array_push($pokemonsToDisplay, $pokemon);
                    }

                }
            }

            // liste
            



            return $this->render('pokemon/searchPokemons.html.twig',['pokemonList'=>$pokemonsToDisplay]);
        }
    }
