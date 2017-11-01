<?php

namespace InfyOm\Generator\Utils;

class SchemaUtil
{
    public static function createField($field)
    {
        $fieldName = $field['fieldName'];
        $databaseInputStr = $field['databaseInputs'];

        $databaseInputs = explode(':', $databaseInputStr);

        $fieldTypeParams = explode(',', array_shift($databaseInputs));
        $fieldType = array_shift($fieldTypeParams);

        $fieldStr = '$table->'.$fieldType."('".$fieldName."'";

        if (count($fieldTypeParams) > 0) {
            $fieldStr .= ', '.implode(' ,', $fieldTypeParams);
        }
        if ($fieldType == 'enum') {
            $inputsArr = explode(',', $field['fieldName']);
            $inputArrStr = GeneratorFieldsInputUtil::prepareValuesArrayStr($inputsArr);
            $fieldStr .= ', '.$inputArrStr;
        }
        if($fieldType == 'boolean')
        {
            $fieldStr .= ')->default(0)';
        }else {
            $fieldStr .= ')';
        }

        if (count($databaseInputs) > 0) {
            foreach ($databaseInputs as $databaseInput) {
                $databaseInput = explode(',', $databaseInput);
                $type = array_shift($databaseInput);

                
                $fieldStr .= "->$type(".implode(',', $databaseInput).')';
                
            }
        }

        $fieldStr .= ';';

        return $fieldStr;
    }
}
