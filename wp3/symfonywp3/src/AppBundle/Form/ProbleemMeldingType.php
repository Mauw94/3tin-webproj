<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use AppBundle\Entity\Post;
use AppBundle\Entity\Probleemmelding;
use AppBundle\Form\Type\DateTimePickerType;
use AppBundle\Form\Type\TagsInputType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines the form used to create and manipulate blog posts.
 *
 */
class ProbleemMeldingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('locatieid', null, [
                'attr' => ['autofocus' => true],
                'label' => 'label.locatie_id',
            ])
            ->add('probleem', null, [
                'label' => 'label.probleem',
            ])
            ->add('datum', DateTimePickerType::class, [
                'label' => 'label.date',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Probleemmelding::class,
        ]);
    }
}
