<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller {

	/**
	 * @Route(path="/")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function listAction() {
		$connection = $this->get('doctrine.dbal.default_connection');
		/* @var $connection \Doctrine\DBAL\Connection */

		$movies = $connection->executeQuery('SELECT * FROM movies');

		return $this->render('AppBundle:Movie:list.html.twig', [
			'movies' => $movies,
		]);
	}

}
