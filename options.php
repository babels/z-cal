<html>

<head>
  <style>

     body{
       line-height: 1.5;

     }


     .wrapper {

       display: grid;
       grid-template-columns: 33% 33% 33%;
       background-color: #fff;
       color: #000;
     }

     .zhide {
       display:none;
     }

     .zshow {
       display:inline;
     }

  </style>

  <script>
     function
     pullevt
        (dx)
     {

        document.getElementById('ttl' ).value  =  document.getElementById('ttl'  + dx).innerHTML;
        document.getElementById('loc' ).value  =  document.getElementById('loc'  + dx).innerHTML;
        document.getElementById('stme').value  =  document.getElementById('stme' + dx).innerHTML;
        document.getElementById('etme').value  =  document.getElementById('etme' + dx).value;
        document.getElementById('dsc' ).value  =  document.getElementById('dsc'  + dx).value;
        document.getElementById('msg' ).value  =  document.getElementById('msg'  + dx).value;
        document.getElementById('utc' ).value  =  document.getElementById('utc'  + dx).value;
        document.getElementById('mps' ).value  =  document.getElementById('mps'  + dx).value;
        document.getElementById('lks' ).value  =  document.getElementById('lks'  + dx).value;
        document.getElementById('zid' ).value  =  document.getElementById('zid'  + dx).value;

        document.getElementById('delete').setAttribute('name','delete');
        console.log("clicked " + dx);
     }
  </script>

</head>

<body>

<?php

  global $wpdb;

  $table_name = $wpdb->prefix . "zcal";
  $table_zevt = $wpdb->prefix . "zevt";

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');


  // UPDATE / INSERT EVENT
  if($_POST['newevt']) {
     $sql = "INSERT INTO " . $table_zevt . " VALUES (0,'" . $_POST['ttl'] . "', '" . $_POST['dsc'] . "', '" . $_POST['msg'] . "','" . $_POST['loc'] . "','" . $_POST['stme'] . "','" . $_POST['etme'] . "','" . $_POST['utc'] . "','" . $_POST['mps'] . "','" . $_POST['lks'] . "');";
     // if not save prog is copy or insert

     if( $_POST['zid'] > 0 ) {
       if( $_POST['newevt'] == "Save" ) {
          echo 'Updated Event';
          $sql = "UPDATE " . $table_zevt . " SET Title='" . $_POST['ttl'] . "', Description='" . $_POST['dsc'] . "', Message='" . $_POST['msg'] . "', Location='" . $_POST['loc'] . "', Begins='" . $_POST['stme'] . "', Ends='" . $_POST['etme'] . "', TZone='" . $_POST['utc'] . "', Maps='" . $_POST['mps'] . "', Links='" . $_POST['lks'] . "' WHERE id='" . $_POST['zid'] . "';";
       }
     }
     echo $sql;
     $wpdb->get_results($sql);
  }


  // DELETE EVENT
  if($_POST['rdelete']) {
       echo "attempting remote delete";
       // REMOTE
       echo "<input type='hidden' id='rdelete' value='" . $_POST['zid'] . "'></input>";
  }

  if($_POST['delete']) {
       // LOCAL
       echo "deleting event";
       $sql = "DELETE FROM " . $table_zevt . " WHERE id='" . $_POST['zid'] . "';";
       echo $sql;
       $wpdb->get_results($sql);
  }


  if($_POST['submit']) {
    echo 'settings saved';
    $sql = "UPDATE " . $table_name . " SET  ApiKy='" . $_POST['ApiKy'] . "', Theme='" . $_POST['Theme'] . "', Style='" . $_POST['Style'] . "', CalGui='" . $_POST['CalGui'] . "', Images='" . $_POST['Images'] . "', ImgRes='" . $_POST['ImgRes'] . "' WHERE id=1;";
    echo $sql;
    $wpdb->get_results($sql);
 
   //  echo  htmlspecialchars($_POST['Theme']);
  }


  $sql = "SELECT * FROM $table_name;";

  $result = $wpdb->get_results($sql) or die(mysql_error());

  echo '<h1>A-Calendar Plugin</h1><br>';


