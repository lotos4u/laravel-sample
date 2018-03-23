<?php

namespace App\Models;

use Collective\Html\FormFacade;

class FormFactory
{

    const MULTI_SELECT_CLASS = 'multiselect-form-select';
    const MULTI_SELECT_PRESENT_INDICATOR = 'multiple_select_present';

    public static function getLabel($name, $text, array $attributes = null)
    {
        $data = ['class' => 'control-label'];
        if (is_array($attributes)) {
            $data = array_merge($data, $attributes);
        }
        $element = FormFacade::label($name, $text, $data);
        return $element;
    }

    public static function getInput($name, $type, $value, array $values = null, array $attributes = null)
    {
        $allowedTypes = ['text', 'textarea', 'select'];
        if (!in_array($type, $allowedTypes)) {
            throw new \Exception("Unknown form input type '$type'");
        }
        $data = ['class' => 'form-control'];
        if (is_array($attributes)) {
            $data = array_merge($data, $attributes);
        }

        $element = null;
        if (in_array($type, ['text', 'textarea'])) {
            $element = FormFacade::$type($name, $value, $data);
        } elseif ($type === 'select') {
            if (is_array($values) && count($values) > 0) {
                $addin = '';
                if (isset($data['multiple']) && $data['multiple']) {
                    $addin = FormFacade::hidden(FormFactory::MULTI_SELECT_PRESENT_INDICATOR . '_' . $name, $name);
                    $name .= '[]';
                }
                $element = FormFacade::$type($name, $values, $value, $data) . $addin;
            } else {
                throw new \Exception('Select element must have values!');
            }
        } else {
            throw new \Exception('Unknown error!');
        }

        return $element;
    }
}