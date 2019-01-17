// global vars
var i, pos, obj, tempObj, tempEle, winSize, extent, scrollHeight;


//toolTip object
var toolTip = null;
var toolTipParent = null;


//find object position
function getRealPos(ele,dir)
{
(dir=="x") ? pos = ele.offsetLeft : pos = ele.offsetTop;
tempEle = ele.offsetParent;
while(tempEle != null)
{
pos += (dir=="x") ? tempEle.offsetLeft : tempEle.offsetTop;
tempEle = tempEle.offsetParent;
}
return pos;
}




//delay timer
var goTip = false;
var goTimer = null;
function focusTimer(e)
{
//second loop 
if(goTimer != null)
{
//clear timer
clearInterval(goTimer);
goTimer = null;
//pass object to create tooltip
focusTip(e);
}
//first loop
else
{
//get focussed object
(e) ? obj = e.target : obj = event.srcElement;
//pass object back through timer
tempObj = obj;
//set interval
goTimer = setInterval('focusTimer(tempObj)',400);
}
}


//create tooltip
function focusTip(obj)
{

//remove any existing tooltip
blurTip();

//if tooltip is null
if(toolTip == null)
{
//get window dimensions
if(typeof window.innerWidth!="undefined")
{
winSize = {
x : window.innerWidth,
y : window.innerHeight
};
}
else if(typeof document.documentElement.offsetWidth!="undefined")
{
winSize = {
x : document.documentElement.offsetWidth,
y : document.documentElement.offsetHeight
};
}
else 
{
winSize = {
x : document.body.offsetWidth,
y : document.body.offsetHeight
};
}

//create toolTip
toolTip = document.createElement('div');

//add classname
toolTip.setAttribute('class','');
toolTip.className = (obj.className == 'youAreHere') ? 'heretooltip' : 'tooltip';

//get focussed object co-ordinates
if(toolTipParent == null)
{
toolTipParent = {
x : getRealPos(obj,'x') - 3,
y : getRealPos(obj,'y') + 2
};
}

// offset tooltip from object
toolTipParent.y += obj.offsetHeight;

//apply tooltip position
toolTip.style.left = toolTipParent.x + 'px';
toolTip.style.top = toolTipParent.y + 'px';

//write in title attribute (with 'you are here' string)
toolTip.innerHTML = (obj.className == 'youAreHere') ? obj.title + ' <b>[You Are Here]</b>' : obj.title;

//add to document
document.body.appendChild(toolTip);

//restrict width
if(toolTip.offsetWidth > 300)
{
toolTip.style.width = '300px';
}

//get tooltip extent
extent = {
x : toolTip.offsetWidth,
y : toolTip.offsetHeight
};

//if tooltip exceeds window width
if((toolTipParent.x + extent.x) >= winSize.x)
{
//shift tooltip left
toolTipParent.x -= extent.x;
toolTip.style.left = toolTipParent.x + 'px';
}

//get scroll height
if(typeof window.pageYOffset!="undefined")
{
scrollHeight = window.pageYOffset;
}
else if(typeof document.documentElement.scrollTop!="undefined")
{
scrollHeight = document.documentElement.scrollTop;
}
else 
{
scrollHeight = document.body.scrollTop;
}

//if tooltip exceeds window height
if((toolTipParent.y + extent.y) >= (winSize.y + scrollHeight))
{
//shift tooltip up
toolTipParent.y -= (extent.y+obj.offsetHeight+4);
toolTip.style.top = toolTipParent.y + 'px';
}


}

}


function blurTip()
{
//if tooltip exists
if(toolTip != null)
{
//remove and nullify tooltip
document.body.removeChild(toolTip);
toolTip = null;
toolTipParent = null;
}
//cancel timer
clearInterval(goTimer);
goTimer = null;
}



window.onload = function()
{
if(typeof document.getElementsByTagName!="undefined")
{

//get tags collection
var allTags = document.getElementsByTagName('*');
var allTagsLen = allTags.length;

for (var i=0;i<allTagsLen;i++)
{

//if tag has title attribute
if(allTags[i].title)
{
//attach event
allTags[i].onfocus = focusTimer;
allTags[i].onblur = blurTip;
allTags[i].onmouseover = blurTip;

}

}

}
}