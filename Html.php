<?php

require_once(dirname(__FILE__)."/lib/authenticate.php");
require_once(dirname(__FILE__)."/lib/session.php");

class Html
{
	/**
	 * HTTP vars from the request.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $HTTPVars;

	/**
	 * The users data file.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $datafil = NULL;

	/**
	 * The class containning the options.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $stier;

	/**
	 * An instanceof the {@link SiteContext}.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $siteContext;

	/**
	 * An instance of the <code>Rounder</code>.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $rounder;

	/**
	 * Creates a new instance.
	 *
	 * @param $HTTPVars variables form the request
	 * @param $inddata the content of users data file.
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 */
	function Html($HTTPVars, &$datafil, $rounder=null)
	{
		$this->setHTTPVars($HTTPVars);

		if (is_object($datafil))
			$this->setDatafil($datafil);

		if ($rounder === null)
			$rounder = new Rounder();
		$this->setRounder($rounder);
	}


	/**
	 * Sets an instance of the {@link Rounder}.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return void
	 * @param $rounder an instance of the {@link Rounder}.
	 */
	function setRounder(&$rounder)
	{
		$this->rounder = &$rounder;
	}

	/**
	 * Gets an instance of the {@link Rounder}.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return Rounder an instance of the {@link Rounder}.
	 */
	function &getRounder()
	{
		return $this->rounder;
	}

	/**
	 * Sets the {@link SiteContext} object.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $siteContext the {@link SiteContext} object.
	 * @return void
	 */
	function setSiteContext(&$siteContext)
	{
		if (strtolower(get_class($siteContext)) == 'sitecontext')
			$this->siteContext = &$siteContext;
		else
		{
			echo "<b>Error:</b> Param <code>\$siteContext</code> to contrusctor <code>StatSite()</code> must be an instance of the class <code>SiteContext</code>.";
			exit;
		}
	}

	/**
	 * Sets the class containning the options.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $stier the class containning the options.
	 * @return void
	 */
	function setStier(&$stier)
	{
		$this->stier = &$stier;
	}

	/**
	 * Returns the class containning the options.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return Stier the class containning the options.
	 */
	function &getStier()
	{
		return $this->stier;
	}

	/**
	 * Sets the variables from the request.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $HTTPVars the variables from the request.
	 * @return void
	 */
	function setHTTPVars($HTTPVars)
	{
		$this->HTTPVars = $HTTPVars;
	}

	/**
	 * Returns the variables from the request.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return String[] the variables from the request.
	 */
	function getHTTPVars()
	{
		return $this->HTTPVars;
	}

	/**
	 * Returns one variable from the request.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $theVar the name of the wanted variable
	 * @return String the named variable from the request.
	 */
	function getHTTPVar($theVar)
	{
		return $this->HTTPVars[$theVar];
	}

	/**
	 * Sets the users datafile, as a {@link Datafil} object.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @param $datafil the users datafile.
	 * @return void
	 * @see Datafil
	 */
	function setDatafil(&$datafil)
	{
		//if (strtolower(get_class($datafil)) == "datafil")
		$this->datafil = &$datafil;
		/*else
		{
			echo "<b>Error:</b> Invalid parameter for function <code>setDatafil(Datafil)</code>. Only instances of class <code>Datafil</code> is valid.";
			exit;
		}*/
	}

	/**
	 * Returns the data source.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return DataSource the data source.
	 */
	function &getDataSource()
	{
		return $this->getDatafil();
	}

	/**
	 * Returns the users datafile, as a {@link Datafil} object.
	 *
	 * @private
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return Datafil brugerens data
	 */
	function &getDatafil()
	{
		return $this->datafil;
	}

	/**
	 * Takes the one of the arrays which is used, and reurns it.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $HTTP_POST_VARS the post vars array
	 * @param $HTTP_GET_VARS the get vars array
	 * @return String[] the one of the parameters which is used.
	 */
	function setPostOrGetVars($HTTP_POST_VARS, $HTTP_GET_VARS)
	{
		if (sizeof($HTTP_GET_VARS) > 0) {
			$HTTP_VARS = $HTTP_GET_VARS;
		} elseif (sizeof($HTTP_GET_VARS)) {
			$HTTP_VARS = $HTTP_POST_VARS;
                } elseif (isset($_POST) and sizeof($_POST) > 0) {
                        $HTTP_VARS = $_POST;
                } elseif (isset($_GET) and sizeof($_GET)) {
                        $HTTP_VARS = $_GET;
                }
		return $HTTP_VARS;
	}

