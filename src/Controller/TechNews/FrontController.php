<?php
/**On aurait pu appeler le fichier default ou index*/

namespace App\Controller\TechNews;


use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     *Page d'accueil
     * @return Response
     */

    public function index()
    {
        #return new Response("<html><body><h1>PAGE D'ACCUEIL</h1></body></html>");
        return $this->render('front/index.html.twig');
    }

    /**
     *Page de contact
     * @return Response
     */
    public function contact()
    {
        return new Response("<html><body><h1>PAGE DE CONTACT</h1></body></html>");
    }

    /**
     * Page permettant d'afficher kes articles d'une catégorie
     * @Route("/categorie/{slug<[a-zA-Z1-9-_/]+>}",
     *     methods={"GET"},
     *     defaults={"slug"="news"},
     *     name="front_categorie")
     * @param $slug
     * @return Response
     */
    public function categorie($slug)
    {
        #return new Response("<html><body><h1>PAGE DE CATEGORIE : $slug</h1></body></html>");
        return $this->render('front/categorie.html.twig');
    }

    /**
     * @Route("/{categorie<[a-zA-Z1-9-/]+>}/{slug<[a-zA-Z1-9-/]+>}_{id<\d+>}.html",
     *     name="front_article")
     * @param $id
     * @param $slug
     * @param $categorie
     * @return Response
     */
    public function article(Article $article)
    {
        # Exemple d'URL
        # /politique/vinci-autoroutes-va-envoyer-une-facture-aux-automobilistes_9841.html

//        $article =$this->getDoctrine()
//            ->getRepository(Article::class)
//            ->find($id);

        #return new Response("<html><body><h1>PAGE ARTICLE : $id</h1></body></html>");
        return $this->render('front/article.html.twig',['article'=>$article]);
    }

}