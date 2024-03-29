<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Mail;
use App\Form\MailCustomType;
use App\Form\SearchCustomType;
use Symfony\Component\Mime\Email;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BienController extends AbstractController
{

    #[Route('/', name: 'accueil')]
    public function accueil(ManagerRegistry $manager): Response
    {
  
        return $this->render('bien/index.html.twig', [
            'biens' => $manager->getRepository(Bien::class)->accueil()
        ]);

    }


    #[Route('/biens', name: 'biens')]
    public function index(ManagerRegistry $manager, Request $request): Response
    {
        $form = $this->createForm(SearchCustomType::class); 
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
                {
                    // $data = $form->getData();
                    
                    
                    $arrayData = [
                        "pmin"=> $form->get('piecemin')->getData(),
                        "pmax"=> $form->get('piecemax')->getData(),
                        "smin"=> $form->get('surfacemin')->getData(),
                        "smax"=> $form->get('surfacemax')->getData(),
                        "prmin"=> $form->get('prixmin')->getData(),
                        "prmax"=> $form->get('prixmax')->getData(), 
                    ];


                    $biens = $manager->getRepository(Bien::class)->findSearch($arrayData);
                    
                    // dump($biens);
                    // die(); 

                }else{

                  $biens = $manager->getRepository(Bien::class)->findAll();  

                }
        
        return $this->render('bien/index.html.twig', [

            'biens' => $biens,
            "formSearch"=> $form->createView()

        ]);

    }

    #[Route('/biens/{id}', name: 'biens_single', requirements:['id'=>'\d+'], methods:["POST","GET"])]  
    #[Route('/bien/{id}/mail', name:'mail', methods:["POST","GET"])] 
    public function single(int $id, ManagerRegistry $manager, Request $request, MailerInterface $mailer): Response
    {     

        $mailEnvoi = New Mail;

        $form = $this->createForm(MailCustomType::class, $mailEnvoi);
        $form->handleRequest($request);
        
        // dump($request);
        
        if($form->isSubmitted() && $form->isValid())
                {
                    $om = $manager->getManager();

                    $bienMail = $manager->getRepository(Bien::class)->find($id);
                   
                    $agent = $bienMail->getAgent();
                    //  dump($rdv->format('Y-m-d H:i:s'));

                    // die(); 
                    // $agent = $bienMail->agent;
                    $mailEnvoi->setAgent($agent);

                    $nom = $form->get('nom')->getData();
                    $prenom = $form->get('prenom')->getData();
                    $mail = $form->get('email')->getData();
                    $rdv = $form->get('rdv')->getData();
                    $mailAgent = $agent->getEmail();

                    

                    // $manager->getRepository(Bien::class)->mailCustom($data);

                    $email = (new Email())
                        ->from($mail) // ya probablement un hic passque l'envoyeur du mail n'est pas 
                        ->to($mailAgent, $mail)
                        ->subject('nouveau rdv avec '.$nom.' '.$prenom)
                        ->text('un rendez-vous est à valider pour le '.$rdv->format('Y-m-d H:i:s').' concernant le bien Id '.$bienMail->getId().' intitulé '.$bienMail->getTitre());
            
                    $mailer->send($email); //

                    $om->persist($mailEnvoi);
                    $om->flush();

                    $this->addFlash('success', 'votre email a bien été envoyé');
                    // die();
                    return $this->redirectToRoute('accueil');
                }

        return $this->render('bien/index.html.twig', [

           "bien" => $manager->getRepository(Bien::class)->find($id),
           "formMail"=> $form->createView()

        ]);
    }


}
