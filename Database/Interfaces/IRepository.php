<?php

namespace Database\Interfaces;

interface IRepository
{
    public function getAll();

    public function getOne(int $id);
}