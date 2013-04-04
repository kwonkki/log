<?
##################################

##################################

/**

* This class checks the availability of a domain and gets the whois data

* You can check domains of the following tld's

* (PLEASE CONTACT ME IF A WHOIS SERVER ISN'T RIGHT!)

* - ac

* - ac.cn

* - ac.jp

* - ac.uk

* - ad.jp

* - adm.br

* - adv.br

* - aero

* - ag

* - agr.br

* - ah.cn

* - al

* - am.br

* - arq.br

* - at

* - au

* - art.br

* - as

* - asn.au

* - ato.br

* - be

* - bg

* - bio.br

* - biz

* - bj.cn

* - bmd.br

* - br

* - ca

* - cc

* - cd

* - ch

* - cim.br

* - ck

* - cl

* - cn

* - cng.br

* - cnt.br

* - com

* - com.au

* - com.br

* - com.cn

* - com.eg

* - com.hk

* - com.mx

* - com.ru

* - com.tw

* - conf.au

* - co.jp

* - co.uk

* - cq.cn

* - csiro.au

* - cx

* - cz

* - de

* - dk

* - ecn.br

* - ee

* - edu

* - edu.au

* - edu.br

* - eg

* - es

* - esp.br

* - etc.br

* - eti.br

* - eun.eg

* - emu.id.au

* - eng.br

* - far.br

* - fi

* - fj

* - fj.cn

* - fm.br

* - fnd.br

* - fo

* - fot.br

* - fst.br

* - fr

* - g12.br

* - gd.cn

* - ge

* - ggf.br

* - gl

* - gr

* - gr.jp

* - gs

* - gs.cn

* - gov.au

* - gov.br

* - gov.cn

* - gov.hk

* - gob.mx

* - gs

* - gz.cn

* - gx.cn

* - he.cn

* - ha.cn

* - hb.cn

* - hi.cn

* - hl.cn

* - hn.cn

* - hm

* - hk

* - hk.cn

* - hu

* - id.au

* - ie

* - ind.br

* - imb.br

* - inf.br

* - info

* - info.au

* - it

* - idv.tw

* - int

* - is

* - il

* - jl.cn

* - jor.br

* - jp

* - js.cn

* - jx.cn

* - kr

* - la

* - lel.br

* - li

* - lk

* - ln.cn

* - lt

* - lu

* - lv

* - ltd.uk

* - mat.br

* - mc

* - med.br

* - mil

* - mil.br

* - mn

* - mo.cn

* - ms

* - mus.br

* - mx

* - name

* - ne.jp

* - net

* - net.au

* - net.br

* - net.cn

* - net.eg

* - net.hk

* - net.lu

* - net.mx

* - net.uk

* - net.ru

* - net.tw

* - nl

* - nm.cn

* - no

* - nom.br

* - not.br

* - ntr.br

* - nx.cn

* - nz

* - plc.uk

* - odo.br

* - oop.br

* - or.jp

* - org

* - org.au

* - org.br

* - org.cn

* - org.hk

* - org.lu

* - org.ru

* - org.tw

* - org.uk

* - pl

* - pp.ru

* - ppg.br

* - pro.br

* - psi.br

* - psc.br

* - pt

* - qh.cn

* - qsl.br

* - rec.br

* - ro

* - ru

* - sc.cn

* - sd.cn

* - se

* - sg

* - sh

* - sh.cn

* - si

* - sk

* - slg.br

* - sm

* - sn.cn

* - srv.br

* - st

* - sx.cn

* - tc

* - th

* - tj.cn

* - tmp.br

* - to

* - tr

* - trd.br

* - tur.br

* - tv // ! .tv domains are limited in requests of WHOIS information at the server whois.tv up to 20 requests

* - tv.br

* - tw

* - tw.cn

* - uk

* - va

* - vet.br

* - vg

* - wattle.id.au

* - ws

* - xj.cn

* - xz.cn

* - yn.cn

* - zlg.br

* - zj.cn

*

* @author    Sven Wagener <sven.wagener@intertribe.de>

* @copyright Intertribe Limited

* @include          Funktion:_include_

*/

class domain{

    var $domain="";



        /*******************************

        * Initializing server variables

        * array(top level domain,whois_Server,not_found_string or MAX number of CHARS: MAXCHARS:n)

        **/

