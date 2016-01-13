<?php

namespace AppBundle\Controller;

use AppBundle\Model\Movie\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function newAction() {
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

		return $this->render('AppBundle:Movie:new.html.twig', [
			'form' => $form->createView(),
		]);
	}



}
