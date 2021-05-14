<?php

namespace App\EntityListener;

use App\Entity\Region;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegionEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Region $region, LifecycleEventArgs $event)
    {
        $region->computeSlug($this->slugger);
    }

    public function preUpdate(Region $region, LifecycleEventArgs $event)
    {
        $region->computeSlug($this->slugger);
    }
}