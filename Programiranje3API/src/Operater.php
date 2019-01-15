<?php
/**
 * Created by PhpStorm.
 * User: tjakopec
 * Date: 04.12.2017.
 * Time: 09:21
 */
/**
 * @Entity @Table(name="operater")
 **/
class Operater
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $sifra;

    /** @Column(type="string") **/
    protected $email;

    /** @Column(type="string") **/
    protected $lozinka;

    /** @Column(type="string") **/
    protected $ime;

    /** @Column(type="string") **/
    protected $prezime;

    /** @Column(type="string") **/
    protected $uloga;

    /** @Column(type="datetime") **/
    protected $datumprijave;


    /**
     * @ManyToOne(targetEntity="Mjesto")
     * @JoinColumn(name="mjesto", referencedColumnName="sifra")
     */
    private $mjesto;

    /**
     * @return mixed
     */
    public function getMjesto()
    {
        return $this->mjesto;
    }

    /**
     * @param mixed $mjesto
     */
    public function setMjesto($mjesto)
    {
        $this->mjesto = $mjesto;
    }



    /**
     * @return mixed
     */
    public function getSifra()
    {
        return $this->sifra;
    }

    /**
     * @param mixed $sifra
     */
    public function setSifra($sifra)
    {
        $this->sifra = $sifra;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getLozinka()
    {
        return $this->lozinka;
    }

    /**
     * @param mixed $lozinka
     */
    public function setLozinka($lozinka)
    {
        $this->lozinka = $lozinka;
    }

    /**
     * @return mixed
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * @param mixed $ime
     */
    public function setIme($ime)
    {
        $this->ime = $ime;
    }

    /**
     * @return mixed
     */
    public function getPrezime()
    {
        return $this->prezime;
    }

    /**
     * @param mixed $prezime
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
    }

    /**
     * @return mixed
     */
    public function getUloga()
    {
        return $this->uloga;
    }

    /**
     * @param mixed $uloga
     */
    public function setUloga($uloga)
    {
        $this->uloga = $uloga;
    }

    /**
     * @return mixed
     */
    public function getDatumprijave()
    {
        return $this->datumprijave;
    }

    /**
     * @param mixed $datumprijave
     */
    public function setDatumprijave($datumprijave)
    {
        $this->datumprijave = $datumprijave;
    }


}