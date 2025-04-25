
<div style="position: relative;">
    <div style="display:inline-block;width:15%;float:left;text-align:center;padding: left 0;">
        <div style="position: absolute; top: 68mm; left: 75mm; width: 100mm;">
            <img src="{{public_path('images/certificate-header.jpg')}}" style="width: 70px" alt="">
        </div>
    </div>
    <div style="display:inline-block;width:60%; float:right; padding-top:40px; padding-right: 130px;">
        <div style="margin-left: 150px; font-weight:bold; font-size: 40px">
            บันทึกข้อความ
        </div>
    </div>
</div>

<table style="margin-top: px;margin-bottom: 5px">
    <tr style="display:block">
        <td style="line-height: 0.5;width: 10px; font-size: 28px; font-weight:500">ส่วนราชการ</td>
        <td style="border-bottom: 1px dotted #000; padding-bottom: 1;line-height: 0.6;width: 280px;padding-left:20px">
            {{$boardAuditorMsRecordInfo->header_text1}}
        </td>
        <td style="line-height: 0.5;width: 20px; font-size: 28px; font-weight:500">โทร</td>
        <td style="border-bottom: 1px dotted #000; padding-bottom: 1;line-height: 0.6;width: 200px;padding-left:40px">
            {{$boardAuditorMsRecordInfo->header_text4}}
        </td>
    </tr>
</table>

<table style="margin-top: 10px;margin-bottom: 5px">
    <tr style="display:block">
        <td style="line-height: 0.5;width: 10px; font-size: 28px; font-weight:500">ที่</td>
        <td style="border-bottom: 1px dotted #000; padding-bottom: 1;line-height: 0.6;width: 320px;padding-left:20px">
            {{$boardAuditorMsRecordInfo->header_text3}}
        </td>
        <td style="line-height: 0.5;width: 20px; font-size: 28px; font-weight:500">วันที่</td>
        <td style="border-bottom: 1px dotted #000; padding-bottom: 1;line-height: 0.6;width: 240px;padding-left:40px">
            {{$boardAuditorMsRecordInfo->header_text4}}
        </td>
    </tr>
</table>

<table style="margin-top: 10px;margin-bottom: 5px">
    <tr style="display:block">
        <td style="line-height: 0.5;width: 30px; font-size: 28px; font-weight:500">เรื่อง</td>
        <td style="border-bottom: 1px dotted #000; padding-bottom: 1;line-height: 0.6;width: 600px;padding-left:20px">
            การแต่งตั้งคณะผู้ตรวจประเมินห้องปฏิบัติการ ( คำขอเลขที่ {{$data->app_no}} )
        </td>
    </tr>
</table>

<div style="position: absolute; top: 65mm; left: 75mm; width: 100mm">
    <div style=";text-align:center">
        <img src="{{public_path($signer->signer_url1)}}" style="width: 70px" alt="">
        <div style="margin-top: -5px;font-size:16px">{{HP::formatDateThaiFullNumThai($signer->signer_2->updated_at)}}</div>
    </div>
    
</div>

