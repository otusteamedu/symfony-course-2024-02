<?php

namespace App\Application;

interface QueryBusInterface
{
    /**
     * @template T
     *
     * @param QueryInterface<T> $query
     *
     * @return T
     */
    public function query(QueryInterface $query);
}