        var $servers=array(

            array("ac","whois.nic.ac","No match"),

                array("ac.cn","whois.cnnic.net.cn","No entries found"),

                array("ac.jp","whois.nic.ad.jp","No match"),

                array("ac.uk","whois.ja.net","no entries"),

                array("ad.jp","whois.nic.ad.jp","No match"),

                array("adm.br","whois.nic.br","No match"),

                array("adv.br","whois.nic.br","No match"),

                array("aero","whois.information.aero","is available"),

                array("ag","whois.nic.ag","does not exist"),

                array("agr.br","whois.nic.br","No match"),

                array("ah.cn","whois.cnnic.net.cn","No entries found"),

                array("al","whois.ripe.net","No entries found"),

                array("am.br","whois.nic.br","No match"),

                array("arq.br","whois.nic.br","No match"),

                array("at","whois.nic.at","nothing found"),

                array("au","whois.aunic.net","No Data Found"),

                array("art.br","whois.nic.br","No match"),

                array("as","whois.nic.as","Domain Not Found"),

                array("asn.au","whois.aunic.net","No Data Found"),

                array("ato.br","whois.nic.br","No match"),

                array("be","whois.geektools.com","No such domain"),

                array("bg","whois.digsys.bg","does not exist"),

                array("bio.br","whois.nic.br","No match"),

                array("biz","whois.biz","Not found"),

                array("bj.cn","whois.cnnic.net.cn","No entries found"),

                array("bmd.br","whois.nic.br","No match"),

                array("br","whois.registro.br","No match"),

                array("ca","whois.cira.ca","Status: AVAIL"),

                array("cc","whois.nic.cc","No match"),

                array("cd","whois.cd","No match"),

                array("ch","whois.nic.ch","We do not have an entry"),

                array("cim.br","whois.nic.br","No match"),

                array("ck","whois.ck-nic.org.ck","No entries found"),

                array("cl","whois.nic.cl","no existe"),

                array("cn","whois.cnnic.net.cn","No entries found"),

                array("cng.br","whois.nic.br","No match"),

                array("cnt.br","whois.nic.br","No match"),

                array("com","whois.verisign-grs.net","No match"),

                array("com.au","whois.aunic.net","No Data Found"),

                array("com.br","whois.nic.br","No match"),

                array("com.cn","whois.cnnic.net.cn","No entries found"),

                array("com.eg","whois.ripe.net","No entries found"),

                array("com.hk","whois.hknic.net.hk","No Match for"),

                array("com.mx","whois.nic.mx","Nombre del Dominio"),

                array("com.ru","whois.ripn.ru","No entries found"),

                array("com.tw","whois.twnic.net","NO MATCH TIP"),

                array("conf.au","whois.aunic.net","No entries found"),

                array("co.jp","whois.nic.ad.jp","No match"),

                array("co.uk","whois.nic.uk","No match for"),

                array("cq.cn","whois.cnnic.net.cn","No entries found"),

                array("csiro.au","whois.aunic.net","No Data Found"),

                array("cx","whois.nic.cx","No match"),

                array("cz","whois.nic.cz","No data found"),

                array("de","whois.denic.de","No entries found"),

                array("dk","whois.dk-hostmaster.dk","No entries found"),

                array("ecn.br","whois.nic.br","No match"),

                array("ee","whois.eenet.ee","NOT FOUND"),

                array("edu","whois.verisign-grs.net","No match"),

                array("edu.au","whois.aunic.net","No Data Found"),

                array("edu.br","whois.nic.br","No match"),

                array("eg","whois.ripe.net","No entries found"),

                array("es","whois.ripe.net","No entries found"),

                array("esp.br","whois.nic.br","No match"),

                array("etc.br","whois.nic.br","No match"),

                array("eti.br","whois.nic.br","No match"),

                array("eun.eg","whois.ripe.net","No entries found"),

                array("emu.id.au","whois.aunic.net","No Data Found"),

                array("eng.br","whois.nic.br","No match"),

                array("far.br","whois.nic.br","No match"),

                array("fi","whois.ripe.net","No entries found"),

                array("fj","whois.usp.ac.fj",""),

                array("fj.cn","whois.cnnic.net.cn","No entries found"),

                array("fm.br","whois.nic.br","No match"),

                array("fnd.br","whois.nic.br","No match"),

                array("fo","whois.ripe.net","no entries found"),

                array("fot.br","whois.nic.br","No match"),

                array("fst.br","whois.nic.br","No match"),

                array("fr","whois.nic.fr","No entries found"),

                array("g12.br","whois.nic.br","No match"),

                array("gd.cn","whois.cnnic.net.cn","No entries found"),

                array("ge","whois.ripe.net","no entries found"),

                array("ggf.br","whois.nic.br","No match"),

                array("gl","whois.ripe.net","no entries found"),

                array("gr","whois.ripe.net","no entries found"),

                array("gr.jp","whois.nic.ad.jp","No match"),

                array("gs","whois.adamsnames.tc","is not registered"),

                array("gs.cn","whois.cnnic.net.cn","No entries found"),

                array("gov.au","whois.aunic.net","No Data Found"),

                array("gov.br","whois.nic.br","No match"),

                array("gov.cn","whois.cnnic.net.cn","No entries found"),

                array("gov.hk","whois.hknic.net.hk","No Match for"),

                array("gob.mx","whois.nic.mx","Nombre del Dominio"),

                array("gs","whois.adamsnames.tc","is not registered"),

                array("gz.cn","whois.cnnic.net.cn","No entries found"),

                array("gx.cn","whois.cnnic.net.cn","No entries found"),

                array("he.cn","whois.cnnic.net.cn","No entries found"),

                array("ha.cn","whois.cnnic.net.cn","No entries found"),

                array("hb.cn","whois.cnnic.net.cn","No entries found"),

                array("hi.cn","whois.cnnic.net.cn","No entries found"),

                array("hl.cn","whois.cnnic.net.cn","No entries found"),

                array("hn.cn","whois.cnnic.net.cn","No entries found"),

                array("hm","whois.registry.hm","(null)"),

                array("hk","whois.hknic.net.hk","No Match for"),

                array("hk.cn","whois.cnnic.net.cn","No entries found"),

                array("hu","whois.ripe.net","MAXCHARS:500"),

                array("id.au","whois.aunic.net","No Data Found"),

                array("ie","whois.domainregistry.ie","no match"),

                array("ind.br","whois.nic.br","No match"),

                array("imb.br","whois.nic.br","No match"),

                array("inf.br","whois.nic.br","No match"),

                array("info","whois.afilias.info","Not found"),

                array("info.au","whois.aunic.net","No Data Found"),

                array("it","whois.nic.it","No entries found"),

                array("idv.tw","whois.twnic.net","NO MATCH TIP"),

                array("int","whois.iana.org","not found"),

                array("is","whois.isnic.is","No entries found"),

                array("il","whois.isoc.org.il","No data was found"),

                array("jl.cn","whois.cnnic.net.cn","No entries found"),

                array("jor.br","whois.nic.br","No match"),

                array("jp","whois.nic.ad.jp","No match"),

                array("js.cn","whois.cnnic.net.cn","No entries found"),

                array("jx.cn","whois.cnnic.net.cn","No entries found"),

                array("kr","whois.krnic.net","is not registered"),

                array("la","whois.nic.la","NO MATCH"),

                array("lel.br","whois.nic.br","No match"),

                array("li","whois.nic.ch","We do not have an entry"),

                array("lk","whois.nic.lk","No domain registered"),

                array("ln.cn","whois.cnnic.net.cn","No entries found"),

                array("lt","ns.litnet.lt","No matches found"),

                array("lu","whois.dns.lu","No entries found"),

                array("lv","whois.ripe.net","no entries found"),

                array("ltd.uk","whois.nic.uk","No match for"),

                array("mat.br","whois.nic.br","No match"),

                array("mc","whois.ripe.net","No entries found"),

                array("med.br","whois.nic.br","No match"),

                array("mil","whois.nic.mil","No match"),

                array("mil.br","whois.nic.br","No match"),

                array("mn","whois.nic.mn","Domain not found"),

                array("mo.cn","whois.cnnic.net.cn","No entries found"),

                array("ms","whois.adamsnames.tc","is not registered"),

                array("mus.br","whois.nic.br","No match"),

                array("mx","whois.nic.mx","Nombre del Dominio"),

                array("name","whois.nic.name","No match"),

                array("ne.jp","whois.nic.ad.jp","No match"),

                array("net","whois.verisign-grs.net","No match"),

                array("net.au","whois.aunic.net","No Data Found"),

                array("net.br","whois.nic.br","No match"),

                array("net.cn","whois.cnnic.net.cn","No entries found"),

                array("net.eg","whois.ripe.net","No entries found"),

                array("net.hk","whois.hknic.net.hk","No Match for"),

                array("net.lu","whois.dns.lu","No entries found"),

                array("net.mx","whois.nic.mx","Nombre del Dominio"),

                array("net.uk","whois.nic.uk","No match for "),

                array("net.ru","whois.ripn.ru","No entries found"),

                array("net.tw","whois.twnic.net","NO MATCH TIP"),

                array("nl","whois.domain-registry.nl","is not a registered domain"),

                array("nm.cn","whois.cnnic.net.cn","No entries found"),

                array("no","whois.norid.no","no matches"),

                array("nom.br","whois.nic.br","No match"),

                array("not.br","whois.nic.br","No match"),

                array("ntr.br","whois.nic.br","No match"),

                array("nx.cn","whois.cnnic.net.cn","No entries found"),

                array("nz","whois.domainz.net.nz","Not Listed"),

                array("plc.uk","whois.nic.uk","No match for"),

                array("odo.br","whois.nic.br","No match"),

                array("oop.br","whois.nic.br","No match"),

                array("or.jp","whois.nic.ad.jp","No match"),

                array("org","whois.verisign-grs.net","No match"),

                array("org.au","whois.aunic.net","No Data Found"),

                array("org.br","whois.nic.br","No match"),

                array("org.cn","whois.cnnic.net.cn","No entries found"),

                array("org.hk","whois.hknic.net.hk","No Match for"),

                array("org.lu","whois.dns.lu","No entries found"),

                array("org.ru","whois.ripn.ru","No entries found"),

                array("org.tw","whois.twnic.net","NO MATCH TIP"),

                array("org.uk","whois.nic.uk","No match for"),

                array("pl","nazgul.nask.waw.pl","does not exists"),

                array("pp.ru","whois.ripn.ru","No entries found"),

                array("ppg.br","whois.nic.br","No match"),

                array("pro.br","whois.nic.br","No match"),

                array("psi.br","whois.nic.br","No match"),

                array("psc.br","whois.nic.br","No match"),

                array("pt","whois.ripe.net","No entries found"),

                array("qh.cn","whois.cnnic.net.cn","No entries found"),

                array("qsl.br","whois.nic.br","No match"),

                array("rec.br","whois.nic.br","No match"),

                array("ro","whois.rotld.ro","No entries found"),

                array("ru","whois.ripn.ru","No entries found"),

                array("sc.cn","whois.cnnic.net.cn","No entries found"),

                array("sd.cn","whois.cnnic.net.cn","No entries found"),

                array("se","whois.nic-se.se","No data found"),

                array("sg","whois.nic.net.sg","NO entry found"),

                array("sh","whois.nic.sh","No match for"),

                array("sh.cn","whois.cnnic.net.cn","No entries found"),

                array("si","whois.arnes.si","No entries found"),

                array("sk","whois.ripe.net","no entries found"),

                array("slg.br","whois.nic.br","No match"),

                array("sm","whois.ripe.net","no entries found"),

                array("sn.cn","whois.cnnic.net.cn","No entries found"),

                array("srv.br","whois.nic.br","No match"),

                array("st","whois.nic.st","No entries found"),

                array("sx.cn","whois.cnnic.net.cn","No entries found"),

                array("tc","whois.adamsnames.tc","is not registered"),

                array("th","whois.nic.uk","No entries found"),

                array("tj.cn","whois.cnnic.net.cn","No entries found"),

                array("tmp.br","whois.nic.br","No match"),

                array("to","whois.tonic.to","No match"),

                array("tr","whois.ripe.net","Not found in database"),

                array("trd.br","whois.nic.br","No match"),

                array("tur.br","whois.nic.br","No match"),

                array("tv","whois.tv","MAXCHARS:75"),

                array("tv.br","whois.nic.br","No match"),

                array("tw","whois.twnic.net","NO MATCH TIP"),

                array("tw.cn","whois.cnnic.net.cn","No entries found"),

                array("uk","whois.thnic.net","No match for"),

                array("va","whois.ripe.net","No entries found"),

                array("vet.br","whois.nic.br","No match"),

                array("vg","whois.adamsnames.tc","is not registered"),

                array("wattle.id.au","whois.aunic.net","No Data Found"),

                array("ws","whois.worldsite.ws","No match for"),

                array("xj.cn","whois.cnnic.net.cn","No entries found"),

                array("xz.cn","whois.cnnic.net.cn","No entries found"),

                array("yn.cn","whois.cnnic.net.cn","No entries found"),

                array("zlg.br","whois.nic.br","No match"),

                array("zj.cn","whois.cnnic.net.cn","No entries found")

        );



