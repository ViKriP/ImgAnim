function iframeH(id){
var iframe = parent.document.getElementById(id);
iframe.style.height=document.body.clientHeight+46+'px';
};

function ImgFiltr(id){
var el=document.getElementById(id);
var valchan=el.value;
var sel=el.selectedIndex;
var options=el.options;
//alert('Выбрана опция '+options[sel].text+' '+options[sel].value);
//    alert('Выбрана опция '+sel.text);

$('.imgcat').removeClass('seled');
$('.imgcat>select option:selected').each(function(){this.selected=false;});

existCanv = document.getElementById("etCanva");
if(existCanv){existCanv.remove();}

        $('#page-navigator>div.active').css("display", "none");
        $('#page-navigator>div.active').removeClass('active');

el.parentElement.classList.add("seled");
el.selectedIndex=sel;
        $('#' + valchan).addClass('active');
        $('#' + valchan).css("display", "block");

iframeH('imganimFrame');
}

$(document).ready(function(){
	$('#ImgFiltr1').get(0).selectedIndex = 1;
	$('#ImgFiltr1').change();
});


//--- etag
var ImgCrop;
var minWidth;
var minHeight;
var PolyArr;

$("polygon").unbind("click").click(function(){

existCanv = document.getElementById("etCanva");
if(existCanv){existCanv.remove();}

var poly = this.getAttribute('points');

var Img = this.parentElement.getElementsByTagName("image")[0];
var ImgPath = Img.getAttribute('xlink:href');
var ImgW = Img.getAttribute('width');
var ImgH = Img.getAttribute('height');

ImgCrop = ImgPath;
minWidth = ImgW;
minHeight = ImgH;

PolyArr = poly.split(' ');

CanvasStart();

//-------
// наполн массив
//-------
var PolyArrXY = [];
var PolyArrX = [];
var PolyArrY = [];
for (var i = 0; i < PolyArr.length; i++) {
	PolyArrXY = PolyArr[i].split(',');
	addClick(PolyArrXY[0],PolyArrXY[1]); 
	PolyArrX.push(PolyArrXY[0]);
	PolyArrY.push(PolyArrXY[1]);
}

var PolyXmax = Math.max.apply(null, PolyArrX);
var PolyXmin = Math.min.apply(null, PolyArrX);
var PolyW = PolyXmax - PolyXmin;

var PolyYmax = Math.max.apply(null, PolyArrY);
var PolyYmin = Math.min.apply(null, PolyArrY);
var PolyH = PolyYmax - PolyYmin;

//-------
// наполн массив
//-------
// generate
//-------
    $(".clipParent").empty(); 
    $(".clipParent").prepend('<img src="'+ImgCrop+'" id="genimg" />'); //01.jpg
    var arr = []; 
    for(var i=0; i < clickX.length; i++){ 
        arr.push(clickX[i]); 
        arr.push(clickY[i]); 
    } 
    $("#genimg")[0].setAttribute("data-polyclip",arr.join(", ")); 
    clickX=[]; 
    clickY=[]; 
    redraw(); 
    polyClip.init(); 
//-------
// generate
//-------
// xymove
//-------
setTimeout(function() {

var canvasDiv = document.getElementById('ImgCrop'); 
canvas = document.createElement('canvas'); 
canvas.setAttribute('width', PolyW); 
canvas.setAttribute('height', PolyH); 
canvas.setAttribute('id', 'etCanva'); 
$(canvasDiv).prepend(canvas); 

var et = document.getElementById('etCanva'), 
    ctx = et.getContext('2d');

var canvas1 = document.getElementById('polyClip0'),
    ctx1 = canvas1.getContext('2d');

ctx.drawImage(canvas1,PolyXmin,PolyYmin,PolyW,PolyH,0,0,PolyW,PolyH);
document.getElementById("canvas").remove();
document.getElementById("polyClip0").remove();

iframeH('imganimFrame');

document.getElementById('ImgAnim-wrap').scrollIntoView();

}, 500);
//-------
// xymove
//----

});

//--- etag
//--- crop
var imageObj;
var context;

function CanvasStart(){
var canvasDiv = document.getElementById('canvasDiv'); 
canvas = document.createElement('canvas'); 
canvas.setAttribute('width', 1); 
canvas.setAttribute('height', 1); 
canvas.setAttribute('id', 'canvas'); 
$(canvasDiv).prepend(canvas); 
if(typeof G_vmlCanvasManager != 'undefined') { 
    canvas = G_vmlCanvasManager.initElement(canvas); 
} 
  
context = canvas.getContext('2d'); 
imageObj = new Image(); 
  
imageObj.onload = function() {
    $(canvas).attr({width : this.width, height: this.height, style: 'display: none'});
    context.drawImage(imageObj,0,0); 
}; 
imageObj.src = ImgCrop;
}

