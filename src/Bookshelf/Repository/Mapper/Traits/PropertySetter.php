<?php

namespace Bookshelf\Repository\Mapper\Traits;

trait PropertySetter
{
    private function setProperties($obj, $properties)
    {
        foreach ($properties as $name => $value) {
            $property = new \ReflectionProperty(get_class($obj), $name);
            $property->setAccessible(true);
            $property->setValue($obj, $value);
        }
    }
}