	/**
	 * Sends header which tells the browser not to cache the page.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return void
	 */
	function outputNoCacheHeaders()
	{
		header("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	/**
	 * Formats a string to explain a poblem has occured.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $tekst the text, may contain html.
	 * @param $type if 0 is specified, html is generated,
	 *              if 1 is specified, java script is generated.
	 * @return String a formated string explaining a problem has occured.
	 */
	function problemer($tekst, $type=0)
	{
		if ($type == 0)
			return "<h3>Der opstod flgende problem(er):</h3><ul>" . $tekst . "</ul>";
		elseif ($type == 1)
			return "document.write('".addslashes($tekst)."');\n";
		else
		{
			echo "<b>Error</b> Unvalid value in parameter in 2nd function problemer() in class Html line ".__LINE__.": \$type=$type. Valid values: <code>0</code> or <code>1</code>.";
			exit;
		}
	}

/**
 * Sets the pro value $no (see {@link #pro} for valid values) to the
 * value $val.
 * 
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $no the field to set
 * @param $val the value to set.
 * @returns void
 */
function setPro($no, $val) {
	$provalue = explode('::',$this->datafil->getLine(58));
	$provalue[$no] = $val;
	$this->datafil->setLine(58, implode('::', $provalue));
}

/**
 * Specifies if the user has a pro account or not.
 * If no parameter is given, or the text &quot;test&quot; is given, 1 is
 * returned if the user has pro, else 0.
 * If a number is given, the the corresponding pro value is returned.
 * 
 * <p>Pro numbers:<br>
 * 0-Max no reference pages<br>
 * 1-Max no unique ip adresses<br>
 * 2-Info about latest X users<br>
 * 3-No questions<br>
 * 4-No anwsers for each question<br>
 * 5-Max no counters<br>
 * 6-Hits pr. users, calculated over X weeks<br>
 * 7-Max no domains<br>
 * 8-Max no search terms<br>
 * 9-No send stat mail times<br>
 * 10-Max no click counter adresses<br>
 * 11-Max no movements<br>
 * 12-Max no charaters for key words<br>
 * 13-Max no charaters for description<br>
 * 14-Max no categories in the index<br> Not implemented
 * 15-Max no adresses to only register stats on<br>
 * 16-Max no entry sites<br>
 * 17-Max no exit sites<br>
 * 
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $nr the wanted pro field, or &quot;test&quot; for general pro.
 * @return boolean the wanted pro field, or if the user has pro or not.
 */
function pro($nr = "test")
{
	//If this is called when the data source has not been loaded
	if ($this->datafil === NULL)
		return false;

	if ($this->datafil->loaded()) {
		$pro = $this->datafil->getLine(61);
	} else {
		$pro = "";
	}

	//                    0   1   2  3  4   5  6   7   8   9  10  11   12  13 14 15  16  17
	$normvalue =  array(100, 30, 20,10,10, 50, 3,100,100, 30, 50, 50,  75, 75, 1, 5, 50, 50); /*The limit for ordinarry users.*/
	$pro_stdvalue =array( 0,  0,  0, 0, 0,  0, 0,  0,  0,  0,999,  0, 300, 85, 1, 0,  0,  0); /*0 means the user can change the value itself, > 0 means the number can not be changed*/
	$maxvalue =   array(150, 100,150,99,99,500,9,150,150,200,999,150, 300, 85, 1,99,150, 150); /*Maximal values used - the users can specify lager values, which is saved, but theese are the heighest actually used. Use of theese can be disabled in stier.php.*/
	//if (($pro + 7*24*3600 > time()) or ($this->stier->getOption('always_pro') == 1))
	if (($pro + 7*24*3600 > 1034310769) or ($this->stier->getOption('always_pro') == 1))
	{
		if ($nr === "test")
			return 1;
		else
		{
			if ($this->datafil->loaded()) {
				$provalue = explode("::",$this->datafil->getLine(58));
			} else {
				$provalue = array();
			}

			//Returns values
			if ($pro_stdvalue[$nr] === 0) /*Chek type*/
			{
				if (isset($provalue[$nr]) and $this->ok0tal($provalue[$nr])) /*Is the users value ok?*/
				{
					//Limit the user selected options
					if (($this->stier->getOption('use_pro_limits') == 1) and ($provalue[$nr] > $maxvalue[$nr]))
						return $maxvalue[$nr];
					else
						return $provalue[$nr];
				}
				else
					return $normvalue[$nr];
			}
			else 	/*If this is a value the user can't change.*/
				return $pro_stdvalue[$nr];
		} /*End of if if ($pro + [...]*/
	}
	else
	{
		if ($nr === "test")
			return 0;
		else
			return $normvalue[$nr];
	}

} /*End of function pro*/

/**
 * States if the given number is correct and &lt; 0.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $tal the number to validate
 * @return boolean 1 if the number is ok, else 0.
 */
function ok0tal($tal)
{
	if ($this->oktal($tal) and $tal > 0)
		return 1;
	else
		return 0;
}

/**
 * States if <code>$tal</code> is a valid number.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $tal the number to validate
 * @return boolean 1 if the number is ok, else 0.
 */
function oktal($tal)
{
	if (! preg_match("/[^0-9]/",$tal))
		return 1;
	else
		return 0;
}

/**
 * Returns if the visit is unique.
 *
 * @param $ip the IP address of the user.
 * @return if the visit is unique.
 * @public
 */
function isVisitUnique($ip)
{
	return ! in_array( $ip, explode(":",$this->datafil->getLine(45)) );
}

/**
 * Calculates the numbers of hits pr. user on the basis of the datafile.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @return float the numbers of hits pr. user on the basis of the datafile.
 */
function hpb()
{
	$sec =  date('s'); /*Second*/
	$min =  date('i'); /*Minute*/
	$hour = date('H'); /*Hour*/
	$mday = date('j'); /*Day in month*/
	$mon =  date('n'); /*Month*/
	$year = date('Y'); /*Year*/
	$wday = date('w'); /*Day of week*/
	$yday = date('z'); /*Day in year*/

	$ind1 = $this->datafil->getLine(64);
	$ind2 = $this->datafil->getLine(65);

	$tmp = explode("::",$ind1);
	$tmp2 = explode("::",$ind2);

	$hpbmax = $this->pro(6);

	$ugenr = round(($yday/7)+1);
	$genr = $ugenr;

	if ($hpbmax > 0)
		{
		while ($ugenr > $hpbmax)
			$ugenr -= $hpbmax;
		}

	$n = $hpbmax;
	$ht = 0;
	$hn = 0;
	$hpb = 0;
	for ($i = 0;$i < $hpbmax; $i++)
		{
		if ($hpbmax != 0) {
			if (isset($tmp[$i]))
				$ht += $tmp[$i] * ($n/$hpbmax);
			if (isset($tmp2[$i]))
				$hn += $tmp2[$i] * ($n/$hpbmax);
		}
		$n--;

		if ($n < 0)
			$n = $hpbmax;
		}
	if ($hn > 0 and $ht != 0)
		$hpb = $hn/$ht;

	return $hpb;
}

/**
 * Rounds the number to a suiting number of decimals.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $tal the number to round.
 * @return float the rounded number.
 */
function afrund($tal)
{
	if ($tal < 0.001) $ud = round($tal,4);
	elseif ($tal < 0.01) $ud = round($tal,3);
	elseif ($tal < 0.1) $ud = round($tal,2);
	elseif ($tal <= 10) $ud = round($tal*100)/100;
	elseif ($tal > 10 and $tal <= 100) $ud = round($tal*10)/10;
	else $ud = round($tal);
	$ud = preg_replace("/\./",",",$ud);
	return $ud;
}

/**
 * States if a stat may be counted on a given url.
 * This function is for ignoring hits from other pages than your own.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $url the url for the page, on which to check if we may register
 *         sats on.
 * @param $okSider an array  or <code>::</code> separated text string
 *         of the adresses the url may start with to be allowed to have
 *         stats registered for them.
 * @return <code>true</code> for yes, <code>false</code> for no.
 * @todo the @c $okSider array can be fetch from the datasource - do this.
 */
function countVisit($url, $okSider)
{
	//Convrts the 2nd parameter to an array, if nessary.
	if (! is_array($okSider))
		$okSider = explode("::",$okSider);

	//Remove invalid urls.
	$okokSider = array();
	foreach ($okSider as $enkeltSide) {
		if (strlen($enkeltSide) > 0)
			$okokSider[] = $enkeltSide;
	}

	//Is there a valid url at all?
	if (sizeof($okokSider) === 0)
		return true;

	foreach ($okokSider as $tjekSide)
	{
		//If there is nothing to check: Next;
		if ($tjekSide === "")
			next;

		//Does $tjekSide start with http:// or https://
		$startHttp = (strpos($tjekSide,"http://") === 0 or strpos($tjekSide,"https://") === 0);

		//Does the given page start with the text of the okSide
		if (	/*tjekSide starts with http://*/
				($startHttp and strpos(strtolower($url),strtolower($tjekSide)) === 0)
				or /*tjekSide does not start with http://*/
				((! $startHttp) and strpos(strtolower($url),strtolower($tjekSide)) !== false)
			 )
				{
					return true;
				}
	}

	return false;
}

/**
 * Returns a text formated string of the current date and time.
 * The format is: &quot;[day] d. [date]/[month]-[year] kl. [hour]:[minute]&quot;.";
 * The format can not be changed, thus this metod is depricated.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @return Stirng en tekststreng der viser dags dato og tid.
 * @depricated use the date function of PHPand a localized format.
 */
function kortdato()
{
	$timeAdjusted = $this->getTimeAdjusted();
	$sec =  date('s', $timeAdjusted); /*Sekund*/
	$min =  date('i', $timeAdjusted); /*Minut*/
	$hour = date('H', $timeAdjusted); /*time*/
	$mday = date('j', $timeAdjusted); /*dag i mned*/
	$mon =  date('n', $timeAdjusted); /*mned*/
	$year = date('Y', $timeAdjusted); /*r*/
	$wday = date('w', $timeAdjusted); /*ugedage*/
	$yday = date('z', $timeAdjusted); /*dag i r*/

	//Write day of week
	if ($wday == 1)
		$uge = "man";
	elseif($wday == 2)
		$uge="tirs";
	elseif($wday == 3)
		$uge="ons";
	elseif($wday == 4)
		$uge="tors";
	elseif($wday == 5)
		$uge="fre";
	elseif($wday == 6)
		$uge="lr";
	else
		$uge="sn";

	return "$uge d. $mday/$mon-$year kl. $hour:$min";
}

/**
 * Recives a full domain name, and returns the domain+topdomain;
 * if the domain is 'co' the 3rd level is also returned. E.g.
 * <code>www.zip.dk</code> returns <code>zip.dk</code> and
 * <code>www.amazon.co.uk</code> gives <code>amazon.co.uk</code>.
 */
function getDom($dom)
{
	$domArray = explode(".",$dom);
	$domArray = array_reverse($domArray);

	if (count($domArray) > 2 and $domArray[1] === "co")
		$udDomArray = array($domArray[0],$domArray[1],$domArray[2]);
	else if(count($domArray) > 1)
		$udDomArray = array($domArray[0],$domArray[1]);
	else
		$udDomArray = array();

	$udDomArray = array_reverse($udDomArray);

	return implode(".",$udDomArray);
}

/**
 * Returns the top domain from the domain.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $domaene det domain to get the topdomain from.
 * @return String the topdomain of the domain.
 */
function getTopDom($domaene)
{
	$dom = explode(".",$this->getDom($domaene));
	$dom = array_reverse($dom);
	return $dom[0];
}

/**
 * Returns an array in which index 0 is the counter number and index 1 is an
 * array of the counter names.
 *
 * If $createNew is set to @c false (default is @c true):
 * Non existing counter numbers/names will @em not be added to the
 * list of counters. Existing numbers/names will be counted up.
 * If no useable counter was found, the first index of the result will be
 * 0 as usual, and when getting this result it is then possible to treat
 * the visit as not yet counted.
 * $createNew was added to support legacy references to ZIP Stat that still
 * contains the old type of counters.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $counterNo         the number of the counter in question (or empty).
 * @param $counterName       the name of the counter in question (or empty).
 * @param $counterNameList   array of the counter names corresponding to the.
 *                           numbers (the indexes of the array).
 * @param $pro_max_counters  the largest amount of counters this user may have.
 * @param $HTTP_REFERER      the address of the registered page.
 * @param $createNew         shall a non existing name be added to the
 *                           list of counters?
 * @return String[] index 0 is the found counter number, index 1 is the
 *                  new array of counter names ($counterNameList)
 *                  with the new countername added, if a new counter is created.
 */
function taelnummer($counterNo, $counterName, $counterNameList,
                 $pro_max_counters, $HTTP_REFERER, $createNew = true)
{
	
	if (isset($counterNo) and ($counterNo*1) > 0)
	{
		/*If a counter number is given.*/
		$i = $counterNo;
	}
	elseif (isset($counterName) and strlen($counterName) > 0)
	{
		/*If a counter name is given.*/
		//Find the counter number that matches the name.
		$i = 0;
		while (($counterNameList[$i] != $counterName) and ($i <= $pro_max_counters)) {
			$i++;
		}

		if ($i == ($pro_max_counters + 1)) {
		/*If we can't find a counter name.*/
			$i=0;
		}
	}
	else
	{
		//If nothing is given.
		//Find the file name of the page:
		$filename = $HTTP_REFERER;

		//If it's not a valid URL: We can't do this.
		if (!preg_match("#^http://#i",$filename)) {
			return array(0,$counterNameList);
		}
			
		$filename = $this->taelnummer_url2name($filename);

		$notFound = 1;
		$location = 0;
		
		$nameIndex = 0;
		while (($notFound) and ($nameIndex <= $pro_max_counters))
		{
			//Find the counter number for which a corresponding name exists.
			if ($counterNameList[$nameIndex] == $filename)
			{
				$i = $nameIndex;
				$notFound = 0;
			}
			if (! (($counterNameList[$nameIndex]) or ($location)) )
				$location = $nameIndex;
			$nameIndex++;
		}

		if (($notFound) and ($location))
		{
			if ($createNew === true) {
				//Don't create non existing.
				return array(0,$counterNameList);
			}
			//Create a new counter if required.
			$counterNameList[$location] = $filename;
			$i = $location;
		}
		elseif ($notFound)
		{
			//If there wasn't room for a new counter.
			$i = 0;
		}
	}

	//If the counter number is too heigh: Use the default counter.
	if ($i > $pro_max_counters)
		$i = 0;
	return array($i,$counterNameList);
}

/** Returns the counter name of the given url or the url if the name was
 *  not found.
 *  
 *  The purpose of this method is only to provide legacy support for
 *  counter names given in existing urls, as in taelnummer(). Please do not
 *  use it for anything else.
 *
 *  @public
 *  @param $url the one to find a name for.
 *  @return the name of the $url or the whole url.
 */
function taelnummer_url2name($url) {
	$filename = $url;
	
	//Remove text after ? and # (both included).
	if (strpos($filename,'?') > 0)
		$filename = substr($filename,0,strpos($filename,'?'));

	if (strpos($filename,'#') > 0)
		$filename = substr($filename,0,strpos($filename,'#'));

	$filenameArray = explode("/",$filename);
	$domain = $filenameArray[2];
	$filenameArray = array_reverse($filenameArray);
	//Use index 0 (folder name) or index 1 (file name)?
	if (strlen($filenameArray[0]) == 0)
		$useIndex = 1;
	else
		$useIndex = 0;

	if ($filenameArray[$useIndex] == $domain)
		$filename = strtolower($filenameArray[$useIndex]);
	else
		$filename = $filenameArray[$useIndex];
		
	return $filename;
}

/**
 * Returns if the given string is a valid e-mail address.
 *
 * @public
 * @param $mail The e-mail address to validate.
 * @return boolean if the given string is a valid e-mail address.
 */
function okmail($mail)
{
	return preg_match("/[\w-_.]+\@[\w-_.]/",$mail);
}

/**
 * Returns if the given string is a valid web url.
 *
 * @public
 * @param $url the url to validate.
 * @return boolean if the given string is a valid web url.
 */
function okurl($url)
{
	//Nothing is not valid
	if ($url === "")
		return 0;

	if ( preg_match("%^https?://[a-z0-9\-.]+\.[a-z0-9\-.~_#/=?+&]+%i",$url)) {
		//Valid - pure url.
		return 1;
	} elseif (strpos(strtolower($url),"mailto:") == 0) {
		//mailto url: Validate as e-mail.
		return $this->okmail(substr($url,7));
	} else {
		//We don't know this one: Invalid.
		return 0;
	}
}

/**
 * Returns the parameters of the given url.
 *
 * @public
 * @param $url the url to get parameters from.
 * @return String[] associative array with the parameres of the url.
 */
function urlkeys($url)
{
	//No parameters.
	if (strpos($url,"?") === false)
		return array();

	//Cut off the domain + path part.
	$url = substr($url,strpos($url,"?")+1);

	//Split it.
	$urlArray = explode("&",$url);

	//Separate into key/value pairs.
	$params = array();
	foreach ($urlArray as $keyvals)
	{
		$tmp = explode("=",$keyvals);
		$params[$tmp[0]] = $tmp[1];
	}
	return $params;
}

/**
 * Add <code>String</code> zeros on the empty places in the given array.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $upTo add zeros on empty places up to this index.
 * @param $anArray the array that shall have zeros added.
 * @return Object[] an array with zeros on empty spots.
 */
function addZeros($upTo,$anArray)
{
	for ($i = 0;$i <= $upTo;$i++)
		if (!isset($anArray[$i]) or $anArray[$i] === 0 or $anArray[$i] == "")
			$anArray[$i] = '0';
	return $anArray;
}

/**
 * Removes invalid data pairs.
 * Returns an array containing two arrays. Index 0 contains the new
 * text array and index 1 contains the new number array.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $textArray an array containing text witch matches the numbers in
 *        the following parameter.
 * @param $numersArray an array containing numbers witch matches the text
 *        in the previous array.
 * @return String[][] an array containing the two new arrays.
 */
function removeInvalidData($textArray,$numbersArray)
{
	//Arryays the valid data is put into.
	$textOkArray = array();
	$numOkArray  = array();

	//Iterates the data
	for ($i = 0;$i < sizeof($textArray);$i++)
	{
		//Checks the data and
		if (
				isset($textArray[$i]) and $textArray[$i] !== "" and $textArray[$i] !== 0
				and $textArray[$i] !== " " and $textArray[$i] !== "&nbsp;" and $textArray[$i] !== null
			and
				isset($numbersArray[$i]) and $numbersArray[$i] > 0 and $numbersArray[$i] !== ""
				and $numbersArray[$i] !== " " and $numbersArray[$i] !== null
			)
		{ /*If the data is OK*/
			$textOkArray[] = $textArray[$i];
			$numOkArray[] = $numbersArray[$i];
		}
	} /*End of for ...*/

	return array($textOkArray, $numOkArray);
}

/**
 * Returns the length of the given month.
 * 1 is January and 12 is December.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 * @param $month the month of witch the length shall be returned.
 * @return int the length of the given month.
 */
function lengthOfMont($month)
{
	$dates = getDate();
	if ($month == 1)  return 31; /*January*/
	elseif (($month == 2) and ($dates['year']/4 != round($dates['year']/4)))  return 28;
		elseif (($month == 2) and ($dates['year']/4 == round($dates['year']/4)))  return 29;
	elseif ($month == 3)  return 31;
	elseif ($month == 4)  return 30;
	elseif ($month == 5)  return 31;
	elseif ($month == 6)  return 30;
	elseif ($month == 7)  return 31;
	elseif ($month == 8)  return 31;
	elseif ($month == 9)  return 30;
	elseif ($month == 10)  return 31;
	elseif ($month == 11)  return 30;
	else  return 31;
}

/**
 * Converts the given @c $str to a boolean value of @c 0 for @c false,
 * @c 1 for @c true and @c 2 for don't know.
 *
 * @param $str the one to convert.
 * @return 0, 1 or 2.
 */
function toBool($str) {
	//Make sure we can treat even messy strings.
	$str = strtolower(trim($str));
	
	//Language notes: 'ja' is yes and 'nej' is no in danish.
	//Note the non typed comparison (== and not ===).
	
	if (strlen($str) > 0 and $str == "false" or $str == "no" or $str == "nej" or $str == "0") {
		return 0;
	} else if (strlen($str) > 0 and $str == "true" or $str == "yes" or $str == "ja" or $str == "1") {
		return 1;
	} else {
		return 2;
	}
}


/**
 * Returns the current unix time adjusted acording to settings and
 * algorithms.
 *
 * @param $time the time to adjust. If not given, the output of the
 *              @c time() function is used.
 * @param $settings an instance of the settings object. This should only
 *                  be given if this method is invoked statically.
 * @return the adjusted timestamp.
 */
function getTimeAdjusted($time = NULL, $settings = NULL) {
	//Get the time.
	if ($time === NULL) {
		$time = time();
	}
	
	//Adjust the time.
	if ($settings === NULL) {
		$time += $this->stier->getOption('timeAdjustSec');
	} else {
		$time += $settings->getOption('timeAdjustSec');
	}
	
	return $time;
}

/**
 * Takes the element at index 0, shifts the whole array one left
 * and puts the element in the back. The resulting array will have
 * the same size as the old one. The parameters is modified!
 *
 * @param $arr the array to rotate - it will be modified!
 */
function array_rotate(&$arr) {
		$ele = array_shift($arr);
		$arr[count($arr)] = $ele;
}

/**
 * Returns date info from the path info in the following associative
 * array format:
 * @li @c year - contains the parsed year.
 * @li @c month - contains the parsed month or <code>1</code>.
 * @li @c day - the day or <code>1</code>.
 * @li @c time - the unix time stamp of the parsed time. Currently for
 *               midnight at the given day.
 * @li @c end  - the unix time stamp for the end of the indicated period,
 *               currently for 23:59:59 at the last day.
 *               If year, month and day are given, the period is a day.
 *               If year and month are given, the period is a month.
 *               This result takes the length of each month into account.
 *               If only a year is given, the period is a year.
 * @li @c week - If a full date and the word &quot;week&quot; is found,
 *               the week number is stored here and the period is 7 days
 *               from that date.
 * @li @c misc - 0 indexed array of non date parameters.
 *
 * <p>This function is expecting the year to be the first integer in the
 * path info. The month to be the second integer and the day to be
 * the third integer. Only year is required, and both day and month defaults
 * to the value <code>1</code>.</p>
 *
 * <p>If no good info can be found an empty array is returned.</p>
 *
 * @param $pathinfo use this value instead of @c getenv('PATH_INFO')
 *                  This parameter is primary ment for ease of testing.
 */
function getDateFromPathinfo($pathinfo = NULL) {
	//Get path info.
	if ($pathinfo === NULL) {
		$pathinfo = getenv('PATH_INFO');
	}
	//Is it empty?
	if (!isset($pathinfo) or strlen($pathinfo) === 0) {
		return array();
	}
	
	//Set defaults.
	$result = array('year' => NULL, 'month' => 1, 'day' => 1,
	                'time' => NULL, 'week' => NULL, 'misc' => array());
	
	//Split and parse the info.
	$parts = split('/', $pathinfo);
	
	//Iterate over the data. Skip the empty index 0.
	$dateElement = 'year'; //The next expected date element.
	for ($i = 1; $i < count($parts); $i++) {
		if (isset($parts[$i]) and ctype_digit($parts[$i]) and strlen($parts[$i]) > 0) {
			//Put data into 
			switch ($dateElement) {
				case 'year':
					$result['year'] = intval($parts[$i]);
					$dateElement = 'month';
					break;
				case 'month':
					$result['month'] = intval($parts[$i]);
					$dateElement = 'day';
					break;
				case 'day':
					$result['day'] = intval($parts[$i]);
					$dateElement = 'none';
					break;
				case 'none':
					$result['misc'][] = $parts[$i];
					break;
				default:
					die('The program should never reach line '.__LINE__.' in '.__FILE__.' for the pathinfo: ['.$pathinfo.']');
			} //End switch.
		} else {//End if integer.
			if ($parts[$i] === 'week' and $dateElement === 'none') {
				$result['week'] = true;
			} else {
				$result['misc'][] = $parts[$i];
			}
		} //End else
	} //End for.
	
	//Do we at least have a year to work with?
	if ($result['year'] === NULL) {
		return array();
	}
	
	//Is the date valid?
	if (!checkdate($result['month'], $result['day'], $result['year'])) {
		return array();
	}
	
	// [int $hour [, int $minute [, int $second [, int $month [, int $day [, int $year 
	$result['time'] = mktime(0, 0, 0, $result['month'], $result['day'], $result['year']);
	
	//Are the collected data OK?
	if ($result['time'] === FALSE or $result['time'] === NULL) {
		return array();
	}
	
	//Make the end of the period.
	// [int $hour [, int $minute [, int $second [, int $month [, int $day [, int $year 
	$emon = $result['month'];
	$eday = $result['day'];
	$eyear = $result['year'];
	if ($dateElement === 'none') {
		//We got year, month, day: Period: Day.
		if ($result['week']	=== true) {
			//Handle if a week is given.
			$eday += 7;
			$result['week'] = date('W', $result['time']);
		} else {
			//It's a normal day.
			$eday++;
		}
	} else if ($dateElement === 'day') {
		//We got year and month: Period month.
		$emon++;
		$eday = 1; //It should be 1, but lets make sure.
	} else if ($dateElement === 'month') {
		//We only got the year: Period: Year.
		$eyear++;
		$eday = 1; //It should be 1, but lets make sure.
		$emon = 1; //It should be 1, but lets make sure.
	}
	//Make the time: The -1 is for making e.g. 1. Jan. 2008 into 31. Dec. 2007 23:59:59
	$result['end'] = mktime(0, 0, 0, $emon, $eday, $eyear) -1;
	
	//Are the collected data OK?
	if ($result['end'] === FALSE or $result['end'] === NULL) {
		return array();
	}

	//Return the final result.	
	return $result;
}

} /*End class HTML*/

/**
 * Formats dates intelligently.
 */
class DateFormatter {

	/**
	 * The format to use, for the PHP function date().
	 *
	 * @private
	 */
	var $format;
	
	/**
	 * The current year (if it shall not be shown) or negative for disabled.
	 * If >= 0 and the year of the date to
	 * format is in the this given year, the format in @c $currentYearFormat
	 * will be used instead of the one in @c $format.
	 *
	 * @private
	 */
	var $currentYear = -1;
	
	/**
	 * Format to use when the year shall not be displayed.
	 *
	 * @private
	 */
	var $currentYearFormat;
	
	/**
	 * Creates a new instance with the given format.
	 *
	 * @param $format the format, for the PHP function date(), to use.
	 * @public
	 */
	function DateFormatter($format) {
		$this->format = $format;
		$this->disableCurrentYear();
	}
	
	/**
	 * Formats the given $time according to the values set in this object.
	 *
	 * @param $time the time in Unix time.
	 * @return the formated time.
	 */
	function format($time) {
		if ($this->currentYear < 0 or date('Y', $time) != $this->currentYear) {
			return date($this->format, $time);
		} else {
			return date($this->currentYearFormat, $time);
		}
	}
	
	/**
	 * Sets the current year and the format to use if the date to format
	 * is in that year.
	 */
	function setCurrentYear($year, $format) {
		$this->currentYear = $year;
		$this->currentYearFormat = $format;
	}
	
	/**
	 * Disables the feature that uses another date format for the current year.
	 * The feature is disabled by default and activated using setCurrentYear().
	 */
	function disableCurrentYear() {
		$this->currentYear = -1;
		$this->currentYearFormat = "";
	}
	
	/**
	 * Sets the format to use, for the PHP function date().
	 *
	 * @public
	 * @param $format the format to use, for the PHP function date().
	 */
	function setFormat($format) {
		$this->format = $format;
	}
	/**
	 * Returns the format to use, for the PHP function date().
	 *
	 * @public
	 * @return the format to use, for the PHP function date().
	 */
	function getFormat() {
		return $this->format;
	}
	
} //End of class DateFormatter

/**
 * Parses dates in legacy time formates.
 */
class LegacyDateParser {

	/**
	 * The parsed date in Unix time. Negative if not parsed or parsing failed.
	 *
	 * @private
	 */
	var $parsedDate = -1;
	
	/**
	 * Attemps to parse the legacy date. Returns @c true if successfull
	 * and @c false if the date was not recognized.
	 *
	 * @public
	 */
	function attemptParse($legacyDate) {
		//Assume failure
		$this->parsedDate = -1;
		
		//We know: lr d. 24/9-2005 kl. 12:32
		//Skip all before space no. 1, parse the rest. 'd.' and 'kl.' is static.
		
		$therest = $legacyDate;
		$day = -1;
		$month = -1;
		$year = -1;
		$hour = -1;
		$minute = -1;
		$separators = array(' ', ' ', '/', '-', ' ', ' ', ':', NULL);
		for ($i = 0; $i < count($separators); $i++) {
			if ($separators[$i] === NULL) {
				$token = $therest;
				$therest = '';
			} else {
				$tmpPos = strpos($therest, $separators[$i]);
				if ($tmpPos === FALSE) {
					return FALSE;
				}
				$token = substr($therest, 0, $tmpPos);
				$therest = substr($therest, $tmpPos + 1);
			}

			switch ($i) {
				//Skip 0, 1 and 5.
				case 2:
					//24 - day of month.
					$day = $token;
					break;
				case 3:
					//9 - month.
					$month = $token;
					break;
				case 4:
					//2005 - year.
					$year = $token;
					break;
				case 6:
					//12 - hour.
					$hour = $token;
					break;
				case 7:
					//32 - minute.
					$minute = $token;
					break;
			} //End switch.
		} //End for.
		
		//Have they all been filled out and are OK?
		if ($hour < 0 or $minute < 0 or $month < 0 or $day < 0 or $year < 0) {
			//No
			return FALSE;
		}
		
		//Make the time.
		$this->parsedDate = mktime($hour, $minute, 0, $month, $day, $year);
		return true;
	}
	
	/**
	 * Attemps to format the @c $legacyDate. If it succeedes the date is
	 * formated using the given @c $timeFormat (for the PHP function date()).
	 * If it fails the @c $legacyDate is returned unchanged.
	 * 
	 * This function is handy for displaying a date in a given format, if it
	 * can be parsed, but have it displayed in its legacy format if it
	 * cannot be parsed.
	 *
	 * @param $legacyDate the date to parse.
	 * @param $timeFormat the format date() format to use on successfull
	 *                    parse. If an instance of DateFormatter as
	 *                    @c $timeFormat it is used instead of date().
	 * @return the formated or unchanged date.
	 */
	function parseToView($legacyDate, $timeFormat) {
		if ($this->attemptParse($legacyDate) === TRUE and $this->parsedDate >= 0) {
			//The date was parsed OK
			if (is_a($timeFormat, 'DateFormatter')) {
				return $timeFormat->format($this->parsedDate);
			} else {
				return date($timeFormat, $this->parsedDate);
			}
		} else {
			return $legacyDate;
		}
		
		echo "Should never get to here on line ".__LINE__ ." in ".__FILE__;
		exit;
	}
	
	/**
	 * Returns the latest parsed date in Unix time or negative if no date
	 * has been parsed or the parsing failed.
	 *
	 * @return the latest parsed date in Unix time or negative.
	 * @public
	 */
	function getParsedDate() {
		return $this->parsedDate;
	}

} //End of class LegacyDateParser

/**
 * Represents an error which has occured.
 */
class Error {
	
	/**
	 * The localized error message for the user, in plain text.
	 * 
	 * @private
	 */
	var $message;
	
	/**
	 * The type of error which occured. May only take the values of the
	 * $ERROR_TYPE_* &quot;constants&quot; defined in this class.
	 * 
	 * @private
	 */
	var $errorType;

	/**
	 * Creates a new instance.
	 * 
	 * @param $errorType the type of error. Must take one of the values given
	 *                   in the method {@link #setErrorType}.
	 * @param $message   the localized error message for the user, in plain
	 *                   text.
	 * @public 
	 */
	function Error($errorType, $message) {
		$this->setErrorType($errorType);
		$this->setMessage($message);
	}

	/**
	 * Returns the localized error message for the user, in plain text.
	 * 
	 * @return the localized error message for the user, in plain text.
	 * @returns String
	 * @public
	 */
	function getMessage() {
		return $this->message;
	}

	/**
	 * Sets the localized error message for the user, in plain text.
	 * 
	 * @param $message the localized error message for the user, in plain text.
	 * @returns void
	 * @public
	 */
	function setMessage($message) {
		$this->message = $message;
	}
	
	/**
	 * Returns the type of error which occured.
	 * Must take one of the values given in the method
	 * {@link #setErrorType}.
	 * 
	 * @returns int
	 * @return the type of error which occured.
	 * @public
	 */
	function getErrorType() {
		return $this->errorType;
	}

	/**
	 * Sets the type of error which occured.
	 * May only take the following values:<br>
	 * 0: No error<br>
	 * 1: Warning - the programs flow may be altered (e.g. to let the user
	 *    correct a value)<br>
	 * 2: Fatal error - the program should be halted and no data saved.
	 * 
	 * @param $errorType the type of error which occured.
	 * @public
	 */
	function setErrorType($errorType) {
		$this->errorType = $errorType;
	}
}

/**
 * Manages a collection of errors.
 */
class Errors {

	/**
	 * Array of the errors which has occured.
	 */
	var $errors;
	
	/** 
	 * Creates a new instance.
	 * 
	 * @public
	 */
	function Errors() {
		$this->errors = array();
	}
	
	/**
	 * Adds the $error (instance of Error) to the collection of errors.
	 * 
	 * @param $error the error to add.
	 * @returns void
	 * @public
	 */
	function addError($error) {
		$this->errors[] = $error;
	}

	/**
	 * Returns how many errors are represented by this class.
	 * 
	 * @returns int
	 * @return how many errors are represented by this class.
	 * @public
	 */
	function getCount() {
		return count($this->errors);
	}
	
	/**
	 * Returns an array of the errors represented by this class.
	 * 
	 * @returns Error[]
	 * @return an array of the errors represented by this class.
	 * @public
	 */
	function getErrors() {
		return $this->errors;
	}
	
	/**
	 * Returns if one or more errors has occured.
	 * 
	 * @returns boolean
	 * @return if one or more errors has occured.
	 * @public
	 */
	function isOccured() {
		return (count($this->errors) > 0);
	}

}

/**
 * This class can round a number in different ways.
 * <p>The given rules are enforced in the following order:<br>
 * The numer is rounded to comply with $maxDecimalsVisible. Then the
 * number is rounded to compy with $goForDecimalsVisible, if it non
 * negative. Ff $maxStrlen is non negative, the number is
 * rounded to comply with this rule. This rule will
 * not remove numbers before the <code>.</code>. Finally
 * $numbersOfSignificance is enforced.</p>
 * <h2>Examples</h2>
 * <p>Please refer to the <code>set</code>-methods for examples where only
 * the specific rules are used.</p>
 *
 * <p><b>Example n</b><br>
 * <pre>
 * $r = new Rounder();
 * $r->setZeroDotToPercent(-1);
 * $r->setMaxDecimalsVisible(4);
 * $r->setGoForDecimalsVisible(2);
 * $r->setMaxStrlen(6);
 * $r->setNumbersOfSignificance(-1); //Disabled
 * echo $r->formatNumber(132.9873235).&quot;\n&quot;;
 * </pre>
 * Output:<code>132.99</code></p>
 *
 * <p><b>Example n</b><br>
 * <pre>
 * $r = new Rounder();
 * $r->setZeroDotToPercent(-1);
 * $r->setMaxDecimalsVisible(4);
 * $r->setGoForDecimalsVisible(2);
 * $r->setMaxStrlen(-1); //Disabled
 * $r->setNumbersOfSignificance(-1); //Disabled
 * echo $r->formatNumber(43.00000567).&quot;\n&quot;;
 * </pre>
 * Output:<code>43.0</code> (Think <code>43.0000</code>)</p>
 *
 * <p><b>Example n</b><br>
 * <pre>
 * $r = new Rounder();
 * $r->setZeroDotToPercent(-1);
 * $r->setMaxDecimalsVisible(-1); //Do not enforce
 * $r->setGoForDecimalsVisible(-1); //Do not enforce
 * $r->setMaxStrlen(6);
 * $r->setNumbersOfSignificance(2);
 * echo $r->formatNumber(3759.93892).&quot;\n&quot;;
 * </pre>
 * Output:<code>3800.0</code> (Think <code>3800.00</code>)</p>
 *
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class Rounder
{
	/**
	 * The maximum numbers of decimas that must be visible.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $maxDecimalsVisible;

	/**
	 * The minimum numbers of decimas that must be visible.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $goForDecimalsVisible;

	/**
	 * The maximal length of the whole number as a <code>String</code>.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $maxStrlen;

	/**
	 * The number of digits of significance.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $numbersOfSignificance;

	/**
	 * The point that must be used.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $point;

	/**
	 * Shall a <code>%</code> be added to the returned number?
	 * <code>0</code> no, <code>1</code> yes.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $addPercent;

	/**
	 * Shall the number be multiplyed be 100 before the rules are enforced?
	 * <code>0</code> no, <code>1</code> yes.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $zeroDotToPercent;

	/**
	 * Instantiates the class.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $addPercent add a &quot;%&quot; to the end of the returned
	 *         number (<code>0</code>|1)
	 * @param $zeroDotToPercent multiply the returned number by 100.
	 * @param $maxDecimalsVisible the maximal number of decimals to include.
	 * @param $goForDecimalsVisible include only this number of decimals,
	 *         but not on the expense of <code>$maxDecimalsVisible</code>.
	 * @param $maxStrlen Round the number so only this amount of decimals
	 *         is returned.
	 * @param $numbersOfSignificance the amount of significant numbers.
	 * @param $point the char used as point. E.g. in USA '.' is used,
	 *         in Denmark ',' is used.
	 */
	function Rounder(
		$addPercent = 1,
		$zeroDotToPercent = 1,
		$maxDecimalsVisible = 5,
		$goForDecimalsVisible = 2,
		$maxStrlen = 4,
		$numbersOfSignificance = -1,
		$point = ','
		)
	{
		$this->setMaxDecimalsVisible($maxDecimalsVisible);
		$this->setGoForDecimalsVisible($goForDecimalsVisible);
		$this->setMaxStrlen($maxStrlen);
		$this->setNumbersOfSignificance($numbersOfSignificance);
		$this->setPoint($point);
		$this->setAddPercent($addPercent);
		$this->setZeroDotToPercent($zeroDotToPercent);
	}

	/**
	 * Returns the number in the format given by the rules.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $number the number that is to be formated.
	 * @return long the number that is formated.
	 */
	function formatNumber($number)
	{
		if ($this->getZeroDotToPercent() === 1)
			$number *= 100;
		if ($this->getMaxDecimalsVisible() !== -1)
			$number = $this->enforceMaxDecimalsVisible($number);
		if ($this->getGoForDecimalsVisible() !== -1)
			$number = $this->enforceGoForDecimalsVisible($number);
		if ($this->getMaxStrlen() !== -1)
			$number = $this->enforceMaxStrlen($number);
		if ($this->getNumbersOfSignificance() !== -1)
			$number = $this->enforceNumbersOfSignificance($number);
		if ($this->getPoint() !== "." and strpos($number,'.') !== false)
			$number = substr_replace($number,$this->getPoint(),strpos($number,"."),1);

		if ($this->getAddPercent() === 1)
			$number .= "%";

		return $number;
	}

	/**
	 * Apply the rule <code>$maxDecimalsVisible</code> to the number.
	 *
	 * @private
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $number the number the rule shall be applied to.
	 * @return long the number after the rule have been applied.
	 */
	function enforceMaxDecimalsVisible($number)
	{
		return round($number,$this->getMaxDecimalsVisible());
	}

	/**
	 * Apply the rule <code>$goForDecimalsVisible</code> to the number.
	 *
	 * @private
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $number the number the rule shall be applied to.
	 * @return long the number after the rule have been applied.
	 */
	function enforceGoForDecimalsVisible($number)
	{
		$amount = $this->getGoForDecimalsVisible();
		$dotAt = strpos($number,".");
		if ($dotAt !== false)
		{
			//A copy of the amount
			$theAmount = $amount;

			//Iterates the rest of the number, after the .
			for ($isAt=$dotAt+1;$isAt < strlen($number);$isAt++)
			{
				if (substr($number,$isAt,1) !== "0")
					$theAmount--;
				if ($theAmount === 0)
				{ /*Now $isAt has the index we shall round from*/
					return round($number,$isAt-$dotAt);
				}
			}

			//We didn't have to round, or couldn't.
			return $number;
		}
		else
		 return $number; /*There is no . in the number*/
	}

	/**
	 * Apply the rule <code>$maxStrlen</code> to the number.
	 *
	 * @private
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $number the number the rule shall be applied to.
	 * @return long the number after the rule have been applied.
	 */
	function enforceMaxStrlen($number)
	{
		$max = $this->getMaxStrlen();

		if (strlen($number) <= $max)
			return $number; /*The size is OK, nothing to do*/

		//How many decimals are there before the .?
		$numFDecimals = strpos($number,".");

		//How mouch shall we round?
		$roundThis = $max - $numFDecimals - 1;

		//If true: We can't round enough, but we can round some.
		if ($roundThis < 0)
			$roundThis = 0;

		return round($number,$roundThis);
	}

	/**
	 * Apply the rule <code>$numbersOfSignificance</code> to the number.
	 *
	 * @private
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $number the number the rule shall be applied to.
	 * @return long the number after the rule have been applied.
	 */
	function enforceNumbersOfSignificance($number)
	{
		$max = $this->getNumbersOfSignificance();
		$dotAt = strpos($number,".");

		if ($dotAt === false and strlen($number) <= $max or strlen($number) < $max)
			return $number; /*Nothing to do.*/

		/*The numbers of decimals before the .*/
		if ($dotAt !== false)
			$power = strlen($number) - strlen($dotAt)-1;
		else
			$power = strlen($number);

		//Round the number
		$factor = pow(10,$power);
		$number /= $factor;
		$number = round($number,$max);
		$number *= $factor;

		return $number;
	}


	/**
	 * Sets the maximum numbers of decimas that must be visible.
	 * Must be &gt;= to <code>$maxDecimalsVisible</code>.
	 * Set to &lt; 0 to disable.
	 * See the class description for the order in witch the rules
	 * are enforced in.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $maxDecimalsVisible the maximum numbers of decimas that
	 *         must be visible.
	 * @return void
	 */
	function setMaxDecimalsVisible($maxDecimalsVisible)
	{
		$this->maxDecimalsVisible = $maxDecimalsVisible;
	}

	/**
	 * Returns the maximum numbers of decimas that must be visible.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return int the maximum numbers of decimas that must be visible.
	 */
	function getMaxDecimalsVisible()
	{
		return $this->maxDecimalsVisible;
	}

	/**
	 * Sets the minimum numbers of decimas that must be visible.
	 * Must be &lt;= to <code>$maxDecimalsVisible</code>.
	 * Set to &lt; 0 to disable.
	 * See the class description for the order in witch the rules
	 * are enforced in.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $goForDecimalsVisible the minimum numbers of decimas that must be visible.
	 * @return void
	 */
	function setGoForDecimalsVisible($goForDecimalsVisible)
	{
		$this->goForDecimalsVisible = $goForDecimalsVisible;
	}

	/**
	 * Gets the minimum numbers of decimas that must be visible.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return int the minimum numbers of decimas that must be visible.
	 */
	function getGoForDecimalsVisible()
	{
		return $this->goForDecimalsVisible;
	}

	/**
	 * Sets the maximal length of the whole number as a <code>String</code>.
	 * Will not remove numbers before the <code>.</code>
	 * (<code>,</code> in some places).
	 * Set to &lt; 0 to disable.
	 * See the class description for the order in witch the rules
	 * are enforced in.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $maxStrlen the maximal length of the whole number as a <code>String</code>.
	 * @return void
	 */
	function setMaxStrlen($maxStrlen)
	{
		$this->maxStrlen = $maxStrlen;
	}

	/**
	 * Gets the maximal length of the whole number as a <code>String</code>.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return int the maximal length of the whole number as a <code>String</code>.
	 */
	function getMaxStrlen()
	{
		return $this->maxStrlen;
	}

	/**
	 * Sets the number of digits of significance.
	 * The number will be rounded so all digits except the first
	 * $numbersOfSignificance ones are 0.
	 * Set to &lt; 0 to disable.
	 * See the class description for the order in witch the rules
	 * are enforced in.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $numbersOfSignificance the number of digits of significance.
	 * @return void
	 */
	function setNumbersOfSignificance($numbersOfSignificance)
	{
		$this->numbersOfSignificance = $numbersOfSignificance;
	}

	/**
	 * Gets the number of digits of significance.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return void the number of digits of significance.
	 */
	function getNumbersOfSignificance()
	{
		return $this->numbersOfSignificance;
	}

	/**
	 * Sets the point that must be used.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $point the point that must be used.
	 * @return void
	 */
	function setPoint($point)
	{
		$this->point = $point;
	}

	/**
	 * Gets the point that must be used.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return char the point that must be used.
	 */
	function getPoint()
	{
		return $this->point;
	}

	/**
	 * Sets shall a <code>%</code> be added to the returned number?
	 * <code>0</code> no, <code>1</code> yes.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return void
	 * @param $addPercent shall a <code>%</code> be added to the returned number?
	 */
	function setAddPercent($addPercent)
	{
		$this->addPercent = $addPercent;
	}

	/**
	 * Gets shall a <code>%</code> be added to the returned number?
	 * <code>0</code> no, <code>1</code> yes.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return boolean shall a <code>%</code> be added to the returned number?
	 */
	function getAddPercent()
	{
		return $this->addPercent;
	}

	/**
	 * Sets shall the number be multiplyed be 100 before the rules are enforced?
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return void
	 * @param $zeroDotToPercent shall the number be multiplyed be 100 before the rules are enforced?
	 */
	function setZeroDotToPercent($zeroDotToPercent)
	{
		$this->zeroDotToPercent = $zeroDotToPercent;
	}

	/**
	 * Gets shall the number be multiplyed be 100 before the rules are enforced?
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return boolean shall the number be multiplyed be 100 before the rules are enforced?
	 */
	function getZeroDotToPercent()
	{
		return $this->zeroDotToPercent;
	}
}

/**
 * Returns the result of a persistence operation.
 *
 * Currently this class is not used, but is intended for a more
 * generalized persistence mechanisem in a future version.
 * 
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class PersistenceResult {

	/**
	 * Unknown error.
	 * Please avoid using this - it's a nightmare to debug.
	 */
	var $UNKNOWN = -1;
	
