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
    
    public function getCharactersToCatalog(int $userId,int $page = 1)
    {   
        $paged = $page <= 1 ? $_ENV['CATALOG_CHARACTER_PER_PAGE'] * 0 : $_ENV['CATALOG_CHARACTER_PER_PAGE'] * ($page - 1);
        
        $qb = $this->menager->createQueryBuilder();
        $qb->select('c')
            ->from('App\Entity\Character','c')
            ->where('c.isPrivate = 0 OR (c.isPrivate = 1 AND (c.player = :userId OR c.gameMaster = :userId))')
            ->setParameter('userId',$userId)
            // ->where('c.isPrivate = 0 ')
            ->orderBy('c.name', 'ASC')
            ->setFirstResult( $paged )
            ->setMaxResults( $_ENV['CATALOG_CHARACTER_PER_PAGE'] )
            ;

        $this->setMaxNumPages($qb);
            
        $query = $qb->getQuery();
           
        return  $query->execute();
    }

    public function getUserCharacters(int $userId,string $type = 'all',int $page = 1)
    {   
        $paged = $page <= 1 ? $_ENV['CATALOG_CHARACTER_PER_PAGE'] * 0 : $_ENV['CATALOG_CHARACTER_PER_PAGE'] * ($page - 1);
        
        $qb = $this->menager->createQueryBuilder();
        $qb->select('c')
            ->from('App\Entity\Character','c')
            ->orderBy('c.name', 'ASC')
            ->setFirstResult( $paged )
            ->setMaxResults( $_ENV['CATALOG_CHARACTER_PER_PAGE'] )
            ;

        switch($type)
        {   
            case 'player' :
                $qb ->where('c.player = :userId');
                break;
            case 'gameMaster' :
                $qb ->where('c.gameMaster = :userId');
                break;    
            default:
                $qb ->where('c.player = :userId OR c.gameMaster = :userId');
        }

        $qb->setParameter('userId',$userId);
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