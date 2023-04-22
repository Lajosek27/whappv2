<?php 
namespace App\Services;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;


class charactersService
{   

    private int $maxNumPages;

    public function __construct(private EntityManagerInterface $menager)
    {
        
    }
    
    public function getCharactersToCatalog(int $page = 1)
    {   
        $paged = $page <= 1 ? $_ENV['CATALOG_CHARACTER_PER_PAGE'] * 0 : $_ENV['CATALOG_CHARACTER_PER_PAGE'] * ($page - 1);

        $qb = $this->menager->createQueryBuilder();
        $qb->select('c')
            ->from('App\Entity\Character','c')
            // ->where('c.isPrivate = 0 OR (c.isPrivate = 1 AND (c.player = :userId OR c.gameMaster = :userId))')
            ->where('c.isPrivate = 0 ')
            // ->setParameter('userId',1)
            ->orderBy('c.name', 'ASC')
            ->setFirstResult( $paged )
            ->setMaxResults( $_ENV['CATALOG_CHARACTER_PER_PAGE'] )
            ;

        $this->setMaxNumPages($qb);
            
        $query = $qb->getQuery();
           
        return  $query->execute();
    }

    private function setMaxNumPages($qb)
    {
        $paginator = new Paginator($qb);
        $this->maxNumPages = ceil(count($paginator)/$_ENV['CATALOG_CHARACTER_PER_PAGE']);
    }

    public function getMaxNumPages()
    {
        return $this->maxNumPages;
    }
    
}

?>