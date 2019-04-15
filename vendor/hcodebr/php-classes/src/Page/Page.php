<?php

namespace Hcode;

use Rain\Tpl;

class Page{

    private $tpl;
    private $options = [];
    private $defaults = [
            "data" => []
    ];
    public function __construct($opts = array())
    {

        $this->options = array_merge($this->defaults,$opts);
            // configuração dos diretórios que o Rain usará como cache
        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"         => false, // set to false to improve the speed
        );

        Tpl::configure( $config );

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        $this->tpl->drawn("header");
    }
    private function setData($data = array()){
        foreach($data as $key => $value ){
            $this->tpl->assign($key,$value); //associa valores a variáveis dinamicamente no template
        }
    }

    public function setTpl($name,$data = array(), $returnHTML =false)
    {
       $this->setData($data); //
       $this->tpl->drawn($name,$returnHTML);
    }

    public function __destruct()
    {
        $this->tpl->drawn("footer");
    }

}



?>