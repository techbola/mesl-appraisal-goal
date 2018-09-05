 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
     <meta charset="utf-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

     
    {{-- <link rel="stylesheet" href="{{ asset('css/printmemo.css') }}" media="screen"> --}}
  </head>
      <body style="font-family:Arial">
    <style>



@import url('app.css');

@page {
    padding: 10px;
    margin: 10px;    
     background: #fff;
}

body {
     background: #fff;
}

* {
    background: #fff;
    font-family: 'Arial', sans-serif;
    font-size: 12px !important;
}



hr {
    margin: 10px 0 !important;
}

.address{
      display: block;
    }

    img{
        position: relative;
        z-index: 999999;
        background: transparent !important;
    }



#bill-box  {
    padding: 20px; 
    border: 1px solid #eee;
    width: 100%;
    border: 1px solid #ddd;
    background: #eee; max-height: 300px
}

table {
    margin-top: 20px;
}


table.dataTable{clear:both;margin-top:6px !important;margin-bottom:6px !important;max-width:none !important}table.dataTable td,table.dataTable th{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}table.dataTable td.dataTables_empty,table.dataTable th.dataTables_empty{text-align:center}table.dataTable.nowrap th,table.dataTable.nowrap td{white-space:nowrap}div.dataTables_wrapper div.dataTables_length label{font-weight:normal;text-align:left;white-space:nowrap}div.dataTables_wrapper div.dataTables_length select{width:75px;display:inline-block}div.dataTables_wrapper div.dataTables_filter{text-align:right}div.dataTables_wrapper div.dataTables_filter label{font-weight:normal;white-space:nowrap;text-align:left}div.dataTables_wrapper div.dataTables_filter input{margin-left:0.5em;display:inline-block;width:auto}div.dataTables_wrapper div.dataTables_info{padding-top:8px;white-space:nowrap}div.dataTables_wrapper div.dataTables_paginate{margin:0;white-space:nowrap;text-align:right}div.dataTables_wrapper div.dataTables_paginate ul.pagination{margin:2px 0;white-space:nowrap}table.dataTable thead>tr>th.sorting_asc,table.dataTable thead>tr>th.sorting_desc,table.dataTable thead>tr>th.sorting,table.dataTable thead>tr>td.sorting_asc,table.dataTable thead>tr>td.sorting_desc,table.dataTable thead>tr>td.sorting{padding-right:30px}table.dataTable thead>tr>th:active,table.dataTable thead>tr>td:active{outline:none}table.dataTable thead .sorting,table.dataTable thead .sorting_asc,table.dataTable thead .sorting_desc,table.dataTable thead .sorting_asc_disabled,table.dataTable thead .sorting_desc_disabled{cursor:pointer;position:relative}table.dataTable thead .sorting:after,table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting_desc:after,table.dataTable thead .sorting_asc_disabled:after,table.dataTable thead .sorting_desc_disabled:after{position:absolute;bottom:8px;right:8px;display:block;font-family:'Glyphicons Halflings';opacity:0.5}table.dataTable thead .sorting:after{opacity:0.2;content:"\e150"}table.dataTable thead .sorting_asc:after{content:"\e155"}table.dataTable thead .sorting_desc:after{content:"\e156"}table.dataTable thead .sorting_asc_disabled:after,table.dataTable thead .sorting_desc_disabled:after{color:#eee}div.dataTables_scrollHead table.dataTable{margin-bottom:0 !important}div.dataTables_scrollBody table{border-top:none;margin-top:0 !important;margin-bottom:0 !important}div.dataTables_scrollBody table thead .sorting:after,div.dataTables_scrollBody table thead .sorting_asc:after,div.dataTables_scrollBody table thead .sorting_desc:after{display:none}div.dataTables_scrollBody table tbody tr:first-child th,div.dataTables_scrollBody table tbody tr:first-child td{border-top:none}div.dataTables_scrollFoot table{margin-top:0 !important;border-top:none}@media screen and (max-width: 767px){div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_paginate{text-align:center}}table.dataTable.table-condensed>thead>tr>th{padding-right:20px}table.dataTable.table-condensed .sorting:after,table.dataTable.table-condensed .sorting_asc:after,table.dataTable.table-condensed .sorting_desc:after{top:6px;right:6px}table.table-bordered.dataTable{border-collapse:separate !important}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-left-width:0}table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable td:last-child{border-right-width:0}table.table-bordered.dataTable tbody th,table.table-bordered.dataTable tbody td{border-bottom-width:0}div.dataTables_scrollHead table.table-bordered{border-bottom-width:0}



/*!
 * Bootstrap v3.3.4 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 *//*! normalize.css v3.0.2 | MIT License | git.io/normalize */html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:700}dfn{font-style:italic}h1{margin:.67em 0;font-size:2em}mark{color:#000;background:#ff0}small{font-size:80%}sub,sup{position:relative;font-size:75%;line-height:0;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{height:0;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}button,input,optgroup,select,textarea{margin:0;font:inherit;color:inherit}button{overflow:visible}button,select{text-transform:none}button,html input[type=button],input[type=reset],input[type=submit]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{padding:0;border:0}input{line-height:normal}input[type=checkbox],input[type=radio]{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:0}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{height:auto}input[type=search]{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;-webkit-appearance:textfield}input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{-webkit-appearance:none}fieldset{padding:.35em .625em .75em;margin:0 2px;border:1px solid silver}legend{padding:0;border:0}textarea{overflow:auto}optgroup{font-weight:700}table{border-spacing:0;border-collapse:collapse}td,th{padding:0}/*! Source: https://github.com/h5bp/html5-boilerplate/blob/master/src/css/main.css */@media print{*,:after,:before{color:#000!important;text-shadow:none!important;background:0 0!important;-webkit-box-shadow:none!important;box-shadow:none!important}a,a:visited{text-decoration:underline}a[href]:after{content:" (" attr(href) ")"}abbr[title]:after{content:" (" attr(title) ")"}a[href^="javascript:"]:after,a[href^="#"]:after{content:""}blockquote,pre{border:1px solid #999;page-break-inside:avoid}thead{display:table-header-group}img,tr{page-break-inside:avoid}img{max-width:100%!important}h2,h3,p{orphans:3;widows:3}h2,h3{page-break-after:avoid}select{background:#fff!important}.navbar{display:none}.btn>.caret,.dropup>.btn>.caret{border-top-color:#000!important}.label{border:1px solid #000}.table{border-collapse:collapse!important}.table td,.table th{background-color:#fff!important}.table-bordered td,.table-bordered th{border:1px solid #ddd!important}}@font-face{font-family:'Glyphicons Halflings';src:url(../fonts/glyphicons-halflings-regular.eot);src:url(../fonts/glyphicons-halflings-regular.eot?#iefix) format('embedded-opentype'),url(../fonts/glyphicons-halflings-regular.woff2) format('woff2'),url(../fonts/glyphicons-halflings-regular.woff) format('woff'),url(../fonts/glyphicons-halflings-regular.ttf) format('truetype'),url(../fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format('svg')}.glyphicon{position:relative;top:1px;display:inline-block;font-family:'Glyphicons Halflings';font-style:normal;font-weight:400;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.glyphicon-asterisk:before{content:"\2a"}.glyphicon-plus:before{content:"\2b"}.glyphicon-eur:before,.glyphicon-euro:before{content:"\20ac"}.glyphicon-minus:before{content:"\2212"}.glyphicon-cloud:before{content:"\2601"}.glyphicon-envelope:before{content:"\2709"}.glyphicon-pencil:before{content:"\270f"}.glyphicon-glass:before{content:"\e001"}.glyphicon-music:before{content:"\e002"}.glyphicon-search:before{content:"\e003"}.glyphicon-heart:before{content:"\e005"}.glyphicon-star:before{content:"\e006"}.glyphicon-star-empty:before{content:"\e007"}.glyphicon-user:before{content:"\e008"}.glyphicon-film:before{content:"\e009"}.glyphicon-th-large:before{content:"\e010"}.glyphicon-th:before{content:"\e011"}.glyphicon-th-list:before{content:"\e012"}.glyphicon-ok:before{content:"\e013"}.glyphicon-remove:before{content:"\e014"}.glyphicon-zoom-in:before{content:"\e015"}.glyphicon-zoom-out:before{content:"\e016"}.glyphicon-off:before{content:"\e017"}.glyphicon-signal:before{content:"\e018"}.glyphicon-cog:before{content:"\e019"}.glyphicon-trash:before{content:"\e020"}.glyphicon-home:before{content:"\e021"}.glyphicon-file:before{content:"\e022"}.glyphicon-time:before{content:"\e023"}.glyphicon-road:before{content:"\e024"}.glyphicon-download-alt:before{content:"\e025"}.glyphicon-download:before{content:"\e026"}.glyphicon-upload:before{content:"\e027"}.glyphicon-inbox:before{content:"\e028"}.glyphicon-play-circle:before{content:"\e029"}.glyphicon-repeat:before{content:"\e030"}.glyphicon-refresh:before{content:"\e031"}.glyphicon-list-alt:before{content:"\e032"}.glyphicon-lock:before{content:"\e033"}.glyphicon-flag:before{content:"\e034"}.glyphicon-headphones:before{content:"\e035"}.glyphicon-volume-off:before{content:"\e036"}.glyphicon-volume-down:before{content:"\e037"}.glyphicon-volume-up:before{content:"\e038"}.glyphicon-qrcode:before{content:"\e039"}.glyphicon-barcode:before{content:"\e040"}.glyphicon-tag:before{content:"\e041"}.glyphicon-tags:before{content:"\e042"}.glyphicon-book:before{content:"\e043"}.glyphicon-bookmark:before{content:"\e044"}.glyphicon-print:before{content:"\e045"}.glyphicon-camera:before{content:"\e046"}.glyphicon-font:before{content:"\e047"}.glyphicon-bold:before{content:"\e048"}.glyphicon-italic:before{content:"\e049"}.glyphicon-text-height:before{content:"\e050"}.glyphicon-text-width:before{content:"\e051"}.glyphicon-align-left:before{content:"\e052"}.glyphicon-align-center:before{content:"\e053"}.glyphicon-align-right:before{content:"\e054"}.glyphicon-align-justify:before{content:"\e055"}.glyphicon-list:before{content:"\e056"}.glyphicon-indent-left:before{content:"\e057"}.glyphicon-indent-right:before{content:"\e058"}.glyphicon-facetime-video:before{content:"\e059"}.glyphicon-picture:before{content:"\e060"}.glyphicon-map-marker:before{content:"\e062"}.glyphicon-adjust:before{content:"\e063"}.glyphicon-tint:before{content:"\e064"}.glyphicon-edit:before{content:"\e065"}.glyphicon-share:before{content:"\e066"}.glyphicon-check:before{content:"\e067"}.glyphicon-move:before{content:"\e068"}.glyphicon-step-backward:before{content:"\e069"}.glyphicon-fast-backward:before{content:"\e070"}.glyphicon-backward:before{content:"\e071"}.glyphicon-play:before{content:"\e072"}.glyphicon-pause:before{content:"\e073"}.glyphicon-stop:before{content:"\e074"}.glyphicon-forward:before{content:"\e075"}.glyphicon-fast-forward:before{content:"\e076"}.glyphicon-step-forward:before{content:"\e077"}.glyphicon-eject:before{content:"\e078"}.glyphicon-chevron-left:before{content:"\e079"}.glyphicon-chevron-right:before{content:"\e080"}.glyphicon-plus-sign:before{content:"\e081"}.glyphicon-minus-sign:before{content:"\e082"}.glyphicon-remove-sign:before{content:"\e083"}.glyphicon-ok-sign:before{content:"\e084"}.glyphicon-question-sign:before{content:"\e085"}.glyphicon-info-sign:before{content:"\e086"}.glyphicon-screenshot:before{content:"\e087"}.glyphicon-remove-circle:before{content:"\e088"}.glyphicon-ok-circle:before{content:"\e089"}.glyphicon-ban-circle:before{content:"\e090"}.glyphicon-arrow-left:before{content:"\e091"}.glyphicon-arrow-right:before{content:"\e092"}.glyphicon-arrow-up:before{content:"\e093"}.glyphicon-arrow-down:before{content:"\e094"}.glyphicon-share-alt:before{content:"\e095"}.glyphicon-resize-full:before{content:"\e096"}.glyphicon-resize-small:before{content:"\e097"}.glyphicon-exclamation-sign:before{content:"\e101"}.glyphicon-gift:before{content:"\e102"}.glyphicon-leaf:before{content:"\e103"}.glyphicon-fire:before{content:"\e104"}.glyphicon-eye-open:before{content:"\e105"}.glyphicon-eye-close:before{content:"\e106"}.glyphicon-warning-sign:before{content:"\e107"}.glyphicon-plane:before{content:"\e108"}.glyphicon-calendar:before{content:"\e109"}.glyphicon-random:before{content:"\e110"}.glyphicon-comment:before{content:"\e111"}.glyphicon-magnet:before{content:"\e112"}.glyphicon-chevron-up:before{content:"\e113"}.glyphicon-chevron-down:before{content:"\e114"}.glyphicon-retweet:before{content:"\e115"}.glyphicon-shopping-cart:before{content:"\e116"}.glyphicon-folder-close:before{content:"\e117"}.glyphicon-folder-open:before{content:"\e118"}.glyphicon-resize-vertical:before{content:"\e119"}.glyphicon-resize-horizontal:before{content:"\e120"}.glyphicon-hdd:before{content:"\e121"}.glyphicon-bullhorn:before{content:"\e122"}.glyphicon-bell:before{content:"\e123"}.glyphicon-certificate:before{content:"\e124"}.glyphicon-thumbs-up:before{content:"\e125"}.glyphicon-thumbs-down:before{content:"\e126"}.glyphicon-hand-right:before{content:"\e127"}.glyphicon-hand-left:before{content:"\e128"}.glyphicon-hand-up:before{content:"\e129"}.glyphicon-hand-down:before{content:"\e130"}.glyphicon-circle-arrow-right:before{content:"\e131"}.glyphicon-circle-arrow-left:before{content:"\e132"}.glyphicon-circle-arrow-up:before{content:"\e133"}.glyphicon-circle-arrow-down:before{content:"\e134"}.glyphicon-globe:before{content:"\e135"}.glyphicon-wrench:before{content:"\e136"}.glyphicon-tasks:before{content:"\e137"}.glyphicon-filter:before{content:"\e138"}.glyphicon-briefcase:before{content:"\e139"}.glyphicon-fullscreen:before{content:"\e140"}.glyphicon-dashboard:before{content:"\e141"}.glyphicon-paperclip:before{content:"\e142"}.glyphicon-heart-empty:before{content:"\e143"}.glyphicon-link:before{content:"\e144"}.glyphicon-phone:before{content:"\e145"}.glyphicon-pushpin:before{content:"\e146"}.glyphicon-usd:before{content:"\e148"}.glyphicon-gbp:before{content:"\e149"}.glyphicon-sort:before{content:"\e150"}.glyphicon-sort-by-alphabet:before{content:"\e151"}.glyphicon-sort-by-alphabet-alt:before{content:"\e152"}.glyphicon-sort-by-order:before{content:"\e153"}.glyphicon-sort-by-order-alt:before{content:"\e154"}.glyphicon-sort-by-attributes:before{content:"\e155"}.glyphicon-sort-by-attributes-alt:before{content:"\e156"}.glyphicon-unchecked:before{content:"\e157"}.glyphicon-expand:before{content:"\e158"}.glyphicon-collapse-down:before{content:"\e159"}.glyphicon-collapse-up:before{content:"\e160"}.glyphicon-log-in:before{content:"\e161"}.glyphicon-flash:before{content:"\e162"}.glyphicon-log-out:before{content:"\e163"}.glyphicon-new-window:before{content:"\e164"}.glyphicon-record:before{content:"\e165"}.glyphicon-save:before{content:"\e166"}.glyphicon-open:before{content:"\e167"}.glyphicon-saved:before{content:"\e168"}.glyphicon-import:before{content:"\e169"}.glyphicon-export:before{content:"\e170"}.glyphicon-send:before{content:"\e171"}.glyphicon-floppy-disk:before{content:"\e172"}.glyphicon-floppy-saved:before{content:"\e173"}.glyphicon-floppy-remove:before{content:"\e174"}.glyphicon-floppy-save:before{content:"\e175"}.glyphicon-floppy-open:before{content:"\e176"}.glyphicon-credit-card:before{content:"\e177"}.glyphicon-transfer:before{content:"\e178"}.glyphicon-cutlery:before{content:"\e179"}.glyphicon-header:before{content:"\e180"}.glyphicon-compressed:before{content:"\e181"}.glyphicon-earphone:before{content:"\e182"}.glyphicon-phone-alt:before{content:"\e183"}.glyphicon-tower:before{content:"\e184"}.glyphicon-stats:before{content:"\e185"}.glyphicon-sd-video:before{content:"\e186"}.glyphicon-hd-video:before{content:"\e187"}.glyphicon-subtitles:before{content:"\e188"}.glyphicon-sound-stereo:before{content:"\e189"}.glyphicon-sound-dolby:before{content:"\e190"}.glyphicon-sound-5-1:before{content:"\e191"}.glyphicon-sound-6-1:before{content:"\e192"}.glyphicon-sound-7-1:before{content:"\e193"}.glyphicon-copyright-mark:before{content:"\e194"}.glyphicon-registration-mark:before{content:"\e195"}.glyphicon-cloud-download:before{content:"\e197"}.glyphicon-cloud-upload:before{content:"\e198"}.glyphicon-tree-conifer:before{content:"\e199"}.glyphicon-tree-deciduous:before{content:"\e200"}.glyphicon-cd:before{content:"\e201"}.glyphicon-save-file:before{content:"\e202"}.glyphicon-open-file:before{content:"\e203"}.glyphicon-level-up:before{content:"\e204"}.glyphicon-copy:before{content:"\e205"}.glyphicon-paste:before{content:"\e206"}.glyphicon-alert:before{content:"\e209"}.glyphicon-equalizer:before{content:"\e210"}.glyphicon-king:before{content:"\e211"}.glyphicon-queen:before{content:"\e212"}.glyphicon-pawn:before{content:"\e213"}.glyphicon-bishop:before{content:"\e214"}.glyphicon-knight:before{content:"\e215"}.glyphicon-baby-formula:before{content:"\e216"}.glyphicon-tent:before{content:"\26fa"}.glyphicon-blackboard:before{content:"\e218"}.glyphicon-bed:before{content:"\e219"}.glyphicon-apple:before{content:"\f8ff"}.glyphicon-erase:before{content:"\e221"}.glyphicon-hourglass:before{content:"\231b"}.glyphicon-lamp:before{content:"\e223"}.glyphicon-duplicate:before{content:"\e224"}.glyphicon-piggy-bank:before{content:"\e225"}.glyphicon-scissors:before{content:"\e226"}.glyphicon-bitcoin:before{content:"\e227"}.glyphicon-btc:before{content:"\e227"}.glyphicon-xbt:before{content:"\e227"}.glyphicon-yen:before{content:"\00a5"}.glyphicon-jpy:before{content:"\00a5"}.glyphicon-ruble:before{content:"\20bd"}.glyphicon-rub:before{content:"\20bd"}.glyphicon-scale:before{content:"\e230"}.glyphicon-ice-lolly:before{content:"\e231"}.glyphicon-ice-lolly-tasted:before{content:"\e232"}.glyphicon-education:before{content:"\e233"}.glyphicon-option-horizontal:before{content:"\e234"}.glyphicon-option-vertical:before{content:"\e235"}.glyphicon-menu-hamburger:before{content:"\e236"}.glyphicon-modal-window:before{content:"\e237"}.glyphicon-oil:before{content:"\e238"}.glyphicon-grain:before{content:"\e239"}.glyphicon-sunglasses:before{content:"\e240"}.glyphicon-text-size:before{content:"\e241"}.glyphicon-text-color:before{content:"\e242"}.glyphicon-text-background:before{content:"\e243"}.glyphicon-object-align-top:before{content:"\e244"}.glyphicon-object-align-bottom:before{content:"\e245"}.glyphicon-object-align-horizontal:before{content:"\e246"}.glyphicon-object-align-left:before{content:"\e247"}.glyphicon-object-align-vertical:before{content:"\e248"}.glyphicon-object-align-right:before{content:"\e249"}.glyphicon-triangle-right:before{content:"\e250"}.glyphicon-triangle-left:before{content:"\e251"}.glyphicon-triangle-bottom:before{content:"\e252"}.glyphicon-triangle-top:before{content:"\e253"}.glyphicon-console:before{content:"\e254"}.glyphicon-superscript:before{content:"\e255"}.glyphicon-subscript:before{content:"\e256"}.glyphicon-menu-left:before{content:"\e257"}.glyphicon-menu-right:before{content:"\e258"}.glyphicon-menu-down:before{content:"\e259"}.glyphicon-menu-up:before{content:"\e260"}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0)}body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}button,input,select,textarea{font-family:inherit;font-size:inherit;line-height:inherit}a{color:#337ab7;text-decoration:none}a:focus,a:hover{color:#23527c;text-decoration:underline}a:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}figure{margin:0}img{vertical-align:middle}.carousel-inner>.item>a>img,.carousel-inner>.item>img,.img-responsive,.thumbnail a>img,.thumbnail>img{display:block;max-width:100%;height:auto}.img-rounded{border-radius:6px}.img-thumbnail{display:inline-block;max-width:100%;height:auto;padding:4px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out}.img-circle{border-radius:50%}hr{margin-top:20px;margin-bottom:20px;border:0;border-top:1px solid #eee}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0}.sr-only-focusable:active,.sr-only-focusable:focus{position:static;width:auto;height:auto;margin:0;overflow:visible;clip:auto}[role=button]{cursor:pointer}.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6{font-family:inherit;font-weight:500;line-height:1.1;color:inherit}.h1 .small,.h1 small,.h2 .small,.h2 small,.h3 .small,.h3 small,.h4 .small,.h4 small,.h5 .small,.h5 small,.h6 .small,.h6 small,h1 .small,h1 small,h2 .small,h2 small,h3 .small,h3 small,h4 .small,h4 small,h5 .small,h5 small,h6 .small,h6 small{font-weight:400;line-height:1;color:#777}.h1,.h2,.h3,h1,h2,h3{margin-top:20px;margin-bottom:10px}.h1 .small,.h1 small,.h2 .small,.h2 small,.h3 .small,.h3 small,h1 .small,h1 small,h2 .small,h2 small,h3 .small,h3 small{font-size:65%}.h4,.h5,.h6,h4,h5,h6{margin-top:10px;margin-bottom:10px}.h4 .small,.h4 small,.h5 .small,.h5 small,.h6 .small,.h6 small,h4 .small,h4 small,h5 .small,h5 small,h6 .small,h6 small{font-size:75%}.h1,h1{font-size:36px}.h2,h2{font-size:30px}.h3,h3{font-size:24px}.h4,h4{font-size:18px}.h5,h5{font-size:14px}.h6,h6{font-size:12px}p{margin:0 0 10px}.lead{margin-bottom:20px;font-size:16px;font-weight:300;line-height:1.4}@media (min-width:768px){.lead{font-size:21px}}.small,small{font-size:85%}.mark,mark{padding:.2em;background-color:#fcf8e3}.text-left{text-align:left}.text-right{text-align:right}.text-center{text-align:center}.text-justify{text-align:justify}.text-nowrap{white-space:nowrap}.text-lowercase{text-transform:lowercase}.text-uppercase{text-transform:uppercase}.text-capitalize{text-transform:capitalize}.text-muted{color:#777}.text-primary{color:#337ab7}a.text-primary:hover{color:#286090}.text-success{color:#3c763d}a.text-success:hover{color:#2b542c}.text-info{color:#31708f}a.text-info:hover{color:#245269}.text-warning{color:#8a6d3b}a.text-warning:hover{color:#66512c}.text-danger{color:#a94442}a.text-danger:hover{color:#843534}.bg-primary{color:#fff;background-color:#337ab7}a.bg-primary:hover{background-color:#286090}.bg-success{background-color:#dff0d8}a.bg-success:hover{background-color:#c1e2b3}.bg-info{background-color:#d9edf7}a.bg-info:hover{background-color:#afd9ee}.bg-warning{background-color:#fcf8e3}a.bg-warning:hover{background-color:#f7ecb5}.bg-danger{background-color:#f2dede}a.bg-danger:hover{background-color:#e4b9b9}.page-header{padding-bottom:9px;margin:40px 0 20px;border-bottom:1px solid #eee}ol,ul{margin-top:0;margin-bottom:10px}ol ol,ol ul,ul ol,ul ul{margin-bottom:0}.list-unstyled{padding-left:0;list-style:none}.list-inline{padding-left:0;margin-left:-5px;list-style:none}.list-inline>li{display:inline-block;padding-right:5px;padding-left:5px}dl{margin-top:0;margin-bottom:20px}dd,dt{line-height:1.42857143}dt{font-weight:700}dd{margin-left:0}@media (min-width:768px){.dl-horizontal dt{float:left;width:160px;overflow:hidden;clear:left;text-align:right;text-overflow:ellipsis;white-space:nowrap}.dl-horizontal dd{margin-left:180px}}abbr[data-original-title],abbr[title]{cursor:help;border-bottom:1px dotted #777}.initialism{font-size:90%;text-transform:uppercase}blockquote{padding:10px 20px;margin:0 0 20px;font-size:17.5px;border-left:5px solid #eee}blockquote ol:last-child,blockquote p:last-child,blockquote ul:last-child{margin-bottom:0}blockquote .small,blockquote footer,blockquote small{display:block;font-size:80%;line-height:1.42857143;color:#777}blockquote .small:before,blockquote footer:before,blockquote small:before{content:'\2014 \00A0'}.blockquote-reverse,blockquote.pull-right{padding-right:15px;padding-left:0;text-align:right;border-right:5px solid #eee;border-left:0}.blockquote-reverse .small:before,.blockquote-reverse footer:before,.blockquote-reverse small:before,blockquote.pull-right .small:before,blockquote.pull-right footer:before,blockquote.pull-right small:before{content:''}.blockquote-reverse .small:after,.blockquote-reverse footer:after,.blockquote-reverse small:after,blockquote.pull-right .small:after,blockquote.pull-right footer:after,blockquote.pull-right small:after{content:'\00A0 \2014'}address{margin-bottom:20px;font-style:normal;line-height:1.42857143}code,kbd,pre,samp{font-family:Menlo,Monaco,Consolas,"Courier New",monospace}code{padding:2px 4px;font-size:90%;color:#c7254e;background-color:#f9f2f4;border-radius:4px}kbd{padding:2px 4px;font-size:90%;color:#fff;background-color:#333;border-radius:3px;-webkit-box-shadow:inset 0 -1px 0 rgba(0,0,0,.25);box-shadow:inset 0 -1px 0 rgba(0,0,0,.25)}kbd kbd{padding:0;font-size:100%;font-weight:700;-webkit-box-shadow:none;box-shadow:none}pre{display:block;padding:9.5px;margin:0 0 10px;font-size:13px;line-height:1.42857143;color:#333;word-break:break-all;word-wrap:break-word;background-color:#f5f5f5;border:1px solid #ccc;border-radius:4px}pre code{padding:0;font-size:inherit;color:inherit;white-space:pre-wrap;background-color:transparent;border-radius:0}.pre-scrollable{max-height:340px;overflow-y:scroll}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:768px){.container{width:750px}}@media (min-width:992px){.container{width:970px}}@media (min-width:1200px){.container{width:1170px}}.container-fluid{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{margin-right:-15px;margin-left:-15px}.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9{float:left}.col-xs-12{width:100%}.col-xs-11{width:91.66666667%}.col-xs-10{width:83.33333333%}.col-xs-9{width:75%}.col-xs-8{width:66.66666667%}.col-xs-7{width:58.33333333%}.col-xs-6{width:50%}.col-xs-5{width:41.66666667%}.col-xs-4{width:33.33333333%}.col-xs-3{width:25%}.col-xs-2{width:16.66666667%}.col-xs-1{width:8.33333333%}.col-xs-pull-12{right:100%}.col-xs-pull-11{right:91.66666667%}.col-xs-pull-10{right:83.33333333%}.col-xs-pull-9{right:75%}.col-xs-pull-8{right:66.66666667%}.col-xs-pull-7{right:58.33333333%}.col-xs-pull-6{right:50%}.col-xs-pull-5{right:41.66666667%}.col-xs-pull-4{right:33.33333333%}.col-xs-pull-3{right:25%}.col-xs-pull-2{right:16.66666667%}.col-xs-pull-1{right:8.33333333%}.col-xs-pull-0{right:auto}.col-xs-push-12{left:100%}.col-xs-push-11{left:91.66666667%}.col-xs-push-10{left:83.33333333%}.col-xs-push-9{left:75%}.col-xs-push-8{left:66.66666667%}.col-xs-push-7{left:58.33333333%}.col-xs-push-6{left:50%}.col-xs-push-5{left:41.66666667%}.col-xs-push-4{left:33.33333333%}.col-xs-push-3{left:25%}.col-xs-push-2{left:16.66666667%}.col-xs-push-1{left:8.33333333%}.col-xs-push-0{left:auto}.col-xs-offset-12{margin-left:100%}.col-xs-offset-11{margin-left:91.66666667%}.col-xs-offset-10{margin-left:83.33333333%}.col-xs-offset-9{margin-left:75%}.col-xs-offset-8{margin-left:66.66666667%}.col-xs-offset-7{margin-left:58.33333333%}.col-xs-offset-6{margin-left:50%}.col-xs-offset-5{margin-left:41.66666667%}.col-xs-offset-4{margin-left:33.33333333%}.col-xs-offset-3{margin-left:25%}.col-xs-offset-2{margin-left:16.66666667%}.col-xs-offset-1{margin-left:8.33333333%}.col-xs-offset-0{margin-left:0}@media (min-width:768px){.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9{float:left}.col-sm-12{width:100%}.col-sm-11{width:91.66666667%}.col-sm-10{width:83.33333333%}.col-sm-9{width:75%}.col-sm-8{width:66.66666667%}.col-sm-7{width:58.33333333%}.col-sm-6{width:50%}.col-sm-5{width:41.66666667%}.col-sm-4{width:33.33333333%}.col-sm-3{width:25%}.col-sm-2{width:16.66666667%}.col-sm-1{width:8.33333333%}.col-sm-pull-12{right:100%}.col-sm-pull-11{right:91.66666667%}.col-sm-pull-10{right:83.33333333%}.col-sm-pull-9{right:75%}.col-sm-pull-8{right:66.66666667%}.col-sm-pull-7{right:58.33333333%}.col-sm-pull-6{right:50%}.col-sm-pull-5{right:41.66666667%}.col-sm-pull-4{right:33.33333333%}.col-sm-pull-3{right:25%}.col-sm-pull-2{right:16.66666667%}.col-sm-pull-1{right:8.33333333%}.col-sm-pull-0{right:auto}.col-sm-push-12{left:100%}.col-sm-push-11{left:91.66666667%}.col-sm-push-10{left:83.33333333%}.col-sm-push-9{left:75%}.col-sm-push-8{left:66.66666667%}.col-sm-push-7{left:58.33333333%}.col-sm-push-6{left:50%}.col-sm-push-5{left:41.66666667%}.col-sm-push-4{left:33.33333333%}.col-sm-push-3{left:25%}.col-sm-push-2{left:16.66666667%}.col-sm-push-1{left:8.33333333%}.col-sm-push-0{left:auto}.col-sm-offset-12{margin-left:100%}.col-sm-offset-11{margin-left:91.66666667%}.col-sm-offset-10{margin-left:83.33333333%}.col-sm-offset-9{margin-left:75%}.col-sm-offset-8{margin-left:66.66666667%}.col-sm-offset-7{margin-left:58.33333333%}.col-sm-offset-6{margin-left:50%}.col-sm-offset-5{margin-left:41.66666667%}.col-sm-offset-4{margin-left:33.33333333%}.col-sm-offset-3{margin-left:25%}.col-sm-offset-2{margin-left:16.66666667%}.col-sm-offset-1{margin-left:8.33333333%}.col-sm-offset-0{margin-left:0}}@media (min-width:992px){.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9{float:left}.col-md-12{width:100%}.col-md-11{width:91.66666667%}.col-md-10{width:83.33333333%}.col-md-9{width:75%}.col-md-8{width:66.66666667%}.col-md-7{width:58.33333333%}.col-md-6{width:50%}.col-md-5{width:41.66666667%}.col-md-4{width:33.33333333%}.col-md-3{width:25%}.col-md-2{width:16.66666667%}.col-md-1{width:8.33333333%}.col-md-pull-12{right:100%}.col-md-pull-11{right:91.66666667%}.col-md-pull-10{right:83.33333333%}.col-md-pull-9{right:75%}.col-md-pull-8{right:66.66666667%}.col-md-pull-7{right:58.33333333%}.col-md-pull-6{right:50%}.col-md-pull-5{right:41.66666667%}.col-md-pull-4{right:33.33333333%}.col-md-pull-3{right:25%}.col-md-pull-2{right:16.66666667%}.col-md-pull-1{right:8.33333333%}.col-md-pull-0{right:auto}.col-md-push-12{left:100%}.col-md-push-11{left:91.66666667%}.col-md-push-10{left:83.33333333%}.col-md-push-9{left:75%}.col-md-push-8{left:66.66666667%}.col-md-push-7{left:58.33333333%}.col-md-push-6{left:50%}.col-md-push-5{left:41.66666667%}.col-md-push-4{left:33.33333333%}.col-md-push-3{left:25%}.col-md-push-2{left:16.66666667%}.col-md-push-1{left:8.33333333%}.col-md-push-0{left:auto}.col-md-offset-12{margin-left:100%}.col-md-offset-11{margin-left:91.66666667%}.col-md-offset-10{margin-left:83.33333333%}.col-md-offset-9{margin-left:75%}.col-md-offset-8{margin-left:66.66666667%}.col-md-offset-7{margin-left:58.33333333%}.col-md-offset-6{margin-left:50%}.col-md-offset-5{margin-left:41.66666667%}.col-md-offset-4{margin-left:33.33333333%}.col-md-offset-3{margin-left:25%}.col-md-offset-2{margin-left:16.66666667%}.col-md-offset-1{margin-left:8.33333333%}.col-md-offset-0{margin-left:0}}@media (min-width:1200px){.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9{float:left}.col-lg-12{width:100%}.col-lg-11{width:91.66666667%}.col-lg-10{width:83.33333333%}.col-lg-9{width:75%}.col-lg-8{width:66.66666667%}.col-lg-7{width:58.33333333%}.col-lg-6{width:50%}.col-lg-5{width:41.66666667%}.col-lg-4{width:33.33333333%}.col-lg-3{width:25%}.col-lg-2{width:16.66666667%}.col-lg-1{width:8.33333333%}.col-lg-pull-12{right:100%}.col-lg-pull-11{right:91.66666667%}.col-lg-pull-10{right:83.33333333%}.col-lg-pull-9{right:75%}.col-lg-pull-8{right:66.66666667%}.col-lg-pull-7{right:58.33333333%}.col-lg-pull-6{right:50%}.col-lg-pull-5{right:41.66666667%}.col-lg-pull-4{right:33.33333333%}.col-lg-pull-3{right:25%}.col-lg-pull-2{right:16.66666667%}.col-lg-pull-1{right:8.33333333%}.col-lg-pull-0{right:auto}.col-lg-push-12{left:100%}.col-lg-push-11{left:91.66666667%}.col-lg-push-10{left:83.33333333%}.col-lg-push-9{left:75%}.col-lg-push-8{left:66.66666667%}.col-lg-push-7{left:58.33333333%}.col-lg-push-6{left:50%}.col-lg-push-5{left:41.66666667%}.col-lg-push-4{left:33.33333333%}.col-lg-push-3{left:25%}.col-lg-push-2{left:16.66666667%}.col-lg-push-1{left:8.33333333%}.col-lg-push-0{left:auto}.col-lg-offset-12{margin-left:100%}.col-lg-offset-11{margin-left:91.66666667%}.col-lg-offset-10{margin-left:83.33333333%}.col-lg-offset-9{margin-left:75%}.col-lg-offset-8{margin-left:66.66666667%}.col-lg-offset-7{margin-left:58.33333333%}.col-lg-offset-6{margin-left:50%}.col-lg-offset-5{margin-left:41.66666667%}.col-lg-offset-4{margin-left:33.33333333%}.col-lg-offset-3{margin-left:25%}.col-lg-offset-2{margin-left:16.66666667%}.col-lg-offset-1{margin-left:8.33333333%}.col-lg-offset-0{margin-left:0}}table{background-color:transparent}caption{padding-top:8px;padding-bottom:8px;color:#777;text-align:left}th{text-align:left}.table{width:100%;max-width:100%;margin-bottom:20px}.table>tbody>tr>td,.table>tbody>tr>th,.table>tfoot>tr>td,.table>tfoot>tr>th,.table>thead>tr>td,.table>thead>tr>th{padding:8px;line-height:1.42857143;vertical-align:top;border-top:1px solid #ddd}.table>thead>tr>th{vertical-align:bottom;border-bottom:2px solid #ddd}.table>caption+thead>tr:first-child>td,.table>caption+thead>tr:first-child>th,.table>colgroup+thead>tr:first-child>td,.table>colgroup+thead>tr:first-child>th,.table>thead:first-child>tr:first-child>td,.table>thead:first-child>tr:first-child>th{border-top:0}.table>tbody+tbody{border-top:2px solid #ddd}.table .table{background-color:#fff}.table-condensed>tbody>tr>td,.table-condensed>tbody>tr>th,.table-condensed>tfoot>tr>td,.table-condensed>tfoot>tr>th,.table-condensed>thead>tr>td,.table-condensed>thead>tr>th{padding:5px}.table-bordered{border:1px solid #ddd}.table-bordered>tbody>tr>td,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>td,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>thead>tr>th{border:1px solid #ddd}.table-bordered>thead>tr>td,.table-bordered>thead>tr>th{border-bottom-width:2px}.table-striped>tbody>tr:nth-of-type(odd){background-color:#f9f9f9}.table-hover>tbody>tr:hover{background-color:#f5f5f5}table col[class*=col-]{position:static;display:table-column;float:none}table td[class*=col-],table th[class*=col-]{position:static;display:table-cell;float:none}.table>tbody>tr.active>td,.table>tbody>tr.active>th,.table>tbody>tr>td.active,.table>tbody>tr>th.active,.table>tfoot>tr.active>td,.table>tfoot>tr.active>th,.table>tfoot>tr>td.active,.table>tfoot>tr>th.active,.table>thead>tr.active>td,.table>thead>tr.active>th,.table>thead>tr>td.active,.table>thead>tr>th.active{background-color:#f5f5f5}.table-hover>tbody>tr.active:hover>td,.table-hover>tbody>tr.active:hover>th,.table-hover>tbody>tr:hover>.active,.table-hover>tbody>tr>td.active:hover,.table-hover>tbody>tr>th.active:hover{background-color:#e8e8e8}.table>tbody>tr.success>td,.table>tbody>tr.success>th,.table>tbody>tr>td.success,.table>tbody>tr>th.success,.table>tfoot>tr.success>td,.table>tfoot>tr.success>th,.table>tfoot>tr>td.success,.table>tfoot>tr>th.success,.table>thead>tr.success>td,.table>thead>tr.success>th,.table>thead>tr>td.success,.table>thead>tr>th.success{background-color:#dff0d8}.table-hover>tbody>tr.success:hover>td,.table-hover>tbody>tr.success:hover>th,.table-hover>tbody>tr:hover>.success,.table-hover>tbody>tr>td.success:hover,.table-hover>tbody>tr>th.success:hover{background-color:#d0e9c6}.table>tbody>tr.info>td,.table>tbody>tr.info>th,.table>tbody>tr>td.info,.table>tbody>tr>th.info,.table>tfoot>tr.info>td,.table>tfoot>tr.info>th,.table>tfoot>tr>td.info,.table>tfoot>tr>th.info,.table>thead>tr.info>td,.table>thead>tr.info>th,.table>thead>tr>td.info,.table>thead>tr>th.info{background-color:#d9edf7}.table-hover>tbody>tr.info:hover>td,.table-hover>tbody>tr.info:hover>th,.table-hover>tbody>tr:hover>.info,.table-hover>tbody>tr>td.info:hover,.table-hover>tbody>tr>th.info:hover{background-color:#c4e3f3}.table>tbody>tr.warning>td,.table>tbody>tr.warning>th,.table>tbody>tr>td.warning,.table>tbody>tr>th.warning,.table>tfoot>tr.warning>td,.table>tfoot>tr.warning>th,.table>tfoot>tr>td.warning,.table>tfoot>tr>th.warning,.table>thead>tr.warning>td,.table>thead>tr.warning>th,.table>thead>tr>td.warning,.table>thead>tr>th.warning{background-color:#fcf8e3}.table-hover>tbody>tr.warning:hover>td,.table-hover>tbody>tr.warning:hover>th,.table-hover>tbody>tr:hover>.warning,.table-hover>tbody>tr>td.warning:hover,.table-hover>tbody>tr>th.warning:hover{background-color:#faf2cc}.table>tbody>tr.danger>td,.table>tbody>tr.danger>th,.table>tbody>tr>td.danger,.table>tbody>tr>th.danger,.table>tfoot>tr.danger>td,.table>tfoot>tr.danger>th,.table>tfoot>tr>td.danger,.table>tfoot>tr>th.danger,.table>thead>tr.danger>td,.table>thead>tr.danger>th,.table>thead>tr>td.danger,.table>thead>tr>th.danger{background-color:#f2dede}.table-hover>tbody>tr.danger:hover>td,.table-hover>tbody>tr.danger:hover>th,.table-hover>tbody>tr:hover>.danger,.table-hover>tbody>tr>td.danger:hover,.table-hover>tbody>tr>th.danger:hover{background-color:#ebcccc}.table-responsive{min-height:.01%;overflow-x:auto}@media screen and (max-width:767px){.table-responsive{width:100%;margin-bottom:15px;overflow-y:hidden;-ms-overflow-style:-ms-autohiding-scrollbar;border:1px solid #ddd}.table-responsive>.table{margin-bottom:0}.table-responsive>.table>tbody>tr>td,.table-responsive>.table>tbody>tr>th,.table-responsive>.table>tfoot>tr>td,.table-responsive>.table>tfoot>tr>th,.table-responsive>.table>thead>tr>td,.table-responsive>.table>thead>tr>th{white-space:nowrap}.table-responsive>.table-bordered{border:0}.table-responsive>.table-bordered>tbody>tr>td:first-child,.table-responsive>.table-bordered>tbody>tr>th:first-child,.table-responsive>.table-bordered>tfoot>tr>td:first-child,.table-responsive>.table-bordered>tfoot>tr>th:first-child,.table-responsive>.table-bordered>thead>tr>td:first-child,.table-responsive>.table-bordered>thead>tr>th:first-child{border-left:0}.table-responsive>.table-bordered>tbody>tr>td:last-child,.table-responsive>.table-bordered>tbody>tr>th:last-child,.table-responsive>.table-bordered>tfoot>tr>td:last-child,.table-responsive>.table-bordered>tfoot>tr>th:last-child,.table-responsive>.table-bordered>thead>tr>td:last-child,.table-responsive>.table-bordered>thead>tr>th:last-child{border-right:0}.table-responsive>.table-bordered>tbody>tr:last-child>td,.table-responsive>.table-bordered>tbody>tr:last-child>th,.table-responsive>.table-bordered>tfoot>tr:last-child>td,.table-responsive>.table-bordered>tfoot>tr:last-child>th{border-bottom:0}}fieldset{min-width:0;padding:0;margin:0;border:0}legend{display:block;width:100%;padding:0;margin-bottom:20px;font-size:21px;line-height:inherit;color:#333;border:0;border-bottom:1px solid #e5e5e5}label{display:inline-block;max-width:100%;margin-bottom:5px;font-weight:700}input[type=search]{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}input[type=checkbox],input[type=radio]{margin:4px 0 0;margin-top:1px \9;line-height:normal}input[type=file]{display:block}input[type=range]{display:block;width:100%}select[multiple],select[size]{height:auto}input[type=file]:focus,input[type=checkbox]:focus,input[type=radio]:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}output{display:block;padding-top:7px;font-size:14px;line-height:1.42857143;color:#555}.form-control{display:block;width:100%;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}.form-control:focus{border-color:#66afe9;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)}.form-control::-moz-placeholder{color:#999;opacity:1}.form-control:-ms-input-placeholder{color:#999}.form-control::-webkit-input-placeholder{color:#999}.form-control[disabled],.form-control[readonly],fieldset[disabled] .form-control{background-color:#eee;opacity:1}.form-control[disabled],fieldset[disabled] .form-control{cursor:not-allowed}textarea.form-control{height:auto}input[type=search]{-webkit-appearance:none}@media screen and (-webkit-min-device-pixel-ratio:0){input[type=date],input[type=time],input[type=datetime-local],input[type=month]{line-height:34px}.input-group-sm input[type=date],.input-group-sm input[type=time],.input-group-sm input[type=datetime-local],.input-group-sm input[type=month],input[type=date].input-sm,input[type=time].input-sm,input[type=datetime-local].input-sm,input[type=month].input-sm{line-height:30px}.input-group-lg input[type=date],.input-group-lg input[type=time],.input-group-lg input[type=datetime-local],.input-group-lg input[type=month],input[type=date].input-lg,input[type=time].input-lg,input[type=datetime-local].input-lg,input[type=month].input-lg{line-height:46px}}.form-group{margin-bottom:15px}.checkbox,.radio{position:relative;display:block;margin-top:10px;margin-bottom:10px}.checkbox label,.radio label{min-height:20px;padding-left:20px;margin-bottom:0;font-weight:400;cursor:pointer}.checkbox input[type=checkbox],.checkbox-inline input[type=checkbox],.radio input[type=radio],.radio-inline input[type=radio]{position:absolute;margin-top:4px \9;margin-left:-20px}.checkbox+.checkbox,.radio+.radio{margin-top:-5px}.checkbox-inline,.radio-inline{position:relative;display:inline-block;padding-left:20px;margin-bottom:0;font-weight:400;vertical-align:middle;cursor:pointer}.checkbox-inline+.checkbox-inline,.radio-inline+.radio-inline{margin-top:0;margin-left:10px}fieldset[disabled] input[type=checkbox],fieldset[disabled] input[type=radio],input[type=checkbox].disabled,input[type=checkbox][disabled],input[type=radio].disabled,input[type=radio][disabled]{cursor:not-allowed}.checkbox-inline.disabled,.radio-inline.disabled,fieldset[disabled] .checkbox-inline,fieldset[disabled] .radio-inline{cursor:not-allowed}.checkbox.disabled label,.radio.disabled label,fieldset[disabled] .checkbox label,fieldset[disabled] .radio label{cursor:not-allowed}.form-control-static{min-height:34px;padding-top:7px;padding-bottom:7px;margin-bottom:0}.form-control-static.input-lg,.form-control-static.input-sm{padding-right:0;padding-left:0}.input-sm{height:30px;padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}select.input-sm{height:30px;line-height:30px}select[multiple].input-sm,textarea.input-sm{height:auto}.form-group-sm .form-control{height:30px;padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}select.form-group-sm .form-control{height:30px;line-height:30px}select[multiple].form-group-sm .form-control,textarea.form-group-sm .form-control{height:auto}.form-group-sm .form-control-static{height:30px;min-height:32px;padding:5px 10px;font-size:12px;line-height:1.5}.input-lg{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}select.input-lg{height:46px;line-height:46px}select[multiple].input-lg,textarea.input-lg{height:auto}.form-group-lg .form-control{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}select.form-group-lg .form-control{height:46px;line-height:46px}select[multiple].form-group-lg .form-control,textarea.form-group-lg .form-control{height:auto}.form-group-lg .form-control-static{height:46px;min-height:38px;padding:10px 16px;font-size:18px;line-height:1.3333333}.has-feedback{position:relative}.has-feedback .form-control{padding-right:42.5px}.form-control-feedback{position:absolute;top:0;right:0;z-index:2;display:block;width:34px;height:34px;line-height:34px;text-align:center;pointer-events:none}.input-lg+.form-control-feedback{width:46px;height:46px;line-height:46px}.input-sm+.form-control-feedback{width:30px;height:30px;line-height:30px}.has-success .checkbox,.has-success .checkbox-inline,.has-success .control-label,.has-success .help-block,.has-success .radio,.has-success .radio-inline,.has-success.checkbox label,.has-success.checkbox-inline label,.has-success.radio label,.has-success.radio-inline label{color:#3c763d}.has-success .form-control{border-color:#3c763d;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075)}.has-success .form-control:focus{border-color:#2b542c;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #67b168;box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #67b168}.has-success .input-group-addon{color:#3c763d;background-color:#dff0d8;border-color:#3c763d}.has-success .form-control-feedback{color:#3c763d}.has-warning .checkbox,.has-warning .checkbox-inline,.has-warning .control-label,.has-warning .help-block,.has-warning .radio,.has-warning .radio-inline,.has-warning.checkbox label,.has-warning.checkbox-inline label,.has-warning.radio label,.has-warning.radio-inline label{color:#8a6d3b}.has-warning .form-control{border-color:#8a6d3b;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075)}.has-warning .form-control:focus{border-color:#66512c;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #c0a16b;box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #c0a16b}.has-warning .input-group-addon{color:#8a6d3b;background-color:#fcf8e3;border-color:#8a6d3b}.has-warning .form-control-feedback{color:#8a6d3b}.has-error .checkbox,.has-error .checkbox-inline,.has-error .control-label,.has-error .help-block,.has-error .radio,.has-error .radio-inline,.has-error.checkbox label,.has-error.checkbox-inline label,.has-error.radio label,.has-error.radio-inline label{color:#a94442}.has-error .form-control{border-color:#a94442;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075)}.has-error .form-control:focus{border-color:#843534;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483;box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483}.has-error .input-group-addon{color:#a94442;background-color:#f2dede;border-color:#a94442}.has-error .form-control-feedback{color:#a94442}.has-feedback label~.form-control-feedback{top:25px}.has-feedback label.sr-only~.form-control-feedback{top:0}.help-block{display:block;margin-top:5px;margin-bottom:10px;color:#737373}@media (min-width:768px){.form-inline .form-group{display:inline-block;margin-bottom:0;vertical-align:middle}.form-inline .form-control{display:inline-block;width:auto;vertical-align:middle}.form-inline .form-control-static{display:inline-block}.form-inline .input-group{display:inline-table;vertical-align:middle}.form-inline .input-group .form-control,.form-inline .input-group .input-group-addon,.form-inline .input-group .input-group-btn{width:auto}.form-inline .input-group>.form-control{width:100%}.form-inline .control-label{margin-bottom:0;vertical-align:middle}.form-inline .checkbox,.form-inline .radio{display:inline-block;margin-top:0;margin-bottom:0;vertical-align:middle}.form-inline .checkbox label,.form-inline .radio label{padding-left:0}.form-inline .checkbox input[type=checkbox],.form-inline .radio input[type=radio]{position:relative;margin-left:0}.form-inline .has-feedback .form-control-feedback{top:0}}.form-horizontal .checkbox,.form-horizontal .checkbox-inline,.form-horizontal .radio,.form-horizontal .radio-inline{padding-top:7px;margin-top:0;margin-bottom:0}.form-horizontal .checkbox,.form-horizontal .radio{min-height:27px}.form-horizontal .form-group{margin-right:-15px;margin-left:-15px}@media (min-width:768px){.form-horizontal .control-label{padding-top:7px;margin-bottom:0;text-align:right}}.form-horizontal .has-feedback .form-control-feedback{right:15px}@media (min-width:768px){.form-horizontal .form-group-lg .control-label{padding-top:14.33px}}@media (min-width:768px){.form-horizontal .form-group-sm .control-label{padding-top:6px}}.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px}.btn.active.focus,.btn.active:focus,.btn.focus,.btn:active.focus,.btn:active:focus,.btn:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}.btn.focus,.btn:focus,.btn:hover{color:#333;text-decoration:none}.btn.active,.btn:active{background-image:none;outline:0;-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);box-shadow:inset 0 3px 5px rgba(0,0,0,.125)}.btn.disabled,.btn[disabled],fieldset[disabled] .btn{pointer-events:none;cursor:not-allowed;filter:alpha(opacity=65);-webkit-box-shadow:none;box-shadow:none;opacity:.65}.btn-default{color:#333;background-color:#fff;border-color:#ccc}.btn-default.active,.btn-default.focus,.btn-default:active,.btn-default:focus,.btn-default:hover,.open>.dropdown-toggle.btn-default{color:#333;background-color:#e6e6e6;border-color:#adadad}.btn-default.active,.btn-default:active,.open>.dropdown-toggle.btn-default{background-image:none}.btn-default.disabled,.btn-default.disabled.active,.btn-default.disabled.focus,.btn-default.disabled:active,.btn-default.disabled:focus,.btn-default.disabled:hover,.btn-default[disabled],.btn-default[disabled].active,.btn-default[disabled].focus,.btn-default[disabled]:active,.btn-default[disabled]:focus,.btn-default[disabled]:hover,fieldset[disabled] .btn-default,fieldset[disabled] .btn-default.active,fieldset[disabled] .btn-default.focus,fieldset[disabled] .btn-default:active,fieldset[disabled] .btn-default:focus,fieldset[disabled] .btn-default:hover{background-color:#fff;border-color:#ccc}.btn-default .badge{color:#fff;background-color:#333}.btn-primary{color:#fff;background-color:#337ab7;border-color:#2e6da4}.btn-primary.active,.btn-primary.focus,.btn-primary:active,.btn-primary:focus,.btn-primary:hover,.open>.dropdown-toggle.btn-primary{color:#fff;background-color:#286090;border-color:#204d74}.btn-primary.active,.btn-primary:active,.open>.dropdown-toggle.btn-primary{background-image:none}.btn-primary.disabled,.btn-primary.disabled.active,.btn-primary.disabled.focus,.btn-primary.disabled:active,.btn-primary.disabled:focus,.btn-primary.disabled:hover,.btn-primary[disabled],.btn-primary[disabled].active,.btn-primary[disabled].focus,.btn-primary[disabled]:active,.btn-primary[disabled]:focus,.btn-primary[disabled]:hover,fieldset[disabled] .btn-primary,fieldset[disabled] .btn-primary.active,fieldset[disabled] .btn-primary.focus,fieldset[disabled] .btn-primary:active,fieldset[disabled] .btn-primary:focus,fieldset[disabled] .btn-primary:hover{background-color:#337ab7;border-color:#2e6da4}.btn-primary .badge{color:#337ab7;background-color:#fff}.btn-success{color:#fff;background-color:#5cb85c;border-color:#4cae4c}.btn-success.active,.btn-success.focus,.btn-success:active,.btn-success:focus,.btn-success:hover,.open>.dropdown-toggle.btn-success{color:#fff;background-color:#449d44;border-color:#398439}.btn-success.active,.btn-success:active,.open>.dropdown-toggle.btn-success{background-image:none}.btn-success.disabled,.btn-success.disabled.active,.btn-success.disabled.focus,.btn-success.disabled:active,.btn-success.disabled:focus,.btn-success.disabled:hover,.btn-success[disabled],.btn-success[disabled].active,.btn-success[disabled].focus,.btn-success[disabled]:active,.btn-success[disabled]:focus,.btn-success[disabled]:hover,fieldset[disabled] .btn-success,fieldset[disabled] .btn-success.active,fieldset[disabled] .btn-success.focus,fieldset[disabled] .btn-success:active,fieldset[disabled] .btn-success:focus,fieldset[disabled] .btn-success:hover{background-color:#5cb85c;border-color:#4cae4c}.btn-success .badge{color:#5cb85c;background-color:#fff}.btn-info{color:#fff;background-color:#5bc0de;border-color:#46b8da}.btn-info.active,.btn-info.focus,.btn-info:active,.btn-info:focus,.btn-info:hover,.open>.dropdown-toggle.btn-info{color:#fff;background-color:#31b0d5;border-color:#269abc}.btn-info.active,.btn-info:active,.open>.dropdown-toggle.btn-info{background-image:none}.btn-info.disabled,.btn-info.disabled.active,.btn-info.disabled.focus,.btn-info.disabled:active,.btn-info.disabled:focus,.btn-info.disabled:hover,.btn-info[disabled],.btn-info[disabled].active,.btn-info[disabled].focus,.btn-info[disabled]:active,.btn-info[disabled]:focus,.btn-info[disabled]:hover,fieldset[disabled] .btn-info,fieldset[disabled] .btn-info.active,fieldset[disabled] .btn-info.focus,fieldset[disabled] .btn-info:active,fieldset[disabled] .btn-info:focus,fieldset[disabled] .btn-info:hover{background-color:#5bc0de;border-color:#46b8da}.btn-info .badge{color:#5bc0de;background-color:#fff}.btn-warning{color:#fff;background-color:#f0ad4e;border-color:#eea236}.btn-warning.active,.btn-warning.focus,.btn-warning:active,.btn-warning:focus,.btn-warning:hover,.open>.dropdown-toggle.btn-warning{color:#fff;background-color:#ec971f;border-color:#d58512}.btn-warning.active,.btn-warning:active,.open>.dropdown-toggle.btn-warning{background-image:none}.btn-warning.disabled,.btn-warning.disabled.active,.btn-warning.disabled.focus,.btn-warning.disabled:active,.btn-warning.disabled:focus,.btn-warning.disabled:hover,.btn-warning[disabled],.btn-warning[disabled].active,.btn-warning[disabled].focus,.btn-warning[disabled]:active,.btn-warning[disabled]:focus,.btn-warning[disabled]:hover,fieldset[disabled] .btn-warning,fieldset[disabled] .btn-warning.active,fieldset[disabled] .btn-warning.focus,fieldset[disabled] .btn-warning:active,fieldset[disabled] .btn-warning:focus,fieldset[disabled] .btn-warning:hover{background-color:#f0ad4e;border-color:#eea236}.btn-warning .badge{color:#f0ad4e;background-color:#fff}.btn-danger{color:#fff;background-color:#d9534f;border-color:#d43f3a}.btn-danger.active,.btn-danger.focus,.btn-danger:active,.btn-danger:focus,.btn-danger:hover,.open>.dropdown-toggle.btn-danger{color:#fff;background-color:#c9302c;border-color:#ac2925}.btn-danger.active,.btn-danger:active,.open>.dropdown-toggle.btn-danger{background-image:none}.btn-danger.disabled,.btn-danger.disabled.active,.btn-danger.disabled.focus,.btn-danger.disabled:active,.btn-danger.disabled:focus,.btn-danger.disabled:hover,.btn-danger[disabled],.btn-danger[disabled].active,.btn-danger[disabled].focus,.btn-danger[disabled]:active,.btn-danger[disabled]:focus,.btn-danger[disabled]:hover,fieldset[disabled] .btn-danger,fieldset[disabled] .btn-danger.active,fieldset[disabled] .btn-danger.focus,fieldset[disabled] .btn-danger:active,fieldset[disabled] .btn-danger:focus,fieldset[disabled] .btn-danger:hover{background-color:#d9534f;border-color:#d43f3a}.btn-danger .badge{color:#d9534f;background-color:#fff}.btn-link{font-weight:400;color:#337ab7;border-radius:0}.btn-link,.btn-link.active,.btn-link:active,.btn-link[disabled],fieldset[disabled] .btn-link{background-color:transparent;-webkit-box-shadow:none;box-shadow:none}.btn-link,.btn-link:active,.btn-link:focus,.btn-link:hover{border-color:transparent}.btn-link:focus,.btn-link:hover{color:#23527c;text-decoration:underline;background-color:transparent}.btn-link[disabled]:focus,.btn-link[disabled]:hover,fieldset[disabled] .btn-link:focus,fieldset[disabled] .btn-link:hover{color:#777;text-decoration:none}.btn-group-lg>.btn,.btn-lg{padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}.btn-group-sm>.btn,.btn-sm{padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}.btn-group-xs>.btn,.btn-xs{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}.btn-block{display:block;width:100%}.btn-block+.btn-block{margin-top:5px}input[type=button].btn-block,input[type=reset].btn-block,input[type=submit].btn-block{width:100%}.fade{opacity:0;-webkit-transition:opacity .15s linear;-o-transition:opacity .15s linear;transition:opacity .15s linear}.fade.in{opacity:1}.collapse{display:none}.collapse.in{display:block}tr.collapse.in{display:table-row}tbody.collapse.in{display:table-row-group}.collapsing{position:relative;height:0;overflow:hidden;-webkit-transition-timing-function:ease;-o-transition-timing-function:ease;transition-timing-function:ease;-webkit-transition-duration:.35s;-o-transition-duration:.35s;transition-duration:.35s;-webkit-transition-property:height,visibility;-o-transition-property:height,visibility;transition-property:height,visibility}.caret{display:inline-block;width:0;height:0;margin-left:2px;vertical-align:middle;border-top:4px dashed;border-right:4px solid transparent;border-left:4px solid transparent}.dropdown,.dropup{position:relative}.dropdown-toggle:focus{outline:0}.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:160px;padding:5px 0;margin:2px 0 0;font-size:14px;text-align:left;list-style:none;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.15);border-radius:4px;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);box-shadow:0 6px 12px rgba(0,0,0,.175)}.dropdown-menu.pull-right{right:0;left:auto}.dropdown-menu .divider{height:1px;margin:9px 0;overflow:hidden;background-color:#e5e5e5}.dropdown-menu>li>a{display:block;padding:3px 20px;clear:both;font-weight:400;line-height:1.42857143;color:#333;white-space:nowrap}.dropdown-menu>li>a:focus,.dropdown-menu>li>a:hover{color:#262626;text-decoration:none;background-color:#f5f5f5}.dropdown-menu>.active>a,.dropdown-menu>.active>a:focus,.dropdown-menu>.active>a:hover{color:#fff;text-decoration:none;background-color:#337ab7;outline:0}.dropdown-menu>.disabled>a,.dropdown-menu>.disabled>a:focus,.dropdown-menu>.disabled>a:hover{color:#777}.dropdown-menu>.disabled>a:focus,.dropdown-menu>.disabled>a:hover{text-decoration:none;cursor:not-allowed;background-color:transparent;background-image:none;filter:progid:DXImageTransform.Microsoft.gradient(enabled=false)}.open>.dropdown-menu{display:block}.open>a{outline:0}.dropdown-menu-right{right:0;left:auto}.dropdown-menu-left{right:auto;left:0}.dropdown-header{display:block;padding:3px 20px;font-size:12px;line-height:1.42857143;color:#777;white-space:nowrap}.dropdown-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:990}.pull-right>.dropdown-menu{right:0;left:auto}.dropup .caret,.navbar-fixed-bottom .dropdown .caret{content:"";border-top:0;border-bottom:4px solid}.dropup .dropdown-menu,.navbar-fixed-bottom .dropdown .dropdown-menu{top:auto;bottom:100%;margin-bottom:2px}@media (min-width:768px){.navbar-right .dropdown-menu{right:0;left:auto}.navbar-right .dropdown-menu-left{right:auto;left:0}}.btn-group,.btn-group-vertical{position:relative;display:inline-block;vertical-align:middle}.btn-group-vertical>.btn,.btn-group>.btn{position:relative;float:left}.btn-group-vertical>.btn.active,.btn-group-vertical>.btn:active,.btn-group-vertical>.btn:focus,.btn-group-vertical>.btn:hover,.btn-group>.btn.active,.btn-group>.btn:active,.btn-group>.btn:focus,.btn-group>.btn:hover{z-index:2}.btn-group .btn+.btn,.btn-group .btn+.btn-group,.btn-group .btn-group+.btn,.btn-group .btn-group+.btn-group{margin-left:-1px}.btn-toolbar{margin-left:-5px}.btn-toolbar .btn-group,.btn-toolbar .input-group{float:left}.btn-toolbar>.btn,.btn-toolbar>.btn-group,.btn-toolbar>.input-group{margin-left:5px}.btn-group>.btn:not(:first-child):not(:last-child):not(.dropdown-toggle){border-radius:0}.btn-group>.btn:first-child{margin-left:0}.btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.btn-group>.btn:last-child:not(:first-child),.btn-group>.dropdown-toggle:not(:first-child){border-top-left-radius:0;border-bottom-left-radius:0}.btn-group>.btn-group{float:left}.btn-group>.btn-group:not(:first-child):not(:last-child)>.btn{border-radius:0}.btn-group>.btn-group:first-child:not(:last-child)>.btn:last-child,.btn-group>.btn-group:first-child:not(:last-child)>.dropdown-toggle{border-top-right-radius:0;border-bottom-right-radius:0}.btn-group>.btn-group:last-child:not(:first-child)>.btn:first-child{border-top-left-radius:0;border-bottom-left-radius:0}.btn-group .dropdown-toggle:active,.btn-group.open .dropdown-toggle{outline:0}.btn-group>.btn+.dropdown-toggle{padding-right:8px;padding-left:8px}.btn-group>.btn-lg+.dropdown-toggle{padding-right:12px;padding-left:12px}.btn-group.open .dropdown-toggle{-webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);box-shadow:inset 0 3px 5px rgba(0,0,0,.125)}.btn-group.open .dropdown-toggle.btn-link{-webkit-box-shadow:none;box-shadow:none}.btn .caret{margin-left:0}.btn-lg .caret{border-width:5px 5px 0;border-bottom-width:0}.dropup .btn-lg .caret{border-width:0 5px 5px}.btn-group-vertical>.btn,.btn-group-vertical>.btn-group,.btn-group-vertical>.btn-group>.btn{display:block;float:none;width:100%;max-width:100%}.btn-group-vertical>.btn-group>.btn{float:none}.btn-group-vertical>.btn+.btn,.btn-group-vertical>.btn+.btn-group,.btn-group-vertical>.btn-group+.btn,.btn-group-vertical>.btn-group+.btn-group{margin-top:-1px;margin-left:0}.btn-group-vertical>.btn:not(:first-child):not(:last-child){border-radius:0}.btn-group-vertical>.btn:first-child:not(:last-child){border-top-right-radius:4px;border-bottom-right-radius:0;border-bottom-left-radius:0}.btn-group-vertical>.btn:last-child:not(:first-child){border-top-left-radius:0;border-top-right-radius:0;border-bottom-left-radius:4px}.btn-group-vertical>.btn-group:not(:first-child):not(:last-child)>.btn{border-radius:0}.btn-group-vertical>.btn-group:first-child:not(:last-child)>.btn:last-child,.btn-group-vertical>.btn-group:first-child:not(:last-child)>.dropdown-toggle{border-bottom-right-radius:0;border-bottom-left-radius:0}.btn-group-vertical>.btn-group:last-child:not(:first-child)>.btn:first-child{border-top-left-radius:0;border-top-right-radius:0}.btn-group-justified{display:table;width:100%;table-layout:fixed;border-collapse:separate}.btn-group-justified>.btn,.btn-group-justified>.btn-group{display:table-cell;float:none;width:1%}.btn-group-justified>.btn-group .btn{width:100%}.btn-group-justified>.btn-group .dropdown-menu{left:auto}[data-toggle=buttons]>.btn input[type=checkbox],[data-toggle=buttons]>.btn input[type=radio],[data-toggle=buttons]>.btn-group>.btn input[type=checkbox],[data-toggle=buttons]>.btn-group>.btn input[type=radio]{position:absolute;clip:rect(0,0,0,0);pointer-events:none}.input-group{position:relative;display:table;border-collapse:separate}.input-group[class*=col-]{float:none;padding-right:0;padding-left:0}.input-group .form-control{position:relative;z-index:2;float:left;width:100%;margin-bottom:0}.input-group-lg>.form-control,.input-group-lg>.input-group-addon,.input-group-lg>.input-group-btn>.btn{height:46px;padding:10px 16px;font-size:18px;line-height:1.3333333;border-radius:6px}select.input-group-lg>.form-control,select.input-group-lg>.input-group-addon,select.input-group-lg>.input-group-btn>.btn{height:46px;line-height:46px}select[multiple].input-group-lg>.form-control,select[multiple].input-group-lg>.input-group-addon,select[multiple].input-group-lg>.input-group-btn>.btn,textarea.input-group-lg>.form-control,textarea.input-group-lg>.input-group-addon,textarea.input-group-lg>.input-group-btn>.btn{height:auto}.input-group-sm>.form-control,.input-group-sm>.input-group-addon,.input-group-sm>.input-group-btn>.btn{height:30px;padding:5px 10px;font-size:12px;line-height:1.5;border-radius:3px}select.input-group-sm>.form-control,select.input-group-sm>.input-group-addon,select.input-group-sm>.input-group-btn>.btn{height:30px;line-height:30px}select[multiple].input-group-sm>.form-control,select[multiple].input-group-sm>.input-group-addon,select[multiple].input-group-sm>.input-group-btn>.btn,textarea.input-group-sm>.form-control,textarea.input-group-sm>.input-group-addon,textarea.input-group-sm>.input-group-btn>.btn{height:auto}.input-group .form-control,.input-group-addon,.input-group-btn{display:table-cell}.input-group .form-control:not(:first-child):not(:last-child),.input-group-addon:not(:first-child):not(:last-child),.input-group-btn:not(:first-child):not(:last-child){border-radius:0}.input-group-addon,.input-group-btn{width:1%;white-space:nowrap;vertical-align:middle}.input-group-addon{padding:6px 12px;font-size:14px;font-weight:400;line-height:1;color:#555;text-align:center;background-color:#eee;border:1px solid #ccc;border-radius:4px}.input-group-addon.input-sm{padding:5px 10px;font-size:12px;border-radius:3px}.input-group-addon.input-lg{padding:10px 16px;font-size:18px;border-radius:6px}.input-group-addon input[type=checkbox],.input-group-addon input[type=radio]{margin-top:0}.input-group .form-control:first-child,.input-group-addon:first-child,.input-group-btn:first-child>.btn,.input-group-btn:first-child>.btn-group>.btn,.input-group-btn:first-child>.dropdown-toggle,.input-group-btn:last-child>.btn-group:not(:last-child)>.btn,.input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle){border-top-right-radius:0;border-bottom-right-radius:0}.input-group-addon:first-child{border-right:0}.input-group .form-control:last-child,.input-group-addon:last-child,.input-group-btn:first-child>.btn-group:not(:first-child)>.btn,.input-group-btn:first-child>.btn:not(:first-child),.input-group-btn:last-child>.btn,.input-group-btn:last-child>.btn-group>.btn,.input-group-btn:last-child>.dropdown-toggle{border-top-left-radius:0;border-bottom-left-radius:0}.input-group-addon:last-child{border-left:0}.input-group-btn{position:relative;font-size:0;white-space:nowrap}.input-group-btn>.btn{position:relative}.input-group-btn>.btn+.btn{margin-left:-1px}.input-group-btn>.btn:active,.input-group-btn>.btn:focus,.input-group-btn>.btn:hover{z-index:2}.input-group-btn:first-child>.btn,.input-group-btn:first-child>.btn-group{margin-right:-1px}.input-group-btn:last-child>.btn,.input-group-btn:last-child>.btn-group{margin-left:-1px}.nav{padding-left:0;margin-bottom:0;list-style:none}.nav>li{position:relative;display:block}.nav>li>a{position:relative;display:block;padding:10px 15px}.nav>li>a:focus,.nav>li>a:hover{text-decoration:none;background-color:#eee}.nav>li.disabled>a{color:#777}.nav>li.disabled>a:focus,.nav>li.disabled>a:hover{color:#777;text-decoration:none;cursor:not-allowed;background-color:transparent}.nav .open>a,.nav .open>a:focus,.nav .open>a:hover{background-color:#eee;border-color:#337ab7}.nav .nav-divider{height:1px;margin:9px 0;overflow:hidden;background-color:#e5e5e5}.nav>li>a>img{max-width:none}.nav-tabs{border-bottom:1px solid #ddd}.nav-tabs>li{float:left;margin-bottom:-1px}.nav-tabs>li>a{margin-right:2px;line-height:1.42857143;border:1px solid transparent;border-radius:4px 4px 0 0}.nav-tabs>li>a:hover{border-color:#eee #eee #ddd}.nav-tabs>li.active>a,.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a:hover{color:#555;cursor:default;background-color:#fff;border:1px solid #ddd;border-bottom-color:transparent}.nav-tabs.nav-justified{width:100%;border-bottom:0}.nav-tabs.nav-justified>li{float:none}.nav-tabs.nav-justified>li>a{margin-bottom:5px;text-align:center}.nav-tabs.nav-justified>.dropdown .dropdown-menu{top:auto;left:auto}@media (min-width:768px){.nav-tabs.nav-justified>li{display:table-cell;width:1%}.nav-tabs.nav-justified>li>a{margin-bottom:0}}.nav-tabs.nav-justified>li>a{margin-right:0;border-radius:4px}.nav-tabs.nav-justified>.active>a,.nav-tabs.nav-justified>.active>a:focus,.nav-tabs.nav-justified>.active>a:hover{border:1px solid #ddd}@media (min-width:768px){.nav-tabs.nav-justified>li>a{border-bottom:1px solid #ddd;border-radius:4px 4px 0 0}.nav-tabs.nav-justified>.active>a,.nav-tabs.nav-justified>.active>a:focus,.nav-tabs.nav-justified>.active>a:hover{border-bottom-color:#fff}}.nav-pills>li{float:left}.nav-pills>li>a{border-radius:4px}.nav-pills>li+li{margin-left:2px}.nav-pills>li.active>a,.nav-pills>li.active>a:focus,.nav-pills>li.active>a:hover{color:#fff;background-color:#337ab7}.nav-stacked>li{float:none}.nav-stacked>li+li{margin-top:2px;margin-left:0}.nav-justified{width:100%}.nav-justified>li{float:none}.nav-justified>li>a{margin-bottom:5px;text-align:center}.nav-justified>.dropdown .dropdown-menu{top:auto;left:auto}@media (min-width:768px){.nav-justified>li{display:table-cell;width:1%}.nav-justified>li>a{margin-bottom:0}}.nav-tabs-justified{border-bottom:0}.nav-tabs-justified>li>a{margin-right:0;border-radius:4px}.nav-tabs-justified>.active>a,.nav-tabs-justified>.active>a:focus,.nav-tabs-justified>.active>a:hover{border:1px solid #ddd}@media (min-width:768px){.nav-tabs-justified>li>a{border-bottom:1px solid #ddd;border-radius:4px 4px 0 0}.nav-tabs-justified>.active>a,.nav-tabs-justified>.active>a:focus,.nav-tabs-justified>.active>a:hover{border-bottom-color:#fff}}.tab-content>.tab-pane{display:none}.tab-content>.active{display:block}.nav-tabs .dropdown-menu{margin-top:-1px;border-top-left-radius:0;border-top-right-radius:0}.navbar{position:relative;min-height:50px;margin-bottom:20px;border:1px solid transparent}@media (min-width:768px){.navbar{border-radius:4px}}@media (min-width:768px){.navbar-header{float:left}}.navbar-collapse{padding-right:15px;padding-left:15px;overflow-x:visible;-webkit-overflow-scrolling:touch;border-top:1px solid transparent;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.1);box-shadow:inset 0 1px 0 rgba(255,255,255,.1)}.navbar-collapse.in{overflow-y:auto}@media (min-width:768px){.navbar-collapse{width:auto;border-top:0;-webkit-box-shadow:none;box-shadow:none}.navbar-collapse.collapse{display:block!important;height:auto!important;padding-bottom:0;overflow:visible!important}.navbar-collapse.in{overflow-y:visible}.navbar-fixed-bottom .navbar-collapse,.navbar-fixed-top .navbar-collapse,.navbar-static-top .navbar-collapse{padding-right:0;padding-left:0}}.navbar-fixed-bottom .navbar-collapse,.navbar-fixed-top .navbar-collapse{max-height:340px}@media (max-device-width:480px)and (orientation:landscape){.navbar-fixed-bottom .navbar-collapse,.navbar-fixed-top .navbar-collapse{max-height:200px}}.container-fluid>.navbar-collapse,.container-fluid>.navbar-header,.container>.navbar-collapse,.container>.navbar-header{margin-right:-15px;margin-left:-15px}@media (min-width:768px){.container-fluid>.navbar-collapse,.container-fluid>.navbar-header,.container>.navbar-collapse,.container>.navbar-header{margin-right:0;margin-left:0}}.navbar-static-top{z-index:1000;border-width:0 0 1px}@media (min-width:768px){.navbar-static-top{border-radius:0}}.navbar-fixed-bottom,.navbar-fixed-top{position:fixed;right:0;left:0;z-index:1030}@media (min-width:768px){.navbar-fixed-bottom,.navbar-fixed-top{border-radius:0}}.navbar-fixed-top{top:0;border-width:0 0 1px}.navbar-fixed-bottom{bottom:0;margin-bottom:0;border-width:1px 0 0}.navbar-brand{float:left;height:50px;padding:15px 15px;font-size:18px;line-height:20px}.navbar-brand:focus,.navbar-brand:hover{text-decoration:none}.navbar-brand>img{display:block}@media (min-width:768px){.navbar>.container .navbar-brand,.navbar>.container-fluid .navbar-brand{margin-left:-15px}}.navbar-toggle{position:relative;float:right;padding:9px 10px;margin-top:8px;margin-right:15px;margin-bottom:8px;background-color:transparent;background-image:none;border:1px solid transparent;border-radius:4px}.navbar-toggle:focus{outline:0}.navbar-toggle .icon-bar{display:block;width:22px;height:2px;border-radius:1px}.navbar-toggle .icon-bar+.icon-bar{margin-top:4px}@media (min-width:768px){.navbar-toggle{display:none}}.navbar-nav{margin:7.5px -15px}.navbar-nav>li>a{padding-top:10px;padding-bottom:10px;line-height:20px}@media (max-width:767px){.navbar-nav .open .dropdown-menu{position:static;float:none;width:auto;margin-top:0;background-color:transparent;border:0;-webkit-box-shadow:none;box-shadow:none}.navbar-nav .open .dropdown-menu .dropdown-header,.navbar-nav .open .dropdown-menu>li>a{padding:5px 15px 5px 25px}.navbar-nav .open .dropdown-menu>li>a{line-height:20px}.navbar-nav .open .dropdown-menu>li>a:focus,.navbar-nav .open .dropdown-menu>li>a:hover{background-image:none}}@media (min-width:768px){.navbar-nav{float:left;margin:0}.navbar-nav>li{float:left}.navbar-nav>li>a{padding-top:15px;padding-bottom:15px}}.navbar-form{padding:10px 15px;margin-top:8px;margin-right:-15px;margin-bottom:8px;margin-left:-15px;border-top:1px solid transparent;border-bottom:1px solid transparent;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 0 rgba(255,255,255,.1);box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 0 rgba(255,255,255,.1)}@media (min-width:768px){.navbar-form .form-group{display:inline-block;margin-bottom:0;vertical-align:middle}.navbar-form .form-control{display:inline-block;width:auto;vertical-align:middle}.navbar-form .form-control-static{display:inline-block}.navbar-form .input-group{display:inline-table;vertical-align:middle}.navbar-form .input-group .form-control,.navbar-form .input-group .input-group-addon,.navbar-form .input-group .input-group-btn{width:auto}.navbar-form .input-group>.form-control{width:100%}.navbar-form .control-label{margin-bottom:0;vertical-align:middle}.navbar-form .checkbox,.navbar-form .radio{display:inline-block;margin-top:0;margin-bottom:0;vertical-align:middle}.navbar-form .checkbox label,.navbar-form .radio label{padding-left:0}.navbar-form .checkbox input[type=checkbox],.navbar-form .radio input[type=radio]{position:relative;margin-left:0}.navbar-form .has-feedback .form-control-feedback{top:0}}@media (max-width:767px){.navbar-form .form-group{margin-bottom:5px}.navbar-form .form-group:last-child{margin-bottom:0}}@media (min-width:768px){.navbar-form{width:auto;padding-top:0;padding-bottom:0;margin-right:0;margin-left:0;border:0;-webkit-box-shadow:none;box-shadow:none}}.navbar-nav>li>.dropdown-menu{margin-top:0;border-top-left-radius:0;border-top-right-radius:0}.navbar-fixed-bottom .navbar-nav>li>.dropdown-menu{margin-bottom:0;border-top-left-radius:4px;border-top-right-radius:4px;border-bottom-right-radius:0;border-bottom-left-radius:0}.navbar-btn{margin-top:8px;margin-bottom:8px}.navbar-btn.btn-sm{margin-top:10px;margin-bottom:10px}.navbar-btn.btn-xs{margin-top:14px;margin-bottom:14px}.navbar-text{margin-top:15px;margin-bottom:15px}@media (min-width:768px){.navbar-text{float:left;margin-right:15px;margin-left:15px}}@media (min-width:768px){.navbar-left{float:left!important}.navbar-right{float:right!important;margin-right:-15px}.navbar-right~.navbar-right{margin-right:0}}.navbar-default{background-color:#f8f8f8;border-color:#e7e7e7}.navbar-default .navbar-brand{color:#777}.navbar-default .navbar-brand:focus,.navbar-default .navbar-brand:hover{color:#5e5e5e;background-color:transparent}.navbar-default .navbar-text{color:#777}.navbar-default .navbar-nav>li>a{color:#777}.navbar-default .navbar-nav>li>a:focus,.navbar-default .navbar-nav>li>a:hover{color:#333;background-color:transparent}.navbar-default .navbar-nav>.active>a,.navbar-default .navbar-nav>.active>a:focus,.navbar-default .navbar-nav>.active>a:hover{color:#555;background-color:#e7e7e7}.navbar-default .navbar-nav>.disabled>a,.navbar-default .navbar-nav>.disabled>a:focus,.navbar-default .navbar-nav>.disabled>a:hover{color:#ccc;background-color:transparent}.navbar-default .navbar-toggle{border-color:#ddd}.navbar-default .navbar-toggle:focus,.navbar-default .navbar-toggle:hover{background-color:#ddd}.navbar-default .navbar-toggle .icon-bar{background-color:#888}.navbar-default .navbar-collapse,.navbar-default .navbar-form{border-color:#e7e7e7}.navbar-default .navbar-nav>.open>a,.navbar-default .navbar-nav>.open>a:focus,.navbar-default .navbar-nav>.open>a:hover{color:#555;background-color:#e7e7e7}@media (max-width:767px){.navbar-default .navbar-nav .open .dropdown-menu>li>a{color:#777}.navbar-default .navbar-nav .open .dropdown-menu>li>a:focus,.navbar-default .navbar-nav .open .dropdown-menu>li>a:hover{color:#333;background-color:transparent}.navbar-default .navbar-nav .open .dropdown-menu>.active>a,.navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus,.navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover{color:#555;background-color:#e7e7e7}.navbar-default .navbar-nav .open .dropdown-menu>.disabled>a,.navbar-default .navbar-nav .open .dropdown-menu>.disabled>a:focus,.navbar-default .navbar-nav .open .dropdown-menu>.disabled>a:hover{color:#ccc;background-color:transparent}}.navbar-default .navbar-link{color:#777}.navbar-default .navbar-link:hover{color:#333}.navbar-default .btn-link{color:#777}.navbar-default .btn-link:focus,.navbar-default .btn-link:hover{color:#333}.navbar-default .btn-link[disabled]:focus,.navbar-default .btn-link[disabled]:hover,fieldset[disabled] .navbar-default .btn-link:focus,fieldset[disabled] .navbar-default .btn-link:hover{color:#ccc}.navbar-inverse{background-color:#222;border-color:#080808}.navbar-inverse .navbar-brand{color:#9d9d9d}.navbar-inverse .navbar-brand:focus,.navbar-inverse .navbar-brand:hover{color:#fff;background-color:transparent}.navbar-inverse .navbar-text{color:#9d9d9d}.navbar-inverse .navbar-nav>li>a{color:#9d9d9d}.navbar-inverse .navbar-nav>li>a:focus,.navbar-inverse .navbar-nav>li>a:hover{color:#fff;background-color:transparent}.navbar-inverse .navbar-nav>.active>a,.navbar-inverse .navbar-nav>.active>a:focus,.navbar-inverse .navbar-nav>.active>a:hover{color:#fff;background-color:#080808}.navbar-inverse .navbar-nav>.disabled>a,.navbar-inverse .navbar-nav>.disabled>a:focus,.navbar-inverse .navbar-nav>.disabled>a:hover{color:#444;background-color:transparent}.navbar-inverse .navbar-toggle{border-color:#333}.navbar-inverse .navbar-toggle:focus,.navbar-inverse .navbar-toggle:hover{background-color:#333}.navbar-inverse .navbar-toggle .icon-bar{background-color:#fff}.navbar-inverse .navbar-collapse,.navbar-inverse .navbar-form{border-color:#101010}.navbar-inverse .navbar-nav>.open>a,.navbar-inverse .navbar-nav>.open>a:focus,.navbar-inverse .navbar-nav>.open>a:hover{color:#fff;background-color:#080808}@media (max-width:767px){.navbar-inverse .navbar-nav .open .dropdown-menu>.dropdown-header{border-color:#080808}.navbar-inverse .navbar-nav .open .dropdown-menu .divider{background-color:#080808}.navbar-inverse .navbar-nav .open .dropdown-menu>li>a{color:#9d9d9d}.navbar-inverse .navbar-nav .open .dropdown-menu>li>a:focus,.navbar-inverse .navbar-nav .open .dropdown-menu>li>a:hover{color:#fff;background-color:transparent}.navbar-inverse .navbar-nav .open .dropdown-menu>.active>a,.navbar-inverse .navbar-nav .open .dropdown-menu>.active>a:focus,.navbar-inverse .navbar-nav .open .dropdown-menu>.active>a:hover{color:#fff;background-color:#080808}.navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a,.navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a:focus,.navbar-inverse .navbar-nav .open .dropdown-menu>.disabled>a:hover{color:#444;background-color:transparent}}.navbar-inverse .navbar-link{color:#9d9d9d}.navbar-inverse .navbar-link:hover{color:#fff}.navbar-inverse .btn-link{color:#9d9d9d}.navbar-inverse .btn-link:focus,.navbar-inverse .btn-link:hover{color:#fff}.navbar-inverse .btn-link[disabled]:focus,.navbar-inverse .btn-link[disabled]:hover,fieldset[disabled] .navbar-inverse .btn-link:focus,fieldset[disabled] .navbar-inverse .btn-link:hover{color:#444}.breadcrumb{padding:8px 15px;margin-bottom:20px;list-style:none;background-color:#f5f5f5;border-radius:4px}.breadcrumb>li{display:inline-block}.breadcrumb>li+li:before{padding:0 5px;color:#ccc;content:"/\00a0"}.breadcrumb>.active{color:#777}.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}.pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{color:#23527c;background-color:#eee;border-color:#ddd}.pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>.active>span,.pagination>.active>span:focus,.pagination>.active>span:hover{z-index:2;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}.pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}.pagination-lg>li>a,.pagination-lg>li>span{padding:10px 16px;font-size:18px}.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span{border-top-left-radius:6px;border-bottom-left-radius:6px}.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span{border-top-right-radius:6px;border-bottom-right-radius:6px}.pagination-sm>li>a,.pagination-sm>li>span{padding:5px 10px;font-size:12px}.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span{border-top-left-radius:3px;border-bottom-left-radius:3px}.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span{border-top-right-radius:3px;border-bottom-right-radius:3px}.pager{padding-left:0;margin:20px 0;text-align:center;list-style:none}.pager li{display:inline}.pager li>a,.pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}.pager li>a:focus,.pager li>a:hover{text-decoration:none;background-color:#eee}.pager .next>a,.pager .next>span{float:right}.pager .previous>a,.pager .previous>span{float:left}.pager .disabled>a,.pager .disabled>a:focus,.pager .disabled>a:hover,.pager .disabled>span{color:#777;cursor:not-allowed;background-color:#fff}.label{display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em}a.label:focus,a.label:hover{color:#fff;text-decoration:none;cursor:pointer}.label:empty{display:none}.btn .label{position:relative;top:-1px}.label-default{background-color:#777}.label-default[href]:focus,.label-default[href]:hover{background-color:#5e5e5e}.label-primary{background-color:#337ab7}.label-primary[href]:focus,.label-primary[href]:hover{background-color:#286090}.label-success{background-color:#5cb85c}.label-success[href]:focus,.label-success[href]:hover{background-color:#449d44}.label-info{background-color:#5bc0de}.label-info[href]:focus,.label-info[href]:hover{background-color:#31b0d5}.label-warning{background-color:#f0ad4e}.label-warning[href]:focus,.label-warning[href]:hover{background-color:#ec971f}.label-danger{background-color:#d9534f}.label-danger[href]:focus,.label-danger[href]:hover{background-color:#c9302c}.badge{display:inline-block;min-width:10px;padding:3px 7px;font-size:12px;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;background-color:#777;border-radius:10px}.badge:empty{display:none}.btn .badge{position:relative;top:-1px}.btn-group-xs>.btn .badge,.btn-xs .badge{top:0;padding:1px 5px}a.badge:focus,a.badge:hover{color:#fff;text-decoration:none;cursor:pointer}.list-group-item.active>.badge,.nav-pills>.active>a>.badge{color:#337ab7;background-color:#fff}.list-group-item>.badge{float:right}.list-group-item>.badge+.badge{margin-right:5px}.nav-pills>li>a>.badge{margin-left:3px}.jumbotron{padding:30px 15px;margin-bottom:30px;color:inherit;background-color:#eee}.jumbotron .h1,.jumbotron h1{color:inherit}.jumbotron p{margin-bottom:15px;font-size:21px;font-weight:200}.jumbotron>hr{border-top-color:#d5d5d5}.container .jumbotron,.container-fluid .jumbotron{border-radius:6px}.jumbotron .container{max-width:100%}@media screen and (min-width:768px){.jumbotron{padding:48px 0}.container .jumbotron,.container-fluid .jumbotron{padding-right:60px;padding-left:60px}.jumbotron .h1,.jumbotron h1{font-size:63px}}.thumbnail{display:block;padding:4px;margin-bottom:20px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px;-webkit-transition:border .2s ease-in-out;-o-transition:border .2s ease-in-out;transition:border .2s ease-in-out}.thumbnail a>img,.thumbnail>img{margin-right:auto;margin-left:auto}a.thumbnail.active,a.thumbnail:focus,a.thumbnail:hover{border-color:#337ab7}.thumbnail .caption{padding:9px;color:#333}.alert{padding:15px;margin-bottom:20px;border:1px solid transparent;border-radius:4px}.alert h4{margin-top:0;color:inherit}.alert .alert-link{font-weight:700}.alert>p,.alert>ul{margin-bottom:0}.alert>p+p{margin-top:5px}.alert-dismissable,.alert-dismissible{padding-right:35px}.alert-dismissable .close,.alert-dismissible .close{position:relative;top:-2px;right:-21px;color:inherit}.alert-success{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}.alert-success hr{border-top-color:#c9e2b3}.alert-success .alert-link{color:#2b542c}.alert-info{color:#31708f;background-color:#d9edf7;border-color:#bce8f1}.alert-info hr{border-top-color:#a6e1ec}.alert-info .alert-link{color:#245269}.alert-warning{color:#8a6d3b;background-color:#fcf8e3;border-color:#faebcc}.alert-warning hr{border-top-color:#f7e1b5}.alert-warning .alert-link{color:#66512c}.alert-danger{color:#a94442;background-color:#f2dede;border-color:#ebccd1}.alert-danger hr{border-top-color:#e4b9c0}.alert-danger .alert-link{color:#843534}@-webkit-keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}@-o-keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}@keyframes progress-bar-stripes{from{background-position:40px 0}to{background-position:0 0}}.progress{height:20px;margin-bottom:20px;overflow:hidden;background-color:#f5f5f5;border-radius:4px;-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.1);box-shadow:inset 0 1px 2px rgba(0,0,0,.1)}.progress-bar{float:left;width:0;height:100%;font-size:12px;line-height:20px;color:#fff;text-align:center;background-color:#337ab7;-webkit-box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);-webkit-transition:width .6s ease;-o-transition:width .6s ease;transition:width .6s ease}.progress-bar-striped,.progress-striped .progress-bar{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);-webkit-background-size:40px 40px;background-size:40px 40px}.progress-bar.active,.progress.active .progress-bar{-webkit-animation:progress-bar-stripes 2s linear infinite;-o-animation:progress-bar-stripes 2s linear infinite;animation:progress-bar-stripes 2s linear infinite}.progress-bar-success{background-color:#5cb85c}.progress-striped .progress-bar-success{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)}.progress-bar-info{background-color:#5bc0de}.progress-striped .progress-bar-info{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)}.progress-bar-warning{background-color:#f0ad4e}.progress-striped .progress-bar-warning{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)}.progress-bar-danger{background-color:#d9534f}.progress-striped .progress-bar-danger{background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)}.media{margin-top:15px}.media:first-child{margin-top:0}.media,.media-body{overflow:hidden;zoom:1}.media-body{width:10000px}.media-object{display:block}.media-right,.media>.pull-right{padding-left:10px}.media-left,.media>.pull-left{padding-right:10px}.media-body,.media-left,.media-right{display:table-cell;vertical-align:top}.media-middle{vertical-align:middle}.media-bottom{vertical-align:bottom}.media-heading{margin-top:0;margin-bottom:5px}.media-list{padding-left:0;list-style:none}.list-group{padding-left:0;margin-bottom:20px}.list-group-item{position:relative;display:block;padding:10px 15px;margin-bottom:-1px;background-color:#fff;border:1px solid #ddd}.list-group-item:first-child{border-top-left-radius:4px;border-top-right-radius:4px}.list-group-item:last-child{margin-bottom:0;border-bottom-right-radius:4px;border-bottom-left-radius:4px}a.list-group-item{color:#555}a.list-group-item .list-group-item-heading{color:#333}a.list-group-item:focus,a.list-group-item:hover{color:#555;text-decoration:none;background-color:#f5f5f5}.list-group-item.disabled,.list-group-item.disabled:focus,.list-group-item.disabled:hover{color:#777;cursor:not-allowed;background-color:#eee}.list-group-item.disabled .list-group-item-heading,.list-group-item.disabled:focus .list-group-item-heading,.list-group-item.disabled:hover .list-group-item-heading{color:inherit}.list-group-item.disabled .list-group-item-text,.list-group-item.disabled:focus .list-group-item-text,.list-group-item.disabled:hover .list-group-item-text{color:#777}.list-group-item.active,.list-group-item.active:focus,.list-group-item.active:hover{z-index:2;color:#fff;background-color:#337ab7;border-color:#337ab7}.list-group-item.active .list-group-item-heading,.list-group-item.active .list-group-item-heading>.small,.list-group-item.active .list-group-item-heading>small,.list-group-item.active:focus .list-group-item-heading,.list-group-item.active:focus .list-group-item-heading>.small,.list-group-item.active:focus .list-group-item-heading>small,.list-group-item.active:hover .list-group-item-heading,.list-group-item.active:hover .list-group-item-heading>.small,.list-group-item.active:hover .list-group-item-heading>small{color:inherit}.list-group-item.active .list-group-item-text,.list-group-item.active:focus .list-group-item-text,.list-group-item.active:hover .list-group-item-text{color:#c7ddef}.list-group-item-success{color:#3c763d;background-color:#dff0d8}a.list-group-item-success{color:#3c763d}a.list-group-item-success .list-group-item-heading{color:inherit}a.list-group-item-success:focus,a.list-group-item-success:hover{color:#3c763d;background-color:#d0e9c6}a.list-group-item-success.active,a.list-group-item-success.active:focus,a.list-group-item-success.active:hover{color:#fff;background-color:#3c763d;border-color:#3c763d}.list-group-item-info{color:#31708f;background-color:#d9edf7}a.list-group-item-info{color:#31708f}a.list-group-item-info .list-group-item-heading{color:inherit}a.list-group-item-info:focus,a.list-group-item-info:hover{color:#31708f;background-color:#c4e3f3}a.list-group-item-info.active,a.list-group-item-info.active:focus,a.list-group-item-info.active:hover{color:#fff;background-color:#31708f;border-color:#31708f}.list-group-item-warning{color:#8a6d3b;background-color:#fcf8e3}a.list-group-item-warning{color:#8a6d3b}a.list-group-item-warning .list-group-item-heading{color:inherit}a.list-group-item-warning:focus,a.list-group-item-warning:hover{color:#8a6d3b;background-color:#faf2cc}a.list-group-item-warning.active,a.list-group-item-warning.active:focus,a.list-group-item-warning.active:hover{color:#fff;background-color:#8a6d3b;border-color:#8a6d3b}.list-group-item-danger{color:#a94442;background-color:#f2dede}a.list-group-item-danger{color:#a94442}a.list-group-item-danger .list-group-item-heading{color:inherit}a.list-group-item-danger:focus,a.list-group-item-danger:hover{color:#a94442;background-color:#ebcccc}a.list-group-item-danger.active,a.list-group-item-danger.active:focus,a.list-group-item-danger.active:hover{color:#fff;background-color:#a94442;border-color:#a94442}.list-group-item-heading{margin-top:0;margin-bottom:5px}.list-group-item-text{margin-bottom:0;line-height:1.3}.panel{margin-bottom:20px;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}.panel-body{padding:15px}.panel-heading{padding:10px 15px;border-bottom:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px}.panel-heading>.dropdown .dropdown-toggle{color:inherit}.panel-title{margin-top:0;margin-bottom:0;font-size:16px;color:inherit}.panel-title>.small,.panel-title>.small>a,.panel-title>a,.panel-title>small,.panel-title>small>a{color:inherit}.panel-footer{padding:10px 15px;background-color:#f5f5f5;border-top:1px solid #ddd;border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.list-group,.panel>.panel-collapse>.list-group{margin-bottom:0}.panel>.list-group .list-group-item,.panel>.panel-collapse>.list-group .list-group-item{border-width:1px 0;border-radius:0}.panel>.list-group:first-child .list-group-item:first-child,.panel>.panel-collapse>.list-group:first-child .list-group-item:first-child{border-top:0;border-top-left-radius:3px;border-top-right-radius:3px}.panel>.list-group:last-child .list-group-item:last-child,.panel>.panel-collapse>.list-group:last-child .list-group-item:last-child{border-bottom:0;border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel-heading+.list-group .list-group-item:first-child{border-top-width:0}.list-group+.panel-footer{border-top-width:0}.panel>.panel-collapse>.table,.panel>.table,.panel>.table-responsive>.table{margin-bottom:0}.panel>.panel-collapse>.table caption,.panel>.table caption,.panel>.table-responsive>.table caption{padding-right:15px;padding-left:15px}.panel>.table-responsive:first-child>.table:first-child,.panel>.table:first-child{border-top-left-radius:3px;border-top-right-radius:3px}.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child,.panel>.table:first-child>tbody:first-child>tr:first-child,.panel>.table:first-child>thead:first-child>tr:first-child{border-top-left-radius:3px;border-top-right-radius:3px}.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:first-child,.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:first-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:first-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:first-child,.panel>.table:first-child>tbody:first-child>tr:first-child td:first-child,.panel>.table:first-child>tbody:first-child>tr:first-child th:first-child,.panel>.table:first-child>thead:first-child>tr:first-child td:first-child,.panel>.table:first-child>thead:first-child>tr:first-child th:first-child{border-top-left-radius:3px}.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:last-child,.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:last-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:last-child,.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:last-child,.panel>.table:first-child>tbody:first-child>tr:first-child td:last-child,.panel>.table:first-child>tbody:first-child>tr:first-child th:last-child,.panel>.table:first-child>thead:first-child>tr:first-child td:last-child,.panel>.table:first-child>thead:first-child>tr:first-child th:last-child{border-top-right-radius:3px}.panel>.table-responsive:last-child>.table:last-child,.panel>.table:last-child{border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child,.panel>.table:last-child>tbody:last-child>tr:last-child,.panel>.table:last-child>tfoot:last-child>tr:last-child{border-bottom-right-radius:3px;border-bottom-left-radius:3px}.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:first-child,.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:first-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:first-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:first-child,.panel>.table:last-child>tbody:last-child>tr:last-child td:first-child,.panel>.table:last-child>tbody:last-child>tr:last-child th:first-child,.panel>.table:last-child>tfoot:last-child>tr:last-child td:first-child,.panel>.table:last-child>tfoot:last-child>tr:last-child th:first-child{border-bottom-left-radius:3px}.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:last-child,.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:last-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:last-child,.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:last-child,.panel>.table:last-child>tbody:last-child>tr:last-child td:last-child,.panel>.table:last-child>tbody:last-child>tr:last-child th:last-child,.panel>.table:last-child>tfoot:last-child>tr:last-child td:last-child,.panel>.table:last-child>tfoot:last-child>tr:last-child th:last-child{border-bottom-right-radius:3px}.panel>.panel-body+.table,.panel>.panel-body+.table-responsive,.panel>.table+.panel-body,.panel>.table-responsive+.panel-body{border-top:1px solid #ddd}.panel>.table>tbody:first-child>tr:first-child td,.panel>.table>tbody:first-child>tr:first-child th{border-top:0}.panel>.table-bordered,.panel>.table-responsive>.table-bordered{border:0}.panel>.table-bordered>tbody>tr>td:first-child,.panel>.table-bordered>tbody>tr>th:first-child,.panel>.table-bordered>tfoot>tr>td:first-child,.panel>.table-bordered>tfoot>tr>th:first-child,.panel>.table-bordered>thead>tr>td:first-child,.panel>.table-bordered>thead>tr>th:first-child,.panel>.table-responsive>.table-bordered>tbody>tr>td:first-child,.panel>.table-responsive>.table-bordered>tbody>tr>th:first-child,.panel>.table-responsive>.table-bordered>tfoot>tr>td:first-child,.panel>.table-responsive>.table-bordered>tfoot>tr>th:first-child,.panel>.table-responsive>.table-bordered>thead>tr>td:first-child,.panel>.table-responsive>.table-bordered>thead>tr>th:first-child{border-left:0}.panel>.table-bordered>tbody>tr>td:last-child,.panel>.table-bordered>tbody>tr>th:last-child,.panel>.table-bordered>tfoot>tr>td:last-child,.panel>.table-bordered>tfoot>tr>th:last-child,.panel>.table-bordered>thead>tr>td:last-child,.panel>.table-bordered>thead>tr>th:last-child,.panel>.table-responsive>.table-bordered>tbody>tr>td:last-child,.panel>.table-responsive>.table-bordered>tbody>tr>th:last-child,.panel>.table-responsive>.table-bordered>tfoot>tr>td:last-child,.panel>.table-responsive>.table-bordered>tfoot>tr>th:last-child,.panel>.table-responsive>.table-bordered>thead>tr>td:last-child,.panel>.table-responsive>.table-bordered>thead>tr>th:last-child{border-right:0}.panel>.table-bordered>tbody>tr:first-child>td,.panel>.table-bordered>tbody>tr:first-child>th,.panel>.table-bordered>thead>tr:first-child>td,.panel>.table-bordered>thead>tr:first-child>th,.panel>.table-responsive>.table-bordered>tbody>tr:first-child>td,.panel>.table-responsive>.table-bordered>tbody>tr:first-child>th,.panel>.table-responsive>.table-bordered>thead>tr:first-child>td,.panel>.table-responsive>.table-bordered>thead>tr:first-child>th{border-bottom:0}.panel>.table-bordered>tbody>tr:last-child>td,.panel>.table-bordered>tbody>tr:last-child>th,.panel>.table-bordered>tfoot>tr:last-child>td,.panel>.table-bordered>tfoot>tr:last-child>th,.panel>.table-responsive>.table-bordered>tbody>tr:last-child>td,.panel>.table-responsive>.table-bordered>tbody>tr:last-child>th,.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>td,.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>th{border-bottom:0}.panel>.table-responsive{margin-bottom:0;border:0}.panel-group{margin-bottom:20px}.panel-group .panel{margin-bottom:0;border-radius:4px}.panel-group .panel+.panel{margin-top:5px}.panel-group .panel-heading{border-bottom:0}.panel-group .panel-heading+.panel-collapse>.list-group,.panel-group .panel-heading+.panel-collapse>.panel-body{border-top:1px solid #ddd}.panel-group .panel-footer{border-top:0}.panel-group .panel-footer+.panel-collapse .panel-body{border-bottom:1px solid #ddd}.panel-default{border-color:#ddd}.panel-default>.panel-heading{color:#333;background-color:#f5f5f5;border-color:#ddd}.panel-default>.panel-heading+.panel-collapse>.panel-body{border-top-color:#ddd}.panel-default>.panel-heading .badge{color:#f5f5f5;background-color:#333}.panel-default>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#ddd}.panel-primary{border-color:#337ab7}.panel-primary>.panel-heading{color:#fff;background-color:#337ab7;border-color:#337ab7}.panel-primary>.panel-heading+.panel-collapse>.panel-body{border-top-color:#337ab7}.panel-primary>.panel-heading .badge{color:#337ab7;background-color:#fff}.panel-primary>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#337ab7}.panel-success{border-color:#d6e9c6}.panel-success>.panel-heading{color:#3c763d;background-color:#dff0d8;border-color:#d6e9c6}.panel-success>.panel-heading+.panel-collapse>.panel-body{border-top-color:#d6e9c6}.panel-success>.panel-heading .badge{color:#dff0d8;background-color:#3c763d}.panel-success>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#d6e9c6}.panel-info{border-color:#bce8f1}.panel-info>.panel-heading{color:#31708f;background-color:#d9edf7;border-color:#bce8f1}.panel-info>.panel-heading+.panel-collapse>.panel-body{border-top-color:#bce8f1}.panel-info>.panel-heading .badge{color:#d9edf7;background-color:#31708f}.panel-info>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#bce8f1}.panel-warning{border-color:#faebcc}.panel-warning>.panel-heading{color:#8a6d3b;background-color:#fcf8e3;border-color:#faebcc}.panel-warning>.panel-heading+.panel-collapse>.panel-body{border-top-color:#faebcc}.panel-warning>.panel-heading .badge{color:#fcf8e3;background-color:#8a6d3b}.panel-warning>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#faebcc}.panel-danger{border-color:#ebccd1}.panel-danger>.panel-heading{color:#a94442;background-color:#f2dede;border-color:#ebccd1}.panel-danger>.panel-heading+.panel-collapse>.panel-body{border-top-color:#ebccd1}.panel-danger>.panel-heading .badge{color:#f2dede;background-color:#a94442}.panel-danger>.panel-footer+.panel-collapse>.panel-body{border-bottom-color:#ebccd1}.embed-responsive{position:relative;display:block;height:0;padding:0;overflow:hidden}.embed-responsive .embed-responsive-item,.embed-responsive embed,.embed-responsive iframe,.embed-responsive object,.embed-responsive video{position:absolute;top:0;bottom:0;left:0;width:100%;height:100%;border:0}.embed-responsive-16by9{padding-bottom:56.25%}.embed-responsive-4by3{padding-bottom:75%}.well{min-height:20px;padding:19px;margin-bottom:20px;background-color:#f5f5f5;border:1px solid #e3e3e3;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.05);box-shadow:inset 0 1px 1px rgba(0,0,0,.05)}.well blockquote{border-color:#ddd;border-color:rgba(0,0,0,.15)}.well-lg{padding:24px;border-radius:6px}.well-sm{padding:9px;border-radius:3px}.close{float:right;font-size:21px;font-weight:700;line-height:1;color:#000;text-shadow:0 1px 0 #fff;filter:alpha(opacity=20);opacity:.2}.close:focus,.close:hover{color:#000;text-decoration:none;cursor:pointer;filter:alpha(opacity=50);opacity:.5}button.close{-webkit-appearance:none;padding:0;cursor:pointer;background:0 0;border:0}.modal-open{overflow:hidden}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0}.modal.fade .modal-dialog{-webkit-transition:-webkit-transform .3s ease-out;-o-transition:-o-transform .3s ease-out;transition:transform .3s ease-out;-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);-o-transform:translate(0,-25%);transform:translate(0,-25%)}.modal.in .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);-o-transform:translate(0,0);transform:translate(0,0)}.modal-open .modal{overflow-x:hidden;overflow-y:auto}.modal-dialog{position:relative;width:auto;margin:10px}.modal-content{position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #999;border:1px solid rgba(0,0,0,.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5)}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}.modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}.modal-backdrop.in{filter:alpha(opacity=50);opacity:.5}.modal-header{min-height:16.43px;padding:15px;border-bottom:1px solid #e5e5e5}.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.42857143}.modal-body{position:relative;padding:15px}.modal-footer{padding:15px;text-align:right;border-top:1px solid #e5e5e5}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}.modal-footer .btn-group .btn+.btn{margin-left:-1px}.modal-footer .btn-block+.btn-block{margin-left:0}.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}@media (min-width:768px){.modal-dialog{width:600px;margin:30px auto}.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5)}.modal-sm{width:300px}}@media (min-width:992px){.modal-lg{width:900px}}.tooltip{position:absolute;z-index:1070;display:block;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:1.4;filter:alpha(opacity=0);opacity:0}.tooltip.in{filter:alpha(opacity=90);opacity:.9}.tooltip.top{padding:5px 0;margin-top:-3px}.tooltip.right{padding:0 5px;margin-left:3px}.tooltip.bottom{padding:5px 0;margin-top:3px}.tooltip.left{padding:0 5px;margin-left:-3px}.tooltip-inner{max-width:200px;padding:3px 8px;color:#fff;text-align:center;text-decoration:none;background-color:#000;border-radius:4px}.tooltip-arrow{position:absolute;width:0;height:0;border-color:transparent;border-style:solid}.tooltip.top .tooltip-arrow{bottom:0;left:50%;margin-left:-5px;border-width:5px 5px 0;border-top-color:#000}.tooltip.top-left .tooltip-arrow{right:5px;bottom:0;margin-bottom:-5px;border-width:5px 5px 0;border-top-color:#000}.tooltip.top-right .tooltip-arrow{bottom:0;left:5px;margin-bottom:-5px;border-width:5px 5px 0;border-top-color:#000}.tooltip.right .tooltip-arrow{top:50%;left:0;margin-top:-5px;border-width:5px 5px 5px 0;border-right-color:#000}.tooltip.left .tooltip-arrow{top:50%;right:0;margin-top:-5px;border-width:5px 0 5px 5px;border-left-color:#000}.tooltip.bottom .tooltip-arrow{top:0;left:50%;margin-left:-5px;border-width:0 5px 5px;border-bottom-color:#000}.tooltip.bottom-left .tooltip-arrow{top:0;right:5px;margin-top:-5px;border-width:0 5px 5px;border-bottom-color:#000}.tooltip.bottom-right .tooltip-arrow{top:0;left:5px;margin-top:-5px;border-width:0 5px 5px;border-bottom-color:#000}.popover{position:absolute;top:0;left:0;z-index:1060;display:none;max-width:276px;padding:1px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:1.42857143;text-align:left;white-space:normal;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,.2);border-radius:6px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,.2);box-shadow:0 5px 10px rgba(0,0,0,.2)}.popover.top{margin-top:-10px}.popover.right{margin-left:10px}.popover.bottom{margin-top:10px}.popover.left{margin-left:-10px}.popover-title{padding:8px 14px;margin:0;font-size:14px;background-color:#f7f7f7;border-bottom:1px solid #ebebeb;border-radius:5px 5px 0 0}.popover-content{padding:9px 14px}.popover>.arrow,.popover>.arrow:after{position:absolute;display:block;width:0;height:0;border-color:transparent;border-style:solid}.popover>.arrow{border-width:11px}.popover>.arrow:after{content:"";border-width:10px}.popover.top>.arrow{bottom:-11px;left:50%;margin-left:-11px;border-top-color:#999;border-top-color:rgba(0,0,0,.25);border-bottom-width:0}.popover.top>.arrow:after{bottom:1px;margin-left:-10px;content:" ";border-top-color:#fff;border-bottom-width:0}.popover.right>.arrow{top:50%;left:-11px;margin-top:-11px;border-right-color:#999;border-right-color:rgba(0,0,0,.25);border-left-width:0}.popover.right>.arrow:after{bottom:-10px;left:1px;content:" ";border-right-color:#fff;border-left-width:0}.popover.bottom>.arrow{top:-11px;left:50%;margin-left:-11px;border-top-width:0;border-bottom-color:#999;border-bottom-color:rgba(0,0,0,.25)}.popover.bottom>.arrow:after{top:1px;margin-left:-10px;content:" ";border-top-width:0;border-bottom-color:#fff}.popover.left>.arrow{top:50%;right:-11px;margin-top:-11px;border-right-width:0;border-left-color:#999;border-left-color:rgba(0,0,0,.25)}.popover.left>.arrow:after{right:1px;bottom:-10px;content:" ";border-right-width:0;border-left-color:#fff}.carousel{position:relative}.carousel-inner{position:relative;width:100%;overflow:hidden}.carousel-inner>.item{position:relative;display:none;-webkit-transition:.6s ease-in-out left;-o-transition:.6s ease-in-out left;transition:.6s ease-in-out left}.carousel-inner>.item>a>img,.carousel-inner>.item>img{line-height:1}@media all and (transform-3d),(-webkit-transform-3d){.carousel-inner>.item{-webkit-transition:-webkit-transform .6s ease-in-out;-o-transition:-o-transform .6s ease-in-out;transition:transform .6s ease-in-out;-webkit-backface-visibility:hidden;backface-visibility:hidden;-webkit-perspective:1000;perspective:1000}.carousel-inner>.item.active.right,.carousel-inner>.item.next{left:0;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}.carousel-inner>.item.active.left,.carousel-inner>.item.prev{left:0;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}.carousel-inner>.item.active,.carousel-inner>.item.next.left,.carousel-inner>.item.prev.right{left:0;-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}}.carousel-inner>.active,.carousel-inner>.next,.carousel-inner>.prev{display:block}.carousel-inner>.active{left:0}.carousel-inner>.next,.carousel-inner>.prev{position:absolute;top:0;width:100%}.carousel-inner>.next{left:100%}.carousel-inner>.prev{left:-100%}.carousel-inner>.next.left,.carousel-inner>.prev.right{left:0}.carousel-inner>.active.left{left:-100%}.carousel-inner>.active.right{left:100%}.carousel-control{position:absolute;top:0;bottom:0;left:0;width:15%;font-size:20px;color:#fff;text-align:center;text-shadow:0 1px 2px rgba(0,0,0,.6);filter:alpha(opacity=50);opacity:.5}.carousel-control.left{background-image:-webkit-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);background-image:-o-linear-gradient(left,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);background-image:-webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.5)),to(rgba(0,0,0,.0001)));background-image:linear-gradient(to right,rgba(0,0,0,.5) 0,rgba(0,0,0,.0001) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);background-repeat:repeat-x}.carousel-control.right{right:0;left:auto;background-image:-webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);background-image:-o-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);background-image:-webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.0001)),to(rgba(0,0,0,.5)));background-image:linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);background-repeat:repeat-x}.carousel-control:focus,.carousel-control:hover{color:#fff;text-decoration:none;filter:alpha(opacity=90);outline:0;opacity:.9}.carousel-control .glyphicon-chevron-left,.carousel-control .glyphicon-chevron-right,.carousel-control .icon-next,.carousel-control .icon-prev{position:absolute;top:50%;z-index:5;display:inline-block}.carousel-control .glyphicon-chevron-left,.carousel-control .icon-prev{left:50%;margin-left:-10px}.carousel-control .glyphicon-chevron-right,.carousel-control .icon-next{right:50%;margin-right:-10px}.carousel-control .icon-next,.carousel-control .icon-prev{width:20px;height:20px;margin-top:-10px;font-family:serif;line-height:1}.carousel-control .icon-prev:before{content:'\2039'}.carousel-control .icon-next:before{content:'\203a'}.carousel-indicators{position:absolute;bottom:10px;left:50%;z-index:15;width:60%;padding-left:0;margin-left:-30%;text-align:center;list-style:none}.carousel-indicators li{display:inline-block;width:10px;height:10px;margin:1px;text-indent:-999px;cursor:pointer;background-color:#000 \9;background-color:rgba(0,0,0,0);border:1px solid #fff;border-radius:10px}.carousel-indicators .active{width:12px;height:12px;margin:0;background-color:#fff}.carousel-caption{position:absolute;right:15%;bottom:20px;left:15%;z-index:10;padding-top:20px;padding-bottom:20px;color:#fff;text-align:center;text-shadow:0 1px 2px rgba(0,0,0,.6)}.carousel-caption .btn{text-shadow:none}@media screen and (min-width:768px){.carousel-control .glyphicon-chevron-left,.carousel-control .glyphicon-chevron-right,.carousel-control .icon-next,.carousel-control .icon-prev{width:30px;height:30px;margin-top:-15px;font-size:30px}.carousel-control .glyphicon-chevron-left,.carousel-control .icon-prev{margin-left:-15px}.carousel-control .glyphicon-chevron-right,.carousel-control .icon-next{margin-right:-15px}.carousel-caption{right:20%;left:20%;padding-bottom:30px}.carousel-indicators{bottom:20px}}.btn-group-vertical>.btn-group:after,.btn-group-vertical>.btn-group:before,.btn-toolbar:after,.btn-toolbar:before,.clearfix:after,.clearfix:before,.container-fluid:after,.container-fluid:before,.container:after,.container:before,.dl-horizontal dd:after,.dl-horizontal dd:before,.form-horizontal .form-group:after,.form-horizontal .form-group:before,.modal-footer:after,.modal-footer:before,.nav:after,.nav:before,.navbar-collapse:after,.navbar-collapse:before,.navbar-header:after,.navbar-header:before,.navbar:after,.navbar:before,.pager:after,.pager:before,.panel-body:after,.panel-body:before,.row:after,.row:before{display:table;content:" "}.btn-group-vertical>.btn-group:after,.btn-toolbar:after,.clearfix:after,.container-fluid:after,.container:after,.dl-horizontal dd:after,.form-horizontal .form-group:after,.modal-footer:after,.nav:after,.navbar-collapse:after,.navbar-header:after,.navbar:after,.pager:after,.panel-body:after,.row:after{clear:both}.center-block{display:block;margin-right:auto;margin-left:auto}.pull-right{float:right!important}.pull-left{float:left!important}.hide{display:none!important}.show{display:block!important}.invisible{visibility:hidden}.text-hide{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}.hidden{display:none!important}.affix{position:fixed}@-ms-viewport{width:device-width}.visible-lg,.visible-md,.visible-sm,.visible-xs{display:none!important}.visible-lg-block,.visible-lg-inline,.visible-lg-inline-block,.visible-md-block,.visible-md-inline,.visible-md-inline-block,.visible-sm-block,.visible-sm-inline,.visible-sm-inline-block,.visible-xs-block,.visible-xs-inline,.visible-xs-inline-block{display:none!important}@media (max-width:767px){.visible-xs{display:block!important}table.visible-xs{display:table}tr.visible-xs{display:table-row!important}td.visible-xs,th.visible-xs{display:table-cell!important}}@media (max-width:767px){.visible-xs-block{display:block!important}}@media (max-width:767px){.visible-xs-inline{display:inline!important}}@media (max-width:767px){.visible-xs-inline-block{display:inline-block!important}}@media (min-width:768px)and (max-width:991px){.visible-sm{display:block!important}table.visible-sm{display:table}tr.visible-sm{display:table-row!important}td.visible-sm,th.visible-sm{display:table-cell!important}}@media (min-width:768px)and (max-width:991px){.visible-sm-block{display:block!important}}@media (min-width:768px)and (max-width:991px){.visible-sm-inline{display:inline!important}}@media (min-width:768px)and (max-width:991px){.visible-sm-inline-block{display:inline-block!important}}@media (min-width:992px)and (max-width:1199px){.visible-md{display:block!important}table.visible-md{display:table}tr.visible-md{display:table-row!important}td.visible-md,th.visible-md{display:table-cell!important}}@media (min-width:992px)and (max-width:1199px){.visible-md-block{display:block!important}}@media (min-width:992px)and (max-width:1199px){.visible-md-inline{display:inline!important}}@media (min-width:992px)and (max-width:1199px){.visible-md-inline-block{display:inline-block!important}}@media (min-width:1200px){.visible-lg{display:block!important}table.visible-lg{display:table}tr.visible-lg{display:table-row!important}td.visible-lg,th.visible-lg{display:table-cell!important}}@media (min-width:1200px){.visible-lg-block{display:block!important}}@media (min-width:1200px){.visible-lg-inline{display:inline!important}}@media (min-width:1200px){.visible-lg-inline-block{display:inline-block!important}}@media (max-width:767px){.hidden-xs{display:none!important}}@media (min-width:768px)and (max-width:991px){.hidden-sm{display:none!important}}@media (min-width:992px)and (max-width:1199px){.hidden-md{display:none!important}}@media (min-width:1200px){.hidden-lg{display:none!important}}.visible-print{display:none!important}@media print{.visible-print{display:block!important}table.visible-print{display:table}tr.visible-print{display:table-row!important}td.visible-print,th.visible-print{display:table-cell!important}}.visible-print-block{display:none!important}@media print{.visible-print-block{display:block!important}}.visible-print-inline{display:none!important}@media print{.visible-print-inline{display:inline!important}}.visible-print-inline-block{display:none!important}@media print{.visible-print-inline-block{display:inline-block!important}}@media print{.hidden-print{display:none!important}}

[v-cloak] {
    display: none;
}

html {
    height: 100%;
}


/* Body Triggers for layout options 
------------------------------------------------------------------
*/

body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
    direction: ltr;
}

body.fixed-header .header {
    position: fixed;
    left: 0;
    top: 0;
}

body.mobile .sidebar-menu {
    overflow: scroll;
    -webkit-overflow-scrolling: touch;
}

body.mobile .sidebar-menu>ul {
    height: auto !important;
    overflow: visible !important;
    -webkit-overflow-scrolling: touch !important;
}

body.mobile .page-sidebar .sidebar-menu .menu-items li:hover a {
    color: #788195;
}

body.mobile .page-sidebar .sidebar-menu .menu-items li:hover .icon-thumbnail {
    color: #788195 !important;
}

body.mobile .page-sidebar .sidebar-menu .menu-items li.active>a, body.mobile .page-sidebar .sidebar-menu .menu-items li.open>a {
    color: #fff;
}

body.mobile .page-sidebar .sidebar-menu .menu-items li.active>.icon-thumbnail, body.mobile .page-sidebar .sidebar-menu .menu-items li.open>.icon-thumbnail {
    color: #fff;
}

body.mobile .drager {
    overflow: auto;
    -webkit-overflow-scrolling: touch;
}

body.sidebar-visible .page-sidebar .scroll-element {
    visibility: visible;
}

body.sidebar-visible .page-sidebar .menu-items .icon-thumbnail {
    -webkit-transform: translate3d(-14px, 0, 0);
    transform: translate3d(-14px, 0, 0);
    -ms-transform: translate(-14px, 0);
}

body.sidebar-visible .page-sidebar .sidebar-header .sidebar-header-controls {
    -webkit-transform: translate3d(48px, 0, 0);
    transform: translate3d(48px, 0, 0);
    -ms-transform: translate(48px, 0);
}

body.no-header .page-container .page-content-wrapper .content {
    padding-top: 0px;
}

body.no-header .header {
    border-bottom-color: transparent;
}

body.dashboard {
    background: #f5f5f5;
}

body.dashboard .page-container {
    background: #f5f5f5;
}

body.rtl [class^="col-"], body.rtl [class*="col-"] {
    float: left;
}


/* Page Loader
------------------------------------
*/

.pace .pace-progress {
    background: #10cfbd;
    height: 3px;
}

.pace .pace-progress-inner {
    box-shadow: none;
}

.pace .pace-activity {
    -webkit-animation: none;
    animation: none;
    top: 73px;
    background: url('../img/progress/progress-circle-success.svg') no-repeat top left;
    background-size: 100% auto;
    margin: 0 auto;
    border-width: 0;
    border-radius: 0;
    width: 28px;
    height: 40px;
    right: 19px;
    left: auto;
}


/* Header 
------------------------------------
*/

.header {
    position: relative;
    display: block;
    height: 60px;
    width: 100%;
    padding: 0 20px 0 0;
    z-index: 800;
    background-color: #fff;
    border-bottom: 1px solid rgba(230, 230, 230, 0.7);
}

.header a {
    color: #3b4751;
}

.header a.btn {
    color: #8b91a0;
}

.header a.btn-warning {
    color: #eaeef1;
}

.header .pull-left, .header .pull-right {
    z-index: 10;
    position: relative;
}

.header .header-inner {
    height: 60px;
    width: 100%;
    vertical-align: middle;
    display: table-cell;
}

.header .header-inner .toggle-sidebar {
    display: none;
}

.header.transparent {
    background-color: transparent !important;
}

.header .brand {
    vertical-align: middle;
    width: 280px;
    text-align: center;
}

.header .bubble {
    border-radius: 100%;
    height: 14px;
    width: 14px;
    background-color: rgba(226, 32, 91, 0.77);
    color: #ffffff;
    position: relative;
    top: -6px;
    float: right;
    right: -5px;
}

.header .notification-list {
    display: inline-block;
}

.header .search-link {
    display: inline-block;
    margin-left: 15px;
    color: #626262;
    opacity: .7;
    font-size: 16px;
    font-family: wf_segoe-ui_light, wf_segoe-ui_normal, "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.header .search-link i {
    margin-right: 15px;
    font-size: 16px;
}

.header .search-link:hover {
    opacity: 1;
}


/* Bootstrap navbar 
------------------------------------
*/

.navbar {
    top: -1px;
}

.navbar-nav>li>a {
    padding-top: 20px;
    padding-bottom: 20px;
}

.navbar-default {
    background-color: #ffffff;
}

.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-default .navbar-nav>.active>a:focus {
    background-color: transparent;
}

.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-default .navbar-nav>.active>a:focus {
    background-color: transparent;
}

.navbar-toggle {
    border-radius: 0;
    background-color: transparent !important;
}


/* Main Menu Sidebar 
------------------------------------
*/

.page-sidebar {
    width: 280px;
    background-color: #2b303b;
    z-index: 1000;
    left: -210px;
    position: fixed;
    bottom: 0;
    top: 0;
    right: auto;
    overflow: hidden;
    -webkit-transition: -webkit-transform 400ms cubic-bezier(0.05, 0.74, 0.27, 0.99);
    -moz-transition: -moz-transform 400ms cubic-bezier(0.05, 0.74, 0.27, 0.99);
    -o-transition: -o-transform 400ms cubic-bezier(0.05, 0.74, 0.27, 0.99);
    transition: transform 400ms cubic-bezier(0.05, 0.74, 0.27, 0.99);
    -webkit-backface-visibility: hidden;
    -webkit-perspective: 1000;
}

.page-sidebar a, .page-sidebar button {
    color: #788195;
}

.page-sidebar a:hover, .page-sidebar button:hover, .page-sidebar a:active, .page-sidebar button:active {
    color: #ffffff;
}

.page-sidebar a:visited, .page-sidebar button:visited, .page-sidebar a:focus, .page-sidebar button:focus {
    color: #788195;
}

.page-sidebar .scroll-element {
    visibility: hidden;
}

.page-sidebar .sidebar-header {
    /* Side-bar header */
    display: block;
    height: 60px;
    line-height: 60px;
    background-color: #272b35;
    border-bottom: 1px solid #232730;
    color: #ffffff;
    width: 100%;
    padding: 0 20px;
    padding-left: 30px;
    clear: both;
    z-index: 10;
    position: relative;
}

.page-sidebar .sidebar-header .sidebar-header-controls {
    display: inline-block;
    -webkit-transition: -webkit-transform 0.4s cubic-bezier(0.05, 0.74, 0.27, 0.99);
    transition: transform 0.4s cubic-bezier(0.05, 0.74, 0.27, 0.99);
    -webkit-backface-visibility: hidden;
}

.page-sidebar .sidebar-header .sidebar-slide-toggle i {
    -webkit-transition: all 0.12s ease;
    transition: all 0.12s ease;
}

.page-sidebar .sidebar-header .sidebar-slide-toggle.active i {
    -webkit-transform: rotate(-180deg);
    -ms-transform: rotate(-180deg);
    transform: rotate(-180deg);
}

.page-sidebar .close-sidebar {
    position: absolute;
    right: 19px;
    top: 14px;
    padding: 9px;
    z-index: 1;
}

.page-sidebar .close-sidebar>i {
    color: rgba(255, 255, 255, 0.57);
}

.page-sidebar .sidebar-overlay-slide {
    /* Side-bar Top Slider */
    width: 100%;
    height: 100%;
    background-color: #272b35;
    display: block;
    z-index: 9;
    padding: 80px 20px 20px 20px;
}

.page-sidebar .sidebar-overlay-slide.from-top {
    top: -100%;
    position: absolute;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}

.page-sidebar .sidebar-overlay-slide.from-top.show {
    -webkit-transform: translate(0, 100%);
    -ms-transform: translate(0, 100%);
    transform: translate(0, 100%);
}

.page-sidebar .sidebar-menu {
    /* Side-bar Menu */
    height: calc(100% - 50px);
    position: relative;
    width: 100%;
}

.page-sidebar .sidebar-menu .outer-tab-nav-section {
    display: inline-block;
    width: 45px;
    position: absolute;
    height: 100%;
    background-color: #0aa699 !important;
}

.page-sidebar .sidebar-menu .menu-items {
    /* Side-bar Menut Items */
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    height: calc(100% - 10px);
    width: 100%;
}

.page-sidebar .sidebar-menu .menu-items li:hover>.icon-thumbnail, .page-sidebar .sidebar-menu .menu-items li.open>.icon-thumbnail, .page-sidebar .sidebar-menu .menu-items li.active>.icon-thumbnail {
    color: #ffffff;
}

.page-sidebar .sidebar-menu .menu-items li:hover>a, .page-sidebar .sidebar-menu .menu-items li.open>a, .page-sidebar .sidebar-menu .menu-items li.active>a {
    color: #ffffff;
}

.page-sidebar .sidebar-menu .menu-items li>a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 65%;
}

.page-sidebar .sidebar-menu .menu-items>li {
    display: block;
    padding: 0;
    clear: right;
}

.page-sidebar .sidebar-menu .menu-items>li:after, .page-sidebar .sidebar-menu .menu-items>li:before {
    display: table;
    content: " ";
    clear: both;
}

.page-sidebar .sidebar-menu .menu-items>li>a {
    font-family: Arial, sans-serif;
    display: inline-block;
    padding: 0 3px;
    padding-left: 32px;
    min-height: 40px;
    line-height: 40px;
    font-size: 14px;
    clear: both;
}

.page-sidebar .sidebar-menu .menu-items>li>a.open {
    background: #313131;
}

.page-sidebar .sidebar-menu .menu-items>li>a>.arrow {
    float: right;
}

.page-sidebar .sidebar-menu .menu-items>li>a>.arrow:before {
    float: right;
    display: inline;
    font-size: 16px;
    font-family: FontAwesome;
    height: auto;
    content: "\f104";
    font-weight: 300;
    text-shadow: none;
    -webkit-transition: all 0.12s ease;
    transition: all 0.12s ease;
}

.page-sidebar .sidebar-menu .menu-items>li>a>.arrow.open:before {
    -webkit-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    transform: rotate(-90deg);
}

.page-sidebar .sidebar-menu .menu-items>li>a>.badge {
    margin-top: 12px;
}

.page-sidebar .sidebar-menu .menu-items>li>a>.title {
    float: left;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    width: 65%;
}

.page-sidebar .sidebar-menu .menu-items>li>a>.details {
    font-size: 12px;
    opacity: 0.4;
    display: block;
    clear: both;
}

.page-sidebar .sidebar-menu .menu-items>li>a.detailed>.title {
    line-height: 28px;
}

.page-sidebar .sidebar-menu .menu-items>li>a.detailed>.details {
    line-height: 16px;
}

.page-sidebar .sidebar-menu .menu-items>li.active>ul.sub-menu {
    display: block;
}

.page-sidebar .sidebar-menu .menu-items>li>.icon-thumbnail:first-letter {
    text-transform: uppercase;
}

.page-sidebar .sidebar-menu .menu-items>li>ul.sub-menu>li ul.sub-menu li {
    padding-left: 10px;
    padding-right: 3px;
}

.page-sidebar .sidebar-menu .menu-items>li>ul.sub-menu>li ul.sub-menu .icon-thumbnail {
    width: 25px;
    height: 25px;
    line-height: 25px;
    font-size: 10px;
}

.page-sidebar .sidebar-menu .menu-items>li>ul.sub-menu li>a>.arrow:before {
    float: right;
    margin-top: 1px;
    margin-right: 20px;
    display: inline;
    font-size: 16px;
    font-family: FontAwesome;
    height: auto;
    content: "\f104";
    font-weight: 300;
    text-shadow: none;
    -webkit-transition: all 0.12s ease;
    transition: all 0.12s ease;
}

.page-sidebar .sidebar-menu .menu-items>li>ul.sub-menu li>a>.arrow.open:before {
    float: right;
    margin-top: 1px;
    margin-right: 18px;
    display: inline;
    font-family: FontAwesome;
    height: auto;
    font-size: 16px;
    -webkit-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    transform: rotate(-90deg);
    font-weight: 300;
    text-shadow: none;
}

.page-sidebar .sidebar-menu .menu-items>li ul.sub-menu {
    display: none;
    list-style: none;
    clear: both;
    margin: 0 0 10px 0;
    background-color: #21252d;
    padding: 18px 0 10px 0;
}

.page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li {
    background: none;
    padding: 0px 20px 0 40px;
    margin-top: 1px;
}

.page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li:hover>.icon-thumbnail {
    color: #ffffff;
}

.page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li>a {
    display: inline-block;
    padding: 5px 0px;
    font-size: 13px;
    font-family: Arial, sans-serif;
    white-space: normal;
}

.page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li .icon-thumbnail {
    width: 30px;
    height: 30px;
    line-height: 30px;
    margin: 0;
    background-color: #2b303b;
    font-size: 14px;
}

.page-sidebar .sidebar-menu .muted {
    color: #576775;
    opacity: .45;
}

.page-sidebar .icon-thumbnail [class^="bg-"], .page-sidebar [class*="bg-"] {
    color: #fff;
}

[data-toggle-pin="sidebar"]>i:before {
    content: "\f10c";
}


/* Sidebar icon holder 
------------------------------------
*/

.icon-thumbnail {
    display: inline-block;
    background: #21252d;
    height: 40px;
    width: 40px;
    line-height: 40px;
    text-align: center;
    vertical-align: middle;
    position: relative;
    left: 0;
    float: right;
    margin-right: 14px;
    color: #788195;
    font-size: 16px;
    -webkit-transition: -webkit-transform 0.4s cubic-bezier(0.05, 0.74, 0.27, 0.99);
    transition: transform 0.4s cubic-bezier(0.05, 0.74, 0.27, 0.99);
    -webkit-backface-visibility: hidden;
    -webkit-perspective: 1000;
    font-family: "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    font-weight: bold;
}

.icon-thumbnail>i {
    font-size: 14px;
}

.nav-collapse.collapse {
    height: 100% !important;
}


/* Secondary App Menu */

.toggle-secondary-sidebar {
    display: none;
}

.secondary-sidebar {
    background: #2d3446;
    width: 250px;
    float: left;
    padding-left: 47px;
    height: 100%;
    position: fixed;
}

.secondary-sidebar.not-fixed {
    position: inherit;
}

.secondary-sidebar .btn-compose {
    font-family: 'Montserrat';
    font-size: 13px;
    font-weight: normal;
    letter-spacing: 0.02em;
    text-transform: uppercase;
}

.secondary-sidebar .menu-title {
    color: rgba(120, 129, 149, 0.5);
    opacity: .5;
    font-size: 10.8px;
    font-family: 'Montserrat';
    font-weight: normal;
    letter-spacing: 0.03em;
}

.secondary-sidebar .main-menu {
    padding-left: 0;
}

.secondary-sidebar .main-menu>li {
    list-style: none;
}

.secondary-sidebar .main-menu>li.active>a {
    color: #48b0f7;
}

.secondary-sidebar .main-menu>li.active>a:hover {
    color: #48b0f7;
}

.secondary-sidebar .main-menu>li.active>a>.title {
    position: relative;
}

.secondary-sidebar .main-menu>li.active>a>.title:after {
    background: #48b0f7;
    border-radius: 50%;
    content: "";
    height: 7px;
    position: absolute;
    right: -14px;
    top: 6.5px;
    width: 7px;
}

.secondary-sidebar .main-menu>li a {
    font-size: 14px;
    color: #788195;
    line-height: 37px;
}

.secondary-sidebar .main-menu>li a:hover {
    color: #fff;
}

.secondary-sidebar .main-menu>li a>.title i {
    margin-right: 6px;
    opacity: .9;
}

.secondary-sidebar .sub-menu {
    margin-left: 23px;
}

.secondary-sidebar .sub-menu li {
    list-style: none;
    padding: 0;
}

.secondary-sidebar .sub-menu li.active a {
    color: #fff !important;
}

.secondary-sidebar .sub-menu li a {
    color: rgba(120, 129, 149, 0.5);
    line-height: 25px;
}

.secondary-sidebar .sub-menu li a:hover {
    color: #fff;
}

.secondary-sidebar .sub-menu li a .badge, .secondary-sidebar .main-menu li a .badge {
    background: transparent;
    font-size: 13px;
    color: #788195;
    line-height: 25px;
}

.split-view {
    position: relative;
    height: 100%;
}

.split-view .split-list {
    float: left;
    width: 360px;
    background: #fff;
    height: 100%;
    overflow-y: auto;
    position: relative;
    -webkit-overflow-scrolling: touch;
    border-right: 1px solid #e6e6e6;
    -webkit-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

.split-view .split-list.slideLeft {
    -webkit-transform: translate(-100%, 0);
    -ms-transform: translate(-100%, 0);
    transform: translate(-100%, 0);
}

.split-view .split-list .list-refresh {
    position: absolute;
    right: 18px;
    top: 5px;
    color: #626262;
    opacity: .34;
    z-index: 101;
}

.split-view .split-list .list-view-fake-header, .split-view .split-list .list-view-group-header {
    background: #f0f0f0;
    height: 30px;
    color: rgba(98, 98, 98, 0.7);
    font-family: 'Montserrat';
    text-transform: uppercase;
    font-size: 10.8px;
    padding-left: 13px;
    padding-top: 6px;
    letter-spacing: 0.04em;
    width: 100%;
}

.split-view .split-list .item {
    height: 117px;
    list-style: none;
    position: relative;
    border-bottom: 1px solid rgba(230, 230, 230, 0.7);
    cursor: pointer;
}

.split-view .split-list .item .inline {
    width: 230px;
}

.split-view .split-list .item .inline>* {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    font-family: arial;
}

.split-view .split-list .item .recipients {
    letter-spacing: 0.01em;
}

.split-view .split-list .item .checkbox {
    float: left;
    clear: left;
    display: none;
}

.split-view .split-list .item .subject {
    font-family: 'Helvetica';
    font-size: 14.33px;
    color: #3b4752;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    height: 36px;
    display: -webkit-box;
    white-space: normal;
    line-height: 18px;
}

.split-view .split-list .item .body {
    font-size: 12.6px;
    opacity: .52;
    height: 22px;
}

.split-view .split-list .item .datetime {
    color: #121212;
    font-family: arial;
    font-size: 11.1px;
    position: absolute;
    right: 20px;
    top: 15px;
}

.split-view .split-details {
    position: relative;
    overflow: auto;
    height: 100%;
}

.split-view .split-details .no-result {
    bottom: 0;
    left: 0;
    margin-top: -34px;
    opacity: 0.5;
    position: absolute;
    right: 0;
    text-align: center;
    top: 50%;
}

.split-view .split-details .actions {
    height: 50px;
    float: left;
}

.split-view .split-details .actions li {
    list-style: none;
    position: relative;
}

.split-view .split-details .actions li:last-child:after {
    display: none;
}

.split-view .split-details .actions li:after {
    content: "";
    height: 14px;
    position: absolute;
    right: -4px;
    top: 18px;
    width: 1px;
    background: rgba(0, 0, 0, 0.07);
}

.split-view .split-details .actions li a {
    font-size: 13.1px;
    color: #626262;
    font-weight: 600;
    padding: 0 13px;
    line-height: 50px;
    white-space: nowrap;
}

.inner-content {
    margin-top: 0px;
    padding: 0px;
    overflow: auto;
    margin-left: 250px;
    min-height: 100%;
}


/* Quick View 
------------------------------------
*/

.quickview-wrapper {
    position: fixed;
    right: -285px;
    top: 0;
    width: 285px;
    background: #fff;
    bottom: 0;
    z-index: 1000;
    box-shadow: 0 0 9px rgba(191, 191, 191, 0.36);
    border-left: 1px solid rgba(222, 227, 231, 0.56);
    -webkit-transition: -webkit-transform 400ms cubic-bezier(0.05, 0.74, 0.27, 0.99);
    transition: transform 400ms cubic-bezier(0.05, 0.74, 0.27, 0.99);
    -webkit-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -webkit-perspective: 1000;
}

.quickview-wrapper.open {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -ms-transform: translate(-100%, 0);
}

.quickview-wrapper .quickview-toggle {
    position: absolute;
    right: 12px;
    top: 2px;
    color: #788195;
    padding: 6px;
    opacity: 0.4;
}

.quickview-wrapper .quickview-toggle:hover {
    opacity: 1;
}

.quickview-wrapper .nav-tabs {
    /* Quickview Tabs */
    background-color: #2b303b;
    position: relative;
    padding: 0 43px;
}

.quickview-wrapper .nav-tabs>li>a {
    padding: 11px;
    color: #788195;
    opacity: 0.6;
    border: 0;
    text-align: center;
    font-size: 11px;
    font-weight: bold;
    min-width: 62px;
}

.quickview-wrapper .nav-tabs>li>a:hover {
    color: #788195;
    opacity: 1;
}

.quickview-wrapper .nav-tabs>li.active>a, .quickview-wrapper .nav-tabs>li.active>a:hover, .quickview-wrapper .nav-tabs>li.active>a:focus {
    background-color: transparent;
    border: 0;
    color: #cdd0d8;
    opacity: 1;
}

.quickview-wrapper .nav-tabs~.tab-content {
    position: absolute;
    padding: 0;
    left: 0;
    right: 0;
    top: 38px;
    bottom: 0;
    height: auto;
}

.quickview-wrapper .nav-tabs~.tab-content>div {
    height: 100%;
}

.quickview-wrapper .nav-tabs~.tab-content ul {
    margin: 0;
    padding: 0;
}

.quickview-wrapper .nav-tabs~.tab-content ul li {
    list-style: none;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes {
    /* Quickview Notes */
    background: #fbf9e3;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes a, .quickview-wrapper .nav-tabs~.tab-content .quickview-notes button {
    color: #968974;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list {
    position: relative;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar {
    height: 50px;
    padding: 0 25px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar ul {
    margin-top: 10px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar ul>li {
    display: inline-block;
    height: auto;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar ul>li a {
    height: 22px;
    line-height: 22px;
    display: block;
    padding: 0 5px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar ul>li a:hover, .quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar ul>li a.selected {
    background: #968974;
    color: #FBF9E3;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list .toolbar .btn-remove-notes {
    background: transparent;
    bottom: 8px;
    display: block;
    left: 50%;
    margin-left: -40%;
    position: absolute;
    width: 83%;
    border: 1px solid #968974;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul {
    padding: 0;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li {
    cursor: pointer;
    height: 42px;
    padding: 0 25px;
    display: block;
    clear: both;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li .left {
    float: left;
    width: 65%;
    height: 100%;
    padding-top: 9px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li .left .checkbox {
    display: none;
    float: left;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li .left .checkbox label {
    margin-right: 0;
    vertical-align: text-top;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li .left p {
    margin: 0;
    font-size: 13px;
    font-weight: bold;
    width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: middle;
    display: inline-block;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li .right {
    font-size: 10.5px;
    text-align: right;
    width: 35%;
    line-height: 41px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li .right .date {
    margin-right: 10px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .list>ul li:hover {
    background: #f4ecd1;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note {
    /* Quickview Note */
    background-image: url('../img/notes_lines.png');
    background-repeat: repeat-y;
    background-position: 27px top;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note>div {
    display: table;
    height: 100%;
    width: 100%;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .toolbar {
    background: #fcfcfa;
    height: 55px;
    width: 100%;
    display: table-row;
    box-shadow: 0 1px 1px -1px rgba(0, 0, 0, 0.33);
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .toolbar>li {
    display: inline-block;
    border-right: 1px solid #EDECEC;
    float: left;
    line-height: 55px;
    padding: 0;
    text-align: center;
    width: 55px;
    height: auto;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .toolbar>li>a {
    color: #a5a5a5;
    display: block;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .toolbar>li>a:hover {
    background: #fffaf6;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .toolbar>li>a.active {
    color: #333;
    background: #f9f1ea;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .toolbar:after {
    position: absolute;
    content: "";
    width: 100%;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body {
    display: table-row;
    height: 100%;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body>div {
    display: table;
    height: 100%;
    width: 100%;
    padding: 0 20px 0 45px;
    white-space: normal;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .top {
    height: 50px;
    display: table-row;
    clear: both;
    line-height: 50px;
    text-align: center;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .top>a {
    float: left;
    color: #b0b0a8;
    margin-left: 10px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .top>span {
    font-style: italic;
    color: #b0b0a8;
    font-size: 11px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .content {
    display: table-row;
    height: 100%;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .content form {
    height: 100%;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .content .quick-note-editor {
    font-size: 12px;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .content .quick-note-editor:focus {
    outline: none;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .content .quick-note-editor::-moz-selection {
    background: #fef8ae;
}

.quickview-wrapper .nav-tabs~.tab-content .quickview-notes .note .body .content .quick-note-editor::selection {
    background: #fef8ae;
}


/* Page Container 
------------------------------------
*/

.page-container {
    width: 100%;
    height: 100%;
    padding-left: 70px;
}

.page-container .page-content-wrapper {
    min-height: 100%;
    position: relative;
}

.page-container .page-content-wrapper .content {
    /* Content holder */
    z-index: 10;
    padding-top: 60px;
    padding-bottom: 72px;
    min-height: 100%;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.page-container .page-content-wrapper .content.full-width {
    width: 100%;
}

.page-container .page-content-wrapper .content .content-inner {
    display: inline-block;
    vertical-align: top;
    height: 100%;
    padding-left: 30px;
    position: relative;
}

.page-container .page-content-wrapper .content:only-child {
    padding-bottom: 0px;
}

.page-container .page-content-wrapper .content.overlay-footer {
    padding-bottom: 0px;
}

.page-container .page-content-wrapper .footer {
    /* Footer */
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    -webkit-transition: left 0.3s ease;
    transition: left 0.3s ease;
}

.page-container .page-content-wrapper .footer.fixed {
    position: fixed;
}

.page-title {
    margin-top: 0px;
}


/* Breadcrumbs
------------------------------------
*/

.breadcrumb {
    font-family: 'Montserrat';
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    box-shadow: none;
    background-color: transparent;
    padding: 15px 0;
    margin: 0;
    border: none;
    text-transform: uppercase;
    display: block;
}

.breadcrumb a {
    margin-left: 5px;
    margin-right: 5px;
    font-family: 'Montserrat';
    font-size: 11px !important;
    font-weight: 400;
    color: #7b7d82;
}

.breadcrumb a.active {
    font-weight: 600;
    color: #0090d9;
}

.breadcrumb li {
    padding-left: 0px;
}

.breadcrumb>li+li:before {
    padding: 0 5px;
    color: #515050;
    font-family: FontAwesome;
    content: "\f105";
    font-weight: bold;
}

.breadcrumb a, .breadcrumb i, .breadcrumb span, .breadcrumb li {
    color: #7b7d82;
    font-weight: 300;
    text-shadow: none;
}


/* Overlay Search 
------------------------------------
*/

.overlay {
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.95);
    z-index: 1010;
    padding-left: 64px;
    overflow: auto;
}

.overlay .inline-block {
    display: inline-block;
}

.overlay .overlay-brand {
    margin-left: 7px;
}

.overlay>div {
    width: 100%;
    height: 260px;
    display: block;
    overflow: hidden;
}

.overlay .has-results {
    overflow: visible;
}

.overlay .overlay-search {
    font-weight: 700;
    font-size: 77px;
    height: 100px;
    letter-spacing: -1.925px;
    line-height: 100px;
    width: 100%;
    padding-left: 0 !important;
}

.overlay .overlay-close {
    position: absolute;
    right: 20px;
    top: 25px;
}

.group-container {
    white-space: nowrap !important;
}

.group-container .single-group {
    vertical-align: top;
    display: inline-block;
    white-space: normal;
}

.jumbotron {
    position: relative;
    overflow: hidden;
    display: block;
    padding: 0;
    background-color: #fafafa;
}

.jumbotron .inner {
    position: relative;
    z-index: 2;
}

.jumbotron.lg {
    height: 600px;
}

.jumbotron .cover-photo {
    width: 100%;
    height: inherit;
    overflow: hidden;
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
    background-size: cover;
    background-color: #10cfbd;
}

.jumbotron .cover-photo img {
    display: none;
}

.jumbotron h1 {
    font-size: 44px;
}


/* Pages Image Icon Sent - Pixel Perfect 
------------------------------------
*/

.icon-set {
    background: url('../img/icons/top_tray.png') no-repeat;
    position: relative;
    display: block;
}

.icon-set.globe-fill {
    background-position: -1px -1px;
    width: 17px;
    height: 17px;
    top: 2px;
}

.icon-set.clip {
    background-position: -20px -2px;
    width: 16px;
    height: 16px;
}

.icon-set.grid-box {
    background-position: -41px -2px;
    width: 14px;
    height: 14px;
}

.icon-set.menu-hambuger {
    background-position: -58px -3px;
    width: 15px;
    height: 13px;
}

.icon-set.menu-hambuger-plus {
    background-position: -77px -1px;
    width: 18px;
    height: 15px;
}

.dropzone {
    overflow: hidden;
}

.dropzone .dz-default.dz-message {
    width: 100%;
}

.scroll {
    position: relative;
    overflow: auto;
}


/* Pages Scroll bar
------------------------------------
*/

.scroll-wrapper>.scroll-element, .scroll-wrapper>.scroll-element div {
    background: none;
    border: none;
    margin: 0;
    padding: 0;
    position: absolute;
    z-index: 10;
}

.scroll-wrapper>.scroll-element div {
    display: block;
    height: 100%;
    left: 0;
    top: 0;
    width: 100%;
}

.scroll-wrapper>.scroll-element.scroll-x {
    bottom: 2px;
    height: 7px;
    left: 0;
    min-width: 100%;
    width: 100%;
}

.scroll-wrapper>.scroll-element.scroll-y {
    height: 100%;
    min-height: 100%;
    right: 2px;
    top: 0;
    width: 4px;
}

.scroll-wrapper>.scroll-element .scroll-element_outer {
    opacity: 0.3;
}

.scroll-wrapper>.scroll-element .scroll-element_size {
    background-color: rgba(0, 0, 0, 0.07);
    opacity: 0;
}

.scroll-wrapper>.scroll-element .scroll-bar {
    background-color: #697686;
}

.scroll-wrapper>.scroll-element.scroll-x .scroll-bar {
    bottom: 0;
    height: 4px;
    min-width: 24px;
    top: auto;
}

.scroll-wrapper>.scroll-element.scroll-x .scroll-element_outer {
    bottom: 0;
    top: auto;
    left: 2px;
    -webkit-transition: height 0.2s;
    transition: height 0.2s;
}

.scroll-wrapper>.scroll-element.scroll-x .scroll-element_size {
    left: -4px;
}

.scroll-wrapper>.scroll-element.scroll-y .scroll-bar {
    left: auto;
    min-height: 24px;
    right: 0;
    width: 4px;
}

.scroll-wrapper>.scroll-element.scroll-y .scroll-element_outer {
    left: auto;
    right: 0;
    top: 2px;
    -webkit-transition: all 0.2s;
    transition: all 0.2s;
}

.scroll-wrapper>.scroll-element.scroll-y .scroll-element_size {
    top: -4px;
}

.scroll-wrapper.auto-hide>.scroll-element .scroll-element_track {
    display: none;
}

.scroll-wrapper>.scroll-element.scroll-x.scroll-scrolly_visible .scroll-element_size {
    left: -11px;
}

.scroll-wrapper>.scroll-element.scroll-y.scroll-scrollx_visible .scroll-element_size {
    top: -11px;
}


/* hover & drag */

.scroll-wrapper>.scroll-element:hover .scroll-element_outer, .scroll-wrapper>.scroll-element.scroll-draggable .scroll-element_outer {
    overflow: hidden;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
    filter: alpha(opacity=70);
    opacity: 0.7;
}

.scroll-wrapper>.scroll-element:hover .scroll-element_outer .scroll-element_size, .scroll-wrapper>.scroll-element.scroll-draggable .scroll-element_outer .scroll-element_size {
    opacity: 1;
}

.scroll-wrapper>.scroll-element:hover .scroll-element_outer .scroll-bar, .scroll-wrapper>.scroll-element.scroll-draggable .scroll-element_outer .scroll-bar {
    height: 100%;
    width: 100%;
}

.scroll-wrapper>.scroll-element.scroll-x:hover .scroll-element_outer, .scroll-wrapper>.scroll-element.scroll-x.scroll-draggable .scroll-element_outer {
    height: 10px;
    min-height: 7px;
}

.scroll-wrapper>.scroll-element.scroll-y:hover .scroll-element_outer, .scroll-wrapper>.scroll-element.scroll-y.scroll-draggable .scroll-element_outer {
    min-width: 7px;
    width: 7px;
}


/* Other overides */

.container-fluid {
    padding-left: 30px;
    padding-right: 30px;
}

.copyright {
    padding: 25px 0;
    border-top: 1px solid rgba(98, 98, 98, 0.07);
}

.navbar-center, .navbar-center>li {
    float: none;
    display: inline-block;
    *display: inline;
    /* ie7 fix */
    *zoom: 1;
    /* hasLayout ie7 trigger */
    vertical-align: top;
}

.navbar-nav li a {
    min-width: 50px;
}

.pager {
    margin: 0;
}


/* Horizontal Menu */

@media (min-width: 992px) {
    .horizontal-menu [data-pages="sidebar"]+.page-container {
        padding-left: 70px;
    }
}

.horizontal-menu [data-pages="sidebar"]+.page-container .header .brand {
    padding-left: inherit;
    text-align: center;
}

.horizontal-menu #horizontal-menu-toggle {
    display: block !important;
}

.horizontal-menu .page-container {
    padding-left: 0;
}

.horizontal-menu .header .brand {
    padding-left: 35px;
    text-align: left;
}

.horizontal-menu .header-seperation {
    display: none;
}

.horizontal-menu .bar {
    width: 100%;
    background-color: #ffffff;
    position: fixed;
    display: table;
    z-index: 50;
}

.horizontal-menu .bar-inner {
    display: table-cell;
    width: 100%;
}

.horizontal-menu .bar-inner>ul {
    margin: 0;
    padding: 0;
    padding-left: 16px;
}

.horizontal-menu .bar-inner>ul>li {
    font-family: "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
    display: inline-block;
    padding: 10px 15px;
    vertical-align: middle;
}

.horizontal-menu .bar-inner>ul>li.classic {
    position: relative;
}

.horizontal-menu .bar-inner>ul>li.open>a {
    opacity: 1;
}

.horizontal-menu .bar-inner>ul>li.mega.open, .horizontal-menu .bar-inner>ul>li.horizontal.open {
    position: inherit;
}

.horizontal-menu .bar-inner>ul>li>a {
    color: #000000;
}

.horizontal-menu .bar-inner>ul>li>a>.arrow {
    display: inline-block;
}

.horizontal-menu .bar-inner>ul>li>a>.arrow:before {
    display: inline;
    font-size: 16px;
    font-family: FontAwesome;
    height: auto;
    content: "\f107";
    font-weight: 300;
    text-shadow: none;
    margin-left: 8px;
    opacity: 0.5;
    position: relative;
    vertical-align: middle;
}

.horizontal-menu .bar-inner>ul>li a {
    opacity: 0.7;
}

.horizontal-menu .bar-inner>ul>li a .description {
    opacity: 0.7;
    transition: opacity 0.1s linear 0s;
}

.horizontal-menu .bar-inner>ul>li a:hover {
    opacity: 1;
}

.horizontal-menu .bar-inner>ul>li a:hover .description {
    opacity: 1;
}

.horizontal-menu .bar-inner>ul>li.open {
    background: #fff;
}

.horizontal-menu .bar-inner>ul>li.open>.classic {
    max-height: 999px;
}

.horizontal-menu .bar-inner>ul>li.open>.classic>li {
    opacity: 1;
}

.horizontal-menu .bar-inner>ul>li.open>.mega, .horizontal-menu .bar-inner>ul>li.open>.horizontal {
    display: block;
}

.horizontal-menu .bar-inner>ul>li>.classic {
    margin: 0;
    padding: 0;
    position: absolute;
    background-color: #fff;
    list-style: none;
    left: 0;
    right: 0;
    top: 40px;
    min-width: 220px;
    max-height: 0;
    overflow: hidden;
    -webkit-transition: all 0.3s linear 0s;
    transition: all 0.3s linear 0s;
}

.horizontal-menu .bar-inner>ul>li>.classic>li {
    margin: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e9ec;
    color: #22262e;
    opacity: 0;
    -webkit-transition: all 0.1s linear 0.1s;
    transition: all 0.1s linear 0.1s;
}

.horizontal-menu .bar-inner>ul>li>.classic>li a {
    color: #000000;
}

.horizontal-menu .bar-inner>ul>li>.classic>li a .description {
    display: block;
    font-size: 12px;
    color: #2c2c2c;
}

.horizontal-menu .bar-inner>ul>li>.classic>li:last-child {
    border-bottom: 0;
}

.horizontal-menu .bar-inner>ul>li>.horizontal {
    margin: 0;
    top: 40px;
    padding: 0;
    position: absolute;
    background-color: #fff;
    list-style: none;
    display: none;
    left: 0;
    right: 0;
    width: 100%;
    border-bottom: 1px solid #e5e9ec;
}

.horizontal-menu .bar-inner>ul>li>.horizontal li {
    margin: 15px;
    color: #000000;
    display: inline-block;
}

.horizontal-menu .bar-inner>ul>li>.horizontal li a {
    color: #000000;
}

.horizontal-menu .bar-inner>ul>li>.horizontal li a .description {
    display: block;
    font-size: 12px;
    color: #2c2c2c;
}

.horizontal-menu .bar-inner>ul>li>.mega {
    margin: 0;
    top: 40px;
    padding: 0;
    position: absolute;
    background-color: #fff;
    list-style: none;
    display: none;
    left: 0;
    right: 0;
    padding-bottom: 20px;
    border-bottom: 1px solid #e5e9ec;
}

.horizontal-menu .bar-inner>ul>li>.mega>li {
    margin: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e9ec;
    color: #000000;
}

.horizontal-menu .bar-inner>ul>li>.mega>li a {
    color: #000000;
}

.horizontal-menu .bar-inner>ul>li>.mega .sub-menu-heading {
    font-size: 14px;
    color: #000000;
    margin-bottom: 10px;
    margin-top: 20px;
}

.horizontal-menu .bar-inner>ul>li>.mega .sub-menu {
    list-style: none;
    margin: 0;
    padding: 0;
    margin-bottom: 10px;
}

.horizontal-menu .bar-inner>ul>li>.mega .sub-menu>li {
    padding-left: 0;
    padding-bottom: 5px;
}

.horizontal-menu .bar-inner>ul>li>.mega .sub-menu>li>a {
    color: #000000;
}

@media (min-width: 980px) {
    .horizontal-menu .page-content {
        margin-left: 0;
    }
    .horizontal-menu .page-content .content {
        padding-top: 123px;
    }
}


/*------------------------------------------------------------------
[2. View Ports]
*/

.view-port {
    position: relative;
    width: 100%;
    height: 100%;
    display: block;
    white-space: nowrap;
    word-spacing: 0;
    font-size: 0;
    overflow: hidden;
}

.view-port>* {
    font-size: initial;
}

.view-port .navbar {
    border-radius: 0;
    padding-left: 0;
    margin-bottom: 0;
    border-left: 0;
    display: table;
    width: 100%;
    top: 0;
    border-top: 0;
}

.view-port .navbar .navbar-inner {
    display: table-cell;
    height: 50px;
    vertical-align: middle;
}

.view-port .navbar .action {
    position: absolute;
    top: 0;
    line-height: 50px;
    z-index: 1;
}

.view-port .navbar .action.pull-right {
    right: 0;
}

.view-port .navbar .view-heading {
    font-size: 15px;
    text-align: center;
}

.view-port .navbar>p {
    line-height: 12px;
    font-size: 12px;
    margin: 0;
}

.view-port .navbar.navbar-sm {
    min-height: 35px;
}

.view-port .navbar.navbar-sm .navbar-inner {
    height: 35px;
}

.view-port .navbar.navbar-sm .action {
    line-height: 35px;
}

.view-port .view {
    display: inline-block;
    width: 100%;
    height: 100%;
    vertical-align: top;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-perspective: 1000;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
}

.view-port .view:first-child:before {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: 0;
    -webkit-transition: opacity 0.2s linear;
    transition: opacity 0.2s linear;
    z-index: -1;
}

.view-port .view:only-child {
    margin: 0;
}

.view-port.from-top>.view:last-child {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -ms-transform: translate(-100%, 0);
}

.view-port.push>.view:first-child {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -ms-transform: translate(-100%, 0);
}

.view-port.push>.view:last-child {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -ms-transform: translate(-100%, 0);
}

.view-port.push-parrallax>.view:first-child {
    -webkit-transition: all 400ms cubic-bezier(0.1, 0.7, 0.1, 1);
    transition: all 400ms cubic-bezier(0.1, 0.7, 0.1, 1);
    -webkit-transform: translate3d(-25%, 0, 0);
    transform: translate3d(-25%, 0, 0);
    -ms-transform: translate(-25%, 0);
}

.view-port.push-parrallax>.view:first-child:before {
    opacity: 0;
    z-index: 100;
}

.view-port.push-parrallax>.view:last-child {
    -webkit-transition: all 400ms cubic-bezier(0.1, 0.7, 0.1, 1);
    transition: all 400ms cubic-bezier(0.1, 0.7, 0.1, 1);
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -ms-transform: translate(-100%, 0);
    box-shadow: 0 0 9px rgba(191, 191, 191, 0.36);
}


/*------------------------------------------------------------------
[3. Chat]
*/


/* Chat Components
--------------------------------------------------
*/

.chat-view .chat-inner {
    padding: 15px;
    overflow-x: hidden;
    height: calc(100% - 103px);
}

.chat-view .message {
    margin-bottom: 10px;
    line-height: 30px;
}

.chat-view .profile-img-wrapper {
    height: 28px;
    width: 28px;
}

.chat-view .chat-bubble {
    position: relative;
    border-radius: 12px;
    padding: 4px 12px;
    font-size: 14px;
    line-height: 16px;
    margin: 5px 0px 0 5px;
    max-width: 60%;
    white-space: normal;
}

.chat-view .chat-bubble>p {
    margin: 0;
}

.chat-view .chat-bubble.from-me {
    background: #daeffd;
    color: #2c2c2c;
    opacity: 0.8;
    float: right;
    border: 1px solid rgba(0, 0, 0, 0.07);
}

.chat-view .chat-bubble.from-them {
    color: #2c2c2c;
    background: #f0f0f0;
    position: relative;
    opacity: 0.8;
    float: left;
    border: 1px solid #f0f5f8;
}

.chat-view .chat-input {
    border: 0;
    height: 45px;
}

.chat-view .chat-input:focus, .chat-view .chat-input:active {
    background-color: #fff;
}

.chat-view .user-controls {
    padding-top: 12px;
}


/* Chat User List
--------------------------------------------------
*/

.chat-user-list>a {
    height: 60px;
}


/* Alert List
--------------------------------------------------
*/

.alert-list>a {
    height: 45px;
}


/*------------------------------------------------------------------
[4. Panels]
*/

.panel {
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 1px;
    -webkit-border-radius: 1px;
    -moz-border-radius: 1px;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
    position: relative;
}

.panel .panel-heading {
    background: transparent;
    border-radius: 0px;
    border-bottom: 0px;
    padding: 20px 20px 7px 20px;
    position: relative;
    z-index: 3;
    min-height: 48px;
}

.panel .panel-heading.separator:after {
    content: "";
    height: 1px;
    background: rgba(0, 0, 0, 0.08);
    left: 16px;
    right: 16px;
    position: absolute;
    bottom: 0;
}

.panel .panel-heading+.panel-body {
    padding-top: 0;
    height: calc(100% - 50px);
}

.panel .panel-heading .panel-title, .heading {
    font-family: 'Montserrat';
    text-transform: capitalize;
    display: inline-block;
    letter-spacing: 0.02em;
    font-size: 20px;
    font-weight: 100;
    margin: 0;
    margin-bottom: 15px;
    padding: 0;
    line-height: normal;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-text-stroke: 0px;
    filter: alpha(opacity=40);
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
}

.panel .panel-heading .panel-controls {
    float: right;
    margin-top: -3px;
}

.panel .panel-heading .panel-controls ul {
    margin: 0;
    padding: 0;
}

.panel .panel-heading .panel-controls ul li {
    display: inline-block;
    list-style: none;
    line-height: 0;
}

.panel .panel-heading .panel-controls:after {
    content: "";
    display: table;
    clear: both;
}

.panel .panel-heading.panel-heading-hover .panel-title {
    opacity: .4;
}

.panel .panel-heading.panel-heading-hover:hover .panel-title {
    opacity: 1;
}

.panel.panel-default {
    border: 1px solid rgba(0, 0, 0, 0.07);
}

.panel.panel-bordered {
    border: 1px solid rgba(230, 230, 230, 0.7);
}

.panel.panel-condensed .panel-heading {
    padding: 13px 13px 0 13px;
    min-height: 30px;
}

.panel.panel-condensed .panel-heading .panel-title {
    opacity: .4;
}

.panel.panel-condensed .panel-body {
    padding: 13px;
}

.panel.panel-hover .panel-heading .panel-title {
    opacity: .4;
}

.panel.panel-hover:hover .panel-heading .panel-title {
    opacity: 1;
}

.panel.panel-transparent {
    background: transparent;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.panel.panel-transparent .panel-body {
    background: transparent;
}

.panel.full-height {
    height: calc(100%);
}

.panel.full-height .panel-body {
    height: auto;
    width: 100%;
    height: 100%;
}

.panel.panel-featured {
    -webkit-box-shadow: -1px 1px 3px 0px rgba(121, 129, 135, 0.14);
    box-shadow: -1px 1px 3px 0px rgba(121, 129, 135, 0.14);
    width: calc(100% - 50px);
    float: right;
}

.panel.panel-featured .panel-title h4 {
    font-family: 'Montserrat';
    font-size: 16px;
    text-transform: uppercase;
    color: #f0f0f0;
}

.panel.panel-featured .panel-body h3 {
    line-height: 34px;
    font-size: 26px;
}

.panel.panel-featured .footer .username {
    line-height: 8px;
    padding-top: 10px;
    font-size: 16px;
}

.panel.panel-featured .footer .buttons li {
    display: inline;
    list-style: none;
    font-weight: bold;
    margin-left: 20px;
}

.panel.panel-featured .footer .buttons li:first-child {
    margin-left: 0;
}

.panel.panel-featured .footer .buttons .heart {
    color: #f55753;
}

.panel.panel-featured .footer .buttons .comment {
    color: #626262;
}

.panel.panel-featured .ribbon {
    width: 38px;
    height: 38px;
    margin-left: -39px;
    float: left;
    -webkit-box-shadow: inset -3px 0px 3px 0px rgba(0, 0, 0, 0.14);
    box-shadow: inset -3px 0px 3px 0px rgba(0, 0, 0, 0.14);
}

.panel.panel-featured .ribbon.green {
    background: #48b0f7;
}

.panel.panel-featured .ribbon.blue {
    background: #10cfbd;
}

.panel.hover-fill:hover {
    background: #f0f0f0;
}

.panel.hover-stroke:hover {
    border: 1px solid #e6e6e6;
}

.panel .panel-body {
    padding: 20px;
    height: 100%;
    width: 100%;
}

.panel .panel-body.no-padding .row {
    margin-left: 0;
    margin-right: 0;
}

.panel .panel-body.no-bottom-padding {
    padding-bottom: 0;
}

.panel .panel-body.no-top-padding {
    padding-top: 0;
}

.panel .panel-body .title {
    margin-top: 0px;
}

.panel .panel-body.scrollable {
    margin-bottom: 20px;
}


/* Portlets
------------------------------------
*/

.portlet-progress {
    background: rgba(255, 255, 255, 0.8);
    bottom: 0;
    left: 0;
    position: absolute !important;
    right: 0;
    top: 0;
    display: none;
    z-index: 2;
}

.portlet-progress>.progress, .portlet-progress>.progress.progress-small {
    height: 3px;
}

.portlet-progress>.progress-circle-indeterminate, .portlet-progress>.portlet-bar-indeterminate {
    display: block;
    left: 50%;
    margin-left: -17px;
    margin-top: -17px;
    position: absolute;
    top: 50%;
}

.portlet-progress>.progress-circle-indeterminate {
    width: 35px;
    height: 35px;
}

.panel-maximized {
    position: fixed !important;
    left: 70px;
    top: 59px;
    bottom: 0;
    right: 0;
    z-index: 600;
    margin: 0;
}


/* Pages notification holder */

.panel .pgn-wrapper {
    position: absolute;
    z-index: 602;
}

.panel-heading a:not(.btn) {
    color: #626262 !important;
    opacity: .4;
    padding-top: 10px;
    padding-bottom: 10px;
}

.panel-heading a:not(.btn).portlet-refresh {
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
}

.panel-heading a:not(.btn).portlet-refresh.refreshing {
    opacity: 1;
}

.panel-heading .dropdown ul li a, .panel-heading .dropdown-menu li a {
    padding: 0 20px;
}

.panel-heading a[data-toggle]:hover {
    opacity: 1;
}

.portlet-icon {
    -moz-osx-font-smoothing: grayscale;
    font-family: "pages-icon";
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-transform: none;
}

.portlet-icon-close:before {
    content: "\e60a";
}

.portlet-icon-maximize:before {
    content: "\e634";
}

.portlet-icon-refresh:before {
    content: "\e600";
}

.portlet-icon-collapse:before {
    content: "\e62c";
}

.portlet-icon-settings:before {
    content: "\e655";
}

.portlet-icon-refresh-lg-master, .portlet-icon-refresh-lg-white {
    width: 15px;
    height: 15px;
    display: block;
    background-size: cover;
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
}

.portlet-icon-refresh-lg-master.fade, .portlet-icon-refresh-lg-white.fade {
    opacity: 0.1;
}

.portlet-icon-refresh-lg-master {
    background-image: url('../img/progress/progress-circle-lg-master-static.svg');
}

.portlet-icon-refresh-lg-white {
    background-image: url('../img/progress/progress-circle-lg-white-static.svg');
}

.portlet-icon-refresh-lg-master-animated, .portlet-icon-refresh-lg-white-animated {
    width: 15px;
    height: 15px;
    display: block;
    background-size: cover;
    opacity: 0;
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
}

.portlet-icon-refresh-lg-master-animated.active, .portlet-icon-refresh-lg-white-animated.active {
    opacity: 1;
}

.portlet-icon-refresh-lg-master-animated {
    background-image: url('../img/progress/progress-circle-lg-master.svg');
}

.portlet-icon-refresh-lg-white-animated {
    background-image: url('../img/progress/progress-circle-lg-white.svg');
}


/* For demo purpose only */

.panel-scroll {
    height: 100px;
}

.sortable .panel-heading {
    cursor: move;
}


/* To prevent lag while dragging */

.ui-sortable-handle {
    transition: max-height 0.3s ease 0s;
}

.sortable .grid .grid-title {
    cursor: move;
}

.ui-sortable {
    min-height: 0px !important;
}

.ui-sortable-placeholder {
    border: 1px dotted black;
    visibility: visible !important;
    height: 100% !important;
}

.ui-sortable-placeholder * {
    visibility: hidden;
}

.sortable-box-placeholder {
    background-color: #f0f0f0;
    border: 1px dashed #e6e6e6;
    display: block;
    margin-top: 0px !important;
    margin-bottom: 24px !important;
}

.sortable-box-placeholder * {
    visibility: hidden;
}

.sortable .panel {
    transition: none;
}

.sortable-column {
    padding-bottom: 100px;
}

.demo-portlet-scrollable {
    height: 158px;
}


/*------------------------------------------------------------------
[5. Typography]
*/


/* Standard elements
--------------------------------------------------
*/

html {
    font-size: 100%;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}

body {
    color: #626262;
    font-family: "Segoe UI", Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    letter-spacing: 0.01em;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    -webkit-font-feature-settings: "kern" 1;
    -moz-font-feature-settings: "kern" 1;
}


/* Headings 
------------------------------------
*/

h1, h2, h3, h4, h5, h6 {
    margin: 10px 0;
    font-family: "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    font-weight: 300;
    color: #2c2c2c;
}

h1 {
    font-size: 44px;
    line-height: 55px;
    letter-spacing: -0.08px;
}

h2 {
    font-size: 31px;
    line-height: 40px;
}

h3 {
    font-size: 27px;
    line-height: 35px;
}

h4 {
    font-size: 22px;
    line-height: 31.88px;
}

h5 {
    font-size: 18px;
    line-height: 25.88px;
}

h3 small, h4 small, h5 small {
    font-weight: 300;
}

h1.block, h2.block, h3.block, h4.block, h5.block, h6.block {
    padding-bottom: 10px;
}


/* Lins and Others
------------------------------------
*/

a {
    text-shadow: none !important;
    color: #3a8fc8;
    transition: color 0.1s linear 0s, background-color 0.1s linear 0s, opacity 0.2s linear 0s !important;
}

a:focus, a:hover, a:active {
    color: #48b0f7;
}

a, a:focus, a:hover, a:active {
    outline: 0 !important;
    text-decoration: none;
}

a[ng-click] {
    cursor: pointer;
}

br {
    line-height: normal;
    clear: both;
}

code {
    color: #c64643;
    background-color: #f0f0f0;
}

code:hover {
    background-color: #fddddd;
}

p {
    display: block;
    font-size: 14px;
    font-weight: normal;
    letter-spacing: 0.01em;
    line-height: 22px;
    margin: 0px 0px 10px 0px;
    font-style: normal;
    white-space: normal;
}

small, .small {
    line-height: 18px;
}

label.inline {
    display: inline-block;
    position: relative;
    top: 0px;
    font-size: 13px;
}

ul>li, ol>li {
    padding-left: 3px;
    line-height: 24px;
}

ul.lg-icon>li, ol.lg-icon>li {
    font-size: 21px;
}

ul.lg-icon>li span, ol.lg-icon>li span {
    font-size: 14px;
}

ul.no-style, ol.no-style {
    list-style: none;
    padding-left: 5px;
}

address {
    margin-bottom: 0px;
}

address a {
    color: #626262;
}

blockquote {
    padding: 0 0 0 18px;
    border-left: 0;
}

blockquote:before {
    content: '';
    font-family: FontAwesome;
    content: "\f10d";
    margin-right: 13px;
    float: left;
}

blockquote p {
    font-size: 16px;
}

blockquote small {
    line-height: 29px;
    color: #8b91a0;
    padding-left: 30px;
}

blockquote small:before {
    content: "";
}

blockquote.pull-right {
    border-right: 0;
}

blockquote.pull-right:before {
    float: right;
    content: '';
    font-family: FontAwesome;
    content: "\f10d";
    margin-left: 13px;
    margin-right: 0;
}

blockquote.pull-right small {
    padding-right: 30px;
}

blockquote.pull-right small:after {
    content: "";
}

hr {
    border-color: rgba(109, 92, 174, 0.13);
}

hr.double {
    border-width: 2px;
}

hr.dotted {
    border-style: dotted none none;
}


/* Font Sizes 
------------------------------------
*/

.small-text {
    font-size: 12px !important;
}

.normal-text {
    font-size: 13px !important;
}

.large-text {
    font-size: 15px !important;
}


/* Font Weights
------------------------------------
 */

.normal {
    font-weight: normal;
}

.semi-bold {
    font-weight: 400 !important;
}

.bold {
    font-weight: bold !important;
}

.light {
    font-weight: 300 !important;
}


/* Misc 
------------------------------------
*/

.logo {
    margin: 18px 14px;
}

.all-caps {
    text-transform: uppercase;
}

.muted {
    color: #e2e2e2;
}

.hint-text {
    opacity: .7;
}

.no-decoration {
    text-decoration: none !important;
}


/* Monochrome Colors
------------------------------------
 */

.bg-master {
    background-color: #626262;
}

.bg-master-light {
    background-color: #e6e6e6;
}

.bg-master-lighter {
    background-color: #f0f0f0;
}

.bg-master-lightest {
    background-color: #fafafa;
}

.bg-master-dark {
    background-color: #2c2c2c;
}

.bg-master-darker {
    background-color: #1a1a1a;
}

.bg-master-darkest {
    background-color: #121212;
}


/* Contextual Colors
------------------------------------
*/


/* Primary
------------------------------------
*/

.bg-primary {
    background-color: #6d5cae;
}

.bg-primary-dark {
    background-color: #584b8d;
}

.bg-primary-darker {
    background-color: #413768;
}

.bg-primary-light {
    background-color: #8a7dbe;
}

.bg-primary-lighter {
    background-color: #e2deef;
}


/* Complete 
------------------------------------
*/

.bg-complete {
    background-color: #48b0f7;
}

.bg-complete-dark {
    background-color: #3a8fc8;
}

.bg-complete-darker {
    background-color: #2b6a94;
}

.bg-complete-light {
    background-color: #6dc0f9;
}

.bg-complete-lighter {
    background-color: #daeffd;
}


/* Success 
------------------------------------
*/

.bg-success {
    background-color: #10cfbd;
}

.bg-success-dark {
    background-color: #0da899;
}

.bg-success-darker {
    background-color: #0a7c71;
}

.bg-success-light {
    background-color: #40d9ca;
}

.bg-success-lighter {
    background-color: #cff5f2;
}


/* Info
------------------------------------
*/

.bg-info {
    background-color: #3b4752;
}

.bg-info-dark {
    background-color: #303a42;
}

.bg-info-darker {
    background-color: #232b31;
}

.bg-info-light {
    background-color: #626c75;
}

.bg-info-lighter {
    background-color: #d8dadc;
}


/* Danger 
------------------------------------
*/

.bg-danger {
    background-color: #f55753;
}

.bg-danger-dark {
    background-color: #c64643;
}

.bg-danger-darker {
    background-color: #933432;
}

.bg-danger-light {
    background-color: #f77975;
}

.bg-danger-lighter {
    background-color: #fddddd;
}


/* Warning
------------------------------------
 */

.bg-warning {
    background-color: #f8d053;
}

.bg-warning-dark {
    background-color: #c9a843;
}

.bg-warning-darker {
    background-color: #957d32;
}

.bg-warning-light {
    background-color: #f9d975;
}

.bg-warning-lighter {
    background-color: #fef6dd;
}


/* More Color Options
------------------------------------
*/


/* Menu 
------------------------------------
*/

.bg-menu-dark {
    background-color: #21252d;
}

.bg-menu {
    background-color: #2b303b;
}

.bg-menu-light {
    background-color: #788195;
}


/* Gradients
------------------------------------
*/

.gradient-grey {
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 75%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 75%);
}

.gradient-black {
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 75%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 75%);
}


/* Other Colors
------------------------------------
*/

.bg-white {
    background-color: #fff;
}

.bg-transparent {
    background-color: transparent !important;
}


/* Text Colors */

.link {
    opacity: .7;
}

.link:hover {
    opacity: 1;
}

.text-master {
    color: #626262 !important;
}

.text-master-light {
    color: #e6e6e6 !important;
}

.text-black {
    color: #2c2c2c !important;
}

.text-white {
    color: #fff !important;
}

.text-complete {
    color: #48b0f7 !important;
}

.text-success {
    color: #10cfbd !important;
}

.text-info {
    color: #3b4752 !important;
}

.text-warning {
    color: #f8d053 !important;
}

.text-warning-dark {
    color: #c9a843 !important;
}

.text-danger {
    color: #f55753 !important;
}

.text-primary {
    color: #6d5cae !important;
}


/* Text Aligngments
------------------------------------
*/

.text-right {
    text-align: right !important;
}

.text-left {
    text-align: left !important;
}

.text-center {
    text-align: center !important;
}


/* Labels
------------------------------------
*/

.label {
    padding: 3px 9px;
    font-size: 11px;
    text-shadow: none;
    background-color: #e6e6e6;
    font-weight: 600;
    color: #626262;
}

.label-success {
    background-color: #10cfbd;
    color: #fff;
}

.label-warning {
    background-color: #f8d053;
    color: #fff;
}

.label-important, .label-danger {
    background-color: #f55753;
    color: #fff;
}

.label-info {
    background-color: #48b0f7;
    color: #fff;
}

.label-inverse {
    background-color: #3a8fc8;
    color: #fff;
}

.label-white {
    background-color: #fff;
    color: #626262;
}


/* Font Sizes
------------------------------------
*/

.fs-10 {
    font-size: 10px !important;
}

.fs-11 {
    font-size: 11px !important;
}

.fs-12 {
    font-size: 12px !important;
}

.fs-13 {
    font-size: 13px !important;
}

.fs-14 {
    font-size: 14px !important;
}

.fs-15 {
    font-size: 15px !important;
}

.fs-16 {
    font-size: 16px !important;
}


/* Line-heights
------------------------------------
*/

.lh-normal {
    line-height: normal;
}

.lh-10 {
    line-height: 10px;
}

.lh-11 {
    line-height: 11px;
}

.lh-12 {
    line-height: 12px;
}

.lh-13 {
    line-height: 13px;
}

.lh-14 {
    line-height: 14px;
}

.lh-15 {
    line-height: 15px;
}

.lh-16 {
    line-height: 16px;
}


/* Font Faces
------------------------------------
*/

.font-arial {
    font-family: Arial, sans-serif !important;
}

.font-montserrat {
    font-family: 'Montserrat' !important;
}

.font-georgia {
    font-family: Georgia !important;
}

.font-heading {
    font-family: "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
}


/* Wells
------------------------------------
*/

.well {
    background-color: #e6e6e6;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    background-image: none;
}

.well.well-large {
    padding: 24px;
    width: auto;
}

.well.well-small {
    padding: 13px;
    width: auto;
}

.well.green {
    background-color: #48b0f7;
    color: #ffffff;
    border: none;
}

.overflow-ellipsis {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}

.jumbotron p {
    font-size: 14px;
    font-weight: normal;
    margin-bottom: inherit;
}

.jumbotron p.small {
    font-size: 85%;
}


/* Responsive Handlers : Typo
------------------------------------
*/

@media (max-width: 1400px) {
    body, p {
        font-size: 13px;
        line-height: 20px;
    }
    h1 {
        font-size: 33px;
        line-height: 44px;
        letter-spacing: -0.08px;
    }
    h2 {
        font-size: 28px;
        line-height: 40px;
    }
    h3 {
        font-size: 24px;
        line-height: 35.88px;
    }
    h4 {
        font-size: 18px;
        line-height: 33.88px;
    }
    h5 {
        font-size: 16px;
        line-height: 25.88px;
    }
    small, .small {
        font-size: 89%;
        line-height: 17px;
    }
}


/* For Windows : Fixes 
------------------------------------
*/

.windows body, .windows p {
    font-size: 13px;
    letter-spacing: normal;
}

.windows h1 {
    font-size: 33px;
    line-height: 49px;
}

.windows h2 {
    font-size: 29px;
    line-height: 40px;
}

.windows h3 {
    font-size: 29px;
    line-height: 33px;
}

.windows h4 {
    font-size: 23px;
    line-height: 32px;
}

.windows h5 {
    font-size: 19px;
    line-height: 28px;
    font-weight: normal;
}

.windows h1, .windows h2, .windows h3, .windows h4, .windows h5 {
    font-weight: 300;
    letter-spacing: normal;
}

.windows .jumbotron p {
    font-size: 13px;
}

.windows .jumbotron p.small {
    font-size: 88%;
}

.windows small, .windows .small {
    font-size: 89%;
}


/*------------------------------------------------------------------
[6. Buttons]
*/


/*
[Buttons Base Styles]
*/

.btn {
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    letter-spacing: 0.01em;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    -webkit-font-feature-settings: "kern" 1;
    -moz-font-feature-settings: "kern" 1;
    margin-bottom: 0;
    border: 1px solid #f0f0f0;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    background-image: none !important;
    color: #626262;
    background-color: #ffffff;
    text-shadow: none;
    box-shadow: none;
    line-height: 21px;
    padding-left: 17px;
    padding-right: 17px;
    position: relative;
    transition: color 0.1s linear 0s, background-color 0.1s linear 0s, opacity 0.2s linear 0s !important;
}

.btn:hover {
    background-color: #fafafa;
    border: 1px solid rgba(98, 98, 98, 0.27);
}

.btn.active {
    border-color: #e6e6e6;
    background: #fff;
}

.btn:focus, .btn:active:focus, .btn.active:focus {
    outline: none !important;
    outline-style: none;
}

.btn .caret {
    margin-left: 3px;
}

.btn .caret.single {
    margin-left: 0px;
}

.btn:hover, .btn:focus, .btn:active, .btn.active, .btn.disabled, .btn[disabled] {
    box-shadow: none;
}

button:focus {
    outline: none !important;
}


/*
Alternate buttons
--------------------------------------------------
*/

.btn-primary, .btn-primary:focus {
    color: #ffffff;
    background-color: #6d5cae;
    border-color: #6d5cae;
}

.btn-primary.active, .btn-primary:active, .btn-primary.active:focus, .btn-primary:active:focus, .btn-primary:active:hover, .open .dropdown-toggle.btn-primary {
    background-color: #584b8d;
    border-color: #584b8d;
    color: #ffffff;
}

.btn-primary.hover, .btn-primary:hover, .open .dropdown-toggle.btn-primary {
    background-color: #8a7dbe;
    border-color: #8a7dbe;
    color: #ffffff;
}

.btn-primary.active:hover {
    background: #5e4f96;
    border-color: #5e4f96;
}

.btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active {
    background-color: #6d5cae;
    border-color: #6d5cae;
}

.btn-primary .badge {
    color: #6d5cae;
    background-color: #ffffff;
}

.btn-success, .btn-success:focus {
    color: #ffffff;
    background-color: #10cfbd;
    border-color: #10cfbd;
}

.btn-success.active, .btn-success:active, .btn-success.active:focus, .btn-success:active:focus, .btn-success:active:hover, .open .dropdown-toggle.btn-success {
    background-color: #0da899;
    border-color: #0da899;
    color: #ffffff;
}

.btn-success.hover, .btn-success:hover, .open .dropdown-toggle.btn-success {
    background-color: #40d9ca;
    border-color: #40d9ca;
    color: #ffffff;
}

.btn-success.active:hover {
    background: #0eb2a3;
    border-color: #0eb2a3;
}

.btn-success.disabled, .btn-success[disabled], fieldset[disabled] .btn-success, .btn-success.disabled:hover, .btn-success[disabled]:hover, fieldset[disabled] .btn-success:hover, .btn-success.disabled:focus, .btn-success[disabled]:focus, fieldset[disabled] .btn-success:focus, .btn-success.disabled:active, .btn-success[disabled]:active, fieldset[disabled] .btn-success:active, .btn-success.disabled.active, .btn-success[disabled].active, fieldset[disabled] .btn-success.active {
    background-color: #10cfbd;
    border-color: #10cfbd;
}

.btn-success .badge {
    color: #10cfbd;
    background-color: #ffffff;
}

.btn-complete, .btn-complete:focus {
    color: #ffffff;
    background-color: #48b0f7;
    border-color: #48b0f7;
}

.btn-complete.active, .btn-complete:active, .btn-complete.active:focus, .btn-complete:active:focus, .btn-complete:active:hover, .open .dropdown-toggle.btn-complete {
    background-color: #3a8fc8;
    border-color: #3a8fc8;
    color: #ffffff;
}

.btn-complete.hover, .btn-complete:hover, .open .dropdown-toggle.btn-complete {
    background-color: #6dc0f9;
    border-color: #6dc0f9;
    color: #ffffff;
}

.btn-complete.active:hover {
    background: #3e97d4;
    border-color: #3e97d4;
}

.btn-complete.disabled, .btn-complete[disabled], fieldset[disabled] .btn-complete, .btn-complete.disabled:hover, .btn-complete[disabled]:hover, fieldset[disabled] .btn-complete:hover, .btn-complete.disabled:focus, .btn-complete[disabled]:focus, fieldset[disabled] .btn-complete:focus, .btn-complete.disabled:active, .btn-complete[disabled]:active, fieldset[disabled] .btn-complete:active, .btn-complete.disabled.active, .btn-complete[disabled].active, fieldset[disabled] .btn-complete.active {
    background-color: #48b0f7;
    border-color: #48b0f7;
}

.btn-complete .badge {
    color: #48b0f7;
    background-color: #ffffff;
}

.btn-info, .btn-info:focus {
    color: #ffffff;
    background-color: #3b4752;
    border-color: #3b4752;
}

.btn-info.active, .btn-info:active, .btn-info.active:focus, .btn-info:active:focus, .btn-info:active:hover, .open .dropdown-toggle.btn-info {
    background-color: #303a42;
    border-color: #303a42;
    color: #ffffff;
}

.btn-info.hover, .btn-info:hover, .open .dropdown-toggle.btn-info {
    background-color: #626c75;
    border-color: #626c75;
    color: #ffffff;
}

.btn-info.active:hover {
    background: #333d47;
    border-color: #333d47;
}

.btn-info.disabled, .btn-info[disabled], fieldset[disabled] .btn-info, .btn-info.disabled:hover, .btn-info[disabled]:hover, fieldset[disabled] .btn-info:hover, .btn-info.disabled:focus, .btn-info[disabled]:focus, fieldset[disabled] .btn-info:focus, .btn-info.disabled:active, .btn-info[disabled]:active, fieldset[disabled] .btn-info:active, .btn-info.disabled.active, .btn-info[disabled].active, fieldset[disabled] .btn-info.active {
    background-color: #3b4752;
    border-color: #3b4752;
}

.btn-info .badge {
    color: #3b4752;
    background-color: #ffffff;
}

.btn-warning, .btn-warning:focus {
    color: #ffffff;
    background-color: #f8d053;
    border-color: #f8d053;
}

.btn-warning.active, .btn-warning:active, .btn-warning.active:focus, .btn-warning:active:focus, .btn-warning:active:hover, .open .dropdown-toggle.btn-warning {
    background-color: #c9a843;
    border-color: #c9a843;
    color: #ffffff;
}

.btn-warning.hover, .btn-warning:hover, .open .dropdown-toggle.btn-warning {
    background-color: #f9d975;
    border-color: #f9d975;
    color: #ffffff;
}

.btn-warning.active:hover {
    background: #d5b347;
    border-color: #d5b347;
}

.btn-warning.disabled, .btn-warning[disabled], fieldset[disabled] .btn-warning, .btn-warning.disabled:hover, .btn-warning[disabled]:hover, fieldset[disabled] .btn-warning:hover, .btn-warning.disabled:focus, .btn-warning[disabled]:focus, fieldset[disabled] .btn-warning:focus, .btn-warning.disabled:active, .btn-warning[disabled]:active, fieldset[disabled] .btn-warning:active, .btn-warning.disabled.active, .btn-warning[disabled].active, fieldset[disabled] .btn-warning.active {
    background-color: #f8d053;
    border-color: #f8d053;
}

.btn-warning .badge {
    color: #f8d053;
    background-color: #ffffff;
}

.btn-danger, .btn-danger:focus {
    color: #ffffff;
    background-color: #f55753;
    border-color: #f55753;
}

.btn-danger.active, .btn-danger:active, .btn-danger.active:focus, .btn-danger:active:focus, .btn-danger:active:hover, .open .dropdown-toggle.btn-danger {
    background-color: #c64643;
    border-color: #c64643;
    color: #ffffff;
}

.btn-danger.hover, .btn-danger:hover, .open .dropdown-toggle.btn-danger {
    background-color: #f77975;
    border-color: #f77975;
    color: #ffffff;
}

.btn-danger.active:hover {
    background: #d34b47;
    border-color: #d34b47;
}

.btn-danger.disabled, .btn-danger[disabled], fieldset[disabled] .btn-danger, .btn-danger.disabled:hover, .btn-danger[disabled]:hover, fieldset[disabled] .btn-danger:hover, .btn-danger.disabled:focus, .btn-danger[disabled]:focus, fieldset[disabled] .btn-danger:focus, .btn-danger.disabled:active, .btn-danger[disabled]:active, fieldset[disabled] .btn-danger:active, .btn-danger.disabled.active, .btn-danger[disabled].active, fieldset[disabled] .btn-danger.active {
    background-color: #f55753;
    border-color: #f55753;
}

.btn-danger .badge {
    color: #f55753;
    background-color: #ffffff;
}

.btn-default, .btn-default:focus {
    color: #5e5e5e;
    background-color: #ffffff;
    border-color: #f0f0f0;
}

.btn-default.active, .btn-default:active, .btn-default.active:focus, .btn-default:active:focus, .btn-default:active:hover {
    background-color: #f0f0f0;
    border-color: #e6e6e6;
    color: #2c2c2c;
}

.btn-default.hover, .btn-default:hover {
    background-color: #fafafa;
    border-color: rgba(98, 98, 98, 0.27);
    color: #1a1a1a;
}

.btn-default.active:hover {
    background: #f0f0f0;
}

.btn-link {
    color: #5e5e5e;
    background-color: transparent;
    border: none;
}

.btn-link:hover, .btn-link:focus, .btn-link:active, .btn-link.active, .btn-link.disabled, .btn-link[disabled] {
    background-color: transparent;
    border: none;
    text-decoration: none;
    outline: none;
}

.btn-file {
    position: relative;
    overflow: hidden;
}

.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    background: red;
    cursor: inherit;
    display: block;
}


/*
Button Sizes
--------------------------------------------------
*/

.btn-lg, .btn-group-lg>.btn {
    padding-left: 28px;
    padding-right: 28px;
    line-height: 23px;
}

.btn-sm, .btn-group-sm>.btn {
    padding-left: 16px;
    padding-right: 16px;
    font-size: 11.9px;
    line-height: 20px;
}

.btn-xs, .btn-group-xs>.btn {
    padding: 2px 9px;
    font-size: 10.5px;
}

.btn-cons {
    margin-right: 5px;
    min-width: 120px;
}


/*
Rounded buttons
--------------------------------------------------
*/

.btn-rounded {
    border-radius: 100px;
}


/*
 Dropdown menus
--------------------------------------------------
*/

.btn-group.open .dropdown-toggle, .open .dropdown-toggle, .open.dropdown-default .dropdown-toggle {
    box-shadow: none;
}


/* Pages default dropdown */

.dropdown-default {
    display: inline-block;
}

.dropdown-default.open>.btn.dropdown-toggle {
    border-color: transparent !important;
    background: transparent !important;
    z-index: 791 !important;
}

.dropdown-default.open .dropdown-menu {
    opacity: 1;
    transform: scale(1, 1);
    z-index: 700;
}

.dropdown-default.open .dropdown-menu li {
    visibility: visible;
}

.dropdown-default.open.dropup>.btn-primary+.dropdown-menu:after, .dropdown-default.open.dropup>.btn-success+.dropdown-menu:after, .dropdown-default.open.dropup>.btn-complete+.dropdown-menu:after, .dropdown-default.open.dropup>.btn-warning+.dropdown-menu:after, .dropdown-default.open.dropup>.btn-danger+.dropdown-menu:after, .dropdown-default.open.dropup>.btn-info+.dropdown-menu:after {
    top: auto;
    bottom: 0;
}

.dropdown-default.open>.btn-primary+.dropdown-menu:after, .dropdown-default.open>.btn-success+.dropdown-menu:after, .dropdown-default.open>.btn-complete+.dropdown-menu:after, .dropdown-default.open>.btn-warning+.dropdown-menu:after, .dropdown-default.open>.btn-danger+.dropdown-menu:after, .dropdown-default.open>.btn-info+.dropdown-menu:after {
    top: 0;
    height: 42px;
}

.dropdown-default.open>.btn-primary+.dropdown-menu:after {
    background-color: #6d5cae;
}

.dropdown-default.open>.btn-success+.dropdown-menu:after {
    background-color: #10cfbd;
}

.dropdown-default.open>.btn-complete+.dropdown-menu:after {
    background-color: #48b0f7;
}

.dropdown-default.open>.btn-warning+.dropdown-menu:after {
    background-color: #f8d053;
}

.dropdown-default.open>.btn-danger+.dropdown-menu:after {
    background-color: #f55753;
}

.dropdown-default.open>.btn-info+.dropdown-menu:after {
    background-color: #3b4752;
}

.dropdown-default.dropup .btn.dropdown-toggle.btn-lg+.dropdown-menu {
    margin-bottom: -47px;
    padding-bottom: 49px;
}

.dropdown-default.dropup .btn.dropdown-toggle.btn-lg+.dropdown-menu:after {
    bottom: 49px;
}

.dropdown-default.dropup .btn.dropdown-toggle.btn-sm+.dropdown-menu {
    margin-bottom: -34px;
    padding-bottom: 36px;
}

.dropdown-default.dropup .btn.dropdown-toggle.btn-sm+.dropdown-menu:after {
    bottom: 36px;
}

.dropdown-default.dropup .btn.dropdown-toggle.btn-xs+.dropdown-menu {
    margin-bottom: -29px;
    padding-bottom: 31px;
}

.dropdown-default.dropup .btn.dropdown-toggle.btn-xs+.dropdown-menu:after {
    bottom: 31px;
}

.dropdown-default.dropup .dropdown-menu {
    margin-bottom: -40px;
    padding: 0 3px 44px 0 !important;
    transform-origin: center bottom 0;
}

.dropdown-default.dropup .dropdown-menu:after {
    bottom: 43px;
    top: auto !important;
}

.dropdown-default .btn.dropdown-toggle {
    text-align: left;
    padding-right: 27px;
}

.dropdown-default .btn.dropdown-toggle.btn-lg {
    padding-right: 42px;
}

.dropdown-default .btn.dropdown-toggle.btn-lg .caret {
    right: 26px;
}

.dropdown-default .btn.dropdown-toggle.btn-lg+.dropdown-menu {
    margin-top: -47px;
    padding-top: 49px;
}

.dropdown-default .btn.dropdown-toggle.btn-lg+.dropdown-menu:after {
    top: 49px;
}

.dropdown-default .btn.dropdown-toggle.btn-sm {
    padding-right: 26px;
}

.dropdown-default .btn.dropdown-toggle.btn-sm .caret {
    right: 16px;
}

.dropdown-default .btn.dropdown-toggle.btn-sm+.dropdown-menu {
    margin-top: -34px;
    padding-top: 36px;
}

.dropdown-default .btn.dropdown-toggle.btn-sm+.dropdown-menu:after {
    top: 36px;
}

.dropdown-default .btn.dropdown-toggle.btn-xs {
    padding-right: 21px;
}

.dropdown-default .btn.dropdown-toggle.btn-xs .caret {
    right: 8px;
}

.dropdown-default .btn.dropdown-toggle.btn-xs+.dropdown-menu {
    margin-top: -29px;
    padding-top: 31px;
}

.dropdown-default .btn.dropdown-toggle.btn-xs+.dropdown-menu:after {
    top: 31px;
}

.dropdown-default .btn.dropdown-toggle .caret {
    position: absolute;
    right: 15px;
    top: 50%;
    margin-top: -2px;
}

.dropdown-default .btn-rounded {
    padding-left: 17px;
    padding-right: 17px;
}

.dropdown-default .btn-rounded+.dropdown-menu {
    border-radius: 17px;
}

.dropdown-default .dropdown-menu {
    margin-top: -40px;
    padding-top: 42px;
    overflow: hidden;
    backface-visibility: hidden;
    display: block;
    opacity: 0;
    transform: scale(1, 0);
    transform-origin: center top 0;
    -webkit-transition: all 170ms cubic-bezier(0.05, 0.74, 0.27, 0.99) 0s;
    transition: all 170ms cubic-bezier(0.05, 0.74, 0.27, 0.99) 0s;
    z-index: -1;
}

.dropdown-default .dropdown-menu:after {
    content: "";
    position: absolute;
    height: 1px;
    left: 0;
    top: 42px;
    background: #e6e6e6;
    width: 100%;
}

.dropdown-default .dropdown-menu li {
    visibility: hidden;
}

.dropdown-menu {
    position: absolute;
    display: none;
    float: left;
    list-style: none;
    text-shadow: none;
    -webkit-box-shadow: 0px 0px 5px rgba(98, 98, 98, 0.2);
    box-shadow: 0px 0px 5px rgba(98, 98, 98, 0.2);
    border: none;
    border-radius: 3px;
    font-size: 13px;
    margin: 0;
    background: #fafafa;
    min-width: 50px;
    z-index: 700 !important;
}

.dropdown-menu .divider {
    background-color: #e6e6e6;
    height: 1px;
    margin: 3px 0;
    border-bottom: 0px;
}

.dropdown-menu>li {
    padding-left: 0px;
}

.dropdown-menu>li:first-child {
    padding-top: 9px;
}

.dropdown-menu>li:last-child {
    padding-bottom: 9px;
}

.dropdown-menu>li.dropdown-header {
    padding: 3px 20px;
}

.dropdown-menu>li.active>a, .dropdown-menu>li.active>a:hover, .dropdown-menu>li.active>a:focus {
    color: #1a1a1a;
    text-decoration: none;
    background-color: #f0f0f0;
    background-image: none;
}

.dropdown-menu>li.disabled>a, .dropdown-menu>li.disabled>a:hover, .dropdown-menu>li.disabled>a:focus {
    color: #959595;
}

.dropdown-menu>li.disabled>a:hover, .dropdown-menu>li.disabled>a:focus {
    text-decoration: none;
    cursor: default;
    background-color: transparent;
    background-image: none;
}

.dropdown-menu>li>a {
    line-height: 35px;
    color: #626262;
    padding: 0 20px;
    border-radius: 3px;
    text-align: left;
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
    color: #1a1a1a;
    text-decoration: none;
    background-color: transparent;
    background-image: none;
}

.dropdown-backdrop {
    z-index: 600;
}


/*
Animated buttons
--------------------------------------------------
*/

.btn-animated {
    overflow: hidden;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    transform-style: preserve-3d;
}

.btn-animated>span {
    display: inline-block;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    transform-style: preserve-3d;
}

.btn-animated:before {
    position: absolute;
    height: 100%;
    width: 100%;
    font-size: 100%;
    line-height: 2.5;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

.btn-animated:after {
    content: '';
    position: absolute;
    z-index: -1;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

.btn-animated.from-top:before {
    left: 0;
    top: -100%;
}

.btn-animated.from-top:hover:before, .btn-animated.from-top.show-icon:before {
    top: 0;
}

.btn-animated.from-top:hover>span, .btn-animated.from-top.show-icon>span {
    -webkit-transform: translateY(300%);
    -ms-transform: translateY(300%);
    transform: translateY(300%);
}

.btn-animated.from-left:before {
    left: -100%;
    top: 0;
}

.btn-animated.from-left:hover:before, .btn-animated.from-left.show-icon:before {
    left: 0;
}

.btn-animated.from-left:hover>span, .btn-animated.from-left.show-icon>span {
    -webkit-transform: translateX(200%);
    -ms-transform: translateX(200%);
    transform: translateX(200%);
}

.btn-animated.fa:before {
    font-family: FontAwesome;
}

.btn-animated.pg:before {
    font-family: "pages-icon";
}


/*
Tag buttons
--------------------------------------------------
*/

.btn-tag {
    line-height: 17px;
    border-radius: 17px 3px 3px 17px;
    padding: 5px 19px;
}

.btn-tag:hover, .btn-tag.hover {
    border-color: transparent;
}

.btn-tag.btn-tag-light {
    background: #fafdff;
    color: #5b8ca5;
    border: 1px solid #cbe4f0;
}

.btn-tag.btn-tag-light:hover {
    background: #fff;
}

.btn-tag.btn-tag-dark {
    background: #e6e6e6;
    color: #626262;
}

.btn-tag.btn-tag-dark:hover {
    background: #ebebeb;
}

.btn-tag.btn-tag-rounded {
    border-radius: 17px;
}


/*
Misc buttons
--------------------------------------------------
*/

.btn-toolbar .btn {
    padding-left: 14px;
    padding-right: 14px;
}

.pager .disabled>button, .pager .disabled>button:hover, .pager .disabled>button:focus, .pager .disabled>span {
    cursor: not-allowed;
    opacity: .5;
}


/*------------------------------------------------------------------
[7. Alerts]
*/

.alert {
    background-image: none;
    box-shadow: none;
    text-shadow: none;
    padding: 9px 19px 9px 15px;
    border-radius: 3px;
    font-size: 13px;
    border-width: 0;
    -webkit-transition: all 0.2s linear 0s;
    transition: all 0.2s linear 0s;
}

.alert.bordered {
    border-width: 1px;
}

.alert .link {
    color: #ce8f22;
    font-weight: bold;
}

.alert .alert-heading {
    color: #ce8f22 !important;
    margin-bottom: 5px;
    font-weight: 600;
}

.alert .btn-small {
    position: relative;
    top: -3.5px;
}

.alert .button-set .btn {
    position: relative;
    top: 8px;
}

.alert .close {
    background: url("../img/icons/noti-cross.png") no-repeat scroll 0 0 transparent;
    background-position: -9px -10px;
    width: 10px;
    height: 9px;
    position: relative;
    opacity: 0.8;
    top: 4.5px;
    float: right;
    margin-left: 20px;
    font-size: 0;
}

.alert .close:hover {
    opacity: 1;
}


/* Alert : Color Options
------------------------------------
*/

.alert-danger, .alert-error {
    background-color: #fddddd;
    color: #933432;
    border-color: #933432;
}

.alert-danger .close, .alert-error .close {
    background-position: -95px -10px !important;
}

.alert-warning {
    background-color: #fef6dd;
    color: #957d32;
    border-color: #957d32;
}

.alert-info {
    background-color: #daeffd;
    color: #2b6a94;
    border-color: #2b6a94;
}

.alert-info .close {
    background-position: -67px -10px !important;
}

.alert-success {
    background-color: #cff5f2;
    color: #0a7c71;
    border-color: #0a7c71;
}

.alert-success .close {
    background-position: -38px -10px !important;
}

.alert-default {
    background-color: #fff;
    color: #626262;
    border-color: #e6e6e6;
}

.alert-default .close {
    background-position: -67px -10px !important;
}


/*------------------------------------------------------------------
[8. Notifications]
*/


/* Badges
--------------------------------------------------
*/

.badge {
    text-shadow: none;
    font-family: wf_segoe-ui_light, wf_segoe-ui_normal, "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 600;
    background-color: #e6e6e6;
    font-size: 11px;
    padding-left: 6px;
    padding-right: 6px;
    padding-bottom: 4px;
    color: #626262;
}

.badge-success {
    background-color: #10cfbd;
    color: #ffffff;
}

.badge-warning {
    background-color: #f8d053;
    color: #ffffff;
}

.badge-important {
    background-color: #f55753;
    color: #ffffff;
}

.badge-danger {
    background-color: #f55753;
    color: #ffffff;
}

.badge-info {
    background-color: #3b4752;
    color: #ffffff;
}

.badge-inverse {
    background-color: #2b6a94;
    color: #ffffff;
}

.badge-white {
    background-color: #ffffff;
    color: #626262;
}

.badge-disable {
    background-color: #2c2c2c;
    color: #626262;
}


/* Notification popup
--------------------------------------------------
*/

.popover {
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 9px rgba(191, 191, 191, 0.36);
    z-index: 790;
}

.notification-toggle {
    top: 35px;
    left: -26px;
    padding: 0;
}

.notification-toggle:before {
    border-bottom: 0px !important;
}

.notification-toggle:after {
    border-bottom: 0px !important;
}

.notification-panel {
    background-color: #fff;
    border: 1px solid #e6e6e6;
}

.notification-panel .notification-body {
    height: auto;
    max-height: 350px;
    position: relative;
    overflow: hidden;
}

.notification-panel .notification-body .notification-item {
    position: relative;
    margin-left: 25px;
    background-color: #fff;
    padding-right: 26px;
}

.notification-panel .notification-body .notification-item.unread .heading {
    opacity: 1;
}

.notification-panel .notification-body .notification-item.unread .option {
    background-color: #daeffd;
}

.notification-panel .notification-body .notification-item.unread .option .mark {
    color: #6dc0f9;
}

.notification-panel .notification-body .notification-item .heading {
    line-height: 43px;
    margin-right: 5px;
    background: #fff;
    border-bottom: 1px solid #e6e6e6;
    position: relative;
    float: left;
    width: 100%;
    font-size: 14px;
    opacity: 0.7;
}

.notification-panel .notification-body .notification-item .heading:after {
    content: '';
    position: absolute;
    width: 5px;
    height: 100%;
    background-color: #fff;
    right: 0;
    top: 1px;
}

.notification-panel .notification-body .notification-item .heading .thumbnail-wrapper {
    cursor: pointer;
}

.notification-panel .notification-body .notification-item .heading .thumbnail-wrapper i {
    -webkit-transition: all 0.12s linear;
    transition: all 0.12s linear;
}

.notification-panel .notification-body .notification-item .heading .time {
    font-size: 11px;
    margin-right: 8px;
}

.notification-panel .notification-body .notification-item .heading.open {
    display: block;
}

.notification-panel .notification-body .notification-item .heading.open .more-details {
    display: block;
}

.notification-panel .notification-body .notification-item .heading.open .thumbnail-wrapper i {
    -webkit-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    transform: rotate(-90deg);
}

.notification-panel .notification-body .notification-item .heading .thumbnail-wrapper.d24 {
    line-height: 20px;
}

.notification-panel .notification-body .notification-item .more-details {
    display: none;
    background-color: #fff;
    width: 100%;
    height: 100%;
    clear: both;
    position: relative;
}

.notification-panel .notification-body .notification-item .more-details .more-details-inner {
    margin-left: 10px;
    padding-left: 28px;
    padding-top: 15px;
    margin-bottom: 20px;
    position: relative;
    border-left: 1px solid rgba(230, 230, 230, 0.7);
    text-align: left;
}

.notification-panel .notification-body .notification-item .more-details .more-details-inner:after {
    width: 14px;
    height: 14px;
    position: absolute;
    content: '';
    background-color: #fff;
    left: -7px;
    top: 25px;
    border: 1px solid rgba(230, 230, 230, 0.9);
    border-radius: 99px;
    -webkit-border-radius: 99px;
    -moz-border-radius: 99px;
}

.notification-panel .notification-body .notification-item .more-details .more-details-inner:before {
    color: #c0c0c0;
    position: absolute;
    bottom: 0;
    left: -5px;
    content: ' \25CF';
    font-size: 13px;
    line-height: 5px;
    background-color: #fff;
    height: 9px;
}

.notification-panel .notification-body .notification-item .more-details .more-details-inner .hint-text {
    opacity: .44;
}

.notification-panel .notification-body .notification-item .option {
    font-size: 10px;
    position: absolute;
    height: 44px;
    width: 26px;
    right: 0;
    text-align: center;
    vertical-align: middle;
    line-height: 44px;
    background-color: #fafafa;
    height: 100%;
}

.notification-panel .notification-body .notification-item .option .mark {
    background-color: transparent;
    color: #c0c0c0;
}

.notification-panel .notification-body .notification-item .option .mark:before {
    content: ' \25CF';
    font-size: 12px;
}

.notification-panel .notification-body .notification-item:last-child .heading {
    border-bottom: 0px;
}

.notification-panel .notification-footer {
    padding: 10px;
    display: block;
    border-top: 1px solid #e6e6e6;
}

.notification-panel .notification-footer a {
    color: #626262;
    opacity: .54;
}

.notification-panel .notification-footer a:hover {
    opacity: .74;
}


/* Simple alerts
--------------------------------------------------
*/

.alerts-container {
    position: fixed;
    width: 350px;
    right: 20px;
    z-index: 999;
    top: 80px;
}

.alerts-container[data-placement$='-left'] {
    left: 100px;
    right: auto;
}

.alerts-container[data-placement$='-right'] {
    right: 20px;
    left: auto;
}

.alerts-container[data-placement^='top-'] {
    top: 80px;
    bottom: auto;
}

.alerts-container[data-placement^='bottom-'] {
    top: auto;
    bottom: 20px;
}

.alerts-container[data-placement='bottom-right'] .alert:last-child, .alerts-container[data-placement='bottom-left'] .alert:last-child {
    margin-bottom: 0;
}

.alerts-container .alert {
    position: relative;
}

.alerts-container .alert .close {
    position: absolute;
    right: 9px;
    top: 15px;
}


/* Pages Notifications plugin
--------------------------------------------------
*/

body.menu-pin>.pgn-wrapper[data-position$='-left'], body.menu-pin>.pgn-wrapper[data-position="top"], body.menu-pin>.pgn-wrapper[data-position="bottom"] {
    left: 250px;
}

.pgn-wrapper {
    position: fixed;
    z-index: 1000;
}

.pgn-wrapper[data-position$='-left'] {
    left: 30px;
}

.pgn-wrapper[data-position$='-right'] {
    right: 20px;
}

.pgn-wrapper[data-position^='top-'] {
    top: 20px;
}

.pgn-wrapper[data-position^='bottom-'] {
    bottom: 20px;
}

.pgn-wrapper[data-position='top'] {
    top: 0;
    left: 0;
    right: 0;
}

.pgn-wrapper[data-position='bottom'] {
    bottom: 0;
    left: 0;
    right: 0;
}

.pgn {
    position: relative;
    margin: 10px;
}

.pgn .alert {
    margin: 0;
}


/* Simple 
------------------------------------
*/

.pgn-simple .alert {
    padding-top: 13px;
    padding-bottom: 13px;
    max-width: 500px;
    animation: fadeIn 0.3s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    -webkit-animation: fadeIn 0.3s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    max-height: 250px;
    overflow: hidden;
}


/* Bar 
------------------------------------
*/

.pgn-bar {
    overflow: hidden;
    margin: 0;
}

.pgn-bar .alert {
    border-radius: 0;
    padding-top: 13px;
    padding-bottom: 13px;
    max-height: 91px;
}

.pgn-wrapper[data-position='top'] .pgn-bar .alert {
    animation: slideInFromTop 0.5s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    -webkit-animation: slideInFromTop 0.5s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    transform-origin: top left;
    -webkit-transform-origin: top left;
}

.pgn-wrapper[data-position='bottom'] .pgn-bar .alert {
    animation: slideInFromBottom 0.5s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    -webkit-animation: slideInFromBottom 0.5s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    transform-origin: bottom left;
    -webkit-transform-origin: bottom left;
}

.pgn-bar .alert span {
    opacity: 0;
    animation: fadeIn 0.3s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
    -webkit-animation: fadeIn 0.3s cubic-bezier(0.05, 0.74, 0.27, 0.99) forwards;
}

@keyframes slideInFromTop {
    0% {
        transform: translateY(-100%);
    }
    100% {
        transform: translateY(0);
    }
}

@-webkit-keyframes slideInFromTop {
    0% {
        -webkit-transform: translateY(-100%);
    }
    100% {
        -webkit-transform: translateY(0);
    }
}

@keyframes slideInFromBottom {
    0% {
        transform: translateY(100%);
    }
    100% {
        transform: translateY(0);
    }
}

@-webkit-keyframes slideInFromBottom {
    0% {
        -webkit-transform: translateY(100%);
    }
    100% {
        -webkit-transform: translateY(0);
    }
}


/* Circle 
------------------------------------
*/

.pgn-circle .alert {
    border-radius: 300px;
    animation: fadeInCircle 0.3s ease forwards, resizeCircle 0.3s 0.4s cubic-bezier(0.25, 0.25, 0.4, 1.6) forwards;
    -webkit-animation: fadeInCircle 0.3s ease forwards, resizeCircle 0.3s 0.4s cubic-bezier(0.25, 0.25, 0.4, 1.6) forwards;
    height: 60px;
    overflow: hidden;
    padding: 6px 55px 6px 6px;
    -webkit-transform: translateZ(0);
    position: relative;
}

.pgn-wrapper[data-position$='-right'] .pgn-circle .alert {
    float: right;
}

.pgn-wrapper[data-position$='-left'] .pgn-circle .alert {
    float: left;
}

.pgn-circle .alert>div>div.pgn-thumbnail>div {
    border-radius: 50%;
    overflow: hidden;
    width: 48px;
    height: 48px;
}

.pgn-circle .alert>div>div.pgn-thumbnail>div>img {
    width: 100%;
    height: 100%;
}

.pgn-circle .alert>div>div.pgn-message>div {
    opacity: 0;
    height: 47px;
    padding-left: 9px;
    animation: fadeIn .3s .5s ease forwards;
    -webkit-animation: fadeIn .3s .5s ease forwards;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    word-break: break-all;
    word-wrap: break-word;
}

.pgn-circle .alert>div>div.pgn-message>div p:only-child {
    padding: 12px 0;
}

.pgn-circle .alert .close {
    margin-top: -12px;
    position: absolute;
    right: 18px;
    top: 50%;
    opacity: 0;
    animation: fadeIn .3s .5s ease forwards;
    -webkit-animation: fadeIn .3s .5s ease forwards;
}

.pgn-circle .alert p {
    margin-bottom: 0;
}

.pgn-circle .alert>div {
    display: table;
    height: 100%;
}

.pgn-circle .alert>div>div {
    display: table-cell;
    vertical-align: middle;
}

@keyframes fadeInCircle {
    0% {
        opacity: 0;
        width: 60px;
    }
    100% {
        opacity: 1;
        width: 60px;
    }
}

@-webkit-keyframes fadeInCircle {
    0% {
        opacity: 0;
        width: 60px;
    }
    100% {
        opacity: 1;
        width: 60px;
    }
}

@keyframes resizeCircle {
    0% {
        width: 60px;
    }
    100% {
        width: 300px;
    }
}

@-webkit-keyframes resizeCircle {
    0% {
        width: 60px;
    }
    100% {
        width: 300px;
    }
}


/* Flip 
------------------------------------
*/

.pgn-wrapper[data-position^='top-'] .pgn-flip {
    top: -30px;
}

.pgn-wrapper[data-position^='bottom-'] .pgn-flip {
    bottom: -30px;
}

.pgn-wrapper[data-position^='bottom-'] .pgn-flip .alert {
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 100%;
}

.pgn-flip .alert {
    -webkit-transform-origin: 50% 0%;
    transform-origin: 50% 0%;
    box-shadow: 0 6px 4px -3px rgba(0, 0, 0, 0.2);
    -webkit-animation-name: flipInX;
    animation-name: flipInX;
    -webkit-animation-duration: 0.8s;
    animation-duration: 0.8s;
    border-radius: 0;
    padding: 25px 35px;
    max-width: 500px;
    max-height: 250px;
    overflow: hidden;
}

@-webkit-keyframes flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -90deg);
        -webkit-transition-timing-function: ease-in;
    }
    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 20deg);
        -webkit-transition-timing-function: ease-out;
    }
    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -10deg);
        -webkit-transition-timing-function: ease-in;
        opacity: 1;
    }
    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 5deg);
        -webkit-transition-timing-function: ease-out;
    }
    100% {
        -webkit-transform: perspective(400px);
    }
}

@keyframes flipInX {
    0% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -90deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -90deg);
        -webkit-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
    }
    40% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 20deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 20deg);
        -webkit-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
    }
    60% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, -10deg);
        transform: perspective(400px) rotate3d(1, 0, 0, -10deg);
        -webkit-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
        opacity: 1;
    }
    80% {
        -webkit-transform: perspective(400px) rotate3d(1, 0, 0, 5deg);
        transform: perspective(400px) rotate3d(1, 0, 0, 5deg);
        -webkit-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
    }
    100% {
        -webkit-transform: perspective(400px);
        transform: perspective(400px);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@-webkit-keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}


/* Pages Notification customizations */

body>.pgn-wrapper[data-position="top"] {
    top: 60px;
    left: 70px;
}

body>.pgn-wrapper[data-position="bottom"] {
    left: 70px;
}

body>.pgn-wrapper[data-position$='-left'] {
    left: 90px;
    right: auto;
}

body>.pgn-wrapper[data-position^='top-'] {
    top: 80px;
    bottom: auto;
}

.pgn-circle .alert .close {
    margin-top: -4px;
}

body>.pgn-wrapper {
    z-index: 900;
}

@media (max-width: 979px) {
    body>.pgn-wrapper[data-position="top"] {
        left: 0;
    }
    body>.pgn-wrapper[data-position="bottom"] {
        left: 0;
    }
}

@media (max-width: 767px) {
    body>.pgn-wrapper[data-position$='-left'], body>.pgn-wrapper[data-position$='-right'] {
        left: 10px !important;
        right: 10px !important;
    }
    body>.pgn-wrapper[data-position$='-right'] .alert, body>.pgn-wrapper[data-position$='-left'] .alert {
        max-width: 100%;
        width: 100%;
    }
}


/* Notifications demo
--------------------------------------------------
*/

.notification-positions {
    border-radius: 4px;
    border: 3px dashed #e6e6e6;
    height: 370px;
    position: relative;
}

.notification-positions>div>.position:not(:only-child) {
    max-width: 50%;
}

.notification-positions .position {
    padding: 15px;
}

.notification-positions .position img {
    border: 3px solid transparent;
}

.notification-positions .position:hover {
    cursor: pointer;
}

.notification-positions .position.active img {
    border-color: #0090d9;
}

.notification-positions .position.pull-top, .notification-positions .position.pull-bottom {
    left: 0;
    right: 0;
}

.notification-positions .position img {
    width: 100%;
}


/*------------------------------------------------------------------
[9. Progress Indicators]
*/

.progress {
    height: 4px;
    background-color: rgba(98, 98, 98, 0.2);
    background-image: none;
    box-shadow: none;
    border-radius: 0;
}

.progress.transparent {
    background-color: rgba(0, 0, 0, 0.28);
}

.progress.progress-small {
    height: 3px;
}


/* Circular Progress : indeterminate color
------------------------------------
*/

.progress-bar-indeterminate {
    background: url('../img/progress/progress-bar-master.svg') no-repeat top left;
    width: 100%;
    height: 100%;
    background-size: cover;
}

.progress-bar-indeterminate.progress-bar-primary {
    background-image: url('../img/progress/progress-bar-primary.svg');
    background-color: transparent;
}

.progress-bar-indeterminate.progress-bar-complete {
    background-image: url('../img/progress/progress-bar-complete.svg');
    background-color: transparent;
}

.progress-bar-indeterminate.progress-bar-success {
    background-image: url('../img/progress/progress-bar-success.svg');
    background-color: transparent;
}

.progress-bar-indeterminate.progress-bar-info {
    background-image: url('../img/progress/progress-bar-info.svg');
    background-color: transparent;
}

.progress-bar-indeterminate.progress-bar-warning {
    background-image: url('../img/progress/progress-bar-warning.svg');
    background-color: transparent;
}

.progress-bar-indeterminate.progress-bar-danger {
    background-image: url('../img/progress/progress-bar-danger.svg');
    background-color: transparent;
}

.progress-bar-indeterminate.progress-bar-master {
    background-image: url('../img/progress/progress-bar-master.svg');
    background-color: transparent;
}


/* Progress Bar
------------------------------------
*/

.progress-bar {
    box-shadow: none;
    border-radius: 0;
    background-color: #626262;
    background-image: none;
    -webkit-transition: all 1000ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
    transition: all 1000ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
    -webkit-transition-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
    -moz-transition-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
    -ms-transition-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
    -o-transition-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
    transition-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
}


/* Progress Bar : Color Options
------------------------------------
*/

.progress-bar-primary {
    background-color: #6d5cae;
    background-image: none;
}

.progress-bar-complete {
    background-color: #48b0f7;
    background-image: none;
}

.progress-bar-success {
    background-color: #10cfbd;
    background-image: none;
}

.progress-bar-info {
    background-color: #3b4752;
    background-image: none;
}

.progress-bar-warning {
    background-color: #f8d053;
    background-image: none;
}

.progress-bar-danger {
    background-color: #f55753;
    background-image: none;
}

.progress-bar-white {
    background-color: #ffffff;
    background-image: none;
}

.progress-bar-black {
    background-color: #000000;
    background-image: none;
}

.progress-info .bar, .progress .bar-info {
    background-color: #232b31;
    background-image: none;
}

.progress-warning .bar, .progress .bar-warning {
    background-color: #957d32;
    background-image: none;
}

.progress-danger .bar, .progress .bar-danger {
    background-color: #933432;
    background-image: none;
}

.progress-white .bar, .progress .bar-white {
    background-color: #ffffff;
    background-image: none;
}

.progress-success.progress-striped .bar, .progress-striped .bar-success {
    background-color: #10cfbd;
}

.progress-info.progress-striped .bar, .progress-striped .bar-info {
    background-color: #3b4752;
}


/* Circular Progress : indeterminate 
------------------------------------
*/

.progress-circle-indeterminate {
    background: url('../img/progress/progress-circle-master.svg') no-repeat top left;
    width: 50px;
    height: 50px;
    background-size: 100% auto;
    margin: 0 auto;
}

.progress-circle-indeterminate.progress-circle-warning {
    background-image: url('../img/progress/progress-circle-warning.svg');
}

.progress-circle-indeterminate.progress-circle-danger {
    background-image: url('../img/progress/progress-circle-danger.svg');
}

.progress-circle-indeterminate.progress-circle-info {
    background-image: url('../img/progress/progress-circle-info.svg');
}

.progress-circle-indeterminate.progress-circle-primary {
    background-image: url('../img/progress/progress-circle-primary.svg');
}

.progress-circle-indeterminate.progress-circle-success {
    background-image: url('../img/progress/progress-circle-success.svg');
}

.progress-circle-indeterminate.progress-circle-complete {
    background-image: url('../img/progress/progress-circle-complete.svg');
}


/* Circular Progress 
------------------------------------
*/

.progress-circle {
    display: block;
    height: 45px;
    margin: 0 auto;
    position: relative;
    width: 45px;
    -webkit-backface-visibility: hidden;
}

.progress-circle.progress-circle-warning .pie .half-circle {
    border-color: #f8d053;
}

.progress-circle.progress-circle-danger .pie .half-circle {
    border-color: #f55753;
}

.progress-circle.progress-circle-info .pie .half-circle {
    border-color: #3b4752;
}

.progress-circle.progress-circle-primary .pie .half-circle {
    border-color: #6d5cae;
}

.progress-circle.progress-circle-success .pie .half-circle {
    border-color: #10cfbd;
}

.progress-circle.progress-circle-complete .pie .half-circle {
    border-color: #48b0f7;
}

.progress-circle.progress-circle-thick .pie .half-circle, .progress-circle.progress-circle-thick .shadow {
    border-width: 5px;
}

.progress-circle .pie {
    clip: rect(0, 45px, 45px, 22.5px);
    height: 45px;
    position: absolute;
    width: 45px;
}

.progress-circle .pie .half-circle {
    border: 3px solid #626262;
    border-radius: 50%;
    clip: rect(0, 22.5px, 45px, 0);
    height: 45px;
    position: absolute;
    width: 45px;
}

.progress-circle .shadow {
    border: 3px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    height: 100%;
    width: 100%;
}


/*------------------------------------------------------------------
[10. Modals]
*/

.modal .close:focus {
    outline: 0;
}

.modal .modal-dialog {
    transition: all .2s !important;
}

.modal .modal-content {
    border: 1px solid #f2f6f7;
    border-radius: 3px;
    box-shadow: none;
}

.modal .modal-header {
    text-align: center;
    border-bottom: 0;
    padding: 25px 25px 0 25px;
}

.modal .modal-header p {
    color: #8b91a0;
}

.modal .modal-body {
    box-shadow: none;
    padding: 25px;
    padding-top: 0;
    white-space: normal;
}

.modal .modal-footer {
    border-top: none;
    box-shadow: none;
    margin-top: 0;
    padding: 25px;
    padding-top: 0;
}

.modal .drop-shadow {
    box-shadow: 0 0 9px rgba(191, 191, 191, 0.36) !important;
}

.modal.fade {
    opacity: 1 !important;
}

.modal.fade.stick-up .modal-dialog {
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
    -ms-transform: translate(0, -100%);
    margin-top: -5px;
}

.modal.fade.stick-up.in .modal-dialog {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    -ms-transform: translate(0, 0);
}

.modal.fade.slide-up {
    height: 100%;
    top: auto;
}

.modal.fade.slide-up.in .modal-dialog {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    -ms-transform: translate(0, 0);
}

.modal.fade.slide-up.disable-scroll {
    overflow: hidden;
}

.modal.fade.slide-up .modal-dialog {
    display: table;
    height: 100%;
    -webkit-transform: translate3d(0, 75%, 0);
    transform: translate3d(0, 75%, 0);
    -ms-transform: translate(0, 75%);
}

.modal.fade.slide-up .modal-content-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal.fade.center-scale .modal-dialog {
    display: table;
    height: 100%;
}

.modal.fade.center-scale .modal-content {
    display: table-cell;
    vertical-align: middle;
    border: 0;
    background: transparent;
}

.modal.fade.center-scale .modal-content .modal-header {
    border-bottom: 0px;
}

.modal.fade.center-scale.in .modal-dialog {
    opacity: 1;
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}

.modal.fade.center-scale .modal-dialog {
    opacity: 0;
    -webkit-transform: scale(0.6);
    -ms-transform: scale(0.6);
    transform: scale(0.6);
}

.modal.fade.fill-in {
    background-color: rgba(255, 255, 255, 0);
    -webkit-transition: background-color 0.3s;
    transition: background-color 0.3s;
}

.modal.fade.fill-in>.close {
    margin-top: 20px;
    margin-right: 20px;
    opacity: 0.6;
}

.modal.fade.fill-in>.close>i {
    font-size: 16px;
}

.modal.fade.fill-in .modal-dialog {
    display: table;
    height: 100%;
}

.modal.fade.fill-in .modal-content {
    display: table-cell;
    vertical-align: middle;
    border: 0;
    background: transparent;
}

.modal.fade.fill-in .modal-content .modal-header {
    border-bottom: 0px;
}

.modal.fade.fill-in.in {
    background-color: rgba(255, 255, 255, 0.85);
}

.modal.fade.fill-in.in .modal-dialog {
    opacity: 1;
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}

.modal.fade.fill-in .modal-dialog {
    opacity: 0;
    -webkit-transform: scale(0.6);
    -ms-transform: scale(0.6);
    transform: scale(0.6);
}

.modal.fade.slide-right .close {
    position: absolute;
    top: 0;
    right: 0;
    margin-right: 10px;
    z-index: 10;
}

.modal.fade.slide-right.in .modal-dialog {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    -ms-transform: translate(0, 0);
}

.modal.fade.slide-right .modal-dialog {
    position: absolute;
    right: 0;
    margin: 0;
    height: 100%;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
    -ms-transform: translate(100%, 0);
}

.modal.fade.slide-right .modal-dialog .modal-content-wrapper {
    height: 100%;
}

.modal.fade.slide-right .modal-dialog .modal-content {
    height: 100%;
}

.modal.fade.slide-right .modal-dialog .modal-body {
    background-color: #fff;
}

.modal.fade.slide-right .modal-content {
    border-radius: 0px;
}

.fill-in-modal .modal-backdrop {
    background-color: transparent;
}

.modal-backdrop {
    opacity: 0;
    -webkit-transition: opacity 0.2s linear;
    transition: opacity 0.2s linear;
}

.modal-backdrop.in {
    opacity: 0.30;
}


/* Responsive Handlers: Modals
------------------------------------
*/

@media (max-width: 768px) {
    .modal.fill-in .modal-dialog {
        width: calc(100% - 20px);
    }
    .modal.slide-up .modal-dialog {
        width: calc(100% - 20px);
    }
}

@media (min-width: 768px) {
    .modal.stick-up .modal-dialog {
        margin: -5px auto;
    }
    .modal.slide-up .modal-dialog {
        margin: 0 auto;
    }
    .modal.fill-in .modal-dialog {
        margin: 0 auto;
    }
    .modal .modal-content {
        box-shadow: none;
    }
}


/*------------------------------------------------------------------
[11. Tabs & Accordians]
*/


/* Tabs
------------------------------------
*/

.nav-tabs>li {
    padding-left: 0;
    padding-right: 0;
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    border-color: #e6e6e6;
    color: #626262;
    background-color: #e6e6e6;
}

.nav-tabs>li>a {
    border-radius: 0;
    padding: 15px 20px;
    margin-right: 0;
    font-family: 'Montserrat';
    font-weight: 400;
    color: rgba(98, 98, 98, 0.7);
    font-size: 12px;
    min-width: 70px;
    text-transform: uppercase;
    border-color: transparent;
}

.nav-tabs>li>a:hover, .nav-tabs>li>a:focus {
    background: transparent;
    border-color: transparent;
    color: #626262;
}

.nav-tabs>li>a .tab-icon {
    margin-right: 6px;
}

.nav-tabs~.tab-content {
    overflow: hidden;
    padding: 15px;
}

.nav-tabs~.tab-content>.tab-pane.slide-left, .nav-tabs~.tab-content>.tab-pane.slide-right {
    -webkit-transition: all 0.3s ease !important;
    transition: all 0.3s ease !important;
}

.nav-tabs~.tab-content>.tab-pane.slide-left.sliding, .nav-tabs~.tab-content>.tab-pane.slide-right.sliding {
    opacity: 0 !important;
}

.nav-tabs~.tab-content>.tab-pane.slide-left.active, .nav-tabs~.tab-content>.tab-pane.slide-right.active {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    -ms-transform: translate(0, 0);
    opacity: 1;
}

.nav-tabs~.tab-content>.tab-pane.slide-left.sliding {
    -webkit-transform: translate3d(10%, 0, 0) !important;
    transform: translate3d(10%, 0, 0) !important;
    -ms-transform: translate(10%, 0) !important;
}

.nav-tabs~.tab-content>.tab-pane.slide-right.sliding {
    -webkit-transform: translate3d(-10%, 0, 0) !important;
    transform: translate3d(-10%, 0, 0) !important;
    -ms-transform: translate(-10%, 0) !important;
}

.nav-tabs.nav-tabs-left:after, .nav-tabs.nav-tabs-right:after {
    border-bottom: 0px;
}

.nav-tabs.nav-tabs-left>li, .nav-tabs.nav-tabs-right>li {
    float: none;
}

.nav-tabs.nav-tabs-left {
    float: left;
    padding-right: 0;
}

.nav-tabs.nav-tabs-left~.tab-content {
    border-left: 1px solid rgba(0, 0, 0, 0.1);
}

.nav-tabs.nav-tabs-right {
    float: right;
    padding-right: 0;
}

.nav-tabs.nav-tabs-right~.tab-content {
    border-right: 1px solid rgba(0, 0, 0, 0.1);
}


/* Tabs : Simple 
------------------------------------
*/

.nav-tabs-simple {
    border-bottom: 0px;
}

.nav-tabs-simple:after {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
    position: relative;
    bottom: 3px;
    z-index: 120;
}

.nav-tabs-simple>li {
    margin-bottom: 0;
}

.nav-tabs-simple>li:after {
    -webkit-transition: all 0.1s linear 0s;
    transition: all 0.1s linear 0s;
    -webkit-backface-visibility: hidden;
    width: 100%;
    display: block;
    background-color: #f55753;
    height: 0px;
    content: '';
    z-index: 125;
}

.nav-tabs-primary.nav-tabs-simple>li:after {
    background-color: #6d5cae;
}

.nav-tabs-success.nav-tabs-simple>li:after {
    background-color: #10cfbd;
}

.nav-tabs-complete.nav-tabs-simple>li:after {
    background-color: #48b0f7;
}

.nav-tabs-danger.nav-tabs-simple>li:after {
    background-color: #f55753;
}

.nav-tabs-warning.nav-tabs-simple>li:after {
    background-color: #f8d053;
}

.nav-tabs-info.nav-tabs-simple>li:after {
    background-color: #3b4752;
}

.nav-tabs-simple>li.active a, .nav-tabs-simple>li.active a:hover, .nav-tabs-simple>li.active a:focus {
    background-color: transparent;
    border-color: transparent;
}

.nav-tabs-simple>li.active:after, .nav-tabs-simple>li:hover:after {
    height: 3px;
}

.nav-tabs-simple.nav-tabs-left:after, .nav-tabs-simple.nav-tabs-right:after {
    border-bottom: 0px;
}

.nav-tabs-simple.nav-tabs-left>li:after, .nav-tabs-simple.nav-tabs-right>li:after {
    width: 0px;
    height: 100%;
    top: 0;
    bottom: 0;
    position: absolute;
}

.nav-tabs-simple.nav-tabs-left>li.active:after, .nav-tabs-simple.nav-tabs-right>li.active:after, .nav-tabs-simple.nav-tabs-left>li:hover:after, .nav-tabs-simple.nav-tabs-right>li:hover:after {
    width: 3px;
}

.nav-tabs-simple.nav-tabs-left>li:after {
    right: 0;
}

.nav-tabs-simple.nav-tabs-right>li:after {
    left: 0;
}


/* Tabs : Line Triangles
------------------------------------
*/

.nav-tabs-linetriangle {
    border-bottom: 0;
}

.nav-tabs-linetriangle:after {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
    position: relative;
    bottom: 0;
}

.nav-tabs-linetriangle>li.active>a {
    background: transparent;
    box-shadow: none;
    border-color: transparent;
}

.nav-tabs-linetriangle>li.active>a:hover, .nav-tabs-linetriangle>li.active>a:focus, .nav-tabs-linetriangle>li.active>a:active {
    border-color: transparent;
    background-color: transparent;
}

.nav-tabs-linetriangle>li.active>a:after, .nav-tabs-linetriangle>li.active>a:before {
    border: medium solid transparent;
    content: "";
    height: 0;
    left: 50%;
    pointer-events: none;
    position: absolute;
    width: 0;
    z-index: 1;
    top: 100%;
}

.nav-tabs-linetriangle>li.active>a:after {
    border-top-color: #fafafa;
    border-width: 10px;
    margin-left: -10px;
}

.nav-tabs-linetriangle>li.active>a:before {
    border-top-color: rgba(0, 0, 0, 0.2);
    border-width: 11px;
    margin-left: -11px;
}

.nav-tabs-linetriangle>li>a span {
    font-size: 1em;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.nav-tabs-linetriangle>li>a, .nav-tabs-linetriangle>li>a:hover, .nav-tabs-linetriangle>li>a:focus {
    overflow: visible;
    -webkit-transition: color 0.2s ease 0s;
    transition: color 0.2s ease 0s;
}

.nav-tabs-linetriangle~.tab-content {
    background: #fff;
}

.nav-tabs-linetriangle.nav-tabs-left.nav-tabs:after {
    border-bottom: none;
}

.nav-tabs-linetriangle.nav-tabs-left.nav-tabs>li.active>a:before {
    border-top: 11px solid transparent;
    border-bottom: 11px solid transparent;
    border-left: 11px solid rgba(0, 0, 0, 0.2);
}

.nav-tabs-linetriangle.nav-tabs-left.nav-tabs>li.active>a:after {
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 10px solid #fafafa;
    margin-top: 1px;
    margin-right: 2px;
}

.nav-tabs-linetriangle.nav-tabs-left.nav-tabs>li.active>a:after, .nav-tabs-linetriangle.nav-tabs-left.nav-tabs>li.active>a:before {
    top: auto;
    right: -23px;
    left: auto;
}

.nav-tabs-linetriangle.nav-tabs-right.nav-tabs:after {
    border-bottom: none;
}

.nav-tabs-linetriangle.nav-tabs-right.nav-tabs>li.active>a:before {
    border-top: 11px solid transparent;
    border-bottom: 11px solid transparent;
    border-right: 11px solid rgba(0, 0, 0, 0.2);
}

.nav-tabs-linetriangle.nav-tabs-right.nav-tabs>li.active>a:after {
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 10px solid #fafafa;
    margin-top: 1px;
    margin-left: -9px;
}

.nav-tabs-linetriangle.nav-tabs-right.nav-tabs>li.active>a:after, .nav-tabs-linetriangle.nav-tabs-right.nav-tabs>li.active>a:before {
    top: auto;
    left: -12px;
    right: auto;
}

@media screen and (max-width: 58em) {
    .nav-tabs-linetriangle {
        font-size: 0.6em;
    }
}


/* Tabs : Fill-up 
------------------------------------
*/

.nav-tabs-fillup {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-perspective: 1000;
    -moz-perspective: 1000;
    perspective: 1000;
}

.nav-tabs-fillup>li {
    overflow: hidden;
}

.nav-tabs-fillup>li>a {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: color 0.3s ease 0s;
    transition: color 0.3s ease 0s;
    background: transparent;
}

.nav-tabs-fillup>li>a:after {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    background: none repeat scroll 0 0 #10cfbd;
    border: 1px solid #10cfbd;
    content: "";
    height: calc(100% + 1px);
    left: 0;
    position: absolute;
    top: 0;
    -webkit-transform: translate3d(0, 100%, 0px);
    transform: translate3d(0, 100%, 0px);
    -webkit-transition: -webkit-transform 0.3s ease 0s;
    transition: transform 0.3s ease 0s;
    width: 100%;
    z-index: -1;
}

.nav-tabs-primary.nav-tabs-fillup>li>a:after {
    background: none repeat scroll 0 0 #6d5cae;
    border: 1px solid #6d5cae;
}

.nav-tabs-success.nav-tabs-fillup>li>a:after {
    background: none repeat scroll 0 0 #10cfbd;
    border: 1px solid #10cfbd;
}

.nav-tabs-complete.nav-tabs-fillup>li>a:after {
    background: none repeat scroll 0 0 #48b0f7;
    border: 1px solid #48b0f7;
}

.nav-tabs-warning.nav-tabs-fillup>li>a:after {
    background: none repeat scroll 0 0 #f8d053;
    border: 1px solid #f8d053;
}

.nav-tabs-danger.nav-tabs-fillup>li>a:after {
    background: none repeat scroll 0 0 #f55753;
    border: 1px solid #f55753;
}

.nav-tabs-info.nav-tabs-fillup>li>a:after {
    background: none repeat scroll 0 0 #3b4752;
    border: 1px solid #3b4752;
}

.nav-tabs-fillup>li>a span {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transform: translate3d(0px, 5px, 0px);
    transform: translate3d(0px, 5px, 0px);
    -webkit-transition: -webkit-transform 0.5s ease 0s;
    transition: transform 0.5s ease 0s;
    display: block;
    font-weight: 700;
    line-height: 1.5;
}

.nav-tabs-fillup>li.active {
    z-index: 100;
}

.nav-tabs-fillup>li.active>a, .nav-tabs-fillup>li.active>a:hover, .nav-tabs-fillup>li.active>a:focus {
    border-color: transparent;
    background: transparent;
    color: #fff;
}

.nav-tabs-fillup>li.active>a:after {
    -webkit-transform: translate3d(0px, 0px, 0px);
    transform: translate3d(0px, 0px, 0px);
    -ms-transform: translate(0px, 0px);
}

.nav-tabs-fillup>li.active>a span {
    -webkit-transform: translate3d(0px, -5px, 0px);
    transform: translate3d(0px, -5px, 0px);
    -ms-transform: translate(0px, -5px);
}

.nav-tabs-fillup>li.active .icon:before {
    -webkit-transform: translate3d(0px, -5px, 0px);
    transform: translate3d(0px, -5px, 0px);
    -ms-transform: translate(0px, -5px);
}

.nav-tabs-fillup .icon:before {
    -webkit-transform: translate3d(0px, 5px, 0px);
    transform: translate3d(0px, 5px, 0px);
    -ms-transform: translate(0px, 5px);
    -webkit-transition: transform 0.5s ease 0s;
    transition: transform 0.5s ease 0s;
    display: block;
    margin: 0;
}

.nav-tabs-fillup~.tab-content {
    background: #fff;
}

.nav-tabs-fillup.nav-tabs-left, .nav-tabs-fillup.nav-tabs-right {
    border-bottom: none;
}

.nav-tabs-fillup.nav-tabs-left:after, .nav-tabs-fillup.nav-tabs-right:after {
    border-bottom: none;
}

.nav-tabs-fillup.nav-tabs-left>li>a:after, .nav-tabs-fillup.nav-tabs-right>li>a:after {
    width: calc(100% + 1px);
    height: 100%;
}

.nav-tabs-fillup.nav-tabs-left>li.active a:after, .nav-tabs-fillup.nav-tabs-right>li.active a:after {
    -webkit-transform: translate3d(0px, 0px, 0px);
    transform: translate3d(0px, 0px, 0px);
    -ms-transform: translate(0px, 0px);
}

.nav-tabs-fillup.nav-tabs-left>li>a:after {
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0);
    -ms-transform: translate(100%, 0);
}

.nav-tabs-fillup.nav-tabs-left>li>a span {
    -webkit-transform: translate3d(5px, 0, 0px);
    transform: translate3d(5px, 0, 0px);
    -ms-transform: translate(5px, 0);
}

.nav-tabs-fillup.nav-tabs-left>li.active a span {
    -webkit-transform: translate3d(-5px, 0, 0px);
    transform: translate3d(-5px, 0, 0px);
    -ms-transform: translate(-5px, 0);
}

.nav-tabs-fillup.nav-tabs-left>li.active .icon:before {
    -webkit-transform: translate3d(-5px, 0, 0px);
    transform: translate3d(-5px, 0, 0px);
    -ms-transform: translate(-5px, 0);
}

.nav-tabs-fillup.nav-tabs-right>li>a:after {
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
    -ms-transform: translate(-100%, 0);
    left: -1px;
}

.nav-tabs-fillup.nav-tabs-right>li>a span {
    -webkit-transform: translate3d(-5px, 0, 0px);
    transform: translate3d(-5px, 0, 0px);
    -ms-transform: translate(-5px, 0);
}

.nav-tabs-fillup.nav-tabs-right>li.active a span {
    -webkit-transform: translate3d(5px, 0, 0px);
    transform: translate3d(5px, 0, 0px);
    -ms-transform: translate(5px, 0);
}

.nav-tabs-fillup.nav-tabs-right>li.active .icon:before {
    -webkit-transform: translate3d(5px, 0, 0px);
    transform: translate3d(5px, 0, 0px);
    -ms-transform: translate(5px, 0);
}

.nav-tabs-header {
    overflow: scroll;
    width: 100%;
}

.nav-tabs-header .nav-tabs {
    width: auto;
    white-space: nowrap;
}

.nav-tabs-header .nav-tabs>li {
    display: inline-block;
    float: inherit;
}

.nav-tabs-header.nav-tabs-linetriangle {
    height: 61px;
    overflow-y: hidden;
}

.nav-tabs-header.nav-tabs-linetriangle:after {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    width: 100%;
    position: relative;
    bottom: 3px;
    z-index: 120;
    content: "";
    clear: both;
}

.nav-tabs-header.nav-tabs-linetriangle~.tab-content {
    position: relative;
    top: -12px;
}

.nav-tabs-header~.tab-content {
    overflow: hidden;
    padding: 15px;
}

.nav-tab-dropdown .cs-select {
    width: 100% !important;
    max-width: 100%;
}


/* Panel Groups
------------------------------------
*/

.panel-group {
    margin-bottom: 18px;
}

.panel-group .panel-heading {
    padding: 13px 18px 10px 22px;
}

.panel-group .panel-heading.collapsed {
    background-color: #fff;
}

.panel-group .panel-heading+.panel-collapse .panel-body {
    border: 0;
}

.panel-group .panel-heading .panel-title {
    width: 100%;
}

.panel-group .panel-heading .panel-title>a {
    color: #626262;
    font-size: 13px;
    font-weight: normal;
    display: block;
    opacity: 1;
}

.panel-group .panel-heading .panel-title>a:hover {
    color: #626262 !important;
}

.panel-group .panel-heading .panel-title>a:hover:after {
    color: #626262 !important;
}

.panel-group .panel-heading .panel-title>a:after {
    font-family: 'FontAwesome';
    content: "\f056";
    position: absolute;
    right: 13px;
    top: 36%;
    color: #626262;
}

.panel-group .panel-heading .panel-title>a.collapsed {
    color: rgba(98, 98, 98, 0.7);
    opacity: 1;
}

.panel-group .panel-heading .panel-title>a.collapsed:after {
    content: "\f055";
    color: rgba(98, 98, 98, 0.7);
}

.panel-group .panel+.panel {
    margin-top: 2px;
}

.panel-group .panel .panel-body {
    height: auto;
}

.nav-pills>li>a {
    border-radius: 0;
    color: #626262;
}

.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
    color: #626262;
    background-color: #e6e6e6;
}

@media (max-width: 767px) {
    .nav.nav-tabs.nav-stack-sm li {
        float: none;
    }
    .nav.nav-tabs.nav-stack-sm.nav-tabs-linetriangle>li.active>a:after, .nav.nav-tabs.nav-stack-sm.nav-tabs-linetriangle>li.active>a:before {
        display: none;
    }
}


/*------------------------------------------------------------------
[12. Sliders]
*/


/* Ion Range Slider
https://github.com/IonDen/ion.rangeSlider
--------------------------------------------------
*/

.irs-line-mid, .irs-line-left, .irs-line-right, .irs-bar, .irs-bar-edge, .irs-slider {
    background-image: none;
}

.irs-bar {
    background: #f55753;
}

.irs-wrapper .irs-line {
    background-color: #e6e6e6;
}

.irs-wrapper .irs-line-mid, .irs-wrapper .irs-line-left, .irs-wrapper .irs-line-right, .irs-wrapper .irs-diapason, .irs-wrapper .irs-slider {
    background: none;
}

.irs-wrapper .irs-diapason {
    background-color: #f55753;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.irs-wrapper .irs-from, .irs-wrapper .irs-to, .irs-wrapper .irs-single {
    background: #f55753;
}

.irs-wrapper .irs-slider.from:before {
    top: -2%;
    left: 37%;
    width: 16%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    background-color: #f55753;
}

.irs-wrapper .irs-slider.to:before {
    top: -2%;
    left: 37%;
    width: 16%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    background-color: #f55753;
}

.irs-wrapper .irs-slider.single:before {
    top: -2%;
    left: 37%;
    width: 16%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    background-color: #f55753;
}

.irs-wrapper .irs-from:after, .irs-wrapper .irs-to:after, .irs-wrapper .irs-single:after {
    border-top-color: #f55753;
}

.irs-wrapper.success .irs-diapason {
    background-color: #10cfbd;
}

.irs-wrapper.success .irs-from, .irs-wrapper.success .irs-to, .irs-wrapper.success .irs-single {
    background: #10cfbd;
}

.irs-wrapper.success .irs-slider.from:before {
    background-color: #10cfbd;
}

.irs-wrapper.success .irs-slider.to:before {
    background-color: #10cfbd;
}

.irs-wrapper.success .irs-slider.single:before {
    background-color: #10cfbd;
}

.irs-wrapper.success .irs-from:after, .irs-wrapper.success .irs-to:after, .irs-wrapper.success .irs-single:after {
    border-top-color: #10cfbd;
}

.irs-wrapper.success .irs-bar {
    background-color: #10cfbd;
}

.irs-wrapper.primary .irs-diapason {
    background-color: #6d5cae;
}

.irs-wrapper.primary .irs-from, .irs-wrapper.primary .irs-to, .irs-wrapper.primary .irs-single {
    background: #6d5cae;
}

.irs-wrapper.primary .irs-slider.from:before {
    background-color: #6d5cae;
}

.irs-wrapper.primary .irs-slider.to:before {
    background-color: #6d5cae;
}

.irs-wrapper.primary .irs-slider.single:before {
    background-color: #6d5cae;
}

.irs-wrapper.primary .irs-from:after, .irs-wrapper.primary .irs-to:after, .irs-wrapper.primary .irs-single:after {
    border-top-color: #6d5cae;
}

.irs-wrapper.primary .irs-bar {
    background-color: #6d5cae;
}

.irs-wrapper.warning .irs-diapason {
    background-color: #f8d053;
}

.irs-wrapper.warning .irs-from, .irs-wrapper.warning .irs-to, .irs-wrapper.warning .irs-single {
    background: #f8d053;
}

.irs-wrapper.warning .irs-slider.from:before {
    background-color: #f8d053;
}

.irs-wrapper.warning .irs-slider.to:before {
    background-color: #f8d053;
}

.irs-wrapper.warning .irs-slider.single:before {
    background-color: #f8d053;
}

.irs-wrapper.warning .irs-from:after, .irs-wrapper.warning .irs-to:after, .irs-wrapper.warning .irs-single:after {
    border-top-color: #f8d053;
}

.irs-wrapper.warning .irs-bar {
    background-color: #f8d053;
}

.irs-wrapper.complete .irs-diapason {
    background-color: #48b0f7;
}

.irs-wrapper.complete .irs-from, .irs-wrapper.complete .irs-to, .irs-wrapper.complete .irs-single {
    background: #48b0f7;
}

.irs-wrapper.complete .irs-slider.from:before {
    background-color: #48b0f7;
}

.irs-wrapper.complete .irs-slider.to:before {
    background-color: #48b0f7;
}

.irs-wrapper.complete .irs-slider.single:before {
    background-color: #48b0f7;
}

.irs-wrapper.complete .irs-from:after, .irs-wrapper.complete .irs-to:after, .irs-wrapper.complete .irs-single:after {
    border-top-color: #48b0f7;
}

.irs-wrapper.complete .irs-bar {
    background-color: #48b0f7;
}

.irs-wrapper.danger .irs-diapason {
    background-color: #f55753;
}

.irs-wrapper.danger .irs-from, .irs-wrapper.danger .irs-to, .irs-wrapper.danger .irs-single {
    background: #f55753;
}

.irs-wrapper.danger .irs-slider.from:before {
    background-color: #f55753;
}

.irs-wrapper.danger .irs-slider.to:before {
    background-color: #f55753;
}

.irs-wrapper.danger .irs-slider.single:before {
    background-color: #f55753;
}

.irs-wrapper.danger .irs-from:after, .irs-wrapper.danger .irs-to:after, .irs-wrapper.danger .irs-single:after {
    border-top-color: #f55753;
}

.irs-wrapper.danger .irs-bar {
    background-color: #f55753;
}


/* noUiSlider
http://refreshless.com/nouislider/
--------------------------------------------------
*/

.noUi-target {
    border-radius: 0px;
    border: 0;
    box-shadow: none;
    direction: ltr;
}

.noUi-target.bg-complete .noUi-connect {
    background-color: #48b0f7;
}

.noUi-target.bg-success .noUi-connect {
    background-color: #10cfbd;
}

.noUi-target.bg-warning .noUi-connect {
    background-color: #f8d053;
}

.noUi-target.bg-danger .noUi-connect {
    background-color: #f55753;
}

.noUi-target.bg-info .noUi-connect {
    background-color: #3b4752;
}

.noUi-target.bg-primary .noUi-connect {
    background-color: #6d5cae;
}

.noUi-target.noUi-connect {
    box-shadow: none;
}

.noUi-handle {
    border-radius: 999px;
    box-shadow: none;
}

.noUi-handle:before, .noUi-handle:after {
    display: none;
}

.noUi-horizontal {
    height: 4px;
}

.noUi-horizontal .noUi-handle {
    width: 18px;
    height: 18px;
    left: -15px;
    border: 1px solid #dbdbdb;
    top: -7px;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}

.noUi-horizontal .noUi-handle:hover {
    border: 1px solid #c0c0c0;
}

.noUi-horizontal .noUi-handle:active {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    border: 1px solid #dbdbdb;
}

.noUi-horizontal .noUi-handle:focus {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    border: 1px solid #dbdbdb;
}

.disable-hover-scale .noUi-handle:active {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}

.disable-hover-scale .noUi-handle:focus {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
}

.vertical-slider {
    height: 150px;
}

.noUi-vertical {
    width: 4px;
}

.noUi-vertical .noUi-handle {
    width: 18px;
    height: 18px;
    border: 1px solid #dbdbdb;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}

.noUi-vertical .noUi-handle:hover {
    border: 1px solid #c0c0c0;
}

.noUi-vertical .noUi-handle:active {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    border: 1px solid #dbdbdb;
}

.noUi-vertical .noUi-handle:focus {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    border: 1px solid #dbdbdb;
}

.noUi-base {
    padding: 5px 0;
}

.noUi-origin {
    border-radius: 0px;
    bottom: 5px;
}

.noUi-connect {
    box-shadow: none;
}

.noUi-background {
    background: #ececec;
    box-shadow: none;
}


/*------------------------------------------------------------------
[13. Treeview]
*/

span.dynatree-active a {
    color: #2c2c2c !important;
    background-color: transparent !important;
}

span.dynatree-selected a {
    color: #2c2c2c !important;
    font-style: normal;
}

ul.dynatree-container a:focus, span.dynatree-focused a:link {
    background-color: transparent;
}

ul.dynatree-container {
    background-color: transparent;
}

ul.dynatree-container a:hover {
    color: #626262;
    opacity: 0.7;
    background-color: transparent;
}

ul.dynatree-container a {
    color: #626262;
}

span.dynatree-empty, span.dynatree-vline, span.dynatree-connector, span.dynatree-expander, span.dynatree-icon, span.dynatree-checkbox, span.dynatree-radio, span.dynatree-drag-helper-img, #dynatree-drop-marker {
    height: 17px;
    position: relative;
    top: 3px;
}


/*------------------------------------------------------------------
[14. Nesstables]
*/

.dd-handle {
    border-color: rgba(230, 230, 230, 0.7);
    color: #626262;
}

.dd-handle:hover {
    background-color: #fafafa;
}

.dark .dd-handle {
    color: #626262;
    background: #f0f0f0;
}

.dark .dd-handle:hover {
    background-color: #fafafa;
}

.dark .dd-placeholder {
    background-color: #e6e6e6;
}

.dd3-content {
    background: #fff;
    border-color: rgba(230, 230, 230, 0.7);
    color: #626262;
}

.dd3-content:hover {
    background-color: #fafafa;
}

.dd3-handle {
    background: transparent;
    text-indent: 9999px;
}

.dd3-handle:before {
    font-family: 'pages-icon';
    color: #626262;
    content: "\e660";
    font-size: 11px;
    top: 5px;
}

.dd-placeholder {
    background: #f0f0f0;
    border-color: rgba(98, 98, 98, 0.35);
}

.dd-empty {
    background-image: none;
    background: #f0f0f0;
    border-color: rgba(98, 98, 98, 0.5);
}

.dd-item>button {
    font-size: 11px;
}

.dd-item>button:before {
    font-family: 'pages-icon';
    content: "\e63b";
}

.dd-item>button[data-action="collapse"]:before {
    font-family: 'pages-icon';
    content: "\e635";
}


/* Responsive Handlers : Nestables
------------------------------------
*/

@media only screen and (min-width: 700px) {
    .dd {
        width: 100%;
    }
}


/*------------------------------------------------------------------
[15. Form Elements]
*/

label, input, button, select, textarea {
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
}

textarea.no-resize {
    resize: none;
}

input[type="radio"], input[type="checkbox"] {
    margin-top: 1px 0 0;
    line-height: normal;
    cursor: pointer;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

select[multiple], select[size] {
    height: auto !important;
}

input:focus, select:focus, textarea:focus, input[type="file"]:focus, input[type="radio"]:focus, input[type="checkbox"]:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

form legend {
    margin: 15px 0px 10px 0px;
}

.form-control {
    background-color: #ffffff;
    background-image: none;
    border: 1px solid rgba(0, 0, 0, 0.28);
    font-family: Arial, sans-serif;
    -webkit-appearance: none;
    color: #2c2c2c;
    outline: 0;
    height: 35px;
    padding: 9px 12px;
    line-height: normal;
    font-size: 14px;
    font-weight: normal;
    vertical-align: middle;
    min-height: 35px;
    -webkit-transition: all 0.12s ease;
    transition: all 0.12s ease;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 2px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -webkit-transition: background 0.2s linear 0s;
    transition: background 0.2s linear 0s;
}

.form-control:focus {
    border-color: rgba(0, 0, 0, 0.1);
    background-color: #f0f0f0;
    outline: 0 !important;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.form-control:focus::-moz-placeholder {
    color: inherit;
    opacity: 0.7;
}

.form-control:focus:-ms-input-placeholder {
    color: inherit;
    opacity: 0.7;
}

.form-control:focus::-webkit-input-placeholder {
    color: inherit;
    opacity: 0.7;
}

.form-control::-moz-placeholder {
    color: inherit;
    opacity: 0.33;
}

.form-control:-ms-input-placeholder {
    color: inherit;
    opacity: 0.33;
}

.form-control::-webkit-input-placeholder {
    color: inherit;
    opacity: 0.33;
}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        background: #ffffff;
    color: rgba(109, 92, 174, 0.73);
    font-weight: bold;
}


/* Input Sizes
--------------------------------------------------
*/

.input-sm, .form-horizontal .form-group-sm .form-control {
    font-size: 13px;
    min-height: 32px;
    height: 32px;
    padding: 8px 9px;
}

.input-lg, .form-horizontal .form-group-lg .form-control {
    border-radius: 3px;
    font-size: 18px;
    height: 45px;
    padding: 11px 13px;
}

.input-xlg {
    height: 51px;
    font-size: 18px;
    line-height: 22px;
}


/* Checkboxes and Radio buttons 
--------------------------------------------------
*/

.radio, .checkbox {
    margin-bottom: 10px;
    margin-top: 10px;
    padding-left: 0px;
}

.radio label, .checkbox label {
    display: inline-block;
    cursor: pointer;
    position: relative;
    padding-left: 25px !important;
    margin-right: 15px;
    font-size: 13px;
}

.radio label:before, .checkbox label:before {
    content: "";
    display: inline-block;
    width: 17px;
    height: 17px;
    margin-right: 10px;
    position: absolute;
    left: 0px;
    background-color: #ffffff;
    border: 1px solid #d0d0d0;
}

.radio label {
    margin-bottom: 6px;
}

.radio label:before {
    bottom: 2.5px;
    border-radius: 99px;
    -webkit-transition: border 0.3s 0s cubic-bezier(0.455, 0.03, 0.215, 1.33);
    transition: border 0.3s 0s cubic-bezier(0.455, 0.03, 0.215, 1.33);
}

.radio input[type=radio]:checked+label:before {
    border-width: 5px;
}

.radio input[type="radio"]:focus+label {
    color: #2c2c2c;
}

.radio input[type="radio"]:focus+label:before {
    background-color: #e6e6e6;
}

.radio input[type=radio] {
    opacity: 0;
    width: 0;
    height: 0;
}

.radio input[type=radio][disabled]+label {
    opacity: 0.65;
}

.radio.radio-success input[type=radio]:checked+label:before {
    border-color: #10cfbd;
}

.radio.radio-primary input[type=radio]:checked+label:before {
    border-color: #6d5cae;
}

.radio.radio-info input[type=radio]:checked+label:before {
    border-color: #3b4752;
}

.radio.radio-warning input[type=radio]:checked+label:before {
    border-color: #f8d053;
}

.radio.radio-danger input[type=radio]:checked+label:before {
    border-color: #f55753;
}

.radio.radio-complete input[type=radio]:checked+label:before {
    border-color: #48b0f7;
}

.checkbox input[type=radio][disabled]+label:after {
    background-color: #e6e6e6;
}

.checkbox label {
    transition: border 0.2s linear 0s, color 0.2s linear 0s;
    white-space: nowrap;
}

.checkbox label:before {
    top: 1.4px;
    border-radius: 3px;
    transition: border 0.2s linear 0s, color 0.2s linear 0s;
}

.checkbox label::after {
    display: inline-block;
    width: 16px;
    height: 16px;
    position: absolute;
    left: 3.2px;
    top: 0px;
    font-size: 11px;
    transition: border 0.2s linear 0s, color 0.2s linear 0s;
}

.checkbox label:after {
    border-radius: 3px;
}

.checkbox input[type=checkbox] {
    opacity: 0;
    width: 0;
    height: 0;
}

.checkbox.checkbox-circle label:after {
    border-radius: 99px;
}

.checkbox.checkbox-circle label:before {
    border-radius: 99px;
}

.checkbox input[type=checkbox]:checked+label:before {
    border-width: 8.5px;
}

.checkbox input[type=checkbox]:checked+label::after {
    font-family: 'FontAwesome';
    content: "\F00C";
    color: #fff;
}

.checkbox input[type="checkbox"]:focus+label {
    color: #2c2c2c;
}

.checkbox input[type="checkbox"]:focus+label:before {
    background-color: #e6e6e6;
}

.checkbox input[type=checkbox][disabled]+label {
    opacity: 0.65;
}

.checkbox input[type=checkbox][disabled]+label:before {
    background-color: #eceff3;
}

.checkbox.right label {
    margin-right: 35px;
    padding-left: 0 !important;
}

.checkbox.right label:before {
    right: -35px;
    left: auto;
}

.checkbox.right input[type=checkbox]:checked+label {
    position: relative;
}

.checkbox.right input[type=checkbox]:checked+label::after {
    font-family: 'FontAwesome';
    content: "\F00C";
    position: absolute;
    right: -27px;
    left: auto;
}

body.rtl .checkbox label::after {
    left: -1.2px;
}

.checkbox.check-success input[type=checkbox]:checked+label:before {
    border-color: #10cfbd;
}

.checkbox.check-primary input[type=checkbox]:checked+label:before {
    border-color: #6d5cae;
}

.checkbox.check-complete input[type=checkbox]:checked+label:before {
    border-color: #48b0f7;
}

.checkbox.check-warning input[type=checkbox]:checked+label:before {
    border-color: #f8d053;
}

.checkbox.check-danger input[type=checkbox]:checked+label:before {
    border-color: #f55753;
}

.checkbox.check-info input[type=checkbox]:checked+label:before {
    border-color: #3b4752;
}

.checkbox.check-success input[type=checkbox]:checked+label::after, .checkbox.check-primary input[type=checkbox]:checked+label::after, .checkbox.check-complete input[type=checkbox]:checked+label::after, .checkbox.check-warning input[type=checkbox]:checked+label::after, .checkbox.check-danger input[type=checkbox]:checked+label::after, .checkbox.check-info input[type=checkbox]:checked+label::after {
    color: #ffffff;
}

.input-group-addon:first-child {
    border-right: 0;
    border-left: 1px solid rgba(0, 0, 0, 0.07);
    -webkit-border-top-left-radius: 2px;
    -moz-border-radius-topleft: 2px;
    border-top-left-radius: 2px;
    -webkit-border-bottom-left-radius: 2px;
    -moz-border-radius-bottomleft: 2px;
    border-bottom-left-radius: 2px;
    -webkit-border-top-right-radius: 0;
    -moz-border-radius-topright: 0;
    border-top-right-radius: 0;
    -webkit-border-bottom-right-radius: 0;
    -moz-border-radius-bottomright: 0;
    border-bottom-right-radius: 0;
}

.input-group-addon:last-child {
    border-right: 1px solid rgba(0, 0, 0, 0.07);
    border-left: 0;
    -webkit-border-top-right-radius: 2px;
    -moz-border-radius-topright: 2px;
    border-top-right-radius: 2px;
    -webkit-border-bottom-right-radius: 2px;
    -moz-border-radius-bottomright: 2px;
    border-bottom-right-radius: 2px;
}

.input-group .form-control:first-child {
    -webkit-border-top-right-radius: 0;
    -moz-border-radius-topright: 0;
    border-top-right-radius: 0;
    -webkit-border-bottom-right-radius: 0;
    -moz-border-radius-bottomright: 0;
    border-bottom-right-radius: 0;
}

.input-group.transparent .input-group-addon {
    background-color: transparent;
    border-color: rgba(0, 0, 0, 0.07);
}


/* Form layouts
--------------------------------------------------
*/

@media only screen and (min-width: 768px) {
    form .row {
        margin-left: 0;
        margin-right: 0;
    }
    form .row [class*='col-']:not(:first-child), form .row [class*='col-']:not(:last-child) {
        padding-right: 7px;
        padding-left: 7px;
    }
    form .row [class*='col-']:first-child {
        padding-left: 0;
    }
    form .row [class*='col-']:last-child {
        padding-right: 0;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    form .row [class*="col-md-"]:not(:first-child), form .row [class*="col-md-"]:not(:last-child) {
        padding-right: 0;
        padding-left: 0;
    }
}


/* Form layouts  : Horizontal
--------------------------------------------------
*/

.form-horizontal .form-group {
    border-bottom: 1px solid #e6e6e6;
    padding-top: 19px;
    padding-bottom: 19px;
    margin-bottom: 0;
}

.form-horizontal .form-group:last-child {
    border-bottom: none;
}

.form-horizontal .form-group:hover .control-label {
    opacity: .6;
}

.form-horizontal .form-group.focused .control-label {
    opacity: 1;
}

.form-horizontal .form-group .control-label {
    text-align: left;
    opacity: .42;
    -webkit-transition: opacity ease 0.3s;
    transition: opacity ease 0.3s;
}


/* Form layouts  : Attached
--------------------------------------------------
*/

.form-group-attached .form-group.form-group-default {
    border-radius: 0;
    margin-bottom: 0;
}

.form-group-attached>div {
    margin: 0;
}

.form-group-attached>div:first-child.row>[class*='col-']:first-child .form-group-default {
    -webkit-border-top-left-radius: 2px;
    -moz-border-radius-topleft: 2px;
    border-top-left-radius: 2px;
}

.form-group-attached>div:first-child.row>[class*='col-']:last-child .form-group-default {
    -webkit-border-top-right-radius: 2px;
    -moz-border-radius-topright: 2px;
    border-top-right-radius: 2px;
}

.form-group-attached>div:first-child.form-group-default {
    -webkit-border-top-left-radius: 2px;
    -moz-border-radius-topleft: 2px;
    border-top-left-radius: 2px;
    -webkit-border-top-right-radius: 2px;
    -moz-border-radius-topright: 2px;
    border-top-right-radius: 2px;
}

.form-group-attached>div:last-child.row>[class*='col-']:first-child .form-group-default {
    -webkit-border-bottom-left-radius: 2px;
    -moz-border-radius-bottomleft: 2px;
    border-bottom-left-radius: 2px;
}

.form-group-attached>div:last-child.row>[class*='col-']:last-child .form-group-default {
    -webkit-border-bottom-right-radius: 2px;
    -moz-border-radius-bottomright: 2px;
    border-bottom-right-radius: 2px;
}

.form-group-attached>div:last-child.form-group-default {
    -webkit-border-bottom-left-radius: 2px;
    -moz-border-radius-bottomleft: 2px;
    border-bottom-left-radius: 2px;
    -webkit-border-bottom-right-radius: 2px;
    -moz-border-radius-bottomright: 2px;
    border-bottom-right-radius: 2px;
}

.form-group-attached>div.row>[class*='col-'] {
    padding-right: 0 !important;
    padding-left: 0 !important;
}

.form-group-attached>div.row>[class*='col-']:not(:only-child):not(:last-child)>.form-group-default {
    border-right-color: transparent;
}

.form-group-attached>div:not(:last-child) .form-group-default, .form-group-attached>div:not(:last-child).form-group-default {
    border-bottom-color: transparent;
}


/* Form layouts  : Responsive Handlers
--------------------------------------------------
*/

@media (max-width: 767px) {
    .form-group-attached .form-group-default {
        border-right-color: rgba(0, 0, 0, 0.07) !important;
    }
}

@media only screen and (min-width: 768px) {
    .form-group-attached>div.row>[class*='col-'] .form-group {
        height: 100%;
        width: 100%;
    }
}


/* Form Groups 
--------------------------------------------------
*/

.form-group {
    margin-bottom: 10px;
}

.form-group label:not(.error) {
    font-family: 'Montserrat';
    font-size: 12px;
    text-transform: capitalize;
    font-weight: 600;
}

.form-group label .help {
    margin-left: 8px;
}

.form-group .help {
    font-size: 12px;
    color: rgba(98, 98, 98, 0.55);
}

.form-group-default {
    background-color: #fff;
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 2px;
    padding-top: 7px;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 4px;
    overflow: hidden;
    -webkit-transition: background-color 0.2s ease;
    transition: background-color 0.2s ease;
}

.form-group-default.required:after {
    color: #f55753;
    content: "*";
    font-family: arial;
    font-size: 20px;
    position: absolute;
    right: 12px;
    top: 6px;
}

.form-group-default.disabled {
    background: #f8f8f8;
    color: rgba(98, 98, 98, 0.23);
}

.form-group-default.disabled input {
    opacity: .6;
}

.form-group-default.disabled.focused {
    background: #f8f8f8;
}

.form-group-default.disabled.focused label {
    opacity: 1;
}

.form-group-default.focused {
    border-color: rgba(0, 0, 0, 0.1) !important;
    background-color: #f0f0f0;
}

.form-group-default.focused label {
    opacity: .4;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
}

.form-group-default.has-error {
    background-color: rgba(245, 87, 83, 0.1);
}

.form-group-default.has-success .form-control-feedback, .form-group-default.has-error .form-control-feedback {
    display: none !important;
}

.form-group-default.has-success .form-control, .form-group-default.has-success .form-control:focus, .form-group-default.has-error .form-control, .form-group-default.has-error .form-control:focus {
    border: none;
    box-shadow: none;
}

.form-group-default.input-group {
    padding: 0;
}

.form-group-default.input-group>label {
    margin-top: 6px;
    padding-left: 12px;
}

.form-group-default.input-group>label.inline {
    margin-top: 16px;
    float: left;
}

.form-group-default.input-group>.form-control {
    margin-top: -2px;
    margin-bottom: 3px;
    padding-left: 12px;
}

.form-group-default.input-group .input-group-addon {
    height: calc(50px);
    min-width: calc(50px);
    border-radius: 0;
    border: none;
}

.form-group-default.input-group.focused .input-group-addon {
    border-color: rgba(0, 0, 0, 0.1);
}

.form-group-default .form-control {
    border: none;
    height: 25px;
    min-height: 25px;
    padding: 0;
    margin-top: -4px;
    background: none;
}

.form-group-default .form-control.error {
    color: #2c2c2c;
}

.form-group-default .form-control:focus {
    background: none;
}

.form-group-default textarea.form-control {
    padding-top: 5px;
}

.form-group-default label {
    margin: 0;
    display: block;
    opacity: 1;
    -webkit-transition: opacity 0.2s ease;
    transition: opacity 0.2s ease;
}

.form-group-default label.label-lg {
    font-size: 13px;
    left: 13px;
    top: 9px;
}

.form-group-default label.label-sm {
    font-size: 11px;
    left: 11px;
    top: 6px;
}

.form-group-default label.highlight {
    opacity: 1;
}

.form-group-default label.fade {
    opacity: .5;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    backface-visibility: hidden;
}

.form-group-default>.input-lg {
    height: 29px;
    min-height: 29px;
    padding-left: 1px;
}

.form-group-default>.input-sm {
    min-height: 18px;
    height: 18px;
}

.form-group-default.form-group-default-select {
    overflow: visible;
}

.form-group-default.form-group-default-select .ui-select-container.ui-select-bootstrap.dropdown .ui-select-match {
    padding-top: 6px;
    height: 23px;
}

.form-group-default.form-group-default-select .ui-select-container .select2-choices {
    border: 0px;
}

.form-group-default.form-group-default-select2 {
    padding: 0;
}

.form-group-default.form-group-default-select2>label {
    position: absolute;
    z-index: 10;
    padding: 7px 12px 0 12px;
}

.form-group-default.form-group-default-select2>label.label-lg {
    left: 0;
    top: 0;
}

.form-group-default.form-group-default-select2>label.label-sm {
    left: 0;
    top: 0;
}

.form-group-default.form-group-default-select2 .select2-container .select2-choice {
    padding-top: 20px;
    height: 52px;
}

.form-group-default.form-group-default-select2 .select2-container .select2-choice .select2-arrow b:before {
    top: 20px;
}

.form-group-default.form-group-default-select2 .select2-container .select2-choice .select2-chosen {
    padding-left: 3px;
    padding-top: 1px;
}

.form-group-default.form-group-default-select2 .select2-container .select2-choices {
    padding-top: 20px;
    height: 52px;
    border: 0px;
}

.form-group-default.form-group-default-select2>.input-lg {
    height: auto;
    padding: 0;
}

.form-group-default.form-group-default-select2>.input-lg .select2-choice {
    padding-top: 20px;
    height: 56px;
}

.form-group-default.form-group-default-select2>.input-sm {
    height: auto;
    padding: 0;
}

.form-group-default.form-group-default-select2>.input-sm .select2-choice {
    padding-top: 20px;
    height: 46px;
}

.form-group-default.form-group-default-selectFx {
    padding: 0;
}

.form-group-default.form-group-default-selectFx>label {
    position: absolute;
    z-index: 10;
    padding: 7px 12px 0 12px;
}

.form-group-default.form-group-default-selectFx>label.label-lg {
    left: 0;
    top: 0;
}

.form-group-default.form-group-default-selectFx>label.label-sm {
    left: 0;
    top: 0;
}

.form-group-default.form-group-default-selectFx .cs-wrapper .cs-placeholder {
    padding-top: 28px;
    height: 52px;
    padding-left: 12px;
}

.form-group-default.form-group-default-selectFx .cs-wrapper .cs-select {
    height: auto;
}

.form-group-default.form-group-default-selectFx .cs-wrapper .cs-select>span:after, .form-group-default.form-group-default-selectFx .cs-wrapper .cs-select .cs-selected span:after {
    top: 39px;
}

.form-group-default.form-group-default-selectFx .cs-wrapper .cs-select.input-lg .cs-placeholder {
    height: 60px;
}

.form-group-default.form-group-default-selectFx .cs-wrapper .cs-select.input-sm .cs-placeholder {
    height: 50px;
}

.form-group-default.form-group-default-selectFx .cs-wrapper .dropdown-placeholder {
    vertical-align: top;
}


/* Form validation
--------------------------------------------------
*/

.has-success .help-block, .has-success .control-label, .has-success .radio, .has-success .checkbox, .has-success .radio-inline, .has-success .checkbox-inline {
    color: #0da899;
}

.has-success .form-control {
    border-color: #0da899;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.has-success .form-control:focus {
    border-color: #09786e;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.has-success .input-group-addon {
    background: #f0f0f0;
    border: 1px solid rgba(0, 0, 0, 0.07);
    color: rgba(98, 98, 98, 0.47);
}

.has-success .form-control-feedback {
    color: #0da899;
}

.has-warning .help-block, .has-warning .control-label, .has-warning .radio, .has-warning .checkbox, .has-warning .radio-inline, .has-warning .checkbox-inline {
    color: #c9a843;
}

.has-warning .form-control {
    border-color: #c9a843;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.has-warning .form-control:focus {
    border-color: #a98b31;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.has-warning .input-group-addon {
    background: #f0f0f0;
    border: 1px solid rgba(0, 0, 0, 0.07);
    color: rgba(98, 98, 98, 0.47);
}

.has-warning .form-control-feedback {
    color: #c9a843;
}

.has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline {
    color: #f55753;
}

.has-error .form-control {
    border-color: #f55753;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.has-error .form-control:focus {
    border-color: #f22823;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.has-error .input-group-addon {
    background: #f0f0f0;
    border: 1px solid rgba(0, 0, 0, 0.07);
    color: rgba(98, 98, 98, 0.47);
}

.has-error .form-control-feedback {
    color: #f55753;
}

.error {
    font-size: 12px;
    color: #f55753;
    display: block;
}


/* Addon inputs
--------------------------------------------------
*/

.input-group-addon {
    background: #f0f0f0;
    border: 1px solid rgba(0, 0, 0, 0.07);
    color: rgba(98, 98, 98, 0.47);
    font-size: 14px;
    padding: 6px 9px;
    display: table-cell;
    border-radius: 3px;
    transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s, color 0.2s linear 0s, box-shadow 0.2s linear 0s, background 0.2s linear 0s;
}

.input-group-addon i {
    position: relative;
    top: 1px;
}

.input-group-addon.primary {
    background-color: #6d5cae;
    border: 1px solid #6d5cae;
    color: #ffffff;
}

.input-group-addon.primary .arrow {
    color: #6d5cae;
}

.input-group-addon.success {
    background-color: #0090d9;
    color: #ffffff;
}

.input-group-addon.success .arrow {
    color: #0090d9;
}

.input-group-addon.info {
    background-color: #1f3853;
    color: #ffffff;
}

.input-group-addon.info .arrow {
    color: #1f3853;
}

.input-group-addon.warning {
    background-color: #fbb05e;
    color: #ffffff;
}

.input-group-addon.warning .arrow {
    color: #fbb05e;
}

.input-group-addon.danger {
    background-color: #f35958;
    color: #ffffff;
}

.input-group-addon.danger .arrow {
    color: #f35958;
}

.input-group-addon .arrow {
    position: relative;
    right: -6px;
    color: #D1DADE;
    z-index: 100;
}

.input-group-addon .arrow:before {
    font-family: 'FontAwesome';
    content: "\f0da";
    font-size: 23px;
    position: absolute;
    left: 17px;
    top: -2px;
}

.input-group-addon:last-child .arrow:before {
    font-family: 'FontAwesome';
    content: "\f0d9";
    font-size: 23px;
    position: absolute;
    left: -23px;
    top: -2px;
}

.input-group-addon:last-child input {
    border-left: 0px;
}


/* Plugins
--------------------------------------------------
Datepicker
https://github.com/eternicode/bootstrap-datepicker
*/

.datepicker {
    padding: 16px 25px;
    border-radius: 2px;
    font-size: 12px;
}

.datepicker:after {
    border-bottom-color: #fafafa;
}

.datepicker thead tr .datepicker-switch {
    color: #6f7b8a;
    font-size: 13px;
}

.datepicker thead tr .next, .datepicker thead tr .prev {
    color: #6d5cae;
    content: '';
    font-size: 0px;
}

.datepicker thead tr .next:before, .datepicker thead tr .prev:before {
    color: #6d5cae;
    font-family: 'FontAwesome';
    font-size: 10px;
}

.datepicker thead tr .prev:before {
    content: "\f053";
}

.datepicker thead tr .next:before {
    content: "\f054";
}

.datepicker thead tr .dow {
    font-family: 'Montserrat';
    color: #6d5cae;
    text-transform: uppercase;
    font-size: 11px;
}

.datepicker thead tr th {
    width: 31px;
    height: 29px;
}

.datepicker tbody tr .odd {
    color: #d0d3d8;
}

.datepicker table tr td {
    width: 31px;
    height: 29px;
}

.datepicker table tr td.old, .datepicker table tr td.new {
    color: #e6e6e6;
}

.datepicker table tr td.day:hover {
    background: #f0f0f0;
}

.datepicker table tr td.active {
    background-color: #6d5cae !important;
}

.datepicker table tr td.active, .datepicker table tr td.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover {
    background-image: none;
    text-shadow: none;
    font-weight: 600;
}

.datepicker table tr td.today, .datepicker table tr td.today:hover, .datepicker table tr td.today.disabled, .datepicker table tr td.today.disabled:hover {
    background-color: #f0f0f0;
    background-image: none;
    color: #ffffff;
}

.datepicker table tr td span {
    border-radius: 4px;
    width: 42px;
    height: 42px;
    line-height: 42px;
}

.datepicker table tr td span.active {
    background-color: #6d5cae !important;
}

.datepicker table tr td span.active, .datepicker table tr td span.active:hover, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover {
    background-image: none;
    border: none;
    text-shadow: none;
}

.datepicker.dropdown-menu {
    border-color: #e6e6e6;
    color: #626262;
}

.datepicker.datepicker-dropdown.datepicker-orient-bottom:before {
    border-color: #e6e6e6;
}

.datepicker-inline {
    width: auto;
}

.input-daterange .input-group-addon {
    text-shadow: none;
    border: 0;
}


/* Timepicker 
https://github.com/m3wolf/bootstrap3-timepicker
*/

.bootstrap-timepicker-widget table td a i {
    font-size: 12px;
}

.bootstrap-timepicker-widget a.btn, .bootstrap-timepicker-widget .bootstrap-timepicker-widget input {
    border-radius: 2px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
}

.bootstrap-timepicker-widget.dropdown-menu {
    background: #fff;
}


/* Daterangepicker
http://www.dangrossman.info/
*/

.daterangepicker {
    background: #fff;
}

.daterangepicker .calendar .calendar-date {
    border: 1px solid rgba(0, 0, 0, 0.07);
}

.daterangepicker .calendar .prev, .daterangepicker .calendar .next, .daterangepicker .calendar th {
    color: #6d5cae;
    text-transform: uppercase;
    font-size: 11px;
}

.daterangepicker .calendar .month {
    color: #6f7b8a;
    font-size: 13px;
}

.daterangepicker td.active, .daterangepicker td.active:hover {
    background-color: #6d5cae;
    border-color: #6d5cae;
}


/* Select2
http://ivaynberg.github.io/select2/
*/

.form-group-default .select2-container .select2-choice, .select2-container-multi .select2-choices {
    border-color: transparent;
}

.select2-container .select2-choice {
    background-image: none;
    border-radius: 2px;
    border: 1px solid rgba(0, 0, 0, 0.28);
    padding: 3px 9px;
    transition: border 0.2s linear 0s;
    height: 35px;
}

.select2-container .select2-choice .select2-arrow {
    right: 0;
    left: auto;
    background: transparent;
    border-left: 0px;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.select2-container .select2-choice .select2-arrow b:before {
    font-family: 'FontAwesome';
    content: "\f0d7";
    position: relative;
    top: 2px;
    right: 5px;
    font-size: 12px;
}

.select2-container .select2-choice>.select2-chosen {
    margin-right: 26px;
    margin-left: 0;
}

.select2-container.select2-drop-above .select2-choice {
    border-bottom-right-radius: 2px;
    border-bottom-left-radius: 2px;
}

.select2-search input, .select2-search-choice-close, .select2-container .select2-choice abbr, .select2-container .select2-choice .select2-arrow b {
    background-image: none !important;
}

.select2-dropdown-open.select2-drop-above .select2-choice, .select2-dropdown-open.select2-drop-above .select2-choices {
    background-image: none !important;
    border: 1px solid rgba(0, 0, 0, 0.07);
    background: #f0f0f0;
}

.select2-dropdown-open .select2-choice .select2-arrow {
    -webkit-transform: scale(scale(1, -1));
    -ms-transform: scale(scale(1, -1));
    transform: scale(scale(1, -1));
}

.select2-drop.select2-drop-above {
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    box-shadow: none;
}

.select2-drop.select2-drop-above.select2-drop-active {
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-bottom: none;
    border-radius: 2px;
    padding-top: 0px;
}

.select2-container-active .select2-choice, .select2-container-active .select2-choices {
    box-shadow: none;
    border: 1px solid rgba(0, 0, 0, 0.07);
    background: #f0f0f0;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
}

.select2-search {
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 4px;
}

.select2-search input {
    background: #ffffff !important;
    vertical-align: baseline;
    line-height: 28px;
    border-radius: 2px;
    border: none;
    font-size: 12px;
    border: 1px solid rgba(0, 0, 0, 0.07);
}

.select2-results {
    margin: 3px 10px 10px 3px;
}

.select2-results li {
    color: #626262;
}

.select2-results li.select2-result-with-children>.select2-result-label {
    color: #2c2c2c;
}

.select2-results li.select2-result-with-children>.select2-result-label:first-child {
    padding-top: 8px;
}

.select2-results .select2-highlighted {
    background: #f0f0f0;
    border-radius: 3px;
}

.select2-results .select2-highlighted .select2-result-label {
    color: #626262;
}

.select2-results .select2-no-results, .select2-results .select2-searching, .select2-results .select2-selection-limit {
    background: none;
    color: #626262;
    font-size: 12px;
    padding-left: 8px;
    padding-top: 0px;
    position: relative;
    top: -5px;
}

.select2-drop-active {
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-bottom: none;
    border-top: none;
    border-bottom-right-radius: 2px;
    border-bottom-left-radius: 2px;
    padding-top: 5px;
    z-index: 790;
}

.select2-container-multi .select2-choices {
    background-image: none;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 2px;
}

.select2-container-multi .select2-choices .select2-search-choice {
    background-color: #e6e6e6;
    background-image: none;
    border: none;
    box-shadow: none;
    color: inherit;
    border-radius: 8px;
    margin: 8px -5px 7px 10px;
    padding: 4px 8px 4px 21px;
}

.select2-container-multi.select2-container-active .select2-choices {
    border: 1px solid rgba(0, 0, 0, 0.07);
    box-shadow: none;
}

.select2-container-multi.select2-container-active .select2-search-choice {
    background-color: #ffffff !important;
}

.select2-container-multi .select2-search-choice-close {
    left: 6px;
}

.select2-search-choice-close {
    background: none;
    top: 4px;
    right: 0;
}

.select2-search-choice-close:hover {
    text-decoration: none;
}

.select2-search-choice-close:before {
    font-family: 'FontAwesome';
    content: "\f00d";
    font-size: 12px;
    color: #626262;
}

.select2-drop-multi .select2-results .select2-no-results, .select2-drop-multi .select2-results .select2-searching, .select2-drop-multi .select2-results .select2-selection-limit {
    top: 0px;
}

.select2.form-control {
    padding: 0;
    box-shadow: none;
    border: 0;
}

.select2-drop-mask {
    z-index: 700;
}

.ui-select-bootstrap .ui-select-choices-row.active>a {
    background: #f0f0f0;
    border-radius: 3px;
    color: #626262;
}

.ui-select-bootstrap>.ui-select-choices {
    background-color: #fff;
}

.ui-select-choices-group-label {
    color: #2c2c2c;
    font-weight: bold;
}

.modal-open .select2-drop-active {
    z-index: 1051;
}

.modal-open .datepicker.dropdown-menu {
    z-index: 1051 !important;
}

.modal-open .select2-drop-mask {
    z-index: 1050;
}

.modal-open .cs-skin-slide.cs-active {
    z-index: 1050;
}

.dropdown-placeholder {
    display: inline-block;
    vertical-align: middle;
}

.dropdown-mask {
    bottom: 0;
    display: none;
    left: 0;
    outline: 0 none;
    overflow: hidden;
    position: fixed;
    right: 0;
    top: 0;
    z-index: 600;
}


/* Bootstrap Tags input
https://github.com/timschlechter/bootstrap-tagsinput
*/

.form-group-default .bootstrap-tagsinput {
    border: 0px;
    padding-left: 0;
}

.bootstrap-tagsinput {
    background-color: transparent;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 4px;
    padding-bottom: 5px;
    -webkit-box-shadow: none;
    box-shadow: none;
    width: 100%;
    -webkit-transition: background 0.2s linear 0s;
    transition: background 0.2s linear 0s;
}

.bootstrap-tagsinput.active-element {
    background-color: #e6e6e6;
}

.bootstrap-tagsinput input {
    border: none;
    margin-bottom: 0px;
    min-height: 25px;
    min-width: 10em !important;
}

.bootstrap-tagsinput .tag {
    vertical-align: middle;
    padding: 6px 9px;
    padding-right: 6px;
    border-radius: 3px;
    line-height: 30px;
}

.bootstrap-tagsinput .tag[data-role="remove"] {
    margin-left: 4px;
}

.bootstrap-tagsinput .tag[data-role="remove"]:hover:active, .bootstrap-tagsinput .tag [data-role="remove"]:hover {
    box-shadow: none;
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
    font-family: 'pages-icon';
    content: "\e60a";
    padding: 0;
}


/* Bootstrap3 wysihtml5
https://github.com/Waxolunist/bootstrap3-wysihtml5-bower
*/

.wysiwyg5-wrapper {
    position: relative;
}

.wysiwyg5-wrapper .wysihtml5-toolbar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    /*height: 50px;*/
    background: #f0f0f0;
    border-top: 1px solid #e6e6e6;
}

.wysiwyg5-wrapper .wysihtml5-toolbar .btn {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-color: transparent;
    border-right-color: #e6e6e6;
    color: #A5A5A5;
    font-size: 16px;
    font-weight: 600;
    height: 50px;
    line-height: 50px;
    padding: 0 5px;
    border-width: 1px;
    border-radius: 0 !important;
    box-shadow: none !important;
}

.wysiwyg5-wrapper .wysihtml5-toolbar .btn:hover .editor-icon {
    opacity: .8;
}

.wysiwyg5-wrapper .wysihtml5-toolbar .btn.active .editor-icon {
    opacity: 1;
}

.wysiwyg5-wrapper .wysihtml5-toolbar .btn.dropdown-toggle {
    padding-left: 10px;
    padding-right: 20px;
}

.wysiwyg5-wrapper .wysihtml5-toolbar .btn.dropdown-toggle .current-font {
    opacity: .5;
    font-size: 14px;
}

.wysiwyg5-wrapper .wysihtml5-toolbar>li {
    margin: 0;
    padding: 0;
}

.wysiwyg5-wrapper .wysiwyg {
    width: 100%;
    min-height: 200px;
    font-size: 14px;
    line-height: 18px;
    padding-bottom: 50px !important;
    border: 0;
}

.wysiwyg5-wrapper .wysiwyg:focus {
    background-color: #fafafa;
    outline: 0 !important;
    -webkit-box-shadow: none;
    box-shadow: none;
}

.wysiwyg5-wrapper .expand-wysiwyg {
    bottom: 0;
    color: #A5A5A5;
    font-size: 20px;
    font-weight: 600;
    height: 50px;
    line-height: 50px;
    padding: 0 15px;
    position: absolute;
    right: 0;
}

.wysiwyg5-wrapper .wysihtml5-sandbox {
    border: none !important;
    padding: 16px 16px 50px !important;
    width: 100% !important;
}

.wysiwyg5-wrapper .wysihtml5-sandbox.expanded {
    height: 100% !important;
}

.toggle-wysiwyg {
    position: absolute;
    right: 15px;
    top: 0;
}

.toggle-wysiwyg li {
    display: inline-block;
    font-weight: 600;
}

.editor-icon {
    background-image: url("../img/editor_tray.png");
    display: inline-block;
    height: 40px;
    margin-top: 5px;
    opacity: 0.4;
    vertical-align: top;
    width: 40px;
}

.editor-icon-headline {
    background-position: 0 0;
    width: 31px;
}

.editor-icon-bold {
    background-position: -40px 0;
}

.editor-icon-italic {
    background-position: -80px 0;
}

.editor-icon-underline {
    background-position: -120px 0;
}

.editor-icon-link {
    background-position: -160px 0;
}

.editor-icon-quote {
    background-position: -200px 0;
}

.editor-icon-ul {
    background-position: -240px 0;
}

.editor-icon-ol {
    background-position: -280px 0;
}

.editor-icon-outdent {
    background-position: -320px 0;
}

.editor-icon-indent {
    background-position: -360px 0;
}

.editor-icon-image {
    background-position: -400px 0;
}

.editor-icon-html {
    background-position: -440px 0;
}


/* Summernote
https://github.com/HackerWins/summernote
*/

.summernote-wrapper .note-editor {
    border-color: #e6e6e6;
}

.summernote-wrapper .note-editor .note-toolbar {
    padding: 0;
    background-color: #f0f0f0;
    border-bottom: none;
}

.summernote-wrapper .note-editor .note-toolbar .btn-group {
    margin: 0 -1px 0 0;
}

.summernote-wrapper .note-editor .note-toolbar .btn-group .btn {
    font-size: 12px;
    font-weight: 600;
    height: 50px;
    min-width: 47px;
    line-height: 50px;
    padding: 0 5px;
    border-radius: 0;
    background-color: #f0f0f0;
    border-color: transparent;
    border-right-color: #e6e6e6;
    border-bottom-color: #e6e6e6;
    color: #626262;
}

.summernote-wrapper .note-editor .note-toolbar .btn-group .btn.active, .summernote-wrapper .note-editor .note-toolbar .btn-group .btn:active {
    background-color: #e6e6e6;
}

.summernote-wrapper .note-editor .note-toolbar .btn-group .btn.dropdown-toggle {
    min-width: 61px;
}

.summernote-wrapper .note-editor .note-toolbar .btn-group .btn:not(:last-child), .summernote-wrapper .note-editor .note-toolbar .btn-group .btn:not(:only-child) {
    margin-right: 1px;
}

.summernote-wrapper .note-editor .note-statusbar {
    background-color: transparent;
}

.summernote-wrapper .note-editor .note-statusbar .note-resizebar {
    border-top-color: transparent;
}

.summernote-wrapper .note-editor .note-statusbar .note-resizebar .note-icon-bar {
    border-top: 1px solid #e6e6e6;
}

.summernote-wrapper .note-popover .popover .popover-content .dropdown-menu li a i, .summernote-wrapper .note-toolbar .dropdown-menu li a i {
    color: #6d5cae;
}

input, input:focus {
    -webkit-transition: none !important;
}

input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #fff inset !important;
}

input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #f0f0f0 inset !important;
}

input.error:-webkit-autofill, input.error:-webkit-autofill:focus, .has-error input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #F9E9E9 inset !important;
}


/* Pages SelectFx */


/* Default custom select styles */

div.cs-select {
    display: inline-block;
    vertical-align: middle;
    position: relative;
    text-align: left;
    background: #fff;
    width: 100%;
    max-width: 500px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

div.cs-select:focus {
    outline: none;
    /* For better accessibility add a style for this in your skin */
}

.cs-select select {
    display: none;
}

.cs-select span {
    display: block;
    position: relative;
    cursor: pointer;
    padding: 1em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


/* Placeholder and selected option */

.cs-select>span {
    padding-right: 3em;
}

.cs-select>span::after, .cs-select .cs-selected span::after {
    speak: none;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.cs-select>span::after {
    content: '\25BE';
    right: 1em;
}

.cs-select .cs-selected span::after {
    content: '\2713';
    margin-left: 1em;
}

.cs-select.cs-active>span::after {
    -webkit-transform: translateY(-50%) rotate(180deg);
    transform: translateY(-50%) rotate(180deg);
}


/* Options */

.cs-select .cs-options {
    position: absolute;
    overflow: hidden;
    width: 100%;
    background: #fff;
    visibility: hidden;
}

.cs-select.cs-active .cs-options {
    visibility: visible;
}

.cs-select ul {
    list-style: none;
    margin: 0;
    padding: 0;
    width: 100%;
}

.cs-select ul span {
    padding: 1em;
}

.cs-select ul li.cs-focus span {
    background-color: #ddd;
}


/* Optgroup and optgroup label */

.cs-select li.cs-optgroup ul {
    padding-left: 1em;
}

.cs-select li.cs-optgroup>span {
    cursor: default;
}

div.cs-skin-slide {
    color: #fff;
    /*font-size: 1.5em;*/
    width: 300px;
}

@media screen and (max-width: 30em) {
    div.cs-skin-slide {
        font-size: 1em;
        width: 250px;
    }
}

div.cs-skin-slide::before {
    content: '';
    background: #282b30;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: -webkit-transform 0.3s;
    transition: transform 0.3s;
}

.cs-skin-slide.cs-active::before {
    -webkit-transform: scale3d(1.1, 3.5, 1);
    transform: scale3d(1.1, 3.5, 1);
}

.cs-skin-slide>span {
    height: 80px;
    line-height: 32px;
    -webkit-transition: text-indent 0.3s, opacity 0.3s;
    transition: text-indent 0.3s, opacity 0.3s;
}

@media screen and (max-width: 30em) {
    .cs-skin-slide>span {
        height: 60px;
        line-height: 28px;
    }
}

.cs-skin-slide.cs-active>span {
    text-indent: -290px;
    opacity: 0;
}

.cs-skin-slide.cs-active>span::after {
    -webkit-transform: translate3d(0, -50%, 0);
    transform: translate3d(0, -50%, 0);
}

.cs-skin-slide .cs-options {
    background: transparent;
    width: 70%;
    height: 400%;
    padding: 1.9em 0;
    top: 50%;
    left: 50%;
    -webkit-transform: translate3d(-50%, -50%, 0);
    transform: translate3d(-50%, -50%, 0);
    -ms-transform: translate(-50%, -50%);
}

@media screen and (max-width: 30em) {
    .cs-skin-slide .cs-options {
        padding-top: 3em;
    }
}

.cs-skin-slide .cs-options li {
    opacity: 0;
    -webkit-transform: translate3d(30%, 0, 0);
    transform: translate3d(30%, 0, 0);
    -webkit-transition: -webkit-transform 0.3s, opacity 0.3s;
    transition: transform 0.3s, opacity 0.3s;
}

.cs-skin-slide.cs-active .cs-options li {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
    opacity: 1;
}

.cs-skin-slide.cs-active .cs-options li:first-child {
    -webkit-transition-delay: 0.05s;
    transition-delay: 0.05s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(2) {
    -webkit-transition-delay: 0.1s;
    transition-delay: 0.1s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(3) {
    -webkit-transition-delay: 0.15s;
    transition-delay: 0.15s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(4) {
    -webkit-transition-delay: 0.2s;
    transition-delay: 0.2s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(5) {
    -webkit-transition-delay: 0.25s;
    transition-delay: 0.25s;
}


/* more options need more delay declaration */

.cs-skin-slide .cs-options li span {
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 2px;
    font-size: 65%;
    padding: 0.8em 1em 0.8em 2.5em;
}

.cs-skin-slide .cs-options li span:hover, .cs-skin-slide .cs-options li.cs-focus span, .cs-skin-slide .cs-options li.cs-selected span {
    color: #eb7e7f;
    background: transparent;
}

.cs-skin-slide .cs-selected span::after {
    content: '';
}


/* Pages Select  overriding */

.form-group-default .cs-skin-slide>span {
    padding: 0 30px 0 0;
    height: 22px;
    line-height: 21px;
}

.form-group-default .cs-wrapper {
    width: 100%;
}

.cs-wrapper {
    display: inline-block;
}

.form-control.cs-select:not(.cs-active) {
    width: 100% !important;
}

.cs-select {
    background-color: transparent;
}

.cs-select span {
    text-overflow: initial;
}

.cs-select .cs-placeholder {
    width: 100%;
}

div.cs-skin-slide {
    width: auto;
    font-family: Arial, sans-serif;
    color: #5e5e5e;
}

div.cs-skin-slide:before {
    background-color: transparent;
}

div.cs-skin-slide.cs-transparent {
    background: none;
}

div.cs-skin-slide.cs-transparent .cs-backdrop {
    border-color: transparent;
    background: none;
}

div.cs-skin-slide.cs-transparent.cs-active .cs-backdrop {
    background: #fafafa;
}

div.cs-skin-slide>span {
    height: 35px;
    padding: 6px 33px 6px 17px;
    line-height: 23px;
    z-index: 1;
}

div.cs-skin-slide.cs-active {
    z-index: 790;
}

div.cs-skin-slide.cs-active:before {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
}

div.cs-skin-slide.cs-active .cs-backdrop {
    border: transparent;
    background: #fafafa;
    box-shadow: -1px 0 1px #cccccc, 1px 0 1px #cccccc;
}

div.cs-skin-slide>span:after, div.cs-skin-slide.cs-active>span:after {
    content: "\f0d7";
    font-family: FontAwesome;
    color: #5e5e5e;
}

div.cs-skin-slide .cs-options {
    height: auto;
    padding: 9px 0;
    width: auto;
    padding: 10px;
    max-height: 350px;
    transform: translate3d(1, 1, 1);
    overflow: hidden;
    z-index: 1;
}

div.cs-skin-slide .cs-options ul {
    width: 100%;
    display: table;
}

div.cs-skin-slide .cs-options ul li {
    display: table-row;
}

div.cs-skin-slide .cs-options ul li span {
    display: table-cell;
    font-size: 14px;
    font-weight: normal;
    letter-spacing: normal;
    padding: 5px 0;
    text-transform: none;
    max-height: 350px;
    overflow-y: auto;
}

div.cs-skin-slide .cs-options ul li span:hover, div.cs-skin-slide .cs-options ul li.cs-focus span, div.cs-skin-slide .cs-options ul li.cs-selected span {
    color: #2c2c2c;
}

.cs-backdrop {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid rgba(0, 0, 0, 0.07);
    bottom: 0;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(6) {
    transition-delay: 0.3s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(7) {
    transition-delay: 0.35s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(8) {
    transition-delay: 0.4s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(9) {
    transition-delay: 0.45s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(10) {
    transition-delay: 0.5s;
}

.cs-skin-slide.cs-active .cs-options li:nth-child(11) {
    transition-delay: 0.55s;
}


/* Dropzone for Angular */

.dropzone[dropzone="dropzone"] input[type="file"] {
    visibility: hidden;
}


/* end overrides */


/* Demo specifc classes */

.demo-form-wysiwyg {
    height: 250px;
}


/*------------------------------------------------------------------
[16. Tables and Datatables]
*/


/* Generic Tables 
------------------------------------
*/

.table {
    margin-top: 5px;
}

.table thead tr th {
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Montserrat';
    font-size: 13px;
    padding-top: 14px;
    padding-bottom: 14px;
    vertical-align: middle;
    border-bottom: 1px solid rgba(230, 230, 230, 0.7);
    color: rgba(44, 44, 44, 0.35);
}

.table thead tr th[class*='sorting_']:not([class='sorting_disabled']) {
    color: #2c2c2c;
}

.table thead tr th:first-child {
    padding-left: 18px !important;
}

.table thead tr th .btn {
    margin-top: -20px;
    margin-bottom: -20px;
}

.table tbody tr td {
    background: #fff;
    border-bottom: 1px solid rgba(230, 230, 230, 0.7);
    border-top: 0px;
    padding: 20px;
    font-size: 13.5px;
}

.table tbody tr td .btn-tag {
    background: rgba(44, 44, 44, 0.07);
    display: inline-block;
    margin: 5px;
    border-radius: 4px;
    padding: 5px;
    color: #62605a !important;
}

.table tbody tr td .btn-tag:hover {
    background: rgba(44, 44, 44, 0.15);
}

.table tbody tr td[class*='sorting_'] {
    color: #000;
}

.table tbody tr.selected td {
    background: #fef6dd;
}

.table.table-hover tbody tr:hover td {
    background: #daeffd !important;
}

.table.table-hover tbody tr.selected:hover td {
    background: #fef6dd !important;
}

.table.table-striped tbody tr td {
    background: #fafafa !important;
}

.table.table-striped tbody tr:nth-child(2n+1) td {
    background: #fff !important;
}

.table.table-borderless tbody tr td {
    border-top: 0;
}

.table.table-condensed {
    table-layout: fixed;
}

.table.table-condensed thead tr th {
    padding-left: 20px;
    padding-right: 20px;
}

.table.table-condensed tbody tr td {
    padding-top: 12px;
    padding-bottom: 12px;
}

.table.table-condensed thead tr th, .table.table-condensed tbody tr td, .table.table-condensed tbody tr td *:not(.dropdown-default) {
    white-space: nowrap;
    vertical-align: middle;
    overflow: hidden;
    text-overflow: ellipsis;
}

.table.table-condensed thead tr th.reset-overflow *, .table.table-condensed tbody tr td.reset-overflow *, .table.table-condensed tbody tr td *:not(.dropdown-default).reset-overflow * {
    overflow: initial !important;
}

.table.table-condensed.table-detailed>tbody>tr.shown>td {
    background: #fef6dd;
}

.table.table-condensed.table-detailed>tbody>tr.shown>td:first-child:before {
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}

.table.table-condensed.table-detailed>tbody>tr.shown+tr>td {
    background: rgba(250, 250, 250, 0.4);
    padding: 0px 40px;
}

.table.table-condensed.table-detailed>tbody>tr.shown+tr>td .table-inline {
    background: transparent;
}

.table.table-condensed.table-detailed>tbody>tr.shown+tr>td .table-inline tr, .table.table-condensed.table-detailed>tbody>tr.shown+tr>td .table-inline td {
    background: transparent;
    font-weight: 600;
}

.table.table-condensed.table-detailed>tbody>tr.row-details>td:first-child:before {
    content: '';
}

.table.table-condensed.table-detailed>tbody>tr>td:hover {
    cursor: pointer;
}

.table.table-condensed.table-detailed>tbody>tr>td:first-child:before {
    content: "\f054";
    display: inline-block;
    margin-right: 8px;
    font-family: 'FontAwesome';
    -webkit-transition: all 0.12s linear;
    transition: all 0.12s linear;
}

.table.table-condensed.table-detailed .table-inline td {
    border: none;
    text-align: left;
}

.table.table-borderless>tbody>tr>td {
    border-bottom: 0px;
}

.fht-table {
    margin-bottom: 0 !important;
}


/* Data-tables 
------------------------------------
*/

.table.dataTable.no-footer {
    border: none;
}

.dataTables_scroll:hover .dataTables_scrollBody:before {
    content: "";
    top: 0;
    height: 0;
}

.dataTables_scrollBody {
    overflow-y: auto;
    border: none !important;
}

.dataTables_scrollBody:before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: 60px;
    bottom: 0;
    background: transparent;
}

.dataTables_wrapper .dataTables_paginate {
    float: right;
}

.dataTables_wrapper .dataTables_paginate ul>li.disabled a {
    opacity: .5;
}

.dataTables_wrapper .dataTables_paginate ul>li>a {
    padding: 5px 10px;
    color: #626262;
    opacity: .35;
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
}

.dataTables_wrapper .dataTables_paginate ul>li>a:hover {
    opacity: .65;
}

.dataTables_wrapper .dataTables_paginate ul>li.next>a, .dataTables_wrapper .dataTables_paginate ul>li.prev>a {
    opacity: 1;
}

.dataTables_wrapper .dataTables_paginate ul>li.disabled a {
    opacity: .35;
}

.dataTables_wrapper .dataTables_paginate ul>li.disabled a:hover {
    opacity: .35;
}

.dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate {
    margin-top: 25px !important;
}

.dataTables_paginate.paging_bootstrap.pagination {
    padding-top: 0;
    padding-right: 20px;
}

.dataTables_wrapper .dataTables_info {
    clear: none;
    font-size: 12px;
    padding: 0 33px;
    color: #626262;
}

.dataTables_wrapper .dataTables_paginate ul>li {
    display: inline-block;
    padding-left: 0;
    font-size: 11px;
}

.dataTables_scrollHeadInner {
    padding-right: 0 !important;
}

.export-options-container {
    position: relative;
}

.dataTables_wrapper .dataTables_paginate ul>li.active>a {
    font-weight: bold;
    color: #626262;
    opacity: 1;
}

.export-options-container a {
    color: inherit;
    opacity: 1;
}

.exportOptions .DTTT.btn-group a {
    display: block !important;
}

table.dataTable thead .sorting_asc:after {
    background-image: url("../img/icons/sort_asc.png");
}

table.dataTable thead .sorting_desc:after {
    background-image: url("../img/icons/sort_desc.png");
}

table.dataTable thead .sorting:after {
    background-image: url("../img/icons/sort_both.png");
}

table.dataTable thead .sorting_asc_disabled:after {
    background-image: url("../img/icons/sort_asc_disabled.png");
}

table.dataTable thead .sorting_desc_disabled:after {
    background-image: url("../img/icons/sort_desc_disabled.png");
}

table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
    bottom: 12px;
    content: "";
    width: 19px;
    height: 19px;
    background-position: center center;
    opacity: 1;
}


/* Responsive Handlers : Tables */

@media (max-width: 991px) {
    .dataTables_wrapper .dataTables_info {
        float: left;
    }
    .dataTables_paginate.paging_bootstrap.pagination {
        float: right;
    }
}

@media (max-width: 480px) {
    .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate {
        float: none;
        text-align: left;
        clear: both;
        display: block;
    }
}


/* Demo classes */

.demo-table-search thead th:nth-child(1) {
    width: 20%;
}

.demo-table-search thead th:nth-child(2) {
    width: 22%;
}

.demo-table-search thead th:nth-child(3) {
    width: 24%;
}

.demo-table-search thead th:nth-child(4) {
    width: 15%;
}

.demo-table-search thead th:nth-child(5) {
    width: 19%;
}

.demo-table-dynamic thead th:nth-child(1) {
    width: 25%;
}

.demo-table-dynamic thead th:nth-child(2) {
    width: 30%;
}

.demo-table-dynamic thead th:nth-child(3) {
    width: 20%;
}

.demo-table-dynamic thead th:nth-child(4) {
    width: 25%;
}


/*------------------------------------------------------------------
[17. Charts]
*/

.line-chart .nvd3 line.nv-guideline {
    /* Vertical bar on hover in interactive chart */
    stroke-width: 30px;
    stroke-opacity: .04;
    stroke: #000;
}

.line-chart .nvd3 .nv-groups path.nv-area {
    /*  filled area */
    fill-opacity: .1;
}

.line-chart .nvd3 .nv-groups path.nv-line {
    /*  Line */
    stroke-opacity: .3;
}

.line-chart .nvd3 .nv-axis line {
    /*  grid lines */
    stroke-opacity: .5;
}

.line-chart[data-x-grid="false"] .nv-x .tick line {
    display: none;
}

.line-chart[data-y-grid="false"] .nv-y .tick line {
    display: none;
}

.line-chart .domain {
    /* domain */
    opacity: 0;
}

.line-chart[data-points="true"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    /* Toggle points */
    fill-opacity: 1;
    stroke-opacity: .5;
}

.line-chart .nvtooltip table td.legend-color-guide div {
    border-radius: 100px;
}

.line-chart thead .nv-pointer-events-none strong {
    color: #afafaf;
}

.line-chart .nv-pointer-events-none {
    font-size: 12px;
}

.line-chart .nv-pointer-events-none .value.nv-pointer-events-none {
    font-family: 'Montserrat';
    font-weight: normal;
    font-size: 11px;
    color: #afafaf;
}

.line-chart .nvtooltip table {
    margin: 12px 10px 14px 15px;
}

.line-chart .nvtooltip.xy-tooltip.nv-pointer-events-none {
    border-color: rgba(0, 0, 0, 0.12);
    box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
}

.line-chart[data-stroke-width="1"] .nvd3 .nv-groups path.nv-line {
    /* Line widths */
    stroke-width: 1px;
}

.line-chart[data-stroke-width="1"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    /* Line widths */
    stroke-width: 2px;
}

.line-chart[data-stroke-width="2"] .nvd3 .nv-groups path.nv-line {
    stroke-width: 2px;
}

.line-chart[data-stroke-width="2"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke-width: 3px;
}

.line-chart[data-stroke-width="3"] .nvd3 .nv-groups path.nv-line {
    stroke-width: 3px;
}

.line-chart[data-stroke-width="3"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke-width: 4px;
}

.line-chart .tick text, .line-chart .nvd3 .nv-axis .nv-axisMaxMin text {
    fill: rgba(98, 98, 98, 0.5);
    font-family: "Montserrat";
    font-size: 11px;
    text-transform: uppercase;
    font-weight: normal;
}

.line-chart .nvd3.nv-scatter .nv-groups .nv-point.hover, .line-chart .nvd3 .nv-groups .nv-point.hover {
    fill: inherit !important;
    stroke: inherit !important;
}


/* Line widths
------------------------------------
*/

.line-chart[data-line-color="master"] .nvd3 line.nv-guideline, .line-chart[data-line-color="master"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="master"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #626262;
}

.line-chart[data-line-color="success"] .nvd3 line.nv-guideline, .line-chart[data-line-color="success"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="success"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #10cfbd;
}

.line-chart[data-line-color="primary"] .nvd3 line.nv-guideline, .line-chart[data-line-color="primary"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="primary"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #6d5cae;
}

.line-chart[data-line-color="info"] .nvd3 line.nv-guideline, .line-chart[data-line-color="info"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="info"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #3b4752;
}

.line-chart[data-line-color="complete"] .nvd3 line.nv-guideline, .line-chart[data-line-color="complete"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="complete"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #48b0f7;
}

.line-chart[data-line-color="warning"] .nvd3 line.nv-guideline, .line-chart[data-line-color="warning"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="warning"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #f8d053;
}

.line-chart[data-line-color="danger"] .nvd3 line.nv-guideline, .line-chart[data-line-color="danger"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="danger"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #f55753;
}

.line-chart[data-line-color="white"] .nvd3 line.nv-guideline, .line-chart[data-line-color="white"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="white"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #fff;
}

.line-chart[data-line-color="black"] .nvd3 line.nv-guideline, .line-chart[data-line-color="black"] .nvd3 .nv-groups path.nv-line, .line-chart[data-line-color="black"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke: #000;
}


/* Area Fill colors
------------------------------------
*/

.line-chart[data-area-color="master"] .nvd3 .nv-groups path.nv-area {
    fill: #626262;
}

.line-chart[data-area-color="success"] .nvd3 .nv-groups path.nv-area {
    fill: #10cfbd;
}

.line-chart[data-area-color="info"] .nvd3 .nv-groups path.nv-area {
    fill: #3b4752;
}

.line-chart[data-area-color="complete"] .nvd3 .nv-groups path.nv-area {
    fill: #48b0f7;
}

.line-chart[data-area-color="primary"] .nvd3 .nv-groups path.nv-area {
    fill: #6d5cae;
}

.line-chart[data-area-color="warning"] .nvd3 .nv-groups path.nv-area {
    fill: #f8d053;
}

.line-chart[data-area-color="danger"] .nvd3 .nv-groups path.nv-area {
    fill: #f55753;
}

.line-chart[data-area-color="white"] .nvd3 .nv-groups path.nv-area {
    fill: #fff;
}

.line-chart[data-area-color="black"] .nvd3 .nv-groups path.nv-area {
    fill: #000;
}


/* Point fill colors
------------------------------------
*/

.line-chart[data-point-color="master"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #626262;
}

.line-chart[data-point-color="success"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #10cfbd;
}

.line-chart[data-point-color="info"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #3b4752;
}

.line-chart[data-point-color="complete"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #48b0f7;
}

.line-chart[data-point-color="primary"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #6d5cae;
}

.line-chart[data-point-color="warning"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #f8d053;
}

.line-chart[data-point-color="danger"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #f55753;
}

.line-chart[data-point-color="white"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    fill: #fff;
}

#nvd3-line svg, #nvd3-line2 svg, #nvd3-area svg {
    height: 500px;
}


/* Rickshaw Charts
------------------------------------
*/

.rickshaw-chart.rickshaw_graph .detail {
    padding-left: 15px;
    transform: translateX(-15px);
    width: 30px;
    background: rgba(0, 0, 0, 0.04);
    right: -15px;
}

.rickshaw-chart.rickshaw_graph .detail .item, .rickshaw-chart.rickshaw_graph .detail .x_label {
    transform: translateX(15px);
}

.rickshaw-chart.rickshaw_graph .detail:after {
    content: "";
    width: 1px;
    background: rgba(0, 0, 0, 0.2);
    height: 100%;
    display: block;
}

.rickshaw-chart .y_grid .tick.major line {
    stroke-dasharray: 3px, 5px;
    opacity: .7;
}

.rickshaw-chart.rickshaw_graph .detail .x_label {
    display: none;
}

.rickshaw-chart.rickshaw_graph .detail .item {
    line-height: 1.4;
    padding: 0.5em;
}

.rickshaw-chart.rickshaw_graph .detail_swatch {
    float: right;
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 0 4px 0 0;
}

.rickshaw-chart.rickshaw_graph .detail .date {
    font-size: 11px;
    color: #a0a0a0;
    opacity: .5;
}

#tab-rickshaw-realtime #rickshaw-realtime_y_axis {
    position: absolute;
    top: 0;
    background: rgba(255, 255, 255, 0.8);
    bottom: 0;
    width: 40px;
    left: 0;
    z-index: 1;
}

#tab-rickshaw-realtime #rickshaw-realtime_y_axis .rickshaw_graph .y_ticks path, #tab-rickshaw-realtime #rickshaw-realtime_y_axis .rickshaw_graph .x_ticks_d3 path {
    fill: none;
    stroke: none;
}

#tab-rickshaw-realtime #rickshaw-realtime_y_axis .rickshaw_graph .y_ticks text, #tab-rickshaw-realtime #rickshaw-realtime_y_axis .rickshaw_graph .x_ticks_d3 text {
    opacity: 0.35;
    font-family: 'Montserrat';
    font-size: 11px;
}

#tab-rickshaw-bars #rickshaw-stacked-bars.rickshaw_graph .detail .dot {
    border-radius: 50px;
}

#tab-rickshaw-bars #rickshaw-stacked-bars.rickshaw_graph .detail .x_label {
    display: none;
}

#tab-rickshaw-bars #rickshaw-stacked-bars.rickshaw_graph .detail .item {
    line-height: 1.4;
    padding: 0.5em;
}

#tab-rickshaw-bars #rickshaw-stacked-bars .detail_swatch {
    float: right;
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 0 4px 0 0;
}

#tab-rickshaw-bars #rickshaw-stacked-bars.rickshaw_graph .detail .date {
    font-size: 11px;
    color: #a0a0a0;
    opacity: .5;
}

#tab-rickshaw-slider #rickshaw-slider {
    height: 500px;
}

#tab-rickshaw-slider .rickshaw_graph .x_grid_d3 .tick {
    stroke-opacity: 0;
}

#tab-rickshaw-slider .rickshaw_graph .y_ticks path, #tab-rickshaw-slider .rickshaw_graph .x_ticks_d3 path {
    stroke: none;
}

#tab-rickshaw-slider .rickshaw_graph .y_ticks text, #tab-rickshaw-slider .rickshaw_graph .x_ticks_d3 text {
    font-family: 'Montserrat';
    font-size: 11px;
}

#tab-rickshaw-slider .rickshaw_range_slider_preview .frame {
    opacity: 0;
}

#tab-rickshaw-slider .rickshaw_range_slider_preview .left_handle, #tab-rickshaw-slider .rickshaw_range_slider_preview .right_handle {
    fill: #000;
    fill-opacity: 0.1 !important;
}

#tab-rickshaw-slider .slider {
    position: absolute;
    top: 0;
    height: 93px;
    overflow: hidden;
}

#tab-rickshaw-slider .chart {
    position: absolute;
    bottom: 40px;
    top: 150px;
    left: 33px;
    right: 0;
    width: auto;
}

#tab-rickshaw-slider .chart .x_tick.plain .title {
    font-family: 'Montserrat';
    font-size: 11px;
}

#tab-rickshaw-slider .y_axis {
    bottom: 0;
    position: absolute;
    top: 150px;
    width: 40px;
    left: -6px;
}

#tab-rickshaw-slider .rickshaw_graph .x_tick {
    border-color: transparent;
}

#tab-rickshaw-slider .rickshaw_graph .x_tick .title {
    bottom: -24px;
    left: -15px;
}


/*------------------------------------------------------------------
[18. List]
*/

.list-view-wrapper {
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    position: absolute;
    width: 100%;
    -webkit-overflow-scrolling: touch;
}

.list-view-container {
    position: relative;
}

.list-view-container .list-quickscroll ul {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 0;
    right: 10px;
    z-index: 120;
    padding-top: 10px;
    padding-bottom: 10px;
}

.list-view-container .list-quickscroll ul li a {
    font-size: 0.7em;
    vertical-align: baseline;
}

.list-view-group-container {
    margin: 0;
    min-height: 1px;
    overflow: hidden;
    padding: 26px 0 0 0;
    position: relative;
}

.list-view-group-container:last-child ul {
    border: 0;
}

.list-view-group-header, .list-view-fake-header {
    background: #fafafa;
    color: #232830;
    font: normal 11px/14px 'Montserrat', Arial;
    text-transform: uppercase;
    margin: 0;
    padding: 6px 0 5px 15px;
    position: absolute;
    border-top: 1px solid rgba(0, 0, 0, 0.07);
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
    z-index: 10;
}

.list-view-group-header {
    bottom: auto;
    min-height: 1px;
    top: 0;
    width: 100%;
    border-top: 0;
}

.list-view-fake-header {
    width: 100%;
    z-index: 100;
    font-size: 11px !important;
    line-height: 14px !important;
}

.list-view-fake-header.list-view-hidden {
    visibility: hidden;
}

.list-view-group-container.list-view-animated .list-view-group-header {
    bottom: 0;
    top: auto;
}

input.list-view-search {
    font-size: 15px;
    color: #232830;
}

.no-top-border .list-view-fake-header {
    border-top: 0;
}

.list-view ul {
    list-style: none;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
}

.list-view li {
    padding-left: 15px;
    white-space: nowrap;
    cursor: pointer;
    width: 100%;
    display: table;
}

.list-view li:hover {
    background-color: #daeffd;
}

.list-view li.active {
    background-color: #fef6dd;
}

.list-view li p {
    margin: 0;
    line-height: 19px;
}

.list-view li>a {
    margin-right: 15px;
    display: table;
    width: 100%;
}

.list-view.boreded li>a {
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
}

.list-view.boreded li:last-child>a {
    border-bottom: 0;
}

.list-view.boreded li+li {
    border-top: 0;
}

[data-ios="true"] .list-view-group-header, [data-ios="true"] .list-view-fake-header {
    width: 288px;
    /*scrollbars aren't visible in iOS devices, so make the headers wider */
}

.list-group-item {
    border: 1px solid #f0f0f0;
}

.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {
    background-color: #40d9ca;
    border-color: #40d9ca;
}

.list-group-item:first-child {
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
}

.list-group-item:last-child {
    border-bottom-right-radius: 2px;
    border-bottom-left-radius: 2px;
}


/*------------------------------------------------------------------
[19. Social App]
*/

.social-wrapper, .social {
    height: 100%;
    width: 100%;
}


/* Cover 
------------------------------------
*/

.social-wrapper .social .jumbotron {
    height: 60vh;
}

.social-wrapper .social .cover-photo {
    position: relative;
    margin: 0 auto;
    overflow-x: hidden;
}

.social-wrapper .social .cover-photo:before {
    background-image: url("../img/linear_gradient.png");
    background-repeat: repeat-x;
    bottom: 0;
    content: " ";
    height: 270px;
    left: 0;
    position: absolute;
    right: 0;
    z-index: 1;
}

.social-wrapper .social .cover-photo .pull-bottom {
    z-index: 2;
}

.cover-img-container {
    position: absolute;
    overflow: hidden;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

.cover-img-container .cover-img {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    min-width: 100%;
    min-height: 100%;
}


/* Feed 
------------------------------------
*/

.social-user-profile {
    width: 52px;
}

.social-user-profile>.thumbnail-wrapper {
    float: none;
}

.social-wrapper .social .feed {
    overflow-y: hidden;
    width: 100%;
}

.social-wrapper .social .feed>.day {
    white-space: normal;
    display: block;
    width: 100%;
    margin: 0 auto;
}

.social-wrapper .social .feed>.day:after {
    feed: '';
    display: block;
    clear: both;
}

.social-wrapper .social .feed>.day:hover>.timeline:after {
    background: #48b0f7;
}


/* Cards 
------------------------------------
*/

.card {
    padding-bottom: 0;
    margin-bottom: 0;
    background: #FFF;
    float: left;
    position: relative;
    border-radius: 4px;
    border-bottom-right-radius: 2px;
    border-bottom-left-radius: 2px;
    margin-bottom: 20px;
    width: 300px;
    border: 1px solid #e6e6e6;
}

.card .circle {
    position: absolute;
    right: 20px;
    top: 20px;
    display: block;
    border-radius: 50%;
    border: 2px solid #f0f0f0;
    width: 9px;
    height: 9px;
    background: #626c75;
    z-index: 1;
}

.card .circle:hover {
    cursor: pointer;
}

.card.full-width {
    width: 100% !important;
}

.card.status {
    background: #daeffd;
    border-radius: 4px;
    padding: 15px 25px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border: 1px solid transparent;
}

.card.status:hover, .card.status.hover {
    border-color: #d8dadc !important;
}

.card.status h5 {
    font-size: 12px;
    margin: 0;
}

.card.status h5 .time {
    color: #fff;
}

.card.status h2 {
    color: #2c2c2c;
    font-size: 25px;
    margin: 0;
    font-weight: normal;
}

.card.status .reactions {
    color: #f0f0f0;
    opacity: .45;
    font-size: 12px;
    margin: 5px 0 0;
    padding: 0;
}

.card.status .reactions li {
    display: inline-block;
    list-style: none;
    padding: 0;
}

.card.status .circle {
    width: 9px;
    height: 9px;
    border: none;
    background: #48b0f7;
}

.card.share .card-header {
    padding: 15px 15px 12px;
    border-bottom: 1px solid #daeffd;
}

.card.share .card-header:hover {
    background: #daeffd;
    cursor: pointer;
    border-top-right-radius: 2px;
    border-top-left-radius: 2px;
}

.card.share .card-header:hover h6 {
    opacity: .6;
}

.card.share .card-header .user-pic {
    float: left;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
}

.card.share .card-header .user-pic>img {
    width: 30px;
    height: 30px;
}

.card.share .card-header h5 {
    font-weight: bold;
    font-size: 14px;
    margin: 0;
    line-height: 22.7px;
    font-family: arial;
    letter-spacing: -0.006em;
    margin-top: -3px;
}

.card.share .card-header h6 {
    font-size: 12px;
    margin: 0;
    font-family: arial;
    opacity: .45;
}

.card.share .card-description {
    padding: 12px 16px 11px;
    font-size: 14px;
    line-height: 21px;
    margin: 0;
}

.card.share .card-description p {
    margin-bottom: 4px;
}

.card.share .card-description .via {
    opacity: .45;
    display: block;
    font-size: 12px;
    font-family: arial;
}

.card.share .card-content {
    position: relative;
}

.card.share .card-content .buttons {
    left: 17px;
    padding: 0;
    position: absolute;
    top: 10px;
}

.card.share .card-content .buttons li {
    display: inline-block;
    list-style: none;
    margin-right: 10px;
}

.card.share .card-content .buttons li a {
    color: #fff;
}

.card.share .card-feed {
    overflow: hidden;
    position: relative;
    max-height: 400px;
}

.card.share .card-feed:hover .buttons {
    opacity: 1;
}

.card.share .card-feed .buttons {
    position: absolute;
    top: 5px;
    right: 0;
    opacity: 0;
}

.card.share .card-feed .buttons li {
    display: inline-block;
    list-style: none;
}

.card.share .card-feed .buttons li a {
    color: #fff;
    opacity: 0.8;
    padding: 5px;
}

.card.share .card-feed>* {
    max-width: 100%;
}

.card.share .card-footer {
    padding: 14px 16px 11px;
    font-size: 12px !important;
}

.card.share .card-footer:hover {
    background: #daeffd;
    cursor: pointer;
}

.card.share .card-footer:hover .reactions, .card.share .card-footer:hover .time {
    opacity: .8;
}

.card.share .card-footer .time {
    float: left;
    opacity: .45;
    font-family: arial;
    margin-top: 1px;
}

.card.share .card-footer .reactions {
    float: right;
    margin: 0;
    padding: 0;
    opacity: .45;
}

.card.share .card-footer .reactions li {
    display: inline-block;
    list-style: none;
}

.card.share .card-footer .reactions li a {
    color: inherit;
}

.card.share .card-description, .card.share .card-feed, .card.share .card-footer {
    border-color: transparent;
    border-style: solid;
}

.card.share .card-description {
    border-width: 1px;
}

.card.share .card-feed {
    border-width: 0 1px;
    margin-top: -2px;
}

.card.share .card-footer {
    border-width: 0 1px 1px 1px;
}

.card.share.share-other .card-description {
    padding-bottom: 0;
}

.card.share.share-other .card-footer {
    padding-top: 0;
    border-radius: 0;
}

.card.share.share-other .card-footer:hover {
    background: #fff;
}

.card.share.share-other .card-header {
    border-top: 1px solid #daeffd;
}

.card.share.share-other .circle {
    background: #f8d053;
}

.card.col1 {
    width: 300px;
}

.card.col2 {
    width: 620px;
}

.card.col3 {
    width: 920px;
}

.card img {
    width: 100%;
}


/* Step Form : Status */

.simform {
    margin-left: 0;
    padding: 0;
    position: static;
    margin-bottom: 20px;
}

.simform .error-message {
    padding-top: 29px !important;
    padding-left: 22px;
}

.simform .final-message, .simform .error-message {
    font-size: 15px;
    opacity: 0.5;
    display: none;
    margin-top: 19px;
    position: static;
    text-align: left;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
}

.simform ol:before {
    background: transparent;
}

.simform .questions li {
    overflow: hidden;
}

.simform .questions li.current {
    position: relative;
}

.simform .questions li.current input {
    font-size: 14px;
    padding: 0 !important;
    margin: 0 !important;
}

.simform .questions li>span {
    width: 100%;
}

.simform .questions li>span label {
    font-size: 12px;
    opacity: .55;
    font-weight: 300;
    -webkit-transition: opacity 0.2s ease;
    transition: opacity 0.2s ease;
}

.simform .questions input {
    background: transparent !important;
    height: 30px;
}

.simform .questions .current input, .simform .no-js .questions input {
    background: transparent;
    border: none;
}

.simform .controls {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
}

.simform .controls .next, .simform .controls .number {
    display: none !important;
}


/* Responsive Handlers: Social App
------------------------------------
*/

@media (min-width: 991px) and (max-width: 1070px) {
    .day .card:first-child .col-md-4:first-child {
        width: 100%;
        margin-bottom: 20px;
    }
    .day .card:first-child .col-md-4:nth-child(2), .day .card:first-child .col-md-4:nth-child(3) {
        width: 50%;
    }
}

@media (max-width: 667px) {
    .social-wrapper .social .feed>.day>.card {
        width: 100% !important;
    }
}


/*------------------------------------------------------------------
[20. Email App]
*/


/* Email Components 
--------------------------------------------------
*/

.compose-wrapper {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 50px;
    background: #ffffff;
    border-top: 1px solid #f0f0f0;
    z-index: 101;
}

.compose-wrapper .compose-email {
    font-size: 24px;
}

.email-composer {
    margin-left: 250px;
    position: relative;
    overflow: auto;
    height: 100%;
    background: #fff;
}

.email-composer .email-toolbar-wrapper .wysihtml5-toolbar {
    background: #f0f0f0;
    border-bottom: 1px solid #e6e6e6;
    position: relative;
    border-top: none;
}

.email-composer .email-body-wrapper {
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 20px;
}

.email-composer .bootstrap-tagsinput {
    margin: 0;
    padding: 0;
}

.email-composer>.row {
    margin-left: -30px;
    margin-right: -30px;
}

.split-view .split-details .email-content-wrapper {
    background: #fff;
    height: 100%;
    width: auto;
    overflow: auto;
}

.split-view .split-details .email-content-wrapper .actions-wrapper {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 50px;
    z-index: 799;
}

.split-view .split-details .email-content-wrapper .email-content {
    margin: 0 auto;
    width: 600px;
    display: block;
    padding-top: 62px;
    padding-bottom: 70px;
    padding-left: 20px;
    padding-right: 20px;
}

.split-view .split-details .email-content-wrapper .email-content .email-content-header .sender .name {
    font-size: 15px;
    color: #3b4752;
}

.split-view .split-details .email-content-wrapper .email-content .email-content-header .sender .datetime {
    color: #626262;
    opacity: .45;
    font-family: arial;
}

.split-view .split-details .email-content-wrapper .email-content .email-content-header .subject {
    font-family: arial;
    color: #3b4752;
    font-size: 15.2px;
    line-height: 17px;
}

.split-view .split-details .email-content-wrapper .email-content .email-content-header .fromto .btn-xs {
    border-radius: 13px;
}

.split-view .split-details .email-content-wrapper .email-content .email-content-body p {
    line-height: 23px;
    color: #626262;
    letter-spacing: 0.001em;
}

.split-view .split-details .email-content-wrapper .email-content .email-reply {
    min-height: 200px;
}

.split-view .split-details .email-content-wrapper .email-content .editor-wrapper {
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.split-view .split-details .email-content-wrapper .email-content .editor-wrapper .wysihtml5-sandbox {
    max-height: 150px;
    min-height: 130px !important;
    width: 100% !important;
}


/* Email App Top Header 
--------------------------------------------------
*/

.header-wrapper-email {
    font-size: 14.92px;
}

.header-wrapper-email .dropdown>.btn {
    color: #48b0f7;
}

.header-wrapper-email .btn:hover {
    text-decoration: none;
}


/* Responsive Handler : Email App 
--------------------------------------------------
*/

@media (max-width: 1024px) {
    .email-composer {
        margin-left: 0;
    }
}


/*------------------------------------------------------------------
[21. Calendar App]
*/

body.overflow-hidden {
    overflow: hidden;
}


/*
Calendar
--------------------------------------------------
Header / .calendar-header
Years / .years .year
Months / .months
Weeks / .weeks-wrapper .week
Grid / .calendar-container
Events / .event-container
*/

.calendar {
    height: 100%;
}

.calendar .drager {
    overflow: hidden;
}

.calendar .drager .scroll-element {
    display: none;
}

.calendar.month {
    padding-left: 5px;
}

.calendar.month .options .date {
    margin-bottom: 22px;
}

.calendar.month .week-dragger {
    display: none;
}

.calendar.month .calendar-container {
    border-top: 1px solid #e6e6e6;
    padding-top: 0;
    height: calc(100% - 169px);
}

.calendar.month .calendar-container .view .tble {
    width: 100%;
}

.calendar.month .calendar-container .view .tble .thead .tcell .weekday {
    margin-left: 10px;
}

.calendar .calendar-header {
    height: 43px;
    background-color: #fafafa;
    line-height: 43px;
    padding-left: 60px;
}

.calendar .calendar-header>.drager {
    width: calc(100% - 141px);
    border-right: 1px solid rgba(0, 0, 0, 0.33);
    line-height: 35px;
}

.calendar .calendar-header .years {
    width: auto;
    list-style: none;
    white-space: nowrap;
    margin-top: 5px;
}

.calendar .calendar-header .years .year {
    display: inline-block;
    width: 69px;
    text-align: center;
    white-space: nowrap;
    font-family: "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.calendar .calendar-header .years .year>a {
    color: rgba(0, 0, 0, 0.5);
    position: relative;
}

.calendar .calendar-header .years .year>a.active {
    color: #000;
}

.calendar .calendar-header .years .year>a.has-event:before {
    position: absolute;
    content: '\25CF';
    width: 100%;
    font-size: 8px;
    line-height: 6px;
    text-align: center;
    color: rgba(0, 0, 0, 0.44);
}

.calendar .options {
    padding-left: 60px;
    margin-top: 15px;
}

.calendar .options .months {
    width: auto;
    white-space: nowrap;
    height: 43px;
    line-height: 43px;
}

.calendar .options .months .month {
    min-width: 30px;
    max-width: 100px;
    padding: 0 10px;
    display: inline-block;
}

.calendar .options .months .month>a {
    position: relative;
    color: rgba(0, 0, 0, 0.28);
}

.calendar .options .months .month>a:hover {
    color: rgba(0, 0, 0, 0.33);
}

.calendar .options .months .month>a.active {
    color: #000000;
}

.calendar .options .months .month>a.has-event:before {
    position: absolute;
    content: '\25CF';
    top: -6px;
    width: 100%;
    font-size: 8px;
    line-height: 6px;
    text-align: center;
    color: rgba(0, 0, 0, 0.33);
}

.calendar .options .date {
    margin-bottom: 20px;
}

.calendar .week-dragger {
    border-bottom: 1px solid #e6e6e6;
    margin-left: -20px;
}

.calendar .weeks-wrapper {
    width: auto;
    white-space: nowrap;
    padding-left: 10px;
    padding-bottom: 12px;
    margin-bottom: 5px;
    margin-left: 20px;
}

.calendar .weeks-wrapper .week {
    display: inline-block;
    position: relative;
    padding-left: 30px;
    padding-right: 30px;
}

.calendar .weeks-wrapper .week:first-child {
    padding-left: 4px;
}

.calendar .weeks-wrapper .week:last-child {
    padding-left: 0px;
}

.calendar .weeks-wrapper .week:before {
    content: '';
    position: absolute;
    right: -20px;
    bottom: 6px;
    height: 20px;
    width: 20px;
    border-left: 1px dotted rgba(0, 0, 0, 0.3);
}

.calendar .weeks-wrapper .week.active .day-wrapper .week-date .day>a {
    color: rgba(0, 0, 0, 0.6);
}

.calendar .weeks-wrapper .week .day-wrapper {
    display: inline-block;
}

.calendar .weeks-wrapper .week .day-wrapper .week-date {
    text-align: center;
    width: 21px;
    height: 21px;
    margin: 6px;
    border-radius: 99px;
    -webkit-border-radius: 99px;
    -moz-border-radius: 99px;
}

.calendar .weeks-wrapper .week .day-wrapper .week-date.current-date {
    background-color: #e6e6e6;
}

.calendar .weeks-wrapper .week .day-wrapper .week-date.active {
    background-color: #10cfbd;
}

.calendar .weeks-wrapper .week .day-wrapper .week-date.active .day>a {
    font-weight: bold;
    opacity: 1;
    color: #fff;
}

.calendar .weeks-wrapper .week .day-wrapper .week-date .day>a {
    letter-spacing: -0.01em;
}

.calendar .weeks-wrapper .week .day-wrapper .week-day {
    text-align: center;
}

.calendar .weeks-wrapper .week .day-wrapper .day {
    display: inline-block;
    text-align: center;
    position: relative;
    z-index: 10;
    padding: 1px 0;
    font-size: 12px;
    color: rgba(0, 0, 0, 0.3);
}

.calendar .weeks-wrapper .week .day-wrapper .day>a {
    position: relative;
    width: 100%;
    display: block;
    text-align: center;
    color: rgba(0, 0, 0, 0.3);
    opacity: 0.7;
    font-weight: 600;
}

.calendar .weeks-wrapper .week .day-wrapper .day>a.has-event:before {
    position: absolute;
    content: '\25CF';
    top: -10px;
    width: 100%;
    font-size: 8px;
    line-height: 6px;
    text-align: center;
    color: #10cfbd;
}

.calendar .weeks-wrapper .week .day-wrapper .day.week-header {
    text-transform: uppercase;
    text-align: center;
    font-family: 'Montserrat';
    font-size: 10px;
}

.calendar .calendar-container {
    position: relative;
    height: calc(100% - 200px);
    padding-top: 10px;
}

.calendar .calendar-container .view {
    width: 100%;
    height: 100%;
    white-space: nowrap;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell {
    position: relative;
    height: 20%;
    clear: both;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .cell-inner .holder {
    position: absolute;
    top: 37px;
    left: 0;
    right: 0;
    bottom: 0;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell.active {
    background: #fff;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell.active .cell-inner {
    background-color: #fef8e7;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell.not {
    background-color: #fafafa;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell.drop-target .cell-inner {
    background-color: #fafafa;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .cell-inner:only-child, .calendar .calendar-container .view.month-view .tble .trow .tcell .cell-inner {
    height: 100%;
    border-bottom: 1px solid #e6e6e6;
    position: relative;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .month-date {
    position: relative;
    text-align: center;
    margin-top: 10px;
    margin-right: 6px;
    width: 25px;
    height: 25px;
    padding-top: 2px;
    margin: 6px;
    float: right;
    display: block;
    z-index: 1;
    border-radius: 99px;
    -webkit-border-radius: 99px;
    -moz-border-radius: 99px;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .month-date.current-date {
    background-color: #e6e6e6;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .month-date.active {
    background-color: #10cfbd;
    font-weight: bold;
    opacity: 1;
    color: #fff;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .event-container {
    height: 30px;
    position: relative !important;
    min-height: 30px !important;
}

.calendar .calendar-container .view.month-view .tble .trow .tcell .event-container .event-inner {
    padding: 8px;
}

.calendar .calendar-container .view.month-view .ghost-element {
    height: 30px;
    position: relative;
    width: 100%;
}

.calendar .calendar-container .view.month-view .grid .tble {
    height: 100%;
    width: 100%;
}

.calendar .calendar-container .view.month-view .event-container .event-title {
    font-size: 12px;
}

.calendar .calendar-container .view.day-view .tble {
    white-space: nowrap;
}

.calendar .calendar-container .view.day-view .tble .thead {
    white-space: nowrap;
    overflow: hidden;
    display: inline-block;
}

.calendar .calendar-container .view.day-view .tble .tcell {
    display: none;
    max-width: 100%;
    width: 100%;
}

.calendar .calendar-container .view.day-view .tble .tcell.active {
    display: inline-block;
}

.calendar .calendar-container .view.day-view .tble .trow {
    display: block;
    height: 80px;
}

.calendar .calendar-container .view.day-view .tble .trow .tcell.active {
    background-color: #fff;
}

.calendar .calendar-container .view .tble {
    display: inline-table;
    width: calc(100% - 50px);
    vertical-align: top;
    position: relative;
}

.calendar .calendar-container .view .tble .thead {
    display: table-row;
    width: 100%;
    background: #fff;
}

.calendar .calendar-container .view .tble .thead .tcell {
    padding: 10px;
    height: 40px;
    position: relative;
}

.calendar .calendar-container .view .tble .thead .tcell .weekday {
    font-size: 12px;
    display: inline-block;
    color: rgba(0, 0, 0, 0.51);
}

.calendar .calendar-container .view .tble .thead .tcell .weekdate {
    font-size: 14px;
    display: inline-block;
    margin-right: 10px;
    color: rgba(0, 0, 0, 0.77);
}

.calendar .calendar-container .view .tble .thead .tcell.active .weekdate, .calendar .calendar-container .view .tble .thead .tcell.active .weekday {
    color: #000000;
}

.calendar .calendar-container .view .tble .thead .tcell:before {
    content: '';
    border-bottom: 1px solid #e6e6e6;
    width: calc(100% - 18px);
    position: absolute;
    bottom: 0;
}

.calendar .calendar-container .view .tble .thead .tcell .event-bubble {
    display: inline-block;
    width: 8px;
    height: 8px;
    margin-left: 5px;
    float: right;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
}

.calendar .calendar-container .view .tble .tcell {
    display: table-cell;
    height: 80px;
    max-width: 14.2857%;
    width: 14.2857%;
}

.calendar .calendar-container .view .tble .trow {
    display: table-row;
}

.calendar .calendar-container .view .tble .trow .tcell {
    background: #fff;
    padding: 0 10px;
}

.calendar .calendar-container .view .tble .trow .tcell .cell-inner {
    height: 40px;
    position: relative;
}

.calendar .calendar-container .view .tble .trow .tcell .cell-inner:first-child {
    border-bottom: 1px dotted #e6e6e6;
}

.calendar .calendar-container .view .tble .trow .tcell .cell-inner:last-child {
    border-bottom: 1px solid #e6e6e6;
}

.calendar .calendar-container .view .tble .trow .tcell .cell-inner:only-child {
    height: 40px;
    border-bottom: 0;
}

.calendar .calendar-container .view .tble .trow .tcell.active {
    background-color: #fef8e7;
}

.calendar .calendar-container .view .tble .trow .tcell.active>* {
    border-color: rgba(0, 0, 0, 0.1) !important;
}

.calendar .calendar-container .view .tble .trow .tcell.disable {
    background-color: #fafafa;
}

.calendar .calendar-container .view .tble .loading {
    left: 10px;
}

.calendar .calendar-container .loading {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(255, 255, 255, 0.5);
    z-index: 100;
}

.calendar .calendar-container .pgn-wrapper {
    position: absolute;
}

.calendar .calendar-container .even-holder {
    position: absolute;
    display: table;
    width: calc(100% - 50px);
    width: 100% \0;
    height: calc(100% - 25px);
}

.calendar .calendar-container .even-holder .event-placeholder {
    height: 100%;
    width: 14.2857%;
    display: table-cell;
}

.calendar .calendar-container .event-container {
    width: 100%;
    height: 40px;
    position: absolute !important;
    z-index: 10;
    overflow: hidden;
    margin-bottom: 5px;
    min-height: 40px !important;
    -webkit-transition: width 0.16s ease;
    transition: width 0.16s ease;
}

.calendar .calendar-container .event-container .event-inner {
    padding: 15px;
}

.calendar .calendar-container .event-container .event-inner:before {
    position: absolute;
    width: 8px;
    height: 8px;
    content: '';
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 999px;
    right: 14px;
    top: 11px;
}

.calendar .calendar-container .event-container .time-wrap {
    line-height: 12px;
    text-align: left;
    color: rgba(0, 0, 0, 0.77);
    overflow: hidden;
    text-overflow: ellipsis;
}

.calendar .calendar-container .event-container .event-start-time, .calendar .calendar-container .event-container .event-end-time {
    font-size: 12px;
    color: rgba(0, 0, 0, 0.44);
}

.calendar .calendar-container .event-container .event-title {
    font-size: 14px;
    line-height: 15px;
    margin-bottom: 8px;
    overflow: hidden;
    text-overflow: ellipsis;
}

.calendar .calendar-container .event-container .resizable-handle {
    position: absolute;
    opacity: 1;
    z-index: 3;
    left: 0;
    right: 0;
    bottom: 0;
    height: 8px;
    overflow: hidden;
    line-height: 8px;
    font-size: 11px;
    font-family: monospace;
    text-align: center;
    cursor: s-resize;
}

.calendar .calendar-container .event-container .resizable-handle:after {
    content: "=";
    color: rgba(0, 0, 0, 0.44);
}

.calendar .calendar-container .event-container.dragging {
    z-index: 100;
}

.calendar .calendar-container .grid {
    display: block;
    overflow: scroll;
    height: calc(100% - 40px);
    -webkit-overflow-scrolling: touch;
}

.calendar .calendar-container .grid.slot-60 .tble .trow .tcell .cell-inner {
    height: 80px;
    border-bottom: 1px solid #e6e6e6;
}

.calendar .calendar-container .grid.slot-15 .tble .trow .tcell {
    height: 25px;
}

.calendar .calendar-container .grid.slot-15 .tble .trow .tcell .cell-inner {
    height: 25px;
    border-bottom: 1px dotted #e6e6e6;
}

.calendar .calendar-container .grid.slot-15 .tble .trow .tcell .cell-inner:last-child {
    border-bottom: 1px solid #e6e6e6;
}

.calendar .calendar-container .grid.slot-15 .time-slot-wrapper .time-slot {
    height: 100px;
}

.calendar .calendar-container .allday-cell {
    height: 40px;
    display: inline-block;
    width: 50px;
    float: left;
}

.calendar .time-slot-wrapper {
    display: inline-block;
    width: 50px;
    float: left;
    height: 100%;
}

.calendar .time-slot-wrapper .time-slot {
    display: block;
    height: 80px;
    width: 100%;
    background: #fff;
}

.calendar .time-slot-wrapper .time-slot:first-child span {
    display: none;
}

.calendar .time-slot-wrapper .time-slot>span {
    float: right;
    position: relative;
    top: -15%;
    color: rgba(0, 0, 0, 0.46);
    font-weight: bold;
    font-size: 12px;
    right: 5px;
}

.calendar-event {
    width: 330px;
    right: -330px;
}

.calendar-event .scrollable {
    height: 100%;
}

.date-selector {
    cursor: pointer;
}


/*
Responsive Util
*/

@media (max-width: 991px) {
    .calendar {
        background-color: #fff;
    }
    .calendar .calendar-header {
        display: none;
    }
    .calendar .options {
        margin-top: 0;
        padding-left: 10px;
    }
    .calendar .options .months {
        line-height: 21px;
        padding-top: 14px;
    }
    .calendar .options .date {
        margin-bottom: 10px;
    }
    .calendar .calendar-container {
        height: 100%;
    }
    .calendar .calendar-container .view.week-view .tble {
        white-space: nowrap;
    }
    .calendar .calendar-container .view.week-view .tble .thead {
        white-space: nowrap;
        overflow: hidden;
        display: inline-block;
    }
    .calendar .calendar-container .view.week-view .tble .tcell {
        display: none;
        max-width: 100%;
        width: 100%;
    }
    .calendar .calendar-container .view.week-view .tble .tcell.active {
        display: inline-block;
        background-color: #fff;
    }
    .calendar .calendar-container .view.week-view .tble .trow {
        display: block;
        height: 80px;
    }
    .calendar .calendar-container .view.month-view .allday-cell {
        display: none;
    }
    .calendar .calendar-container .view.month-view .grid .tble {
        padding-left: 0;
    }
    .calendar .calendar-container .view.month-view .tble .thead .tcell {
        padding: 3px;
        padding-top: 10px;
    }
    .calendar .calendar-container .view.month-view .tble .trow .tcell {
        padding: 0 6px;
    }
    .calendar .calendar-container .view.month-view .tble .trow .tcell .event-container {
        border-radius: 99px;
        -webkit-border-radius: 99px;
        -moz-border-radius: 99px;
        position: absolute !important;
        height: 16px !important;
        width: 16px !important;
        min-height: 16px !important;
        margin: 0 auto;
        left: 0;
        right: 0;
    }
    .calendar .calendar-container .view.month-view .tble .trow .tcell .event-container .event-inner {
        display: none;
    }
    .calendar .calendar-container.month {
        height: calc(100% - 101px);
    }
    .calendar .weeks-wrapper {
        margin-bottom: 0;
    }
    .calendar.month {
        padding-left: 0;
    }
    .calendar.month .calendar-container {
        height: calc(100% - 108px);
    }
    .calendar-event {
        width: 240px;
        right: -240px;
    }
    .months-drager {
        margin-left: 27px;
        width: calc(100% - 80px);
        border-right: 1px solid #e6e6e6;
        padding-top: 0;
    }
}

@media (max-width: 640px) {
    .calendar.month .calendar-container .view .tble .thead .tcell {
        text-align: center;
    }
    .calendar.month .calendar-container .view .tble .thead .tcell:before {
        width: 100%;
    }
    .calendar.month .calendar-container .view .tble .thead .tcell .weekday {
        width: 11px;
        overflow: hidden;
        letter-spacing: 4px;
        font-weight: bold;
    }
}


/*------------------------------------------------------------------
[22. Login]
*/

.login-wrapper {
    height: 100%;
    background-color: #6d5cae;
}

.login-wrapper>* {
    height: 100%;
}

.login-wrapper .bg-pic {
    position: absolute;
    width: 100%;
    overflow: hidden;
}

.login-wrapper .bg-pic>img {
    height: 100%;
    opacity: 0.6;
}

.login-wrapper .login-container {
    width: 496px;
    display: block;
    position: relative;
    float: right;
}

.login-wrapper .bg-caption {
    width: 500px;
}

.register-container {
    width: 550px;
    margin: auto;
    height: 100%;
}


/* Responsive handlers : Login
------------------------------------
*/

@media (max-width: 768px) {
    .login-wrapper .login-container {
        width: 100%;
    }
    .register-container {
        width: 100%;
        padding: 15px;
    }
}

@media only screen and (max-width: 321px) {
    .login-wrapper .login-container {
        width: 100%;
    }
}


/*------------------------------------------------------------------
[23. Lock Screen]
*/

.lock-container {
    margin-left: auto;
    margin-right: auto;
    width: 600px;
}

.lock-screen-wrapper .credentials {
    margin-top: -84px;
    position: absolute;
    top: 50%;
}

.lock-screen-wrapper .credentials .thumbnail-wrapper {
    width: 53px;
    height: 53px;
}

.lock-screen-wrapper .credentials .logged {
    opacity: .21;
    margin-top: -5px !important;
}

.lock-screen-wrapper .credentials .name {
    opacity: .69;
    margin-top: -5px !important;
    font-size: 36px;
    height: 45px;
    overflow: hidden;
}

.lock-screen-wrapper .terms-wrapper>div {
    display: table;
}

.lock-screen-wrapper .terms-wrapper .terms {
    display: table-cell;
    vertical-align: middle;
}

.lock-screen-wrapper .terms-wrapper .logo-terms {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    text-align: center;
    position: relative;
}

.lock-screen-wrapper .terms-wrapper .logo-terms .brand {
    left: 50%;
    margin-left: -21px;
    margin-top: -5px;
    position: absolute;
    top: 50%;
}


/* Responsive Handlers : Lockscreen 
------------------------------------
*/

@media (max-width: 767px) {
    .lock-container {
        width: 80%;
    }
    .lock-screen-wrapper .credentials form {
        margin-top: 15px;
    }
}

@media (max-width: 480px) {
    .lock-screen-wrapper .credentials {
        margin: 0;
        position: static;
        margin-top: 100px;
        width: 100%;
        float: left;
        clear: both;
    }
    .lock-screen-wrapper .credentials>div {
        text-align: center;
    }
    .lock-screen-wrapper .credentials .thumbnail-wrapper {
        float: none;
        margin: 0 auto;
    }
}


/*------------------------------------------------------------------
[24. Timeline]
*/


/*
  Adapted from Vertical Timeline by Sebastiano Guerriero
  http://codyhouse.co/gem/vertical-timeline/
*/


/* -------------------------------- 

Modules - reusable parts of our design

-------------------------------- */

.timeline-container {
    /* this class is used to give a max-width to the element it is applied to, and center it horizontally when it reaches that max-width */
    width: 90%;
    max-width: 1170px;
    margin: 0 auto;
}

.timeline-container::after {
    /* clearfix */
    content: '';
    display: table;
    clear: both;
}

.timeline-container.top-circle:before {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 99px;
    -webkit-border-radius: 99px;
    -moz-border-radius: 99px;
    background-color: #fff;
    z-index: 10;
}


/* -------------------------------- 

Main components 

-------------------------------- */

.timeline {
    position: relative;
    padding: 3em 0 3em 0;
    margin-top: 0;
    margin-bottom: 2em;
}

.timeline::before {
    /* this is the vertical line */
    content: '';
    position: absolute;
    top: 0;
    left: 18px;
    height: 100%;
    width: 2px;
    background: #fff;
}

@media only screen and (min-width: 1170px) {
    .timeline-container:not(.left) .timeline {
        margin-bottom: 3em;
    }
    .timeline-container:not(.left) .timeline::before {
        left: 50%;
        margin-left: -2px;
    }
}

.timeline-block {
    position: relative;
    margin: 2em 0;
}

.timeline-block:after {
    content: "";
    display: table;
    clear: both;
}

.timeline-block:first-child {
    margin-top: 0;
}

.timeline-block:last-child {
    margin-bottom: 0;
}

@media only screen and (min-width: 1170px) {
    .timeline-container:not(.left) .timeline .timeline-block {
        margin: 4em 0;
    }
    .timeline-container:not(.left) .timeline .timeline-block:first-child {
        margin-top: 0;
    }
    .timeline-container:not(.left) .timeline .timeline-block:last-child {
        margin-bottom: 0;
    }
}

.timeline-point {
    position: absolute;
    top: 12px;
    left: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-align: center;
    background: #b3b3b3;
    border: 2px solid #fff;
}

.timeline-point.small {
    height: 12px;
    margin-left: 13px;
    margin-top: 14px;
    width: 12px;
}

.timeline-point i {
    color: #fff;
    font-size: 14px;
    left: 50%;
    margin-left: -7px;
    margin-top: -7px;
    position: absolute;
    top: 50%;
}

.timeline-point.primary {
    background-color: #6d5cae;
}

.timeline-point.complete {
    background-color: #48b0f7;
}

.timeline-point.success {
    background-color: #10cfbd;
}

.timeline-point.info {
    background-color: #3b4752;
}

.timeline-point.danger {
    background-color: #f55753;
}

.timeline-point.warning {
    background-color: #f8d053;
}

@media only screen and (min-width: 1170px) {
    .timeline-container:not(.left) .timeline .timeline-point {
        left: 50%;
        margin-left: -21px;
        /* Force Hardware Acceleration in WebKit */
        -webkit-transform: translateZ(0);
        -webkit-backface-visibility: hidden;
    }
    .timeline-container:not(.left) .timeline .timeline-point.is-hidden {
        visibility: hidden;
    }
    .timeline-container:not(.left) .timeline .timeline-point.small {
        margin-left: -7px;
    }
    .timeline-container:not(.left) .timeline .timeline-point.bounce-in {
        visibility: visible;
        -webkit-animation: cd-bounce-1 0.6s;
        -moz-animation: cd-bounce-1 0.6s;
        animation: cd-bounce-1 0.6s;
    }
}

@-webkit-keyframes cd-bounce-1 {
    0% {
        opacity: 0;
        -webkit-transform: scale(0.5);
    }
    60% {
        opacity: 1;
        -webkit-transform: scale(1.2);
    }
    100% {
        -webkit-transform: scale(1);
    }
}

@-moz-keyframes cd-bounce-1 {
    0% {
        opacity: 0;
        -moz-transform: scale(0.5);
    }
    60% {
        opacity: 1;
        -moz-transform: scale(1.2);
    }
    100% {
        -moz-transform: scale(1);
    }
}

@keyframes cd-bounce-1 {
    0% {
        opacity: 0;
        -webkit-transform: scale(0.5);
        -moz-transform: scale(0.5);
        -ms-transform: scale(0.5);
        -o-transform: scale(0.5);
        transform: scale(0.5);
    }
    60% {
        opacity: 1;
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -ms-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }
    100% {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }
}

.timeline-content {
    position: relative;
    margin-left: 60px;
}

.timeline-content:after {
    content: "";
    display: table;
    clear: both;
}

.timeline-content .card {
    margin-bottom: 0;
}

.timeline-content .event-date {
    display: inline-block;
    float: left;
    padding: .8em 0;
    opacity: .7;
    clear: both;
}

@media (max-width: 480px) {
    .timeline-container {
        width: 94%;
    }
}

@media only screen and (min-width: 1170px) {
    .timeline-container:not(.left) .timeline .timeline-content {
        margin-left: 0;
        width: 46%;
    }
    .timeline-container:not(.left) .timeline .timeline-content::before {
        top: 24px;
        left: 100%;
        border-color: transparent;
        border-left-color: white;
    }
    .timeline-container:not(.left) .timeline .timeline-content.is-hidden {
        visibility: hidden;
    }
    .timeline-container:not(.left) .timeline .timeline-content.bounce-in {
        visibility: visible;
        -webkit-animation: cd-bounce-2 0.6s;
        -moz-animation: cd-bounce-2 0.6s;
        animation: cd-bounce-2 0.6s;
    }
    .timeline-container:not(.left) .timeline .timeline-content .event-date {
        position: absolute;
        width: 100%;
        left: 118%;
        top: -2px;
        font-size: 16px;
        font-size: 1rem;
    }
    .timeline-container:not(.left) .timeline .timeline-content .event-date small {
        margin-top: 13px;
        display: block;
    }
    .timeline-container:not(.left) .timeline .timeline-content .event-date h6+small {
        margin-top: 0;
    }
    .timeline-container:not(.left) .timeline .timeline-block:nth-child(odd) .timeline-content .card {
        float: right;
    }
    .timeline-container:not(.left) .timeline .timeline-block:nth-child(even) .timeline-content {
        float: right;
    }
    .timeline-container:not(.left) .timeline .timeline-block:nth-child(even) .timeline-content::before {
        top: 24px;
        left: auto;
        right: 100%;
        border-color: transparent;
        border-right-color: white;
    }
    .timeline-container:not(.left) .timeline .timeline-block:nth-child(even) .timeline-content .event-date {
        left: auto;
        right: 118%;
        text-align: right;
    }
}

@media only screen and (min-width: 1170px) {
    /* inverse bounce effect on even content blocks */
    .timeline-container:not(.left) .timeline .timeline-block:nth-child(even) .timeline-content.bounce-in {
        -webkit-animation: cd-bounce-2-inverse 0.6s;
        -moz-animation: cd-bounce-2-inverse 0.6s;
        animation: cd-bounce-2-inverse 0.6s;
    }
}

@-webkit-keyframes cd-bounce-2 {
    0% {
        opacity: 0;
        -webkit-transform: translateX(-100px);
    }
    60% {
        opacity: 1;
        -webkit-transform: translateX(20px);
    }
    100% {
        -webkit-transform: translateX(0);
    }
}

@-moz-keyframes cd-bounce-2 {
    0% {
        opacity: 0;
        -moz-transform: translateX(-100px);
    }
    60% {
        opacity: 1;
        -moz-transform: translateX(20px);
    }
    100% {
        -moz-transform: translateX(0);
    }
}

@keyframes cd-bounce-2 {
    0% {
        opacity: 0;
        -webkit-transform: translateX(-100px);
        -moz-transform: translateX(-100px);
        -ms-transform: translateX(-100px);
        -o-transform: translateX(-100px);
        transform: translateX(-100px);
    }
    60% {
        opacity: 1;
        -webkit-transform: translateX(20px);
        -moz-transform: translateX(20px);
        -ms-transform: translateX(20px);
        -o-transform: translateX(20px);
        transform: translateX(20px);
    }
    100% {
        -webkit-transform: translateX(0);
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -o-transform: translateX(0);
        transform: translateX(0);
    }
}

@-webkit-keyframes cd-bounce-2-inverse {
    0% {
        opacity: 0;
        -webkit-transform: translateX(100px);
    }
    60% {
        opacity: 1;
        -webkit-transform: translateX(-20px);
    }
    100% {
        -webkit-transform: translateX(0);
    }
}

@-moz-keyframes cd-bounce-2-inverse {
    0% {
        opacity: 0;
        -moz-transform: translateX(100px);
    }
    60% {
        opacity: 1;
        -moz-transform: translateX(-20px);
    }
    100% {
        -moz-transform: translateX(0);
    }
}

@keyframes cd-bounce-2-inverse {
    0% {
        opacity: 0;
        -webkit-transform: translateX(100px);
        -moz-transform: translateX(100px);
        -ms-transform: translateX(100px);
        -o-transform: translateX(100px);
        transform: translateX(100px);
    }
    60% {
        opacity: 1;
        -webkit-transform: translateX(-20px);
        -moz-transform: translateX(-20px);
        -ms-transform: translateX(-20px);
        -o-transform: translateX(-20px);
        transform: translateX(-20px);
    }
    100% {
        -webkit-transform: translateX(0);
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -o-transform: translateX(0);
        transform: translateX(0);
    }
}

.timeline-container.center .timeline {
    margin-top: 3em;
    margin-bottom: 3em;
}

.timeline-container.center .timeline::before {
    left: 50%;
    margin-left: -2px;
}

.timeline-container.center .timeline .timeline-point {
    left: 50%;
    margin-left: -21px;
    /* Force Hardware Acceleration in WebKit */
    -webkit-transform: translateZ(0);
    -webkit-backface-visibility: hidden;
}

.timeline-container.center .timeline .timeline-point.is-hidden {
    visibility: hidden;
}

.timeline-container.center .timeline .timeline-point.small {
    margin-left: -7px;
}

.timeline-container.center .timeline .timeline-point.bounce-in {
    visibility: visible;
    -webkit-animation: cd-bounce-1 0.6s;
    -moz-animation: cd-bounce-1 0.6s;
    animation: cd-bounce-1 0.6s;
}

.timeline-container.center .timeline .timeline-content {
    margin-left: 0;
    width: 46%;
}

.timeline-container.center .timeline .timeline-content::before {
    top: 24px;
    left: 100%;
    border-color: transparent;
    border-left-color: white;
}

.timeline-container.center .timeline .timeline-content.is-hidden {
    visibility: hidden;
}

.timeline-container.center .timeline .timeline-content.bounce-in {
    visibility: visible;
    -webkit-animation: cd-bounce-2 0.6s;
    -moz-animation: cd-bounce-2 0.6s;
    animation: cd-bounce-2 0.6s;
}

.timeline-container.center .timeline .timeline-content .event-date {
    position: absolute;
    width: 100%;
    left: 118%;
    top: -2px;
    font-size: 16px;
    font-size: 1rem;
}

.timeline-container.center .timeline .timeline-content .event-date small {
    margin-top: 13px;
    display: block;
}

.timeline-container.center .timeline .timeline-content .event-date h6+small {
    margin-top: 0;
}

.timeline-container.center .timeline .timeline-block:nth-child(odd) .timeline-content .card {
    float: right;
}

.timeline-container.center .timeline .timeline-block:nth-child(even) .timeline-content {
    float: right;
}

.timeline-container.center .timeline .timeline-block:nth-child(even) .timeline-content::before {
    top: 24px;
    left: auto;
    right: 100%;
    border-color: transparent;
    border-right-color: white;
}

.timeline-container.center .timeline .timeline-block:nth-child(even) .timeline-content .event-date {
    left: auto;
    right: 118%;
    text-align: right;
}

@media only screen and (min-width: 1170px) {
    .timeline-container.left {
        width: 60%;
        margin-left: 100px;
    }
}


/*------------------------------------------------------------------
[25. Gallery]
*/

.gallery {
    margin: 70px auto 0 auto;
}

.gallery-item {
    overflow: hidden;
    cursor: default;
    background-color: #000;
    margin-bottom: 10px;
    position: relative;
    width: 280px;
    height: 240px;
}

.gallery-item:hover {
    cursor: pointer;
}

.gallery-item[data-width="1"] {
    width: 280px;
}

.gallery-item[data-width="2"] {
    width: 570px;
}

.gallery-item[data-height="1"] {
    height: 240px;
}

.gallery-item[data-height="2"] {
    height: 490px;
}

.gallery-item>img {
    opacity: 1;
    -webkit-transition: opacity 0.35s;
    transition: opacity 0.35s;
}

.gallery-item>.live-tile img {
    opacity: 1;
    -webkit-transition: opacity 0.35s;
    transition: opacity 0.35s;
}

.gallery-item .rating {
    margin-top: -5px;
    color: rgba(255, 255, 255, 0.3);
}

.gallery-item .rating>.rated {
    color: #ffffff;
}

.gallery-item .item-info {
    -webkit-transform: translate3d(0, 40%, 0);
    transform: translate3d(0, 40%, 0);
    -webkit-transition: -webkit-transform 0.35s, color 0.35s;
    transition: transform 0.35s, color 0.35s;
}

.gallery-item .item-info.more-content {
    -webkit-transform: translate3d(0, 32%, 0);
    transform: translate3d(0, 32%, 0);
}

.gallery-item:hover .item-info {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}

.gallery-item:hover>img {
    opacity: 0.6;
}

.gallery-item:hover>.live-tile img {
    opacity: 0.6;
}

.gallery-item:active .item-info {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}

.gallery-item:active>img {
    opacity: 0.6;
}

.item-details {
    z-index: 1050;
}

.item-details .dialog__content {
    width: 845px;
    max-width: 845px;
    padding: 0;
    text-align: left;
    border: 1px solid rgba(0, 0, 0, 0.8);
}

.item-details .dialog__content .dialog__overview {
    height: 516px;
    position: relative;
}

.item-details .dialog__content .dialog__overview .buy-now {
    position: absolute;
    bottom: 20px;
    right: 35px;
}

.item-details .dialog__content .dialog__overview .item-slideshow .slide {
    width: 516px;
    height: 516px;
    display: block;
    overflow: hidden;
}

.item-details .dialog__content .dialog__footer {
    height: 75px;
}

.item-details .dialog__content .dialog__footer .price {
    margin: 0;
    padding: 0;
    line-height: 75px;
}

.item-details .dialog__content .dialog__footer .separator {
    position: relative;
}

.item-details .dialog__content .dialog__footer .separator:after {
    content: "";
    width: 1px;
    background: rgba(255, 255, 255, 0.1);
    position: absolute;
    height: 27px;
    right: 0;
    top: 24px;
}

.item-details .dialog__content .dialog__footer .recommended li {
    overflow: hidden;
}

.item-details .dialog__content .dialog__footer .recommended li a {
    width: 56px;
    height: 56px;
    display: block;
}

.item-details .dialog__content .dialog__footer .recommended li img {
    width: 100%;
}

.item-details .dialog__content .close {
    top: 15px;
    right: 15px;
    z-index: 100;
}

.item-details .owl-nav {
    left: 0;
    position: absolute;
    top: 50%;
    width: 100%;
    color: #fff;
    opacity: .7;
    font-size: 18px;
    padding: 0 20px;
}

.item-details .owl-nav .owl-prev {
    float: left;
}

.item-details .owl-nav .owl-next {
    float: right;
}

.item-details .owl-dots {
    bottom: 23px;
    position: absolute;
    right: 23px;
}

.item-details .owl-dots .owl-dot {
    width: 10px;
    height: 10px;
    border-radius: 10px;
    display: inline-block;
    background: rgba(0, 0, 0, 0.3);
    margin-left: 6px;
}

.item-details .owl-dots .owl-dot.active {
    background: #fff;
}

.owl-carousel .owl-stage-outer {
    direction: ltr;
}

.gallery-filters {
    position: absolute;
    left: 0;
    right: 0;
    height: 70px;
    top: -70px;
}

@media (max-width: 920px) {
    .gallery-item.first {
        display: none;
    }
}

@media (max-width: 767px) {
    .item-details .dialog__content {
        height: 90%;
        overflow-y: auto;
        width: 400px;
        max-width: 400px;
    }
    .item-details .dialog__content .container-fluid {
        height: 100%;
        padding-left: 30px;
        padding-right: 30px;
    }
    .item-details .dialog__content .dialog__overview {
        height: 100%;
        margin-right: -30px;
        margin-left: -30px;
    }
    .item-details .item-slideshow-wrapper {
        height: 515px !important;
    }
    .item-details .item-description {
        height: auto !important;
    }
    .item-details .item-description .buy-now {
        position: static !important;
        float: right;
        margin-bottom: 20px;
    }
    .item-details .item-slideshow .owl-stage-outer, .item-details .item-slideshow .owl-stage {
        height: 100%;
    }
    .item-details .item-slideshow .slide {
        width: 100% !important;
    }
}

@media (max-width: 420px) {
    .gallery {
        margin-top: 80px;
    }
    .gallery-filters {
        top: -90px;
    }
    .item-details .dialog__content {
        width: 100%;
        max-width: 100%;
    }
}

@media (max-width: 610px) {
    .gallery-item, .gallery {
        width: 100% !important;
    }
}

@media (min-width: 768px) {
    .item-details .dialog__content .container-fluid>.row {
        margin-left: -30px;
        margin-right: -30px;
    }
}


/*------------------------------------------------------------------
[26. Vector Map : Mapplic Plugin] 
*/

.mapplic-container {
    width: 100%;
    background-color: transparent;
}

.mapplic-container .mapplic-fullscreen-button {
    left: auto;
    right: 154px;
    bottom: 0;
    top: auto;
}

.mapplic-container .mapplic-clear-button {
    visibility: hidden;
}

.mapplic-tooltip:before {
    content: "Location";
    font-size: 12px;
    margin: 0;
    line-height: normal;
    opacity: .7;
    color: #626262;
}

.mapplic-tooltip-close {
    opacity: .5;
    background: none;
}

.mapplic-tooltip-close:after {
    content: "\e60a";
    font-family: 'pages-icon';
    font-size: 12px;
    position: relative;
    top: -2px;
    color: #626262;
    opacity: .7;
}

.mapplic-tooltip-title {
    display: none;
}

.mapplic-tooltip-content {
    margin-top: 5px;
}

.mapplic-tooltip {
    max-width: 150px;
    padding: 10px 12px;
    border-radius: 4px;
}

.mapplic-tooltip-description {
    font-weight: bold;
    color: #626262;
}

.mapplic-tooltip-description strong {
    color: #f55753;
    margin-right: 2px;
}

.map-controls {
    position: absolute;
    left: 50px;
    top: 80px;
    z-index: 1;
}

.mapplic-pin {
    background-image: url('../../assets/img/maps/marker-master.svg');
    background-size: contain;
}

.mapplic-pin.pulse {
    background-image: url('../../assets/img/maps/pulse-master.svg');
}

.mapplic-pin.pulse.green {
    background-image: url('../../assets/img/maps/pulse-success.svg');
}

.mapplic-pin.pulse.blue {
    background-image: url('../../assets/img/maps/pulse-complete.svg');
}

.mapplic-pin.pulse.purple {
    background-image: url('../../assets/img/maps/pulse-primary.svg');
}

.mapplic-pin.pulse.yellow {
    background-image: url('../../assets/img/maps/pulse-warning.svg');
}

.mapplic-pin.pulse.red {
    background-image: url('../../assets/img/maps/pulse-danger.svg');
}

.mapplic-pin.pulse-alt {
    background-image: url('../../assets/img/maps/pulse-alt-master.svg');
}

.mapplic-pin.pulse-alt.green {
    background-image: url('../../assets/img/maps/pulse-alt-success.svg');
}

.mapplic-pin.pulse-alt.blue {
    background-image: url('../../assets/img/maps/pulse-alt-complete.svg');
}

.mapplic-pin.pulse-alt.purple {
    background-image: url('../../assets/img/maps/pulse-alt-primary.svg');
}

.mapplic-pin.pulse-alt.yellow {
    background-image: url('../../assets/img/maps/pulse-alt-warning.svg');
}

.mapplic-pin.pulse-alt.red {
    background-image: url('../../assets/img/maps/pulse-alt-danger.svg');
}

.mapplic-pin.marker {
    background-image: url('../../assets/img/maps/marker-master.svg');
}

.mapplic-pin.marker.green {
    background-image: url('../../assets/img/maps/marker-success.svg');
}

.mapplic-pin.marker.blue {
    background-image: url('../../assets/img/maps/marker-complete.svg');
}

.mapplic-pin.marker.purple {
    background-image: url('../../assets/img/maps/marker-primary.svg');
}

.mapplic-pin.marker.yellow {
    background-image: url('../../assets/img/maps/marker-warning.svg');
}

.mapplic-pin.marker.red {
    background-image: url('../../assets/img/maps/marker-danger.svg');
}

.mapplic-pin.marker-alt {
    background-image: url('../../assets/img/maps/marker-alt-master.svg');
}

.mapplic-pin.marker-alt.green {
    background-image: url('../../assets/img/maps/marker-alt-success.svg');
}

.mapplic-pin.marker-alt.blue {
    background-image: url('../../assets/img/maps/marker-alt-complete.svg');
}

.mapplic-pin.marker-alt.purple {
    background-image: url('../../assets/img/maps/marker-alt-primary.svg');
}

.mapplic-pin.marker-alt.yellow {
    background-image: url('../../assets/img/maps/marker-alt-warning.svg');
}

.mapplic-pin.marker-alt.red {
    background-image: url('../../assets/img/maps/marker-alt-danger.svg');
}


/*------------------------------------------------------------------
[27. Pricing]
*/

.pricing-table td[class*="bg-"], .pricing-table th[class*="bg-"] {
    border-top-color: transparent;
    border-bottom-color: rgba(0, 0, 0, 0.02);
    border-right-color: transparent;
    border-left-color: transparent;
    border-bottom-width: 1px;
    border-bottom-style: solid;
}

.pricing-table>thead>tr>th {
    border-bottom-width: 1px;
}

.pricing-table tr td:nth-child(2), .pricing-table tr th:nth-child(2) {
    border-left: 1px solid rgba(0, 0, 0, 0.1);
}

@media only screen and (max-width: 768px) {
    /* Force table to not be like tables anymore */
    .pricing-table, .pricing-table thead, .pricing-table tbody, .pricing-table th, .pricing-table td, .pricing-table tr {
        display: block;
    }
    .pricing-table {
        /* Hide table headers (but not display: none;, for accessibility) */
        /*
    Label the data
    */
    }
    .pricing-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
    .pricing-table tr {
        margin-top: 25px;
    }
    .pricing-table tr td:nth-child(2), .pricing-table tr th:nth-child(2) {
        border-left: none;
    }
    .pricing-table td {
        /* Behave like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
        white-space: normal;
        text-align: left;
    }
    .pricing-table td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 50%;
        margin-top: -11px;
        left: 17px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        text-align: left;
        font-weight: bold;
    }
    .pricing-table td:before {
        content: attr(data-title);
    }
}


/* Pricing Layouts */

.pricing-layout-overflow-top {
    position: relative;
    margin-top: -232px;
}


/*------------------------------------------------------------------
[27. Widgets]
*/

.widget {
    position: relative;
}

.widget>div {
    position: relative;
    z-index: 1;
}

.widget:after {
    background-size: cover;
    content: " ";
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    position: absolute;
    z-index: 0;
    opacity: .69;
}

.widget-1:after {
    background-image: url("../../assets/img/dashboard/pages_hero.jpg");
    background-size: cover;
    content: " ";
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    position: absolute;
    z-index: 0;
    opacity: .69;
}

.widget-1:before {
    background-image: url('../img/linear_gradient.png');
    background-repeat: repeat-x;
    content: " ";
    left: 0;
    right: 0;
    height: 325px;
    bottom: 0;
    position: absolute;
    z-index: 1;
}

.widget-1>.panel-body .company:nth-child(2)>div {
    display: table;
    margin: 0 auto;
    width: 127px;
}

.widget-1>.panel-body>* {
    z-index: 1;
}

.widget-1>.panel-body>*:not(.pull-bottom) {
    position: relative;
}

.widget-1>.panel-body .pull-bottom {
    padding: 0 49px 56px 42px;
}

.widget-1 span.label {
    color: #fff;
    background: rgba(255, 255, 255, 0.3);
}

.widget-2:after {
    background-image: url("../../assets/img/social/person-cropped.jpg");
}

.widget-3 a {
    text-decoration: none;
}

.widget-3 .pg-map {
    font-size: 30px;
}

.widget-3 .widget-3-fav {
    background: rgba(0, 0, 0, 0.07);
    vertical-align: middle;
    padding: 6px 11px;
    display: block;
}

.widget-4 .row-sm-height:nth-child(1) {
    height: 30px;
}

.widget-4 .row-sm-height:nth-child(2) {
    height: 30px;
}

.widget-4-chart {
    height: 100%;
    width: 100%;
    bottom: 0;
    position: absolute;
    right: 0;
}

.widget-4-chart.line-chart .tick text, .widget-4-chart .line-chart .nvd3 .nv-axis .nv-axisMaxMin text {
    transform: translate(-10px, -32px);
}

.widget-4-chart .nvtooltip .nv-pointer-events-none thead {
    display: none;
}

.widget-4-chart .nvtooltip .nv-pointer-events-none tbody .nv-pointer-events-none .key {
    display: none;
}

.widget-5-chart-container {
    overflow: hidden;
}

.widget-5-chart {
    height: auto;
    width: auto;
    bottom: 20px;
    position: absolute;
    right: 20px;
    left: 20px;
    top: 40px;
}

.widget-6 {
    background: #939393;
}

.widget-6 .label {
    background: rgba(0, 0, 0, 0.3);
    color: rgba(255, 255, 255, 0.67);
}

.widget-7 .slide-back .row-sm-height:nth-child(1) {
    height: 60%;
}

.widget-7 .slide-back .row-sm-height:nth-child(2) {
    height: 40%;
}

.widget-7-chart {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    position: absolute;
}

.widget-7-chart.line-chart[data-points="true"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke-opacity: 1;
}

.widget-7-chart .nvd3 circle.nv-point:nth-child(4) {
    fill: #f55753 !important;
    stroke: #f55753 !important;
}

.widget-8 {
    height: 145px;
}

.widget-8 .row-xs-height:first-child {
    height: 41px;
}

.widget-8-chart {
    height: 100px;
    width: 50%;
    bottom: 0;
    position: absolute;
    right: 0;
}

.widget-8-chart .line-chart[data-points="true"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke-opacity: 0.3;
}

.widget-8-chart .line-chart .nvd3 .nv-groups path.nv-line {
    stroke-opacity: 0.15;
}

.widget-8-chart .nvtooltip {
    display: none;
}

.widget-9 {
    height: 145px;
}

.widget-9 .row-xs-height:first-child {
    height: 26px;
}

.widget-9 .progress {
    background: rgba(0, 0, 0, 0.1);
}

.widget-10 {
    height: 145px;
}

.widget-11 sup {
    margin-right: -4px;
}

.widget-11 .widget-11-table {
    height: 380px;
}

.widget-11 .widget-11-table tr td:first-child {
    width: 40%;
}

.widget-11-2 sup {
    margin-right: -4px;
}

.widget-11-2 .widget-11-2-table {
    height: 273px;
}

.widget-12 .list-inline a {
    padding: 3px 4px;
    border-radius: 3px;
    opacity: .7;
}

.widget-12 .list-inline .active a {
    opacity: 1;
}

.widget-12 .nvd3-line svg {
    height: 316px;
}

.widget-12 .company-stat-boxes .close {
    line-height: 0;
}

.widget-12 .widget-12-search {
    margin-top: -3px;
}

.widget-14 .row-xs-height:nth-child(1) {
    height: 30px;
}

.widget-14 .row-xs-height:nth-child(2) {
    height: 120px;
}

.widget-14 .row-xs-height:nth-child(3) {
    height: 297px;
}

.widget-14-chart_y_axis {
    position: absolute;
    top: 0;
    background: rgba(255, 255, 255, 0.8);
    bottom: 0;
    width: 35px;
    left: 0;
    z-index: 2;
}

.widget-14-chart_y_axis .rickshaw_graph .y_ticks path, .widget-14-chart_y_axis .rickshaw_graph .x_ticks_d3 path {
    fill: none;
    stroke: none;
}

.widget-14-chart_y_axis .rickshaw_graph .y_ticks text, .widget-14-chart_y_axis .rickshaw_graph .x_ticks_d3 text {
    opacity: 0.35;
    font-family: 'Montserrat';
    font-size: 11px;
}

.widget-14-chart_y_axis .y_ticks.plain g:first-child {
    opacity: 0 !important;
}

.widget-14-chart-legend .ui-sortable li {
    padding-right: 0;
}

.widget-14-chart-legend .ui-sortable li .action {
    display: none;
}

.widget-14-chart-legend .ui-sortable li:last-child {
    margin-top: 7px;
}

.widget-15 #widget-15-tab-1>div {
    height: 170px;
}

.widget-15-2 {
    height: 469px;
}

.widget-15-2 #widget-15-2-tab-1 .full-width {
    height: 180px;
}

.widget-16-header .pull-left:last-child {
    width: 69%;
}

.widget-16-chart {
    height: 100px;
}

.widget-16-chart.line-chart[data-stroke-width="2"] .nvd3.nv-line .nvd3.nv-scatter .nv-groups .nv-point {
    stroke-width: 2px;
}

.widget-17 {
    height: 467px;
}

.widget-17 .widget-17-weather {
    width: 90%;
}

.widget-18-post {
    height: 342px;
    background: url('../../assets/img/social/quote.jpg');
    background-position: center center;
    background-size: cover;
}

.widget-19-post {
    height: 237px;
    background: #00A79A;
}

.widget-19-post img {
    top: 50%;
    margin-top: -70px;
}

.btn-circle-arrow {
    border: 1px solid #fff;
    border-radius: 100px;
    position: relative;
    width: 18px;
    height: 18px;
    display: inline-block;
    vertical-align: middle;
    margin-right: 4px;
}

.btn-circle-arrow i {
    font-size: 11px;
    position: absolute;
    left: 50%;
    top: 50%;
    margin-left: -5px;
    margin-top: -4px;
}


/*** Large screens ***/

@media only screen and (min-width: 1824px) {
    .ar-3-2:before {
        padding-top: calc(55% - 5px) !important;
    }
    .ar-2-3:before {
        padding-top: calc(135% - 5px) !important;
    }
}

@media (max-width: 991px) {
    .panel {
        height: auto !important;
    }
    .widget-8, .widget-9, .widget-10 {
        height: 180px !important;
    }
}

@media (max-width: 480px) {
    .widget-1-wrapper {
        height: 340px;
    }
}

@media (max-width: 420px) {
    .widgets-container {
        margin-top: 80px;
    }
}

@media (max-width: 610px) {
    .widget-item, .widgets-container {
        width: 100% !important;
    }
}


/*------------------------------------------------------------------
[28. Misc : Helper Classes]
*/

.custom {
    height: 150px;
}

.icon-list .fa-item {
    display: block;
    color: #121212;
    line-height: 32px;
    height: 32px;
    padding-left: 10px;
}

.icon-list .fa-item>i {
    width: 32px;
    font-size: 14px;
    display: inline-block;
    text-align: right;
    margin-right: 10px;
}

.push-on-sidebar-open {
    -webkit-transition: -webkit-transform 0.25s ease;
    transition: transform 0.25s ease;
    -webkit-backface-visibility: hidden;
}


/* Thumbnail for icons and profile pics 
------------------------------------
*/

.thumbnail-wrapper {
    display: inline-block;
    overflow: hidden;
    float: left;
}

.thumbnail-wrapper.circular {
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
}

.thumbnail-wrapper.bordered {
    border-width: 4px;
    border-style: solid;
}

.thumbnail-wrapper.bordered.d16 {
    width: 20px;
    height: 20px;
}

.thumbnail-wrapper.bordered.d16>* {
    line-height: 12px;
}

.thumbnail-wrapper.bordered.d24 {
    width: 28px;
    height: 28px;
}

.thumbnail-wrapper.bordered.d24>* {
    line-height: 24px;
}

.thumbnail-wrapper.bordered.d32 {
    width: 36px;
    height: 36px;
}

.thumbnail-wrapper.bordered.d32>* {
    line-height: 28px;
}

.thumbnail-wrapper.bordered.d48 {
    width: 52px;
    height: 52px;
}

.thumbnail-wrapper.bordered.d48>* {
    line-height: 44px;
}

.thumbnail-wrapper.d16 {
    width: 16px;
    height: 16px;
}

.thumbnail-wrapper.d16>* {
    line-height: 16px;
}

.thumbnail-wrapper.d24 {
    width: 24px;
    height: 24px;
}

.thumbnail-wrapper.d24>* {
    line-height: 24px;
}

.thumbnail-wrapper.d32 {
    width: 32px;
    height: 32px;
}

.thumbnail-wrapper.d32>* {
    line-height: 32px;
}

.thumbnail-wrapper.d39 {
    width: 39px;
    height: 39px;
}

.thumbnail-wrapper.d39>* {
    line-height: 39px;
}

.thumbnail-wrapper.d48 {
    width: 48px;
    height: 48px;
}

.thumbnail-wrapper.d48>* {
    line-height: 50px;
}

.thumbnail-wrapper>* {
    vertical-align: middle;
    width: 100%;
    height: 100%;
    text-align: center;
}


/* Profile dropdown
------------------------------------
*/

.profile-dropdown {
    background: #fff;
    padding: 0;
}

.profile-dropdown:before {
    position: absolute;
    top: -7px;
    right: 15px;
    display: inline-block;
    border-right: 7px solid transparent;
    border-bottom: 7px solid #ccc;
    border-left: 7px solid transparent;
    border-bottom-color: rgba(0, 0, 0, 0.2);
    content: '';
}

.profile-dropdown:after {
    position: absolute;
    top: -6px;
    right: 16px;
    display: inline-block;
    border-right: 6px solid transparent;
    border-bottom: 6px solid #ffffff;
    border-left: 6px solid transparent;
    content: '';
}

.profile-dropdown li:last-child {
    margin-top: 11px;
    padding: 0;
}

.profile-dropdown li:last-child>a {
    padding-top: 3px;
    padding-bottom: 3px;
    padding-right: 19px;
}

.profile-dropdown li>a {
    opacity: .5;
    -webkit-transition: opacity ease 0.3s;
    transition: opacity ease 0.3s;
    padding-left: 17px;
    padding-right: 37px;
    min-width: 138px;
}

.profile-dropdown li>a>i {
    margin-right: 5px;
}

.profile-dropdown li>a:hover {
    opacity: 1;
}

.profile-dropdown-toggle {
    background: transparent;
    border: none;
}


/* Scroll 
------------------------------------
*/

.scrollable {
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}


/* Overides 
------------------------------------
*/

.no-padding {
    padding: 0px !important;
}

.no-margin {
    margin: 0px !important;
}

.no-overflow {
    overflow: hidden !important;
}

.auto-overflow {
    overflow: auto !important;
}

.reset-overflow {
    overflow: initial !important;
}

.center-margin {
    margin-left: auto;
    margin-right: auto;
}

.inherit-size {
    width: inherit;
    height: inherit;
}

.inherit-height {
    height: inherit;
}

.image-responsive-height {
    width: 100%;
}

.image-responsive-width {
    height: 100%;
}

.overlayer {
    position: absolute;
    display: block;
    z-index: 21;
}

.overlayer.fullwidth {
    width: 100%;
}

.overlayer-wrapper {
    position: relative;
    display: block;
    z-index: 10;
}

.overlay-fixed {
    position: fixed !important;
    top: auto !important;
}

.top-left {
    position: absolute !important;
    top: 0;
    left: 0;
}

.top-right {
    position: absolute !important;
    top: 1px;
    right: 0;
}

.bottom-left {
    position: absolute !important;
    bottom: 1px;
    left: 0;
}

.bottom-right {
    position: absolute !important;
    bottom: 0;
    right: 0;
}

.pull-bottom {
    position: absolute !important;
    bottom: 0;
}

.pull-up {
    position: absolute !important;
    top: 0;
}

.pull-left {
    float: left !important;
}

.pull-right {
    float: right !important;
}

.pull-center {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    display: table;
    z-index: 1;
}

.cursor {
    cursor: pointer;
}

.scroll-x-hidden {
    overflow-x: hidden !important;
}


/* Generic Padding Helpers 
------------------------------------
*/

.p-t-0 {
    padding-top: 0px !important;
}

.p-r-0 {
    padding-right: 0px !important;
}

.p-l-0 {
    padding-left: 0px !important;
}

.p-b-0 {
    padding-bottom: 0px !important;
}

.padding-0 {
    padding: 0px !important;
}

.p-t-5 {
    padding-top: 5px !important;
}

.p-r-5 {
    padding-right: 5px !important;
}

.p-l-5 {
    padding-left: 5px !important;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.padding-5 {
    padding: 5px !important;
}

.p-t-10 {
    padding-top: 10px !important;
}

.p-r-10 {
    padding-right: 10px !important;
}

.p-l-10 {
    padding-left: 10px !important;
}

.p-b-10 {
    padding-bottom: 10px !important;
}

.padding-10 {
    padding: 10px !important;
}

.p-t-15 {
    padding-top: 15px !important;
}

.p-r-15 {
    padding-right: 15px !important;
}

.p-l-15 {
    padding-left: 15px !important;
}

.p-b-15 {
    padding-bottom: 15px !important;
}

.padding-15 {
    padding: 15px !important;
}

.p-t-20 {
    padding-top: 20px !important;
}

.p-r-20 {
    padding-right: 20px !important;
}

.p-l-20 {
    padding-left: 20px !important;
}

.p-b-20 {
    padding-bottom: 20px !important;
}

.padding-20 {
    padding: 20px !important;
}

.p-t-25 {
    padding-top: 25px !important;
}

.p-r-25 {
    padding-right: 25px !important;
}

.p-l-25 {
    padding-left: 25px !important;
}

.p-b-25 {
    padding-bottom: 25px !important;
}

.padding-25 {
    padding: 25px !important;
}

.p-t-30 {
    padding-top: 30px !important;
}

.p-r-30 {
    padding-right: 30px !important;
}

.p-l-30 {
    padding-left: 30px !important;
}

.p-b-30 {
    padding-bottom: 30px !important;
}

.padding-30 {
    padding: 30px !important;
}

.p-t-35 {
    padding-top: 35px !important;
}

.p-r-35 {
    padding-right: 35px !important;
}

.p-l-35 {
    padding-left: 35px !important;
}

.p-b-35 {
    padding-bottom: 35px !important;
}

.padding-35 {
    padding: 35px !important;
}

.p-t-40 {
    padding-top: 40px !important;
}

.p-r-40 {
    padding-right: 40px !important;
}

.p-l-40 {
    padding-left: 40px !important;
}

.p-b-40 {
    padding-bottom: 40px !important;
}

.padding-40 {
    padding: 40px !important;
}

.p-t-45 {
    padding-top: 45px !important;
}

.p-r-45 {
    padding-right: 45px !important;
}

.p-l-45 {
    padding-left: 45px !important;
}

.p-b-45 {
    padding-bottom: 45px !important;
}

.padding-45 {
    padding: 45px !important;
}

.p-t-50 {
    padding-top: 50px !important;
}

.p-r-50 {
    padding-right: 50px !important;
}

.p-l-50 {
    padding-left: 50px !important;
}

.p-b-50 {
    padding-bottom: 50px !important;
}

.padding-50 {
    padding: 50px !important;
}

.p-t-55 {
    padding-top: 55px !important;
}

.p-r-55 {
    padding-right: 55px !important;
}

.p-l-55 {
    padding-left: 55px !important;
}

.p-b-55 {
    padding-bottom: 55px !important;
}

.padding-55 {
    padding: 55px !important;
}

.p-t-60 {
    padding-top: 60px !important;
}

.p-r-60 {
    padding-right: 60px !important;
}

.p-l-60 {
    padding-left: 60px !important;
}

.p-b-60 {
    padding-bottom: 60px !important;
}

.padding-60 {
    padding: 60px !important;
}

.p-t-65 {
    padding-top: 65px !important;
}

.p-r-65 {
    padding-right: 65px !important;
}

.p-l-65 {
    padding-left: 65px !important;
}

.p-b-65 {
    padding-bottom: 65px !important;
}

.padding-65 {
    padding: 65px !important;
}

.p-t-70 {
    padding-top: 70px !important;
}

.p-r-70 {
    padding-right: 70px !important;
}

.p-l-70 {
    padding-left: 70px !important;
}

.p-b-70 {
    padding-bottom: 70px !important;
}

.padding-70 {
    padding: 70px !important;
}

.p-t-75 {
    padding-top: 75px !important;
}

.p-r-75 {
    padding-right: 75px !important;
}

.p-l-75 {
    padding-left: 75px !important;
}

.p-b-75 {
    padding-bottom: 75px !important;
}

.padding-75 {
    padding: 75px !important;
}

.p-t-80 {
    padding-top: 80px !important;
}

.p-r-80 {
    padding-right: 80px !important;
}

.p-l-80 {
    padding-left: 80px !important;
}

.p-b-80 {
    padding-bottom: 80px !important;
}

.padding-80 {
    padding: 80px !important;
}

.p-t-85 {
    padding-top: 85px !important;
}

.p-r-85 {
    padding-right: 85px !important;
}

.p-l-85 {
    padding-left: 85px !important;
}

.p-b-85 {
    padding-bottom: 85px !important;
}

.padding-85 {
    padding: 85px !important;
}

.p-t-90 {
    padding-top: 90px !important;
}

.p-r-90 {
    padding-right: 90px !important;
}

.p-l-90 {
    padding-left: 90px !important;
}

.p-b-90 {
    padding-bottom: 90px !important;
}

.padding-90 {
    padding: 90px !important;
}

.p-t-95 {
    padding-top: 95px !important;
}

.p-r-95 {
    padding-right: 95px !important;
}

.p-l-95 {
    padding-left: 95px !important;
}

.p-b-95 {
    padding-bottom: 95px !important;
}

.padding-95 {
    padding: 95px !important;
}

.p-t-100 {
    padding-top: 100px !important;
}

.p-r-100 {
    padding-right: 100px !important;
}

.p-l-100 {
    padding-left: 100px !important;
}

.p-b-100 {
    padding-bottom: 100px !important;
}

.padding-100 {
    padding: 100px !important;
}


/* Generic Margin Helpers
------------------------------------
 */

.m-t-0 {
    margin-top: 0px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.m-b-0 {
    margin-bottom: 0px;
}

.m-t-5 {
    margin-top: 5px;
}

.m-r-5 {
    margin-right: 5px;
}

.m-l-5 {
    margin-left: 5px;
}

.m-b-5 {
    margin-bottom: 5px;
}

.m-t-10 {
    margin-top: 10px;
}

.m-r-10 {
    margin-right: 10px;
}

.m-l-10 {
    margin-left: 10px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-15 {
    margin-top: 15px;
}

.m-r-15 {
    margin-right: 15px;
}

.m-l-15 {
    margin-left: 15px;
}

.m-b-15 {
    margin-bottom: 15px;
}

.m-t-20 {
    margin-top: 20px;
}

.m-r-20 {
    margin-right: 20px;
}

.m-l-20 {
    margin-left: 20px;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-25 {
    margin-top: 25px;
}

.m-r-25 {
    margin-right: 25px;
}

.m-l-25 {
    margin-left: 25px;
}

.m-b-25 {
    margin-bottom: 25px;
}

.m-t-30 {
    margin-top: 30px;
}

.m-r-30 {
    margin-right: 30px;
}

.m-l-30 {
    margin-left: 30px;
}

.m-b-30 {
    margin-bottom: 30px;
}

.m-t-35 {
    margin-top: 35px;
}

.m-r-35 {
    margin-right: 35px;
}

.m-l-35 {
    margin-left: 35px;
}

.m-b-35 {
    margin-bottom: 35px;
}

.m-t-40 {
    margin-top: 40px;
}

.m-r-40 {
    margin-right: 40px;
}

.m-l-40 {
    margin-left: 40px;
}

.m-b-40 {
    margin-bottom: 40px;
}

.m-t-45 {
    margin-top: 45px;
}

.m-r-45 {
    margin-right: 45px;
}

.m-l-45 {
    margin-left: 45px;
}

.m-b-45 {
    margin-bottom: 45px;
}

.m-t-50 {
    margin-top: 50px;
}

.m-r-50 {
    margin-right: 50px;
}

.m-l-50 {
    margin-left: 50px;
}

.m-b-50 {
    margin-bottom: 50px;
}

.m-t-55 {
    margin-top: 55px;
}

.m-r-55 {
    margin-right: 55px;
}

.m-l-55 {
    margin-left: 55px;
}

.m-b-55 {
    margin-bottom: 55px;
}

.m-t-60 {
    margin-top: 60px;
}

.m-r-60 {
    margin-right: 60px;
}

.m-l-60 {
    margin-left: 60px;
}

.m-b-60 {
    margin-bottom: 60px;
}

.m-t-65 {
    margin-top: 65px;
}

.m-r-65 {
    margin-right: 65px;
}

.m-l-65 {
    margin-left: 65px;
}

.m-b-65 {
    margin-bottom: 65px;
}

.m-t-70 {
    margin-top: 70px;
}

.m-r-70 {
    margin-right: 70px;
}

.m-l-70 {
    margin-left: 70px;
}

.m-b-70 {
    margin-bottom: 70px;
}

.m-t-75 {
    margin-top: 75px;
}

.m-r-75 {
    margin-right: 75px;
}

.m-l-75 {
    margin-left: 75px;
}

.m-b-75 {
    margin-bottom: 75px;
}

.m-t-80 {
    margin-top: 80px;
}

.m-r-80 {
    margin-right: 80px;
}

.m-l-80 {
    margin-left: 80px;
}

.m-b-80 {
    margin-bottom: 80px;
}

.m-t-85 {
    margin-top: 85px;
}

.m-r-85 {
    margin-right: 85px;
}

.m-l-85 {
    margin-left: 85px;
}

.m-b-85 {
    margin-bottom: 85px;
}

.m-t-90 {
    margin-top: 90px;
}

.m-r-90 {
    margin-right: 90px;
}

.m-l-90 {
    margin-left: 90px;
}

.m-b-90 {
    margin-bottom: 90px;
}

.m-t-95 {
    margin-top: 95px;
}

.m-r-95 {
    margin-right: 95px;
}

.m-l-95 {
    margin-left: 95px;
}

.m-b-95 {
    margin-bottom: 95px;
}

.m-t-100 {
    margin-top: 100px;
}

.m-r-100 {
    margin-right: 100px;
}

.m-l-100 {
    margin-left: 100px;
}

.m-b-100 {
    margin-bottom: 100px;
}

.full-height {
    height: 100% !important;
}

.full-width {
    width: 100%;
}

.hide {
    display: none;
}

.inline {
    display: inline-block !important;
}

.block {
    display: block;
}

.b-blank {
    border-color: #000;
}


/* Border Helpers 
------------------------------------
*/

.b-a, .b-r, .b-l, .b-t, .b-b {
    border-style: solid;
    border-width: 0;
}

.b-r {
    border-right-width: 1px;
}

.b-l {
    border-left-width: 1px;
}

.b-t {
    border-top-width: 1px;
}

.b-b {
    border-bottom-width: 1px;
}

.b-a {
    border-width: 1px;
}

.b-dashed {
    border-style: dashed;
}

.b-thick {
    border-width: 2px;
}

.b-transparent {
    border-color: rgba(0, 0, 0, 0.4);
}

.b-transparent-white {
    border-color: rgba(255, 255, 255, 0.3);
}

.b-grey {
    border-color: #e6e6e6;
}

.b-white {
    border-color: #fff;
}

.b-primary {
    border-color: #6d5cae;
}

.b-complete {
    border-color: #6d5cae;
}

.b-success {
    border-color: #10cfbd;
}

.b-info {
    border-color: #3b4752;
}

.b-danger {
    border-color: #f55753;
}

.b-warning {
    border-color: #f8d053;
}


/* Border Radius
------------------------------------
*/

.b-rad-sm {
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
}

.b-rad-md {
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
}

.b-rad-lg {
    border-radius: 7px;
    -webkit-border-radius: 7px;
    -moz-border-radius: 7px;
}

.no-border {
    border: none !important;
}


/** Profile Wrappers **/

.profile-img-wrapper {
    float: left;
    border-radius: 100px 100px 100px 100px;
    display: inline-block;
    height: 35px;
    overflow: hidden;
    width: 35px;
    -webkit-flex: 1;
    -moz-flex: 1;
    flex: 1;
}

.profile-img-wrapper.big {
    height: 68px;
    width: 68px;
}

.profile-img-wrapper.with-left-space-custom {
    margin-left: 7px;
}

.relative {
    position: relative;
}


/* Demo Purposes */

.icon-set-preview {
    transition: opacity 0.1s linear;
}

#icon-list {
    transition: all 0.1s ease-in-out;
}

.error-number {
    font-family: 'Montserrat';
    font-size: 90px;
    line-height: 90px;
}

.error-container-innner {
    margin-left: auto;
    margin-right: auto;
    width: 360px;
}

.error-container {
    margin-top: -100px;
    margin-left: auto;
    margin-right: auto;
    width: 38%;
}

.visible-xlg {
    display: none;
}

.hidden-xlg {
    display: block;
}

.sm-gutter .row>[class^="col-"], .sm-gutter .row>[class*="col-"] {
    padding-left: 5px;
    padding-right: 5px;
}

.sm-gutter .row {
    margin-left: -5px;
    margin-right: -5px;
}


/* Aspect ratio */

.ar-1-1 .panel, .ar-2-1 .panel, .ar-1-2 .panel, .ar-3-2 .panel, .ar-2-3 .panel {
    margin: 0;
}

.ar-1-1 {
    position: relative;
    width: 100%;
    /* desired width */
    overflow: hidden;
}

.ar-1-1:before {
    content: "";
    display: block;
    padding-top: 100%;
    /* initial ratio of 1:1*/
}

.ar-1-1>div {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.ar-2-1 {
    position: relative;
    width: 100%;
    /* desired width */
    overflow: hidden;
}

.ar-2-1:before {
    content: "";
    display: block;
    padding-top: calc(50% - 5px);
    /* initial ratio of 1:1*/
}

.ar-2-1>div {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.ar-1-2 {
    position: relative;
    width: 100%;
    /* desired width */
    overflow: hidden;
}

.ar-1-2:before {
    content: "";
    display: block;
    padding-top: calc(150% - 5px);
    /* initial ratio of 1:1*/
}

.ar-1-2>div {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.ar-3-2 {
    position: relative;
    width: 100%;
    /* desired width */
    overflow: hidden;
}

.ar-3-2:before {
    content: "";
    display: block;
    padding-top: calc(75% - 5px);
    /* initial ratio of 1:1*/
}

.ar-3-2>div {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.ar-2-3 {
    position: relative;
    width: 100%;
    /* desired width */
    overflow: hidden;
}

.ar-2-3:before {
    content: "";
    display: block;
    padding-top: calc(125% - 5px);
    /* initial ratio of 1:1*/
}

.ar-2-3>div {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.v-align-bottom {
    vertical-align: bottom !important;
}

.v-align-top {
    vertical-align: top !important;
}

.v-align-middle {
    vertical-align: middle !important;
}


/* vertical alignment styles */

.col-top {
    vertical-align: top !important;
}

.col-middle {
    vertical-align: middle !important;
}

.col-bottom {
    vertical-align: bottom !important;
}


/* columns of same height styles 
------------------------------------
*/

.container-xs-height {
    display: table;
    padding-left: 0px;
    padding-right: 0px;
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.row-xs-height {
    display: table-row;
}

.col-xs-height {
    display: table-cell;
    float: none;
}

@media (min-width: 768px) {
    .container-sm-height {
        display: table;
        padding-left: 0px;
        padding-right: 0px;
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .row-sm-height {
        display: table-row;
    }
    .col-sm-height {
        display: table-cell !important;
        float: none !important;
    }
}

@media (min-width: 992px) {
    .container-md-height {
        display: table;
        padding-left: 0px;
        padding-right: 0px;
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .row-md-height {
        display: table-row;
    }
    .col-md-height {
        display: table-cell !important;
        float: none !important;
    }
}

@media (min-width: 1200px) {
    .container-lg-height {
        display: table;
        padding-left: 0px;
        padding-right: 0px;
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    .row-lg-height {
        display: table-row;
    }
    .col-lg-height {
        display: table-cell !important;
        float: none !important;
    }
}


/*------------------------------------------------------------------
[29. Print]
*/

@media print {
    .header, .page-sidebar, .quickview-wrapper, .overlay {
        display: none;
    }
    .page-container {
        padding-left: 0;
    }
    .page-content-wrapper .content {
        border-top: 0;
    }
    .page-content-wrapper .content .panel {
        border: none;
    }
    .page-content-wrapper .content .panel .panel-body {
        padding: 0;
    }
    [class^='padding-'], [class*='padding-'], .table tbody tr td {
        padding: 10px;
    }
}


/*------------------------------------------------------------------
[30. Demo : Only for demo pursposes]
*/

.builder {
    width: 423px;
    right: -423px;
}

.builder>div {
    height: calc(100% - 12px);
}

.builder a {
    position: relative;
    display: block;
    width: 100%;
    color: #a1a1a1;
}

.builder a>img {
    opacity: 0.33;
    -webkit-transition: opacity 0.1s linear;
    transition: opacity 0.1s linear;
}

.builder a.active {
    color: #626262;
}

.builder a.active>img {
    opacity: 0.87;
}

.builder a.active:before {
    background-image: url('../../assets/img//demo/tick.svg');
    width: 23px;
    height: 23px;
    content: '';
    position: absolute;
    top: 84px;
    right: -10px;
    z-index: 10;
}

.builder a:hover {
    color: #818181;
}

.builder a:hover>img {
    opacity: 0.7;
}

.builder .builder-footer {
    right: 0;
    left: 0;
    z-index: 10;
}

.builder .theme-selector.active:before {
    top: 54px;
    right: 10px;
}

.builder .nav-tabs {
    background-color: transparent;
    padding: 0;
}

.builder .nav-tabs>li>a {
    min-width: 99px;
    padding: 16px 0;
}

.builder .nav-tabs~.tab-content {
    position: relative;
    padding-right: 0px;
    height: 100%;
    top: 0;
}

.builder .nav-tabs~.tab-content .tab-pane {
    height: 100%;
    overflow-x: hidden !important;
}

.builder .nav-tabs~.tab-content .tab-pane .scrollable {
    padding-top: 27px;
    height: calc(100% - 47px);
    overflow-x: hidden !important;
}

.builder .builder-close {
    position: absolute;
    right: 36px;
    top: 20px;
    padding: 7px;
    width: auto;
    z-index: 10;
}

.builder .builder-toggle {
    position: absolute;
    width: 54px;
    height: 50px;
    top: 20%;
    left: -48px;
    text-align: center;
    line-height: 50px;
    cursor: pointer;
}

.builder:before {
    position: absolute;
    content: '';
    width: 48px;
    height: 50px;
    background-color: #fff;
    top: 20%;
    left: -47px;
    box-shadow: 0 0 9px rgba(191, 191, 191, 0.36);
    border-left: 1px solid rgba(222, 227, 231, 0.56);
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
}

.builder:after {
    position: absolute;
    content: '';
    background-color: #fff;
    width: 5px;
    height: 50px;
    left: 0;
    top: 20%;
}

.builder .btn-toggle-theme>img {
    opacity: 1 !important;
}

.builder .btn-toggle-theme p {
    line-height: 18px;
}

.rtl .builder .builder-toggle {
    left: auto;
    right: -48px;
}

.content-builder {
    display: none;
}

.content-builder.active {
    display: block;
}

.content-builder .placeholder {
    position: relative;
}

.content-builder .placeholder:after {
    content: "Content goes here";
    position: absolute;
    left: 0;
    top: 50%;
    margin-top: -10px;
    right: 0;
    text-align: center;
    font-size: 26px;
    opacity: .16;
    color: #626262;
}

.previewer {
    height: 35px;
}


/* Demo Widths For GIF Animations 
------------------------------------
*/

.demo-bg-hinted {
    background-color: #939393;
}

.demo-fs-23 {
    font-size: 23px !important;
}

.demo-mw-50 {
    max-width: 50px;
}

.demo-mw-300 {
    max-width: 300px;
}

.demo-mw-350 {
    max-width: 350px;
}

.demo-mw-400 {
    max-width: 400px;
}

.demo-mw-500 {
    max-width: 500px;
}

.demo-mw-600 {
    max-width: 600px;
}

.demo-container {
    height: 2000px;
}


/* Views page */

.view-iframe-wrapper {
    width: 100%;
    height: 255px;
    background: #fff;
    position: relative;
}

.view-iframe-wrapper iframe {
    width: 100%;
    height: 100%;
    padding: 45px 45px 0 45px;
}

@media (max-width: 1200px) {
    .view-iframe-wrapper iframe {
        padding: 0;
    }
}

.visible-xlg {
    display: none;
}

.hidden-xlg {
    display: block;
}


/*** Large screens ***/

@media (min-width: 1824px) {
    .visible-xlg {
        display: block !important;
    }
    .hidden-xlg {
        display: none !important;
    }
    .quickview-wrapper .tab-content #quickview-notes>.inner {
        width: 570px;
    }
    .container-fluid.container-fixed-lg {
        width: 1700px;
        margin-right: auto;
        margin-left: auto;
    }
    .menu-pin .container-fluid.container-fixed-lg {
        width: 1450px;
    }
    .visible-xlg {
        display: block !important;
    }
    .hidden-xlg {
        display: none !important;
    }
    .col-xlg-1, .col-xlg-2, .col-xlg-3, .col-xlg-4, .col-xlg-5, .col-xlg-6, .col-xlg-7, .col-xlg-8, .col-xlg-9, .col-xlg-10, .col-xlg-11 {
        float: left;
        min-height: 1px;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
    }
    .col-xlg-12 {
        float: left;
        min-height: 1px;
        padding-left: 15px;
        padding-right: 15px;
        position: relative;
        width: 100%;
    }
    .col-xlg-11 {
        width: 91.6667%;
    }
    .col-xlg-10 {
        width: 83.3333%;
    }
    .col-xlg-9 {
        width: 75%;
    }
    .col-xlg-8 {
        width: 66.6667%;
    }
    .col-xlg-7 {
        width: 58.3333%;
    }
    .col-xlg-6 {
        width: 50%;
    }
    .col-xlg-5 {
        width: 41.6667%;
    }
    .col-xlg-4 {
        width: 33.3333%;
    }
    .col-xlg-3 {
        width: 25%;
    }
    .col-xlg-2 {
        width: 16.6667%;
    }
    .col-xlg-1 {
        width: 8.33333%;
    }
    .col-xlg-pull-12 {
        right: 100%;
    }
    .col-xlg-pull-11 {
        right: 91.6667%;
    }
    .col-xlg-pull-10 {
        right: 83.3333%;
    }
    .col-xlg-pull-9 {
        right: 75%;
    }
    .col-xlg-pull-8 {
        right: 66.6667%;
    }
    .col-xlg-pull-7 {
        right: 58.3333%;
    }
    .col-xlg-pull-6 {
        right: 50%;
    }
    .col-xlg-pull-5 {
        right: 41.6667%;
    }
    .col-xlg-pull-4 {
        right: 33.3333%;
    }
    .col-xlg-pull-3 {
        right: 25%;
    }
    .col-xlg-pull-2 {
        right: 16.6667%;
    }
    .col-xlg-pull-1 {
        right: 8.33333%;
    }
    .col-xlg-pull-0 {
        right: 0;
    }
    .col-xlg-push-12 {
        left: 100%;
    }
    .col-xlg-push-11 {
        left: 91.6667%;
    }
    .col-xlg-push-10 {
        left: 83.3333%;
    }
    .col-xlg-push-9 {
        left: 75%;
    }
    .col-xlg-push-8 {
        left: 66.6667%;
    }
    .col-xlg-push-7 {
        left: 58.3333%;
    }
    .col-xlg-push-6 {
        left: 50%;
    }
    .col-xlg-push-5 {
        left: 41.6667%;
    }
    .col-xlg-push-4 {
        left: 33.3333%;
    }
    .col-xlg-push-3 {
        left: 25%;
    }
    .col-xlg-push-2 {
        left: 16.6667%;
    }
    .col-xlg-push-1 {
        left: 8.33333%;
    }
    .col-xlg-push-0 {
        left: 0;
    }
    .col-xlg-offset-12 {
        margin-left: 100%;
    }
    .col-xlg-offset-11 {
        margin-left: 91.6667%;
    }
    .col-xlg-offset-10 {
        margin-left: 83.3333%;
    }
    .col-xlg-offset-9 {
        margin-left: 75%;
    }
    .col-xlg-offset-8 {
        margin-left: 66.6667%;
    }
    .col-xlg-offset-7 {
        margin-left: 58.3333%;
    }
    .col-xlg-offset-6 {
        margin-left: 50%;
    }
    .col-xlg-offset-5 {
        margin-left: 41.6667%;
    }
    .col-xlg-offset-4 {
        margin-left: 33.3333%;
    }
    .col-xlg-offset-3 {
        margin-left: 25%;
    }
    .col-xlg-offset-2 {
        margin-left: 16.6667%;
    }
    .col-xlg-offset-1 {
        margin-left: 8.33333%;
    }
    .col-xlg-offset-0 {
        margin-left: 0;
    }
}


/*** Desktops ***/


/*** Medium Size Screen ***/

@media only screen and (max-width: 1400px) {
    .page-sidebar .page-sidebar-inner .sidebar-slide .sidebar-menu {
        bottom: 50px;
    }
    .page-sidebar .page-sidebar-inner .sidebar-slide .sidebar-widgets {
        display: none;
    }
    .footer-widget {
        padding: 11px 21px !important;
    }
}


/*** Desktops & Laptops ***/

@media only screen and (min-width: 980px) {
    body.ie9.menu-pin .page-sidebar {
        transform: none !important;
        -webkit-transform: none !important;
        -ms-transform: none !important;
    }
    body.menu-pin {
        overflow-x: hidden;
    }
    body.menu-pin .header .brand {
        width: 245px;
    }
    body.menu-pin .page-container {
        padding-left: 0;
    }
    body.menu-pin .page-container .page-content-wrapper .content {
        padding-left: 250px;
    }
    body.menu-pin .page-container .page-content-wrapper .footer {
        left: 250px;
    }
    body.menu-pin [data-toggle-pin="sidebar"]>i:before {
        content: "\f192";
    }
    body.menu-pin .page-sidebar {
        transform: translate(210px, 0) !important;
        -webkit-transform: translate(210px, 0) !important;
        -ms-transform: translate(210px, 0) !important;
    }
    body.menu-pin .page-sidebar {
        width: 250px;
    }
    body.menu-pin .page-sidebar .sidebar-header .sidebar-header-controls {
        -webkit-transform: translateX(18px);
        -ms-transform: translateX(18px);
        transform: translateX(18px);
    }
    body.menu-pin .page-sidebar .menu-items .icon-thumbnail {
        -webkit-transform: translate3d(-14px, 0, 0);
        transform: translate3d(-14px, 0, 0);
        -ms-transform: translate(-14px, 0);
    }
    body.menu-behind .page-sidebar {
        z-index: 799;
    }
    body.menu-behind .header .brand {
        width: 200px;
        text-align: left;
        padding-left: 20px;
    }
    body.box-layout {
        background-color: #ffffff;
    }
    body.box-layout>.container, body.box-layout>.full-height>.container {
        height: 100%;
        padding: 0;
        background-color: #fafafa;
    }
    body.box-layout .header {
        background-color: transparent;
        border: 0;
        padding: 0;
    }
    body.box-layout .header>.container {
        background-color: #fff;
        border-bottom: 1px solid rgba(230, 230, 230, 0.7);
        padding: 0 20px 0 0;
    }
    body.box-layout .page-sidebar {
        left: auto;
        transform: none !important;
        -webkit-transform: none !important;
    }
    body.box-layout .page-container .page-content-wrapper .footer {
        width: auto;
    }
    .header .brand {
        position: relative;
    }
    .header .user-info-wrapper .user-details .user-name {
        font-size: 16px;
    }
    .header .user-info-wrapper .user-details .user-other {
        font-size: 10px;
    }
    .header .user-info-wrapper .user-pic {
        position: relative;
        top: -6px;
    }
    .notification-panel {
        width: 400px;
    }
}


/*** General Small Screen Desktops ***/


/*** General tablets and phones ***/

@media (max-width: 991px) {
    .page-container {
        padding-left: 0;
    }
    body.sidebar-open .page-container {
        -webkit-transform: translate3d(250px, 0, 0);
        transform: translate3d(250px, 0, 0);
        -ms-transform: translate(250px, 0);
        overflow: hidden;
        position: fixed;
    }
    body.sidebar-open .push-on-sidebar-open {
        -webkit-transform: translate3d(250px, 0, 0);
        transform: translate3d(250px, 0, 0);
        -ms-transform: translate(250px, 0);
        overflow: hidden;
    }
    body.box-layout>.container {
        padding: 0;
        height: 100%;
    }
    body.box-layout .header>.container {
        padding: 0;
    }
    body.box-layout .header>.container .pull-right .sm-action-bar {
        right: 0;
    }
    body.menu-opened.horizontal-menu {
        overflow-y: hidden;
    }
    body.menu-opened.horizontal-menu .bar {
        -webkit-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
        -ms-transform: translate(0%, 0);
    }
    .header {
        padding: 0 10px;
        width: 100%;
        border-bottom: 1px solid rgba(0, 0, 0, 0.07);
        background: #fff !important;
    }
    .header .header-inner {
        text-align: center;
    }
    .header .header-inner .mark-email {
        left: 45px;
        position: absolute;
        top: 23px;
    }
    .header .header-inner .quickview-link {
        position: absolute;
        right: 0;
        top: 12px;
    }
    .header .brand {
        width: auto;
    }
    .header .notification-list, .header .search-link {
        display: none;
    }
    .header>.pull-left, .header>.pull-right {
        position: relative;
    }
    .header>.pull-right .sm-action-bar {
        right: 0;
    }
    .sm-action-bar {
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 10;
    }
    .sm-action-bar>a {
        padding: 10px;
        display: inline-block;
    }
    .pace .pace-activity {
        top: 60px;
    }
    .page-sidebar {
        width: 250px;
        z-index: auto;
        left: 0 !important;
        -webkit-transform: translate3d(0, 0px, 0px) !important;
        transform: translate3d(0, 0px, 0px) !important;
    }
    .page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li {
        padding: 0px 30px 0 36px;
    }
    .page-container {
        padding-left: 0;
        position: relative;
        transition: transform .25s ease;
        -webkit-transition: -webkit-transform 0.25s ease;
    }
    .page-container .page-content-wrapper .content {
        overflow-x: hidden;
        height: auto;
    }
    .icon-thumbnail {
        margin-right: 24px;
    }
    .page-sidebar {
        display: none;
        z-index: auto;
    }
    .page-sidebar.visible {
        display: block;
    }
    .page-sidebar .page-sidebar-inner {
        z-index: 1;
        left: 0 !important;
        width: 260px;
    }
    .page-sidebar .page-sidebar-inner .sidebar-slide .sidebar-menu {
        overflow: scroll;
        -webkit-overflow-scrolling: touch;
        top: 40px;
        bottom: 0;
    }
    .page-sidebar .page-sidebar-inner .sidebar-slide .sidebar-menu ul>li>a>.badge {
        display: inline-block;
    }
    .secondary-sidebar {
        float: none;
        height: auto;
        left: 50%;
        margin-left: -125px;
        padding: 20px;
        position: absolute;
        right: 0;
        top: 60px;
        z-index: 9999;
        display: none;
        border-radius: 10px;
    }
    .secondary-sidebar .btn-compose {
        display: none;
    }
    .inner-content {
        margin: 0;
    }
    .breadcrumb {
        padding-left: 15px;
        padding-right: 15px;
    }
    .copyright {
        padding-left: 15px;
        padding-right: 15px;
    }
    body>.pgn-wrapper[data-position="top"] {
        top: 48px;
        left: 0;
    }
    body>.pgn-wrapper[data-position="bottom"] {
        left: 0;
    }
    body>.pgn-wrapper[data-position$='-left'] {
        left: 20px;
        right: auto;
    }
    .sm-table {
        display: table;
        width: 100%;
    }
    .user-profile-wrapper {
        position: absolute;
        right: 50px;
        top: -9px;
    }
    /*** Horizontal Menu **/
    .horizontal-menu .bar {
        display: block;
        position: fixed;
        top: 0;
        bottom: 0;
        height: 100%;
        width: 250px;
        background-color: #fff;
        z-index: 10;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
        right: 0;
        z-index: 1000;
        box-shadow: 0 0 9px rgba(191, 191, 191, 0.36);
        border-left: 1px solid rgba(222, 227, 231, 0.56);
        -webkit-transform: translate3d(100%, 0, 0);
        transform: translate3d(100%, 0, 0);
        -ms-transform: translate(100%, 0);
        -webkit-transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
        transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .horizontal-menu .bar .bar-inner>ul>li {
        display: block;
    }
    .horizontal-menu .bar .bar-inner>ul>li>a .arrow {
        float: right;
        padding-right: 25px;
    }
    .horizontal-menu .bar .bar-inner>ul>li .classic {
        position: relative;
        background-color: transparent;
        top: 0;
    }
    .horizontal-menu .bar .bar-inner>ul>li .mega, .horizontal-menu .bar .bar-inner>ul>li.horizontal {
        position: relative;
    }
    .horizontal-menu .bar .bar-inner>ul>li>.horizontal {
        position: relative;
        top: 0;
        border-bottom: 0;
    }
    .horizontal-menu .bar .bar-inner>ul>li>.horizontal li {
        display: block;
    }
}


/* Landscape view of all tablet devices */

@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
    .page-sidebar .sidebar-menu .menu-items ul {
        -webkit-transform: translateZ(0);
        -webkit-backface-visibility: hidden;
        -webkit-perspective: 1000;
    }
    .page-container .page-content-wrapper .content {
        padding-top: 60px;
    }
    body.box-layout>.container {
        width: 100%;
    }
    .error-page .error-container {
        width: auto;
    }
    .secondary-sidebar {
        float: none;
        height: auto;
        left: 50%;
        margin-left: -155px;
        padding: 20px;
        position: absolute;
        right: 0;
        top: 60px;
        z-index: 9999;
        display: none;
        border-radius: 10px;
    }
    .secondary-sidebar .btn-compose {
        display: none;
    }
    .split-details {
        margin-left: 0;
    }
    .toggle-secondary-sidebar {
        display: block;
        font-size: 18px;
        left: 50%;
        margin-left: -36px;
        position: absolute;
    }
    .toggle-secondary-sidebar~.brand {
        display: none !important;
    }
}

@media (max-width: 991px) {
    .sm-b-r, .sm-b-l, .sm-b-t, .sm-b-b {
        border-width: 0;
    }
    .sm-b-r {
        border-right-width: 1px;
    }
    .sm-b-l {
        border-left-width: 1px;
    }
    .sm-b-t {
        border-top-width: 1px;
    }
    .sm-b-b {
        border-bottom-width: 1px;
    }
}

@media (min-width: 1200px) {
    .row-same-height {
        overflow: hidden;
    }
    .row-same-height>[class*="col-lg"] {
        margin-bottom: -99999px;
        padding-bottom: 99999px;
    }
}

@media (min-width: 992px) {
    .row-same-height {
        overflow: hidden;
    }
    .row-same-height>[class*="col-md"] {
        margin-bottom: -99999px;
        padding-bottom: 99999px;
    }
    .horizontal-menu .bar {
        display: table !important;
    }
    .horizontal-menu .bar+div {
        padding-top: 50px;
    }
}

@media (min-width: 768px) {
    .row-same-height {
        overflow: hidden;
    }
    .row-same-height>[class*="col-sm"] {
        margin-bottom: -99999px;
        padding-bottom: 99999px;
    }
    .box-layout .container .jumbotron, .container-fluid .jumbotron {
        padding: 0;
    }
    .dataTables_wrapper.form-inline .checkbox input[type=checkbox], .form-inline .radio input[type=radio] {
        position: absolute;
    }
}


/* Portrait view of all tablet devices */

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
    .page-sidebar .sidebar-menu .menu-items>li>a {
        padding-left: 27px;
    }
    .page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li {
        padding: 0px 27px 0 31px;
    }
    .icon-thumbnail {
        margin-right: 21px;
    }
    .error-page .error-container {
        width: auto;
    }
}

@media (max-width: 979px) {
    .toggle-secondary-sidebar {
        font-size: 18px;
        position: static;
        display: block;
    }
    .toggle-secondary-sidebar~.brand {
        display: none !important;
    }
    .secondary-sidebar {
        float: none;
        height: auto;
        left: 50%;
        margin-left: -125px;
        padding: 20px;
        position: absolute;
        right: 0;
        top: 60px;
        z-index: 9999;
        display: none;
        border-radius: 10px;
    }
    .secondary-sidebar .btn-compose {
        display: none;
    }
    .split-view .split-list {
        width: 100%;
        height: auto;
        bottom: 50px;
        left: 0;
        top: 0;
        position: absolute;
        z-index: 2000;
        float: none;
    }
    .split-view .split-list .item {
        padding: 8px;
    }
    .split-view .split-list .item .inline {
        margin-left: 5px;
        width: 188px;
    }
    .split-view .split-details {
        margin-left: 0;
        width: 100%;
    }
    .split-view .split-details .email-content-wrapper {
        overflow: auto;
        padding: 0;
        height: calc(100% - 50px);
    }
    .split-view .split-details .email-content-wrapper .email-content {
        width: 90%;
    }
    .compose-wrapper {
        display: block !important;
    }
    .compose-wrapper .btn-compose {
        display: block !important;
    }
}

@media (max-width: 767px) {
    .header {
        height: 48px;
    }
    .header .notification-list, .header .search-link {
        display: none;
    }
    .header .header-inner {
        height: 48px;
    }
    .header .user-info-wrapper {
        display: none;
    }
    .header .search-link {
        height: 19px;
        width: 16px;
        overflow: hidden;
    }
    .jumbotron, .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }
    .page-container .page-content-wrapper .content {
        padding-top: 48px;
        padding-bottom: 100px;
    }
    .page-sidebar .sidebar-header {
        padding: 0 12px;
    }
    .page-sidebar .sidebar-menu .menu-items>li>a {
        padding-left: 20px;
    }
    .page-sidebar .sidebar-menu .menu-items>li ul.sub-menu>li {
        padding: 0px 25px 0 28px;
    }
    .icon-thumbnail {
        margin-right: 20px;
    }
    .secondary-sidebar {
        top: 48px;
    }
    .split-details {
        margin-left: 0;
    }
    .email-composer {
        padding-left: 30px;
        padding-right: 30px;
    }
    .sm-pull-bottom, .sm-pull-up {
        position: relative !important;
    }
    .sm-p-t-0 {
        padding-top: 0px !important;
    }
    .sm-p-r-0 {
        padding-right: 0px !important;
    }
    .sm-p-l-0 {
        padding-left: 0px !important;
    }
    .sm-p-b-0 {
        padding-bottom: 0px !important;
    }
    .sm-padding-0 {
        padding: 0px !important;
    }
    .sm-p-t-5 {
        padding-top: 5px !important;
    }
    .sm-p-r-5 {
        padding-right: 5px !important;
    }
    .sm-p-l-5 {
        padding-left: 5px !important;
    }
    .sm-p-b-5 {
        padding-bottom: 5px !important;
    }
    .sm-padding-5 {
        padding: 5px !important;
    }
    .sm-p-t-10 {
        padding-top: 10px !important;
    }
    .sm-p-r-10 {
        padding-right: 10px !important;
    }
    .sm-p-l-10 {
        padding-left: 10px !important;
    }
    .sm-p-b-10 {
        padding-bottom: 10px !important;
    }
    .sm-padding-10 {
        padding: 10px !important;
    }
    .sm-p-t-15 {
        padding-top: 15px !important;
    }
    .sm-p-r-15 {
        padding-right: 15px !important;
    }
    .sm-p-l-15 {
        padding-left: 15px !important;
    }
    .sm-p-b-15 {
        padding-bottom: 15px !important;
    }
    .sm-padding-15 {
        padding: 15px !important;
    }
    .sm-p-t-20 {
        padding-top: 20px !important;
    }
    .sm-p-r-20 {
        padding-right: 20px !important;
    }
    .sm-p-l-20 {
        padding-left: 20px !important;
    }
    .sm-p-b-20 {
        padding-bottom: 20px !important;
    }
    .sm-padding-20 {
        padding: 20px !important;
    }
    .sm-p-t-25 {
        padding-top: 25px !important;
    }
    .sm-p-r-25 {
        padding-right: 25px !important;
    }
    .sm-p-l-25 {
        padding-left: 25px !important;
    }
    .sm-p-b-25 {
        padding-bottom: 25px !important;
    }
    .sm-padding-25 {
        padding: 25px !important;
    }
    .sm-p-t-30 {
        padding-top: 30px !important;
    }
    .sm-p-r-30 {
        padding-right: 30px !important;
    }
    .sm-p-l-30 {
        padding-left: 30px !important;
    }
    .sm-p-b-30 {
        padding-bottom: 30px !important;
    }
    .sm-padding-30 {
        padding: 30px !important;
    }
    .sm-p-t-35 {
        padding-top: 35px !important;
    }
    .sm-p-r-35 {
        padding-right: 35px !important;
    }
    .sm-p-l-35 {
        padding-left: 35px !important;
    }
    .sm-p-b-35 {
        padding-bottom: 35px !important;
    }
    .sm-padding-35 {
        padding: 35px !important;
    }
    .sm-p-t-40 {
        padding-top: 40px !important;
    }
    .sm-p-r-40 {
        padding-right: 40px !important;
    }
    .sm-p-l-40 {
        padding-left: 40px !important;
    }
    .sm-p-b-40 {
        padding-bottom: 40px !important;
    }
    .sm-padding-40 {
        padding: 40px !important;
    }
    .sm-p-t-45 {
        padding-top: 45px !important;
    }
    .sm-p-r-45 {
        padding-right: 45px !important;
    }
    .sm-p-l-45 {
        padding-left: 45px !important;
    }
    .sm-p-b-45 {
        padding-bottom: 45px !important;
    }
    .sm-padding-45 {
        padding: 45px !important;
    }
    .sm-p-t-50 {
        padding-top: 50px !important;
    }
    .sm-p-r-50 {
        padding-right: 50px !important;
    }
    .sm-p-l-50 {
        padding-left: 50px !important;
    }
    .sm-p-b-50 {
        padding-bottom: 50px !important;
    }
    .sm-padding-50 {
        padding: 50px !important;
    }
    .sm-m-t-5 {
        margin-top: 5px !important;
    }
    .sm-m-r-5 {
        margin-right: 5px !important;
    }
    .sm-m-l-5 {
        margin-left: 5px !important;
    }
    .sm-m-b-5 {
        margin-bottom: 5px !important;
    }
    .sm-m-t-10 {
        margin-top: 10px !important;
    }
    .sm-m-r-10 {
        margin-right: 10px !important;
    }
    .sm-m-l-10 {
        margin-left: 10px !important;
    }
    .sm-m-b-10 {
        margin-bottom: 10px !important;
    }
    .sm-m-t-15 {
        margin-top: 15px !important;
    }
    .sm-m-r-15 {
        margin-right: 15px !important;
    }
    .sm-m-l-15 {
        margin-left: 15px !important;
    }
    .sm-m-b-15 {
        margin-bottom: 15px !important;
    }
    .sm-m-t-20 {
        margin-top: 20px !important;
    }
    .sm-m-r-20 {
        margin-right: 20px !important;
    }
    .sm-m-l-20 {
        margin-left: 20px !important;
    }
    .sm-m-b-20 {
        margin-bottom: 20px !important;
    }
    .sm-m-t-25 {
        margin-top: 25px !important;
    }
    .sm-m-r-25 {
        margin-right: 25px !important;
    }
    .sm-m-l-25 {
        margin-left: 25px !important;
    }
    .sm-m-b-25 {
        margin-bottom: 25px !important;
    }
    .sm-m-t-30 {
        margin-top: 30px !important;
    }
    .sm-m-r-30 {
        margin-right: 30px !important;
    }
    .sm-m-l-30 {
        margin-left: 30px !important;
    }
    .sm-m-b-30 {
        margin-bottom: 30px !important;
    }
    .sm-m-t-35 {
        margin-top: 35px !important;
    }
    .sm-m-r-35 {
        margin-right: 35px !important;
    }
    .sm-m-l-35 {
        margin-left: 35px !important;
    }
    .sm-m-b-35 {
        margin-bottom: 35px !important;
    }
    .sm-m-t-40 {
        margin-top: 40px !important;
    }
    .sm-m-r-40 {
        margin-right: 40px !important;
    }
    .sm-m-l-40 {
        margin-left: 40px !important;
    }
    .sm-m-b-40 {
        margin-bottom: 40px !important;
    }
    .sm-m-t-45 {
        margin-top: 45px !important;
    }
    .sm-m-r-45 {
        margin-right: 45px !important;
    }
    .sm-m-l-45 {
        margin-left: 45px !important;
    }
    .sm-m-b-45 {
        margin-bottom: 45px !important;
    }
    .sm-m-t-50 {
        margin-top: 50px !important;
    }
    .sm-m-r-50 {
        margin-right: 50px !important;
    }
    .sm-m-l-50 {
        margin-left: 50px !important;
    }
    .sm-m-b-50 {
        margin-bottom: 50px !important;
    }
    .sm-no-margin {
        margin: 0px;
    }
    .sm-no-padding {
        padding: 0px;
    }
    .sm-text-right {
        text-align: right !important;
    }
    .sm-text-left {
        text-align: left !important;
    }
    .sm-text-center {
        text-align: center !important;
    }
    .sm-pull-right {
        float: right !important;
    }
    .sm-pull-left {
        float: left !important;
    }
    .sm-pull-reset {
        float: none !important;
    }
    .sm-block {
        display: block;
    }
    .error-container {
        width: auto;
    }
    .sm-image-responsive-height {
        width: 100%;
        height: auto;
    }
}


/*** Phones ***/

@media (max-width: 480px) {
    body {
        width: 100%;
    }
    body .header {
        width: 100%;
        height: 48px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.07);
    }
    body .header .header-inner {
        height: 48px;
        text-align: center;
    }
    body .header .header-inner .toggle-secondary-sidebar {
        font-size: 16px;
        top: 12px;
    }
    body .header .header-inner .mark-email {
        left: 35px;
        top: 14px;
    }
    body .header .header-inner .quickview-link {
        top: 14px;
    }
    body .header .notification-list, body .header .search-link {
        display: none;
    }
    body .header .dropdown-submenu {
        top: 12px;
    }
    body .header .notification-list, body .header .search-link {
        display: none;
    }
    body #overlay-search {
        font-size: 48px;
        height: 118px;
        line-height: 46px;
    }
    .page-sidebar .sidebar-header {
        height: 48px;
        line-height: 48px;
    }
    .panel .panel-heading {
        padding-left: 15px;
    }
    .panel .panel-body {
        padding: 15px;
        padding-top: 0;
    }
    .error-page {
        padding: 15px;
    }
    .error-page .error-container {
        margin-top: 30px;
        width: auto;
    }
    .error-page .pull-bottom {
        position: relative;
    }
    .map-controls {
        left: 10px;
    }
    .register-container {
        height: auto !important;
    }
    .error-container-innner {
        width: auto;
    }
}


/*** Retina Display Images **/

@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 200/100), only screen and (min-device-pixel-ratio: 2) {
    .icon-set {
        background: url('../img/icons/top_tray_2x.png');
        position: relative;
        background-size: 95px 19px;
    }
    .editor-icon {
        background-image: url("../img/editor_tray_2x.png");
        background-size: 480px 40px;
    }
    .alert .close {
        background: url("../img/icons/noti-cross-2x.png") no-repeat scroll 0 0 transparent;
        background-position: -9px -10px;
        width: 10px;
        height: 9px;
        position: relative;
        opacity: 0.8;
        background-size: 114px 29px;
    }
    .msg_err {
        color: red;
        font-size: 10px;
        text-transform: capitalize;
        font-weight: lighter;
    }
}

.abbr-avatar {
    background: #f7bd0a;
    display: inline-block;
    border-radius: 50%;
    text-align: center;
    color: #fafafa;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: -1px;
}
    </style>
 <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-12  text-left">
                @if(!is_null($cash_entry->BrandID))
                  <div class="media">
                  <img style="margin: 0 !important" src="{{ asset("images/logos/".$cash_entry->brand->LogoLocation) }}" alt="company logo" width="170px" class=" logo"> 
                </div>
                @else
                <div class="media">
                  <img style="margin: 0 !important" src="{{ asset("images/logos/lekkigardens.jpg") }}" alt="company logo" width="170px" class=" logo">
                  <div class="m-t-25">
                    {{-- {!! str_replace(',', ',<br>', $narrations->brand->Address) !!} --}}
                  </div>
                </div>
                @endif
                <div class="m-t-25 address">
                    {!! str_replace(',', ',<br>', $cash_entry->brand->Address ?? '-') !!}
                  </div>
              </div>
              <div class="col-md-6 col-sm-12  text-right">
                <h2>RECEIPT</h2>
                <p class="pb-3"># {{ 'BNKRCPOM'.$cash_entry->CashEntryRef }}</p>
                <ul class="px-0 list-unstyled hide">
                  <li>Balance Due</li>
                  <li class="lead text-bold-800">{{-- 'N' . (number_format(0.00, 2)) --}}</li>
                </ul>
              </div>
            </div> <hr>
            <!--/ Invoice Company Details -->
            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
              <div class="col-sm-12  text-left">
                {{-- <p class="text-muted">Bill To</p> --}}
              </div>
              <div class="col-md-6 col-sm-12  text-left">
                <ul class="px-0 list-unstyled">
                  <li class="text-bold-800"> <span class="text-muted m-r-10">Customer Name:</span> {{ $client_details->Customer ?? '-' }}</li>
                  <li><span class="text-muted m-r-10">Email:</span> <span class="text">{{ $client_details->Email ?? '-' }}</span></li>
                  <li><span class="text-muted m-r-10">Phone No:</span> <span class="">{{ $client_details->Phone ?? '-' }}</span></li>
                  <li></li>
                </ul>
              </div>
              <div class="col-md-6 col-sm-12  text-right">
                <p>
                  <span class="text-muted m-r-10">Receipt Date</span> {{ nice_date($cash_entry->ValueDate) }}</p>
                <p>
                  <span class="text-muted m-r-10">Account Manager</span> <b>{{ $client_details->account_manager->AccountManager ?? 'Somebody Here' }}</b></p>
                <p>
                  <span class="text-muted m-r-10">Contact Number</span>{{ $client_details->account_manager->MobileNumber ?? '-' }}</p>
              </div>
            </div> <hr>
            <!--/ Invoice Customer Details -->
            <!-- Invoice Items Details -->
            
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table ">
                    <thead>
                      <tr>
                        <th width="40%" class="text-left">Product(s)</th>
                        <th class="text-left">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="width: 40%">
                          <p>{!! $cash_entry->product->ProductCategory ?? '-' !!}</p>
                        </td>
                        <td>{!! $cash_entry->Description ?? '-' !!}</td>
                      </tr>
                    </tbody>
                    {{-- <tfoot>
                      <td></td>
                      <td class="text-right"><b>TOTAL</b></td>
                      <td class="text-right"><b>{{ 'N' . (number_format($cash_entry->Amount,2)) }}</b></td>
                    </tfoot> --}}
                  </table>
                </div>
              </div>
            </div>

            <h4 class="text-center semi-bold m-t-15 m-b-15"></h4>
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">S/N</th>
                        <th class="text-left">Description</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="text-center" scope="row">1</th>
                        <td>
                          <p>{!! $narrations->Narration ?? $cash_entry->Narration !!}</p>
                        </td>
                        <td class="text-right">{{ 'N' . (number_format($cash_entry->Amount,2)) }}</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <td></td>
                      <td class="text-right"><b>TOTAL</b></td>
                      <td class="text-right"><b>{{ 'N' . (number_format($cash_entry->Amount,2)) }}</b></td>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <!-- Invoice Footer -->
            <div id="invoice-footer" class="m-t-30">
              <span>Total Payments Received Till Date : </span>
              <span class="semi-bold"> <b>{!! 'N' . (number_format($cash_entry->PaymentToDate, 2)) ?? '-' !!}</b></span> <br>

              <span>Outstanding Balance : </span>
              <span class="semi-bold"> <b>{!! 'N' . (number_format($cash_entry->OutstandingBalance, 2)) ?? '-' !!}</b></span> <br>
              <span>Terms : </span>
              <span> {!! $cash_entry->Terms ?? '-' !!}</span> <br>

              <span>Amount in words : </span>
              <span>
                <b>{{ ucwords($amount_in_words) ?? '-'  }} Naira Only</b>
              </span> <br>
              <span>Bank transfer to : </span>
              <span>
                <b>{{ ucwords($cash_entry->gl_debit->Description) ?? '-' }}</b>
              </span> <br> 
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="row">
                    <div class="col-sm-5 col-xs-6">
                      <div class="text-center">
                        {{-- <p>The Client</p>  --}}
                        
                        <div class="rule" style="height: 70px; border-bottom: 1px solid #eee; margin-right: 10px">
                          {{-- <img src="{{ asset('images/signature-scan.png') }}" width="100"  alt="sample signature"> --}}
                          {{-- <hr> --}}
                        </div>

                        <h5 class="semi-bold">{{ $client_details->Customer ?? '-' }}</h5>

                        {{-- <p class="text-muted">Managing Director</p> --}}
                      </div>
                    </div>

                    <div class="col-sm-5 col-xs-6 col-md-offset-1">
                      <div class="text-center">
                       @if(!is_null($cash_entry->SignatoryID))
                        @if($cash_entry->signatory->SignatureLocation != null)                       
                        <div class="rule" style="height: 70px; border-bottom: 1px solid #eee; margin-right: 10px">
                          <img src="{{ asset("images/".$cash_entry->signatory->SignatureLocation) }}" width="100"  alt="sample signature">
                        </div>
                        @else
                        <div class="rule" style="height: 70px; border-bottom: 1px solid #eee">
                          <img src="{{ asset("images/signature-scan.png") }}" width="100"  alt="sample signature">
                          <hr>
                        </div>
                        @endif

                       
                       @endif
                       @if(!is_null($cash_entry->SignatoryID))
                        <h5 class="semi-bold">{{ $cash_entry->signatory->fullName }} (Accountant)</h5>
                        @else
                         <div class="rule" style="height: 70px">
                          
                          {{-- <hr> --}}
                        </div>
                        <h5 class="semi-bold">No Signatory (Accountant)</h5>
                       @endif

                        {{-- <p class="text-muted">Managing Director</p> --}}
                      </div>
                    </div>


                  </div>
                </div>
                
              </div>
            </div>
            <!--/ Invoice Footer -->
          </div>
        </body>
        </html>