<div style="position: relative;margin-top:20px;line-height:1.15">
    <div Style="margin-bottom:5px;">เรียน &nbsp;&nbsp;&nbsp; ผอ.สก. ผ่าน ผก.รป.{{$boardAuditorMsRecordInfo->body_text1}}</div>
    <div style="font-weight: bold;margin-left:90px;">๑. เรื่องเดิม</div>
    <div>
        @php
            $textResult = TextHelper::callLonganTokenizePost("วันที่!" . $data->register_date . "!ห้องปฏิบัติ".str_replace(' ', '!', $data->lab_name)." ได้ยื่นคำขอรับใบรับรองห้องปฏิบัติการ".$data->lab_type." สาขา".$data->scope_branch." ในระบบ E-Accreditation และสามารถรับคำขอได้เมื่อวันที่ ". $data->get_date);
            // แทนที่ '!' ด้วย span ที่ซ่อนด้วย color:#fff
            $textResult = str_replace('!', '<span style="color:#fff;">!</span>', $textResult);

        @endphp
   
        <div style="text-indent: 100px;display:block;font-size:22px;word-spacing: -0.2em">{!! $textResult !!}</div>
    </div>
    <div style="font-weight: bold;margin-left:90px ;margin-top:5px;">๒. ข้อกฎหมาย/กฎระเบียบที่เกี่ยวข้อง</div>
    <div>
        <div style="margin-left:105px; letter-spacing: 0.4px">๒.๑ พระราชบัญญัติการมาตรฐานแห่งชาติ พ.ศ. ๒๕๕๑ (ประกาศในราชกิจจานุเบกษา</div>
        <p style="margin: top 0; letter-spacing: 0.3px">วันที่ ๔ มีนาคม ๒๕๕๑) มาตรา ๒๘ วรรค ๒ ระบุ “การขอใบรับรอง การตรวจสอบและการออกใบรับรอง ให้เป็นไปตาม หลักเกณฑ์ วิธีการและเงื่อนไขที่คณะกรรมการประกาศ กําหนด”</p>
        <div style="margin-left:105px; letter-spacing: 0.3px">๒.๒ ประกาศคณะกรรมการการมาตรฐานแห่งชาติ เรื่อง หลักเกณฑ์ วิธีการ และเงื่อนไข</div>
        <p style="margin: top 0;">การรับรองห้องปฏิบัติการ (ประกาศในราชกิจจานุเบกษา วันที่ ๑๗ พฤษภาคม ๒๕๖๔)</p>
        <div style="margin-left:130px; letter-spacing: 0.8px">ข้อ ๖.๑.๒ (๑) แต่งตั้งคณะผู้ตรวจประเมิน ประกอบด้วย หัวหน้าคณะผู้ตรวจ</div>
        <p style="margin: top 0;">ประเมิน ผู้ตรวจประเมินด้านวิชาการ และผู้ตรวจประเมิน ซึ่งอาจมีผู้เชี่ยวชาญร่วมด้วยตามความเหมาะสม</p>
        <div style="margin-left:130px;letter-spacing: -0.2px">ข้อ ๖.๑.๒ (๒.๑) คณะผู้ตรวจประเมินจะทบทวน<span style="letter-spacing:0.1px">และประเมินเอกสารของห้องปฏิบัติการ</span></div>
        <p style="margin: top 0;"><span style="letter-spacing:0.2px">และข้อ ๖.๑.๒ (๒.๒) คณะผู้ตรวจประเมินจะตรวจประเมินความสามารถและประสิทธิผลของการดําเนินงาน </span> <span style="letter-spacing:-0.15px">ตามระบบการบริหารของห้องปฏิบัติการโดยพิจารณาหลักฐานและเอกสารที่เกี่ยวข้อง การสัมภาษณ์ รวมทั้งสังเกต</span> <span style="letter-spacing: 0.15px;">การปฏิบัติงานตามระบบบริหารงานและมาตรฐานการตรวจสอบและรับรองที่เกี่ยวข้อง ณ สถานประกอบการ</span> ของผู้ยืนคําขอและสถานที่ทําการอื่นในสาขาที่ขอรับการรับรอง</p>
        <div style="margin-left:105px; letter-spacing: 0.75px">๒.๓ ประกาศสํานักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรม เรื่อง แนวทางการแต่งตั้ง</div>
        <p style="margin: top 0;letter-spacing: 0.3px">พนักงานเจ้าหน้าที่ตามพระราชบัญญัติการมาตรฐานแห่งชาติ พ.ศ. ๒๕๕๑ (ประกาศ ณ วันที่ ๙ กุมภาพันธ์ พ.ศ. ๒๕๖๐) ซึ่งระบุพนักงานเจ้าหน้าที่ต้องมีคุณสมบัติตามข้อ ๑. ถึง ๓.</p>
        <div style="margin-left:105px; letter-spacing: 0.5px">๒.๔ คําสั่งสํานักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรม ที่ ๓/๒๕๖๕ เรื่อง มอบอํานาจ</div>
        <p style="margin: top 0; letter-spacing: 0.25px">ให้ข้าราชการสั่งและปฏิบัติราชการแทนเลขาธิการสํานักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรมในการเป็นผู้มี<span style="letter-spacing:-0.1px">อำนาจพิจารณาดำเนินการตามพระราชบัญญัติการมาตรฐานแห่งชาติ พ.ศ. ๒๕๕๑ (สั่ง ณ วันที่ ๑๓ พฤศจิกายน</span> ๒๕๖๖) <span style="letter-spacing: 0.35px;">ข้อ ๓. ระบุให้ผู้อํานวยการสํานักงานคณะกรรมการการมาตรฐานแห่งชาติเป็นผู้มีอํานาจพิจารณา</span> <span style="letter-spacing:0.4px">แต่งตั้งคณะผู้ตรวจประเมิน ตามพระราชบัญญัติการมาตรฐานแห่งชาติ พ.ศ. ๒๕๕๑ และข้อ ๕.๒ ในกรณี</span></p>
        <p style="margin: bottom 0;"><span style="letter-spacing: 0.45px;">ที่ข้าราชการผู้รับมอบอํานาจตามข้อ ๓. ไม่อาจปฏิบัติราชการได้หรือไม่มีผู้ดํารงตําแหน่งดังกล่าว ให้รอง</span></p>
    </div>
