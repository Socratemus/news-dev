<?php

namespace models\Entities;


abstract class AbstractEntity {
    
    public final function exchange( $Data ){
        
        $reflect = new \ReflectionClass($this);
        
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
        //var_dump($props);
        
        foreach($props as $prop){
            
            if(isset($Data[$prop->getName()]) && $val = $Data[$prop->getName()]){
                
                if(method_exists ( $this , $method = 'set' .  $prop->getName()  )){
                   
                    $this->{$method}($val);
                }
                
                
            }
            
        }
       
    }
    
}