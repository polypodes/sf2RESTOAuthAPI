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
        return [
            'index' => array(
                'books'=> '/books',
                'authors'=> '/authors'
            )
        ];
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
     * bookAction
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

    /**
     * authorsAction
     *
     * @return Array data
     */
    public function authorsAction()
    {
        return ['authors' => $authors = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('LesPolypodesRestOAuthBundle:Author')
                ->findAll()];
    }

    /**
     * authorAction
     *
     * @param int id
     *
     * @return Array data
     */
    public function authorAction($id)
    {
        return ['author' => $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('LesPolypodesRestOAuthBundle:Author')
                ->find($id)];
    }


}
