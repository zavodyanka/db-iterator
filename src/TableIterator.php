<?php

class TableIterator implements \Iterator
{
    /** @var \PDOStatement */
    protected $pdoStatement;

    /** @var int */
    protected $key;

    /** @var  bool|\stdClass */
    protected $result;

    /** @var  bool  */
    protected $valid;

    public function __construct(\PDOStatement $PDOStatement)
    {
        $this->pdoStatement = $PDOStatement;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->result;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->key++;
        $this->result = $this->pdoStatement->fetch(
            \PDO::FETCH_OBJ,
            \PDO::FETCH_ORI_ABS,
            $this->key
        );

        if (false === $this->result) {
            $this->valid = false;

            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->valid;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->key = 0;
    }
}