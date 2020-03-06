<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\Category;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{CollectionType, FileType, IntegerType, TextType, SubmitType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('image', FileType::class, [])
            ->add('life')
            ->add('attack')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('add', SubmitType::class, [
                'label' => 'Create card'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