	/**
	 * No error - it went well!
	 */
	var $NO_ERROR = 0;
	
	/**
	 * The username contains charaters this source cannot handle.
	 */
	var $INVALID_USERNAME = 1;
	
	/**
	 * The user was not found, but the attempted operation requires that the
	 * user exists (e.g. load the users data).
	 */
	var $USER_NOT_FOUND = 2;
	
	/**
	 * User found, but data is corrupted beoynd recovery
	 */
	var $DATA_CORRUPTED = 3;
	
	/**
	 * User found, but could not be loaded due to internal failure
	 */
	var $FOUND_BUT_INTERNAL_ERROR = 4;
	
	/**
	 * Internal failure (e.g. could not connect to database).
	 */
	var $INTERNAL_ERROR = 5;
	
	/**
	 * The user exists, but the attempted operation requires that the user
	 * does not exist (e.g. create a new user).
	 */
	var $USER_EXISTS = 6;
	
	/**
	 * The result of the operation.
	 *
	 * The valid values are given by the constants (upper case vars) defined
	 * in this class. The values of the constants are subject to change so
	 * please do not rely on them to stay the same.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $error = 0;
	
	/**
	 * A technical text (preferably in english) that shortly describes
	 * an error that occured. This will only be shown to the system
	 * administrator, so it may contain sensible information.
	 *
	 * Is an empty string if no message is set. This situation will occure,
	 * so when using the string take it into account so the user does not
	 * see something stupid like: Here is a detailed error message: ""
	 */
	var $errorMsg = "";
	
	/**
	 * A localized error message that may be shown to the user.
	 *
	 * Is an empty string if no message is set. This situation will occure,
	 * so when using the string take it into account so the user does not
	 * see something stupid like: Here is a detailed error message: ""
	 */
	var $errorMsgLocale = "";

	/**
	 * Returns the result of the operation.
	 *
	 * The valid values are given by the constants (upper case vars) defined
	 * in this class. The values of the constants are subject to change so
	 * please do not rely on them to stay the same.
	 * 
	 * @return the result of the operation.
	 */
	function getError() {
		return $this->error;
	}
	
	/**
	 * The valid values are:
	 *
	 * The valid values are given by the constants (upper case vars) defined
	 * in this class. The values of the constants are subject to change so
	 * please do not rely on them to stay the same.
	 *
	 * @param $error an error code as specified in this method.
	 */
	function setError($error) {
		$this->error = $error;
	}
	
	/**
	 * Returns a technical text (preferably in english) that shortly describes
	 * an error that occured. This will only be shown to the system
	 * administrator, so it ***may contain SENSIBLE information***.
	 *
	 * Is an empty string if no message is set. This situation will occure,
	 * so when using the string take it into account so the user does not
	 * see something stupid like: Here is a detailed error message: ""
	 *
	 * @return a technical text that shortly describes an error that occured.
	 */
	function getErrorMsg() {
		return $this->errorMsg;
	}
	
	/**
	 * Sets a technical text (preferably in english) that shortly describes
	 * an error that occured. This will only be shown to the system
	 * administrator, so it may contain sensible information.
 	 * Is an empty string if no message is set. 
	 *
	 * @param $errorMsg a technical text that shortly describes an error
	 *                  that occured.
	 */
	function setErrorMsg($errorMsg) {
		$this->errorMsg = $errorMsg;
	}
	
	/**
	 * Returns a localized error message that may be shown to the user.
	 *
	 * Is an empty string if no message is set. This situation will occure,
	 * so when using the string take it into account so the user does not
	 * see something stupid like: Here is a detailed error message: ""
	 *
	 * @return a localized error message that may be shown to the user.
	 */
	function getErrorMsgLocale() {
		return $this->errorMsgLocale;
	}

	/**
	 * Sets a localized error message that may be shown to the user.
	 * Is an empty string if no message is set.
	 *
	 * @param $errorMsgLocale a localized error message that may be shown
	 *                        to the user.
	 */
	function setErrorMsgLocale($errorMsgLocale) {
		$this->errorMsgLocale = $errorMsgLocale;
	}
}

/**
 * Implemented by classes that can handle persistence.
 *
 * Currently this class is not used, but is intended for a more
 * generalized persistence mechanisem in a future version.
 * 
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class PersistenceSource {

	/**
	 * The name of the represented user. An empty string if not specified.
	 * Some functions may require this to be set.
	 * The class should not require this to be instantiated. Instead it
	 * should be set by methods like attemptLoad.
	 */
	var $username;

	function PersistenceSource() {
	}

	/**
	 * Returns the username
	 */
	function getUsername() {
		return $this->username;
	}

	/**
	 * Returns a string that identify the source. E.g. "mysql.20" or "textfile".
	 *
	 * @return a string that identify the source. E.g. "mysql.20" or "textfile".
	 */
	function getMethodId() {
		echo "The method PersistenceSource::getMethodId must be overridden, but it is not.";
		exit;
	}
	
	/**
	 * Returns if the given user exists (true) or not (false).
	 *
	 * @param $username the user in question.
	 */
	function userExists($username) {
		echo "The method PersistenceSource::create must be overridden, but it is not.";
		exit;
	}
	
	/**
	 * Attempts to create a user with the given $username.
	 * The method will fail if the user exists.
	 *
	 * @param $username the user to attempt to create.
	 * @return NULL if successfull or an instance of PersistenceResult.
	 */
	function create($username) {
		echo "The method PersistenceSource::create must be overridden, but it is not.";
		exit;
	}
	
	/**
	 * Attempts to load the user identified by the username.
	 *
	 * @param $username the user to attempt to load
	 * @return NULL if successfull or an instance of PersistenceResult.
	 */
	function attemptLoad($username) {
		echo "The method PersistenceSource::create must be overridden, but it is not.";
		exit;
	}
	
	/**
	 * Saves the users data.
	 * This method requires that the users data has been loaded using a
	 * function like attemptLoad.
	 *
	 * @return an instance of PersistenceResult.
	 */
	function persist() {
		echo "The method PersistenceSource::persist must be overridden, but it is not.";
		exit;
	}

}

/**
 * Provies a general interface for any data source that may be used.
 *
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class DataSource
{
	/**
	 * The username of the represented user.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $brugernavn;

	 /**
	  * An instance of the site context.
	  *
	  * @private
	  * @since 0.0.1
	  */
	 var $siteContext;

	 /**
	  * An instance of <code>Stier</code>.
	  *
	  * @private
	  * @since 0.0.1
	  */
	 var $path;

   /**
    * Set to 'hit' when saving due to a hit registered.
    * Set to 'maint' when saving due to maintance.
    * This will cause the proper time stamps to be set.
    */
	 var $operation = null;

	/**
	 * Creates a new instance.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 2.1.0
	 * @author Simon Mikkelsen
	 * @param $username the username
	 * @param $settings an instance of the settings object.
	 * @return DataSource
	 */
	function DataSource($username, &$settings)
	{
		//Validate the username
		if ($this->isUsernameValid($username))
		{
			$this->setUsername($username);
		}

		$this->setPath($settings);
	}

	function setOperation($op) {
	   if ($op != 'hit' and $op != 'maint') {
       die('Unsupported operation value given.');
	   }
     $this->operation = $op;
	}

	/**
	 * Logs the given $visit in the collective stats.
	 * An actual implementation may not be avalible from all data sources.
	 * In that case the method does nothing.
	 *
	 * @param $visit an instance of the class Visit.
	 */
	function logVisitCollectively($visit) {
		echo "Error: The method logVisitCollectively must be derived by any class that derives DataSource.";
		exit;
	}
	
	/**
	 * Returns a representation of the data that can be used for backup.
	 * 
	 * @return a representation of the data that can be used for backup.
	 */
	function getBackup() {
		die("This method getBackup must be derived by any class that derives DataSource.");
	}

	/**
	 * Creates and returns a new instance of the current data source.
	 *
	 * @public
	 * @param $username  the username to create an instance for.
	 * @param $options   an instance of the class that provides options.
	 */
	function createInstance($username, &$options) {
		return new PersistenceMgr($username, $options);
	}
	
	/**
	 * Creates and returns a new instance of the current CollectiveReader.
	 *
	 * @public
	 * @param $options an instance of the class that provides options.
	 * @return instance of the current CollectiveReader.
	 */
	function createCollectiveReader(&$options) {
		return new MySqlCollectiveReader($options);
	}
	
	/**
	 * Creates and returns a new instance of the current {@link ContentCache}.
	 *
	 * @public
	 * @param $options an instance of the class that provides options.
	 * @return instance of the current {@link ContentCache}.
	 */
	function createContentCache(&$options) {
		return new MySqlContentCache($options);
	}

	/**
	 * States if the given username is a valid username.
	 * This method does not tell if the username exists.
	 *
	 * @public
	 * @return boolean @c true if the username is valid, else @c false.
	 * @static
	 */
	function isUsernameValid($username)
	{
		return ! preg_match("/[^a-z0-9_\-]/i", $username);
	}

	/**
	 * Returns the represented username.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return String the username.
	 */
	 function getUsername()
	 {
		 return $this->brugernavn;
	 }
	 
	 /**
	  * Returns the value of the given setting.
		*
		* The current valid keys are:
		* @li @c ignoreQuery Ignore query string of the url for counters. Values: false for no, true (or everything else, default) for yes.
		*
		* @param $key the key of the setting to return.
		* @return the value corresponding to the given key or @c false (not
		*         the string but @c === @c false) if the key is undefined.
		* @public
	  */
	 function getUserSetting($key) {
		 //Unpack the string. If the input is garbage, do not let that disturbe us.
		 @parse_str($this->getLine(108), $values);
		 
		 //Return the value or false for undefined.
		 if (isset($values[$key])) {
			 return $values[$key];
		 } else {
			 return false;
		 }
	 }
	 
	 /**
	  * Sets the value of the given setting.
		*
		* @see getUserSetting() for valid keys.
		* @param $key the key of the setting to set.
		* @param $value the value of the setting to set.
		* @public
	  */
	 function setUserSetting($key, $value) {
		 //Unpack the string. If the input is garbage, do not let that disturbe us.
		 @parse_str($this->getLine(108), $values);
		 
		 //Set the value.
		 $values[$key] = $value;
		 
		 //Build the settings string to save.
		 $settingsStr = "";
		 foreach ($values as $setKey => $setVal) {
			$settingsStr .= urlencode($setKey)."=".urlencode($setVal)."&";
		 }
		 
		 //Cut off the trailing &:
		 $settingsStr = substr($settingsStr, 0, strlen($settingsStr) -1);
		 
		 //Persist the result.
		 $this->setLine(108, $settingsStr);
	 }
	 

	/**
	 * Returns an object that represents the requested line.
	 * If multiple lines are involved in the creation of the object, the
	 * the object is returned no matter which of the lines are requested.
	 * 
	 * It is recommended always to use these objects, if they are avalible.
	 * The following lines can be represented by objects:<br>
	 * 51: The reset dates.<br>
	 *
	 * @param $index the requested line index.
	 * @public
	 * @return Object An object that represents the given index.
	 */
	 function getLineObj($index)
	 {
		 if ($index == 51)
		 	return new Resets($this->getLine(51));
//		 if ($index == 61) /*Protid*/
//		 	return new Protid($this->getLine(61));
//		 elseif ($index == 108) /*Brugerspecifikke indstillinger*/
//		 	return new KoeberInfo($this->getLine(108));
		 else
		 {
			 //If the line cannot be represented.
			 echo "<b>Error: lib.php getLinieObj(): This linie ($index) can't yet be represented by an object.";
			 exit;
		 }
	 }

	 /**
	  * Sets a line using an instance of the class which represents the
	  * line(s). Currently only the class <code>Protid</code> supported.
		*
		* @note This method is not used, and cannot do anything. The concept of
		*       representing different kinds of data as object is good, so
		*       consider using it in the future.
	  */
	 function setLineObj(&$obj)
	 {
		 //if (strtolower(get_class($obj)) == "protid")
			// $this->setLine(61,$obj->getLine());
		 //else
		 if (false)
		 {
			 //If the object cannot be used to anything.
			 echo "<b>Error: lib.php setLineObj(): The given object, <code>".get_class($obj)."</code>, is not supported.";
			 exit;
		 }
	 }

	 /**
	  * Stter et antal linier der er i en array.
	  * Frste parameter er en array med elementer.
	  * Den flgende parameter er en integer der angiver element 0's
	  * nummer i datafilen, parametren derefter er nummeret for
	  * element 1 osv.
	  *
	  * @public
	  * @version 0.0.1
	  * @since 0.0.1
	  */
	function setLines()
	{
		if (func_num_args() < 2)
		{
			echo "<b>Error:</b> Line ".__LINE__."in Html.php function setLines() in class <code>Datafil</code>: A minimum of 2 arguments required.";
			exit;
		}
		if (!is_array(func_get_arg(0)))
		{
			echo "<b>Error:</b> Line ".__LINE__."in Html.php function setLines() in class <code>Datafil: 1st argument must be an array.";
			exit;
		}

		$lines = func_get_arg(0);
		for ($i = 1; $i < func_num_args();$i++)
			$this->setLine(func_get_arg($i),$lines[$i-1]);
	}

	 /**
	  * Returns an instance of the site context.
	  *
	  * @public
	  * @since 0.0.1
	  * @version 0.0.1
	  * @return SiteContext an instance of the site context.
	  */
	 function &getSiteContext()
	 {
		 return $this->siteContext;
	 }

	 /**
	  * Sets an instance of the site context.
	  *
	  * @public
	  * @since 0.0.1
	  * @version 0.0.1
	  * @param void $siteContext an instance of the site context.
	  */
	 function setSiteContext(&$siteContext)
	 {
		 $this->siteContext = &$siteContext;
	 }

	 /**
	  * Returns an instance of <code>Stier</code>.
	  *
	  * @public
	  * @since 0.0.1
	  * @version 0.0.1
	  * @return Stier an instance of <code>Stier</code>.
	  */
	 function &getPath()
	 {
		 return $this->path;
	 }

	 /**
	  * Sets an instance of <code>Stier</code>.
	  *
	  * @public
	  * @since 0.0.1
	  * @version 0.0.1
	  * @return void
	  * @param $path an instance of <code>Stier</code>.
	  */
	 function setPath(&$path)
	 {
		 $this->path = &$path;
	 }

	/**
	 * Sets the represented username.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @param $brugernavn the represented username.
	 * @return void
	 */
	 function setUsername($brugernavn)
	 {
		 if ($this->isUsernameValid($brugernavn))
		 	$this->brugernavn = $brugernavn;
	 }

}

