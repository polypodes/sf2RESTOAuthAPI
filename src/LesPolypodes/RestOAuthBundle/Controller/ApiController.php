<?php

namespace LesPolypodes\RestOAuthBundle\Controller;

class ApiController extends BaseController
{

    /**
     * indexAction
     *
     * @return Array data
     */
    public function indexAction()
    {
        return ['index' => array('books'=> '/books')];
    }

    /**
     * booksAction
     *
     * @return Array data
     */
    public function booksAction()
    {
        return ['books' => $books = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('LesPolypodesRestOAuthBundle:Book')
            ->findAll()];
    }

    /**
     * BookAction
     *
     * @param int id
     *
     * @return Array data
     */
    public function bookAction($id)
    {
        return ['book' => $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('LesPolypodesRestOAuthBundle:Book')
            ->find($id)];
    }


}
