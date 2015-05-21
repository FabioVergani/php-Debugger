<?php
$debug=(int)$_GET['debugme'];
if($debug===1){
 function trace($o,$t){printf('<pre>'.(isset($t)?'<b>'.$t.'</b>:':'').'%s<pre>',print_r($o,true));};
}else{
 function trace(){};//dummy!
};
//=======================================================================================


//=======================================================================================
if($debug===1){//list-defined-vars
 echo('<span style="text-align:left;">');

  $a=get_defined_vars();
  unset($a['GLOBALS'],$a['debug']);

  echo('<hr>');
  $i='_SERVER';
  $c=$a[$i];
  unset($a[$i]);

  foreach(array('_POST','_GET','_COOKIE','_FILES') as $i){
   $b[$i]=$a[$i];
   unset($a[$i]);
  };
  unset($i);
  trace($a,'other user-defined vars');

  $a=get_defined_constants(true);
  $a=$a['user'];

  //$m=array('tokenizer','tokenized','user_agent');
  //foreach($m as $i){unset($a[$i]);};
  //unset($i);
  //echo('<small>+ '.implode(',',$m).' ...</small>');
  //unset($m);

  trace($a,'user-defined constants');
  unset($a);

  trace($b,'globals');
  unset($b);

  $h=apache_request_headers();
  $m=array('User-Agent',$user_ip[1]);
  foreach($m as $i){unset($h[$i]);};
  unset($i);
  trace($h,'headers');
  unset($h);
  echo('<small>+ '.implode(',',$m).' ...</small>');
  unset($m);

  $a='SERVER_SIGNATURE';
  $b=$c[$a];
  $m=array($a,'HTTP_X_FORWARDED_FOR');
  foreach($m as $i){unset($c[$i]);};
  unset($i);
  trace($c,$a.':'.$b);unset($c,$b,$a);
  echo('<small>+ '.implode(',',$m).' ...</small>');
  unset($m,$a,$b);

 echo('</span>');
};
?>
