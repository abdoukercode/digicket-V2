<?php


namespace AppBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use AppBundle\Document\Ticket;
/**
 * @MongoDB\Document(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{

    /**
     * @MongoDB\Id
     */
    protected $public_id;

    /**
     * @MongoDB\Field(type="string" , nullable=true)
     */
    protected $name;

    /**
     * @MongoDB\Field(type="string", nullable=true)
     */
    protected $username;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $password;


    /**
     * @MongoDB\Field(type="string")
     */
    protected $email;


    /**
     * @MongoDB\Field(type="string" , nullable=true)
     */
    protected $facebook_uid;

    /**
     * @MongoDB\Field(type="string" , nullable=true)
     */
    protected $avatar;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $enabled;


    /**
     * @MongoDB\Field(type="string", nullable=true)
     */
    protected $refresh_token;

    /**
     * @MongoDB\Field(type="date", nullable=true)
     */
    protected $created_at;


    /**
     * @MongoDB\Field(type="date", nullable=true)
     */
    protected $updated_at;


    /**
     * @MongoDB\Field
     * @MongoDB\ReferenceMany(targetDocument="Ticket"  )
     */
    private $tickets;


    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get publicId
     *
     * @return id $publicId
     */
    public function getPublicId()
    {
        return $this->public_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set facebookUid
     *
     * @param string $facebookUid
     * @return $this
     */
    public function setFacebookUid($facebookUid)
    {
        $this->facebook_uid = $facebookUid;
        return $this;
    }

    /**
     * Get facebookUid
     *
     * @return string $facebookUid
     */
    public function getFacebookUid()
    {
        return $this->facebook_uid;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string $avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refresh_token = $refreshToken;
        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string $refreshToken
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param date $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add ticket
     *
     * @param AppBundle\Document\Ticket $ticket
     */
    public function addTicket(\AppBundle\Document\Ticket $ticket)
    {
        $this->tickets[] = $ticket;
    }

    /**
     * Remove ticket
     *
     * @param AppBundle\Document\Ticket $ticket
     */
    public function removeTicket(\AppBundle\Document\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection $tickets
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getPublicId();
    }

}
