<?php

namespace App\Repositories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Collection;

class AgencyRepository
{
    public function all(): Collection
    {
        return Agency::query()
            ->orderBy('id', 'desc')
            ->get();
    }

    public function create(array $data): Agency
    {
        return Agency::create($data);
    }

    public function find(int $id): ?Agency
    {
        return Agency::find($id);
    }

    public function update(Agency $agency, array $data): Agency
    {
        $agency->update($data);

        return $agency;
    }

    public function delete(Agency $agency): bool
    {
        return $agency->delete();
    }
}
