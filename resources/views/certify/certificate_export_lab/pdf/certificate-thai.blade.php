<style>
    @page {
        margin:2%;padding:0;
    }
    @page {
    header: page-header;
    footer: page-footer;
}
    body {
        font-family: 'THSarabunNew', sans-serif;
    }
    .content{
        /* border: 5px solid #d4af37; */
        /* padding: 5%; */
        padding-top: 5%;
        padding-left: 5%;
        padding-right: 5%;
        margin: 0px;
        height: 100%;
        top: 10%;
        position: relative;
 
    }
    .tc{
        text-align: center;
    }
    div{
        width: 100%;
    }
    h1,h2,h3,h4,h5,h6,p{
        padding: 0px;
        margin: 0px;
        line-height: 2em;
    }
    .space{
        height:20px;
    }
    .space-mini{
        height: 10px;
    }
    b{
        font-weight: bold;
    }
    h1{
        margin-bottom: 10px;
    }
    .w-100{
        width: 100%;
    }
    .tab {
        display:inline-block;
        margin-left: 40px;
    }
    .tr{
        text-align: right;
    }
    .w-66{
        width: 66%;
    }
    .w-33{
        width: 33%;
    }
    .w-15{
        width: 15%;
    }
    .w-50{
        width: 50%;
    }
    table{
        line-height: 2em;
        font-size: 1.2em;
    }
    .font-6{
        font-size: 6pt;
    }
    .font-7px{
        font-size: 7px;
    }
    .font-7{
        font-size: 7pt;
    }
    .font-8{
        font-size: 8pt;
    }
    .font-8px{
        font-size: 8px;
    }
    .font-10{
        font-size: 10pt;
    }
    .font-11{
        font-size: 11pt;
    }
    .font-12{
        font-size: 12pt;
    }
    .font-13{
        font-size: 11pt;
    }
    .font-16{
        font-size: 16pt;
    }
    
    .font-8px{
        font-size: 8px;
    }
        .free-dot {
            border-bottom: thin dotted #000000; 
            padding-bottom: 0px !important;
 
        }
      .custom-label{
         background: #ffffff;
        border-bottom: thin dotted #ffffff; 
        padding-bottom: 5px;
      }
      

</style>


<body>

<div class="content">    
    <table width="100%"    style="padding-top: 10px;"    > 
        <tr>
        <td width="33%"  class="font-8"  style="padding-top: 60px;line-height:15px;" > 
           <p>ใบรับรองเลขที่ &nbsp;&nbsp;<span   class="free-dot" > {{ $certificate }}</span> </p> 
           <p  class="font-7">(Certificate No.) </p> 
        </td>
        <td width="33%"  align="center">
            {{-- <img src="{{ asset('storage/uploads/certify/certificate-header (1).jpg') }}" width="100px"/> --}}
        </td>
        <td width="33%" class="font-7"  align="right"  style="padding-top: -100px;line-height:15px;">
            <p>แบบ กมช./สมอ.๒ </p> 
            <p>Form NSC/TISI 2 </p>
        </td>
       </tr>
    </table>
    
    <div class="space"></div>

    <table width="100%"   >
        <tr>
            <td align="center" class="font-16"  > 
                 <b>ใบรับรองระบบงาน</b>    
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p class="font-7">(Certificate of Accreditation)</p> 
           </td>
        </tr>

        <tr>
            <td align="center"  class="font-12" style="padding-top: -10px;">
                 <b>อาศัยอำนาจตามความในพระราชบัญญัติการมาตรฐานแห่งชาติ พ.ศ. {{ HP::toThaiNumber('2551')}} </b> 
            </td>
        </tr>
        <tr>
            <td align="center"   style="padding-top: -20px;" >
                <p class="font-7">(By Virtue of National Standardization Act B.E. 2551 (2008))</p> 
           </td>
        </tr>

        <tr>
            <td align="center"   class="font-12"  style="padding-top: -10px;">
                <b>เลขาธิการสำนักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรม</b> 
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p class="font-7">(Secretary-General, Thai Industrial Standards Institute)</p> 
           </td>
        </tr>

        <tr>
            <td align="center"  class="font-12"  style="padding-top: -10px;">
                  <b>ออกใบรับรองฉบับนี้ให้</b> 
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p class="font-7">(Issues this certificate to)</p> 
           </td>
        </tr>
  </table>

  <table width="100%"   >
        <tr>
            <td align="center"  style="padding-top: -5px;line-height:25px;"  class="font-11"  >
                 {!! $name !!}  
            </td>
        </tr>

        
         @if ($name_en == '(Thailand Institute of Scientific and Technological Research, Industrial Metrology and Testing Service Centre, Photometry and Temperature Standards Laboratory)')
                    <tr>
                        <td align="center"  style="padding-top:-2px;padding-bottom:15px;line-height:15px;" >
                            <p class="font-7" >
                                (Thailand Institute of Scientific and Technological Research,
                             <br>
                                Industrial Metrology and Testing Service Centre, Photometry and Temperature Standards Laboratory)
                            </p>  
                        </td>
                    </tr>
        @elseif ($name_en == '(Thailand Institute of Scientific and Technological Research (TISTR), Industrial Metrology and Testing Service Centre, Electrical and Electronic Standards Laboratory)')
                    <tr>
                        <td align="center"  style="padding-top:-2px;padding-bottom:15px;line-height:15px;" >
                            <p class="font-7" >
                                (Thailand Institute of Scientific and Technological Research (TISTR),
                             <br>
                                 Industrial Metrology and Testing Service Centre, Electrical and Electronic Standards Laboratory)
                            </p>  
                        </td>
                    </tr>
        @else
                    <tr>
                        <td align="center"  style="padding-top: -15px;" >
                            <p class="font-7"> {!! $name_en !!} </p> 
                        </td>
                    </tr>
        @endif
