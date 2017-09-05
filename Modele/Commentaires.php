<?php


class Commentaires
{
    private $_id;
    private $_pseudo;
    private $_contenu;
    private $_dateCreation;
    private $_idArticle;
    private $_idParent;
    private $_signaler;
    private $_moderer;

    /**
     * @return mixed
     */
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->_pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->_pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        if ($this->getModerer() == 1)
        {
            $this->setContenu('Ce commentaire a été modéré par l\'administrateur');
        }
        return $this->_contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->_contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->_idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->_idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getIdParent()
    {
        return $this->_idParent;
    }

    /**
     * @param mixed $idParent
     */
    public function setIdParent($idParent)
    {
        $this->_idParent = $idParent;
    }

    /**
     * @return mixed
     */
    public function getSignaler()
    {
        return $this->_signaler;
    }

    /**
     * @param mixed $signaler
     */
    public function setSignaler($signaler = 1)
    {
        $this->_signaler = $signaler;
    }

    public function getModerer()
    {
        return $this->_moderer;
    }

    /**
     * @param mixed $administrer
     */
    public function setModerer($administrer = 1)
    {
        $this->_moderer = $administrer;
    }




}