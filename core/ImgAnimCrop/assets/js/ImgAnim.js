// Преобразование полигона в нужный вид
function PointsToSVG() {
//alert('Ok');
var o = document.getElementById("ImgPolyPoints");
//alert('value=' + o.value + ' inner=' + o.innerHTML);
var poly = document.getElementById("ImgPolyPointsEdit");

var i = 0;
var pars = o.value.replace(/,/g, function(i) {
    return function() {
        return (i++ % 2 ? ' ' : ',');
    };
}(0));
poly.value = pars; //o.value;
};


function ToHide(ObjID) {
var o = document.getElementById(ObjID);
if (o.hidden == true){
	o.hidden=false;
} else {
	o.hidden=true;
}
}
