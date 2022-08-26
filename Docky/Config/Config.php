<?php

namespace Docky\Config;

class Config {

  public $cfg_data,$vars,$templvars;

  public function __init($cfg_data){

    $this->cfg_data = $cfg_data;

  }

  public function vars_init($vars){

    $this->vars = $vars;

  }

  public function set($var,$val){

    $this->cfg_data[$var] = $val;

  }

  public function get($var){

    return $this->cfg_data[$var];

  }

  public function vars_get(){

    return $this->vars;

  }

  public function vars_get_var($var){

    return $this->vars[$var];

  }

  // TEMPLATE CODE

  public function template_vars_init($templvars){

    $this->templvars = $templvars;

  }

  public function template_vars_get(){

    return $this->templvars;

  }

}

$Config = new Config([]);

$Config->vars_init(

[

  "project" => 'Scandiweb Test assignment',

  "domain" => "http://".$_SERVER['HTTP_HOST']."/",

  "seo_site_name" => "Scandiweb Test assignment",

  "seo_keywords" => "Scandiweb Test assignment",

  "seo_language" => "ru-UA",

  "seo_description" => "Scandiweb Test assignment",

  "seo_image" => "Картинка"

]

);

$Config->template_vars_init(

[
'project' => $Config->vars_get_var("project")
]

);

