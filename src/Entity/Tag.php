<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var Article
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="tag")
     * @ORM\JoinColumn(nullable=true)
     */
    private $articles;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Add Article
     *
     * @param Article $article
     * @return tag
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        return $this;
    }
    /**
     * Remove Article
     *
     * @param Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }
    /**
     * @return Article
     */
    public function getArticles(): ?Collection
    {
        return $this->articles;
    }
}
