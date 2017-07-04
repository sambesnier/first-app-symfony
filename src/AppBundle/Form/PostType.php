<?php

namespace AppBundle\Form;

use AppBundle\Repository\AuthorRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    "label" => "Titre"
                ])
            ->add(
                'author',
                EntityType::class,
                [
                    "class" => "AppBundle\Entity\Author",
                    "choice_label" => "name",
                    "placeholder" => "Choisissez un auteur",
                    "label" => "Auteur",
                    "query_builder" => function(AuthorRepository $er) {
                        return $er->getOnlyWomen();
                    }
                ])
            ->add(
                'content',
                TextareaType::class,
                [
                    'attr' =>
                        [
                            'rows' => 6
                        ],
                    "label" => "Texte"
                ])
            ->add(
                'tags',
                EntityType::class,
                [
                    "class" => "AppBundle\Entity\Tag",
                    "choice_label" => "tagName",
                    "label" => "Tags",
                    "multiple" => true,
                    "expanded" => true
                ])
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Valider'
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_post';
    }


}
