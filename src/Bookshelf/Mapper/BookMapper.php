<?php

namespace Bookshelf\Mapper;

use Atlas\Orm\Mapper\AbstractMapper;

/**
 * @inheritdoc
 */
class BookMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('author', AuthorMapper::class)->on(['author_id' => 'id']);
    }
}
