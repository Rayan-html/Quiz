<?php
interface vormpje{
    function geefOppervlakte();
}
interface dummy{}

class Rondje implements vormpje, dummy{
    public $radius;
    function geefOppervlakte()
    {
        return 0.5 * 3.14 * $this->radius;
    }
}

class Persoon{

}
class Docent extends Persoon{

}