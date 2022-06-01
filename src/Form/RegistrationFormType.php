<?php

namespace App\Form;

use App\Entity\Sport;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'choice_label' => 'libelle',
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => true,
            ])

            ->add('sexe', ChoiceType::class, [
                'required' => true,
                'label' => 'Etes-vous un homme ou une femme?',
                'choices' => [
                    'Femme' => 'femme',
                    'Homme' => 'homme',
                    'Autre' => 'Autre',
                ],
            ])
            ->add('age', ChoiceType::class, [
                'required' => true,
                'label' => 'Quel âge avez-vous ?',
                'choices' => array_combine(range(18, 99, 1), range(18, 99, 1)),
            ])
            ->add('ville', CountryType::class, [
                'required' => true,
                'label' => 'Dans quelle ville de France habitez-vous ?',
                'attr' => [
                    'placeholder' => 'Tapez et choississez une localisation',
                ],
            ])
            ->add('pseudo', TextType::class, [
                'required' => true,
                'label' => 'Crée un nom d\'utilisateur',
                'help' => 'C\'est le nom que les autres voient. Cela peut simplement être votre prénom.',
                'attr' => [
                    'placeholder' => 'Entrez votre nom ici',
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Votre adresse email',
                'help' => 'Votre adresse email reste invisible aux autres utilisateurs.',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email ici',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Je déclare avoir 18 ans ou plus et j\'accepte les Termes et conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions pour poursuivre sur le site internet.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirme ton mot de passe'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
