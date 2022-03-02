<?php

namespace App\Repository;

use App\Entity\Bien;
use Symfony\Component\Mailer\Mailer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Mime\Email;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }


    // /**
    //  * @return Bien[] Returns an array of Bien objects
    //  */
    public function findSearch($data){

        // dump($data);

        $req =  $this->createQueryBuilder('b')
                ->setParameter('pmin', $data['pmin'])
                ->setParameter('pmax', $data['pmax'])
                ->setParameter('smin', $data['smin'])
                ->setParameter('smax', $data['smax'])
                ->setParameter('prmin', $data['prmin'])
                ->setParameter('prmax', $data['prmax'])

                ->andWhere('b.floor >= :pmin')
                ->andWhere('b.floor <= :pmax')
                ->andWhere('b.surface >= :smin')
                ->andWhere('b.surface <= :smax')
                ->andWhere('b.prix >= :prmin')
                ->andWhere('b.prix <= :prmax')

                ->orderBy('b.id', 'ASC')

                ->getQuery()
                ->getResult()
                ;

            // dump($req);
            // die();   
            return $req;   

    }

    public function accueil(){


            $req =  $this->createQueryBuilder('b')
                
                ->select('b')
                ->orderBy('b.id', 'ASC')

                // ->addSelect('user')
                // ->andWhere('b.agent_id' === 'id')

                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;

            // dump($req);
        return $req;

    }



    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