/**
 * Makes it possible to handle data in a MySQL database.
 Database format:
 id
 username
 date
 data
 
 Format of visits:
 day (day+month+year)
 data_type enum(day, browser, os, color, screenres)
 hits
 unique (1 or 0)
 
 Two tables for visits exists: Today and archive
 *
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class DatabaseMysqlSource extends DataSource
{
	
	/**
	 * The users data formated as used by DataFileSource.
	 *
	 * @private
	 */
	var $dataArray;
	
	/**
	 * The name of the table for logging hits collectively.
	 * The attribute is just a cache and if there are any disputes about
	 * the name, this attribute will loose.
	 *
	 * @private
	 */
	var $dbTableCollective;
	
	/**
	 * The name of the archive table for logging hits collectively.
	 * The attribute is just a cache and if there are any disputes about
	 * the name, this attribute will loose.
	 *
	 * @private
	 */
	var $dbTableCollectiveArcive;
	
	/**
	 * The instance of MySqlAccess used to connect to the database.
	 *
	 * @private
	 */
	var $db;

        var $fieldsWhitelist = array('statsitePublic' => 'boolean');
	
	/**
	 * Creates a new instance.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @author Simon Mikkelsen
	 * @param $username the username
	 * @param $options an instance of the settings object.
	 * @return DatabaseMysqlSource
	 */
	function DatabaseMysqlSource($username, &$options)
	{
		$this->setPath($options);
		//Cache for other methods
		$this->dbTableCollective = $this->path->getOption('DB_tablename_visits');
		$this->dbTableCollectiveArcive = $this->path->getOption('DB_tablename_visits_archive');

		//Validate the username
		if ($this->isUsernameValid($username))
		{
			$this->setUsername($username);
		}
		
		//Create the connection to the database
		$this->db = new MySqlAccess($options);
	}

	/**
	 * Returns a string that identify the source. E.g. "mysql.20" or "textfile".
	 *
	 * @return a string that identify the source. E.g. "mysql.20" or "textfile".
	 */
	function getMethodId() {
		return "mysql.20";
	}

	/**
	 * States if the current username exists.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return boolean true if the username exists, else false.
	 */
	function findesBrugernavn() {
		$sql = "SELECT id FROM ".$this->getTableName()
		    ." WHERE username=\"" .$this->db->secureSlashes($this->brugernavn)."\"";
		$res = $this->db->runQuery($sql);
		return sizeof($res) > 0;
	}

	/**
	 * Logs the given $visit in the collective stats.
	 * An actual implementation may not be avalible from all data sources.
	 * In that case the method does nothing.
	 *
	 * @param $visit an instance of the class Visit.
	 * @public
	 */
	function logVisitCollectively($visit) {
		/*
			day (YYYYMMDD)
			data_type enum(day,
			               browser,
			               os,
			               color,     //In bits
			               screenres, //Value: XxY
			               searchEngine,
			               searchWord,
			               java, //Java enabled: Value: 0 false, 1 true, 2 unknown
			               js,   //Java script enabled: Value:  0 false, 1 true, 2 unknown
			               language,
			               topdom)
			hits
			isUnique (1 or 0)
			value
		*/
		/*
			getUnique()
			getTime()
			getBrowser()
			getOs()
			getResolution()
			getColorDepth()
			getUnique()
			getSearchEngine()
			getSearchWords()
			getJavaEnabled()
			getJavaScriptEnabled()
			getLanguage()
			getTopdom()
*/
		$this->updateVisitCollectively("day", $visit->getTime(), date("YmdH",
		                  $visit->getTime()), $visit->getUnique());
		$this->updateVisitCollectively("browser", $visit->getTime(),
		                  $visit->getBrowser(), $visit->getUnique());
		$this->updateVisitCollectively("os", $visit->getTime(),
		                  $visit->getOs(), $visit->getUnique());
		$this->updateVisitCollectively("screenres", $visit->getTime(),
		                  $visit->getResolution(), $visit->getUnique());
		$this->updateVisitCollectively("color", $visit->getTime(),
		                  $visit->getColorDepth(), $visit->getUnique());
		$this->updateVisitCollectively("java", $visit->getTime(),
		                  $visit->getJavaEnabled(), $visit->getUnique());
		$this->updateVisitCollectively("js", $visit->getTime(),
		                  $visit->getJavaScriptEnabled(), $visit->getUnique());
		$this->updateVisitCollectively("language", $visit->getTime(),
		                  $visit->getLanguage(), $visit->getUnique());
		$this->updateVisitCollectively("topdom", $visit->getTime(),
		                  $visit->getTopdom(), $visit->getUnique());
		$this->updateVisitCollectively("searchEngine", $visit->getTime(),
		                  $visit->getSearchEngine(), $visit->getUnique());
		/*
		if (is_array($visit->getSearchWords())) {
			foreach ($visit->getSearchWords() as $word) {
				$this->updateVisitCollectively("searchWord", $visit->getTime(),
				              $word, $visit->getUnique());
			}
		}
		*/
	}
	
	/**
	 * Counts 1 up in the given $column. If it does not exists it is created.
	 *
	 * @param $dataType the data type to update for.
	 * @param $unixtime the date to update for in unixtime.
	 * @param $value    the value of the field to update.
	 * @param $unique   if the visit is unique. 1 for unique, 0 for none unique.
	 * @private
	 */
	function updateVisitCollectively($dataType, $unixtime, $value, $unique) {
		if (! isset($value) or $value === "") {
			//Don't log nothing
			return;
		}
	
		/*$sql = "UPDATE $tableName SET hits=hits+1"
		                ." WHERE data_type=\"$dataType\" AND day=FROM_UNIXTIME("
		                .$this->db->secureSlashes($unixtime).")"
		                ." AND isUnique=$unique AND value=\""
		                .$this->db->secureSlashes($value)."\";";*/
		$sql = "INSERT INTO ".$this->dbTableCollective." SET "
		      ."day=FROM_UNIXTIME(".$this->db->secureSlashes($unixtime)."), "
		      ."data_type='$dataType', "
		      ."hits='1', "
		      ."isUnique='$unique', "
		      ."value='".$this->db->secureSlashes($value)."'"
		      ." ON DUPLICATE KEY UPDATE hits = hits + 1; ";

		$this->db->runQuery($sql, FALSE);
	}

	/**
	 * Returns the name of the main table used.
	 */
	function getTableName() {
		return $this->path->getOption('DB_tablename_main');
	}
	
	/**
	 * Deletes the represented user.
	 * 
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return TRUE on success or FALSE on faliure (as the PHP function unlink).
	 * @returns boolean
	 */
	function deleteUser() {
		$sql = "DELETE FROM ".$this->getTableName()." WHERE username=\"".$this->db->secureSlashes($this->brugernavn)."\"";
		$this->db->runQuery($sql, false);
		return ($this->db->latestQueryAffected() > 0);
	}

	/**
	 * Fetches the users data file.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return boolean 1 if the file was fetched, -2 if the data file is
	 *                 corrupt, else 0.
	 */
	function hentFil()
	{
                // Read main data field.
		$sql = "SELECT * FROM ".$this->getTableName()." WHERE username=\"".$this->db->secureSlashes($this->brugernavn)."\"";
		$res = $this->db->runQuery($sql);

		if (sizeof($res) === 0 or ! isset($res[0]['data']) or strlen($res[0]['data']) === 0)
			return 0;
		$this->dataArray = array();
		$this->dataArray = explode("\n", stripslashes($res[0]['data']));

                // Read additional data fields.
                $this->fieldsValues = array();
                foreach ($this->fieldsWhitelist as $field => $type) {
                  $this->fieldsValues[$field] = $this->readField($res[0], $field, $type);
                }

		return 1;
	}

        function readField($fieldsHash, $fieldName, $fieldType) {
          if ($fieldType === 'boolean') {
            return isset($fieldsHash[$fieldName]) and $fieldsHash[$fieldName] === '1';
          } else {
            die("Unsupported field type: '$fieldType'.");
          }
        }

        function getWriteFieldValue($name) {
          array_key_exists($name, $this->fieldsWhitelist) or die("Unknown field (1): '$name'.");
          if ($this->fieldsWhitelist[$name] === 'boolean') {
            return $this->fieldsValues[$name] === TRUE ? '1' : '0';
          } else {
            die("Field with unsupported type: '$name'.");
          }
        }

        function getField($name) {
          array_key_exists($name, $this->fieldsWhitelist) or die("Unknown field (2): '$name'.");
          return $this->fieldsValues[$name];
        }

        function setField($name, $value) {
          array_key_exists($name, $this->fieldsWhitelist) or die("Unknown field (3): '$name'.");
          $this->fieldsValues[$name] = $value;
        }
	
	/**
	 * Creates the current user, if non existent.
	 *
	 * @return <code>true</code> if it went well, else <code>false</code>.
	 */
	function createUser()
	{
		if ($this->findesBrugernavn())
			return false;

		$sql = "INSERT INTO ".$this->getTableName()." (username, data) VALUES (\"".$this->db->secureSlashes($this->brugernavn)."\", \"\")";
		$this->db->runQuery($sql, false);
		return $this->db->latestQueryAffected() === 1;
	}

	/**
	 * Saves the represented data file.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @param $saveTimes the number of times the data file should
	 *        be attempted saved, if not saved correctly. This
	 *        parameter is primary ment to make it useable to let
	 *        the function invoke itself (recursively).
	 * @return boolean <code>true</code> if the file was saved, else
	 *         <code>false</code>.
	 */
	function gemFil($saveTimes = 3)
	{
                // Prepare fields.
                $fieldSQL = '';
                foreach ($this->fieldsWhitelist as $field => $type) {
                  $fieldSQL .= ', ' . $field . '="'.$this->db->secureSlashes($this->getWriteFieldValue($field)).'"';
                }

                // Prepare old data structure.
		$this->prepareForImplode();

		$timestampSql = '';
		if ($this->operation == 'hit') {
		  $timestampSql = ', latestVisit = NOW()';
		} else if ($this->operation == 'maint') {
		  $timestampSql = ', latestMaintenance = NOW()';
	  }
		//Save the data.
		$userdata = $this->db->secureSlashes(implode("\n", $this->dataArray));
		$sql = "UPDATE ".$this->getTableName()
		      ." SET data=\"".$userdata."\"" . $fieldSQL . $timestampSql ." WHERE username=\""
		      .$this->db->secureSlashes($this->brugernavn)."\"";
		$this->db->runQuery($sql, false);
		$noAffectedRows = $this->db->latestQueryAffected();
		return $noAffectedRows > 0;
	}
	
	/**
	 * Prepares $this->dataArray for the <code>implode</code> method,
	 * by making sure that all indecies are set.
	 */
	function prepareForImplode() {
		//Make sure all indecies are set.
		for ($i = 0; $i < $this->getLinesInDataFile(); $i++) {
			if (! isset($this->dataArray[$i]) or $this->dataArray[$i] == ""
			     or strlen($this->dataArray[$i]) === 0) {
				$this->dataArray[$i] = "";
			} else {
                                $this->dataArray[$i] = trim($this->dataArray[$i]);
				$this->dataArray[$i] = str_replace(array("\n", "\r"), "", $this->dataArray[$i]);
			}
		}
 
	}

	/**
	 * Returns a representation of the data that can be used for backup.
	 * 
	 * @public
	 * @return a representation of the data that can be used for backup.
	 */
	function getBackup() {
		$backup = "INSERT INTO zs20_main SET username=\"".addslashes($this->getUsername())."\", data=\"";
		
		$backup .= addslashes(implode("\n", $this->dataArray));
		$backup .= "\"";
		return $backup;
	}
	
	/**
	 * Returns if the $username/$password combination can be authenticated
	 * against the main password.
	 * 
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return boolean if the user can be authenticated.
	 * @param $username the username to authenticate.
	 * @param $password the password to authenticate.
         * @param $requiredPermission the permission the user must have.
         * @param $getOnLogin the permissions the user must be on successfull login.
	 */
	function authenticate($username, $password = NULL, $requiredPermission, $getOnLogin) {
                $sessionFactory = new SessionFactory($this->path);
                $session = $sessionFactory->create();
                $permissions = $session->getSessionPermissions($username);
                if ($permissions !== NULL and in_array($requiredPermission, $permissions)) {
                  return TRUE;
                }
                $session->closeSession();
                if ($password === NULL) {
                  return FALSE;
                }

		$sql = "SELECT * FROM ".$this->getTableName()." WHERE username=\"".$this->db->secureSlashes($this->brugernavn)."\"";
		$res = $this->db->runQuery($sql);
		if (sizeof($res) === 0) {
			return false;
		}
		$data = explode("\n", $res[0]['data']);
		$rpassword = stripslashes(str_replace(array("\n", "\r"), "", $data[6]));
                
                $authFactory = new AuthenticationFactory($this->path);
                $auth = $authFactory->create();
                if ($auth->doAuthenticate($username, $password, $rpassword)) {
                     if ($rpassword !== NULL and $rpassword !== "") {
                       $this->hentFil();
                       $this->dataArray[6] = "";
                       $this->gemFil();
                     }
                   $newPermission = is_array($getOnLogin) ? $getOnLogin : array($getOnLogin);
		   $session->createNewSession($username, $newPermission, FALSE);
                   return TRUE; 
                }
                return FALSE;
	}

	/**
	 * Returns the number of lines in the data file.
	 * This is a fixed, hardcoded number, that only may be expanded.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return int the number of lines in the data file.
	 */
	function getLinesInDataFile()
	{
		return 120;
	}

	/**
	 * Returns the line corresponding to the parameter.
	 * All new line charaters are removed.
	 * The first line has index 0 (zero).
	 *
	 * @param $index the index of the requested line.
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return String the requested line.
	 */
	function getLine($index)
	{
		return stripslashes($this->dataArray[$index])	;
	}

	/**
	 * Returns the line that corresponds to the parameter,
	 * as an array (<code>Stirng[]</code>). All new line charchars are
	 * removed. The first line has the index 0, and the first element
	 * in the returned array has index 0 in the returned array.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $index the index of the wanted line.
	 * @return String[] the line as an array
	 */
	function getLineAsArray($index)
	{
		return explode("::", $this->dataArray[$index]);
	}

	 /**
	 * Sets the contents of the file.
	 * Makes sure that the line always only has one new-line charater in the
	 * end, and no where else.
	 *
	 * @param $index the index of the requested line.
	 * @param $line the contents of the line to set.
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return void
	 */
	 function setLine($index,$line)
	 {
	 	$this->dataArray[$index] = $line;
	 }
	
	/**
	 * Lists all usernames. If $notOlderThan is given, only usernames which
	 * have been active after the given time (in seconds, unix time), will
	 * be returned,
	 * 
	 * @param $notOlderThan only return usernames accessed after this
	 *                      unix time (in seconds).
	 * @returns String[]
	 */
	function listUsernames($notOlderThan = -1) {
		echo "Function listUsernames not implemented for mysql data source.";
		exit;
	}
	
}

/**
 * Provides access and common methods for a MySQL database.
 *
 * @author Simon Mikkelsen
 */
class MySqlAccess
{
	/**
	 * The database connection to use.
	 *
	 * @private
	 */
	var $conn;
	
	/**
	 * The options.
	 *
	 * @private
	 */
	var $options;
	
	/**
	 * Creates a new instance.
	 *
	 * @public
	 * @author Simon Mikkelsen
	 * @param $options an instance of the settings object.
	 */
	function MySqlAccess(&$options)
	{
		$this->options = &$options;
		$this->conn = $this->openDatabase();
	}

	/**
	 * Opens and returns a connection to the database.
	 *
	 * @return a connection to the database.
	 * @private
	 */
	function openDatabase() {
		//Get info for connecting
		$db = $this->options->getOption('DB_database');
		$user = $this->options->getOption('DB_username');
		$host = $this->options->getOption('DB_hostname');
		$passwd = $this->options->getOption('DB_password');

		$conn = mysql_connect($host, $user, $passwd);
		if ($conn) {
			if (! mysql_select_db($db, $conn))
				$status = mysql_error();
			else
				$status= 0;
		} else {
			$status = mysql_error();
		}
	
		if (! $conn) {
			echo "Can not connect to database - try later. Sorry.";
			exit;
		}
	
		return ($conn);
	}

	/**
	 * Escapes the $sql if nessasery.
	 *
	 * @param $sql the SQL the escape
	 * @param the escaped SQL.
	 */
	function secureSlashes($sql) {
		if (get_magic_quotes_gpc() === 1) {
			return mysql_real_escape_string(stripslashes($sql));
		} else {
			return mysql_real_escape_string($sql);
		}
	}
	
	/**
	 * Runs the $sql query on the database and returns an array of associative
	 * arrays with the result.
	 *
	 * @param $sql the query to run.
	 * @param $outputExpected if output is expected (true or false).
	 */
	function runQuery($sql, $outputExpected = TRUE) {
		$result = mysql_query($sql, $this->conn);
		if ($result === FALSE) {
			die("Unfortunally there was an internal error in what is called an SQL query. If this error does not go away, please contact the administrator of this website. We are very sorry!");
		}
		
		if (($outputExpected !== TRUE) or $result === FALSE)
			return array();

		$resultArray = array();

		while ($indl = mysql_fetch_array($result)) {
 			$resultArray[] = $indl;
 			unset($indl);
		}
		return $resultArray;
	}
	
	/**
	 * Returns the number of rows the latest query affected.
	 *
	 * @return Returns the number of rows the latest query affected.
	 */
	function latestQueryAffected() {
		return mysql_affected_rows($this->conn);
	}

}

/**
 * Makes it possible to use the old Datafil class with the new
 * DataFileSource.
 */
class Datafil extends DataFileSource
{
	
}

