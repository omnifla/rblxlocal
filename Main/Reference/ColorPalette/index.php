<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title>Style Guide</title>

    <head id="ctl00_Head1">
        <script type="text/javascript" src="/js/roblox.js"></script>
        <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">

        <script type="text/javascript" src="/js/jquery/jquery-1.7.2.min.js"></script>
        <script src="https://web.archive.org/web/20140516222409js_/http://code.highcharts.com/highcharts.js"></script>
        <script src="https://web.archive.org/web/20140516222409js_/http://code.highcharts.com/modules/exporting.js"></script>

        <style type="text/css" rel="stylesheet">
            .color-square-container,
            .color-sliver-container {
                float: left;
                height: 140px;
                margin-right: 18px;
            }

            .color-sliver-container {
                height: 40px;
            }

            .color-square {
                width: 120px;
                height: 120px;
            }

            .color-sliver {
                width: 120px;
                height: 15px;
            }

            .color-label {
                font-weight: 600;
            }

            .color-doc-section {
                clear: both;
                padding-bottom: 40px;
            }

            .color-btn-one {
                width: 0;
                height: 0;
                border: 60px solid transparent;
                border-top-color: #4278D2;
                border-left-color: #4278D2;
                border-right-color: #FFFFFF;
                border-bottom-color: #FFFFFF;
            }

            .color-btn-two {
                width: 0;
                height: 0;
                border: 60px solid transparent;
                border-top-color: #00B255;
                border-left-color: #00B255;
                border-right-color: #008B41;
                border-bottom-color: #008B41;
            }

            #buttons {
                height: 170px;
            }
        </style>
    </head>