    /*

    * Constructor of class domain

    * @param string        $str_domainame    the full name of the domain

    * @desc Constructor of class domain



    function domain($str_domainname){

        $this->domain=$str_domainname;

    }



    /*

    * Returns the whois data of the domain

    * @return string $whoisdata Whois data as string

    * @desc Returns the whois data of the domain

    */

    function info(){

        if($this->is_valid()){





            $tldname=$this->get_tld();

            $domainname=$this->get_domain();

            $whois_server=$this->get_whois_server();

            /*

            $tldname="cn";

            $domainname="sina.com";

            $whois_server="whois.cnnic.net.cn";

            */

            // If tldname have been found

            if($whois_server!=""){

                // Getting whois information

                $fp = @fsockopen($whois_server,43) or die("연결실패!(连接失败!)");



                $dom=$domainname.".".$tldname;

                fputs($fp, "$dom\r\n") or die("오류발생!(发生错误!)");



                // Getting string

                $string="";

                while(!feof($fp)){

                    $string.=fgets($fp,128);

                }

                fclose($fp);

                return $string;

            }else{

                return "No whois server for this tld in list!";

            }

        }else{

            return "Domainname isn't valid!";

        }

    }



    /**

    * Returns the whois data of the domain in HTML format

    * @return string $whoisdata Whois data as string in HTML

    * @desc Returns the whois data of the domain  in HTML format

    */