</div>

<pagebreak />
<div style="text-align: center;">
    <div style="text-align: center; margin-top: 20px;">
        <span>-{{ HP::toThaiNumber(2) }}-</span>
    </div>
</div>

    <div style="position: relative;padding-top:10px; line-height:1.15">
        <p><span style="letter-spacing: 0.15px;">เลขาธิการสํานักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรมที่กํากับเป็นผู้พิจารณาแต่งตั้งคณะผู้ตรวจประเมิน ตาม</span> พระราชบัญญัติการมาตรฐานแห่งชาติ พ.ศ. ๒๕๕๑</p>
        <div style="margin-top: 80px; margin-left:520px; margin-bottom: 30px;">๓. ข้อเท็จจริง ...</div>
        <div style="font-weight: bold;margin-left:90px;margin-top:5px;">๓. ข้อเท็จจริง</div>
        <div style="margin-left:105px;letter-spacing: 0.1px;">ตามประกาศคณะกรรมการการมาตรฐานแห่งชาติ เรื่อง หลักเกณฑ์ วิธีการ และเงื่อนไขการ</div>
        <p style="margin: top 0;letter-spacing: 0.5px;"> <span style="letter-spacing: 0.05px;">รับรองห้องปฏิบัติการ สมอ. มีอํานาจหน้าที่ในการรับรองความสามารถห้องปฏิบัติการ กําหนดให้มีการประเมิน</span> เพื่อพิจารณาให้การรับรองความสามารถห้องปฏิบัติการ{{$data->lab_type}} ตามมาตรฐานเลขที่ มอก. 17025-2561</p>

        <div style="font-weight: bold;margin-left:90px;margin-top:5px;">๔. การดําเนินการ</div>
        @php
            $textResult = TextHelper::callLonganTokenizePost("รป.".$boardAuditorMsRecordInfo->body_text2." สก. ได้สรรหาคณะผู้ตรวจประเมินประกอบด้วย". str_replace(' ', '!', $data->experts) ." เพื่อดำเนินการตรวจประเมินให้การรับรองห้องปฏิบัติการ และกำหนดการตรวจประเมินห้องปฏิบัติการ".str_replace(' ', '!', $data->lab_name). " ". str_replace(' ', '!', $data->date_range). " ซึ่งเห็นสมควรเสนอแต่งตั้งคณะผู้ตรวจประเมินห้องปฏิบัติการ ดังนี้");
            // แทนที่ '!' ด้วย span ที่ซ่อนด้วย color:#fff
            $textResult = str_replace('!', '<span style="color:#fff;">!</span>', $textResult);

        @endphp
   
        <div style="text-indent: 100px;display:block;font-size:22px;word-spacing: -0.2em">{!! $textResult !!}</div>

        <div style="display:inline-block;padding-top:0%;padding-top:20px;padding-bottom:15px">
            <table style="border-collapse: collapse;margin-left:90px;">
                @php
                    $index = 0;
                @endphp
                @foreach ($data->statusAuditorMap as $statusId => $auditorIds)
                    @php
                        $index++;
                    @endphp

                    @foreach ($auditorIds as $auditorId)
                        @php
                            $info = HP::getExpertInfo($statusId, $auditorId);
                       
                            $textResult = TextHelper::callLonganTokenizePost($info->statusAuditor->title);
                            // แทนที่ '!' ด้วย span ที่ซ่อนด้วย color:#fff
                            $textResult = str_replace('!', '<span style="color:#fff;">!</span>', $textResult);
                
                        @endphp
                        <tr>
                            <td style="width: 180px">{{HP::toThaiNumber($index)}}. {{$info->auditorInformation->title_th}}{{$info->auditorInformation->fname_th}} {{$info->auditorInformation->lname_th}}</td>
                            <td style="width: 100px">{{$info->auditorInformation->number_auditor}}</td>
                            <td style="padding-left:10px;word-spacing: -0.2em">{!!$textResult!!}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>

        <p style="margin-top: 10px;">โดยมีรายละเอียดการตรวจประเมินดังกําหนดการตรวจประเมินที่แนบมาพร้อมนี้</p>

        <div style="font-weight: bold;margin-left:90px;margin-top:5px;">๕. ข้อปัญหา/อุปสรรค</div>
        <p style="margin: top 0;margin-left:105px;">-</p>

        <div style="font-weight: bold;margin-left:90px;margin-top:5px;">๖. ข้อพิจารณา</div>
        <p style="margin: top 0;margin-left:105px;">เพื่อโปรดนําเรียน สมอ. พิจารณาลงนามอนุมัติการแต่งตั้งคณะผู้ตรวจประเมิน</p>

        <div style="font-weight: bold;margin-left:90px;margin-top:5px;">๗. ข้อเสนอ</div>
        <p style="margin: top 0;margin-left:105px;letter-spacing: 0.85px;">จึงเรียนมาเพื่อโปรดพิจารณา หากเห็นเป็นการสมควร ขอได้โปรดนําเรียน ลมอ. </p>
        <p style="margin: top 0;letter-spacing: 0.1px;"> <span style="letter-spacing: 0.1px;">เพื่ออนุมัติการแต่งตั้งคณะผู้ตรวจประเมินเพื่อดําเนินการตรวจประเมินให้การรับรองห้องปฏิบัติการ{{$data->lab_type}} ห้องปฏิบัติการ{{$data->lab_name}}</span>รายละเอียดดังข้างต้น</p>

    </div>


    <pagebreak />
    
    <div style="text-align: center;">
        <div style="text-align: center; margin-top: 20px;">
            <span>-{{ HP::toThaiNumber(3) }}-</span>
        </div>
    </div>

