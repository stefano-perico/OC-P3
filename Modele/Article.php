<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 28/07/2017
 * Time: 21:13
 */


class Article
{
    private $_id;
    private $_titre;
    private $_contenu;
    private $_dateCreation;

    const URL = 'index.php?action=article&id=';

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
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->_titre;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->_contenu;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        if (is_string($titre))
        {
            $this->_titre = $titre;
        }
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        if (is_string($contenu))
        {
            $this->_contenu = $contenu;
        }
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = $dateCreation;
    }

    public function getExtrait()
    {
        $html = substr($this->getContenu(),0,255);
        $html .= '<p><a href="'. $this->getUrl() .'">Voir la suite</a></p>';
        return $html;
    }

    public function getUrl()
    {
        return self::URL.$this->getId();
    }


}





