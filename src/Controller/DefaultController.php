<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 *
 * Class DefaultController
 * @package App/Controller
 **/
class DefaultController extends AbstractController
{
	/**
	 * @Route(path="/", methods={"GET"})
	 *
	 * @return string
	 */
	public function home()
	{
		return $this->render("Default/home.html.twig");
	}

	/**
	 * @Route(path="/{name}", methods={"GET"})
	 *
	 * @return string
	 */
	public function getName($name)
	{
		return $this->render("Default/getName.html.twig", [
			"name" => $name
		]);
	}
}