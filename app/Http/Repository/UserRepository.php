<?php

namespace App\Http\Repository;

use App\User;

class UserRepository
{
    private $_model;

    public function __construct(User $user)
    {
        $this->_model = $user;
    }

    public function getList($request, $select = '*')
    {
        $pageSize = $request['pageSize'] ?? 10;

        $query = $this->_model->select($select);
        $query = $this->filter($query, $request);

        return $query->latest()->paginate($pageSize);
    }

    public function getSingleData($id, $select = '*')
    {
        return $this->_model->select($select)->findOrFail($id);
    }

    public function create($request)
    {
        return $this->_model->create($request);
    }

    public function update($id, $request)
    {
        $query = $this->_model->findOrFail($id);
        return $query->update($request);
    }

    public function delete($id)
    {
        $query = $this->_model->findOrFail($id);
        return $query->delete();
    }

    private function filter($query, $filter)
    {
        return $query
            ->when(true === isset($filter['name']) && !empty($filter['name']), function ($query) use ($filter) {
                $query->where('name', $filter['name']);
            });
    }
}
