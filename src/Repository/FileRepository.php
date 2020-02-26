<?php

namespace App\Repository;

use App\Entity\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method File|null find($id, $lockMode = null, $lockVersion = null)
 * @method File|null findOneBy(array $criteria, array $orderBy = null)
 * @method File[]    findAll()
 * @method File[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, File::class);
    }

    /**
    * @return File[] Returns an array of File objects
    */
    public function findLikeByFileName($value)
    {
        $query = $this->createQueryBuilder('f');
        return $query->where($query->expr()->like('f.file_name', ':val'))
            ->setParameter('val', '%'.$value.'%')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return File[] Returns an array of File objects
    */
    public function findLikeByFileNamePaginate($value, $current_page = 1)
    {
        $total_count = count($this->findAll());
        $per_page = 2;
        $query = $this->createQueryBuilder('f');
        $query->where($query->expr()->like('f.file_name', ':val'))
            ->setParameter('val', '%'.$value.'%')
            ->setFirstResult(($current_page-1)*$per_page)
            ->setMaxResults($per_page);
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $paginator = $this->getCollection($paginator);
        $pages_count = count($paginator);
        return [
            "total_count" => $total_count, 
            "pages_count" => $pages_count, 
            "per_page" => $per_page, 
            "current_page" => $current_page, 
            "data" => $paginator
        ];
    }

    /**
    * @return File[] Returns an array of File objects
    */
    public function findAllPaginnate($current_page = 1)
    {
        $total_count = count($this->findAll());
        $per_page = 2;
        $query = $this->createQueryBuilder("f")
                       ->setFirstResult(($current_page-1)*$per_page)
                       ->setMaxResults($per_page);
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $paginator = $this->getCollection($paginator);
        $pages_count = count($paginator);
        return [
            "total_count" => $total_count, 
            "pages_count" => $pages_count, 
            "per_page" => $per_page, 
            "current_page" => $current_page, 
            "data" => $paginator
        ];
    }

    // Get all item paginator
    public function getCollection($paginator){
        $data = [];
        foreach ($paginator as $post) {
            $data[] = $post;
        }
        return $data;
    }
       

    /*
    public function findOneBySomeField($value): ?File
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
