<?php
/**
 * Created by PhpStorm.
 * User: denys
 * Date: 2/3/17
 * Time: 9:16 AM
 */
namespace App\Traits;

trait PreConfigurable
{
    public function isMandatory()
    {
        $mandatoryData = config('preconfigurable');
        foreach ($mandatoryData as $data) {
            if ($data['class_name'] == __CLASS__) {
                $field_name = $data['field_name'];
                $value = $this->$field_name;
                $mandatoryValues = $data['values'];
                if (in_array($value, $mandatoryValues)) {
                    return true;
                }
            }
        }
        return false;
    }
}