<?php

namespace Core;

class Controller
{
    protected $viewPath = __DIR__ . '/../src/views/';

    public function getClassName()
    {
        // böyle bir değer geliyor App\Controllers\HomeController sadece Home kısmını almak istiyorum
        $class = explode('\\', get_class($this));
        $class = end($class);
        $class =  str_replace('Controller', '', $class);
        return $class;
    }

    public function view(string $viewname, array $data = [])
    {
        extract($data);
        $filePath = $this->viewPath . $this->getClassName() . '/' . $viewname . '.php';

        // Hata ayıklama için dosya yolunu kontrol edin
        if (!file_exists($filePath)) {
            die("View dosyası bulunamadı: " . $filePath);
        }

        include_once $filePath;
    }

    public function viewLayout(string $viewname, string $layoutname , array $data = [])
    {
        extract($data);
        $viewcontent = "";
        ob_start(); // Çıktı tamponunu başlat
        include  $this->viewPath . $this->getClassName() . '/' . $viewname . '.php';
        $output = ob_get_contents(); // Çıktıyı değişkene al
        ob_end_clean(); // Çıktı tamponunu temizle

        $viewcontent = $output; // Çıktıyı ekrana yazdır

        include_once __DIR__ . '/../src/views/layouts/' . $layoutname . '.php';
    }

    public function jsonResult($data)
    {
        echo json_encode($data);
    }
}