<?php

namespace App\Http\Controllers;

use App\Custom\Fetch;
use App\Custom\Paginate;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class ClientsController extends Controller
{

    private $http;
    private $paginate;
    public function __construct()
    {
        // inyectando las dependencias
        $this->http = new Fetch();
        $this->paginate = new Paginate();
    }

    public function index()
    {
        $data = [];
        $data = $this->http->get(env("URL_SERVER_API") . SELF::URL_USERS . env("TOKEN_API_CONECTADOS"));
        if ($data === null) {
            return view('clients.index', ['errorToken' => 'Token Incorrecto']);
        }
        //ordenamos de manera descendiente tomando como parametro de ordenamiento a created_at
        $dates = array_map('strtotime', array_column($data, 'created_at'));
        array_multisort($dates, SORT_DESC, $data);
        $data = $this->paginate->paginate($data, 50);
        return view('clients.index', compact('data'));
    }

    public function transaction($idClient)
    {
        $dataTransaction = [];
        $url = env("URL_SERVER_API");
        $token = env("TOKEN_API_CONECTADOS");
        $dataTransaction = $this->http->get($url . SELF::URL_USERS . $token . SELF::URL_TRANSACTION . $idClient);
        if ($dataTransaction === null) {
            return redirect()->back()->with('error', 'Token Incorrecto');
        } else if ($dataTransaction === []) {
            return redirect()->back()->with('error', 'El usuario no tiene transacciones');
        }
        $dataTransaction = $this->paginate->paginate($dataTransaction, 5);
        $dataTransaction->withPath('');
       
        return view('transaction.index', compact('dataTransaction'));
    }

    public function getInfoUser(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|numeric'
            ]);
            $cliente = [];
            $idClient = $validatedData["id"];
            $token = env("TOKEN_API_CONECTADOS");
            $url = env("URL_SERVER_API");
            $concatUserToken = '/users/' . $token;
            $infoUser = $this->http->get(env("URL_SERVER_API") . SELF::URL_USERS . env("TOKEN_API_CONECTADOS"));
            $transactionUser = $this->http->get(env("URL_SERVER_API") . SELF::URL_USERS . env("TOKEN_API_CONECTADOS") . SELF::URL_TRANSACTION . $idClient);
            foreach ($infoUser as $elem) {
                if ($elem["id"] == $idClient) {
                    $cliente['infoUser'] = $elem;
                    break;
                }
            }
            $cliente['transactionUser'] = $transactionUser;
            return response()->json([
                'cliente' => $cliente
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
