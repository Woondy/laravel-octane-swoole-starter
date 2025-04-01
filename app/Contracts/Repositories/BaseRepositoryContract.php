<?php

namespace App\Contracts\Repositories;

/**
 * Contract for the BaseRepository.
 */
interface BaseRepositoryContract
{
    /**
     * Get all records
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a record by ID
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(string $id);

    /**
     * Find a record by ID or throw an exception
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(string $id);

    /**
     * Create a new record
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update a record
     *
     * @param string $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(string $id, array $data);

    /**
     * Delete a record
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Get the model instance
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();
} 