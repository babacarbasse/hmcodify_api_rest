<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HasConstraint;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;


class HasConstraintController extends Controller
{

    /**
     * @ApiDoc(
     *    section = "HasConstraint",
     *    description="Lists all hasConstraint entities."
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"hasConstraint"})
     * @Rest\Get("/hasConstraints")
     */
    public function getHasConstraintsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('AppBundle:HasConstraint')->findAll();

    }

    /**
     * @ApiDoc(
     *    section = "HasConstraint",
     *    description="Creates a new hasConstraint entity.",
     *    input={
     *      "class" = "AppBundle\Form\HasConstraintType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "HasConstraint",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=HasConstraint::class, "groups"={}},
     *         400 = {"class"=HasConstraintType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"hasConstraint"})
     * @Rest\Post("/hasConstraints")
     */
    public function postHasConstraintAction(Request $request)
    {
        $hasConstraint = new HasConstraint();
        $form = $this->createForm('AppBundle\Form\HasConstraintType', $hasConstraint);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hasConstraint);
            $em->flush();

            return $hasConstraint;
        } else {
            return $form;
        }
    }

    /**
     * @ApiDoc(
     *    section = "HasConstraint",
     *    description="Finds and displays a hasConstraint entity"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_OK, serializerGroups={"hasConstraint"})
     * @Rest\Get("/hasConstraints/{id}")
     */
    public function getHasConstraintAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:HasConstraint')->findOneBy(
            array("id" => $request->get('id'))
        );
    }

    /**
     * @ApiDoc(
     *    section = "HasConstraint",
     *    description="Remove a hasConstraint"
     * )
     *
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"hasConstraint"})
     * @Rest\Delete("/hasConstraints/{id}")
     */
    public function removeHasConstraintAction(Request $request)
    {
        $orm = $this->getDoctrine()->getManager();
        $hasConstraint = $orm->getRepository('AppBundle:HasConstraint')->findOneBy(
            array("id" => $request->get('id'))
        );
        $orm->remove($hasConstraint);
        $orm->flush();
        return;
    }


    /**
     * @ApiDoc(
     *    section = "HasConstraint",
     *    description="Update entity hasConstraint",
     *    input={
     *      "class" = "AppBundle\Form\HasConstraintType",
     *      "name" = ""
     *    },
     *    output= {
     *      "class" = "HasConstraint",
     *      "parsers"={"Nelmio\ApiDocBundle\Parser\JmsMetadataParser"},
     *      "groups"={""}
     *     },
     *    responseMap={
     *         200 = {"class"=HasConstraint::class, "groups"={}},
     *         400 = {"class"=HasConstraintType::class, "form_errors"=true, "name" = ""}
     *    },
     *    statusCodes={
     *         201="Success",
     *         400="Form error",
     *         500="Server error"
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={})
     * @Rest\Put("/hasConstraints/{id}")
     */
    public function putHasConstraintAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:HasConstraint')->findOneBy(
            array("id" => $request->get('id'))
        );

        if(empty($data)) {
            return $this->resourceNotFound();
        }

        $form = $this->createForm('AppBundle\Form\HasConstraintType', $data, []);

        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em->flush();
            return $data;
        } else {
            return $form;
        }
    }

    public function resourceNotFound() {
        return \FOS\RestBundle\View\View::create(['message' => 'Resource not found'], Response::HTTP_NOT_FOUND);
    }
}
