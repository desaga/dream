/* used for the global menu */
var hoverClass = "ANM-Hover";
var topmostClass = "ANM";
var userAgent = navigator.userAgent;
var versionOffset = userAgent.indexOf("MSIE");
var isIE = (versionOffset >= 0);
var isPreIE7 = false;
var fullVersionIE = "";
var majorVersionIE = "";
var clientWidth = 0;
var scrollBarOffset = 16;
var menuItemWidth = 200;

if (isIE)
{
    fullVersionIE = parseFloat(userAgent.substring(versionOffset+5, userAgent.length));
    majorVersionIE = parseInt('' + fullVersionIE);
    isPreIE7 = majorVersionIE < 7;
    isPreIE7 = true;
 }

var _onloadEvents = new Array();
function AddOnloadEvent(func){
	_onloadEvents[_onloadEvents.length] = func;
}
function ExecuteOnloadEvents(){
	for(var i = 0; i < _onloadEvents.length; i++){
		eval(_onloadEvents[i]);
	}
}

AddOnloadEvent('SetHover__AspNetMenu()');

window.onload = ExecuteOnloadEvents; 

function Hover__AspNetMenu(element)
{
    AddClass__CssFriendlyAdapters(element, hoverClass);
    setMenuPositionOnHover(element);
    
    if (isPreIE7)
    {
        var child = element.firstChild;
        while (child)
        {
            if (child.tagName == "UL")
            {
            
                var grandchild = child.firstChild;
                while (grandchild)
                {
                    if (grandchild.tagName == "LI")
                    {
                        if ((typeof(grandchild.iFrameFormElementMask) != "undefined") && (grandchild.iFrameFormElementMask != null))
                        {
                            grandchild.iFrameFormElementMask.style.display = "block";
                            
                            var w = grandchild.offsetWidth;
                            if ((grandchild.offsetWidth == 0) && (typeof(element.iFrameFormElementMask) != "undefined") && (element.iFrameFormElementMask != null) && (element.iFrameFormElementMask.style.width.length > 0))
                            {
                                w = element.iFrameFormElementMask.style.width;
                            }
                            grandchild.iFrameFormElementMask.style.width = w;
                            
                            var h = grandchild.offsetHeight + 5 /* fudge to cover margins between menu items */;
                            if ((grandchild.offsetHeight == 0) && (typeof(element.iFrameFormElementMask) != "undefined") && (element.iFrameFormElementMask != null) && (element.iFrameFormElementMask.style.height.length > 0))
                            {
                                h = element.iFrameFormElementMask.style.height;
                            }
                            grandchild.iFrameFormElementMask.style.height = h;
                            
                        }
                    }
                    
                    grandchild = grandchild.nextSibling;
                }
            }

            child = child.nextSibling;
        }
    }
}

function Unhover__AspNetMenu(element)
{
    RemoveClass__CssFriendlyAdapters(element, hoverClass);
    RemoveClass__CssFriendlyAdapters(element, "DisplayMenuOnLeft");
    RemoveClass__CssFriendlyAdapters(element, "DisplayMenuOnRight");         
    
    if (isPreIE7)
    {
        var child = element.firstChild;
        while (child)
        {
            if (child.tagName == "UL")
            {
                var grandchild = child.firstChild;
                while (grandchild)
                {
                    if (grandchild.tagName == "LI")
                    {
                        if ((typeof(grandchild.iFrameFormElementMask) != "undefined") && (grandchild.iFrameFormElementMask != null))
                        {
                            grandchild.iFrameFormElementMask.style.display = "none";
                        }
                    }

                    grandchild = grandchild.nextSibling;
                }
            }

            child = child.nextSibling;
        }
    }
}

function SetHover__AspNetMenu()
{
    var menus = document.getElementsByTagName("ul");
    for (var i=0; i<menus.length; i++)
    {
        if(menus[i].className == topmostClass)
        {
            var items = menus[i].getElementsByTagName("li");
            for (var k=0; k<items.length; k++)
            {
                
                items[k].onmouseover = function() { Hover__AspNetMenu(this); }
                items[k].onmouseout = function() { Unhover__AspNetMenu(this); }
                
                if (isPreIE7 && ((typeof(items[k].iFrameFormElementMask) == "undefined") || (items[k].iFrameFormElementMask == null)))
                {
                    var iFrameFormElementMask = document.createElement("IFRAME");
                    iFrameFormElementMask.scrolling= "no";
                    iFrameFormElementMask.src = "javascript:false;";
                    iFrameFormElementMask.frameBorder = 0;
                    iFrameFormElementMask.style.display = "none";
                    iFrameFormElementMask.style.position = "absolute";
                    iFrameFormElementMask.style.filter = "progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)";

                    iFrameFormElementMask.style.zIndex = -1;
                    items[k].insertBefore(iFrameFormElementMask, items[k].firstChild);
                    items[k].iFrameFormElementMask = iFrameFormElementMask;
                }             
            }
        }
    }
}

function getClientWidth()
{
    if (window.innerWidth) {
        clientWidth = (window.innerWidth - scrollBarOffset);
    }
    else if (document.documentElement && document.documentElement.clientWidth) {
        clientWidth = (document.documentElement.clientWidth - scrollBarOffset);
    }
    else if (document.body && document.body.clientWidth) {
        clientWidth = document.body.clientWidth;
    }    
    return clientWidth;
}

