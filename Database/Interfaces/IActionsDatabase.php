<?php

namespace Database\Interfaces;

interface IActionsDatabase
{
    public function get($id);
    public function getAll();
    public function insert( $class);
    public function update( $class);
    public function remove( $id);
    public function format($data);


}