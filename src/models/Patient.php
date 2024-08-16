<?php
namespace App\Models;
use Core\Model;
use DateTime;

class Patient extends Model
{

    public int $ID = 0;
    public string $TC="";
    public string $name = "";
    public string $lastName="";
    public string $dosyaNo="";
    public string $protokolNo="";
    public string $dogumYeri="";
    public DateTime $dogumTarihi;

    public function __construct()
    {
        parent::__construct();

        $this->dogumTarihi=new DateTime('now');
        dd($this->dogumTarihi->format('d.m.y'));

    }





}