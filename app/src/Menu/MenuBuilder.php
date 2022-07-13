<?php

namespace App\Menu;

use App\Entity\User;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MenuBuilder
{

    const CSS_CLASSES = [
        'ROOT' => 'nav-item',
        'MENU' => 'nav-link collapsed m-0',
        'SUBMENU' => 'nav-link-text ms-1 sidemenu-submenu collapse ps-2',
        'ITEM' => 'sidenav-normal sidemenu-item',
        'LINK' => 'nav-link m-0'
    ];

    private ItemInterface $menu;
    private ?string $userRole = null;

    public function __construct(
        private readonly FactoryInterface       $factory,
        private readonly ParameterBagInterface  $parameterBag
    ){

    }
}
