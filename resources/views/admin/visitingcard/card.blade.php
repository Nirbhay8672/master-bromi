@extends('admin.layouts.app')
@section('content')
    <style>
        .button {
            display: inline-block;
            max-height: 34px;
            font-size: medium;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
        }

        .flex-container > div {
            background-color: #f1f1f1;
            width: auto;
            height: 375px;
            margin: 15px;
        }
        
        .flip-card {
            background-color: transparent;
            width: 575px;
            height: 300px;
        }
        
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        
        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }
        
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        
        .flip-card-front {
            color: black;
        }
        
        .flip-card-back {
            transform: rotateY(180deg);
        }
        .text-shadow {
            text-shadow: 0px 0px 6px rgb(0, 0, 0);
        }
        .outlined-card {
            border: 2px solid #00000082;
        }

    </style>
    <div class="page-body" x-data='visiting_card_page'>
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">

                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="mb-3">Visiting Card<a class="btn custom-icon-theme-button tooltip-btn"
                                href="{{ route('admin.settings') }}"
                                data-tooltip="Back"
                                style="float: inline-end;"
                            >
                                <i class="fa fa-backward"></i>
                            </a></h5>
                        </div>
                        <div class="card-body">
                            <div class="flex-container">
                                <div>
                                    <div class="clearfix">
                                        <div class="pull-left p-3">
                                            <button class="btn btn-secondary" type="submit" value="Demo" onclick="printCard('card1', 'front1', 'back1')">Demo</button>
                                        </div>
                                        <div class="pull-right p-3">
                                            <input type="color" id="favcolor" x-model="textColor" @change="updateTextColorFirst()" name="favcolor">
                                        </div>
                                    </div>
                                    <div class="flip-card">
                                        <div class="flip-card-inner" id="card1">
                                            <div class="flip-card-front text-center outlined-card" id="front1" style="background-image: url({{asset('card/front-1.png')}});background-size: cover;">
                                                <img src="{{ Auth::user()->company_logo ? asset('storage/file_image'.'/'.Auth::user()->company_logo) : asset('Bromi-Logo-card.png')}}" alt="Avatar" style="width:200px;height:200px;margin-top: 40px;">
                                                <h3 x-text="company_detail.company_name ?? 'Company Name'" id="company_1_front" class="text-shadow"></h3>
                                            </div>
                                            <div class="flip-card-back outlined-card" id="back1" style="background-image: url( {{asset('card/1.png')}} );background-size: cover;">
                                                <div class="row">
                                                    <div class="col-md-6" style="margin-top: 120px;">
                                                        <h3 style="margin-left: 20px;" id="company_name_1">{{ Auth::user()->company_name ?? 'Company Name'}}</h3>
                                                        <ul style="margin-left: 20px;" id="card_detail_1">
                                                            <li class="mb-2">
                                                                <span>{{ Auth::user()->first_name ?? 'person name' }}</span>
                                                            </li>
                                                            <li class="mb-2">
                                                                <span style="text-transform: lowercase;">{{ Auth::user()->email ?? 'xyz@gmail.com' }}</span>
                                                            </li>
                                                            <li class="mb-2">
                                                                <span>{{ Auth::user()->mobile_number ?? '00000 00000' }}</span>
                                                            </li>
                                                            <li class="mb-2">
                                                                <span>{{ Auth::user()->address ?? 'company address' }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img src="{{ Auth::user()->company_logo ? asset('storage/file_image'.'/'.Auth::user()->company_logo) : asset('Bromi-Logo-card.png')}}" alt="Left Image" class="img-fluid" style="width:200px;height:200px;margin-left: 50px;margin-top: 60px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="clearfix">
                                        <div class="pull-left p-3">
                                            <button class="btn btn-secondary" type="submit" value="Demo" @click="printCard('card2', 'front2', 'back2')">Demo</button>
                                        </div>
                                        <div class="pull-right p-3">
                                            <input type="color" id="favcolor" x-model="textColor2" @change="updateTextColorSecond()" name="favcolor" value="#ff0000">
                                        </div>
                                    </div>
                                    <div class="flip-card">
                                        <div class="flip-card-inner" id="card2">
                                            <div class="flip-card-front text-center outlined-card" id="front2" style="background-color: rgb(147, 192, 255)">
                                                <img src="{{ Auth::user()->company_logo ? asset('storage/file_image'.'/'.Auth::user()->company_logo) : asset('Bromi-Logo-card.png')}}" alt="Avatar" style="width:200px;height:200px;">
                                                <h3 id="company_name_2">{{ Auth::user()->company_name ?? 'Company Name'}}</h3>
                                            </div>
                                            <div class="flip-card-back text-center outlined-card" id="back2">
                                                <h3 style="margin-top: 60px;" id="company_name_2_back">{{ Auth::user()->company_name ?? 'Company Name'}}</h3>
                                                <ul id="card_detail_2">
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->first_name ?? 'person name' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span style="text-transform: lowercase;">{{ Auth::user()->email ?? 'xyz@gmail.com' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->mobile_number ?? '00000 00000' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->address ?? 'company address' }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="clearfix">
                                        <div class="pull-left p-3">
                                            <button class="btn btn-secondary" type="submit" value="Demo" @click="printCard('card3', 'front3', 'back3')">Demo</button>
                                        </div>
                                        <div class="pull-right p-3">
                                            <input type="color" id="favcolor" x-model="textColor3" @change="updateTextColorThird()" name="favcolor" value="#ff0000">
                                        </div>
                                    </div>
                                    <div class="flip-card">
                                        <div class="flip-card-inner" id="card3">
                                            <div class="flip-card-front outlined-card" id="front3"  style="background-image: url({{asset('card/front-3.png')}});background-size: cover;">
                                                <img src="{{ Auth::user()->company_logo ? asset('storage/file_image'.'/'.Auth::user()->company_logo) : asset('Bromi-Logo-card.png')}}" alt="Avatar" style="width:200px;height:200px;margin-left: 284px;">
                                                <h3 id="company_name_3" style="margin-left: 350px;">{{ Auth::user()->company_name ?? 'Company Name'}}</h3>
                                            </div>
                                            <div class="flip-card-back outlined-card" id="back3" style="background-image: url({{asset('card/back-3.png')}});background-size: cover;">
                                                <h3 style="margin-top: 60px;margin-left: 250px;" id="company_name_3_back">{{ Auth::user()->company_name ?? 'Company Name'}}</h3>
                                                <ul id="card_detail_3" style="margin-left: 250px;">
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->first_name ?? 'person name' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span style="text-transform: lowercase;">{{ Auth::user()->email ?? 'xyz@gmail.com' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->mobile_number ?? '00000 00000' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->address ?? 'company address' }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="clearfix">
                                        <div class="pull-left p-3">
                                            <button class="btn btn-secondary" type="submit" value="Demo" @click="printCard('card4', 'front4', 'back4')">Demo</button>
                                        </div>
                                        <div class="pull-right p-3">
                                            <input type="color" id="favcolor" x-model="textColor4" @change="updateTextColorForth()" name="favcolor" value="#ff0000">
                                        </div>
                                    </div>
                                    <div class="flip-card">
                                        <div class="flip-card-inner" id="card4">
                                            <div class="flip-card-front outlined-card" id="front4"  style="background-image: url({{asset('card/front-4.png')}});background-size: cover;">
                                                <img src="{{ Auth::user()->company_logo ? asset('storage/file_image'.'/'.Auth::user()->company_logo) : asset('Bromi-Logo-card.png')}}" alt="Avatar" style="width:200px;height:200px;margin-left: 40px;">
                                                <span class="h2" id="company_name_4" style="margin-left: 10px;">{{ Auth::user()->company_name ?? 'Company Name'}}</span>
                                            </div>
                                            <div class="flip-card-back outlined-card" id="back4" style="background-image: url({{asset('card/back-4.png')}});background-size: cover;">
                                                <h3 style="margin-top: 60px;margin-left: 250px;" id="company_name_4_back">{{ Auth::user()->company_name ?? 'Company Name'}}</h3>
                                                <ul id="card_detail_4" style="margin-left: 250px;">
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->first_name ?? 'person name' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span style="text-transform: lowercase;">{{ Auth::user()->email ?? 'xyz@gmail.com' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->mobile_number ?? '00000 00000' }}</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <span>{{ Auth::user()->address ?? 'company address' }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $encode_company = json_encode($company);
    @endphp
@endsection

@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>

    <script type="text/javascript">

        document.addEventListener('alpine:init', () => {

            Alpine.data('visiting_card_page', () => ({
                
                init() {

                    document.getElementById('company_name_1').style.color = this.textColor;
                    document.getElementById('card_detail_1').style.color = this.textColor;
                    document.getElementById('company_1_front').style.color = this.textColor;


                    document.getElementById('company_name_2').style.color = this.textColor2;
                    document.getElementById('card_detail_2').style.color = this.textColor2;
                    document.getElementById('company_name_2_back').style.color = this.textColor2;

                    document.getElementById('company_name_3').style.color = this.textColor3;
                    document.getElementById('card_detail_3').style.color = this.textColor3;
                    document.getElementById('company_name_3_back').style.color = this.textColor3;

                    document.getElementById('company_name_4').style.color = this.textColor4;
                    document.getElementById('card_detail_4').style.color = this.textColor4;
                    document.getElementById('company_name_4_back').style.color = this.textColor4;
                },
                
                company_detail : JSON.parse(@Json($encode_company)),

                textColor : '#FFFFFF',
                textColor2 : '#000000',
                textColor3 : '#000000',
                textColor4 : '#000000',

                updateTextColorFirst() {
                    document.getElementById('company_name_1').style.color = this.textColor;
                    document.getElementById('card_detail_1').style.color = this.textColor;
                    document.getElementById('company_1_front').style.color = this.textColor;
                },

                updateTextColorSecond() {
                    document.getElementById('company_name_2').style.color = this.textColor2;
                    document.getElementById('card_detail_2').style.color = this.textColor2;
                    document.getElementById('company_name_2_back').style.color = this.textColor2;
                },

                updateTextColorThird() {
                    document.getElementById('company_name_3').style.color = this.textColor3;
                    document.getElementById('card_detail_3').style.color = this.textColor3;
                    document.getElementById('company_name_3_back').style.color = this.textColor3;
                },

                updateTextColorForth() {
                    document.getElementById('company_name_4').style.color = this.textColor4;
                    document.getElementById('card_detail_4').style.color = this.textColor4;
                    document.getElementById('company_name_4_back').style.color = this.textColor4;
                },
            }));
        });

    </script>

    <script>
        window.jsPDF = window.jspdf.jsPDF;
        var docPDF = new jsPDF();

        function printCard(card , front , back){
            const cardElement = document.getElementById(card);
            const frontCardElement = document.getElementById(front);
            const backCardElement = document.getElementById(back);

            if (backCardElement) {
                // Apply CSS transform to flip the back card
                backCardElement.style.transform = 'scaleX(-1) rotateY(180deg)';
            }

            Promise.all([
                domtoimage.toPng(frontCardElement),
                domtoimage.toPng(backCardElement)
            ])
            .then(function(images) {
                const pdf = new jsPDF();
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();

                const frontImgData = images[0];
                const backImgData = images[1];

                // Define the desired dimensions for the card in the PDF
                const cardWidthInPdf = 100; // Set the desired width of the card in the PDF (e.g., 100 mm)
                const cardHeightInPdf = (cardWidthInPdf * frontCardElement.offsetHeight) / frontCardElement.offsetWidth;

                const spaceBetweenCards = 10; // Set the desired space between the front and back card
                const paddingTop = 5; // Set the desired padding from the top (in mm)

                // Calculate the positions for the front and back card
                const frontCardX = (pdfWidth - cardWidthInPdf) / 2;
                const frontCardY = paddingTop;

                const backCardX = frontCardX;
                const backCardY = frontCardY + cardHeightInPdf + spaceBetweenCards;

                // Add front side to the PDF
                pdf.addImage(frontImgData, 'PNG', frontCardX, frontCardY, cardWidthInPdf, cardHeightInPdf);

                // Add back side to the PDF
                pdf.addImage(backImgData, 'PNG', backCardX, backCardY, cardWidthInPdf, cardHeightInPdf);

                const pdfData = pdf.output('blob');
                const pdfURL = URL.createObjectURL(pdfData);

                // Open PDF in a new tab for previewing
                window.open(pdfURL);
            })
            .catch(function(error) {
                console.error('Error generating PDF:', error);
            })
            .finally(function() {
                // Reset the CSS transform of the back card element
                if (backCardElement) {
                    backCardElement.style.transform = '';
                }
            });
        }
    </script>

@endpush
