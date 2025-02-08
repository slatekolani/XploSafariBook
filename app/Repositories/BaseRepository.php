<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class BaseRepository.
 */
class BaseRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->query()->count();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }
    /*find by uuid*/
    public function findByUuid($uuid)
    {
        return $this->query()->where('uuid',$uuid)->first();
    }

    public function findByReferenceBase($reference)
    {
        return $this->query()->where('reference',$reference)->first();
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }

    public function all()
    {
        return call_user_func(static::MODEL.'::all');
    }


    /*Query only active resources*/
    public function queryActive($isactive = 1)
    {
        if($isactive == 2){
            return $this->query();
        }else{
            return $this->query()->where('isactive', $isactive);
        }

    }

    /*Get active for select*/
    public function getActiveForSelectBase($isactive = 1)
    {
        return $this->queryActive($isactive)->orderBy('name')->pluck('name', 'id');
    }

    /*Get all for select*/
    public function getForSelectBase()
    {
        return $this->query()->pluck('name', 'id');
    }



    /**
     * Return Only Importer ID
     * @param $uuid
     * @return mixed
     */
    public function getByUuid($uuid)
    {
        return $this->query()->where('uuid', $uuid)->first();
    }


    /*Find instance from where conditions*/
    public function findByWhere(array $where_inputs)
    {
        return $this->query()->where($where_inputs)->first();
    }


    /*General query to update using DB builder*/
    public function generalDbBuilderUpdateQuery($table_name, array $where_input, array $update_input){

        DB::table($table_name)->where($where_input)->update($update_input);
    }


    /**
     * @param $pivot_table_name
     * @param array $relation_where_input
     * @param array $attributes
     * Manual sync pivot for many to many
     */
    public function generalSyncPivot($pivot_table_name, array $relation_where_input, array $attributes = [])
    {
        $check_if_exists = DB::table($pivot_table_name)->where($relation_where_input)->count();

        if($check_if_exists > 0)
        {
            //exists
            if(count($attributes) > 0)
            {
                DB::table($pivot_table_name)->where($relation_where_input)->update($attributes);
            }
        }else{
            //do not exists - Attach
            $insert_input = array_merge($relation_where_input, $attributes);
            DB::table($pivot_table_name)->insert($insert_input);
        }
    }

    /*Create using mass assign by filtering keys which are in table*/
    public function createMassAssign($table, array $input)
    {

        $input_common = $this->getCommonInputForMassAssign($table, $input);

        $entry=   $this->query()->create($input_common);
        return $entry;
    }

