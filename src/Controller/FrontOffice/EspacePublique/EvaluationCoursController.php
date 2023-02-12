<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\Cours;
use App\Entity\EvaluationCours;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EvaluationCoursController extends AbstractController
{
    /**
     * @Route("/evaluation/cours/ajouter/{id}", name="evaluation_cours_ajouter")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function index(Request $request, Cours $cours)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isXmlHttpRequest()) {
            $evaluationExiste = $em->getRepository('App:EvaluationCours')->findOneBy(array(
                'cours' => $cours, 'utilisateur' => $this->getUser()
            ));
            if (!$evaluationExiste) {
                $nombre = $request->request->get('rating');
                $entity = new EvaluationCours();
                $entity->setCours($cours);
                $entity->setNombre($nombre);
                $entity->setUtilisateur($this->getUser());
                $em->persist($entity);
                $em->flush();

                $totalEvaluation = $em->getRepository('App:EvaluationCours')->totalParCours($cours);
                $nombreEvaluation = $em->getRepository('App:EvaluationCours')->nombreParCours($cours);
                $nombreEtoiles = 0;
                if ($totalEvaluation > 0 && $nombreEvaluation > 0) {
                    $nombreEtoiles = intval($totalEvaluation / $nombreEvaluation);
                }
                return new JsonResponse(array(
                    'nombreEtoiles' => $nombreEtoiles,
                    'totalEvaluation' => $totalEvaluation,
                    'nombreEvaluation' => $nombreEvaluation
                ));
            }
        }
    }
}