/*
// Print last SQL query string
echo $wpdb->last_query;
// Print last SQL query result
echo $wpdb->last_result;
// Print last SQL query Error
echo $wpdb->last_error; */

  echo '<hr><br><label id="hlbl"></label><br>';

  foreach( $result as $results ) {
     // Hidden Control Elements

     echo '<input id="theme" type="hidden" value="';
     echo $results->Theme;
     echo '"/>';

     echo '<input id="cstyle" type="hidden" value="';
     echo $results->Style;
     echo '"/>';

     echo '<input id="calwig" type="hidden" value="';
     echo $results->CalGui;
     echo '"/>';

     echo '<input id="imgs" type="hidden" value="';
     echo $results->Images;
     echo '"/>';

     echo '<input id="imgr" type="hidden" value="';
     echo $results->ImgRes;
     echo '"/>';

     // Start Form
     echo '<form id="setopt" action="" method="POST">';
     echo '<div class="wrapper"><div class="box a">';
     echo 'API KEY:';
     echo '<input id="apiky" name="ApiKy" type="text" value="';
     echo $results->ApiKy;
     echo '"/>';

     echo '<svg width="24" height="24" version="1.0" id="chxapi" display="none">';
     echo '<g transform="matrix(0.05405906,0,0,0.05747228,62.781779,2.5215255)">';
     echo '<g transform="matrix(0.4801848,0,0,0.4801848,-316.23146,468.10984)">';
     echo '<path style="fill:#139e1c;fill-opacity:1;stroke:#000000;stroke-width:19.89183235;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m -1747.2444,-549.29769 287.7212,333.8986 c 146.6009,-298.83075 326.0615,-573.74326 614.51553,-834.74651 -215.88563,121.81746 -453.85923,353.1417 -657.14093,639.3803 z" /></g></g></svg>';

     echo '<svg version="1.1" width="24" height="24" viewBox="0 0 24 24" id="qstapi" display="">';
     echo '<path style="fill:#ffcc00;stroke-width:0.02963728"';
     echo 'd="M 10.01444,24.104419 C 8.220417,23.906462 6.9811604,23.013822 6.9811604,21.919542 c 0,-0.572483 0.3243142,-1.083059 0.9436711,-1.485641 0.1549954,-0.100753 0.3882138,-0.22943 0.5182638,-0.285963 0.7000594,-0.304316 1.6935387,-0.466697 2.4745277,-0.404453 0.924214,0.07366 1.626674,0.274873 2.217538,0.635195 0.455363,0.277693 0.797025,0.633503 0.968708,1.008829 0.105886,0.231485 0.09512,0.891402 -0.01869,1.145027 -0.48544,1.081902 -2.269177,1.770674 -4.070754,1.571883 z M 9.3988566,18.784767 C 9.0070468,18.739617 8.7026959,18.67642 8.2824815,18.552954 7.0681917,18.196178 6.3283114,17.531909 6.0805882,16.576082 5.9932248,16.239 5.9930531,15.583579 6.0801977,15.238872 c 0.1387705,-0.548687 0.5024217,-1.177819 1.0064404,-1.741186 0.6053635,-0.676647 1.2850592,-1.240525 3.0230639,-2.507948 0.348923,-0.254451 0.787678,-0.58322 0.975008,-0.730599 1.699381,-1.3369624 2.660521,-2.7399523 2.981302,-4.3518504 0.08599,-0.4321071 0.0868,-1.2637186 0.0015,-1.630898 -0.126615,-0.5456621 -0.4031,-1.099547 -0.7191,-1.4406328 C 12.873411,2.3230204 12.165047,1.9520894 11.421192,1.8265619 11.0512,1.7641248 10.179671,1.7700277 9.7714508,1.8377232 8.777153,2.0026332 8.083011,2.4068945 7.7138956,3.036019 7.5233428,3.3608004 7.4603471,3.6355351 7.4840117,4.0386034 7.5052087,4.3996622 7.5312979,4.4971626 7.7068403,4.8713504 7.8312076,5.1364517 7.9931704,5.3876475 8.2585006,5.7269384 8.5212265,6.0629003 8.5157234,6.035569 8.3401224,6.1322136 7.8298918,6.4130219 6.6570063,6.7382791 5.7633331,6.8467956 4.8128215,6.9622117 3.6802094,6.9540317 2.8584594,6.8258175 1.9983172,6.6916107 1.191035,6.3429958 0.72059819,5.9026107 -0.0709082,5.1616661 -0.12549189,4.1134846 0.57853224,3.1744898 1.0130562,2.5949403 1.8515776,2.0334708 2.9913617,1.5588697 4.2677928,1.0273715 5.709462,0.6608239 7.4720817,0.419635 8.9447422,0.21812321 10.34309,0.12928934 12.041261,0.12935978 c 1.790681,0 3.13746,0.0872995 4.476433,0.28991883 3.004923,0.45471986 5.328376,1.48414699 6.450843,2.85810639 0.485852,0.5947101 0.754626,1.2074853 0.830113,1.8925528 0.09405,0.8535159 -0.173263,1.6584022 -0.819913,2.4688029 -0.330288,0.4139246 -1.115624,1.1164106 -1.832558,1.6392311 -0.373519,0.2723858 -1.445634,0.9362792 -1.902713,1.1782312 -0.618045,0.327157 -2.241433,1.08841 -4.252888,1.9943 -2.688326,1.210732 -3.032016,1.383579 -3.578952,1.799912 -0.685352,0.5217 -0.975397,0.95142 -0.977051,1.44757 -0.002,0.565385 0.463287,0.969369 1.287794,1.118393 0.152805,0.02762 0.366614,0.03728 0.825172,0.03728 h 0.618924 l 0.02263,0.05491 c 0.02306,0.05598 -0.06518,0.411938 -0.235866,0.951324 -0.10986,0.347193 -0.209805,0.478308 -0.475541,0.623852 -0.210146,0.1151 -0.540997,0.196792 -1.085124,0.267936 -0.49404,0.06459 -1.5659514,0.08237 -1.9937696,0.03308 z" /></svg>';





     echo '</div>';
  }