var clickX = new Array(); 
var clickY = new Array(); 
var clickDrag = new Array(); 
var paint; 
  
function addClick(x, y, dragging) 
{ 
    clickX.push(x); 
    clickY.push(y); 
    clickDrag.push(dragging); 
} 
  
function redraw(){ 
    canvas.width = canvas.width; // Clears the canvas 
    context.drawImage(imageObj,0,0); 
  
    context.strokeStyle = "#df4b26"; 
    context.lineJoin = "round"; 
    context.lineWidth = 5; 
              
    for(var i=0; i < clickX.length; i++) 
    { 
    context.beginPath(); 
    context.arc(clickX[i], clickY[i], 3, 0, 2 * Math.PI, false); 
    context.fillStyle = '#ffffff'; 
    context.fill(); 
    context.lineWidth = 5; 
    context.stroke(); 
    } 
} 
  
$('#canvas').click(function(e){ 
    var mouseX = e.pageX - this.offsetLeft; 
    var mouseY = e.pageY - this.offsetTop; 
          
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop); 
    redraw(); 
}); 
//--- crop
//--- polyclip-p
var polyClip = new function() {
    function s(b, c) {
        q[b] = new Image;
        var e = q[b];
        $(c).attr("data-polyclip-index", b);
        $(e).bind("load", function() {
            d.drawShape(b, c)
        });
        e.src = c.src
    }
    var d = this,
        r, k = [],
        q = [];
    d.isOldIE = window.G_vmlCanvasManager;
    d.init = function() {
        r = $("img[data-polyclip]");
        r.each(s)
    };
    d.drawShape = function(b, c) {
        var e = $(c),
            a = document.createElement("canvas");
a.setAttribute('style','display:none');
        a.width = minWidth;
        a.height = minHeight;
        a.id = "polyClip" + b;
//a.translate(-416,-5);
        var l = jQuery.trim(e.attr("data-polyclip")).split(","),
            j = c.src;
        k[a.id] = [];
        e.replaceWith(a);
        d.isOldIE && G_vmlCanvasManager.initElement(a);
        for (var f = a.getContext("2d"), e = 0; e < l.length; e += 2) {
            var h = parseInt(jQuery.trim(l[e])),
                i = parseInt(jQuery.trim(l[e + 1]));
            k[a.id].push({
                x: h,
                y: i
            });
            e == 0 ? f.moveTo(h, i) : f.lineTo(h, i)
        }
        if (d.isOldIE) f.fillStyle = "", f.fill(), a = $("fill", a).get(0), a.color = "", a.src = c.src, a.type = "tile", a.alignShape = false;
        else {
            var g = new Image;
            g.onload = function() {
                var a = f.createPattern(g, "repeat");
                f.fillStyle = a;
                f.fill();
                a: {
                    for (var b = parseInt(jQuery.trim(l[0])), c = parseInt(jQuery.trim(l[1])),
                            e = -1; e <= 1; e++)
                        for (var d = 0; d <= 1; d++)
                            if (a = f.getImageData(b + e, c + d, 1, 1).data[3], a != 0) {
                                a = true;
                                break a
                            }
                    a = false
                }
                a || g.src.indexOf("?chromeError") < 0 && (g.src += "?chromeError")
            };
            g.src = j
        }
    };
    d.findObject = function(b) {
        var c = b.currentTarget;
        if ($(c).hasClass("cropParent")) return $(c);
        for (var e in k)
            if (k.hasOwnProperty(e) && (c = $("#" + e), d.isInPolygon(c, b.pageX, b.pageY, true))) return c
    };
    d.isInPolygon = function(b, c, e, a) {
        var d = b.get(0),
            d = k[d.id],
            j = d.length,
            f, h, i, g, o, m, p = false,
            n = {
                left: 0,
                top: 0
            };
        a && (n = b.offset());
        if (j < 3) return false;
        f = d[j - 1].x + n.left;
        h = d[j - 1].y + n.top;
        for (m = 0; m < j; m++) b = d[m].x + n.left, a = d[m].y + n.top, b > f ? (i = f, o = b, g = h, h = a) : (i = b, o = f, g = a), b < c == c <= f && (e - g) * (o - i) < (h - g) * (c - i) && (p = !p), f = b, h = a;
        return p
    }
};
//document.write('<style type="text/css">img[data-polyclip], img.polyClip { visibility: hidden; }</style>');
polyClip.isOldIE ? $(window).bind("load", polyClip.init) : $(document).ready(polyClip.init);
//--- polyclip-p

