<?php

namespace App\Functions;

class GenericModel
{

    public function validation(): bool
    {
        $data = [];
        $methods = get_class_methods(get_class($this));

        foreach ($methods as $value) {
            if (preg_match("/^set/", $value)) {
                $nameProperty = str_replace("set", "", $value);
                $nameMethod = "get{$nameProperty}";
                $data[mb_strtolower($nameProperty)] = $this->$nameMethod();
            }
        }

        foreach ($this->required as $field) {
            if (empty($data[$field])) {
                $this->message = "Por favor, preencha todos os campos!";
                return false;
            }
        }
        return true;
    }

}