/**
 * Representerer en datafil.
 * <p><b>Fil: Html.php</b></p>
 *
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class DataFileSource extends DataSource {
	/**
	 * States the path to the folder containing the data files.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $_datamappe;

	/**
	 * The contents of the data file in an array with one line for each
	 * index. Any line may or may not contain a new line charater at the
	 * end of the line.
	 *
	 * @private
	 * @since 0.0.1
	 */
	 var $datafil;

	/**
	 * Creates a new instance.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @author Simon Mikkelsen
	 * @param $brugernavn the username
	 * @param $stier an instance of the settings object.
	 * @return Datafil
	 */
	function DataFileSource($brugernavn, &$stier)
	{
		//Validate the username
		if ($this->isUsernameValid($brugernavn))
		{
			$this->_datamappe = $stier->getSti('zipstat_datafiler');
			$this->setUsername($brugernavn);
		}

		$this->setPath($stier);
	}

	/**
	 * Returns a string that identify the source. E.g. "mysql.20" or "textfile".
	 *
	 * @return a string that identify the source. E.g. "mysql.20" or "textfile".
	 */
	function getMethodId() {
		return "textfile";
	}

	/**
	 * Logs the given $visit in the collective stats.
	 * An actual implementation may not be avalible from all data sources.
	 * In that case the method does nothing.
	 *
	 * @param $visit an instance of the class Visit.
	 */
	function logVisitCollectively($visit) {
		//Not supported, do nothing
	}

	/**
	 * States if the current username exists.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return boolean true if the username exists, else false.
	 */
	function findesBrugernavn()
	{
		return $this->isUsernameValid($this->getUsername()) and
					file_exists($this->getFilnavn());
	}
	
	/**
	 * Deletes the represented user.
	 * 
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return TRUE on success or FALSE on faliure (as the PHP function unlink).
	 * @returns boolean
	 */
	function deleteUser() {
		return unlink($this->getFilnavn());
	}

	/**
	 * Gives the path to the user file belonging to the given username.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return String the path to the users data file.
	 * @param $brugernavn the username to translate into a file name. If not
	 *                    given the username this object is instantiated
	 *                    with.
	 */
	function getFilnavn($brugernavn = "")
	{
		if ($brugernavn !== "")
			return $this->_datamappe."/".$brugernavn.".txt";
		else
			return $this->_datamappe."/".$this->getUsername().".txt";
	}

	/**
	 * Returns the name of the file which shall be used to save the backup
	 * file in.
	 */
	function getBackupFilename($username = "")
	{
		if ($username !== "")
			return $this->_datamappe."/".$username.".txt";
		else
			return $this->_datamappe."_backup/".$this->getUsername().".txt";
	}

	/**
	 * Fetches the users data file.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return boolean 1 if the file was fetched, -2 if the data file is
	 *                 corrupt, else 0.
	 */
	function hentFil()
	{
		if ($this->findesBrugernavn())
		{
			//Read the data file into an array
			$datafil = $this->readContens($this->getFilnavn());
			if (($datafil === false or ! $this->datafilOk($datafil)) and file_exists($this->getBackupFilename()))
			{
				$datafil = $this->readContens($this->getBackupFilename());
			}

			if ($this->datafilOk($datafil))
			{
				$this->datafil = $datafil;
				return 1;
			}
			else
				return -2;
		}

		//Hvis det gik galt.
		return 0;
	} /*End of function hentfil()*/

	/**
	 * States if the data file is ok.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return boolean true if the data file is ok, else false.
	 */
	function datafilOk($datafil = -1)
	{
		if ($datafil === -1)
			$datafil = $this->datafil;

		if (!is_array($datafil))
			return false;
		else
			return preg_match("/filen er ok/",$datafil[0]);
	}
	
	/**
	 * Creates the current user, if non existent.
	 *
	 * @return <code>true</code> if it went well, else <code>false</code>.
	 */
	function createUser()
	{
		//If user name is ok but does not exist: Create it
		if ($this->isUsernameValid($this->getUsername()
		      and (! $this->findesBrugernavn()))) {
			$fp = fopen($this->getFilnavn(), 'w');
			fwrite($fp, '');
			fclose($fp);
			chmod($this->getFilnavn(), 0666);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Saves the represented data file.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @param $saveTimes the number of times the data file should
	 *        be attempted saved, if not saved correctly. This
	 *        parameter is primary ment to make it useable to let
	 *        the function invoke itself (recursively).
	 * @return boolean <code>true</code> if the file was saved, else
	 *         <code>false</code>.
	 */
	function gemFil($saveTimes = 3)
	{
		if ($this->findesBrugernavn() and $this->datafilOk())
		{
			//Remove all new lines and carrige returns and finally
			//put a \n in the end
			$this->datafil = str_replace(array("\n", "\r"), "", $this->datafil);
			//$this->datafil = str_replace("\r", "", $this->datafil);

			$this->datafil = array_slice($this->datafil,0,120);
			for ($i = 0; $i < sizeof($this->datafil); $i++)
			{
				$this->datafil[$i] .= "\n";
			}

			$datafileContens = implode("",$this->datafil);

			//Write backup file if possible
			$backupSaveResult = false;
			if (! file_exists($this->getBackupFilename()) or
				(is_writable($this->getBackupFilename())))
			{
				$backupSaveResult = $this->saveContens(
				        $this->getBackupFilename(), $datafileContens, $saveTimes);
			}

			//Write main datafile if possible
			if ($backupSaveResult === true
			     and file_exists($this->getFilnavn())
				 and is_writable($this->getFilnavn()))
			{
				return $this->saveContens($this->getFilnavn(),
				                                    $datafileContens, $saveTimes);
			}

		} /*End does user name exists and file ok*/

		//The file could not be saved, or was saved with error.
		return false;
	}

	/**
	 * Saves the <code>$contens</code> into <code>$fileName</code> in a
	 * secure way. The function will try to write the data
	 * <code>$saveTimes</code> before it will give up saving the data.
	 *
	 * @param $fileName to file name to save to.
	 * @param $contens the contens to save.
	 * @saveTimes the number of times the function shall try to save the
	 *            data before giving up.
	 * @protected
	 * @return boolean the result of the save operation.
	 */
	function saveContens($fileName, $contens, $saveTimes = 3)
	{
		if (strlen($contens) === 0)
			return false;

		$fp = fopen ($fileName, "wb");
		if (! $fp)
			return false;
		//Backups the data file if we shall rewrite it
		$res = fwrite($fp, $contens);
		fclose($fp);

		//Check if the file is saved correctly, and try to rewrite it
		//up to $saveTimes times if it failed.
		for ($i = 1; $i <= $saveTimes; $i++)
		{
			//If the file was saved ok
			$redDatafile = $this->readContens($fileName);
			if ($redDatafile !== false && $this->datafilOk($redDatafile))
				return true;
			else
			{ /*Try to save the file again*/
				$this->saveContens($fileName, $contens, 0);
			}
		} /*End for try to get it $saveTimes times*/
		return false;
	}

	/**
	 * Returns if the $username/$password combination can be authenticated
	 * against the main password.
	 * 
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return boolean if the user can be authenticated.
	 * @param $username the username to authenticate.
	 * @param $password the password to authenticate.
	 */
	function authenticate($username, $password) {
                        die("This login method is no longer supported.");
			return ( ($this->getUsername() === $username) and ($this->getLine(6) === $password) );
	}

	/**
	 * Read and returns the contens of <code>$fileName</code> and returns it
	 * as an aray, where each line corresponds to an element.
	 * If something went wrong, <code>false</code> is returned.
	 *
	 * @protected
	 * @param $fileName the name of the file to read.
	 * @return String the contens of <code>$fileName</code> or <code>false</code>
	 *                if something went wrong.
	 */
	function readContens($fileName)
	{
		return file($fileName);
	}

	/**
	 * Returns the number of lines in the data file.
	 * This is a fixed, hardcoded number, that only may be expanded.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return int the number of lines in the data file.
	 */
	function getLinesInDataFile()
	{
		return 120;
	}

	/**
	 * Returns the line corresponding to the parameter.
	 * All new line charaters are removed.
	 * The first line has index 0 (zero).
	 *
	 * @param $index the index of the requested line.
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return String the requested line.
	 */
	 function getLine($index)
	 {
			//Henter linien
			$linie = $this->datafil[$index];
			//Fjerner alle \n
			//$linie = preg_replace("/[\n\r]/","",$linie);
			return str_replace(array("\n", "\r"), "", $linie);
	 }

	 /**
	  * Returns the line that corresponds to the parameter,
	  * as an array (<code>Stirng[]</code>). All new line charchars are
	  * removed. The first line has the index 0, and the first element
	  * in the returned array has index 0 in the returned array.
	  *
	  * @public
	  * @version 0.0.1
	  * @since 0.0.1
	  * @param $index the index of the wanted line.
	  * @return String[] the line as an array
	  */
	 function getLineAsArray($index)
	 {
		 return explode("::", $this->getLine($index));
	 }

	 /**
	 * Sets the contents of the file.
	 * Makes sure that the line always only has one new-line charater in the
	 * end, and no where else.
	 *
	 * @param $index the index of the requested line.
	 * @param $linie the contents of the line to set.
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return void
	 */
	 function setLine($index,$linie)
	 {
		 //Fjerner alle \n
		 $linie = preg_replace("/[\n\r]/","",$linie);
		 //Stter denne, samt et efterflgende \n
		 $this->datafil[$index] = $linie . "\n";
	 }
	
	/**
	 * Lists all usernames. If $notOlderThan is given, only usernames which
	 * have been active after the given time (in seconds, unix time), will
	 * be returned,
	 * 
	 * @param $notOlderThan only return usernames accessed after this
	 *                      unix time (in seconds).
	 * @returns String[]
	 */
	function listUsernames($notOlderThan = -1) {
		$this_dir = dir($this->_datamappe);
		while ($file = $this_dir->read()) {
			if ($notOlderThan == -1 or fileatime($this->_datamappe.'/'.$file) >= $notOlderThan)
				$result_array[] = substr($file, 0, -4);
		}
		return $result_array;
	}


} /*End of class Datafil*/

/**
 * Represents a visit.
 */
class Visit {

	/**
	 * The time of the visit in Unix time.
	 *
	 * @private
	 */
	var $time;
	
	/**
	 * The simplified (as registered internally) browser identification string.
	 *
	 * @private
	 */
	var $browser;
	
	/**
	 * The simplified (as registered internally) operating system
	 * identification string.
	 *
	 * @private
	 */
	var $os;
	
	/**
	 * The resolution of the screen in the format XRESxYRES.
	 *
	 * @private
	 */
	var $resolution;
	
	/**
	 * The color depth of the screen in bits.
	 *
	 * @private
	 */
	var $colorDepth;
	
	/**
	 * The search engine the user used to find the page. Empty if none.
	 *
	 * @private
	 */
	var $searchEngine;
	
	/**
	 *  Array of the search words the user used to find the page. Empty if none.
	 *
	 * @private
	 */
	var $searchWords;
	
	/**
	 * Is Java enabled? 1 for true, 0 for false, 2 for unknown.
	 *
	 * @private
	 */
	var $javaEnabled;
	
	/**
	 * Is Java Script enabled? 1 for true, 0 for false, 2 for unknown.
	 *
	 * @private
	 */
	var $javaScriptEnabled;
	
	/**
	 * The language the user prefers.
	 *
	 * @private
	 */
	var $language;
	
	/**
	 * The top domain of the user.
	 *
	 * @private
	 */
	var $topdom;

	/**
	 * Creates a new instance.
	 */
	function Visit() {
		$this->searchWords = array();
	}
	
	/**
	 * Sets true if the user have not been registered before, else false.
	 *
	 * @param $unique true if the user have not been registered before, else false.
	 */
	function setUnique($unique) {
		$this->unique = $unique;
	}

	/**
	 * Returns true if the user have not been registered before, else false.
	 *
	 * @return true if the user have not been registered before, else false.
	 */
	function getUnique() {
		return $this->unique;
	}

	/**
	 * Sets the time of the visit in Unix time.
	 *
	 * @param $time the time of the visit in Unix time.
	 */
	function setTime($time) {
		$this->time = $time;
	}

	/**
	 * Returns the time of the visit in Unix time.
	 *
	 * @return the time of the visit in Unix time.
	 */
	function getTime() {
		return $this->time;
	}
	
	/**
	 * Sets the simplified (as registered internally) browser identification string.
	 *
	 * @param $browser the simplified (as registered internally) browser identification string.
	 */
	function setBrowser($browser) {
		$this->browser = $browser;
	}

	/**
	 * Returns the simplified (as registered internally) browser identification string.
	 *
	 * @return the simplified (as registered internally) browser identification string.
	 */
	function getBrowser() {
		return $this->browser;
	}
	
	/**
	 * Sets the simplified (as registered internally) operating system identification string.
	 *
	 * @param $os the simplified (as registered internally) operating system identification string.
	 */
	function setOs($os) {
		$this->os = $os;
	}

	/**
	 * Returns the simplified (as registered internally) operating system identification string.
	 *
	 * @return the simplified (as registered internally) operating system identification string.
	 */
	function getOs() {
		return $this->os;
	}
	
	/**
	 * Sets the resolution of the screen in the format XRESxYRES.
	 *
	 * @param $resolution the resolution of the screen in the format XRESxYRES.
	 */
	function setResolution($resolution) {
		$this->resolution = $resolution;
	}

	/**
	 * Returns the resolution of the screen in the format XRESxYRES.
	 *
	 * @return the resolution of the screen in the format XRESxYRES.
	 */
	function getResolution() {
		return $this->resolution;
	}
	
	/**
	 * Sets the color depth of the screen in bits.
	 *
	 * @param $colorDepth the color depth of the screen in bits.
	 */
	function setColorDepth($colorDepth) {
		$this->colorDepth = $colorDepth;
	}

	/**
	 * Returns the color depth of the screen in bits.
	 *
	 * @return the color depth of the screen in bits.
	 */
	function getColorDepth() {
		return $this->colorDepth;
	}

	/**
	 * Sets the search engine the user used to find the page. Empty if none.
	 *
	 * @param $searchEngine the search engine the user used to find the page. Empty if none.
	 */
	function setSearchEngine($searchEngine) {
		$this->searchEngine = $searchEngine;
	}
	
	/**
	 * Returns the search engine the user used to find the page. Empty if none.
	 *
	 * @return the search engine the user used to find the page. Empty if none.
	 */
	function getSearchEngine() {
		return $this->searchEngine;
	}

	/**
	 *  Sets an array of the search words the user used to find the page. Empty if none.
	 *
	 *  @param $searchWords array of the search words the user used to find the page. Empty if none.
	 */
	function setSearchWords($searchWords) {
		$this->searchWords = $searchWords;
	}

	/**
	 *  Returns an array of the search words the user used to find the page. Empty if none.
	 *
	 *  @return an array of the search words the user used to find the page. Empty if none.
	 */
	function getSearchWords() {
		return $this->searchWords;
	}
	
	/**
	 * Sets if Java is enabled.  1 for true, 0 for false, 2 for unknown.
	 *
	 * @param $javaEnabled if Java is enabled.
	 */
	function setJavaEnabled($javaEnabled) {
		$this->javaEnabled = $javaEnabled;
	}
	
	/**
	 * Returns if Java is enabled.  1 for true, 0 for false, 2 for unknown.
	 *
	 * @return  if Java is enabled.
	 */
	function getJavaEnabled() {
		return $this->javaEnabled;
	}
	
	/**
	 * Sets if Java Script is enabled.  1 for true, 0 for false, 2 for unknown.
	 *
	 * @param $javaScriptEnabled if Java Script is enabled?
	 */
	function setJavaScriptEnabled($javaScriptEnabled) {
		$this->javaScriptEnabled = $javaScriptEnabled;
	}
	
	/**
	 * Returns if Java Script is enabled.  1 for true, 0 for false, 2 for unknown.
	 *
	 * @return if Java Script is enabled?
	 */
	function getJavaScriptEnabled() {
		return $this->javaScriptEnabled;
	}
	
	/**
	 * Sets the language the user prefers.
	 *
	 * @param $language the language the user prefers.
	 */
	function setLanguage($language) {
		$this->language = $language;
	}
	
	/**
	 * Returns the language the user prefers.
	 *
	 * @return the language the user prefers.
	 */
	function getLanguage() {
		return $this->language;
	}

	/**
	 * Sets the top domain of the user.
	 *
	 * @param $topdom the top domain of the user.
	 */
	function setTopdom($topdom) {
		$this->topdom = $topdom;
	}
	
	/**
	 * Returns the top domain of the user.
	 *
	 * @return the top domain of the user.
	 */
	function getTopdom() {
		return $this->topdom;
	}
}

/**
 * Represents a single item of text/value in the collective stats.
 * Using a class instead of arrays makes it easier to attach more
 * information later.
 *
 * @author Simon Mikkelsen
 */
class CollectiveItem {
	
	/**
	 * The text to display for the item.
	 *
	 * @private
	 */
	var $text;

	/**
	 * The number of times the item has occurd.
	 *
	 * @private
	 */
	var $count;

	/**
	 * Creates a new instance.
	 *
	 * @public
	 * @param $text  the text to display for the item.
	 * @param $count the number of times the item has occurd.
	 */
	function CollectiveItem($text, $count) {
		$this->text = $text;
		$this->count = $count;
	}

	/**
	 * Returns the text to display for the item.
	 *
	 * @public
	 * @return the text to display for the item.
	 */
	function getText() {
		return $this->text;
	}

	/**
	 * Sets the text to display for the item.
	 *
	 * @public
	 * @param $text the text to display for the item.
	 */
	function setText($text) {
		$this->text = $text;
	}
	
	/**
	 * The number of times the item has occurd.
	 *
	 * @public
	 * @return the number of times the item has occurd.
	 */
	function getCount() {
		return $this->count;
	}

	/**
	 * Sets the number of times the item has occurd.
	 *
	 * @return the number of times the item has occurd.
	 */
	function setCount($count) {
		$this->count = $count;
	}
}

/**
 * Represets a request for collective stats.
 *
 * @author Simon Mikkelsen
 */
class CollectiveStatRequest {

	/**
	 * An identifier of the stat to return.
	 *
	 * @private
	 */
	var	$stat;

	/**
	 * If visits must be unique. True for unique visits, false for non unique visits.
	 *
	 * @private
	 */
	var $unique;

	/**
	 * The start time.
	 *
	 * @private
	 */
	var $startDay;

	/**
	 * The end time.
	 *
	 * @private
	 */
	var $endDay;
	
	/**
	 * States how to group the visits. The valid values are defined in the
	 * method setGroupby($groupby).
	 * 
	 * @private
	 */
	var $groupby;

	/**
	 * Creates a new instance.
	 *
	 * The times are in Unix time with a days pression, that is $startDay
	 * is for 00:00:00 at the given day and $endDay is for 23:59:59 at the
	 * given day.
	 *
	 * Valid values for $stat are:
	 * @li @c day - visits by day.
	 * @li @c browser - visits by browser.
	 * @li @c os - visits by operating system.
	 * @li @c color - visits by supported colors in bits.
	 * @li @c screenres - visits by screen resolution.
	 * @li @c searchEngine - visits by search engines.
	 * @li @c searchWord - visits by search words.
	 * @li @c java - visits by java support.
	 * @li @c js - visits by java script support.
	 * @li @c language - visits by prefered language.
	 * @li @c topdom - visits by top domain.
	 *
	 * @param $stat      identifier of the stat to return.
	 * @param $unique    true for unique visits, false for non unique visits.
	 * @param $startDay  the start time.
	 * @param $endDay    the end time.
	 */
	function CollectiveStatRequest($stat, $unique, $startDay, $endDay) {
		$this->stat = $stat;
		$this->unique = $unique;
		$this->startDay = $startDay;
		$this->endDay = $endDay;
		$this->setGroupby('total');
	}

	/**
	 * Returns how to group the visits. The valid values are defined in
	 * the method setGroupby($groupby).
	 * 
	 * @public
	 * @return how to group the visits.
	 */
	function getGroupby() {
		return $this->groupby;
	}
	
	/**
	 * Sets states how to group the visits.
	 *
	 * The valid values are:
	 * @li @c total (default) One total set for the select time span.
	 * @li @c day One text/value set for each day.
	 * @li @c week One text/value set for each week.
	 * @li @c month One text/value set for each month.
	 * 
	 * @public
	 * @param $groupby states how to group the visits.
	 */
	function setGroupby($groupby) {
		$this->groupby = $groupby;
	}

	/**
	 * Returns an identifier of the stat to return.
	 *
	 * @public
	 * @return an identifier of the stat to return.
	 */
	function getStat() {
		return $this->stat;
	}

	/**
	 * Sets an identifier of the stat to return.
	 *
	 * @public
	 * @param $stat an identifier of the stat to return.
	 */
	function setStat($stat) {
		$this->stat = $stat;
	}

	/**
	 * Returns if visits must be unique.
	 * True for unique visits, false for non unique visits.
	 *
	 * @public
	 * @return if visits must be unique.
	 */
	function getUnique() {
		return $this->unique;
	}

	/**
	 * Sets if visits must be unique.
	 * True for unique visits, false for non unique visits.
	 *
	 * @public
	 * @param $unique if visits must be unique.
	 */
	function setUnique($unique) {
		$this->unique = $unique;
	}

	/**
	 * Returns the start time.
	 * 
	 * The definition of the times are described in the constructor.
	 *
	 * @public
	 * @return the start time.
	 */
	function getStartDay() {
		return $this->startDay;
	}

	/**
	 * Sets the start time.
	 * 
	 * The definition of the times are described in the constructor.
	 *
	 * @public
	 * @param $startDay the start time.
	 */
	function setStartDay($startDay) {
		$this->startDay = $startDay;
	}

	/**
	 * Sets the end time.
	 * 
	 * The definition of the times are described in the constructor.
	 *
	 * @public
	 * @param $endDay the end time.
	 */
	function setEndDay($endDay) {
		$this->endDay = $endDay;
	}

	/**
	 * Returns the end time.
	 * 
	 * The definition of the times are described in the constructor.
	 *
	 * @public
	 * @return the end time.
	 */
	function getEndDay() {
		return $this->endDay;
	}
} //End of class CollectiveStatRequest

/**
 * Interface implemented by classes that can read the collective stats.
 *
 * @author Simon Mikkelsen
 */
class CollectiveReader {

	/**
	 * Returns the data for the given stat for the given time span.
	 *
	 * The stats are returned as an associative array of CollectiveItem ordered
	 * by CollectiveItem::getCount() with the largest count as index 0.
	 *
	 * @param $request instance of CollectiveStatRequest stating which stats to return.
	 * @return the requested stats summerized.
	 */
	function getStat($request) {
		echo "Error: The method getStat in Html.php line ".__LINE__." must be implemented when deriving from class CollectiveReader.";
		exit;
	}
	
	/**
	 * Returns an array of dates (in Unix time at 00:00) data exists for.
	 * The data are sorted with the oldest date first (index 0).
	 * 
	 * @return an array of dates (in Unix time at 00:00) data exists for.
	 */
	function getDataDates() {
		die("The function getDataDates in ".__FILE__." (".__LINE__.") must be implemented when deriving from class CollectiveReader.");
	}
	
} //End of class CollectiveReader

/**
 * Interface implemented by classes that can read the collective stats.
 *
 * @author Simon Mikkelsen
 */
class MySqlCollectiveReader extends CollectiveReader {
	
	/**
	 * The options.
	 *
	 * @private
	 */
	var $options;
	
	/**
	 * The instance of MySqlAccess used to connect to the database.
	 *
	 * @private
	 */
	var $db;
	
	/**
	 * The format, for use in PHP's date() function, that can create a date
	 * for the database.
	 */
	var $dbDateFormat = "Y-m-d";
	
	/**
	 * Creats a new instance.
	 *
	 * @param $options an instance of the settings object.
	 */
	function MySqlCollectiveReader(&$options) {
		$this->options = &$options;
		
		//Create the database connection.
		$this->db = new MySqlAccess($options);
	}

	/**
	 * Returns the data for the given stat for the given time span.
	 *
	 * The stats are returned as an associative array of CollectiveItem ordered
	 * by CollectiveItem::getCount() with the largest count as index 0.
	 *
	 * @param $request instance of CollectiveStatRequest stating which stats to return.
	 * @return the requested stats summerized.
	 */
	function getStat($request) {
		//Run the query
		$res = $this->getQueryResult($request);
		$collItems = array();
		
		//Iterate over the result.
		foreach ($res as $value) {
			$collItems[] = new CollectiveItem($value["value"], $value["sumHits"]);
		}
		
		return $collItems;
	}
	
	/**
	 * Returns the data for the given stat for the given time span.
	 *
	 * This method is made to support GraphStatGenerator::setTextArray()
	 * and GraphStatGenerator::setNumberArray(). Use
	 * 
	 * @code
	 * list($text, $value) = $datasource->getStatArrays($request);
	 * @endcode
	 *
	 * to get the data in an easy way.
	 * 
	 * @param $request instance of CollectiveStatRequest stating which
	 *                 stats to return.
	 * @return @c array(array($text), array(value)) - two element array:
	 *         Index 0 an array of the text, index 1 an array of the
	 *         corresponding values.
	 */
	function getStatArrays($request) {
		//Run the query
		$res = $this->getQueryResult($request);
		
		//Iterate over the result.
		$textRes = array();
		$valueRes = array();
		foreach ($res as $value) {
			$textRes[] = $value["value"];
			$valueRes[] = $value["sumHits"];
		}
		
		return array($textRes, $valueRes);
	}
	
	/**
	 * Builds and runs the query corresponding to the given @c $request and
	 * returns the result as given by MySqlAccess::runQuery().
	 *
	 * @param $request instance of CollectiveStatRequest stating which stats to return.
	 * @return the result as given by MySqlAccess::runQuery().
	 */
	function getQueryResult($request) {
		$dbTable = $this->options->getOption('DB_tablename_visits_archive');
		
		//Prepare group related SQL
		//Group by (officially only a lower case string is supported, but we
		//          supports case insensitive in case it screws a bit.)
		$groupBy = strtolower($request->getGroupby());
		$groupGB = "";
		if ($groupBy == 'week') {
		//select sum(hits), value, yearweek(day, 3) from zs20_visits group by yearweek(day, 3), value
			$groupGB = " GROUP BY YEARWEEK(day, 3), value"; //Gives YYYYWW; 3 means 1-53, week starts monday 
		} else if ($groupBy == 'month') {
			$groupGB = " GROUP BY YEAR(day), MONTH(day), value";
		}  else if ($groupBy == 'day') {
			$groupGB = " GROUP BY day, value";
		} else {
			//If total
			$groupGB = " GROUP BY value";
		}

		//Make the main SQL statement
		$sql = "SELECT *, sum(hits) AS sumHits FROM $dbTable WHERE data_type = \""
		        .$this->db->secureSlashes($request->getStat())."\""
		        ." AND isUnique = ";
		if ($request->getUnique()) {
			$sql .= "1";
		} else {
			$sql .= "0";
		}
		
 		$sql .= " AND day >= \"".date($this->dbDateFormat, $request->getStartDay())."\"";
		$sql .= " AND day <= \"".date($this->dbDateFormat, $request->getEndDay())."\"";
		$sql .= "$groupGB ORDER BY day, value ASC";

		//Run the query
		return $this->db->runQuery($sql);
	}
	
	/**
	 * Implemented to make this class pass for a PersistenceMgr - when
	 * this method returns @c false other method will (hipefully) not
	 * be called.
	 *
	 * @return @c false.
	 */
	function loaded() {
		return false;
	}
	
	/**
	 * Implemented to make this class pass for a PersistenceMgr.
	 *
	 * @return An empty string.
	 */
	function getUsername() {
		return "";
	}
	
	/**
	 * Returns an array of dates (in Unix time at 00:00) data exists for.
	 * The data are sorted with the oldest date first (index 0).
	 * 
	 * @return an array of dates (in Unix time at 00:00) data exists for.
	 */
	function getDataDates() {
		//Get the data.
		$dbTable = $this->options->getOption('DB_tablename_visits_archive');
		$sql = "SELECT DISTINCT UNIX_TIMESTAMP(day) AS unix_day FROM $dbTable ORDER BY day DESC";
		$rawData = $this->db->runQuery($sql);
		
		//Reformat the array:
		$finalData = array();
		foreach ($rawData as $val) {
			$finalData[] = $val['unix_day'];
		}
		
		return $finalData;
	}
} //End of class MySqlCollectiveReader

/**
 * Caches content that takes a long time to generate.
 * The class provides to terms: category and id.
 * Combined they are unique, so multiple cached items can have the same
 * category (as long as they have a different id) and multiple cached
 * items can have the same id (as long as they have a different category).
 *
 * The category is ment to hold e.g. the kind of website it holds (e.g.
 * statesite) while the id e.g. holds the parameters that generated the
 * site.
 *
 * @author Simon Mikkelsen
 */
class ContentCache {

	/**
	 * The options.
	 *
	 * @protected
	 */
	var $options;
	
	/**
	 * Creates a new instance.
	 *
	 * @param $options an instance of the options.
	 */
	function ContentCache(&$options) {
		$this->options = &$options;
	}
	
	/**
	 * Returns the contents that is cached for the given category and id.
	 * If no contents exists then <code>null</code> is returned.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 * @return the content that is cached for the given category and id or
	 *         <code>null</code>.
	 */
	function getCached($category, $id) {
		die("The clas ContentCache must be extended and the method getCached implemented.");	
	}
	
	/**
	 * Sets the flag that somebody is generating content for the given
	 * category and id and returns if it succeded (<code>true</code>) or
	 * not (<code>false</code>). In the latter case somebody else is
	 * generating and you should try to get content in a few seconds.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 */
	function lockGenerating($category, $id) {
		die("The clas ContentCache must be extended and the method setGenerating implemented.");	
	}
	
	/**
	 * Sets some content for the given category and id.
	 * Before using method you must always have aquired permission using
	 * {@link #lockGenerating()}.
	 * Any flag set by {@link #setGenerating} is cleared.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 * @param $content  the new content.
	 * @param $expires  the time (in Unix time) the content expires.
	 *                  give the value <code>-1</code> for never.
	 */
	function setContents($category, $id, $content, $expires) {
		die("The clas ContentCache must be extended and the method setContents implemented.");	
	}
	
	/**
	 * Returns the unix timestamp to use with {@link #setContents} in order
	 * to have the content expire a next midnight. It also takes care of
	 * any adjustment made in the options.
	 *
	 * @return the unix timestamp to use with {@link #setContents} in order
	 *         to have the content expire a next midnight.
	 */
	function getNextMidnightExpiration() {
			//Just ignore - for searching sourcecode: time()
			$timeInfo = getdate();
			return time() - $timeInfo['hours']*60*60 - $timeInfo['minutes']*60
		                  - $timeInfo['seconds']
		                  + 24*60*60 + $this->options->getOption('cache_expire_adjust_collindex');
	}

}

/**
 * Caches content that takes a long time to generate.
 * The class provides to terms: category and id.
 * Combined they are unique, so multiple cached items can have the same
 * category (as long as they have a different id) and multiple cached
 * items can have the same id (as long as they have a different category).
 *
 * The category is ment to hold e.g. the kind of website it holds (e.g.
 * statesite) while the id e.g. holds the parameters that generated the
 * site.
 *
 * This implementation uses MySQL.
 *
 * @author Simon Mikkelsen
 */
class MySqlContentCache extends ContentCache {

	/**
	 * The instance of MySqlAccess used to connect to the database.
	 *
	 * @private
	 */
	var $db;
	
	/**
	 * The database table to use.
	 */
	var $dbTable;
	
	/**
	 * Creats a new instance.
	 *
	 * @param $options an instance of the settings object.
	 */
	function MySqlContentCache(&$options) {
		parent::ContentCache($options);
		
		//Create the database connection.
		$this->db = new MySqlAccess($options);
		
		$this->dbTable = $this->options->getOption('DB_tablename_cache');
	}

	/**
	 * Returns the contents that is cached for the given category and id.
	 * If no contents exists then <code>null</code> is returned.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 * @return the content that is cached for the given category and id or
	 *         <code>null</code>.
	 */
	function getCached($category, $id) {
		//Get the data (Note: FROM_UNIXTIME(0) is NULL for MySQL).
		$sql = "SELECT * FROM ".$this->dbTable." WHERE category = \"".$this->db->secureSlashes($category)
		        ."\" AND id = \"".$this->db->secureSlashes($id)."\" AND generating = 0 "
		        ."AND (expires = FROM_UNIXTIME(0) OR expires > NOW())";
		$rawData = $this->db->runQuery($sql);
		
		//Is there cached content?
		if (count($rawData) === 0) {
			return NULL;
		}
		
		return $rawData[0]['contents'];
	}
	
	/**
	 * Sets the flag that somebody is generating content for the given
	 * category and id and returns if it succeded (<code>true</code>) or
	 * not (<code>false</code>). In the latter case somebody else is
	 * generating and you should try to get content in a few seconds.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 * @param $retryno  used when this method is calling itself to make
	 *                  sure it does not retry getting a lock too many
	 *                  times. This parameter is for internal use (yes,
	 *                  that could be done by wrapping the function,
	 *                  but please just don't use it).
	 * @return if you got a lock, and can generate content (@c true) or
	 *         somebody else got it, and they will generate the content
	 *         (@c false).
	 * @public
	 */
	function lockGenerating($category, $id, $retryno = 0) {
		//The following algorithm makes sure only one process is
		//generating content. The key is the update query: Take the right to
		//generate content only if noone else has it. At worst this has a minute
		//teoretical risk of failing, and then we only has 2 processes doing the
		//same reasonable amount of work.
		//SELECT
		//Is generating == 0?
		//Yes: 
		//	update set generating = our_random_id where updater = 0
		//	SELECT
		//	Is generating == our_random_id
		//	Yes:
		//		Make content and store it.
		//	No:
		//		Somebody else got there first: Let them make content.
		//		Wait and present their result.
		//No:
		//	Somebody else got there first: Let them make content.
		//	Wait and present their result.

		//Note: If generating == 0 then nobody is generating the content.
		//      If it is != 0 then the "process" with that id is generating.

		$sql = "SELECT generating, UNIX_TIMESTAMP(created) as ucreated FROM "
		        .$this->dbTable." WHERE category = \"".$this->db->secureSlashes($category)
		        ."\" AND id = \"".$this->db->secureSlashes($id)."\"";
		$rawData = $this->db->runQuery($sql);
		
		$generatingId = rand(1, pow(10, 10));
		//Is there cached content?
		if (count($rawData) === 0) {
			//No: Do an insert.
			$sql = "INSERT INTO ".$this->dbTable." SET category = \"".$this->db->secureSlashes($category)
		        ."\", id = \"".$this->db->secureSlashes($id)."\", generating = ".$generatingId;
		} else if ($rawData[0]['generating'] == 0) {
			//Yes: Do an update.
			$sql = "UPDATE ".$this->dbTable." SET generating = ".$generatingId
						." WHERE category = \"".$this->db->secureSlashes($category)
		        ."\"AND id = \"".$this->db->secureSlashes($id)."\" "
		        ."AND generating = 0";
		} else {
			//Somebody else is generating now.
			return $this->generatingExpired($category, $id, $rawData[0]['ucreated'], $retryno);
		}
		
		//Run the query.
		$this->db->runQuery($sql, FALSE);
		
		
		//Did we get the right to generate?
		$sql = "SELECT generating, UNIX_TIMESTAMP(created) as ucreated FROM "
		        .$this->dbTable." WHERE category = \"".$this->db->secureSlashes($category)
		        ."\" AND id = \"".$this->db->secureSlashes($id)."\"";
		$rawData = $this->db->runQuery($sql);
		if ($rawData[0]['generating'] != $generatingId) {
			//Somebody got there first.
			return $this->generatingExpired($category, $id, $rawData[0]['ucreated'], $retryno);
		} else {
			//We got the right!
			return true;
		}
	}
	
	/**
	 * Called when somebody else is generating the page content.
	 * This function makes sure that if it has taken too long we will retry
	 * to generate the content.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 * @param $created the unix timestamp the cached content was started to
	 *                 be generated.
	 * @param $retryno the recursion level of {@link #lockGenerating}. Just
	 *                 use the parameter of the same name from that method.
	 * @return the value {@link #lockGenerating} must return in this case.
	 * @private
	 */
	function generatingExpired($category, $id, $created, $retryno) {
		$maxRetryCount = 1;
		if ($retryno >= $maxRetryCount) {
			//Don't retry too many times.
			return false;
		}
		
		$maxWaitTimeSec = 12; //Why 12? It is 3Xreload (5 sec each) minutes a little).
		if (time() - $created < $maxWaitTimeSec) {
			//We still have to wait.
			return false;
		} else {
			//OK, the one generating content is taking too long: Try to take over.
			$sql = "UPDATE ".$this->dbTable." SET generating = 0"
						." WHERE category = \"".$this->db->secureSlashes($category)
		        ."\"AND id = \"".$this->db->secureSlashes($id)."\"";
			//Run the query.
			$this->db->runQuery($sql, FALSE);
			return $this->lockGenerating($category, $id, $retryno + 1);
		}
	}
	
	/**
	 * Sets some content for the given category and id.
	 * Before using method you must always have aquired permission using
	 * {@link #lockGenerating()}.
	 * Any flag set by {@link #setGenerating} is cleared.
	 *
	 * @param $category the category in question.
	 * @param $id       the id in question.
	 * @param $content  the new content.
	 * @param $expires  the time (in Unix time) the content expires.
	 *                  give the value <code>-1</code> for never.
	 */
	function setContents($category, $id, $content, $expires) {
		$sql = "SELECT generating FROM ".$this->dbTable." WHERE category = \"".$this->db->secureSlashes($category)
		        ."\" AND id = \"".$this->db->secureSlashes($id)."\"";
		$rawData = $this->db->runQuery($sql);
		
		if ($expires === -1) {
			$expiresSql = "NULL";
		} else {
			$expiresSql = "FROM_UNIXTIME(".($expires*1).")";
		}

		//You must have made a row using lockGenerating, so there must be a row
		//to update.
		$sql = "UPDATE ".$this->dbTable." SET "
		  ."contents = \"".$this->db->secureSlashes($content)."\", "
		  ."expires = ".$expiresSql.", "
		  ."generating = 0"
		  ." WHERE "
			."category = \"".$this->db->secureSlashes($category)."\" "
		  ."AND id = \"".$this->db->secureSlashes($id)."\"";

		$this->db->runQuery($sql, FALSE);
	}
}

/**
 * Provides a datasource for logging.
 *
 * @author Simon Mikkelsen
 */
class LogDatasource {

	/**
	 * The instance of the options.
	 */
	var $options;
	
	/**
	 * Pointer to the log file.
	 */
	var $logFilePointer;
	
	/**
	 * The name of the file corresponding to the $logFilePointer.
	 */
	var $logFileName;
	
	/**
	 * Array of files to parse.
	 */
	var $processingList;
	
	/**
	 * Creates a new instance.
	 * 
	 * @param $options The instance of the options.
	 */
	function LogDatasource(&$options) {
		$this->options = $options;
		$this->logFilePointer = NULL;
		$this->logFileName = NULL;
		$this->processingList = array();
	}
	
	/**
	 * Returns if the data source is open.
	 * 
	 * @return if the data source is open.
	 * @returns boolean
	 */
	function isOpen() {
		return ($this->logFilePointer !== NULL);
	}
	
	/**
	 * States that the old log file has been processed.
	 * 
	 * @private
	 */
	function oldFileProcessed() {
		//Does an old file exist?
		if ($this->logFileName !== NULL and file_exists($this->logFileName)) {
			//What to do with the old file
			$doWithLog = $this->options->getPath('processIntoEach');
			if ($doWithLog === 1) {
				//rename file
				$newFileName = dirname($this->logFileName).'/'.basename($this->logFileName, '.'.$this->options->getOption('logModeFileExt'));
				$newFileName .= '.'.$this->options->getOption('processedLogsExp');
				rename($this->logFileName, $newFileName);
			} else if ($doWithLog === 2) {
				//Delete file
				unlink($this->logFileName);
			}
		}
			
	}
	
	/**
	 * Returns the next record or NULL if the last one have been returned.
	 * NULL is also returned if the data source is not open.
	 */
	function nextRecord() {
		//Start on a new file?
		if ($this->logFilePointer !== NULL and feof($this->logFilePointer)) {
			//Close the old file
			fclose($this->logFilePointer);
			$this->logFilePointer = NULL;
			//Rename the old file
			$this->oldFileProcessed();
		}
		
		//Open the next file
		if ($this->logFilePointer === NULL) {
			//Are there more files?
			if (count($this->processingList) === 0) {
				return NULL;
			}
			//Open the next file
			$this->logFileName = array_pop($this->processingList);
			$this->logFilePointer = fopen($this->logFileName, 'r');
			//If the next file is empty: Move on
			if (feof($this->logFilePointer)) {
				return $this->nextRecord();
			}
		}

		$line = fgets($this->logFilePointer, 100000);
		return str_replace(array("\n", "\r"), array("",""), $line);
	}
	
	/**
	 * Returns the file name of the log.
	 */
	function getLogFilename() {
		return $this->options->getPath('zipstat_logs')
		           .'/'.date($this->options->getOption('logModeFileName'))
		           .'.'.$this->options->getOption('logModeFileExt');
	}
	
	/**
	 * Returns the names of the files to process.
	 */
	function getProcesableFiles() {
		//Create the processing list
		$ext = '.'.$this->options->getOption('logModeFileExt');
		$files = array();
		$fileDates = array();
		$handle=opendir($path.$moverse);
		while ($file = readdir($handle)) {
			//Select only files with the correct extention
			if (is_file($file) and strpos($file, $ext) === (strlen($file)-strlen($ext))) {
				$files[] = $file;
				$fileDates[] = filemtime($file);
			}
		} //End while

		//Find the newest
		$newest = -1;
		for ($i = 0; $i < count($fileDates); $i++) {
			if ($newest == -1 or $fileDates[$i] > $fileDates[$newest])
				$newest = $i;
		} //End for
		//Throw the newest away - it is the one which is in use
		if ($newest !== -1)
			$files = array_splice($files, $newest, 1);
		return $files;
	}
	
	/**
	 * Opens the source for processing, e.g. reading one record after the
	 * other.
	 * When the source is open for processing it can not be opened for
	 * writing.
	 */
	function openForProcessing() {
		$this->processingList = $this->getProcesableFiles();
	}
	
	/**
	 * Opens the source.
	 * When the source is open for processing it can not be opened for
	 * writing.
	 */
	function openSource() {
		$filename = $this->getLogFilename();
		$this->logFilePointer = fopen($filename, 'a');
	}
	
	/**
	 * Closes the source.
	 */
	function closeSource() {
		if ($this->logFilePointer !== NULL) {
			fclose($this->logFilePointer);
			$this->logFilePointer = NULL;
		}
	}
	
	/**
	 * Adds the record to the log.
	 * 
	 * @param $record the one to add, usually a line of text.
	 */
	function addRecord($record) {
		$record = str_replace(array("\n", "\r"), "", $record)."\n";
		fwrite($this->logFilePointer, $record);
	}
}

/**
 * Represents the array of dates where different stats are reset.
 *
 * @public
 * @version 0.0.1
 * @since 0.0.1
 */
class Resets
{
	/**
	 * Array of the dates where the different stats are reset.
	 * The index of this array directly corresponds to the indexes of the
	 * data file.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $resets;

	/**
	 * Creates a new instance.
	 *
	 * @param $line the <code>::</code> seperated line containing the reset
	 *        dates. The first date must correspond to element index 0.
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 */
	function Resets($line)
	{
		$this->resets = explode("::",$line);
	}

	/**
	 * Returns the date corresponding to the given index.
	 * If an instance of <code>Localizer</code> is given, it will be used
	 * to format the date.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $index the index
	 * @param $locale a locale to use, if given.
	 * @return String the corresponding index.
	 */
	function getDateString($index, $locale = -1)
	{
		if (! isset($this->resets) or ! isset($this->resets[$index]))
			return '';

		if ($locale != -1 and strtolower(get_class($locale)) === "localizer") {
			return $locale->localizeDate($this->resets[$index]);
		} else {
			return $this->resets[$index];
		}
	}

	/**
	 * Returns if a date exist for the given index.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $index the index that shall be evaluted.
	 * @return boolean <code>1</code> if a date exist at the index, else <code>0</code>.
	 */
	function dateExist($index)
	{
		if (strlen($this->resets[$index]) > 0)
			return 1;
		else
			return 0;
	}

}

/**
 * Logs time for performance testing.
 */
class TimeLogger2
{
	var $lastTime;

	var $usr;

	var $start;

	/**
	 * Creats a new instance.
	 *
	 * @param $usr the name of the user for testing (so multiple instances
	 *             can de seperated from each other).
	 */
	function TimeLogger2($usr)
	{
		list($usec, $sec) = explode(" ",microtime());
		$this->usr = $usr."[".($sec + $usec)."]";
		$this->lastTime = $sec + $usec;
		$this->start = $sec + $usec;
	}

	/**
	 * Log this point, and mark it with the <code>$msg</code>.
	 *
	 * @param $msg the message to log.
	 */
	function timeLog($msg)
	{
		list($usec, $sec) = explode(" ",microtime());
		$thisTime = $sec + $usec;
		$out = $this->usr." ".($thisTime - $this->lastTime)." ".$msg."\n";
		$this->lastTime = $thisTime;
		$fp = fopen("timelog2.txt","a");
		fwrite($fp, $out);
		fclose($fp);
	}

	/**
	 * Markes the end of the log. Writes the log to the file <code>timelog2.txt</code>.
	 */
	function theend()
	{
		list($usec, $sec) = explode(" ",microtime());
		$thisTime = $sec + $usec;
		$out = $this->usr." ".($thisTime - $this->start)." ----- End. ------\n";
		$fp = fopen("timelog2.txt","a");
		fwrite($fp, $out);
		fclose($fp);
	}
}

/**
 * Does translation between the stored names of the search engines and the
 * actual urls.
 *
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class SearchEngines
{
	var $engins;

	function SearchEngines()
	{
		$this->engines['altavista'][0] = 'http://www.altavista.com';
		$this->engines['altavista'][1] = 'Altavista';

		$this->engines['excite'][0] = 'http://www.excite.com';
		$this->engines['excite'][1] = 'Excite';

		$this->engines['lycos'][0] = 'http://www.lycos.com';
		$this->engines['lycos'][1] = 'Lycos';
		$this->engines['lycos'][2] = 'http://www.lycos.dk';
		$this->engines['lycos'][3] = 'Lycos DK';

		$this->engines['webcrawler'][0] = 'http://www.webcrawler.com';
		$this->engines['webcrawler'][1] = 'Webcrawler';

		$this->engines['hotbot'][0] = 'http://www.hotbot.com';
		$this->engines['hotbot'][1] = 'Hotbot';

		$this->engines['yahoo'][0] = 'http://www.yahoo.com';
		$this->engines['yahoo'][1] = 'Yahoo';
		$this->engines['yahoo'][2] = 'http://www.yahoo.dk';
		$this->engines['yahoo'][3] = 'Yahoo DK';

		$this->engines['jubii'][0] = 'http://www.jubii.dk';
		$this->engines['jubii'][1] = 'Jubii';

		$this->engines['sol'][0] = 'http://www.sol.dk';
		$this->engines['sol'][1] = 'SOL';

		$this->engines['yahuu'][0] = 'http://www.yahuu.dk';
		$this->engines['yahuu'][1] = 'Yahuu.dk';

		$this->engines['voila'][0] = 'http://www.voila.com';
		$this->engines['voila'][1] = 'Voila';

		$this->engines['msn'][0] = 'http://www.msn.com';
		$this->engines['msn'][1] = 'MSN';
		$this->engines['msn'][2] = 'http://www.msn.dk';
		$this->engines['msn'][3] = 'MSN DK';

		$this->engines['find'][0] = 'http://www.find.dk';
		$this->engines['find'][1] = 'Find.dk';

		$this->engines['auu'][0] = 'http://www.auu.dk';
		$this->engines['auu'][1] = 'Opasia';

		$this->engines['go'][0] = 'http://www.go.com';
		$this->engines['go'][1] = 'Go';

		$this->engines['overture'][0] = 'http://www.overture.com';
		$this->engines['overture'][1] = 'Overture';
		$this->engines['overture'][2] = 'http://www.go.com';
		$this->engines['overture'][3] = 'Go';

		$this->engines['crawler'][0] = 'http://www.crawler.de';
		$this->engines['crawler'][1] = 'Crawler.de';

		$this->engines['suchen'][0] = 'http://www.suchen.com';
		$this->engines['suchen'][1] = 'Suchen';

		$this->engines['goto'][0] = 'http://www.goto.com';
		$this->engines['goto'][1] = 'Goto';

		$this->engines['directhit'][0] = 'http://www.directhit.com';
		$this->engines['directhit'][1] = 'Directhit';

		$this->engines['thunderstone'][0] = 'http://www.thunderstone.com';
		$this->engines['thunderstone'][1] = 'Thunderstone';

		$this->engines['northernlight'][0] = 'http://www.northernlight.com';
		$this->engines['northernlight'][1] = 'Northernlight';

		$this->engines['whatuseek'][0] = 'http://www.whatuseek.com';
		$this->engines['whatuseek'][1] = 'Whatuseek';

		$this->engines['about'][0] = 'http://www.about.com';
		$this->engines['about'][1] = 'About';

		$this->engines['planetsearch'][0] = 'http://www.planetsearch.com';
		$this->engines['planetsearch'][1] = 'Planetsearch';

		$this->engines['google'][0] = 'http://www.google.com';
		$this->engines['google'][1] = 'Google';

		$this->engines['factfinder'][0] = 'http://www.factfinder.dk';
		$this->engines['factfinder'][1] = 'Factfinder';

		$this->engines['add2me'][0] = 'http://www.add2me.dk';
		$this->engines['add2me'][1] = 'Add2me';

		$this->engines['cybercity'][0] = 'http://www.cybercity.dk';
		$this->engines['cybercity'][1] = 'Cybercity';

		$this->engines['map.net.uni-c'][0] = 'http://www.map.net.uni-c.dk';
		$this->engines['map.net.uni-c'][1] = 'UNI-C';

		$this->engines['ditdanmark'][0] = 'http://www.ditdanmark.dk';
		$this->engines['ditdanmark'][1] = 'Ditdanmark';

		$this->engines['search.dmoz'][0] = 'http://www.dmoz.org';
		$this->engines['search.dmoz'][1] = 'Open Directory Project';

		$this->engines['1klik'][0] = 'http://www.1klik.dk';
		$this->engines['1klik'][1] = '1klik';

		$this->engines['123portal'][0] = 'http://www.123portal.dk';
		$this->engines['123portal'][1] = '123portal';

		$this->engines['netstjernen'][0] = 'http://www.netstjernen.dk';
		$this->engines['netstjernen'][1] = 'Netstjernen';

		$this->engines['alltheweb'][0] = 'http://alltheweb.com';
		$this->engines['alltheweb'][1] = 'Alltheweb.com';

		$this->engines['opasia'][0] = 'http://find.opasia.dk';
		$this->engines['opasia'][1] = 'Opasia';

		$this->engines['ofir'][0] = 'http://www.ofir.dk';
		$this->engines['ofir'][1] = 'Ofir';

		//$this->engins[''][0] = '';
		//$this->engins[''][1] = '';
	}

	/**
	 * Returns the keys which can be represented.
	 * The key of a search engine can always be found in its domain name.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return String[] the represented keys.
	 */
	function getKeys()
	{
		$keys = array();
		foreach ($this->engins as $key => $value)
			$keys[] = $key;
		return $keys;
	}

	/**
	 * Returns an <code>String[]</code> of the urls the <code>$engine</code>
	 * represents.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $engine the string that represents the engine which urls is
	 *               to return.
	 * @return String[] the urls corresponding to <code>$engine</code>.
	 */
	function getUrls($engine)
	{
		$engine = strtolower($engine);

		$returns = array();
		for ($i = 0; isset($this->engines[$engine]) and $i < sizeof($this->engines[$engine]); $i += 2)
			$returns[] = $this->engines[$engine][$i];
		return $returns;
	}

	/**
	 * Returns an <code>String[]</code> of the names the <code>$engine</code>
	 * represents.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $engine the string that represents the engine which names is
	 *               to return.
	 * @return String[] the names corresponding to <code>$engine</code>.
	 */
	function getNames($engine)
	{
		$engine = strtolower($engine);

		$returns = array();
		for ($i = 1; isset($this->engines[$engine]) and $i < sizeof($this->engines[$engine]); $i += 2)
			$returns[] = $this->engines[$engine][$i];
		return $returns;
	}

}

