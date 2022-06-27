<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cinebaz\Media\Models\Media;
use Cinebaz\Seo\Models\Seo;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Cache;
use Cart;
use Session;
use App\Http\Traits\LNagad;
use Cinebaz\Media\Models\MediaLicence;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    use LNagad;
    public function index($id)
    {
        // Cart::clear();
        $message = '';
        $success = false;
        $needLogin = false;
        $member = auth('member')->user();
        $media = Media::find($id);
        $checkCart      = [];

        $cartCollection = Cart::getContent();
        foreach ($cartCollection as $cart) {
            $checkCart[]  = $cart->associatedModel->id;
        }

        $uniqid     = Str::random(9);
        $rowId      = $uniqid;
        // dd($media);
        $date = new \DateTime('now', new \DateTimezone('Asia/Dhaka'));
        if ($media) {
            if ($member) {
                if (!in_array($id, $checkCart)) {

                    if ($media->premium) {
                        if ($media->published_at && $media->published_at < $date->format('Y-m-d H:m:s')) {

                            $purchased = OrderDetails::where([
                                'media_id' => $id,
                                'member_id' => $member->id
                            ])->where('deadline', '>', $date->format('Y-m-d H:i:s'))
                                ->whereHas('orders', function ($query) {
                                    $query->where('status', 'Complete');
                                })->latest()->first();

                            if (!$purchased) {


                                if (!$media->discount_price) {
                                    if ($media->regular_price) {
                                        $media->discount_price = $media->regular_price;
                                    } else {
                                        $media->discount_price = 0;
                                    }
                                }
                                $getToday = date('Y-m-d H:i:s');
                                $deadline = MovieDeadline();
                                $new_time = date("Y-m-d H:i:s", strtotime($deadline));

                                $addCart = Cart::add(array(
                                    'id'        => $rowId,
                                    'name'      => $media->title_en,
                                    'price'     => $media->discount_price,
                                    'quantity'  => 1,
                                    'attributes' => [
                                        'hour'  => $new_time
                                    ],
                                    'associatedModel' => $media
                                ));
                                $success = true;
                                $message = 'Movie added on Bucket !';
                            } else {
                                $message = 'You already purchased this media please see your purchased list.';
                            }

                            $success = ($purchased) ? false : true;
                        } else {
                            $message = 'This media not published yet.';
                        }
                    } else {
                        $message = 'It is a Free media no need to buy.';
                    }
                } else {
                    $message = 'Movie Already on Bucket !';
                }
            } else {
                $needLogin = true;
                $message = 'Please login first.';
            }
        } else {

            $message = 'Media Not found.';
        }

        if ($success) {
            notify()->success($message);
        } else {
            notify()->error($message);
        }
        $cartCollection     = Cart::getContent();
        $total_added_count     = $cartCollection->count();
        $total_price         = Cart::getTotal();

        $cart = [
            'success' => $success,
            'message' => $message,
            'needLogin' => $needLogin,
            'cartCollection'  => $cartCollection,
            'total_added_count' => $total_added_count,
            'total_price'   => $total_price

        ];
        // return View('cart.cart_items')->with($cart);
        return response()->json([
            'content' => view('cart.cart_items')->with($cart)->render(),
            'success' => $success,
            'message' => $message,
            'needLogin' => $needLogin,
        ]);
    }


    public function checkout_process(PaymentRequest $request)
    {
         
        $cartCollection = Cart::getContent();
        $cartTotal      = Cart::getTotal();
        $cart           = json_decode($request->get('cart_json'), true);
        $member         = auth('member')->user();
        $code           = uniqid();

        $create = new Order();
        $create->code              = $code;
        $create->name              = $member->name;
        $create->payment_method    = $request->payment_type;
        $create->email             = $member->email;
        $create->phone             = $member->phone;
        $create->amount            = $cartTotal;
        $create->status            = 'Unpaid';
        $create->member_id         = $member->id;
        $create->sub_status        = 'Unpaid';
        $create->address           = $member->address;
        $create->transaction_id    = $code;
        $create->currency          = "BDT";
        $create->save();

        foreach ($cartCollection as $myCart) {
            $createChild = new OrderDetails();
            $createChild->order_id         = $create->id;
            $createChild->media_id         = $myCart->associatedModel->id;
            $createChild->regular_price    = $myCart->associatedModel->regular_price;
            $createChild->discounted_price = $myCart->associatedModel->discount_price;
            $createChild->price            = $myCart->associatedModel->discount_price;
            $createChild->member_id        = $member->id;
            $createChild->deadline         = $myCart->attributes->hour;
            $createChild->duration         = $myCart->associatedModel->duration;
            $createChild->status           = 'Unpaid';
            $createChild->transaction_id   = $code;
            $createChild->save();
            
            $validity = 3;
            if($myCart->associatedModel->validity  && $myCart->associatedModel->validity > 3){
                $validity = $myCart->associatedModel->validity;
            } 
            $this->storeLicence($myCart->associatedModel , $validity , $create->id);
            if($myCart->associatedModel->video_nature_id == 2){  //Web_seires
                foreach($myCart->associatedModel->episodes as $key => $media){
                       $this->storeLicence($media , $validity , $create->id);
                }        
                     
            }elseif($myCart->associatedModel->video_nature_id == 4) {//combo
                foreach($myCart->associatedModel->combo as $key => $media){
                       $this->storeLicence($media , $validity , $create->id);
                }  
            }

        }


        // dd($request->payment_type);
        if ($request->payment_type == 1) {
            return redirect()->route('frontend.checkout.sslcommerz.index', $create->id);
        } elseif ($request->payment_type == 2) {
            $this->nagadInitialize([
                'amount' => $create->amount,
                'transaction_id' => $create->transaction_id
            ]);

            // dd('Nagad');
            // return redirect()->route('checkout.nagad.index', $create->id);
        }
    }
    public function checkout()
    {
        $mdata['seo'] = Seo::get();
        Session::put('redirectUrl', url()->current());
        // return $cartCollection = Cart::getContent();
        return View('cart.checkout')->with($mdata);
    }
    public function delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function nagad_callback(Request $request)
    {

        $payment_ref_id = $request->payment_ref_id;
        $verify = $this->NagadPyamentVerify($payment_ref_id);

        $tran_id = $verify['orderId'];

        $check  = Order::where('transaction_id', $tran_id)->first();

        if (isset($verify['status']) && $verify['status'] == 'Success' && $check) {

            $this->update($tran_id, 'Complete', $payment_ref_id);

            $removeCart = Cart::clear();
            $member = auth('member')->user();
            if (Cache::has('my-bucketList-' . $member->id)) {
                Cache::forget('my-bucketList-' . $member->id);
            }

            return redirect()->route('member.auth.profile', [app()->getLocale()]);
        } else {
            return redirect()->route('frontend.cart:checkout', [app()->getLocale()]);
        }
    } 

    private function update($tran_id, $status, $payment_ref_id)
    {
        
        $order_update = Order::where('transaction_id', $tran_id)
            ->update(['status' => $status, 'code' => $payment_ref_id]);

        $details_update = OrderDetails::where('transaction_id', $tran_id)
            ->update([
                'status' => $status,
                'deadline' => ($status == 'Complete') ? date("Y-m-d H:i:s", strtotime('+ 24 hours')) : null
            ]);

            if($status == 'Complete'){
                $order = Order::select('id')->where('transaction_id', $tran_id)->firstOrFail();
                MediaLicence::where('order_id' , $order->id)->update([
                  'status' => 1
                ]);
            }
    }

    private function storeLicence($media , $validity , $order_id){
        $licence = new MediaLicence();
        $licence->order_id          = $order_id;
        $licence->media_id          = $media->id;
        $licence->member_id         = auth('member')->user()->id;
        $licence->purchases_date    = date("Y-m-d H:i:s");
        $licence->deadline          = date("Y-m-d H:i:s", strtotime('+ '.$validity.' days'));
        $licence->video_type        = $media->video_nature_id;
        $licence->save();
    }
}
