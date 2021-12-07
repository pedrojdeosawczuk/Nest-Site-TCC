function click() {
if (event.button==2||event.button==3) {
 oncontextmenu='return false';
  }
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")


