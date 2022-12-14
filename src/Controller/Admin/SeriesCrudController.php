<?php

namespace App\Controller\Admin;

use App\Entity\Series;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SeriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Series::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('languages'),
            NumberField::new('episode_time'),
            TextField::new('backdrop_path'),
            NumberField::new('number_episodes'),
            TextEditorField::new('description'),
        ];
    }

}
