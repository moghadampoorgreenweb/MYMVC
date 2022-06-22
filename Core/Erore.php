<?php namespace Core;


use App\Config;

class Erore
{

    public static function erorehandller($level ,$massage ,$file ,$line)
    {
        if ( error_reporting() !== 0 ){
            throw  new \ErrorException($massage,0,$level,$file,$line);
        }
    }

    public static function exebtionhandler($exebtion)
    {
        $code=$exebtion->getCode();
        if ($code != 404){
           $code= 500;
        }
         http_response_code($code);
       // var_dump($exebtion);
// debug    true or false
      if (Config::SHOW_DEBUG){
          echo "<h1>fatal erore : </h1>";
          echo "  <p> Uncaught Exception :". get_class($exebtion) . "</p>";
          echo "  <p> message :'" .$exebtion->getmessage(). "'</p>";
          echo "  <p> trace : <pre>" .$exebtion->getTraceAsString(). "</pre> </p>";
          echo "  <p> throw in :  " .$exebtion->getfile()." to line : ".$exebtion->getline(). " </p>";
      }else{
         $log= dirname(__DIR__).'/Storage/logs/'.date('Y-M-D').'txt';
         ini_set('error_log',$log);
          $massage= "\n";
          $massage.= "<h1>fatal erore : </h1>\n";
          $massage.= "  <p> Uncaught Exception :". get_class($exebtion) . "</p>\n";
          $massage.= "  <p> message :'" .$exebtion->getmessage(). "'</p>\n";
          $massage.= "  <p> trace : <pre>" .$exebtion->getTraceAsString(). "</pre> </p>\n";
          $massage.= "  <p> throw in :  " .$exebtion->getfile()." to line : ".$exebtion->getline(). " </p>\n";
          $massage.= '___________________________________________'."\n";
          error_log($massage);
          // view 404
      //    echo View::render("errors/{$code}");
          echo View::rendertemplate("errors.{$code}");
      }

    }
/*    function test() {
        try {
            throw new Exception('foo');
        } catch (Exception $e) {
            $e->getTraceAsString();
            return 'catch';
        } finally {
            return 'finally';
        }
    }*/
}