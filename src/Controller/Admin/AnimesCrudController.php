<?php

namespace App\Controller\Admin;

use App\Entity\Animes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnimesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animes::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('type'),
            TextField::new('status'),
            TextField::new('image'),
            NumberField::new('episode_count'),
            TextEditorField::new('synopsis'),
        ];
    }

}
