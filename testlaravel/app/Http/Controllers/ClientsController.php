<?php

namespace App\Http\Controllers;

use App\Custom\Fetch;
use App\Custom\Paginate;
use App\Models\RegisterPetition;
use Illuminate\Http\Request;

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

        //el segundo parametro de la paginacion es para indicar cuantos registros contrendra cada pagina
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
            //nos aseguramos que se nos envie el id
            $validatedData = $request->validate([
                'id' => 'required|numeric'
            ]);
            $cliente = [];
            $idClient = $validatedData["id"];
            $infoUser = $this->http->get(env("URL_SERVER_API") . SELF::URL_USERS . env("TOKEN_API_CONECTADOS"));
            $transactionUser = $this->http->get(env("URL_SERVER_API") . SELF::URL_USERS . env("TOKEN_API_CONECTADOS") . SELF::URL_TRANSACTION . $idClient);
            if ($infoUser === null || $transactionUser === null) {
                return response()->json([
                    'message' => 'Token Incorrecto'
               ],401);            
            }
            
            foreach ($infoUser as $elem) {
                if ($elem["id"] == $idClient) {
                    $cliente['infoUser'] = $elem;
                    break;
                }
            }

            //registramos a manera de log la informacion consultada
            $cliente['transactionUser'] = $transactionUser;
            $registerLog = new RegisterPetition;
            $registerLog->segmentation_id = $cliente["infoUser"]["segmentation_id"];
            $registerLog->program_id = $cliente["infoUser"]["program_id"];
            $registerLog->user_id = $cliente["infoUser"]["user_id"];
            $registerLog->netcommerce_id = $cliente["infoUser"]["netcommerce_id"];
            $registerLog->one_signal_player_id = $cliente["infoUser"]["one_signal_player_id"];
            $registerLog->identification_type_id = $cliente["infoUser"]["identification_type_id"];
            $registerLog->identification_number = $cliente["infoUser"]["identification_number"];
            $registerLog->mobile_number = $cliente["infoUser"]["mobile_number"];
            $registerLog->meta = $cliente["infoUser"]["meta"];
            $registerLog->insitu_code_reference = $cliente["infoUser"]["insitu_code_reference"];
            $registerLog->birth_date = $cliente["infoUser"]["birth_date"];
            $registerLog->active = $cliente["infoUser"]["active"];
            $registerLog->has_updated_info = $cliente["infoUser"]["has_updated_info"];
            $registerLog->inactivate_reason = $cliente["infoUser"]["inactivate_reason"];
            $registerLog->account_lockout_date = $cliente["infoUser"]["account_lockout_date"];
            $registerLog->state_user_id = $cliente["infoUser"]["state_user_id"];
            $registerLog->save();
            
            return response()->json([
                'cliente' => $cliente
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
