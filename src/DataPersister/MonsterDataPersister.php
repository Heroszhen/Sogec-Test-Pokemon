<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Monster;
use Doctrine\ORM\EntityManagerInterface;

final class MonsterDataPersister implements ContextAwareDataPersisterInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Monster;
    }

    public function persist($data, array $context = [])
    {
        // call your persistence layer to save $data
        if($data->getId() != null){
            $old = $this->em->find(Monster::class,$data->getId());
        }
        
        $ob = $data;
        if($data->getId() != null){
            $ob = $old;
            $ob
                ->setName($data->getName())
                ->setType1($data->getType1())
                ->setGeneration($data->getGeneration())
                ->setIslegendary($data->getIslegendary());
        }
        //return $this->decorated->remove($data, $context);
        $this->em->persist($ob);
        $this->em->flush();
        return $ob;
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}