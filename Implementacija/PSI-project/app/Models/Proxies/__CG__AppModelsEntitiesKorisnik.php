<?php

namespace App\Models\Proxies\__CG__\App\Models\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Korisnik extends \App\Models\Entities\Korisnik implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'idkorisnik', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'ime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'prezime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'mail', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'korisnickoime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'sifra', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'tip', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'myNotifications', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'myTasks', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'myProjects'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'idkorisnik', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'ime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'prezime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'mail', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'korisnickoime', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'sifra', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'tip', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'myNotifications', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'myTasks', '' . "\0" . 'App\\Models\\Entities\\Korisnik' . "\0" . 'myProjects'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Korisnik $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getIdkorisnik()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getIdkorisnik();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdkorisnik', []);

        return parent::getIdkorisnik();
    }

    /**
     * {@inheritDoc}
     */
    public function setIme($ime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIme', [$ime]);

        return parent::setIme($ime);
    }

    /**
     * {@inheritDoc}
     */
    public function getIme()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIme', []);

        return parent::getIme();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrezime($prezime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrezime', [$prezime]);

        return parent::setPrezime($prezime);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrezime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrezime', []);

        return parent::getPrezime();
    }

    /**
     * {@inheritDoc}
     */
    public function setMail($mail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMail', [$mail]);

        return parent::setMail($mail);
    }

    /**
     * {@inheritDoc}
     */
    public function getMail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMail', []);

        return parent::getMail();
    }

    /**
     * {@inheritDoc}
     */
    public function setKorisnickoime($korisnickoime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setKorisnickoime', [$korisnickoime]);

        return parent::setKorisnickoime($korisnickoime);
    }

    /**
     * {@inheritDoc}
     */
    public function getKorisnickoime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getKorisnickoime', []);

        return parent::getKorisnickoime();
    }

    /**
     * {@inheritDoc}
     */
    public function setSifra($sifra)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSifra', [$sifra]);

        return parent::setSifra($sifra);
    }

    /**
     * {@inheritDoc}
     */
    public function getSifra()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSifra', []);

        return parent::getSifra();
    }

    /**
     * {@inheritDoc}
     */
    public function setTip($tip)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTip', [$tip]);

        return parent::setTip($tip);
    }

    /**
     * {@inheritDoc}
     */
    public function getTip()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTip', []);

        return parent::getTip();
    }

    /**
     * {@inheritDoc}
     */
    public function addMyNotification(\App\Models\Entities\Obavestenja $myNotification)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMyNotification', [$myNotification]);

        return parent::addMyNotification($myNotification);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMyNotification(\App\Models\Entities\Obavestenja $myNotification)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMyNotification', [$myNotification]);

        return parent::removeMyNotification($myNotification);
    }

    /**
     * {@inheritDoc}
     */
    public function getMyNotifications()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMyNotifications', []);

        return parent::getMyNotifications();
    }

    /**
     * {@inheritDoc}
     */
    public function addMyTask(\App\Models\Entities\Task $myTask)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMyTask', [$myTask]);

        return parent::addMyTask($myTask);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMyTask(\App\Models\Entities\Task $myTask)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMyTask', [$myTask]);

        return parent::removeMyTask($myTask);
    }

    /**
     * {@inheritDoc}
     */
    public function getMyTasks()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMyTasks', []);

        return parent::getMyTasks();
    }

    /**
     * {@inheritDoc}
     */
    public function addMyProject(\App\Models\Entities\Projekat $myProject)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMyProject', [$myProject]);

        return parent::addMyProject($myProject);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMyProject(\App\Models\Entities\Projekat $myProject)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMyProject', [$myProject]);

        return parent::removeMyProject($myProject);
    }

    /**
     * {@inheritDoc}
     */
    public function getMyProjects()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMyProjects', []);

        return parent::getMyProjects();
    }

}