?>

  <div class="box b">THEME:
  <select id="caltheme" name="Theme"  style="margin-left:15%">
     <option value="Light">Light</option>
     <option value="Dark">Dark</option>
     <option value="Transparent">Transparent</option>
  </select></div>

  <div class="box c">
  STYLE:
  <select id="calstyle" name="Style"  style="margin-left:15%">
     <option value="Events" selected>Events</option>
     <option value="Schedual">Schedual</option>
  </select></div>

  <div class="box a">
  CALENDAR:
  <select id="calgui" name="CalGui">
     <option value="Hidden" selected>Hidden</option>
     <option value="Shown">Shown</option>
     <option value="Hourly">Hourly</option>
  </select></div>

  <div class="box b">
  IMAGES:
  <select id="calimgs" name="Images"  style="margin-left:15%">
     <option value="Horizontal" selected>Horizontal</option>
     <option value="Verticle">Verticle</option>
     <option value="Hidden">Hidden</option>
  </select></div>

  <div class="box c">
  RESOLUTION:
     <input type="text" id="imgres" name="ImgRes" value="250x250"></input>
  </div>

  <div class="box a">
     <label>Connections Per Day: </label><label id="climmit">100</label></div>

  <div class="box b">
     <label>Membership: <label><label id="ismember">Guest</label></div>

  <div class="box c">
     <input type="submit" name="submit" value="submit"></input></div>
  </div>

</form>


<h1>New Event</h1><br>
<hr>

