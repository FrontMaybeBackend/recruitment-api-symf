<?php

namespace App\Controller\Admin;

use App\Entity\Application;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ApplicationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Application::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->setFormOptions([
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
                'csrf_token_id' => 'app',
                'validation_groups' => ['admin'],

            ])
            ->setPaginatorPageSize(5)
            ->setPaginatorRangeSize(5);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Imię'),
            TextField::new('surname', 'Nazwisko'),
            EmailField::new('email'),
            TextField::new('phone', 'Telefon'),
            IntegerField::new('experience', 'Doświadczenie (lata)'),
            ChoiceField::new('jobTypeEnum', 'Tryb pracy')
                ->setFormTypeOption('choice_label', fn($value) => $value->getLabel()),
            ChoiceField::new('positionTypeEnum', 'Poziom doświadczenia')
                ->setFormTypeOption('choice_label', fn($value) => $value->getLabel()),
        ];
    }

}
