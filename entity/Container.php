<?php

namespace entity;


class Container
{
    protected $parameters;


    public function __construct(array $parameters)

    {
        $this->parameters = $parameters;
    }


}