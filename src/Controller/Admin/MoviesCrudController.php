<?php

namespace App\Controller\Admin;

use App\Entity\Movies;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MoviesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movies::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            ArrayField::new('genre'),
            TextEditorField::new('description'),
        ];
    }

}
