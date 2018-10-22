<?php
 
namespace App\Controller;
 
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
 
/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findAll();
 
        return $this->render('Article/index.html.twig', [
            'articles' => $articles
        ]);
    }
 
 
 
    /**
     * @Route("/new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
 
            return $this->redirectToRoute('app_article_index');
        }
 
        return $this->render('Article/new.html.twig', [
            'Article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Article $article)
    {
        $form = $this->createForm(ArticleType::class, $article);
 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
 
            return $this->redirectToRoute('app_article_show', ['id' => $article->getId()]);
        }
 
        return $this->render('Article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();        
    	$article = $em->getRepository(Article::class)->find($id);

        return $this->render('Article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request, Article $article)
    {
        if ($this->isCsrfTokenValid('delete-item', $request->query->get('_token')))
        {
            throw new AccessDeniedException('Erreur csrf');
        }

        $em = $this->getDoctrine()->getManager();
        //hard delete
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('app_article_index');
    }

}