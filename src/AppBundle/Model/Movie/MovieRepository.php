<?php

namespace AppBundle\Model\Movie;

use Doctrine\ORM\EntityManager;

class MovieRepository {

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;

	/**
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}

	/**
	 * @return \AppBundle\Model\Movie\Movie[]
	 */
	public function findAll() {
		return $this->em->getRepository(Movie::class)->findAll();
	}

	/**
	 * @param int $movieId
	 * @return \AppBundle\Model\Movie\Movie|null
	 */
	public function findById($movieId) {
		return $this->em->getRepository(Movie::class)->find($movieId);
	}

}
