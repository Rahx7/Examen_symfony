<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Mail;
use App\Entity\User;


use App\Entity\Photo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private $manager;

    public function __construct(ManagerRegistry $manager){
        $this->manager = $manager ;

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        $manager = $this->manager;

        $Users =  $manager->getRepository(User::class)->findAll();
        $Mails =  $manager->getRepository(Mail::class)->findAll();
        $Biens =  $manager->getRepository(Bien::class)->findAll();

        return $this->render('admin/dashboard.html.twig',[
            'Users'=> $Users,
            'Mails'=> $Mails,
            'Biens'=> $Biens,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecf symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('menu User');
        yield MenuItem::linkToCrud('Bien', 'fa fa-house-user', Bien::class); 
        yield MenuItem::linkToCrud('photo', 'fa fa-house-user', Photo::class); 

        if($this->getUser() && $this->isGranted('ROLE_ADMIN') && $this->isGranted('ROLE_SUPER_ADMIN') ){
 
            yield MenuItem::section('menu Admin');
            yield MenuItem::linkToCrud('Mail', 'fa fa-smile', Mail::class);
        }
        if($this->getUser() && $this->isGranted('ROLE_SUPER_ADMIN') ){
            yield MenuItem::section('menu Super Admin');
            yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
    }
    }
}
