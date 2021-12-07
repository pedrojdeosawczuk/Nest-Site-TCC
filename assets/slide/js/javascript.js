
var totalCount = 3;
function ChangeIt() 
{
var num = Math.ceil( Math.random() * totalCount );
document.body.background = 'assets/slide/img/'+num+'.jpg';
document.body.style.backgroundRepeat = "repeat"; // Background repeat
}