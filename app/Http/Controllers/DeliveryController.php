<?php

namespace App\Http\Controllers;

use App\Exports\DeliveryDataExport;
use App\Repository\IDeliveryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryController extends Controller
{
    private $deliveryRepository;

    public function __construct(IDeliveryRepository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    public function deliveryDetail()
    {
        $category_deliveries = $this->getAllDeliveryCategory();
        $delivery_category = $this->getAllDeliveryCategory();
        return view('components.delivery-detail', compact('category_deliveries', 'delivery_category'));
    }

    public function deliverySearch()
    {
        $delivery_category = $this->getAllDeliveryCategory();
        return view('components.delivery-search', compact('delivery_category'));
    }

    public function validationInsertDelivery(Request $request)
    {
        return $this->deliveryRepository->validateInsertDelivery($request);
    }

    public function insertDelivery(Request $request)
    {
        return $this->deliveryRepository->insertDelivery($request);
    }

    public function getAllDeliveryCategory()
    {
        return $this->deliveryRepository->getAllDeliveryCategory();
    }

    public function getDataDeliveryById($id)
    {
        return $this->deliveryRepository->getDataDeliveryById($id);
    }

    public function deleteDeliveryById($id)
    {
        return $this->deliveryRepository->deleteDeliveryById($id);
    }

    public function updateDelivery(Request $request, $id)
    {
        return $this->deliveryRepository->updateDelivery($request, $id);
    }

    public function searchDelivery(Request $request)
    {
        return $this->deliveryRepository->searchDelivery($request);
    }

    public function exportDeliveryExcel(Request $request)
    {
        return $this->deliveryRepository->exportDeliveryExcel($request);
    }

    public function searchInDeliveryDetail(Request $request)
    {
        return $this->deliveryRepository->searchInDeliveryDetail($request);
    }
}
