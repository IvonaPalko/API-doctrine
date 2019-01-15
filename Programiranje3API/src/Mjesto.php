<?php
/**
 * Created by PhpStorm.
 * User: tjakopec
 * Date: 05.12.2017.
 * Time: 13:05
 */

/**
 * @Entity @Table(name="mjesto")
 **/
class Mjesto
{

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $sifra;

    /** @Column(type="string") **/
    protected $naziv;

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
    public function getNaziv()
    {
        return $this->naziv;
    }

    /**
     * @param mixed $naziv
     */
    public function setNaziv($naziv)
    {
        $this->naziv = $naziv;
    }


}