    function html_info(){

        return nl2br($this->info());

    }



    /**

    * Returns name of the whois server of the tld

    * @return string $server the whois servers hostname

    * @desc Returns name of the whois server of the tld

    */

    function get_whois_server(){

            $found=false;

            $tldname=$this->get_tld();

            for($i=0;$i<count($this->servers);$i++){

                if($this->servers[$i][0]==$tldname){

                    $server=$this->servers[$i][1];

                    $full_dom=$this->servers[$i][3];

                    $found=true;

                }

            }

            return $server;

    }



    /**

    * Returns the tld of the domain without domain name

    * @return string $tldname the tlds name without domain name

    * @desc Returns the tld of the domain without domain name

    */

    function get_tld(){

       // Splitting domainname

       $domain=split("\.",$this->domain);

       if(count($domain)>2){

           $domainname=$domain[0];

           for($i=1;$i<count($domain);$i++){

               if($i==1){

                  $tldname=$domain[$i];

               }else{

                  $tldname.=".".$domain[$i];

               }

            }

       }else{

           $domainname=$domain[0];

           $tldname=$domain[1];

       }

       return $tldname;

    }



    /**

    * Returns all tlds which are supported by the class

    * @return array $tlds all tlds as array

    * @desc Returns all tlds which are supported by the class

    */

