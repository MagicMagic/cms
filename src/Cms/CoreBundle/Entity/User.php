<?php

    namespace Cms\CoreBundle\Entity;

    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\Role\Role;
    use Symfony\Component\Security\Core\User\AdvancedUserInterface;

    /**
     * User
     *
     * @ORM\Table(name="users")
     * @ORM\Entity(repositoryClass="Cms\CoreBundle\Entity\UserRepository")
     */
    class User implements AdvancedUserInterface, \Serializable
    {
        /**
         * @var integer
         *
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @var string
         *
         * @ORM\Column(name="username", type="string", length=60, unique=true)
         */
        private $username;

        /**
         * @var string
         *
         * @ORM\Column(name="password", type="string", length=64)
         */
        private $password;

        /**
         * @var string
         *
         * @ORM\Column(name="salt", type="string", length=42)
         */
        private $salt;

        /**
         * @var string
         *
         * @ORM\Column(name="name", type="string", length=255)
         */
        private $name;

        /**
         * @var boolean
         *
         * @ORM\Column(name="active", type="boolean")
         */
        private $active;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="date_modified", type="datetime")
         */
        private $dateModified;

        /**
         * @var \DateTime
         *
         * @ORM\Column(name="date_created", type="datetime")
         */
        private $dateCreated;

        /**
         * @var ArrayCollection|Role
         * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
         */
        private $roles;

        public function __construct()
        {
            $this->active      = 1;
            $this->salt        = sha1(uniqid(null, true));
            $this->dateCreated = new \DateTime();
            $this->roles       = new ArrayCollection();
        }

        /**
         * Get id
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set username
         *
         * @param string $username
         * @return User
         */
        public function setUsername($username)
        {
            $this->username = $username;

            return $this;
        }

        /**
         * Get username
         *
         * @return string
         */
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * Set password
         *
         * @param string $password
         * @return User
         */
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        /**
         * Get password
         *
         * @return string
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set salt
         *
         * @param string $salt
         * @return User
         */
        public function setSalt($salt)
        {
            $this->salt = $salt;

            return $this;
        }

        /**
         * Get salt
         *
         * @return string
         */
        public function getSalt()
        {
            return $this->salt;
        }

        /**
         * Set name
         *
         * @param string $name
         * @return User
         */
        public function setName($name)
        {
            $this->name = $name;

            return $this;
        }

        /**
         * Get name
         *
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Set active
         *
         * @param boolean $active
         * @return User
         */
        public function setActive($active)
        {
            $this->active = $active;

            return $this;
        }

        /**
         * is active
         *
         * @return boolean
         */
        public function isActive()
        {
            return $this->active;
        }

        /**
         * Set dateModified
         *
         * @param \DateTime $dateModified
         * @return User
         */
        public function setDateModified($dateModified)
        {
            $this->dateModified = $dateModified;

            return $this;
        }

        /**
         * Get dateModified
         *
         * @return \DateTime
         */
        public function getDateModified()
        {
            return $this->dateModified;
        }


        /**
         * Get dateCreated
         *
         * @return \DateTime
         */
        public function getDateCreated()
        {
            return $this->dateCreated;
        }

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * String representation of object
         * @link http://php.net/manual/en/serializable.serialize.php
         * @return string the string representation of the object or null
         */
        public function serialize()
        {
            return serialize(array(
                $this->id,
            ));
        }

        /**
         * (PHP 5 &gt;= 5.1.0)<br/>
         * Constructs the object
         * @link http://php.net/manual/en/serializable.unserialize.php
         * @param string $serialized <p>
         * The string representation of the object.
         * </p>
         * @return void
         */
        public function unserialize($serialized)
        {
            list (
                $this->id,
                ) = unserialize($serialized);
        }

        /**
         * Returns the roles granted to the user.
         *
         * <code>
         * public function getRoles()
         * {
         *     return array('ROLE_USER');
         * }
         * </code>
         *
         * Alternatively, the roles might be stored on a ``roles`` property,
         * and populated in any number of different ways when the user object
         * is created.
         *
         * @return Role[] The user roles
         */
        public function getRoles()
        {
            return $this->roles->toArray();
        }

        /**
         * Removes sensitive data from the user.
         *
         * This is important if, at any given point, sensitive information like
         * the plain-text password is stored on this object.
         */
        public function eraseCredentials()
        {
            // TODO: Implement eraseCredentials() method.
        }

        /**
         * Checks whether the user's account has expired.
         *
         * Internally, if this method returns false, the authentication system
         * will throw an AccountExpiredException and prevent login.
         *
         * @return Boolean true if the user's account is non expired, false otherwise
         *
         * @see AccountExpiredException
         */
        public function isAccountNonExpired()
        {
            // TODO: Implement isAccountNonExpired() method.
            return true;
        }

        /**
         * Checks whether the user is locked.
         *
         * Internally, if this method returns false, the authentication system
         * will throw a LockedException and prevent login.
         *
         * @return Boolean true if the user is not locked, false otherwise
         *
         * @see LockedException
         */
        public function isAccountNonLocked()
        {
            // TODO: Implement isAccountNonLocked() method.
            return true;
        }

        /**
         * Checks whether the user's credentials (password) has expired.
         *
         * Internally, if this method returns false, the authentication system
         * will throw a CredentialsExpiredException and prevent login.
         *
         * @return Boolean true if the user's credentials are non expired, false otherwise
         *
         * @see CredentialsExpiredException
         */
        public function isCredentialsNonExpired()
        {
            // TODO: Implement isCredentialsNonExpired() method.
            return true;
        }

        /**
         * Checks whether the user is enabled.
         *
         * Internally, if this method returns false, the authentication system
         * will throw a DisabledException and prevent login.
         *
         * @return Boolean true if the user is enabled, false otherwise
         *
         * @see DisabledException
         */
        public function isEnabled()
        {
            return $this->isActive();
        }
    }
