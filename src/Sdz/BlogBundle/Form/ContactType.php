<?php

# src/tuto/WelcomeBundle/Form/Type/ContactType.php

namespace Sdz\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Sdz\BlogBundle\Type\ContactType;

class ContactType extends AbstractType
{
public function buildForm(FormBuilder $builder, array $options)
 {
    $builder
            ->add('email', 'email')
            ->add('subject', 'text')
            ->add('content', 'textarea');
    
    
 }
public function getName()
 {
    $form = $this->get('form.factory')->create(new ContactType());
    return 'Contact';
 }
}
?>

