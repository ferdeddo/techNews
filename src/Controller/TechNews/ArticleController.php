<?php


namespace App\Controller\TechNews;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{/**
 *démonstration de l'ajout d'un article avec Doctrine
 * @Route("/demo/article",name="article_demo")
 * dans le controller on a pas besoin de déclarer les $categorie et $membre et $article comme private
 * c'est des variable locale!!!
 */

    public function demo()
    {
        #création de la Catégorie
        $categorie=new Categorie();
        $categorie
            ->setNom("Commerce")
            ->setSlug("commerce");
        #création d'un membre
        $membre=new Membre();
        $membre
            ->setNom("NEGGAZ1")
            ->setPrenom("malika1")
            ->setEmail("neggazmalik@gmail.com")
            ->setPassword("test")
            ->setRoles(["ROLE_AUTEUR"])
        ;
        #création de l'article
        $article = new Article();
        $article
            ->setTitre("Des \"gilets jaunes\" et Francis Lalanne ")
            ->setSlug("des-gilets-jaunes-et-francis-lalanne")
            ->setContenu("<p>Le chanteur Francis Lalanne annonce le lancement d'une liste
                     de \"gilets jaunes\" pour les élections européennes. Une hypothèse avancée par d'autres figures 
                     du mouvement à l'instar de Christophe Chalençon. Selon un sondage Ipsos, La République en marche 
                     recueillerait 21% des voix, le Rassemblement national 17 et La France insoumise 12. Si une liste 
                     \"gilets jaunes\" se présentait, elle obtiendrait alors 12% des suffrages. Elle priverait ainsi 
                     Marine Le Pen et Jean-Luc Mélenchon de 3% chacun.</p>")
            ->setFeaturedImage("16689717.jpg")
            ->setSpotlight("1")
            ->setSpecial("0")
            ->setMembre($membre)
            ->setCategorie($categorie)
        ;
        /**
         * Récupération du manager de Doctrine
         * le EntityManager est une class qui sais comment persister d'autres classes
         * (effectuer des opérations CRUD sur nos entités)
         *
         * $em
         */
        $em=$this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->persist($membre);
        $em->persist($article);
        $em->flush();
        #Retourner une réponse à la vue
        return new Response('Nouvel Article ajouté avec ID:'
            .$article->getId()
            .'et la nouvelle catégorie'
            .$categorie->getNom()
            .'de membre:'.$membre->getPrenom()
        );

    }
}