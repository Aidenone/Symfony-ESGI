<?php
 
namespace App\Form;

use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 
class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('title')
           ->add('content')
           ->add('tag', EntityType::class, [
               'label'         => 'Tag',
               'class'         => Tag::class,
               'choice_label'  => "title",
               'multiple'      => false,
               'required'      => false,
           ])
       ;
    }
}