</table>
 

<table width="100%"   >

        <tr>
            <td align="center" class="font-12" style="padding-top: -10px;">
                  <b>ตั้งอยู่เลขที่</b>
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p class="font-7">(Address)</p> 
           </td>
        </tr>

    @if (mb_strlen($address) <= 100)
        <tr >
            <td align="center"   style="padding-top: -10px;font-size:{{$lab_name_font_size_address}}pt" >
                <p>{!! HP::toThaiNumber($address) !!} </p>
            </td>
        </tr> 
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p  class="font-7">{!! '('.$address_en.')' !!} </p>
        </td>
        </tr>

    @elseif(mb_strlen($address) > 140)
    @php
         $address = HP::toThaiNumber($address);
        $array_address =  explode(" ",$address);
        $address1 =  $array_address[0].' '.$array_address[1].' '.$array_address[2].' '.$array_address[3].' '.$array_address[4].' '.$array_address[5].' '.$array_address[6];
  @endphp
        <tr>
            <td align="center"  style="padding-top: -10px;font-size:{{$lab_name_font_size}}pt"  >
                {!! $address1 !!}  
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -10px;font-size:{{$lab_name_font_size}}pt"  >
                {!!  str_replace($address1,"",$address)   !!}  
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p  class="font-7">{!! '('.$address_en.')' !!} </p>
            </td>
        </tr>
    @else 
    @php
        $address = HP::toThaiNumber($address);
        $array_address =  explode(" ",$address);
        $address1 =  $array_address[0].' '.$array_address[1].' '.$array_address[2].' '.$array_address[3].' '.$array_address[4].' '.$array_address[5].' '.$array_address[6];
    @endphp
        <tr>
            <td align="center"  style="padding-top: -10px;font-size:{{$lab_name_font_size}}pt"  >
                {!! $address1 !!}  
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -10px;font-size:{{$lab_name_font_size}}pt"  >
                {!!  str_replace($address1,"",$address)   !!}  
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p  class="font-7">{!! '('.$address_en.')' !!} </p>
            </td>
        </tr>
    @endif
</table>
<table width="100%"   >
        <tr>
            <td align="center" class="font-12" style="padding-top: -10px;"  >
                 <b>ได้รับการรับรองความสามารถ</b>
            </td>
        </tr>
        <tr>
            <td align="center"  style="padding-top: -20px;" >
                <p class="font-7">(Certificate of competence)</p> 
           </td>
        </tr>
        <tr>
            <td   align="center" class="font-11"  style="padding-top: -10px;"   >
                  ตามมาตรฐานเลขที่&nbsp;&nbsp;&nbsp;{!! HP::toThaiNumber($formula)    !!} 
            </td>
        </tr>
        <tr>
            <td   align="center"  style="padding-top: -20px;" >
                <p class="font-7"> {!! !empty($formula_en) ?  '(Standard No. '.$formula_en.')' :  '' !!}</p>  
           </td>
        </tr>
