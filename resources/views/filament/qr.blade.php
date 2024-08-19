@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp
    <!-- render base64 image -->
<!--<img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=" alt="QR">-->
<!--<img src="https://quickchart.io/qr?size=300&text={{$this->data['code']}}" alt="QR">-->
<!--<a href="https://quickchart.io/qr?ecLevel=H&size=500&text={{$this->data['code']}}">Click here to download</a>-->

{!! QrCode::size(300)->generate($this->data['code']) !!}
