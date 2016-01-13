<?php

namespace AppBundle\Controller;

use AppBundle\Model\Movie\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller {

	/**
	 * @Route(path="/")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function listAction() {
		$movieRepository = $this->get('app.movie.movie_repository');
		/* @var $movieRepository \AppBundle\Model\Movie\MovieRepository */
		
		$movies = $movieRepository->findAll();

		return $this->render('AppBundle:Movie:list.html.twig', [
			'movies' => $movies,
		]);
	}

}