    function get_tlds(){

            $tlds="";

            for($i=0;$i<count($this->servers);$i++){

                    $tlds[$i]=$this->servers[$i][0];

            }

            return $tlds;

    }



    /**

    * Returns the name of the domain without tld

    * @return string $domain the domains name without tld name

    * @desc Returns the name of the domain without tld

    */

    function get_domain(){

       // Splitting domainname

       $domain=split("\.",$this->domain);

       return $domain[0];

    }



    /**

    * Returns the string which will be returned by the whois server of the tld if a domain is avalable

    * @return string $notfound  the string which will be returned by the whois server of the tld if a domain is avalable

    * @desc Returns the string which will be returned by the whois server of the tld if a domain is avalable

    */

    function get_notfound_string(){

       $found=false;

       $tldname=$this->get_tld();

       for($i=0;$i<count($this->servers);$i++){

           if($this->servers[$i][0]==$tldname){

               $notfound=$this->servers[$i][2];

           }

       }

       return $notfound;

    }



    /**

    * Returns if the domain is available for registering

    * @return boolean $is_available Returns 1 if domain is available and 0 if domain isn't available

    * @desc Returns if the domain is available for registering

    */

    function is_available(){

        $whois_string=$this->info();

        $not_found_string=$this->get_notfound_string();



        $domain=$this->domain;

        $whois_string2=ereg_replace("$domain","",$whois_string);



        $array=split(":",$not_found_string);



        if($array[0]=="MAXCHARS"){

                if(strlen($whois_string2)<=$array[1]){

                        return true;

                }else{

                        return false;

                }

        }else{

                if(preg_match("/".$not_found_string."/i",$whois_string)){

                    return true;

                }else{

                    return false;

                }

        }

    }



