<?php

namespace App\Entity;


use Cocur\Slugify\Slugify;

class PropertySearch
{

    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minSurface;

    /**
     * @retrun int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
    * @param int|null $maxPrice
     * @retrun PropertySearch
     */
    public function setMaxPrice($maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * @retrun int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
    * @param int|null $minSurface
     * @retrun PropertySearch
     */
    public function setMinSurface($minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }

}
