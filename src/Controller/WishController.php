<?php


namespace App\Controller;


use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /** @Route("/list/{page}", name="wish_list") */
    public function list(WishRepository $wishRepository, $page):Response{
        $maxPage = ceil($wishRepository->count([]) / 4);
        $pageArray = [];
        for($i = 1; $i <= $maxPage; $i++){
            array_push($pageArray, $i);
        }
        $offset = ($page - 1) * 4;
        $wishes = $wishRepository->findBy([],["dateCreated" => "DESC"], 4, $offset);
        return $this->render('wish/list.html.twig', [
            "wishes" => $wishes,
            "pageNb" => $maxPage,
            "array" => $pageArray,
            "currentPage" => $page]);
    }

    /** @Route("/list/detail/{id}", name="wish_detail") */
    public function detail(WishRepository $wishRepository, $id):Response{
        $wish = $wishRepository->find($id);
        return $this->render('wish/detail.html.twig', ["wish" => $wish]);
    }

    /** @Route("/addWish", name="wish_addWish") */
    public function addWish(Request $request, EntityManagerInterface $entityManager){
        $wish = new Wish();
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);
        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash('success', 'A new wish has been added to the list !');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }
        return $this->render('wish/addWish.html.twig',[
            'form' => $wishForm->createView()
        ]);
    }
}