//    Create mass assign using DB builder
    public function createMassAssignDbBuilder($table, array $input)
    {

        $input_common = $this->getCommonInputForMassAssign($table, $input);

        DB::table($table)->insert($input_common);
    }

    /*update mass assign by filtering keys exists ib the table*/
    public function updateMassAssign($table,$resource_id, array $input)
    {
        $resource = $this->find($resource_id);
        $input_common = $this->getCommonInputForMassAssign($table, $input);
        $resource->update($input_common);
    }

    /*update mass assign by filtering keys exists ib the table by where input*/
    public function updateMassAssignByWhere($table,array $where_input, array $input)
    {
        $input_common = $this->getCommonInputForMassAssign($table, $input);
        DB::table($table)->where($where_input)->update($input_common);
    }


    /*Get Input with all keys exists in the table columns*/
    public function getCommonInputForMassAssign($table, array $input)
    {
        $columns = DB::getSchemaBuilder()->getColumnListing($table);

        $input_keys = array_keys($input);

        $keys_common = (array_intersect($columns, $input_keys));

        /*STart get values*/
        $values = [];
        foreach($keys_common as $key)
        {
            array_push($values, $input[$key]);
        }
        $array_combine = array_combine($keys_common, $values);
        return $array_combine;
    }
    /**
     * Check if phone number is unique
     * @param $phone_formatted
     * @param $phone_column_name
     * @param $action_type
     * @param null $object_id => primary key of the model
     * @throws GeneralException
     */
    public function checkIfPhoneIsUnique($phone_formatted,$phone_column_name, $action_type,$object_id = null)
    {
        $return = 0;
        if ($action_type == 1){
            /*on insert*/
            $return = $this->query()->where($phone_column_name, $phone_formatted)->count();
        }else{
            /*on edit*/
            $return = $this->query()->where('id','<>', $object_id)->where($phone_column_name, $phone_formatted)->count();
        }
        /*Check outcome */
        if ($return == 0)
        {
            //is unique
        }else{
            /*Phone is taken: throw exception*/
            throw new GeneralException(__('exceptions.general.taken', ['key' => __('label.phone') ]));
        }
    }


    /**
     * @param array $input is array of all where conditions
     * @param $action_type
     * @param null $resource_id
     * @throws GeneralException
     * Check if already exists
     */
    public function checkIfExistsGeneral($action_type, array $input, $resource_id = null, $message = null )
    {
        if($action_type == 1){
            /*When adding*/
            $check = $this->query()->where($input)->count();
        }else{
            $check = $this->query()->where('id', '<>', $resource_id)->where($input)->count();
        }

        if($check > 0){
            throw new GeneralException(($message) ? $message : __('exceptions.general.already_exists'));
        }

    }

    /*Check if exists status no exception throwing*/
    public function checkIfExistsStatusGeneral($action_type, array $input, $resource_id = null)
    {
        if($action_type == 1){
            /*When adding*/
            $check = $this->query()->where($input)->count();
        }else{
            $check = $this->query()->where('id', '<>', $resource_id)->where($input)->count();
        }

        return ($check > 0) ? true : false;

    }

    /**
     * @param $action_type
     * @param $name_value - value inserted
     * @param $name_column - column db to be checked
     * @param null $other_where_input
     * @param null $resource_id for edit
     * @param null $message
     * @throws GeneralException
     * Check if entry exist based on name and other optional conditions
     */
    public function checkIfNameExistsGeneral($action_type,$name_value, $name_column, $other_where_input = null, $resource_id = null, $message = null){

        $name_where = 'LOWER('. $name_column . ') = '. '\'' .  strtolower($name_value) . '\'';
        if($action_type == 1){
            /*When adding*/

            if(isset($other_where_input)){

                $check = $this->query()->whereRaw($name_where)->where($other_where_input)->count();
            }else{


                $check = $this->query()->whereRaw($name_where)->count();

            }

        }else{
            if(isset($other_where_input)){
                $check = $this->query()->where('id', '<>', $resource_id)->whereRaw($name_where)->where($other_where_input)->count();
            }else{
                $check = $this->query()->where('id', '<>', $resource_id)->whereRaw($name_where)->count();
            }
        }

        if($check > 0){
            throw new GeneralException(($message) ? $message : __('exceptions.general.already_exists'));
        }
    }

    /**
     * @param array $input
     * @return mixed
     * Regex column search
     */
    public function regexColumnSearch(array $input)
    {
        $return = $this->query();
        if (count($input)) {
            $sql = $this->regexFormatColumn($input)['sql'];
            $keyword = $this->regexFormatColumn($input)['keyword'];
            $return = $this->query()->whereRaw($sql, $keyword);
        }
        return $return;
    }

    /**
     * @param array $input
     * @return array
     * Regex format according to drive used
     */
    public function regexFormatColumn(array $input)
    {
        $keyword = [];
        $sql = "";
        if (count($input)) {
            switch (DB::getDriverName()) {
                case 'pgsql':
                    foreach ($input as $key => $value) {
                        $sql .= " cast({$key} as text) ~* ? or";
                        $keyword[] = $value;
                    }
                    break;
                default:
                    foreach ($input as $key => $value) {
                        $value = strtolower($value);
                        $sql .= " LOWER({$key}) REGEXP  ? or";
                        $keyword[] = $value;
                    }
            }
            $sql = substr($sql, 0, -2);
            $sql = "( {$sql} )";
        }
        return ['sql' => $sql, 'keyword' => $keyword];
    }


    /**
     * @param $model
     * change the status isactive of the model
     */
    public function changeStatus($model)
    {
        $status = $model->isactive;
        switch ($status)
        {
            case 1:
                $model->isactive = 0;
                break;

            case 0:
                $model->isactive = 1;

                break;

            default :
                $model->isactive = 1;

        }

        $model->save();
    }

    /*Entries with similar name on add /edit to avoid duplicates*/
    public function getEntriesWithSimilarNameOnAddEditBase($table_name, $name_inserted,$column_name,  $opt_where_raw = null,$limit = 10, $offset = 0)
    {

        $search_whereRaw = 'LOWER('. $column_name .') ~* ' . '\''. strtolower($name_inserted) . '\'';
        $base_query = DB::table($table_name)->whereRaw($search_whereRaw);

        if($opt_where_raw){
            $base_query = $base_query->whereRaw($opt_where_raw);
        }
        $entries = $base_query->limit($limit)->offset($offset)->get();
        return ($entries);
    }


}
