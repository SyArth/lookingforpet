<?php

namespace App\Controller\Admin;

use App\Entity\Puce;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class PuceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Puce::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex(),
            TextField::new('numero'),
            AssociationField::new('animal'),
        ];
    }

}
