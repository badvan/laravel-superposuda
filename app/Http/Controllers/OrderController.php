<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RetailCrm\Api\Enum\ByIdentifier;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Filter\Orders\OrderFilter;
use RetailCrm\Api\Model\Request\BySiteRequest;
use RetailCrm\Api\Model\Request\Orders\OrdersRequest;

class OrderController extends Controller
{
    protected $retailCrmDomain;
    protected $retailCrmApiKey;
    protected $productId;
    protected $productName;
    protected $lastName;
    protected $firstName;
    protected $patronymic;
    protected $article;
    protected $manufacturer;
    protected $comment;

    public function __construct()
    {
        $this->retailCrmDomain = env('RETAIL_CRM_DOMAIN');
        $this->retailCrmApiKey = env('RETAIL_CRM_API_KEY');
    }

    public function index()
    {
        return view('order.create');
    }

    public function create(Request $request)
    {
        try {
            $fio = $request->input('fio');
            $this->article = $request->input('article');
            $brand = $request->input('brand');
            $this->comment = $request->input('comment');
            list ($this->lastName, $this->firstName, $this->patronymic) = array_pad(mb_split('\s', $fio), 3, null);

            $response = Http::get("{$this->retailCrmDomain}/api/v5/store/products?apiKey={$this->retailCrmApiKey}&filter[name]={$this->article}&filter[manufacturer]={$brand}");

            $this->productId = $response['products'][0]['offers'][0]['id'];
            $this->productName = $response['products'][0]['offers'][0]['name'];
            $this->manufacturer = $response['products'][0]['manufacturer'];

        } catch (\Exception $e) {
            throw new \DomainException('Ошибка, продукт не найден!');
        }

        $response = Http::post("{$this->retailCrmDomain}/api/v5/orders/create?apiKey={$this->retailCrmApiKey}", ['order' => $this->jsonEncode()]);

        dd($response);
    }

    public function jsonEncode()
    {
        return json_encode([
            'status' => 'trouble',
            'orderType' => 'fizik',
            'site' => 'test',
            'orderMethod' => 'test',
            'number' => '21011978',
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'patronymic' => $this->patronymic,
            'customerComment' => $this->comment,
            'company' => [
                'brand' => $this->manufacturer
            ],
            'items' => [
                [
                    'offer' => [
                        'id' => $this->productId,
                        'article' => $this->article,
                        'name' => $this->productName
                    ]
                ]
            ]
        ]);
    }
}
