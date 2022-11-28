<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Models\chitietorder;
use App\Models\order;
use App\Models\thanhtoan;
use App\Models\ban;

use PDF;
use Illuminate\Support\Facades\Storage;

use Session;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('paypal.test');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction($maorder)
    {
        $usd = \Session::get('vnd_to_usd');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction', ['maorder' => $maorder]),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $usd
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('banhangall')
                ->with('error', 'Lỗi thanh toán.');

        } else {
            return redirect()
                ->route('banhangall')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request,$maorder)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $chitietorder = chitietorder::where('maorder', $maorder)->get();
            $order = order::where('maorder', $maorder)->get();
            $data = [
                'danhsachorder' => $order,
                'danhsachchitietorder'    => $chitietorder,
            ];
            foreach ($order as $o) {
            }
            $thanhtienve = $o->soluong * $o->gia;
            $thanhtienmon = chitietorder::where('maorder', $maorder)->sum('thanhtien');
            // return view('banhang.thanhtoan')
            //         ->with('danhsachorder', $order)
            //         ->with('danhsachchitietorder', $chitietorder)
            //         ->with('thanhtienve', $thanhtienve)
            //         ->with('thanhtienmon', $thanhtienmon);
            $thanhtoan = new thanhtoan();
            $thanhtoan->nhanvien = Session::get('thungan');
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $thanhtoan->giothanhtoan = date('Y/m/d h:i:s');
            $thanhtoan->maorder = $maorder;
            ban::where('maban', $o->maban)->update([
                'trangthai' => 0,
            ]);
            order::where('maorder', $maorder)->update([
                'trangthai' => 1,
            ]);
            $thanhtoan->thanhtien = ($thanhtienve + $thanhtienmon);
            $thanhtoan->save();
            $pdf = PDF::loadView('banhang.thanhtoan', $data);
            $banso = ban::where('maban', $o->maban)->get();
            foreach ($banso as $b) {
            }
            Storage::put('public/storage/hoadon/' . $b->banso . '_' . date('Y') . date('m') . date('d') . '_' . rand() . '.' . 'pdf', $pdf->output());
            return redirect()
                ->route('banhangall')
                ->with('success', 'Thanh toán bằng Paypal thành công.');
        } else {
            return redirect()
                ->route('banhangall')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('banhangall')
            ->with('error', $response['message'] ?? 'Bạn đã đóng giao dịch Paypal.');
    }
}