    /**

    * Returns if the domain name is valid

    * @return boolean $is_valid Returns 1 if domain is valid and 0 if domain isn't valid

    * @desc Returns if the domain name is valid

    */

    function is_valid(){

        if(ereg("^[a-zA-Z0-9\-]{3,}$",$this->get_domain()) && !preg_match("/--/",$this->get_domain())){

            return true;

        }else{

            return false;

        }

    }

}

?>

<?php

top();

if($HTTP_POST_VARS["action"]=="whois")

{

$domain1=htmlspecialchars($HTTP_POST_VARS["ym1"]);

$domain2=$HTTP_POST_VARS["ym"];

$my = new domain();

 for($i=0;$i<sizeof($domain2);$i++)

 {

  $my->domain=$domain1.".".$domain2[$i];

  $check=$my->is_available();

  //echo $my->is_available()."<br>";

  if(!$check)

  {

    if($domain1)

    $reged[]=$domain1.".".$domain2[$i];

    else

    $reged[]="www.".$domain2[$i];

  }

  else $unreg[]=$domain1.".".$domain2[$i];

 }

 //echo sizeof($unreg)."-------".sizeof($reged)."<br>";

   echo "<table cellspacing=1 cellpadding=3 width=500 align=\"center\" bgcolor=\"lightgreen\"><tr><td align=\"center\" bgcolor=\"gray\"><font style=\"font-size:20px;color:black\">[<b>도메인 검색결과 / 域名搜索结果</b>]</font></td></tr>";

   echo "<tr bgcolor=\"white\"><td>";

 if(count($reged))

    {

      for($i=0;$i<sizeof($reged);$i++)

      {

        echo "<b>".$reged[$i]."</b>&nbsp;등록된 도메인 입니다. (无法注册.) -> <a href=\"".$HTTP_SERVER_VARS["PHP_SELF"]."?action=view&dname=".$reged[$i]."\">상세정보 보기 / (查看详细)</a><br>";

      }

    }

 if(count($unreg))

    {

echo "<hr>";

      for($i=0;$i<sizeof($unreg);$i++)

      {

        echo "<b>".$unreg[$i]."</b>&nbsp;등록 가능한 도메인 입니다. (可以注册)<br>";

      }

    }

echo "</td></tr></table>";

/*

echo "<hr>";

echo "<pre>".$my->info()."</pre>";

*/

back();

}

#################

elseif($HTTP_GET_VARS["action"]=="view")

 {

    $dname=htmlspecialchars($HTTP_GET_VARS["dname"]);

    if(!$dname) error("오류발생!(发生错误!)");

   $my = new domain();

   $my->domain=$dname;

   back();

   echo "<hr>";

   echo "<table cellspacing=1 cellpadding=3 width=500 align=\"center\" bgcolor=\"lightgreen\"><tr><td align=\"center\" bgcolor=\"#f9f9f9\"><font style=\"font-size:20px;color:black\">[<a href=\"http://www.".$dname."\" target=\"_blank\" title=\"접속하기 / 点击访问\"><b>".$dname."</b></a>]</font></td></tr>";

   echo "<tr bgcolor=\"white\"><tD>";

   echo "<pre>".$my->info()."</pre>";

   echo "</td></tr></table>";

   echo "<hr>";

   back();

 }

###############

