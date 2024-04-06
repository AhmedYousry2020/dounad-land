<?php

namespace App\Interfaces;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

interface BaseInterface
{

    /**
     * @param bool $whereHasRelation - only model with relation
     * @return self
     */
    public function viaRelationOnly($whereHasRelation = true);

    /**
     * Return all records
     *
     * @param string $orderBy
     * @param array $relations
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function all($orderBy = 'id', array $relations = [], array $parameters = []);

    /**
     * Return paginated items
     *
     * @param string $orderBy
     * @param array $relations
     * @param int $paginate
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function paginate($orderBy = 'name', array $relations = [], $paginate = 25, array $parameters = []);

    /**
     * Get many records by a field and value
     *
     * @param array $parameters
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    public function getBy(array $parameters, array $relations = []);

    /**
     * List all records
     *
     * @param string $fieldName
     * @param string $fieldId
     * @return mixed
     * @throws Exception
     */
    public function pluck($fieldName = 'name', $fieldId = 'id');

    /**
     * List all records matching a field's value
     *
     * @param string $field
     * @param mixed $value
     * @param string $listFieldName
     * @param string $listFieldId
     * @return mixed
     * @throws Exception
     */
    public function pluckBy($field, $value, $listFieldName = 'name', $listFieldId = 'id');

    /**
     * Find a single record
     *
     * @param int $id
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    public function find($id, array $relations = []);

    /**
     * Find a single record by a field and value
     *
     * @param string $field
     * @param mixed $value
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    public function findBy($field, $value, array $relations = []);
    /**
     * Find a single record by multiple fields
     *
     * @param array $data
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    public function findByMany(array $data, array $relations = []);

    /**
     * Find multiple models
     *
     * @param array $ids
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    public function getWhereIn(array $ids, array $relations = []);

    /**
     * Find multiple models
     *
     * @param array $id
     * @param array $relations
     * @return mixed
     * @throws Exception
     */
    public function getNotWhereIn(array $id, array $relations = []);

    /**
     * Create a new record
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function store(array $data);

    /**
     * Update the model instance
     *
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function update(array $data, int|Model $id);

    /**
     * Delete a record
     *
     * @param int|Model $modal
     * @return mixed
     * @throws Exception
     */
    public function destroy(int|Model $modal);

    /**
     * Count of all records
     *
     * @return int
     * @throws Exception
     */
    public function count(): int;

    /**
     * Return model name
     *
     * @return string
     * @throws RuntimeException If model has not been set.
     */
    public function getModelName(): string;

    /**
     * Return a new query builder instance.
     */
    public function getQueryBuilder(): Builder;

    /**
     * Returns new model instance.
     *
     * @return Model
     */
    public function getNewInstance();

    /**
     * Set the order by field
     *
     * @param string $orderBy
     * @return void
     */
    public function setOrderBy($orderBy);

    /**
     * Get the order by field
     *
     * @return string
     */
    public function getOrderBy();

    /**
     * Set the order direction
     *
     * @param string $orderDirection
     * @return void
     */
    public function setOrderDirection($orderDirection);

    /**
     * Get the order direction
     *
     * @return string
     */
    public function getOrderDirection();
}
