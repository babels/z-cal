
/* backend math for simple calendar, changing day, month, first and last day of month, counting from year 0 */

function
  getmonth
     ( cmnth )
{
  /* get month name by number */

  var cmnth   =  +cmnth -1;
  var months  =  "January,Febuary,March,April,May,June,July,August,September,October,November,December".split(",");
  var mine    =  months[cmnth];

  return mine;
}


function
   cgetmonth
     ( month )
{
  /* get numeric month by alpha */
  var months  =  "January,Febuary,March,April,May,June,July,August,September,October,November,December".split(",");
  var lm  = months.length;
  var i   = 0;
  var chk = '';
  for ( i<lm; chk=months[i]; i++ ) {
     if ( chk == month )
       return i;
  }
  return "error"
}


function
   getday
     ( ii )
{
  /* return day from of week from numberic index */
  ii = +ii -1;
  var days  =  "Mon,Tue,Wed,Thu,Fri,Sat,Sun".split(",");
  var day   =  days[ii];
  if ( day ) {
     return day;
  } else {
    return "Sun";
  }
  return "error";
}


function
  setnull
    ( lts )
{
  /* grey out days over last in month, highlight below */

  // grey out
  if ( lts < 31 ) {
     for( var i=+lts; i<31; i++ ) {
       var k = i + 1;
       var eid = "day" + k;
       console.log("removing " + eid);
       document.getElementById( eid ).setAttribute("style","font-weight: 900;");
       document.getElementById( eid ).setAttribute("style","color: rgba(0,0,0,.3);");
     }
  }

  // highlight
  if ( lts > 28 ) {
    var kts = +lts + 1;
    for ( var j=28; j<kts; j++) {
       var eid = "day" + j;
       document.getElementById( eid ).style = "";
       console.log("highlighting " + eid);
    }
  }

  return;
}


function
  setdays
     ( first, year, month )
{
  /* calculates days of week from first of month, sets form */

  month    =  cgetmonth( month );
  var lst  =  new Date();
  lst.setFullYear( year, month, 0 )
  var lts  =  lst.toString().split(" ")[2];

  setnull( lts );

  var days =  "Mon,Tue,Wed,Thu,Fri,Sat,Sun".split(",");
  var lds  =  days.length;
  var i    =  0;   // loop iter
  var dy   =  "";  // day place holder
  var day  =  "";  // numeric day
  var z    =  1;   // day label

  for( i < lds; dy=days[i]; i++) {
     if ( first == dy ) {
        day = i;
     }
  }

  // outer week limmit / wrapps loop
  var lim = +day +7;
  var k= +day;

  while( day < lim ) {

     if ( k == 7 )
        k = 0;

     eid = "day" + z;
     dy  = days[k];

     document.getElementById( eid ).innerHTML = dy;

     day++;  // actual
     k++;    // offset
     z++;    // label eval id
  }

  return;
}


function
   getfirst
     (mth, yr)
{
  /*get first day of week by month year */

  var dy      =  "1";
  var dt      =  mth + " " + dy + ", " + yr + " 00:00:00";
  var ofweek  =  new Date( dt ).getDay();
  ofweek      =  getday( ofweek );

  return ofweek;
}


function
  monthup()
{
  var nwh    =  ''                                            // new month
  var first  =  ''                                            // first of month
  var nth    =  document.getElementById('hmonth').value;      // old month
  var yer    =  document.getElementById('yearlb').innerHTML;  // current year

  if ( +nth == 12 ) {
     nwh = 1;
  } else {
     nwh = +nth +1;
  }

  var mth = getmonth( nwh );

  document.getElementById('monthlb').innerHTML = mth;
  document.getElementById('hmonth').value      = nwh;

  first = getfirst(mth, yer);
  setdays( first, yer, mth );

  return;
}


function
  monthdown()
{
  var nwh   = ''						// new month
  var first = ''						// first day of week
  var nth   = document.getElementById('hmonth').value;		// old month
  var yer    =  document.getElementById('yearlb').innerHTML;	// current year

  if ( +nth == 1 ) {
     nwh = 12;
  } else {
     nwh = +nth -1;
  }

  var mth = getmonth( nwh );

  document.getElementById('monthlb').innerHTML = mth;
  document.getElementById('hmonth').value = nwh;

  first = getfirst(mth, yer);
  setdays( first, yer, mth );

  return;
}


function
  yearup()
{
  var first  =  ''                                            // first day of week
  var mth    =  document.getElementById('hmonth').value;      // current month
  var cyr    =  document.getElementById('yearlb').innerHTML;
  var nwy    =  +cyr +1;

  document.getElementById('yearlb').innerHTML = nwy;

  first      =  getfirst(mth, nwy);
  setdays( first, cyr, mth );

  return;
}


function
  yeardown()
{
  var first  =  ''                                            // first day of week
  var mth    =  document.getElementById('hmonth').value;      // current month
  var cyr    =  document.getElementById('yearlb').innerHTML;
  var nwy    =  +cyr -1;

  document.getElementById('yearlb').innerHTML = nwy;

  first      =  getfirst(mth, nwy);
  setdays( first ,cyr, nwy);

  return;
}



function
  loadate()
{
  /* load month from text field */

  var nth = document.getElementById('hmonth').value;
  var mth = getmonth( nth );
  var yer = document.getElementById('yearlb').innerHTML;

  document.getElementById('monthlb').innerHTML = mth;

  var first = getfirst(mth, yer);
  setdays( first, yer, mth );

  return;
}


loadate();
