
(function($)
{$.fn.sudoSlider=function(optionsOrg)
{var falsev=!1,truev=!falsev,defaults={controlsShow:truev,controlsFadeSpeed:400,controlsFade:truev,insertAfter:truev,firstShow:falsev,lastShow:falsev,vertical:falsev,speed:800,ease:'swing',auto:falsev,pause:2000,continuous:falsev,prevNext:truev,numeric:falsev,numericAttr:'class="controls"',numericText:[],clickableAni:falsev,history:falsev,speedhistory:400,autoheight:truev,customLink:falsev,fade:falsev,crossFade:truev,fadespeed:1000,updateBefore:falsev,ajax:falsev,preloadAjax:100,startSlide:falsev,ajaxLoadFunction:falsev,beforeAniFunc:falsev,afterAniFunc:falsev,uncurrentFunc:falsev,currentFunc:falsev,prevHtml:'<a href="#" class="prevBtn"></a>',nextHtml:'<a href="#" class="nextBtn"></a>',loadingText:'Loading Content...',firstHtml:'<a href="#" class="firstBtn"> first </a>',controlsAttr:'id="controls"',lastHtml:'<a href="#" class="lastBtn"> last </a>',autowidth:truev,slideCount:1,resumePause:falsev,moveCount:1},baseSlider=this;optionsOrg=$.extend(defaults,optionsOrg);return this.each(function()
{var init,ul,li,liConti,s,t,ot,ts,clickable,buttonclicked,fading,ajaxloading,numericControls,numericContainer,destroyed,controls,html,firstbutton,lastbutton,nextbutton,prevbutton,timeout,destroyT,oldSpeed,dontCountinue,dontCountinueFade,autoOn,a,b,i,continuousClones,orgSlideCount,beforeAniFuncFired=falsev,asyncTimedLoad,callBackList=[],obj=$(this),options=optionsOrg,option=[],bigNumber=10000000;initSudoSlider(obj,falsev);function initSudoSlider(obj,destroyT)
{b=0;for(a in options){option[b]=options[a];b++;}
destroyed=falsev;init=truev;ul=obj.children("ul");li=ul.children("li");s=li.length;if(option[25])
{if(ul.length==0)obj.append(ul=$('<ul></ul>'));if(option[25].length>s)
{for(a=1;a<=option[25].length-s;a++)ul.append('<li><p>'+option[35]+'</p></li>');li=ul.children("li");s=li.length;}}
t=0;ot=t;ts=s-1;clickable=truev;buttonclicked=falsev;fading=falsev;ajaxloading=falsev;numericControls=[];destroyed=falsev;if(obj.css("position")=="static")obj.css("position","relative");if(li.length){li.css('float','left');li.eq(0).css('display','block');}
option[40]=parseInt10(option[40])
option[42]--;orgSlideCount=option[40];if(!option[21])option[40]+=option[42];option[27]=parseInt10(option[27])||1;continuousClones=option[11]&&(!option[21]||option[40]>1);for(a=0;a<s;a++)
{option[15][a]=option[15][a]||(a+1);option[25][a]=option[25][a]||falsev;}
for(i=0;i<s;i++)
{if(callBackList[i]==undefined)callBackList[i]=[];callBackList[i].push(li.eq(i));}
if(continuousClones)
{for(i=option[40];i>=1;i--)
{var appendRealPos=getRealPos(-option[40]+i-1);var prependRealPos=getRealPos(option[40]-i);var appendClone=li.eq(appendRealPos).clone();var prependClone=li.eq(prependRealPos).clone();callBackList[appendRealPos].push(appendClone);callBackList[prependRealPos].push(prependClone);ul.prepend(appendClone).append(prependClone);}
liConti=ul.children("li");if(option[25])
{for(a=s-option[40];a<s;a++)
{if(option[25][a]&&a!=option[27]-1)ajaxLoad(a,falsev,0,falsev);}}}
option[2]=option[2]&&!option[11];ul[option[6]?'height':'width'](bigNumber);liConti=ul.children("li");controls=falsev;if(option[0])
{controls=$('<span '+option[37]+'></span>');$(obj)[option[3]?'after':'before'](controls);if(option[13]){numericContainer=controls.prepend('<ol '+option[14]+'></ol>').children();b=option[13]=='pages'?orgSlideCount:1;for(a=0;a<s-((option[11]||option[13]=='pages')?1:orgSlideCount)+1;a+=b)
{numericControls[a]=$("<li rel='"+(a+1)+"'><a href='#'><span>"+option[15][a]+"</span></a></li>").appendTo(numericContainer).click(function(){goToSlide($(this).attr('rel')-1,truev);return falsev;});};}
if(option[4])firstbutton=makecontrol(option[36],"first");if(option[5])lastbutton=makecontrol(option[38],"last");if(option[12]){nextbutton=makecontrol(option[34],"next");prevbutton=makecontrol(option[33],"prev");}};if(option[26]===truev)for(i=0;i<=ts;i++)if(option[25][i]&&option[27]-1!=i)ajaxLoad(i,falsev,0,falsev);b=[1,7,10,18,23];for(a in b){option[parseInt10(b[a])]=textSpeedToNumber(option[parseInt10(b[a])]);}
if(option[20])
{$(option[20]).live('click',function(){if(a=$(this).attr('rel')){if(a=='stop')
{option[9]=falsev;stopAuto();}
else if(a=='start')
{timeout=startAuto(option[10]);option[9]=truev;}
else if(a=='block')clickable=falsev;else if(a=='unblock')clickable=truev;else if(clickable)goToSlide((a==parseInt10(a))?a-1:a,truev);}
return falsev;});}
runOnImagesLoaded(liConti.slice(0,option[40]),truev,function()
{if(option[9])timeout=startAuto(option[10]);if(destroyT)animate(destroyT,falsev,falsev,falsev);else if(option[17]){a=$(window);if(i=a.hashchange)
{i(URLChange);}
else if(i=$.address)
{i.change(URLChange);}
else
{a.bind('hashchange',URLChange);}
URLChange();}
else animate(option[27]-1,falsev,falsev,falsev);});}
function URLChange()
{i=filterUrlHash(location.hash.substr(1));if(init)animate(i,falsev,falsev,falsev);else if(i!=t)goToSlide(i,falsev);}
function startAsyncDelayedLoad()
{if(option[25]&&parseInt10(option[26]))
{for(a in option[25])
{if(option[25][a])
{clearTimeout(asyncTimedLoad);asyncTimedLoad=setTimeout(function(){ajaxLoad(a,falsev,0,falsev);},parseInt10(option[26]));break;}}}}
function startAuto(pause)
{autoOn=truev;return setTimeout(function(){goToSlide("next",falsev);},pause);}
function stopAuto()
{clearTimeout(timeout);autoOn=falsev;}
function textSpeedToNumber(speed)
{return(parseInt10(speed)||speed==0)?parseInt10(speed):speed=='fast'?200:(speed=='normal'||speed=='medium')?400:speed=='slow'?600:400;};function makecontrol(html,action)
{return $(html).prependTo(controls).click(function(){goToSlide(action,truev);return falsev;});}
function goToSlide(i,clicked,speed)
{beforeAniFuncFired=falsev;if(!destroyed)
{if(option[9])
{var delay=option[21]?option[23]:option[7];if(clicked){stopAuto();if(option[41])timeout=startAuto(delay+option[41]);}
else timeout=startAuto(option[10]+delay);}
if(option[21])
{fadeto(i,clicked,speed);}
else
{if(option[11])
{a=filterDir(i);i=a;var diff=Math.abs(t-a);if(a<option[40]-orgSlideCount+1&&Math.abs(t-a-s)<diff)
{i=a+s;diff=Math.abs(t-a-s);}
if(a>ts-option[40]&&Math.abs(t-a+s)<diff)
{i=a-s;}}
else
{i=filterDir(i);}
animate(i,clicked,truev,falsev,speed);}}};function fadeControl(fadeOpacity,fadetime,nextcontrol)
{if(nextcontrol)
{var eA=nextbutton,eB=lastbutton,directionA='next',directionB='last',firstlastshow=option[5];}
else
{var eA=prevbutton,eB=firstbutton,directionA='prev',directionB='first',firstlastshow=option[4];}
if(option[0])
{if(option[12])eA[fadeOpacity?'fadeIn':'fadeOut'](fadetime);if(firstlastshow)eB[fadeOpacity?'fadeIn':'fadeOut'](fadetime);}
if(option[20])
{$(option[20]).filter(function(index){return($(this).attr("rel")==directionA||$(this).attr("rel")==directionB);})
[fadeOpacity?"fadeIn":"fadeOut"](fadetime);}};function fadeControls(a,fadetime)
{fadeControl(a,fadetime,falsev);fadeControl(a<s-orgSlideCount,fadetime,truev);};function setCurrent(i)
{i=getRealPos(i)+1;if(option[13])for(a in numericControls)setCurrentElement(numericControls[a],i);if(option[20])setCurrentElement($(option[20]),i);};function setCurrentElement(element,i)
{if(element.filter)
{element.filter(".current").removeClass("current").each(function(){if(isFunc(option[31])){option[31].call(this,$(this).attr("rel"));}});element.filter(function(){b=$(this).attr("rel");if(option[13]=='pages')
{for(a=0;a<orgSlideCount;a++)
{if(b==i-a)return truev;}}
else return b==i;return falsev;}).addClass("current").each(function(index){if(isFunc(option[32])){option[32].call(this,i);}});}};function filterUrlHash(a)
{for(i in option[15])if(option[15][i]==a)return i;return a?t:0;};function runOnImagesLoaded(target,allSlides,callback)
{var elems=target.add(target.find('img')).filter('img');var len=elems.length;if(!len)
{callback();return this;}
function loadFunction(that)
{$(that).unbind('load').unbind('error');if(that.naturalHeight&&!that.clientHeight)
{$(that).height(that.naturalHeight).width(that.naturalWidth);}
if(allSlides)
{len--;if(len==0)
{callback();}}
else
{callback();}}
elems.each(function(){var that=this;$(that).load(function(){var imageObj=$(that);if(allSlides)
imageObj.closest('ul').children('li').css('display','block');if(imageObj.attr("width")>0&&imageObj.width()>imageObj.attr("width")){imageObj.width(imageObj.attr("width"));imageObj.css("height","");}
loadFunction(that);}).error(function(){loadFunction(that);});if(that.readyState=="complete")
{$(that).trigger("load");}
else if(that.readyState)
{that.src=that.src;}
else if(that.complete)
{$(that).trigger("load");}
else if(that.complete===undefined)
{var src=that.src;that.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";that.src=src;}});}
function autoadjust(i,speed)
{if(option[19])autoheightwidth(i,speed,truev);if(option[39])autoheightwidth(i,speed,falsev);}
function autoheightwidth(i,speed,axis)
{obj.ready(function(){adjustHeightWidth(i,speed,axis);runOnImagesLoaded(li.eq(i),falsev,function(){adjustHeightWidth(i,speed,axis);});});};function adjustHeightWidth(i,speed,axis)
{var i=getRealPos(i);var target=li.eq(i);b=target[axis?"height":"width"]();obj.animate(axis?{height:b}:{width:b},{queue:falsev,duration:speed,easing:option[8]});}
function adjustPosition()
{if(!option[6])ul.css("margin-left","-"+bigNumber+"px");ul.css("margin-left",getSlidePos(t,false)).css("margin-top",getSlidePos(t,true));};function getSlidePos(slide,vertical)
{var slide=liConti.eq(slide+(continuousClones?option[40]:0));if(slide.length){var pos=slide.position();return pos?-pos[vertical?'top':'left']:0;}
return 0;};function adjust()
{t=getRealPos(t);if(!option[24])setCurrent(t);adjustPosition();clickable=truev;if(option[17]&&buttonclicked)window.location.hash=option[15][t];if(!fading&&beforeAniFuncFired)
{AniCall(t,truev);}
if(Runner.isMasterOnDetail)
$('body').addClass('runner-dummy-forIE');};function AniCall(i,after)
{i=getRealPos(i);var callBackThis=$();for(a in callBackList[i])
{callBackThis=callBackThis.add(callBackList[i][a]);}
(after?afterAniCall:beforeAniCall)(callBackThis,i+1);}
function afterAniCall(el,a)
{if(isFunc(option[30]))option[30].call(el,a);}
function beforeAniCall(el,a)
{if(isFunc(option[29]))option[29].call(el,a);}
function filterDir(dir)
{if(dir=='next')
{return limitDir(t+1+option[42],dir);}
else if(dir=='prev')
{return limitDir(t-1-option[42],dir);}
else if(dir=='first')
{return 0;}
else if(dir=='last')
{return ts;}
else
{return limitDir(parseInt10(dir),dir);}};function limitDir(i,dir)
{if(option[11])
{return getRealPos(i);}
else
{var maxSlide=s-orgSlideCount;if(i>maxSlide)
{if(t==maxSlide&&dir=='next')
{return 0;}
else
{return maxSlide;}}
else if(i<0)
{if(t==0&&dir=='prev')
{return maxSlide;}
else
{return 0;}}
else
{return i;}}}
function ajaxLoad(i,adjust,speed,ajaxCallBack)
{if(asyncTimedLoad)clearTimeout(asyncTimedLoad);var target=option[25][i],targetslide=li.eq(i),ajaxInit=speed===truev,speed=(speed===truev)?0:speed,ajaxspeed=(fading)?(!option[22]?parseInt10(option[23]*(2/5)):option[23]):speed,tt=i+1,textloaded=falsev;$.ajax({url:target,success:function(data,textStatus,jqXHR){var type=jqXHR.getResponseHeader('Content-Type').substr(0,5);if(type!='image')
{textloaded=truev;targetslide.html(data);ajaxAdjust(i,speed,ajaxCallBack,adjust,ajaxInit,falsev);}},complete:function(jqXHR){if(!textloaded)
{image=new Image();targetslide.html('').append(image);image.src=target;ajaxAdjust(i,speed,ajaxCallBack,adjust,ajaxInit,truev);}}});option[25][i]=falsev;options.ajax[i]=falsev;};function ajaxAdjust(i,speed,ajaxCallBack,adjust,ajaxInit,img){var target=li.eq(i);if(continuousClones)
{var notFirst=falsev;for(a in callBackList[i])
{if(notFirst)callBackList[i][a].replaceWith($(target).clone());notFirst=truev;}
liConti=ul.children("li");}
if(adjust)autoadjust(i,speed);runOnImagesLoaded(target,truev,function(){if(ajaxInit===truev)adjustPosition();if(isFunc(ajaxCallBack))ajaxCallBack();startAsyncDelayedLoad();});if(isFunc(option[28])){option[28].call(target,parseInt10(i)+1,img);}
if(ajaxCallBack==2)
{AniCall(i,falsev);if(!beforeAniFuncFired)
{AniCall(i,truev);beforeAniFuncFired=truev;}}};function fadeto(i,clicked,ajaxcallback)
{if(filterDir(i)!=t&&!destroyed&&clickable)
{ajaxloading=falsev;if(option[24])setCurrent(filterDir(i));if(!(speed||speed==0))var speed=(!clicked&&!option[9]&&option[17])?option[23]*(option[18]/option[7]):option[23],ll=filterDir(i);if(option[2])fadeControls(ll,option[1]);if(ajaxcallback)
{speed=oldSpeed;if(dontCountinueFade)dontCountinueFade--;}
else if(option[25])
{dontCountinueFade=0;oldSpeed=speed;for(a=ll;a<ll+orgSlideCount;a++)
{if(option[25][a])
{ajaxLoad(getRealPos(a),falsev,speed,function(){fadeto(i,clicked,truev);});dontCountinueFade++;}}}
else
{dontCountinueFade=falsev;}
if(!dontCountinueFade)
{clickable=!clicked;autoadjust(ll,option[23]);AniCall(ll,falsev);if(option[22])
{var firstRun=truev,push=0;for(a=ll;a<ll+orgSlideCount;a++)
{var clone=li.eq(getRealPos(a)).clone().prependTo(obj);clone.css({'z-index':'10000','position':'absolute','list-style':'none','top':option[6]?push:0,'left':option[6]?0:push}).hide().fadeIn(option[23],option[8],function(){fixClearType(this);clickable=truev;fading=truev;if(firstRun)
{animate(ll,falsev,falsev,falsev);if(option[17]&&clicked)window.location.hash=option[15][t];AniCall(ll,truev);firstRun=falsev;}
$(this).remove();fading=falsev;});push+=li.eq(a)[option[6]?'outerHeight':'outerWidth'](truev);}}
else
{var fadeinspeed=parseInt10((speed)*(3/5));var fadeoutspeed=speed-fadeinspeed;liConti.each(function()
{$(this).animate({opacity:0.0001},{queue:falsev,duration:fadeoutspeed,easing:option[8],complete:function(){clickable=truev;fading=truev;animate(ll,falsev,falsev,falsev);clickable=!clicked;$(this).animate({opacity:1},{queue:falsev,duration:fadeinspeed,easing:option[8],complete:function(){fixClearType(this);if(option[17]&&clicked)window.location.hash=option[15][t];clickable=truev;fading=falsev;AniCall(ll,truev);}});}});});}}}};function animate(dir,clicked,time,ajaxcallback,speed)
{if((clickable&&!destroyed&&(dir!=t||init))&&s>getRealPos(dir)||ajaxcallback)
{if(!ajaxcallback)ajaxloading=falsev;clickable=(!clicked&&!option[9])?truev:option[16];buttonclicked=clicked;ot=t;t=dir;if(option[24])setCurrent(t);var diff=Math.sqrt(Math.abs(ot-t));if(!(speed||speed==0))var speed=(!time)?0:((!clicked&&!option[9])?parseInt10(diff*option[18]):parseInt10(diff*option[7])),i=getRealPos(t);if(ajaxcallback)
{speed=oldSpeed;if(dontCountinue)dontCountinue--;}
else if(option[25])
{if(option[25][i])
{ajaxLoad(i,truev,init||speed,2);ajaxloading=truev;}
if(!fading)
{var aa=(ot>t)?t:ot,ab=(ot>t)?ot:t;dontCountinue=0;oldSpeed=speed;for(a=aa;a<=ab;a++)
{if(a<=ts&&a>=0&&option[25][a])
{ajaxLoad(a,falsev,speed,function(){animate(dir,clicked,time,truev);});dontCountinue++;}}}
for(a=i+1;a<=i+orgSlideCount;a++)
{if(option[25][a])ajaxLoad(a,falsev,0,falsev);}}
if(!dontCountinue)
{if(!fading&&!ajaxloading)
{AniCall(i,falsev);beforeAniFuncFired=truev;}
if(!fading)autoadjust(t,speed);ul.animate({marginTop:getSlidePos(t,true),marginLeft:getSlidePos(t,false)},{queue:falsev,duration:speed,easing:option[8],complete:adjust});if(option[2])
{var fadetime=option[1];if(!clicked&&!option[9])fadetime=(option[18]/option[7])*option[1];if(!time)fadetime=0;if(fading)fadetime=parseInt10((option[23])*(3/5));fadeControls(t,fadetime);}
if(init)if(!option[25][i])startAsyncDelayedLoad();init=falsev;};}};function getRealPos(a)
{a=parseInt10(a);while(a<0)
{a+=s;}
return a%s;}
function isFunc(func)
{return $.isFunction(func);}
function parseInt10(num)
{return parseInt(num,10);}
function fixClearType(element)
{if(screen.fontSmoothingEnabled)element.style.removeAttribute("filter");}
baseSlider.getOption=function(a){return options[a];}
baseSlider.setOption=function(a,val){baseSlider.destroy();options[a]=val;baseSlider.init();return baseSlider;}
baseSlider.insertSlide=function(html,pos,numtext){baseSlider.destroy();if(pos>s)pos=s;var html='<li>'+html+'</li>';if(!pos||pos==0)ul.prepend(html);else li.eq(pos-1).after(html);if(pos<=destroyT||(!pos||pos==0))destroyT++;if(option[15].length<pos){option[15].length=pos;}
option[15].splice(pos,0,numtext||parseInt10(pos)+1);baseSlider.init();return baseSlider;}
baseSlider.removeSlide=function(pos){pos--;baseSlider.destroy();li.eq(pos).remove();option[15].splice(pos,1);if(pos<destroyT)destroyT--;baseSlider.init();return baseSlider;}
baseSlider.goToSlide=function(a,speed){goToSlide((a==parseInt10(a))?a-1:a,truev,speed);return baseSlider;}
baseSlider.block=function(){clickable=falsev;return baseSlider;}
baseSlider.unblock=function(){clickable=truev;return baseSlider;}
baseSlider.startAuto=function(){option[9]=truev;timeout=startAuto(option[10]);return baseSlider;}
baseSlider.stopAuto=function(){option[9]=falsev;stopAuto();return baseSlider;}
baseSlider.destroy=function(){destroyT=t;if(controls)controls.remove();destroyed=truev;$(option[20]).die("click");if(continuousClones)for(a=1;a<=option[40];a++)liConti.eq(a-1).add(liConti.eq(-a)).remove();adjustPosition();return baseSlider;}
baseSlider.init=function(){if(destroyed){initSudoSlider(obj,destroyT);}
return baseSlider;}
baseSlider.adjust=function(speed){if(!speed)speed=0;autoadjust(i,speed)
return baseSlider;}
baseSlider.getValue=function(a){return a=='currentSlide'?t+1:a=='totalSlides'?s:a=='clickable'?clickable:a=='destroyed'?destroyed:a=='autoAnimation'?autoOn:undefined;}});};})(jQuery);