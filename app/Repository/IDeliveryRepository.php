<?php

namespace App\Repository;

use App\Http\Requests\DeliveryCreateRequest;

interface IDeliveryRepository
{
    public function validateInsertDelivery($request);

    public function insertDelivery($request);

    public function updateDelivery($request, $id);

    public function getAllDeliveryCategory();

    public function getDataDeliveryById($id);

    public function deleteDeliveryById($id);

    public function searchDelivery($request);

    public function exportDeliveryExcel($request);

    public function searchInDeliveryDetail($request);

}
