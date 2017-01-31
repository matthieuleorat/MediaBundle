<?php

namespace Lch\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller
{

    public function saveAction(Request $request)
    {
        die(dump($request->request->get('lch_multisitebundle_superadmin_site')));
        return $this->render('LchMediaBundle:Image:index.html.twig');
    }
}
