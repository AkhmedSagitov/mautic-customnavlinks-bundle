<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Mautic\CoreBundle\Controller\CommonController;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Entity\MenuItem;
use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type\MenuItemType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuItemController extends CommonController
{

    public function indexAction(): Response
    {
        $items = $this->getDoctrine()->getRepository(MenuItem::class)->findAll();

        return $this->delegateView([
            'viewParameters'  => [
                'menuItems'  => $items,
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }

    public function newAction(Request $request, EntityManagerInterface $em): Response
    {
        $menuItem = new MenuItem();
        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($menuItem);
            $em->flush();

            return $this->redirectToRoute('mautic_menu_item_index');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'action' => 'new',
                'form'   => $form->createView(),
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }

    public function editAction(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $menuItem = $em->getRepository(MenuItem::class)->find($id);

        if (!$menuItem) {
            throw $this->createNotFoundException('MenuItem not found.');
        }

        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('mautic_menu_item_index');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'action'    => 'edit',
                'form'      => $form->createView(),
                'menu_item' => $menuItem,
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }

    public function showAction(int $id, EntityManagerInterface $em): Response
    {
        $menuItem = $em->getRepository(MenuItem::class)->find($id);

        if (!$menuItem) {
            throw $this->createNotFoundException('MenuItem not found.');
        }

        return $this->delegateView([
            'viewParameters'  => [
                'action'    => 'show',
                'menu_item' => $menuItem,
            ],
            'contentTemplate' => '@LeuchtfeuerCustomNavlinks/CreateMenu/index.html.twig',
        ]);
    }

    public function deleteAction(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $menuItem = $em->getRepository(MenuItem::class)->find($id);

        if (!$menuItem) {
            throw $this->createNotFoundException('MenuItem not found.');
        }

        if ($this->isCsrfTokenValid('delete'.$menuItem->getId(), $request->request->get('_token'))) {
            $em->remove($menuItem);
            $em->flush();
        }

        return $this->redirectToRoute('mautic_menu_item_index');
    }
}