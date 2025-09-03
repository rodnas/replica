function rightchangeBanner() //banner changer function
	{
	if(rightcounter > rightbanArray.length-1) rightcounter = 0;
	getobject("rightadverttext").innerHTML = rightbanArray[rightcounter];
	rightadverturl = righturlArray[rightcounter]; //sets a new URL to the banner
	rightcounter++; //increase the counter for the next banner
	}

function toplinechangeBanner() //banner changer function
	{
	if(toplinecounter > toplinebanArray.length-1) toplinecounter = 0;
	getobject("toplineadverttext").innerHTML = toplinebanArray[toplinecounter];
	toplineurl = toplineurlArray[toplinecounter]; //sets a new URL to the banner
	toplinecounter++; //increase the counter for the next banner
	}

function bottomlinechangeBanner() //banner changer function
	{
	if(bottomlinecounter > bottomlinebanArray.length-1)	bottomlinecounter = 0;
	getobject("bottomlineadverttext").innerHTML = bottomlinebanArray[bottomlinecounter];
	bottomlineurl = bottomlineurlArray[bottomlinecounter]; //sets a new URL to the banner
	bottomlinecounter++; //increase the counter for the next banner
	}

function getobject(obj)
	{
	if (document.getElementById)
		return document.getElementById(obj)
	else if (document.all)
		return document.all[obj]
	}