/**
 * Builds an url.
 *
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class UrlBuilder
{
	/**
	 * The paramters of the url.
	 *
	 * @private
	 */
	var $parameters;

	/**
	 * The hash-part of the url. Set to an empty string to disable.
	 *
	 * @private
	 */
	var $hash;

	/**
	 * The domain and subdomain part. Set to an empty string to state unknown,
	 * or in other words relative to the current file.
	 *
	 * @private
	 */
	var $domain;

	/**
	 * The part after the domain name. If a domain is specified and a / does
	 * not exist as the first char in this variable, one is prepended.
	 *
	 * @private
	 */
	var $url;

	/**
	 * The port number. If this is <code>-1</code> no port number is specified.
	 *
	 * @private
	 */
	var $port = -1;

	/**
	 * The protocol to use.
	 * If a domain is given, but no protocol, &quot;http&quot; is used as
	 * default. If no domain is given, the protocol is never used.
	 *
	 * @private
	 */
	var $protocol;
	
	/**
	 * Creates a new instance.
	 *
	 * @param $url the part after the domain name.
	 * @param $domain the domain and subdomain part.
	 */
	function UrlBuilder($url, $domain = "")
	{
		$this->setUrl($url);
		$this->setDomain($domain);
	}

	/**
	 * Returns a textual representation of the represented url.
	 *
	 * @return String the url.
	 */
	function createUrl()
	{
		$url = "";


		//If a domain name is given
		if (strlen($this->getDomain()) > 0)
		{
			//Prepend the protocol
			if (strlen($this->getProtocol()) === 0)
				$url = "http";
			else
				$url = $this->getProtocol();
			$url .= "://";

			//Add the domain
			$url .= $this->getDomain();

			//If port is given
			if ($this->getPort() >= 0)
				$url .= ":".$this->getPort();

			//Is there a slash before the url (if exists)
			if (strlen($this->getUrl()) > 0)
			{
				if (substr($this->getUrl(), 0, 1) !== "/")
					$url .= "/";
				$url .= $this->getUrl();
			} else {
				$url .= "/";
			}
		} //End if domain name exists

		//Add parameters
		if (sizeof($this->getParameters()) > 0)
		{
			$url .= "?";
			foreach ($this->getParameters() as $key => $val)
				$url .= urlencode($key)."=".urlencode($val)."&";
			$url = substr($url, 0, -1);
		}

		if (strlen($this->getHash()) > 0)
			$url .= "#".urlencode($this->getHash());

		return $url;
	}

	/**
	 * Fills out this builder using the full url (with protocol, domain, port,
	 * path etc. mixed together).
	 * <b>WARNING</b>: This method has not yet been implemented!
	 */
	function setFullUrl($fullUrl)
	{
echo "setFullUrl not implemented!";
	}

	/**
	 * Returns the protocol to use. If a domain is given, but no protocol,
	 * &quot;http&quot; is used as default. If no domain is given, the
	 * protocol is never used.
	 *
	 * @public
	 * @return String the protocol to use.
	 */
	function getProtocol()
	{
		return $this->protocol;
	}

	/**
	 * Sets the protocol to use.
	 * If a domain is given, but no protocol, &quot;http&quot; is used as
	 * default. If no domain is given, the protocol is never used.
	 *
	 * @public
	 * @param $protocol the protocol to use.
	 */
	function setProtocol($protocol)
	{
		$this->protocol = $protocol;
	}

	/**
	 * Returns the domain and subdomain part. Set to an empty string to
	 * state unknown, or in other words relative to the current file.
	 *
	 * @public
	 * @return String the domain and subdomain part.
	 */
	function getDomain()
	{
		return $this->domain;
	}

	/**
	 * Sets the domain and subdomain part. Set to an empty string to state
	 * unknown, or in other words relative to the current file.
	 *
	 * @public
	 * @param $domain the domain and subdomain part.
	 */
	function setDomain($domain)
	{
		$this->domain = $domain;
	}
	/**
	 * Returns the part after the domain name. If a domain is specified and
	 * a / does not exist as the first char in this variable, one is prepended.
	 *
	 * @public
	 * @return String the part after the domain name.
	 */
	function getUrl()
	{
		return $this->url;
		}

	/**
	 * Sets the part after the domain name. If a domain is specified and a
	 * / does not exist as the first char in this variable, one is prepended.
	 *
	 * @public
	 * @param $url the part after the domain name.
	 */
	function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * Returns the hash-part of the url. Set to an empty string to disable.
	 *
	 * @public
	 * @return String the hash-part of the url. Set to an empty string to disable.
	 */
	function getHash()
	{
		return $this->hash;
	}

	/**
	 * Sets the hash-part of the url. Set to an empty string to disable.
	 *
	 * @public
	 * @param $hash the hash-part of the url. Set to an empty string to disable.
	 */
	function setHash($hash)
	{
		$this->hash = $hash;
	}

	/**
	 * Returns the paramters of the url.
	 *
	 * @public
	 * @return String[] the paramters of the url.
	 */
	function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * Sets the paramters of the url.
	 * Clears all other parameters.
	 *
	 * @public
	 * @param $parameters the paramters of the url.
	 */
	function setParameters($parameters)
	{
		$this->parameters = $parameters;
	}

	/**
	 * Sets the parameter of the url.
	 *
	 * @public
	 * @param $key the key of the parameter
	 * @param $val the value of the parameter
	 */
	function setParameter($key, $val)
	{
		$this->parameters[$key] = $val;
	}

	/**
	 * Returns the port number. If this is <code>-1</code> no port number is specified.
	 *
	 * @public
	 * @return int the port number. If this is <code>-1</code> no port number is specified.
	 */
	function getPort()
	{
		return $this->port;
	}

	/**
	 * Sets the port number. If this is <code>-1</code> no port number is specified.
	 *
	 * @public
	 * @param $port the port number. If this is <code>-1</code> no port number is specified.
	 */
	function setPort($port)
	{
		$this->port = $port;
	}

} //End of class UrlBuilder