<body>
    <div style="position:relative;margin:0 auto;padding-left: 20px">
        <h1>Color Palette</h1>
        <div style="position:relative;top:0px;float:left">
            <h2>Ratio</h2>
            <div id="colorWheel" style="min-width:750px; height:625px;" data-highcharts-chart="0">
                <div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 750px; height: 625px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="750" height="625">
                        <desc>Created with Highcharts 4.0.1</desc>
                        <defs>
                            <clipPath id="highcharts-1">
                                <rect x="0" y="0" width="730" height="600"></rect>
                            </clipPath>
                        </defs>
                        <rect x="0" y="0" width="750" height="625" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect>
                        <path fill="rgba(239,239,239,0.25)" d="M 0 0"></path>
                        <g class="highcharts-series-group" zIndex="3">
                            <g class="highcharts-series highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(10,10) scale(1 1)" style="cursor:pointer;">
                                <path fill="#FFFFFF" d="M 352.4451100716042 580.9999944101962 A 269.5 269.5 0 0 1 83.0000473293565 311.6597201330993 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#4278D2" d="M 83.00002235921511 311.3902201454853 A 269.5 269.5 0 0 1 161.7460007276672 121.12363129418912 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#0055B3" d="M 161.9364724416353 120.93297251488556 A 269.5 269.5 0 0 1 352.1256699066897 42.0002599686203 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#00A1DA" d="M 352.3951697889696 42.00002038844815 A 269.5 269.5 0 0 1 387.3324531504009 44.26050028574531 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#008B41" d="M 387.5996751893502 44.29546635282901 A 269.5 269.5 0 0 1 421.94233102297244 51.100282907035535 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#F5B400" d="M 422.20269597550293 51.169855426332504 A 269.5 269.5 0 0 1 455.36221230836435 62.40239808655528 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#E27520" d="M 455.6112584376598 62.505384830510565 A 269.5 269.5 0 0 1 487.01939813417823 77.97316743975983 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#E04A32" d="M 487.25285766812397 78.10780357888072 A 269.5 269.5 0 0 1 542.9152162352904 120.78477924909186 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#EFEFEF" d="M 543.1058362166552 120.97528979119377 A 269.5 269.5 0 0 1 585.814771047867 176.61313032440341 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#989898" d="M 585.9495412376857 176.8465124999948 A 269.5 269.5 0 0 1 612.720089932904 241.38755605948865 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#4C4C4C" d="M 612.790072255125 241.64781116227067 A 269.5 269.5 0 0 1 612.8855681498816 380.99536602726374 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#343434" d="M 612.8159426026637 381.255716804336 A 269.5 269.5 0 0 1 543.176434318087 501.95405586581836 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                                <path fill="#00B255" d="M 542.9858849557543 502.1446370413371 A 269.5 269.5 0 0 1 352.7645503136362 580.9998701542016 L 352.5 311.5 A 0 0 0 0 0 352.5 311.5 Z" stroke="#FFFFFF" stroke-width="1" stroke-linejoin="round" transform="translate(0,0)"></path>
                            </g>
                            <g class="highcharts-markers" visibility="visible" zIndex="0.1" transform="translate(10,10) scale(1 1)"></g>
                        </g>
                        <g class="highcharts-data-labels highcharts-tracker" visibility="visible" zIndex="6" transform="translate(10,10) scale(1 1)" opacity="1" style="cursor:pointer;">
                            <path fill="none" d="M 135.72151903462907 523.278480965371 C 140.72151903462907 523.278480965371 146.3783732841214 517.6216267158786 154.15654787717344 509.8434521228266 L 161.93472247022547 502.06527752977456" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 70.7980800128696 196.88631200665563 C 75.7980800128696 196.88631200665563 83.1891162729599 199.94777946557633 93.35179113058405 204.15729722159233 L 103.5144659882082 208.36681497760833" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 232.88631200665537 34.79808001286969 C 237.88631200665537 34.79808001286969 240.94777946557616 42.18911627295998 245.15729722159216 52.35179113058413 L 249.36681497760816 62.514465988208286" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 377.08823720442797 12 C 372.08823720442797 12 371.5650121705868 20.624123875947078 370.8455777490552 31.600572031571716 L 370.12614332752366 42.577020187196354" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 472.5999565595053 35 C 467.5999565595053 35 409.3688288677018 25.60109076245837 407.22283532552433 36.3897288468939 L 405.0768417833469 47.178366931329435" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 516.9929465525043 58 C 511.99294655250435 58 446.1996041358716 35.46986725217674 442.6637700175368 45.8860986766229 L 439.12793589920204 56.30233010106906" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 548.7328423676227 81 C 543.7328423676227 81 481.42715319883905 50.061595843221454 476.56197760643005 59.927196000081025 L 471.69680201402105 69.7927961569406" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 573.47222043587 104 C 568.47222043587 104 529.9539565560424 80.23750130510516 523.2575808369464 88.96438804830873 L 516.5612051178505 97.69127479151231" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 595.109325417225 129.17595201188834 C 590.109325417225 129.17595201188834 583.7624986948953 134.0460434439581 575.0356119516916 140.74241916305402 L 566.308725208488 147.43879488214995" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 634.2019199871304 196.88631200665577 C 629.2019199871304 196.88631200665577 621.8108837270403 199.9477794655765 611.6482088694161 204.15729722159247 L 601.4855340117919 208.36681497760844" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 657 311.5 C 652 311.5 644 311.5 633 311.5 L 622 311.5" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 616.8746084334393 461.25000000000006 C 611.8746084334393 461.25000000000006 604.9464052031639 457.25000000000006 595.420125761535 451.75000000000006 L 585.8938463199062 446.25000000000006" stroke-width="1" stroke="#000000"></path>
                            <path fill="none" d="M 472.11368799334434 588.2019199871304 C 467.11368799334434 588.2019199871304 464.0522205344238 580.8108837270399 459.8427027784078 570.6482088694158 L 455.6331850223918 560.4855340117917" stroke-width="1" stroke="#000000"></path>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(82,513)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#FFFFFF</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(11,187)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#4278D2</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(175,25)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#0055B3</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(382,2)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#00A1DA</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(478,25)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#008B41</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(522,48)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#F5B400</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(554,71)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#E27520</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(578,94)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#E04A32</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(600,119)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#EFEFEF</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(639,187)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#989898</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(662,302)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#4C4C4C</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(622,451)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#343434</tspan>
                                </text></g>
                            <g zIndex="1" style="cursor:pointer;" transform="translate(477,578)"><text x="3" zIndex="1" style="font-size:11px;color:#000000;fill:#000000;" y="15">
                                    <tspan style="font-weight:bold">#00B255</tspan>
                                </text></g>
                        </g>
                        <g class="highcharts-legend" zIndex="7">
                            <g zIndex="1">
                                <g></g>
                            </g>
                        </g>
                        <g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(511,28)" opacity="0" visibility="hidden">
                            <path fill="none" d="M 3.5 0.5 L 115.5 0.5 C 118.5 0.5 118.5 0.5 118.5 3.5 L 118.5 45.5 C 118.5 48.5 118.5 48.5 115.5 48.5 L 3.5 48.5 C 0.5 48.5 0.5 48.5 0.5 45.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke-width="5" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" transform="translate(1, 1)" width="118" height="48"></path>
                            <path fill="none" d="M 3.5 0.5 L 115.5 0.5 C 118.5 0.5 118.5 0.5 118.5 3.5 L 118.5 45.5 C 118.5 48.5 118.5 48.5 115.5 48.5 L 3.5 48.5 C 0.5 48.5 0.5 48.5 0.5 45.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke-width="3" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" transform="translate(1, 1)" width="118" height="48"></path>
                            <path fill="none" d="M 3.5 0.5 L 115.5 0.5 C 118.5 0.5 118.5 0.5 118.5 3.5 L 118.5 45.5 C 118.5 48.5 118.5 48.5 115.5 48.5 L 3.5 48.5 C 0.5 48.5 0.5 48.5 0.5 45.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke-width="1" isShadow="true" stroke="black" stroke-opacity="0.15" transform="translate(1, 1)" width="118" height="48"></path>
                            <path fill="rgba(249, 249, 249, .85)" d="M 3.5 0.5 L 115.5 0.5 C 118.5 0.5 118.5 0.5 118.5 3.5 L 118.5 45.5 C 118.5 48.5 118.5 48.5 115.5 48.5 L 3.5 48.5 C 0.5 48.5 0.5 48.5 0.5 45.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" stroke-width="1" stroke="#EFEFEF"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" y="21">
                                <tspan style="font-size: 10px">#EFEFEF</tspan>
                                <tspan x="8" dy="16">Color Ratio: </tspan>
                                <tspan style="font-weight:bold" dx="0">4.2%</tspan>
                            </text>
                        </g>
                    </svg></div>
            </div>
        </div>
        <div style="width:700px;position:relative;top:0px;float:left;">
            <div id="coreColors" class="color-doc-section" style="height:190px;">
                <h2>Core Colors</h2>
                <h3 style="float:left;margin: 1px;">Gamer</h3>
                <h3 style="float:right;margin: 1px;">Developer</h3>
                <hr style="clear:both">
                <div class="color-square-container">
                    <div class="color-square" style="background-color:#0055B3;border:1px solid #0044A2;"></div>
                    <span class="color-label">#0055B3</span>
                </div>
                <div class="color-square-container">
                    <div class="color-square" style="background-color:#FFFFFF;border:1px solid #EEEEEE;"></div>
                    <span class="color-label">#FFFFFF</span>
                </div>
                <div class="color-square-container">
                    <div class="color-square" style="background-color:#EFEFEF;border:1px solid #DEDEDE;"></div>
                    <span class="color-label">#EFEFEF</span>
                </div>
                <div class="color-square-container">
                    <div class="color-square" style="background-color:#4C4C4C;border:1px solid #3B3B3B;"></div>
                    <span class="color-label">#4C4C4C</span>
                </div>
                <div class="color-square-container">
                    <div class="color-square" style="background-color:#343434;border:1px solid #232323;"></div>
                    <span class="color-label">#343434</span>
                </div>
            </div>
            <div id="buttons" class="color-doc-section">
                <h2>Buttons</h2>
                <div class="color-square-container">
                    <div style="border:1px solid #EEEEEE;">
                        <div class="color-square color-btn-one"></div>
                    </div>
                    <span class="color-label">#4278D2</span> / <span class="color-label">#FFFFFF</span>
                </div>
                <div class="color-square-container">
                    <div style="border:1px solid #007A30;">
                        <div class="color-square color-btn-two"></div>
                    </div>
                    <span class="color-label">#00B255</span> / <span class="color-label">#008B41</span>
                </div>

            </div>
            <div id="auxillary" class="color-doc-section">
                <h2>Auxillary</h2>
                <div class="color-sliver-container">
                    <div class="color-sliver" style="background-color:#008B41;border:1px solid #007A30;"></div>
                    <span class="color-label">#008B41</span>
                </div>
                <div class="color-sliver-container">
                    <div class="color-sliver" style="background-color:#E04A32;border:1px solid #D03921;"></div>
                    <span class="color-label">#E04A32</span>
                </div>
                <div class="color-sliver-container">
                    <div class="color-sliver" style="background-color:#E27520;border:1px solid #D16410;"></div>
                    <span class="color-label">#E27520</span>
                </div>
                <div class="color-sliver-container">
                    <div class="color-sliver" style="background-color:#F5B400;border:1px solid #E4A300;"></div>
                    <span class="color-label">#F5B400</span>
                </div>
                <div class="color-sliver-container">
                    <div class="color-sliver" style="background-color:#00A1DA;border:1px solid #0090C9;"></div>
                    <span class="color-label">#00A1DA</span>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            Highcharts.setOptions({
                colors: [
                    '#FFFFFF', // 90
                    '#4278D2', // 45
                    '#0055B3', // 45
                    '#00A1DA', // 7.5
                    '#008B41', // 7.5
                    '#F5B400', // 7.5
                    '#E27520', // 7.5
                    '#E04A32', // 15
                    '#EFEFEF', // 15
                    '#989898', // 15
                    '#4C4C4C', // 30
                    '#343434', // 30
                    '#00B255' // 45
                ]
            });
            $('#colorWheel').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                credits: {
                    enabled: false
                },
                exporting: {
                    enabled: false
                },
                title: {
                    text: null
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            format: '<b>{point.color}</b>'
                        },
                        startAngle: 180
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Color Ratio',
                    data: [
                        ['#FFFFFF', 90],
                        ['#4278D2', 45],
                        ['#0055B3', 45],
                        ['#00A1DA', 7.5],
                        ['#008B41', 7.5],
                        ['#F5B400', 7.5],
                        ['#E27520', 7.5],
                        ['#E04A32', 15],
                        ['#EFEFEF', 15],
                        ['#989898', 15],
                        ['#4C4C4C', 30],
                        ['#343434', 30],
                        ['#00B255', 45]
                    ]
                }]
            });
        });
    </script>


</body>