</table>
 <table width="100%" >
        <tr>
            <td   align="center"    style="padding-top: -10px;font-size:{{$lab_name_font_size_condition}}pt" >
                <span class="custom-label" style="font-size:12pt;" ></span>&nbsp;&nbsp;&nbsp;{!! $condition_th !!} 
            </td>
        </tr>
        <tr >
            <td   align="center" style="padding-top: -20px;" >
                <span  style="font-size:8pt"></span>&nbsp;&nbsp;&nbsp;<span class="{{$lab_name_font_size_condition == 6 ? 'font-7px' : 'font-7' }}  "> {!!  '('.$condition_en.')' !!}</span> 
            </td>
        </tr>
</table>
<table width="100%"   >
        <tr>
            <td  align="center"  colspan="3"   class="font-12"   style="padding-top: -10px;"      >
                 <b>หมายเลขการรับรองที่ </b>&nbsp;&nbsp;&nbsp;{{ $accereditatio_no }}     
           </td>
        </tr>
         <tr>
            <td  align="center"   colspan="3"      style="padding-top: -20px;" >
                <p class="font-7"> {!! !empty($accereditatio_no_en) ?  '(Accreditation No. '.$accereditatio_no_en.')' :  '' !!}</p>  
           </td>
        </tr>

        <tr>
            <td  align="center"   class="font-11"  style="padding-top: -10px;"  colspan="3">
                 โดยมีรายละเอียดสาขาและขอบข่ายที่ได้ใบรับรอง แสดงไว้ใน QR CODE และ www.tisi.go.th   
           </td>
        </tr>
         <tr>
            <td  align="center" style="padding-top: -20px;"  colspan="3" >
                <p class="font-7">(Details of the scheme and scope of the certificate are shown in QR CODE and www.tisi.go.th)</p>     
           </td>
        </tr>
</table>
 

    <table width="100%" style="padding-top: -13px;" >
        @php
            if(is_null($date_start) ||  empty($date_start) ){
                $date_start ='';
            }else{
                $date_start = HP::toThaiNumber( HP::formatDateThaiFullPoint($date_start) );
            }
        @endphp 
        <tr>
            <td  align="right"  width="30%"  class="font-11">    </td>
            <td   align="center"   width="70%"  class="font-11">  ออกให้ ณ วันที่   {!! $date_start !!}   </td>
        </tr>
        <tr>
            <td  align="right"    class="font-11">    </td>
            <td   align="center"  style="padding-top: -20px;"  class="font-7">  {!! !empty($date_start_en) ?  '(Issue date : '.$date_start_en.')' :  '' !!}   </td>
        </tr>

    </table>
</div>

<htmlpagefooter name="page-footer">
    <div style="padding-left: 5%;
                padding-right: 5%;">   
    <table >
        <tr>
            <td  colspan="3" style="padding-top: -5px;" >
                @if(!is_null($url))
                    <a href="{{ $url }}"  target="_blank">
                        <img src="data:image/png;base64, {!! base64_encode($image_qr) !!} " width="4cm" >
                    </a>
                @else
                      <br><br><br><br><br>
                @endif
            </td>
        </tr>
        <tr>
            <td style="width: 80%;padding-top:: -50px;" class="font-12" >
                <p>กระทรวงอุตสาหกรรม สำนักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรม</p>
            </td>
            <td class="tr" style="width:15%;padding-top: -60px; ">
                <img  type="image/png" src="{{public_path('images/certify/ilac.png') }}"/>
            </td>
            <td class="tr" style="width:15%;padding-top: -60x;">
                <img  type="image/png" src="{{public_path('images/certify/nc.png') }}"/>
            </td>
        </tr>
        <tr>
            <td  colspan="3" style="padding-top: -30px;" >
                <p class="font-7">(Ministry of Industry Thailand, Thai Industrial Standards Institute)</p>
            </td>
        </tr>
    </table>
</div>
</htmlpagefooter>


</body>