<!--New Local Event-->
<form id="newevt" action="" method="POST">
<input type="hidden" id="apk2" value=""></input>
<div class="wrapper">
  <div class="box a"> Title:          <input type="text" id="ttl"  name="ttl" value=""></input></div>
  <div class="box b"> Description:    <input type="text" id="dsc"  name="dsc" value=""></input></div>
  <div class="box c"> Message:        <input type="text" id="msg"  name="msg" value=""></input></div>

  <div class="box a"> Location:       <input type="text" id="loc"  name="loc" value=""></input></div>
  <div class="box b"> Begins:         <input type="datetime-local" id="stme" name="stme" value=""></input></div>
  <div class="box c"> Ends:           <input type="datetime-local" id="etme" name="etme" value=""></input></div>

  <div class="box a"> Time Zone:      <input type="text" id="utc"  name="utc" value=""></input></div>
  <div class="box b"> Maps:           <input type="text" id="mps"  name="mps" value=""></input></div>
  <div class="box c"> Images & Links: <textarea id="lks" name="lks" value=""></textarea></input></div>
  <!--<input type="text" id="lks"  name="lks" value=""></input></div> -->


  <input type="hidden" id="zid" name="zid" value="0"></input>

  <div class="box a"><input type="submit" name="newevt"  value="Save"></input></div>
  <div class="box b"><input type="submit" name="newevt"  value="Copy"></input></div>
  <div class="box c"><input type="submit" name="delete"  value="Delete" id='delete'></input></div>
</div>
</form>


<h1>Events</h1><br>
<hr>

<div id="evtbx" class="wrapper">

  <?php
  error_reporting( 0 );
  global $wpdb;

  $table_zevt = $wpdb->prefix . "zevt";
  $sql = "SELECT * FROM $table_zevt;";

  $result = $wpdb->get_results($sql) or die(mysql_error());

  $i=1;
  foreach( $result as $results ) {
    // EVENTS
    //echo $i . '<br>';

    echo "<div class='box a'><center><label id='ttl$i'  class='locev' onclick='pullevt($i);'>" . $results->Title       . "</label></center></div>";
    echo "<div class='box b'><center><label id='loc$i'  class='locev' onclick='pullevt($i);'>" . $results->Location    . "</label></center></div>";
    echo "<div class='box c'><center><label id='stme$i' class='locev' onclick='pullevt($i);'>" . $results->Begins      . "</label></center></div>";

    echo "<input type='hidden' id='dsc$i'  class='locev'  onclick='pullevt($i);' value='" . $results->Description . "'></input>";
    echo "<input type='hidden' id='msg$i'  class='locev'  onclick='pullevt($i);' value='" . $results->Message     . "'></input>";
    echo "<input type='hidden' id='etme$i' class='locev'  onclick='pullevt($i);' value='" . $results->Ends        . "'></input>";
    echo "<input type='hidden' id='utc$i'  class='locev'  onclick='pullevt($i);' value='" . $results->TZone       . "'></input>";
    echo "<input type='hidden' id='mps$i'  class='locev'  onclick='pullevt($i);' value='" . $results->Maps        . "'></input>";
    echo "<input type='hidden' id='lks$i'  class='locev'  onclick='pullevt($i);' value='" . $results->Links       . "'></input>";
    echo "<input type='hidden' id='zid$i'  class='locev'  onclick='pullevt($i);' value='" . $results->id          . "'></input>";

    $i++;
  }
  echo "<input type='hidden' id='ttlevts' value='" . $i . "'></input>";
  ?>





