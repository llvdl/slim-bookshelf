<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace Bookshelf\Database\TableMapper;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class AuthorTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'id',
            'name',
            'biography',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'id' => (object) [
                'name' => 'id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => true,
                'primary' => true,
            ],
            'name' => (object) [
                'name' => 'name',
                'type' => 'varchar',
                'size' => 100,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'biography' => (object) [
                'name' => 'biography',
                'type' => 'mediumtext',
                'size' => null,
                'scale' => null,
                'notnull' => false,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey()
    {
        return [
            'id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return 'id';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'id' => null,
            'name' => null,
            'biography' => null,
        ];
    }
}
