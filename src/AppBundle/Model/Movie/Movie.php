<?php

namespace AppBundle\Model\Movie;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="movies")
 */
class Movie {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="date")
	 */
	private $releaseDate;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return \DateTime
	 */
	public function getReleaseDate() {
		return $this->releaseDate;
	}

	/**
	 * @param \DateTime $releaseDate
	 */
	public function setReleaseDate(DateTime $releaseDate) {
		$this->releaseDate = $releaseDate;
	}

	/**
	 * @return null|string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param null|string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

}