<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace Bookshelf\Mapper;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class BookTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'id',
            'author_id',
            'title',
            'isbn',
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
            'author_id' => (object) [
                'name' => 'author_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'title' => (object) [
                'name' => 'title',
                'type' => 'varchar',
                'size' => 100,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'isbn' => (object) [
                'name' => 'isbn',
                'type' => 'varchar',
                'size' => 13,
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
            'author_id' => null,
            'title' => null,
            'isbn' => null,
        ];
    }
}
