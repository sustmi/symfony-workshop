<?php

namespace AppBundle\Controller;

use AppBundle\Model\Movie\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

		$form = $this
			->createFormBuilder($movie, [
				'data_class' => Movie::class
			])
			->add('name', TextType::class)
			->add('releaseDate', DateType::class)
			->add('description', TextareaType::class)
			->add('submit', SubmitType::class)
			->getForm();

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



}