function setMenuPositionOnHover(element)
{
var correction = 1;
	if(HasClass__CssFriendlyAdapters(element, "ANM-Root")){		
		
		var child = element.firstChild;
        while (child)
        {
            if (child.tagName == "UL" && HasClass__CssFriendlyAdapters(child, "ANM-Sub"))
            {
            	var firstEl = element;
            	while (firstEl.previousSibling) {
            		firstEl = firstEl.previousSibling;
            	}
            	
            	if (!isIE ) {
            		if (element.parentNode.offsetWidth < document.documentElement.offsetWidth) {
	            		correction = (document.documentElement.offsetWidth - 12 - element.parentNode.offsetWidth)/2;
            		}
            		else {
            			correction = 12;
            		}
            	}
				//reset the left position to that of it's parent
				child.style.left = findPosX(element) - findPosX(firstEl) - correction; //element.style.left;
				/*if(child.offsetLeft < getClientWidth()){
					//move the item to the left until it shows the entire contents of the list
					var pStartX = findPosX(child);
					var cWidth = getClientWidth();
					//alert(findPosX(element));
					if( (pStartX + menuItemWidth) > cWidth){
						var leftAdjust = (pStartX + menuItemWidth) - cWidth;
						child.style.left -= leftAdjust;
						break;
					}
				}*/
            }
            child = child.nextSibling;
        }
	}
	else{
		if(HasClass__CssFriendlyAdapters(element, "ANM-Leaf") 
			&& element.parentNode!=null && element.parentNode.className =="ANM-Sub" 
			&& element.parentNode.parentNode!=null)
		{
			var elementOffset = element.parentNode.parentNode.offsetLeft;

			if(elementOffset >= (getClientWidth() - (menuItemWidth * 2)))
			{
				AddClass__CssFriendlyAdapters(element, "DisplayMenuOnLeft");
			}
			else
			{
				AddClass__CssFriendlyAdapters(element, "DisplayMenuOnRight");
			}
		}
	}
}

function findPosX(obj)
{
	var curleft = 0;
	if(obj.offsetParent)
		while(1) 
		{
		  curleft += obj.offsetLeft;
		  if(!obj.offsetParent)
			break;
		  obj = obj.offsetParent;
		}
	else if(obj.x)
		curleft += obj.x;
	return curleft;
}

function findPosY(obj)
{
	var curtop = 0;
	if(obj.offsetParent)
		while(1)
		{
		  curtop += obj.offsetTop;
		  if(!obj.offsetParent)
			break;
		  obj = obj.offsetParent;
		}
	else if(obj.y)
		curtop += obj.y;
	return curtop;
}

function CanHaveClass__CssFriendlyAdapters(element)
{
    return ((element != null) && (element.className != null));
}

function HasAnyClass__CssFriendlyAdapters(element)
{
    return (CanHaveClass__CssFriendlyAdapters(element) && (element.className.length > 0));
}

function HasClass__CssFriendlyAdapters(element, specificClass)
{
    return (HasAnyClass__CssFriendlyAdapters(element) && (element.className.indexOf(specificClass) > -1));
}

function AddClass__CssFriendlyAdapters(element, classToAdd)
{
    if (HasAnyClass__CssFriendlyAdapters(element))
    {
        if (!HasClass__CssFriendlyAdapters(element, classToAdd))
        {
            element.className = element.className + " " + classToAdd;
        }
    }
    else if (CanHaveClass__CssFriendlyAdapters(element))
    {
        element.className = classToAdd;
    }
}

function AddClassUpward__CssFriendlyAdapters(startElement, stopParentClass, classToAdd)
{
    var elementOrParent = startElement;
    while ((elementOrParent != null) && (!HasClass__CssFriendlyAdapters(elementOrParent, topmostClass)))
    {
        AddClass__CssFriendlyAdapters(elementOrParent, classToAdd);
        elementOrParent = elementOrParent.parentNode;
    }    
}

function SwapClass__CssFriendlyAdapters(element, oldClass, newClass)
{
    if (HasAnyClass__CssFriendlyAdapters(element))
    {
        element.className = element.className.replace(new RegExp(oldClass, "gi"), newClass);
    }
}

function SwapOrAddClass__CssFriendlyAdapters(element, oldClass, newClass)
{
    if (HasClass__CssFriendlyAdapters(element, oldClass))
    {
        SwapClass__CssFriendlyAdapters(element, oldClass, newClass);
    }
    else
    {
        AddClass__CssFriendlyAdapters(element, newClass);
    }
}

function RemoveClass__CssFriendlyAdapters(element, classToRemove)
{
    SwapClass__CssFriendlyAdapters(element, classToRemove, "");
}

function RemoveClassUpward__CssFriendlyAdapters(startElement, stopParentClass, classToRemove)
{
    var elementOrParent = startElement;
    while ((elementOrParent != null) && (!HasClass__CssFriendlyAdapters(elementOrParent, topmostClass)))
    {
        RemoveClass__CssFriendlyAdapters(elementOrParent, classToRemove);
        elementOrParent = elementOrParent.parentNode;
    }    
}

