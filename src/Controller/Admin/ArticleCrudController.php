<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        //mettre pleine largeur pour le contenu de l'admin, et pour l'admin en general
        ->renderContentMaximized()
        //laisse seulement les icones du menu sur la gauche, besoin de hover pour voir le texte du menu
        //->renderSidebarMinimized()
        //->setEntityLabelInSingular('Region')
        //fixe le titre du haut au case ou il y a plusieurs resultats
        ->setEntityLabelInPlural('Articles')
        //ajoute listing au titre du haut
        ->setPageTitle('index', '%entity_label_plural% listing')
        //pour les dates
        //->setDateFormat('short')
        //trier par plus grand au plus petit
        //->setDefaultSort(['id' => 'DESC'])
        //le nombre de ligne qui s'affiche sur une page au max, ici je mets 15 resultat par page
        ->setPaginatorPageSize(15)
        //la pagination et combien de pages qui s'affiche avant et apres dans la pagination
        ->setPaginatorRangeSize(3)
        
        
        ;
    }

    public function configureFields(string $pageName): iterable
    {
    return [
        IdField::new('id')->hideOnForm(),
        TextField::new('titre'),
        TextEditorField::new('contenu'),
        TextField::new('image'),
        DateTimeField::new('createdAt'),
        AssociationField::new('categorie'),
    ];
    }
}