<div style="padding-top:30px">
    <table style="width: 100%;text-align:center;">
        <tr>
            <td style="width:40%"></td>
            <td>  <img src="{{public_path($signer->signer_url2)}}" style="width: 70px" alt=""></td>
        </tr>
        <tr>
            <td style="width:40%"></td>
            <td>{{$signer->signer_1->signer_name}}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{$signer->signer_1->signer_position}}</td>
        </tr>
        <tr>
            <td style="width:40%"></td>
            <td>{{HP::formatDateThaiFullNumThai($signer->signer_1->updated_at)}}</td>
        </tr>
    </table>
</div>


        <div style="margin-top: 170px; margin-left:520px; margin-bottom: 30px;">เรียน ลมอ.</div>

        <div style="position: relative;padding-top:10px ;line-height:1.18">
            <p style="margin: bottom 0;">เรียน ลมอ.</p>
            <div style="margin-left:90px; letter-spacing: 0.5px;">สก. ได้ตรวจสอบรายละเอียดการดําเนินการสําหรับการแต่งตั้งคณะผู้ตรวจประเมินแล้ว</div>
            <p style="margin: top 0;">ตามหลักเกณฑ์ วิธีการ และเงื่อนไขการรับรองห้องปฏิบัติการที่กําหนด รายละเอียดดังข้างต้น</p>

            <div style="margin-left:90px;margin-top:5px; letter-spacing: 0.15px;">จึงเรียนมาเพื่อโปรดอนุมัติการแต่งตั้งคณะผู้ตรวจประเมินเพื่อดําเนินการตรวจประเมินให้การ</div>
            <div style="letter-spacing: 0.1px;">รับรองห้องปฏิบัติการ{{$data->lab_type}} {{$data->lab_name}} ตามวันและเวลา ดังกล่าว</div>

            <table style="width: 100%;text-align:center;margin-top:20px">
                <tr>
                    <td style="width:40%"></td>
                    <td>  <img src="{{public_path($signer->signer_url3)}}" style="width: 70px" alt=""></td>
                </tr>
                <tr>
                    <td style="width:40%"></td>
                    <td>{{$signer->signer_3->signer_name}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>ผู้อำนวยการสำนักงานคณะกรรมการการมาตรฐานแห่งชาติ</td>
                </tr>
                <tr>
                    <td style="width:40%"></td>
                    <td>{{HP::formatDateThaiFullNumThai($signer->signer_3->updated_at)}}</td>
                </tr>
            </table>
     

            <div style="position: relative;padding-top:110px ;line-height:1.18">
                <p style="margin: top 0;">
                    <input type="checkbox" id="option1" name="committee" style="margin-right: 5px;" checked="checked">
                    <label for="option1" style="border-bottom: 1px dotted black; line-height: 1; margin-bottom: 0;">อนุมัติ</label>
                </p>
                <p style="margin: top 0;padding-bottom: 10px;padding-top:10px;" checked="checked">
                    <input type="checkbox" id="option1" name="committee" style="margin-right: 5px;" checked="checked">
                    <label for="option1" style="border-bottom: 1px dotted black; line-height: 1; margin-bottom: 0;">ดำเนินการต่อไป</label>
                </p>
                <p style="margin: top 0;">
                    <input type="checkbox" id="option1" name="committee" style="margin-right: 5px;">
                    <label for="option1" style="border-bottom: 1px dotted black; line-height: 1; margin-bottom: 0;">..........................</label>
                </p>
            </div>

        </div>

<pagebreak />
<div style="text-align: center;">
    <div style="text-align: center; margin-top: 20px;">
        <span>-{{ HP::toThaiNumber(4) }}-</span>
    </div>
</div>
<div style="padding-top:70px">
    <table style="width: 100%;text-align:center">
        <tr>
            <td>
                <img src="{{public_path($signer->signer_url4)}}" style="width: 70px" alt=""></td>
            <td style="width:45%"></td>
        </tr>
        <tr>
            <td>{{$signer->signer_4->signer_name}}</td>
            <td></td>
        </tr>
        <tr>
            <td >ตำแหน่ง ผู้อำนวยการสำนักงานคณะกรรมการการมาตรฐานแห่งชาติ<br>
                ปฏิบัติราชการแทน<br>
                เลขาธิการสำนักงานมาตรฐานผลิตภัณฑ์อุตสาหกรรม</td>
            <td></td>
        </tr>
        <tr>
            <td >{{HP::formatDateThaiFullNumThai($signer->signer_4->updated_at)}}</td>
            <td></td>
        </tr>
    </table>
</div>



 
