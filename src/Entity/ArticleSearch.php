<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ArticleSearch {
    
    /**
     * @var int|null
     * 
     */
    private $minPrice;

    /**
     * @var int|null
     * @Assert\Range(max=30, maxMessage = "valeur max de {{ limit }} Euros")
     */
    private $maxPrice;  
    
    /**
     * @return int|null
     */
    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    /**
     * @param int|null $minPrice
     * @return ArticleSearch
     */
    public function setMinPrice(int $minPrice): ArticleSearch
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return ArticleSearch
     */
    public function setMaxPrice(int $maxPrice): ArticleSearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }
}