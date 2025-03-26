<?php

namespace DanielKnoop\StadtBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelpController extends AbstractController
{
    private $navigation;
    
    public function __construct()
    {
        $this->navigation = array(
            'Einleitung' => array(
                'Systemvoraussetzungen' => array(),
                'Copyright'             => array()
            ),
            'Starten und Beenden' => array(),
            'Benutzeroberfläche' => array(
                'Kartenfenster' => array(
                    'Kartennavigation'   => array(),
                    /*'Zoomwerkzeuge'    => array(),*/
                    'Übersichtskarte'    => array(),
                ),
                'Werkzeugleiste' => array(
                    'Hintergrundkartenauswahl'      => array(),
                    'Informationsabfrage'           => array(),
                    'Karte drucken'                 => array(),
                    'Karte exportieren'             => array(),
                    'Standort'                      => array(),
                    'Treffpunkt'                    => array(),
                    'Strecke oder Flaeche messen'   => array(),
                    'Redlining'                     => array(),
                ),
                'Steuertafel' => array(
                    'Suche'                         => array(),
                 ),   
                'Fußleiste' => array(
                    'Koordinatenanzeige'            => array(),   
                ),
            ),
            'Kontakt' => array()
        );
    }
    
    #[Route('/help', name: 'mapbender_help_page')]
    public function indexAction()
    {
        //return $this->getParams('', '', 'Einleitung');
        return $this->render('@DanielKnoopStadtBundle/Resources/views/Help/page.html.twig', $this->getParams('', '', 'Einleitung'));
    }
    
    #[Route('/help/{category}/{page}', name: 'mapbender_help_category')]
    public function categoryPageAction($category, $page)
    {
        return $this->render('@DanielKnoopStadtBundle/Resources/views/Help/page.html.twig', $this->getParams($category, '', $page));
    }    
    
    #[Route('/help/{subcategory}/{category}/{page}', name: 'mapbender_help_subcategory')]
    public function subcategoryPageAction($category, $subcategory, $page)
    {
        return $this->render('@DanielKnoopStadtBundle/Resources/views/Help/page.html.twig', $this->getParams($category, $subcategory, $page));
    }    
    
    private function getParams($category, $subcategory, $page)
    {

        return array(
            'category'    => $category,
            'subcategory' => $subcategory,
            'page'        => $page,
            'navigation'  => $this->navigation,
            'title'       => (empty($category)?'':' &raquo; '.$category).(empty($category)?'':' &raquo; '.$subcategory)
        );
    }

}
