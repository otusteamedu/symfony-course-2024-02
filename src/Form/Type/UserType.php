<?php

namespace App\Form\Type;

use App\DTO\ManageUserDTO;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'Логин пользователя',
                'attr' => [
                    'data-time' => time(),
                    'placeholder' => 'Логин пользователя',
                    'class' => 'user-login',
                ],
            ]);

        if ($options['isNew'] ?? false) {
            $builder->add('password', PasswordType::class, [
                'label' => 'Пароль пользователя',
            ]);
        }

        $builder
            ->add('age', IntegerType::class, [
                'label' => 'Возраст',
            ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class)
            ->setMethod($options['isNew'] ? 'POST' : 'PATCH');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ManageUserDTO::class,
            'empty_data' => new ManageUserDTO(),
            'isNew' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'save_user';
    }
}