/**
 * Builds an url for the statsite.
 *
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class StatSiteUrlBuilder extends UrlBuilder
{

	/**
	 * Values for the show[] parameter.
	 */
	var $showParameters;

	/**
	 * Creates a new instance.
	 *
	 * @param $siteContext an instance of the {@link SiteContext}.
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 */
	function StatSiteUrlBuilder(&$siteContext)
	{
			$this->setUrl("stats.php");
			$this->showParameters = array();
			//$this->setFullUrl($siteContext->getPath("cgiURL")."/stats.php");
			//$this->setParameter("brugernavn", $siteContext->getHTTP_VARS("brugernavn"));
	}
	
	/**
	 * Returns the parameters for the url. Overwrites its parent in the
	 * {@link UrlBuilder}.
	 *
	 * @return String[] the parameters for the url.
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 */
	function getParameters() {
		$params = array();
		for ($i = 0; $i < count($this->showParameters); $i++) {
			$params["show[$i]"] = $this->showParameters[$i];
		}
		return array_merge(parent::getParameters(), $params);
	}

	/**
	 * Sets that the stat given by <code>$stat</code> should be visible.
	 * The $stat is as returned by <code>StatGenerator-&gt;getHeadlineKey</code>.
	 *
	 * @param $stat as returned by <code>StatGenerator-&gt;getHeadlineKey</code>.
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 */
	function setStatVisible($stat)
	{
		//$this->setParameter("show[]", $stat);
		if (! in_array($stat, $this->showParameters))
			$this->showParameters[] = $stat;
	}
	
	/**
	 * Sets that all stats should be shown.
	 * 
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 */
	function setShowAll()
	{
		//$this->setParameters(array());
		$this->setStatVisible($this->getKeyAll());
	}

	/**
	 * Returns the key which states that all stats should be selected.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return  the key which states that all stats should be selected.
	 * @returns String
	 */
	function getKeyAll() {
		return 'all';
	}
} //End of class StatSiteUrlBuilder

/**
 * Provides utilities for debugging.
 */
class Debug {

	/**
	 * @author spagmoid at yahoo dot NOSPAMcom
	 */
	function stacktrace()
	{
	   $s = '';
	   $MAXSTRLEN = 64;
	   
	   $s = '<pre align=left>';
	   $traceArr = debug_backtrace();
	   array_shift($traceArr);
	   $tabs = sizeof($traceArr)-1;
	   foreach($traceArr as $arr)
	   {
	       for ($i=0; $i < $tabs; $i++) $s .= ' &nbsp; ';
	       $tabs -= 1;
	       $s .= '<font face="Courier New,Courier">';
	       if (isset($arr['class'])) $s .= $arr['class'].'.';
	       $args = array();
	       if(!empty($arr['args'])) foreach($arr['args'] as $v)
	       {
	           if (is_null($v)) $args[] = 'null';
	           else if (is_array($v)) $args[] = 'Array['.sizeof($v).']';
	           else if (is_object($v)) $args[] = 'Object:'.get_class($v);
	           else if (is_bool($v)) $args[] = $v ? 'true' : 'false';
	           else
	           { 
	               $v = (string) @$v;
	               $str = htmlspecialchars(substr($v,0,$MAXSTRLEN));
	               if (strlen($v) > $MAXSTRLEN) $str .= '...';
	               $args[] = "\"".$str."\"";
	           }
	       }
	       $s .= $arr['function'].'('.implode(', ',$args).')</font>';
	       $Line = (isset($arr['line'])? $arr['line'] : "unknown");
	       $File = (isset($arr['file'])? $arr['file'] : "unknown");
	       $s .= sprintf("<font color=#808080 size=-1> # line %4d, file: <a href=\"file:/%s\">%s</a></font>",
	           $Line, $File, $File);
	       $s .= "\n";
	   }    
	   $s .= '</pre>';
	   return $s;
	}

}

/**
 * Manages how to read and write data.
 * 
 * @public
 * @version 0.0.1
 * @author Simon Mikkelsen
 */
class PersistenceMgr extends DataSource {
	
	/**
	 * An instance of the object to use for reading.
	 * Must extend the class DataSource.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $sourceRead = NULL;
	
	/**
	 * An instance of the object to use for writing.
	 * Must extend the class DataSource.
	 *
	 * @private
	 * @since 0.0.1
	 */
	var $sourceWrite = NULL;
	
	/**
	 * Creates a new instance.
	 *
	 * @param $username the username
	 * @param $settings an instance of the settings object.
	 */
	function PersistenceMgr($username, &$settings) {
		DataSource::DataSource($username, $settings);
	}

	function setOperation($operation) {
    if ($this->sourceRead !== NULL) {
      $this->sourceRead->setOperation($operation);
    }
    if ($this->sourceWrite !== NULL) {
      $this->sourceWrite->setOperation($operation);
    }
	}

	/**
	 * Creates a datasource identified by the given $key.
	 *
	 * @param $key      key identifying the datasource to create.
	 * @param $username the username
	 * @param $settings an instance of the settings object.
	 * @private
	 */
	function &createDataSourceByKey($key, $username, &$settings) {
		if ($key === 'mysql.20') {
			$d = new DatabaseMysqlSource($username, $settings);
                        return $d;
		} else if ($key === 'textfile') {
			$d = new DataFileSource($username, $settings);
                        return $d;
		} else {
			echo "Unknown data source key ($key) given to PersistenceMgr::createDataSourceByKey.";
			exit;
		}
	}
	
	/**
	 * Returns an instance of the object to use for reading user data.
	 * The object extends the class DataSource.
	 *
	 * @return an instance of the object to use for reading user data.
	 * @private
	 */
	function &getReader() {
		if ($this->sourceRead === NULL) {
			$sourcesReadStr = $this->path->getOption('persistenceRead');
			//Find a datasource to use
			foreach ($sourcesReadStr as $dsKey) {
				$dataSource = &$this->createDataSourceByKey($dsKey, $this->brugernavn, $this->path);
				$res = $dataSource->hentFil();
				if ($res === 1) {
					//We got a datasource with the data in it
					$this->sourceRead = &$dataSource;
					return $dataSource;
				}
			} //End foreach
			
		} //End else
		//echo "Return reader: ".$this->sourceRead->getMethodId();
		return $this->sourceRead;
	}
	
	/**
	 * Returns if the users data have been loaded.
	 *
	 *  @return if the users data have been loaded.
	 */
	function isDataLoaded() {
		return (count($this->dataArray) > 0);
	}

	/**
	 * Returns an instance of the object to use for writing user data.
	 * The object extends the class DataSource.
	 * If the reader contains any loaded userdata it will be copied to the writer.
	 *
	 * @return an instance of the object to use for writing user data.
	 * @private
	 */
	function &getWriter() {
		if ($this->sourceWrite === NULL) {
			$sourceWriteStr = $this->path->getOption('persistenceWrite');
			
			//Is the reader and writer the same
			if ($this->sourceRead === NULL or $this->sourceRead->getMethodId() !== $sourceWriteStr) {
				//This should only happen once for each user, if the primary
				//reader is the same as the writer
				$this->sourceWrite = &$this->createDataSourceByKey($sourceWriteStr, $this->brugernavn, $this->path);

				//If the username does not exist in the writer: Create it.
				if (! $this->sourceWrite->findesBrugernavn() and $this->isDataLoaded()) {
				
					$createRes = $this->sourceWrite->createUser();
					if ($createRes === FALSE) {
						//Todo: An error occured
						echo "Could not create user $this->brugernavn";
						exit;
					}
				}
				
				//If a reader has not yet been created, use the same as the
				//writer (its usually when creating a new user)
				if ($this->sourceRead === NULL) {
					//$this->sourceRead = &$this->sourceWrite;
					$this->sourceRead = &$this->getReader();
				} else {
					$this->copyReaderToWriter();
				}
			} else if ($this->sourceRead !== NULL) {
				$this->sourceWrite = &$this->sourceRead;
			}
		}
		
		return $this->sourceWrite;
	}
	
