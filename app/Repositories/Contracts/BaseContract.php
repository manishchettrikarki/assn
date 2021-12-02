<?php


namespace App\Repositories\Contracts;


interface BaseContract
{
    public function getTable();

    public function getColumn(array $column);
    public function all();
    public function count();
    public function find($id);
    public function first();
    public function findWhere($column,$value);
    public function getWhere(...$data);
    public function findWhereFirst($column,$value);
    public function findWhereFirstOrFail($column,$value);
    public function chainWhere($column,$value);
    public function chainOrWhere($column,$value);
    public function wheres(array $checks);
    public function wheresFirst(array $checks);
    public function executeQuery();
    public function executeAndFirst();
    public function limit(int $limit);
    public function select(array $array);
    public function paginate($perPage = 10);
    public function create(array $data);
    public function update($id,array $data);
    public function delete($id);
    public function orderBy($column,$dir);
    public function withRelations(array $relations);
    public function withCriteria(...$criteria);
    public function saveFile($file,$fileName,$disk,$path='');
    public function ofYear($column,$date);
    public function ofMonth($column,$date);
    public function ofDay($column,$date);
    public function ofDate(...$data);
}
