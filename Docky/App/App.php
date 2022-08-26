<?php
namespace Docky\App;
class App {
  public function render($template_name, $__TEMPLATE_CONFIG__){
    if (file_exists("./src/tpl/$template_name.tpl")){
      $TplFile = fopen("./src/tpl/$template_name.tpl", "r");
      if ($TplFile) {
        while (!feof($TplFile)) {
          $buffer = fgets($TplFile, 4096);
          if (strpos($buffer,"<%=")){
            $numoftokens = count(explode("<%=", $buffer));
            if ($numoftokens == 2){
              $bufferVar = substr($buffer, 0, strpos($buffer, "%>"));
              $end = substr($bufferVar, strpos($bufferVar, '<%='));
              $varFound = trim(str_replace(";","",str_replace("<%=","",$end)));
              echo str_replace("<%= $varFound; %>",$__TEMPLATE_CONFIG__[$varFound],$buffer);
            }else{
              $bufferVar = explode("<%", $buffer);
              $buffarray = $bufferVar;
              $_newText  = [];
              for ($i = 1;$i<$numoftokens;$i++){
                for ($k = 0;$k < count($buffarray);$k++){
                  if (strpos($buffarray[$k], "%>")){

                  }else{
                    unset($buffarray[$k]);
                  }
                }
                $jlcount = 0;
                foreach($buffarray as $debuff){
                  $new_debuff = str_replace($debuff[0], "", $debuff);
                  $next_debuff = str_replace("%>", "", $new_debuff);
                  $newBuff = trim(explode(";", $next_debuff)[0]);
                  $_newText[$jlcount] = "<%= $newBuff; %>:".$__TEMPLATE_CONFIG__[$newBuff];
                  $jlcount++;
                }
              }
              $line = $buffer;
              for($l = 0;$l<count($_newText);$l++){
                $line_expl = explode(":",$_newText[$l]);
                $line = str_replace($line_expl[0],$line_expl[1],$line);
              }
              echo $line;
            }
          }else{
            echo $buffer;
          }
        }
        fclose($TplFile);
      }
    }else{
      die("App Error: Render Error template path in template {{".$template_name."}} not found!");
    }
  }
}
$App = new App([]);