	/**
	 * Copies the contents of the reader to the writer, if they are not the same object.
	 *
	 * @private
	 */
	function copyReaderToWriter() {
		$linesInDataFile = $this->sourceRead->getLinesInDataFile();
		$this->sourceWrite->setUsername($this->sourceRead->getUsername());
		for ($i = 0; $i < $linesInDataFile; $i++) {
			$this->sourceWrite->setLine($i, $this->sourceRead->getLine($i));
		}
	}
	
	//Impl of DataSource
	/**
	 * Deletes the represented user.
	 * 
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return TRUE on success or FALSE on faliure (as the PHP function unlink).
	 * @returns boolean
	 */
	function deleteUser() {
		//This must be done for all possible readers AND the writer
		
		$sourcesReadStr = $this->path->getOption('persistenceRead');
		//Delete in all readers
		$deleteResult = false;
		foreach ($sourcesReadStr as $dsKey) {
			$dataSource = &$this->createDataSourceByKey($dsKey, $this->brugernavn, $this->path);
			if ($dataSource->findesBrugernavn()) {
				$deleteResult &= $dataSource->deleteUser();
			} //End if
		} //End foreach
		
		//Delete in the writer
		$dsKey = $this->path->getOption('persistenceWrite');
		$dataSource = &$this->createDataSourceByKey($dsKey, $this->brugernavn, $this->path);
		if ($dataSource->findesBrugernavn()) {
			$deleteResult &= $dataSource->deleteUser();
		} //End if
		
		//Returns false if just one fails or if the username does not exist anywhere.
		return $deleteResult;
	}
	
	/**
	 * Returns if the represented user exists in any of the avalible
	 * data sources.
	 *
	 * @public
	 * @since 2.1.0
	 * @version 2.1.0
	 * @return true if the user exist in a data source, else false.
	 * @returns boolean
	 */
	function userExists() {
		//This must be done for all possible readers AND the writer
		
		$sourcesReadStr = $this->path->getOption('persistenceRead');
		//Check in all readers
		$userExists = false;
		foreach ($sourcesReadStr as $dsKey) {
			$dataSource = &$this->createDataSourceByKey($dsKey, $this->brugernavn, $this->path);
			$userExists |= $dataSource->findesBrugernavn();
		} //End foreach
		
		//Check in the writer
		$dsKey = $this->path->getOption('persistenceWrite');
		$dataSource = &$this->createDataSourceByKey($dsKey, $this->brugernavn, $this->path);
		$userExists |= $dataSource->findesBrugernavn();
		
		//Returns true if the user exist in just one data source.
		return $userExists;
	}

	/**
	 * Fetches the users data file.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return boolean 1 if the file was fetched, -2 if the data file is
	 *                 corrupt, else 0.
	 */
	function hentFil()
	{
		$dataSource = &$this->getReader();
		if ($dataSource === NULL) {
			return 0;
		}
		return $dataSource->hentFil();
	}
	
	/**
	 * Returns a representation of the data that can be used for backup.
	 * 
	 * @return a representation of the data that can be used for backup.
	 */
	function getBackup() {
		$dataSource = &$this->getReader();
		return $dataSource->getBackup();
	}
	
	/**
	 * Creates the current user, if non existent.
	 *
	 * @return <code>true</code> if it went well, else <code>false</code>.
	 */
	function createUser()
	{
		$dataSource = &$this->getWriter();
		return $dataSource->createUser();
	}

	/**
	 * Saves the represented data file.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @param $saveTimes the number of times the data file should
	 *        be attempted saved, if not saved correctly. This
	 *        parameter is primary ment to make it useable to let
	 *        the function invoke itself (recursively).
	 * @return boolean <code>true</code> if the file was saved, else
	 *         <code>false</code>.
	 */
	function gemFil($saveTimes = 3)
	{
		$dataSource = &$this->getWriter();
		return $dataSource->gemFil($saveTimes);
	}

	/**
	 * Returns if the $username/$password combination can be authenticated
	 * against the main password.
	 * 
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return boolean if the user can be authenticated.
	 * @param $username the username to authenticate.
	 * @param $password the password to authenticate.
         * @param $requiredPermission the permission the user must have.
         * @param $getOnLogin the permissions the user must be on successfull login.
	 */
	function authenticate($username, $password, $requiredPermission, $getOnLogin) {
		//Todo: Maby this should just use the reader, but it is the safest
		//to use the writer now.
		$dataSource = &$this->getWriter();
		if ($dataSource === NULL) {
			return false;
		}
		return $dataSource->authenticate($username, $password, $requiredPermission, $getOnLogin);
	}

	/**
	 * Returns the number of lines in the data file.
	 * This is a fixed, hardcoded number, that only may be expanded.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @return int the number of lines in the data file.
	 */
	function getLinesInDataFile()
	{
		$dataSource = &$this->getWriter();
		return $dataSource->getLinesInDataFile();
	}

	/**
	 * Returns the line corresponding to the parameter.
	 * All new line charaters are removed.
	 * The first line has index 0 (zero).
	 *
	 * @param $index the index of the requested line.
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return String the requested line.
	 */
	function getLine($index)
	{
		$dataSource = &$this->getWriter();
		return $dataSource->getLine($index);
	}

        function getField($name) {
		$dataSource = &$this->getWriter();
                return $dataSource->getField($name);
        }

        function setField($name, $value) {
		$dataSource = &$this->getWriter();
                $dataSource->setField($name, $value); 
        }

	/**
	 * Returns the line that corresponds to the parameter,
	 * as an array (<code>Stirng[]</code>). All new line charchars are
	 * removed. The first line has the index 0, and the first element
	 * in the returned array has index 0 in the returned array.
	 *
	 * @public
	 * @version 0.0.1
	 * @since 0.0.1
	 * @param $index the index of the wanted line.
	 * @return String[] the line as an array
	 */
	function getLineAsArray($index)
	{
		$dataSource = &$this->getWriter();
		return $dataSource->getLineAsArray($index);
	}

	 /**
	 * Sets the contents of the file.
	 * Makes sure that the line always only has one new-line charater in the
	 * end, and no where else.
	 *
	 * @param $index the index of the requested line.
	 * @param $line the contents of the line to set.
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return void
	 */
	 function setLine($index,$line)
	 {
			$dataSource = &$this->getWriter();
			$dataSource->setLine($index,$line);
	 }
	
	/**
	 * Lists all usernames. If $notOlderThan is given, only usernames which
	 * have been active after the given time (in seconds, unix time), will
	 * be returned,
	 * 
	 * @param $notOlderThan only return usernames accessed after this
	 *                      unix time (in seconds).
	 * @returns String[]
	 */
	function listUsernames($notOlderThan = -1) {
		echo "Function listUsernames not implemented for mysql data source.";
		exit;
	}
	
	/**
	 * Returns if any data has been loaded. Many methods will fail if used
	 * when this method returns false.
	 *
	 * @public
	 * @since 0.0.1
	 * @version 0.0.1
	 * @return true or false, depending on if any data has been loaded.
	 * @returns boolean
	 */
	function loaded() {
		return ($this->getReader() !== NULL);
	}

} //End class PersistenceMgr.

/**
 * Compare URL with a number of advanced settings, such as ignoring protocol
 * or sub domain.
 *
 * @author Simon Mikkelsen
 */
class UrlComparator {
	
	/**
	 *  Array of sub domains to ignore.
	 *
	 *  @see setIgnoreSubdomain()
	 *  @private
	 */
	var $ignoreSubdomains = array("www");
	
	/**
	 * If protocols shall be ignored. E.g. @c http:// and @c https:// is
	 * the same. Booleans @c true and @c false are valid values.
	 *
	 * @private
	 */
	var $ignoreProtocols = true;
	
	/**
	 * If the case shall be ignored in the path part of the url.
	 *
	 * @see setIgnorePathCase()
	 * @private
	 */
	var $ignorePathCase = false;
	
	/**
	 * Files that can be index files.
	 *
	 * @see setIndexFiles()
	 * @private
	 */
	var $indexFiles = array("index.htm", "index.html", "index.shtml",
	                        "index.php", "index.php3", "index.jsp",
	                        "default.htm", "default.html", "default.asp",
	                        "default.aspx");
	/**
	 * Creates a new instance with default settings optimized for Unix urls.
	 *
	 * @public
	 * @author Simon Mikkelsen
	 */
	function UrlComparator() {
	}
	
	/**
	 * Returns if the given @c $url is part of the given @c $siteUrl.
	 * E.g. if the site is @c http://www.foobar.com/ and the url is
	 * http://foobar.com/some/file.html then @c true is returned.
	 *
	 * @param $siteUrl the url of the website.
	 * @param $url     the url that might be a part of the website.
	 * @return if the given @c $url is part of the given @c $siteUrl.
	 * @public
	 */
	function isInSite($siteUrl, $url) {
		//Are they equal?
		if ($siteUrl === $url) {
			return true;
		}

		//Remove searc and hash-mark parts.
		$siteUrl = $this->removeSearch($siteUrl);
		$url = $this->removeSearch($url);
		
		//Remove any index files from the site.
		list($path, $file) = $this->splitPath($siteUrl);
		if ($this->ignorePathCase === TRUE) {
			$file = strtolower($file);
		}
		if (in_array($file, $this->indexFiles)) {
			$siteUrl = $path;
		}
		
		//Make sure they contains the same number of /'s.
		$url = $this->ensureDirCount($siteUrl, $url);
		
		return $this->equals($siteUrl, $url);
	}
	
	/**
	 * Returns an altered version of @c $changeUrl that do not have
	 * more directories (or just /'s) than @c $refUrl.
	 *
	 * @param $refUrl the reference, which directory count, the
	 *                @c changeUrl must match.
	 * @param $changeUrl the url that is possibly changed and
	 *                   returned.
	 */
	function ensureDirCount($refUrl, $changeUrl) {
		//Remove trailing / to make the algorithm simpler.
		if (substr($refUrl, -1) === '/')
			$refUrl = substr($refUrl, 0, -1);
		if (substr($changeUrl, -1) === '/')
			$changeUrl = substr($changeUrl, 0, -1);
			
		//Remove scheme / protocol for the same reason.
		list($sRef, $refUrl) = $this->splitScheme($refUrl);
		list($sChange, $changeUrl) = $this->splitScheme($changeUrl);
		
		//Count /'s
		$rCnt = substr_count($refUrl, '/');
		$cCnt = substr_count($changeUrl, '/');
		
		//Strip those off we don't want.
		for ($r = $rCnt; $r < $cCnt; $r++) {
			$changeUrl = substr($changeUrl, 0, strrpos($changeUrl, '/'));
		}
		
		return $sChange.$changeUrl.'/';
	}
	
	/**
	 * Returns a 2 index array (0, 1) split after the @c :// of the
	 * scheme, including @c ://. E.g.
	 * @code
	 *	print_r(splitScheme('http://foo.com/'));
	 * array(
	 *   [0] => 'http://',
	 *   [1] => 'foo.com/'
	 * );
	 * @endcode
	 *
	 * @param $url the one to split.
	 * @return array of scheme and the rest of the url.
	 * @public
	 */
	function splitScheme($url) {
		$index = strpos($url, '://');
		if ($index === false) {
			//There is no protocol.
			return array('', $url);
		}
		
		list($scheme, $rurl) = split('://', $url);
		return array($scheme.'://', $rurl);
	}
	
	/**
	 * Returns the url stripped for everything from the ?.
	 *
	 * @param $url the one to strip.
	 * @return the url striped for everything from the ?.
	 * @private
	 */
	function removeSearch($url) {
		$qIndex = strpos($url, '?');
		if ($qIndex !== FALSE)
			$url = substr($url, 0, $qIndex);
			
		$hIndex = strpos($url, '#');
		if ($hIndex !== FALSE)
			$url = substr($url, 0, $hIndex);
			
		return $url;
	}
	
	/**
	 * Parses the @c $url using PHPs @c parse_url and attempts to insert
	 * missing parts. E.g. if no scheme / protocol is specified, it is
	 * inserted.
	 *
	 * @param $url the one to parse.
	 * @param $reparses states if the invocation is a reparse (@c true) or
	 *                  not (@c false, the usual case). This is only to prevent
	 *                  an infinite loop for unknown and unexpected data.
	 * @return the parsed @c $url, maby with fixes, or @c false if impossible
	 *         to parse.
	 * @public
	 */
	function parse_and_fix($url, $reparse = false) {
		/* parse_url result:
    [scheme] => http
    [host] => hostname
    [user] => username
    [pass] => password
    [path] => /path
    [query] => arg=value
    [fragment] => anchor
		*/
		$purl = parse_url($url);
		//This url is so bad we cannot parse it.		
		if ($purl === false) {
			return false;
		}
		
		//Default key values.
		//Certain keys have non empty default values, where it is reasonable.
		$setKeys = array('scheme' => 'http', 'host' => '', 'path' => '/',
										 'user' => '', 'pass' => '', 'query' => '', 'fragment' => '');
		
		//Has scheme / protocol been set?
		if (!isset($purl['scheme']) or strlen($purl['scheme']) === 0) {
			if ($reparse) {
				return false; //A reparse should not trigger this situation.
			}
			//No: Add it and reparse.
			return $this->parse_and_fix($setKeys['scheme'].'://'.$url, true);
		}
		
		//Make sure all expected keys are set.
		foreach ($setKeys as $key => $default) {
			if (!isset($purl[$key])) {
				$purl[$key] = $default;
			}
		}
	
		return $purl;
	}
	
	/**
	 * Returns if the given urls are equal, based on the rules set op in the
	 * class.
	 *
	 * @param $url1 the first url to compare.
	 * @param $url2 the second url to compare.
	 * @return if the urls are equal (@c true) or not (@c false).
	 * @public
	 */
	function equals($url1, $url2) {
		//Are they just equal?
		if ($url1 == $url2) {
			return true;
		}
		
		//No - try the rules.
		
		/* parse_url result:
    [scheme] => http
    [host] => hostname
    [user] => username
    [pass] => password
    [path] => /path
    [query] => arg=value
    [fragment] => anchor
		*/
		$url1Cmp = $this->parse_and_fix($url1);
		$url2Cmp = $this->parse_and_fix($url2);
		
		//If one of the urls are really bad: Probably not equal.
		if ($url1Cmp === FALSE or $url2Cmp === FALSE) {
			return false;
		}
		
		//Apply case ignoring.
		$url1Cmp['scheme'] = strtolower($url1Cmp['scheme']);
		$url2Cmp['scheme'] = strtolower($url2Cmp['scheme']);
		$url1Cmp['host'] = strtolower($url1Cmp['host']);
		$url2Cmp['host'] = strtolower($url2Cmp['host']);
		
		if ($this->ignorePathCase === TRUE) {
			$url1Cmp['path'] = strtolower($url1Cmp['path']);
			$url2Cmp['path'] = strtolower($url2Cmp['path']);
		}
		
		//Set no path to / e.g. foo.com vs. foo.com/
/*		if (strlen($url1Cmp['path']) === 0)
			$url1Cmp['path'] = '/';
		if (strlen($url2Cmp['path']) === 0)
			$url2Cmp['path'] = '/';
*/		
		//Look at protocol / scheme
		if (!$this->ignoreProtocols and $url1Cmp['scheme'] != $url2Cmp['scheme']) {
			return false;
		}
		
		//Look at misc. parts.
		if ($url1Cmp['user'] != $url2Cmp['user']
		 or $url1Cmp['pass'] != $url2Cmp['pass']
		 or $url1Cmp['query'] != $url2Cmp['query']
		 or $url1Cmp['fragment'] != $url2Cmp['fragment']) {
			return false;
		}
		
		//Test hostname
		if ($this->stripHostname($url1Cmp['host']) != $this->stripHostname($url2Cmp['host'])) {
			return false;
		}

		//Test path
		if ($url1Cmp['path'] == $url2Cmp['path']) {
			return true;
		}
		//No - try the rules.
		
		//Test path
		list($path1, $file1) = $this->splitPath($url1Cmp['path']);
		list($path2, $file2) = $this->splitPath($url2Cmp['path']);

		if ($path1 != $path2) {
			return false;
		}
		
		if ($file1 == $file2) {
			return true;
		} else if (strlen($file1) === 0 and in_array($file2, $this->indexFiles)) {
			//If one is empty and the other one is an index file: Return equal.
			return true;
		} else if (strlen($file2) === 0 and in_array($file1, $this->indexFiles)) {
			//If one is empty and the other one is an index file: Return equal.
			return true;
		}

		return false;
	}
	
	/**
	 * Splits the given path into path, filename and file name extentiont.
	 * The result is returned as an array where index 0 is the path1 (including
	 * all slashes) and 1 is the file name. The path can optionally contain the
	 * initial part of an url.
	 * E.g.
	 * @code
	 * //Normal url.
	 * print_r(splitPath("/foo/bar.html"));
	 * // [0] => "/foo/"
	 * // [1] => "bar.html"
	 *
	 * //No file name.
	 * print_r(splitPath("/foo/bar/"));
	 * // [0] => "/foo/bar/"
	 * // [1] => ""
	 *
	 * //Root page.
	 * print_r(splitPath("/"));
	 * // [0] => "/"
	 * // [1] => ""
	 *
	 * //Contains an URL.
	 * print_r(splitPath("http://www.foo.com/foo/bar.html"));
	 * // [0] => "http://www.foo.com/foo/"
	 * // [1] => "bar.html"
	 *
	 * @endcode
	 *
	 * @param $path the path to split.
	 * @return the path split up.
	 */
	function splitPath($path) {
		$result = array("", "");
		
		//Find the end slash.
		$endSlashIndex = strrpos($path, '/');
		if ($endSlashIndex === FALSE) {
			//No slashes: It should be a file name.
			$result[1] = $path;
			return $result;
		}
		
		//Get the path to return. including the final slash.
		$result[0] = substr($path, 0, $endSlashIndex + 1);
		$result[1] = substr($path, $endSlashIndex + 1);
		return $result;
	}
	
	/**
	 * Returns the given hostname striped for sub domains returned by
	 * getIgnoreSubdomain().
	 *
	 * @param $hostname the one to strip.
	 * @return the stripped hostname.
	 * @private
	 */
	function stripHostname($hostname) {
		$hostSplit = explode(".", $hostname);
		
		//Iterate over the hostname parts. - 2: Don't look at domain and top level domain.
		for ($i = 0; $i < count($hostSplit) - 2; $i++) {
			if (isset($hostSplit[$i]) and in_array($hostSplit[$i], $this->ignoreSubdomains)) {
				//Remove this sub domain
				unset($hostSplit[$i]);
				$i--;
			}
		}
		
		return implode(".", $hostSplit);
	}
	
	/**
	 *  Sets an array of sub domains to ignore. A typical example is @c www.
	 *  A protocol to ignore will be stripped off both urls before comparing.
	 *  If the sub domain is only present on one of the urls, it is only
	 *  stripped off that url.
	 *
	 *  @public
	 *  @param array of sub domains to ignore.
	 */
	function setIgnoreSubdomain($ignoreSubdomains) {
		$this->ignoreSubdomains = $ignoreSubdomains;
	}

	/**
	 *  Returns an array of sub domains to ignore.
	 *
	 *  @see setIgnoreSubdomain()
	 *  @public
	 *  @return array of sub domains to ignore.
	 */
	function getIgnoreSubdomain() {
		return $this->ignoreSubdomains;
	}
	
	/**
	 * Sets If protocols shall be ignored. E.g. @c http:// and @c https:// is
	 * the same. Booleans @c true and @c false are valid values.
	 *
	 * @param $ignoreProtocols if protocols shall be ignored.
	 * @public
	 */
	function setIgnoreProtocols($ignoreProtocols) {
		$this->ignoreProtocols = $ignoreProtocols;
	}
	
	/**
	 * Returns If protocols shall be ignored. E.g. @c http:// and @c https:// is
	 * the same. Booleans @c true and @c false are valid values.
	 *
	 * @return if protocols shall be ignored.
	 * @public
	 */
	function getIgnoreProtocols() {
		return $this->ignoreProtocols;
	}
	
	/**
	 * Sets if the case shall be ignored in the path part of the url. Some web
	 * servers are case insensitive, and this settings should be set to @c true.
	 * Booleans @c true and @c false are valid balues.
	 *
	 * When setting this option to @c true, all file names given to
	 * setIndexFiles() that has just one upper case letter, will be ignored.
	 *
	 * @param $ignorePathCase if case shall be ignored in the path part of the
	 *                        url.
	 * @public
	 */
	function setIgnorePathCase($ignorePathCase) {
		$this->ignorePathCase = $ignorePathCase;
	}
	
	/**
	 * Returns if the case shall be ignored in the path part of the url.
	 *
	 * @see setIgnorePathCase()
	 * @return if case shall be ignored in the path part of the url.
	 * @public
	 */
	function getIgnorePathCase() {
		return $this->ignorePathCase;
	}
	
	/**
	 * Sets an array of files that can be index files, and should be removed from the end of
	 * the path of the url before comparing, with the exception that if two
	 * urls have different index files they will never be considered equal.
	 *
	 * Even if getIgnorePathCase() is @c true case will never be ignored on
	 * the files in the given array. If case should be ignored, give only
	 * lower case file names (e.g. using PHP's strtolower()).
	 *
	 * @param $indexFiles array of possible index files.
	 * @public
	 */
	function setIndexFiles($indexFiles) {
		$this->indexFiles = $indexFiles;
	}
	
	/**
	 * Returns an array of files that can be index files.
	 *
	 * @see setIndexFiles()
	 * @return an array of possible index files.
	 * @public
	 */
	function getIndexFiles() {
		return $this->indexFiles;
	}
} //End of class UrlComparator

?>
