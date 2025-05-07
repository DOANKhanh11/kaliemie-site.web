<?php

namespace App\Controller;

use App\Entity\Indisponibilite;
use App\Entity\Infirmiere;
use App\Entity\PersonneLogin;
use App\Form\IndisponibiliteType;
use App\Repository\IndisponibiliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/infirmiere/indisponibilite')]
class IndisponibiliteController extends AbstractController
{
    #[Route('/dashboard', name: 'indisponibilite_index')]
    public function index(IndisponibiliteRepository $repo, EntityManagerInterface $em): Response
    {
        $personne = $this->getUser();

        $infirmiere = $em->getRepository(Infirmiere::class)->findOneBy([
            'personneLogin' => $personne
        ]);

        if (!$infirmiere) {
            throw $this->createAccessDeniedException("Infirmière non trouvée.");
        }

        $indispos = $repo->findBy(['infirmiere' => $infirmiere->getId()]);

        return $this->render('indisponibilite/index.html.twig', [
            'indisponibilites' => $indispos,
        ]);
    }

    #[Route('/new', name: 'indisponibilite_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $indispo = new Indisponibilite();

        $form = $this->createForm(IndisponibiliteType::class, $indispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personne = $this->getUser();

            $infirmiere = $em->getRepository(Infirmiere::class)->findOneBy([
                'personneLogin' => $personne
            ]);

            if (!$infirmiere) {
                throw new \Exception("Infirmière non trouvée.");
            }

            $indispo->setInfirmiere($infirmiere->getId());

            $em->persist($indispo);
            $em->flush();

            $this->addFlash('success', 'Indisponibilité enregistrée.');
            return $this->redirectToRoute('indisponibilite_index');
        }

        return $this->render('indisponibilite/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{infirmiere}/{dateDebut}/delete', name: 'indisponibilite_delete')]
    public function delete(int $infirmiere, string $dateDebut, IndisponibiliteRepository $repo, EntityManagerInterface $em): Response
    {
        $date = new \DateTime($dateDebut);

        $indispo = $repo->findOneBy([
            'infirmiere' => $infirmiere,
            'dateDebut' => $date
        ]);

        if (!$indispo) {
            throw $this->createNotFoundException("Indisponibilité non trouvée.");
        }

        $em->remove($indispo);
        $em->flush();

        $this->addFlash('success', 'Indisponibilité supprimée.');
        return $this->redirectToRoute('indisponibilite_index');
    }
}
