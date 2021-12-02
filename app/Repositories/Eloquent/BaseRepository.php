<?php


namespace App\Repositories\Eloquent;


use App\Exceptions\ModelNotDefined;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Criteria\CriteriaContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseContract,CriteriaContract
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModelClass();
    }


    protected function getModelClass()
    {
        if(!method_exists($this,'model')){
            throw new ModelNotDefined("No Model defined");
        }
        return app()->make($this->model());
    }

    public function getTable(){
        return $this->model->getTable();
    }

    public function getColumn(array $columns){
        DB::table($this->getTable())->select($columns)->get();
    }

    public function all()
    {
        return $this->model->get();
    }

    public function find($id)
    {
        return $this->model->findorfail($id);
    }

    public function first(){
        return $this->model->first();
    }

    public function findWhere($column, $value)
    {
        return $this->model->where($column,$value)->get();
    }

    public function getWhere(...$data){
        if(count($data) > 2){
            return $this->model->where($data[0],$data[1],$data[2])->get();
        } else {
            return $this->model->where($data[0],$data[1])->get();
        }
    }

    public function findWhereFirst($column, $value)
    {
        return $this->model->where($column,$value)->first();
    }

    public function chainWhere($column,$value){
        return $this->model->where($column,$value);
    }

    public function chainOrWhere($column,$value){
        return $this->model->orWhere($column,$value);
    }

    public function executeQuery(){
        return $this->model->get();
    }

    public function executeAndFirst(){
        return $this->model->first();
    }

    public function select(array $array){
       return $this->model->select($array)->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function orderBy($column,$dir='asc'){
        return $this->model->orderBy($column,$dir);
    }

    public function delete($id)
    {
        $record = $this->find($id);
        return $record->delete();
    }

    public function withCriteria(...$criteria)
    {

        $criteria = Arr::flatten($criteria);
        foreach($criteria as $criterion)
        {
            $this->model = $criterion->apply($this->model);
        }

        return $this;
    }

    public function withRelations(array $relations)
    {
        foreach($relations as $relation){
            $this->model->with($relation);
        }
    }

    public function limit(int $limit)
    {
        return $this->model->limit($limit);
    }

    public function findWhereFirstOrFail($column, $value)
    {
        $data =  $this->model->where($column,$value)->first();
        if(!$data){
            abort(404);
        }
        return $data;
    }

    public function saveFile($file, $fileName, $disk, $path='')
    {
        $file->storeAs($path,$fileName,['disk'=>$disk]);
    }

    public function wheres(array $checks)
    {
        return $this->model->where($checks)->get();
    }

    public function wheresFirst(array $checks)
    {
        return $this->model->where($checks)->first();
    }

    public function ofYear($column, $date)
    {
        return $this->model->whereYear($column,$date);
    }

    public function ofMonth($column, $date)
    {
        return $this->model->whereMonth($column,$date);
    }

    public function ofDay($column,$date){
        return $this->model->whereDay($column,$date);
    }

    public function ofDate(...$data){
        if(count($data) > 2){
            return $this->model->whereDate($data[0],$data[1],$data[2])->get();
        } else {
            return $this->model->whereDate($data[0],$data[1])->get();
        }

    }

    public function count()
    {
        return $this->model->count();
    }
}
