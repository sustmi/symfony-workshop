<?php

namespace AppBundle\Controller;

use AppBundle\Model\Movie\Movie;
use AppBundle\Model\Movie\MovieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

	/**
	 * @Route(path="/new/")
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function newAction(Request $request) {
		$movie = new Movie();

		$form = $this->createForm(MovieFormType::class, $movie);
		$form->handleRequest($request);

		if ($form->isValid()) {
			$movie = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em->persist($movie);
			$em->flush();

			$this->addFlash('success', 'Movie ' . $movie->getName() . ' was created.');

			return $this->redirectToRoute('app_movie_list');
		}

		return $this->render('AppBundle:Movie:new.html.twig', [
			'form' => $form->createView(),
		]);
	}

	/**
	 * @Route(path="/edit/{movieId}")
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @param int $movieId
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, $movieId) {
		$movieRepository = $this->get('app.movie.movie_repository');
		/* @var $movieRepository \AppBundle\Model\Movie\MovieRepository */

		$movie = $movieRepository->findById($movieId);

		$form = $this->createForm(MovieFormType::class, $movie);
		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->flush();

			$this->addFlash('success', 'Movie ' . $movie->getName() . ' was edited.');

			return $this->redirectToRoute('app_movie_list');
		}

		return $this->render('AppBundle:Movie:edit.html.twig', [
			'form' => $form->createView(),
			'movie' => $movie,
		]);
	}

}