else

 {

?>



                  <form name="form1" method="POST" action="<?php echo $HTTP_SERVER_VARS["PHP_SELF"];?>">

                    <input type="hidden" name="action" value="whois">

                    <table width="420" border="0" cellspacing="1" cellpadding="3" bgcolor="#b90000">

                      <tr>



                        <td colspan="3" bgcolor="#b50000"><font style="font-size:14px;color:white">
						域名查询: www.</font><input type="text" name="ym1">



                          <input type="submit" name="Submit" value="查询">

                          <font size="2"> </font></td>



                      </tr>



                      <tr bgcolor="#F2F2F2">



                        <td>

                          <input type="checkbox" name="ym[]" value="com" checked> 
							.com </td>

                        <td width="20%">

                          <input type="checkbox" name="ym[]" value="net"  > .net </td>

                        <td>

                          <input type="checkbox" name="ym[]" value="org" > .org </td>



                      </tr>



                      <tr>



                        <td bgcolor="#F2F2F2">



                          <input type="checkbox" name="ym[]" value="com.cn" checked> 
							.com.cn </td>

                        <td width="20%" bgcolor="#F2F2F2">

                          <input type="checkbox" name="ym[]" value="net.cn" >.net.cn </td>



                        <td bgcolor="#F2F2F2">



                          <input type="checkbox" name="ym[]" value="org.cn" >.org.cn </td>



                      </tr>



                       <tr bgcolor="#F2F2F2"> <td bgcolor="#F2F2F2">



                          <input type="checkbox" name="ym[]" value="gov.cn" > .gov.cn </td>



                        <td>

                          <input type="checkbox" name="ym[]" value="info" > 
							.info </td>

                        <td>

                          <input type="checkbox" name="ym[]" value="biz" value="yes" >



                          .biz </td>

                      </tr>

                      <?php

                      if($HTTP_GET_VARS["flag"]=="tw")

                      {

                      ?>

                       <tr bgcolor="#F2F2F2"> <td bgcolor="#F2F2F2">



                          <input type="checkbox" name="ym[]" value="com.tw" > .com.tw </td>



                        <td>

                          <input type="checkbox" name="ym[]" value="net.tw" > .net.tw </td>



                        <td>

                          <input type="checkbox" name="ym[]" value="gov.tw" value="yes" > 
							.gov.tw </td>

                      </tr>

                      <?php

                      }

                      ?>

                       <tr bgcolor="#F2F2F2"> <td bgcolor="#F2F2F2">



                          <input type="checkbox" name="ym[]" value="tv" > .tv </td>



                        <td>

                          <input type="checkbox" name="ym[]" value="cc" > .cc </td>

                        <td>

                          <input type="checkbox" name="ym[]" value="sh" value="yes" > 
							.sh </td>

                      </tr>

                    </table>



                  </form>

<?php

 }

copyright();

bottom();

function error($msg)

 {

    echo "<script language=\"JavaScript\">alert(\"".$msg."\");</script>";

 }



 function back()

 {

    echo "<button onClick=\"window.history.back(-1)\">뒤로(返回)</button>";

 }



 function top()

 {

?>

<html>

<head>

<title>도메인 검색결과! / 域名搜索结果</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style type="text/css">

<!--

body,tr,td,table{color:green;font-size:13px;}

A {

        COLOR: green; TEXT-DECORATION: none;font-size:14px;

}

A:hover {

        COLOR: #b50000; TEXT-DECORATION: none;font-size:14px;background-color:#f0f0f0

        }

a.link {

        COLOR: background; TEXT-DECORATION: none;font-size:14px;

}

a.link:hover {

        COLOR: black; TEXT-DECORATION: none;font-size:14px;

        }

A.news {

        COLOR: black; TEXT-DECORATION: none;font-size:12px

}

A.news:hover {

        COLOR: #b50000; TEXT-DECORATION: none;font-size:12px;background-color:white

        }

A.top {

        COLOR: #b50000; TEXT-DECORATION: none;font-size:12px;background-color:#f4f4f4

}

A.top:hover {

        COLOR: #900000; TEXT-DECORATION: none;font-size:12px;background-color:white

        }

body {

SCROLLBAR-FACE-COLOR: #FFFFFF; SCROLLBAR-HIGHLIGHT-COLOR: #FFFFFF; SCROLLBAR-SHADOW-COLOR: #99CCFF; SCROLLBAR-3DLIGHT-COLOR: #99CCFF; SCROLLBAR-ARROW-COLOR: #99CCFF; SCROLLBAR-TRACK-COLOR: #FFFFFF; SCROLLBAR-DARKSHADOW-COLOR: #FFFFFF

}

.TEXTAREA



{



font-family: ; font-size: 9pt; color: black; border-left: 1px double; border-right: 1px solid; border-top: 1px double; border-bottom: 1px double background: #0000ff;



}

TEXTAREA



{



font-family: ; font-size: 9pt; color: black; border-left: 1px double; border-right: 1px solid; border-top: 1px double; border-bottom: 1px double background: #0000ff;



}

-->

</style>

</head>

<body>

<br>

<center>

<?php

 }



function bottom()

{

 echo "</center><body></html>";

}



function copyright()

{

echo "";

}

?>