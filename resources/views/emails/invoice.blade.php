@php
    $regular_price = 0;
    $purchased_price = 0;
@endphp
<div style="width:100%; background:#dadada; padding-top: 80px; padding-bottom: 80px;">
  <table cellpadding="0" cellspacing="0" itemprop="action" itemscope="" style="width:700px; background:#ffffff; color:#000; max-width:90%; margin:auto;font-family :Roboto,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 5px; border: 1px solid rgb(109, 107, 107);">
    <thead>
      <tr>
        <td colspan="2" style="background:#000; padding:0px; border-top-left-radius: 4px; border-top-right-radius: 4px; ">
          <img src="https://mgr2.cinebaz.com/assets/frontend/images/logo.png" alt="Cinebaz" style="margin: auto; height: 60px; width: auto;
                  display: flex; padding: 5px;">
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right; border: none; padding: 10px; ">
          @php
          $date = new DateTime('now',new DateTimezone('Asia/Dhaka'));
          @endphp
          <br>
          <span>Date: {{$date->format('j-F-Y, g:i a')}}</span>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:left; border: none; padding: 10px;">
          <br>
          <!-- <td class="text-left"> -->
              To<br>
              Mr/Mrs. <b>{{ $order->name}}</b><br>
              Address: {{ $order->address}}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center; border-bottom: 1px solid black; font-size:14px; padding: 10px;">
          <h2>Invoice</h2>
        </td>
      </tr>
      
    </thead>
    <tbody style="font-size:14px;">
      <tr>
        <td style="width: 40% ; text-align:center; border-bottom: 1px solid black; font-size:14px; padding: 10px;"><b>Order Info</b></td>
        <td style="width: 60% ;text-align:center; border-bottom: 1px solid black; font-size:14px; padding: 10px;"><b>Media Details</b></td>

      </tr>
      <tr>
        <td style="width: 40%; border-right: 1px solid black; border-bottom: 1px solid black; font-size:14px; padding: 10px;">
          <b>Invoice ID :</b> {{$order->code}}<br>
          <b>Order date :</b> {{$order->created_at->format('d/m/Y')}}<br>
          <b>Order Status :</b> {{$order->status}}<br />
          <b>Currency :</b> {{$order->currency}}<br />
          <b>Transaction ID :</b> {{$order->transaction_id}}<br />
          <b>Payment Method :</b>
        </td>
        <td width="60%" style="padding: 0px; border-bottom: 1px solid black;">
        <table style="font-size:14px;">
          <tbody >
          @forelse($order->Details as $details)
            <tr>
              <td style="border: none; padding: 10px;">@isset($details->medias->featuredL->small)
                    <img src="{{asset('storage/'.$details->medias->featuredL->small)}}" width="auto" height="50">
                @endisset
              </td>
              <td style="border: none; padding: 10px;">
                <b>Title:</b> {{$details->medias->title_en}}<br>
                <b>Price:</b>{{$order->currency}}. {{$details->discounted_price??''}}<br>
                <b>Expire On:</b> {{$details->deadline??''}}<br />
              </td>
            </tr>
            @php
            $regular_price += $details->regular_price;
            $purchased_price += $details->discounted_price;
            @endphp
      
            @empty
            <tr class="text-center">
              <td style="border: none; padding: 10px; "><b>Empty</b></td>
            </tr>
            @endforelse
          </tbody>
        </table>
                
        </td>

      </tr>
      

      @if(!$order->Details->isEmpty())
      {{-- <tr>
        <td style="text-align:right; border-right: 1px solid black; border-bottom: 1px solid black; padding: 5px;"><b>Total Regular Price</b></td>
        <td style=" border-bottom: 1px solid black; padding: 5px;" >{{$order->currency}}. {{$regular_price}} </td>
      </tr> --}}
      <tr style="border-bottom: 1px solid black;">
        <td style="text-align:right; border-right: 1px solid black; border-bottom: 1px solid black;  padding: 5px;"><b>Total</b></td>
        <td style="border-bottom: 1px solid black; padding: 5px;" ><b>{{$order->currency}}. {{$purchased_price}}</b></td>
      </tr>
      @endif
      </tr>
    </tbody>
    <tfoot>
      <td colspan="2" style="text-align:center; padding-top:50px; padding-bottom:10px; border:none;">
        Copyright &copy; {{ date('Y') }} Cinebaz Limited
      </td>
    </tfoot>

  </table>
</div>