<script>
  function setsel( oid, opt ) {
     /* set the value of option as selected at id */

     var optionsToSelect = [opt];
     var select = document.getElementById( oid );

     for ( var i = 0, l = select.options.length, o; i < l; i++ ) {
       o = select.options[i];

       if ( optionsToSelect.indexOf( o.text ) != -1 ) {
          o.selected = true;

       }
     }
  }

  function shead( txt ) {
     document.getElementById('hlbl').innerHTML = txt;
  }

  function tglid( prog, id ) {
    /* add remove class to id via hide show prog*/

    var obj = document.getElementById( id );
    if( obj ) {

      if( prog == "hide" ) {
         obj.classList.add("zhide");
         obj.classList.remove("zshow");
      }

      if( prog == "show" ) {
         obj.classList.add("zshow");
         obj.classList.remove("zhide");
      }

    } else {
      console.log("bad object refference " + id );
    }
  }

  function setrem() {
     /* initializes remote calendar events by apiky */

  function pullrem(dx)
     {
        console.log("some thing");

        document.getElementById('ttl' ).value  =  document.getElementById('ttl'  + dx).innerHTML;
        document.getElementById('loc' ).value  =  document.getElementById('loc'  + dx).innerHTML;
        document.getElementById('stme').value  =  document.getElementById('stme' + dx).innerHTML;
        document.getElementById('etme').value  =  document.getElementById('etme' + dx).value;
        document.getElementById('dsc' ).value  =  document.getElementById('dsc'  + dx).value;
        document.getElementById('msg' ).value  =  document.getElementById('msg'  + dx).value;
        document.getElementById('utc' ).value  =  document.getElementById('utc'  + dx).value;
        document.getElementById('mps' ).value  =  document.getElementById('mps'  + dx).value;
        document.getElementById('lks' ).value  =  document.getElementById('lks'  + dx).value;
        document.getElementById('zid' ).value  =  document.getElementById('zid'  + dx).value;

        document.getElementById('delete').setAttribute('name','rdelete');


        console.log("clicked " + dx);
     }

     function newhide( key, val, par ) {
         inpt = document.createElement("input");
         inpt.setAttribute("id", key + tv);
         inpt.setAttribute("type","hidden");
         inpt.setAttribute("value", val);
         par.appendChild( inpt );
     }


     var apk = document.getElementById('apiky').value;
     var apl = apk.length;

     if( apl == 64 ) {
       console.log("apiky looks goods");

       var url   =  "https://z-calendar.club/cgi-bin/lsevt?hellasecret";
       var req   =  new XMLHttpRequest();

       var data  =  {};
       var dic   =  {};

       data.apky =  apk;

       var json  =  JSON.stringify(data);
       var req   =  new XMLHttpRequest();

      
       req.open("POST", url, false);
       req.setRequestHeader("Content-type","application/json; charset=utf-8");

       req.send(json);

       var status = req.status;

       console.log("state" + req.readyState);
       console.log("status " + status);

       var txt = req.responseText;
       console.log("response text");

       var tok = txt.split("},{")
       for (var i = 0; i < tok.length; i++){
         var dic = {}
         var obj = tok[i];
         console.log("line " + obj);
         var tik = obj.split(",");

         for (var j  =  0; j < tik.length; j++){
            var row  =  tik[j];
            var key  =  row.split(":")[0];
            var val  =  row.split(":")[1];

            key      =  key.substring(2, key.length-1);
            val      =  val.substring(2, val.length-1);

//            if( key.includes('zid') ) key="zid";
            console.log("key " + key + " val " + val);
            dic[key] =  val;
         }

         // event variables
         var usr     =  dic.usr;		// user
         var ttl     =  dic.ttl;		// registerd domain
         var dsc     =  dic.dsc;		// verified txt record?
         var msg     =  dic.msg;		// premium?
         var loc     =  dic.loc;		// daily limmit left
         var stme    =  dic.stme;		// apiky
         var etme    =  dic.etme;		// email ky
         var utc     =  dic.utc;		// utc
         var mps     =  dic.mps;		// email ky
         var lks     =  dic.lks;		// links
         var zid     =  dic.zid;		// uid
         var lln     =  lks.length;

//         zid = 'zid' + zid.substring(0, zid.length - 1);


         if( lln > 3 ) {
            lks = lks.substring(0, lks.length-3);
         }

         var wrp  =  document.getElementById( 'evtbx' );
         var tv   =  document.getElementById('ttlevts').value;
         tv = +tv +1;

         ttl = atob( ttl );
         var boxa = document.createElement('div');
         boxa.setClass = "box a";
         var inpt = document.createElement('label');
         inpt.setAttribute("id", "ttl" + tv);
         inpt.onclick = function() { pullrem(tv); };
         // inpt.setAttribute("onlick", "function() { pullrem(" + tv + "); }");
         inpt.setClass  = "remev";
         inpt.innerHTML = ttl;
         boxa.appendChild( inpt );
         wrp.append(boxa);

         loc = atob( loc );
         var boxb = document.createElement('div');
         boxb.setClass = "box b";
         inpt = document.createElement('label');
         inpt.setAttribute("id", "loc" + tv);
         inpt.setAttribute("onlick", "function() { pullrem(" + tv + "); }");
         inpt.setClass  = "remev";
         inpt.innerHTML = loc;
         boxb.appendChild( inpt );
         wrp.append(boxb);

         var boxc = document.createElement('div');
         boxc.setClass = "box c";
         inpt = document.createElement('label');
         inpt.setAttribute("id", "stme" + tv);
         inpt.setAttribute("onlick",  "function() { pullrem(" + tv + "); }");
         inpt.setClass  = "remev";
         inpt.innerHTML = stme;
         boxc.appendChild( inpt );
         wrp.append(boxc);

         dsc = atob( dsc );
         msg = atob( msg );
//         mps = atob( mps );
//         lks = atob( lks );

         newhide("dsc",  dsc,  wrp);
         newhide("msg",  msg,  wrp);
         newhide("etme", etme, wrp);
         newhide("utc",  utc,  wrp);
         newhide("mps",  mps,  wrp);
         newhide("lks",  lks,  wrp);
         newhide("zid",  zid,  wrp);

/*         var ettl = document.createElement("input");
         ettl.setAttribute("id", "ttl" + tv);
         ettl.className = "retev"; */

//         console.log("usr " + usr + '\n' + " ttl " + ttl + '\n' + " dsc " + dsc +  '\n' + " msg " + msg + '\n' + " loc " + loc +  '\n' + " stme  " + stme + '\n' + " etme " + etme +  '\n' + " utc " + utc +  '\n' + " mps " + mps +  '\n' + " lks " + lks);
       }


     } else {
        console.log("bad apiky");
        shead("Check Your Api Key!");
     }
  }


  function delrvt(rid) {
     var url   =  'https://z-calendar.club/cgi-bin/delevt?hellasecret';
     var req   =  new XMLHttpRequest();
     var zid   =  document.getElementById('zid').value;

     var data  =  {};

     data.apky =  document.getElementById('apk2').value;
     data.rid  =  rid.substr(3);

     var json  =  JSON.stringify(data);
     var req   =  new XMLHttpRequest();

     req.open('POST', url, false);
     req.setRequestHeader('Content-type','application/json; charset=utf-8');

     req.send(json);

     var status = req.status;

     console.log('state' + req.readyState);
     console.log('status ' + status);

     var txt = req.responseText;
     console.log('response text');
  }



  function setopt() {
     /* bring backend control values to frontend form */

     var apk  =  document.getElementById( 'apiky'  ).value;
     var thm  =  document.getElementById( 'theme'  ).value;
     var sty  =  document.getElementById( 'cstyle' ).value;
     var wig  =  document.getElementById( 'calwig' ).value;
     var igs  =  document.getElementById( 'imgs'   ).value;
     var igr  =  document.getElementById( 'imgr'   ).value;

     setsel( 'caltheme', thm );
     setsel( 'calstyle', sty );
     setsel(   'calgui', wig );
     setsel(  'calimgs', igs );

     document.getElementById('imgres').value = igr;
     var apl = apk.length;

     if( apl == 64 ) {
       tglid('show', 'chxapi');
       tglid('hide', 'qstapi');
	// move the apk from settings to event form for remote
       document.getElementById('apk2').value = apk;
     }

     var rdl = document.getElementById('rdelete');
     if( rdl ) {
        var rid = rdl.value;
        console.log("deleting remote event");
        delrvt( rid );
     } else {
        console.log("not deleting remote event");
     }
  }


  shead("SHWAY");

  var apk = document.getElementById('apiky').value;
  var aln = apk.length;

  if( aln < '64' ) {
     shead("Signup For Free Api Key");
  }

  setopt();
  /* else {
     shead("api key looks good");
  } */
  setrem();

</script>

</body>
</html>

