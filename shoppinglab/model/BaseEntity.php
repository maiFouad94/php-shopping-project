<?php

class BaseEntity
{

    public function __call($methodName, $args)
    {
        if(preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches))// set or get w wraha 8rf capital 
        {
            $property = strtolower($matches[2]) . $matches[3]; //matches 2 feha awl 7rf b3d set , w match 3 feha b2y el kilma  
            if(!property_exists($this, $property)) //exception lw msh mawgoda 
            {
                throw new \Exception('Property ' . $property . ' not exists');
            }
            switch ($matches[1])
            {
                case 'set':
                    $this->checkArguments($args, 1, 1, $methodName);
                    return $this->set($property, $args[0]);
                case 'get':
                    $this->checkArguments($args, 0, 0, $methodName);
                    return $this->get($property);
                case 'default':
                    throw new \Exception('Method ' . $methodName . ' not exists');
            }
        }
    }

    public function get($property)
    {
        return $this->$property;
    }

    public function set($property, $value)
    {
        $this->$property = $value;
        return $this;
    }

    protected function checkArguments(array $args, $min, $max, $methodName)
    {
        $argc = count($args);
        if($argc < $min || $argc > $max)
        {
            throw new \Exception('Method ' . $methodName . ' needs minimaly ' . $min . ' and maximaly ' . $max . ' arguments. ' . $argc . ' arguments given.');
        }
    }

}
