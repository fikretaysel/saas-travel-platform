<?php

namespace App\Services;

use App\Models\Agency;
use App\Repositories\AgencyRepository;
use Illuminate\Database\Eloquent\Collection;

class AgencyService
{
    public function __construct(
        private readonly AgencyRepository $agencyRepository
    ) {
    }

    public function getAllAgencies(): Collection
    {
        return $this->agencyRepository->all();
    }

    public function createAgency(array $data): Agency
    {
        return $this->agencyRepository->create($data);
    }

    public function getAgencyById(int $id): ?Agency
    {
        return $this->agencyRepository->find($id);
    }

    public function updateAgency(Agency $agency, array $data): Agency
    {
        return $this->agencyRepository->update($agency, $data);
    }

    public function deleteAgency(Agency $agency): bool
    {
        return $this->agencyRepository->delete($agency);
    }
}
