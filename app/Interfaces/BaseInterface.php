<?php
namespace App\Interfaces;

interface BaseInterface
{
  public function create(array $data);
  public function delete($id);
  public function find($id);
  public function findBy($field, $value);
  public function all();
}
